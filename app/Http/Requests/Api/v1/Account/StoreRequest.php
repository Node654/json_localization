<?php

namespace App\Http\Requests\Api\v1\Account;

use App\Enums\AccountType;
use App\Facades\Account;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Enum;

class StoreRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:50', 'unique:users,email'],
            'accountType' => ['required', 'string', new Enum(AccountType::class)],
            'companyName' => ['required_if:accountType,'.AccountType::LTD->value],
            'password' => ['required', 'required_array_keys:value,confirmation'],
            'password.value' => ['required', 'min:4', 'max:8'],
            'password.confirmation' => ['same:password.value'],
        ];
    }

    public function createAccount(): void
    {
        Account::store($this->validated());
    }
}
