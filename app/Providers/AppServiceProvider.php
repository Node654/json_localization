<?php

namespace App\Providers;

use App\Http\Resources\Api\v1\Account\UserResource;
use App\Services\Account\AccountService;
use App\Services\Language\LanguageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind('account_service', AccountService::class);
        $this->app->bind('language_service', LanguageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserResource::withoutWrapping();
    }
}
