<?php

namespace App\Providers;

use App\Services\TournamentService;
use App\Services\UserService;
use App\Services\WebsiteService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        Paginator::useBootstrap();
        $this->app->bind(WebsiteService::class,function (){
            return new WebsiteService();
        });
        $this->app->bind(TournamentService::class,function (){
            return new TournamentService();
        });
        $this->app->bind(UserService::class,function (){
            return new UserService();
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }
}
