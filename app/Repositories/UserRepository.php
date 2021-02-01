<?php


namespace App\Repositories;


use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Str;

class UserRepository
{
    /**
     * @param UserRequest $request
     * @return mixed
     */
    public function createUser(UserRequest $request)
    {
        return User::create($request->validated() + ['id' => Str::uuid()->toString()]);
    }
}
