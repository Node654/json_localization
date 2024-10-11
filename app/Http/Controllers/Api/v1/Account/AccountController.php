<?php

namespace App\Http\Controllers\Api\v1\Account;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Account\SignInRequest;
use App\Http\Requests\Api\v1\Account\StoreRequest;
use App\Http\Resources\Api\v1\Account\UserResource;
use Illuminate\Http\JsonResponse;

class AccountController extends Controller
{
    public function store(StoreRequest $request)
    {
        $request->createAccount();

        return responseOk();
    }

    public function signIn(SignInRequest $request): JsonResponse
    {
        return response()->json([
            'token' => $request->signIn(),
        ]);
    }

    public function show()
    {
        return new UserResource(auth()->user());
    }
}
