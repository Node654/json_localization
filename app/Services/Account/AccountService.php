<?php

namespace App\Services\Account;

use App\Exceptions\Account\InvalidUserCredentialsException;
use App\Models\Performer;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountService
{
    public function store(array $data): User
    {
        $user = User::create([
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'account_type' => Arr::get($data, 'accountType'),
            'company_name' => Arr::get($data, 'accountType') === 'ltd' ? Arr::get($data, 'companyName') : null,
            'password' => Hash::make(Arr::get($data, 'password.value')),
        ]);

        if ($user->account_type->value === 'freelancer' && is_string($user->account_type->value))
        {
            $user->performer()->create();
        }

        return $user;
    }

    /**
     * @throws InvalidUserCredentialsException
     */
    public function signIn(string $email, string $password): string
    {
        $user = User::query()->where('email', $email)->first();

        if (! empty($user)) {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                $user->tokens()->delete();

                return $user->createToken('api-token')->plainTextToken;
            }
        }

        throw new InvalidUserCredentialsException;
    }
}
