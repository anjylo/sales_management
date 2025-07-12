<?php

namespace App\Http\Controllers;

use App\Services\AuthService;

use Illuminate\Http\Request;
use App\Http\Requests\UserRegisterRequest;

use App\Models\User;

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
}
