<?php

namespace Modules\User;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\User\Facades\ScheduleFacade;
use Modules\User\Facades\UserFacade;
use Modules\User\Services\DepartmentService;
use Modules\User\Services\ScheduleService;
use Modules\User\Services\UserService;


class UserServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\User\Http\Controllers';

    public function register()
    {
       UserFacade::shouldProxyTo(UserService::class);
        //add mocking in tests
//        if (app()->runningUnitTests()) {
//        } else {
//        }
    }

    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            $this->mapApiRoutes();
        }

        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    private function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__.'/routes/api.php');
    }
}
