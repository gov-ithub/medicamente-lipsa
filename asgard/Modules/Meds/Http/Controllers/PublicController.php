<?php namespace Modules\Meds\Http\Controllers;

use Modules\Core\Http\Controllers\BasePublicController;
use Modules\User\Entities\Sentinel\User;
use Illuminate\Mail\Mailer;

use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;
use Modules\Meds\Http\Requests\SubscribeMedRequest;
use Modules\Meds\Http\Requests\CreateMedRequest;
use Modules\Meds\Http\Requests\SearchMedRequest;

use Modules\Meds\Entities\Patient;
use Modules\Meds\Entities\Notification;
use Modules\Meds\Entities\Med;
use Modules\Meds\Entities\Contact;
use Modules\Meds\Entities\Recipe;
use Modules\Meds\Entities\Reply;

class PublicController extends BasePublicController
{
	private $mailer;
	
	//TODO: redo all CRUD with repository
	public function __construct(Mailer $mailer) {
        parent::__construct();
		$this->mailer = $mailer;
		
		view()->share('medPackage', Med::$packageList);
    }

	public function index() {
		$patients = Patient::where('status', 1)
						->orderBy('created_at', 'desc')
							->paginate(10);

		if (\Request::ajax()) {
			return view('meds.partials.paged_meds')->with(compact('patients'))->render();
		}
		return view('meds.index')->with(compact('patients'));
	}
	
	public function falseReports() {
		$patients = Patient::where('status', Patient::getStatus('Neeligibil'))
						->orderBy('created_at', 'desc')
							->get();

		return view('meds.false-reports', [
				'medPackage' => Med::$packageList,
			])->with(compact('patients'));
	}
	public function subscribeRequest(SubscribeMedRequest $request) {
		$patient = Patient::findOrFail((int) $request->all()['patient_id']);
		$patient->notifications()->create([
			'email' => $request->all()['email']
		]);
		return 'saved!';
	}
	
	public function newRequest() {
		return view('meds.cerere', [
			'patientRoles' => Patient::$roles,
			'medPackage' => Med::$packageList,
		]);
    }
	
	public function postRequest(CreateMedRequest $request) {
		//dd($request);
		$row = Patient::create();
		$row->fill($request->all());
		$row->status = 1; //auto-publish
		
		$med = new Med;
		$med->fill($request->all()['med']);
		$row->med()->save($med);
		
		$contact = new Contact;
		$contact->fill($request->all()['contact']);
		$row->contact()->save($contact);
		
		$recipe = new Recipe;
		$recipe->fill($request->all()['recipe']);
		$row->recipe()->save($recipe);
		
        $row->push();
//		if(app()->environment('live'))
			$this->sendNotification($row);
		
		return view('meds.cerere-confirm');
	}
	
	public function search(Request $request) {
		if(isset($request->all()['q'])) {
			preg_match_all("/\b\w{3}\w*\b/", $queryString = trim($request->all()['q']), $search_words);
			$queryWords = implode(' ', $search_words[0]);

			if(trim($queryWords)) {
				$meds = Med::search($queryWords, 0)
							->with(['patient', 'publicReply'])
								->orderBy('relevance', 'desc')
								->orderBy('created_at', 'desc')
									->get();
			}
		} else {
			$meds = null;
			$queryString = '';
		}
		return view($request->ajax() ? 'meds.partials.search_results' : 'meds.search')->with(compact('meds', 'queryString'));
	}
	
	public function searchMedName(SearchMedRequest $request) {
		$medName = trim($request->all()['med_name']);
		\Session::flash('med_name', $medName);
		$meds = Med::like('name', $medName)->get();
		if(!$meds->count())
			return redirect()->route('public.cerere');

		return view('meds.search_add')->with(compact('meds', 'medName'));
	}
	
	//copy replies from prev. version
	public function importReplies(){
		$replies = \Modules\Meds\Entities\Reply1::all();
		$skipped = [];
		foreach($replies as $r){
			$p = Patient::find($r->patient_id);
			if($p){
				$reply = Reply::create([
					'user_id' => 1,
					'med_id' => $p->med->id,
					'cause' => html_entity_decode($r->cause),
					'action' => html_entity_decode($r->action),
					'deadline' => $r->deadline,
					'created_at' => $r->created_at,
					'is_public' => 1
				]);
				$p->med->reply_id = $reply->id;
				$p->med->save();
			} else 
				$skipped[] = $r;
		}
		dd($skipped);
	}
		
	private function sendNotification($patient){
		$admins = User::lists('email')->toArray();
//		dd($admins);
        $this->mailer->send(['html' => 'meds.emails.html.notification'],
			compact('patient'),
			function($message) use( $patient, $admins ){
				$message->from('no-reply@medicamentelipsa.ro', "MedicamenteLipsa.ro");
				$message->subject("Medicament lipsă: {$patient->med->name} (#{$patient->id})");
				
				$message->bcc($admins);
			});
		return response('s-a dus');
    }	
}
