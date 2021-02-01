<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Repositories\UserRepository;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\BadResponseException;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Psr\Http\Message\StreamInterface;

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

    /**
     * @param Request $request
     * @return JsonResponse|StreamInterface
     * @throws GuzzleException
     */
    public function login(Request $request)
    {
        $client = new Client();
        try {
            $response = $client->post(config('services.passport.login_endpoint'), [
                'form_params' => [
                    'grant_type' => 'password',
                    'client_id' => config('services.passport.client_id'),
                    'client_secret' => config('services.passport.client_secret'),
                    'username' => $request->email,
                    'password' => $request->password,
                    'scope' => '*',
                ],
            ]);

            return $response->getBody();

        } catch (BadResponseException $exception) {
            if ($exception->getCode() === 400) {
                return response()
                    ->json('Invalid Request. Please enter a username or a password', $exception->getCode());
            } elseif ($exception->getCode() === 401) {
                return response()
                    ->json('Your credentials are incorrect. Please try again', $exception->getCode());
            }

            return response()
                ->json('Server error', $exception->getCode());
        }
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        auth()->user()->tokens->each(function ($token, $key){
            $token->delete();
        });

        return response()->json('Logged out successfully', 200);
    }
}
