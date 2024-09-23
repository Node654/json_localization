<?php

namespace App\Services\Account;

use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AccountService
{
    public function store(array $data): User
    {
        return User::create([
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'accountType' => Arr::get($data, 'accountType'),
            'companyName' => Arr::get($data, 'companyName'),
            'password' => Hash::make(Arr::get($data, 'password.value')),

        ]);
    }
}
