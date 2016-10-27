<?php namespace Modules\Meds\Repositories\Cache;

use Modules\Meds\Repositories\PatientRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CachePatientDecorator extends BaseCacheDecorator implements PatientRepository
{
    public function __construct(PatientRepository $patient)
    {
        parent::__construct();
        $this->entityName = 'meds.patients';
        $this->repository = $patient;
    }
}
