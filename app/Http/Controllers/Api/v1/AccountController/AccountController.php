<?php

namespace App\Http\Controllers\Api\v1\AccountController;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\v1\Account\StoreRequest;

class AccountController extends Controller
{
    public function store(StoreRequest $request)
    {
        $request->createAccount();
        return redirectOk();
    }
}
