<?php

namespace App\Facades;

use App\Http\Requests\Api\v1\Account\SignInRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User store(array $data)
 * @method static string signIn(string $email, string $password)
 * @see \App\Services\Account\AccountService
 */

class Account extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'account_service';
    }
}
