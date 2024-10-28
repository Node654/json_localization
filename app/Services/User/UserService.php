<?php

namespace App\Services\User;

use App\Http\Resources\Api\v1\User\UserSearchResource;
use App\Models\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class UserService
{
    public function index(string $name, ?int $limit): AnonymousResourceCollection
    {
        $users = User::query()->where('name', 'like', "%$name%")->limit($limit)->get();

        return UserSearchResource::collection($users);
    }
}
