<?php namespace Modules\Meds\Providers;

use Illuminate\Support\ServiceProvider;

class MedsServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return array();
    }

    private function registerBindings()
    {
        $this->app->bind(
            'Modules\Meds\Repositories\MedRepository',
            function () {
                $repository = new \Modules\Meds\Repositories\Eloquent\EloquentMedRepository(new \Modules\Meds\Entities\Med());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Meds\Repositories\Cache\CacheMedDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Meds\Repositories\PatientRepository',
            function () {
                $repository = new \Modules\Meds\Repositories\Eloquent\EloquentPatientRepository(new \Modules\Meds\Entities\Patient());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Meds\Repositories\Cache\CachePatientDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Meds\Repositories\ContactRepository',
            function () {
                $repository = new \Modules\Meds\Repositories\Eloquent\EloquentContactRepository(new \Modules\Meds\Entities\Contact());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Meds\Repositories\Cache\CacheContactDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Meds\Repositories\RecipeRepository',
            function () {
                $repository = new \Modules\Meds\Repositories\Eloquent\EloquentRecipeRepository(new \Modules\Meds\Entities\Recipe());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Meds\Repositories\Cache\CacheRecipeDecorator($repository);
            }
        );
        $this->app->bind(
            'Modules\Meds\Repositories\ReplyRepository',
            function () {
                $repository = new \Modules\Meds\Repositories\Eloquent\EloquentReplyRepository(new \Modules\Meds\Entities\Reply());

                if (! config('app.cache')) {
                    return $repository;
                }

                return new \Modules\Meds\Repositories\Cache\CacheReplyDecorator($repository);
            }
        );
// add bindings





    }
}
