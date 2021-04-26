<?php

namespace App\Providers;

use App\Actions\Auth\LogsInUser;
use App\Actions\Auth\LogsOutUser;
use App\Contracts\Auth\ILogsInUser;
use App\Actions\Auth\RegistersUsers;
use App\Contracts\Auth\ILogsOutUser;
use App\Contracts\Auth\IRegistersUser;
use Illuminate\Support\ServiceProvider;
use App\Actions\PhotoshootRequest\CreatesPhotoshootRequest;
use App\Contracts\PhotoshootRequest\ICreatesPhotoshootRequest;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //Authentication Container bindings
        $this->app->bind(IRegistersUser::class, RegistersUsers::class);
        $this->app->bind(ILogsInUser::class, LogsInUser::class);
        $this->app->bind(ILogsOutUser::class, LogsOutUser::class);

        // 
        $this->app->bind(ICreatesPhotoshootRequest::class, CreatesPhotoshootRequest::class);
    }
}
