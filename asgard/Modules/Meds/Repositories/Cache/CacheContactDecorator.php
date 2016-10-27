<?php namespace Modules\Meds\Repositories\Cache;

use Modules\Meds\Repositories\ContactRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheContactDecorator extends BaseCacheDecorator implements ContactRepository
{
    public function __construct(ContactRepository $contact)
    {
        parent::__construct();
        $this->entityName = 'meds.contacts';
        $this->repository = $contact;
    }
}
