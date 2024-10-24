<?php

namespace App\Facades;

use App\Services\User\UserService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static index(string $name, ?int $limit)
 *
 * @see UserService
 */
class User extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'user_service';
    }
}
