<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;
use App\Http\Requests\UserLoginRequest;

class AuthController extends Controller
{
    public function __construct(private AuthService $service)
    {
        
    }

    /**
     * Register user
     * 
     * @param \App\Http\Requests\UserRegisterRequest $request
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(UserRegisterRequest $request)
    {
        $user = $this->service->register($request->validated());
        
        return response()->json($user, 201);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(UserLoginRequest $request)
    {
        $token = $this->service->login($request->validated());
        
        if (! $token) {
            return response()->json(['message' => 'Invalid email or password. Please try again.'], 401);
        }

        return response()
            ->json([ 'message' => 'Success'])
            ->cookie('access_token', $token, 30, null, null, false, true);
    }   
}
