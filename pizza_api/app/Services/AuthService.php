<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
class AuthService
{
	public function register(array $data): User
	{
		$user = User::create([
			'name' => $data['name'],
			'email' => $data['email'],
			'password' => Hash::make($data['password']),
		]);

		return $user;
	}

	public function login(array $data): string | bool
	{
		$credentials = [
			'email' => $data['email'],
			'password' => $data['password'],
		];

		if (! $token = auth()->attempt($credentials)) {
			return false;
		}

		return $token;
	}

	public function logout(): void
	{
			auth()->logout();
	}

	public function user(): User | null
	{
		return auth()->user();
	}
}