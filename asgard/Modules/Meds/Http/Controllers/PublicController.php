<?php namespace Modules\Meds\Http\Controllers;

use Modules\Core\Http\Controllers\BasePublicController;
use Illuminate\Http\Request;
use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Mail\Mailer;
use Modules\User\Entities\Sentinel\User;

use Modules\Meds\Http\Requests\CreateMedRequest;
use Modules\Meds\Entities\Patient;
use Modules\Meds\Entities\Med;
use Modules\Meds\Entities\Contact;
use Modules\Meds\Entities\Recipe;
use Modules\Meds\Entities\Reply;

class PublicController extends BasePublicController
{
	private $mailer;
	
	public function __construct(Mailer $mailer) {
        parent::__construct();
		$this->mailer = $mailer;
    }

	public function index() {
		$patients = Patient::where('status', 1)
						->orderBy('created_at', 'desc')
							->get();

		return view('meds.index', [
				'medPackage' => Med::$packageList,
			])->with(compact('patients'));
	}
	
	public function falseReports() {
		$patients = Patient::where('status', Patient::getStatus('Neeligibil'))
						->orderBy('created_at', 'desc')
							->get();

		return view('meds.false-reports', [
				'medPackage' => Med::$packageList,
			])->with(compact('patients'));
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
	
	public function test1(){
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
