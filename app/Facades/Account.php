<?php

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static \App\Models\User store(array $data)
 * @see \App\Services\Account\AccountService
 */

class Account extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'account_service';
    }
}
