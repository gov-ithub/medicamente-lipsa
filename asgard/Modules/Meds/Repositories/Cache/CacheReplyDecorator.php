<?php namespace Modules\Meds\Repositories\Cache;

use Modules\Meds\Repositories\ReplyRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheReplyDecorator extends BaseCacheDecorator implements ReplyRepository
{
    public function __construct(ReplyRepository $reply)
    {
        parent::__construct();
        $this->entityName = 'meds.replies';
        $this->repository = $reply;
    }
}
