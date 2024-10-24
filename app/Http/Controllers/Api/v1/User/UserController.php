<?php

namespace App\Http\Controllers\Api\v1\User;

use App\Facades\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserController extends Controller
{
    public function index(Request $request): AnonymousResourceCollection
    {
        return User::index($request->get('name'), $request->get('offset'));
    }
}
