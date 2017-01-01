<?php namespace Modules\Meds\Handlers\Events;

use Modules\Meds\Entities\Reply;
use Modules\Meds\Entities\Notification;
use Illuminate\Mail\Mailer;

class ReplyEvents {

    protected $mailer = null;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function replyUpdated(Reply $reply)
    {
		$notify = $reply->med->patient->notifications;
		if($reply->med->patient->allow_contact) {
			$notify->push(new Notification([
				'patient_id' => $reply->med->patient->id,
				'email' => $reply->med->patient->email,
			]));
			if($reply->med->patient->contact) {
				if($reply->med->patient->contact->email) {
					$notify->push(new Notification([
						'patient_id' => $reply->med->patient->id,
						'email' => $reply->med->patient->contact->email,
					]));
				}
			}
		}
		
//		dd($notify);
//        $this->mailer->notifyReplyUpdated($article);
    }

}