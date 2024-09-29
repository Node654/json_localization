<?php

namespace App\Facades;

use App\Services\Language\LanguageService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static JsonResponse store(array $data)
 * @see LanguageService
 */
class Language extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'language_service';
    }
}
