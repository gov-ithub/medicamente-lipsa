<?php namespace Modules\Meds\Presenters;

use Laracasts\Presenter\Presenter;
use Modules\Blog\Entities\Status;

class MedPresenter extends Presenter
{
    private $med;
	private $causePeriod = 4; //work days
	private $actionPeriod = 7; // 4 + 7 days

    public function __construct($entity)
    {
        parent::__construct($entity);
        $this->repository = app('Modules\Meds\Repositories\MedRepository');
    }

	/**
	 * 
	 * @param type $ts		true  - return timestamp
	 *						false - carbon object
	 * @param type $forJs	*1000, only of $ts is true
	 */
	public function causeDeadline($ts = true, $forJs = true) {
		$ddl = $this->entity->created_at->copy()
				->addWeekdays($this->causePeriod)
					->hour($this->entity->created_at->hour)
					->minute($this->entity->created_at->minute)
					->second($this->entity->created_at->second);
		if(!$ts)
			return $ddl;
		return $ddl->timestamp * ($forJs ? 1000 : 1);
	}
	public function actionDeadline($ts = true, $forJs = true) {
		$ddl = $this->entity->created_at->copy()
				->addWeekdays($this->causePeriod)
				->addDays($this->actionPeriod)
					->hour($this->entity->created_at->hour)
					->minute($this->entity->created_at->minute)
					->second($this->entity->created_at->second);
		if(!$ts)
			return $ddl;
		return $ddl->timestamp * ($forJs ? 1000 : 1);
	}


	//preview long replies... (unused)
	private function truncate($text, $length) {
		$length = abs((int) $length);
		if (strlen($text) > $length) {
			$text = preg_replace("/^(.{1,$length})(\s.*|$)/s", '\\1...', $text); // …
		}
		return($text);
	}

}
