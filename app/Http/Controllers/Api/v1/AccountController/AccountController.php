<?php

namespace App\Http\Controllers\Api\v1\AccountController;

use App\Facades\Account;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Account\SignInRequest;
use App\Http\Requests\Api\v1\Account\StoreRequest;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function store(StoreRequest $request)
    {
        $request->createAccount();
        return redirectOk();
    }

    public function signIn(SignInRequest $request): JsonResponse
    {
        return response()->json([
            'token' => $request->signIn()
        ]);
    }
}
