<?php

namespace App\Providers;

use App\Http\Controllers\Api\v1\Performer\PerformerController;
use App\Http\Resources\Api\v1\Account\UserResource;
use App\Services\Account\AccountService;
use App\Services\Document\DocumentService;
use App\Services\Language\LanguageService;
use App\Services\Performer\PerformerService;
use App\Services\Project\ProjectService;
use App\Services\User\UserService;
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
        $this->app->bind('project_service', ProjectService::class);
        $this->app->bind('document_service', DocumentService::class);
        $this->app->bind('performer_service', PerformerService::class);
        $this->app->bind('user_service', UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        UserResource::withoutWrapping();
    }
}
