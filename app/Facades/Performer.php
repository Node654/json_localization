<?php

namespace App\Facades;

use App\Services\Performer\PerformerService;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Facade;

/**
 * @method static store(array $data)
 * @see PerformerService
 */
class Performer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'performer_service';
    }
}
