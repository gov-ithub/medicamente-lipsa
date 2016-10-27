<?php namespace Modules\Meds\Repositories\Eloquent;

use Modules\Meds\Entities\Reply;
use Modules\Meds\Repositories\PatientRepository;
use Modules\Core\Repositories\Eloquent\EloquentBaseRepository;

class EloquentPatientRepository extends EloquentBaseRepository implements PatientRepository
{
    public function update($patient, $data)
    {

		$patient->update($data);

        $patient->med()->update(array_get($data, 'med', []));
        $patient->contact()->update(array_get($data, 'contact', []));
        $patient->recipe()->update(array_get($data, 'recipe', []));
		
		$this->auth = app('Modules\Core\Contracts\Authentication');
		if(!$patient->med->myReply){
			$reply = Reply::create([
				'user_id' => $this->auth->check()->id,
				'med_id' => $patient->med->id,
			]);
			$reply->save();
//			$patient->med->myReply()->associate($reply);
		}
		if(!trim($data['reply']['deadline']))
			$data['reply']['deadline'] = null;
        $patient->med->myReply()->update(array_get($data, 'reply', []));
		if($this->auth->check()->hasRoleName('Admin')){
			$patient->med->reply_id = (bool) $data['reply']['is_public'] ? $patient->med->myReply->id : null;
			$patient->med->save();
		}
		
        return $patient;
    }
}
