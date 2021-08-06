<?php

namespace Modules\Auth;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Modules\Auth\Authenticator\ApiAuth;
use Modules\Auth\Authenticator\TokenGenerator;
use Modules\Auth\Facades\AuthFacade;
use Modules\Auth\Facades\TokenGeneratorFacade;
use Modules\Auth\Facades\UserProviderFacade;

class SampleAuthServiceProvider extends ServiceProvider
{
    private $namespace = 'Modules\Auth\Http\Controllers';

    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/config/sample_login.php', 'sample_login');

        AuthFacade::shouldProxyTo(ApiAuth::class);
        UserProviderFacade::shouldProxyTo(UserProvider::class);
        TokenGeneratorFacade::shouldProxyTo(TokenGenerator::class);

//        if (app()->runningUnitTests()) {
//            //TODO add fake classes for test
//        } else {
//
//        }
    }

    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            $this->defineRoutes();
        }

        if ($this->app->runningInConsole()) {
            $this->publishes(
                [
                    __DIR__.'/config' => $this->app->configPath(),
                ],
                'sample_login'
            );
        }
    }

    private function defineRoutes()
    {

        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(__DIR__.'/routes.php');
    }
}
