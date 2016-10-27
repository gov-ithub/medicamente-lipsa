<?php namespace Modules\Meds\Repositories\Cache;

use Modules\Meds\Repositories\MedRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheMedDecorator extends BaseCacheDecorator implements MedRepository
{
    public function __construct(MedRepository $med)
    {
        parent::__construct();
        $this->entityName = 'meds.meds';
        $this->repository = $med;
    }
}
