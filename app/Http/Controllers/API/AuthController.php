<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use Illuminate\Http\JsonResponse;

class AuthController extends Controller
{
    /**
     * @var UserRepository
     */
    private UserRepository $userRepository;

    /**
     * AuthController constructor.
     * @param UserRepository $userRepository
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    /**
     * @param UserRequest $request
     * @return JsonResponse
     */
    public function register(UserRequest $request) : JsonResponse
    {
        $user = $this->userRepository->createUser($request);
        $accessToken = $user->createToken('authToken')->accessToken;

        return response()->json([ 'user' => $user, 'access_token' => $accessToken], 201);
    }
}
