<?php

namespace App\Services\Account;

use App\Exceptions\Account\InvalidUserCredentialsException;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountService
{
    public function store(array $data): User
    {
        return User::create([
            'name' => Arr::get($data, 'name'),
            'email' => Arr::get($data, 'email'),
            'account_type' => Arr::get($data, 'accountType'),
            'company_name' => $data['companyName'],
            'password' => Hash::make(Arr::get($data, 'password.value')),
        ]);
    }

    /**
     * @throws InvalidUserCredentialsException
     */
    public function signIn(string $email, string $password): string
    {
        $user = User::query()->where('email', $email)->first();

        if (! empty($user))
        {
            if (Auth::attempt(['email' => $email, 'password' => $password])) {
                return $user->createToken('api-token')->plainTextToken;
            }
        }

        throw new InvalidUserCredentialsException();
    }
}
