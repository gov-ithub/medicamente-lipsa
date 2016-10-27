<?php namespace Modules\Meds\Repositories\Cache;

use Modules\Meds\Repositories\RecipeRepository;
use Modules\Core\Repositories\Cache\BaseCacheDecorator;

class CacheRecipeDecorator extends BaseCacheDecorator implements RecipeRepository
{
    public function __construct(RecipeRepository $recipe)
    {
        parent::__construct();
        $this->entityName = 'meds.recipes';
        $this->repository = $recipe;
    }
}
