<?php

namespace App\Http\Controllers\Api;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
  use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

	public function __construct()
	{
		$this->middleware(
			'auth:api',
			['except' => ['login', 'register']]
		);
	}

	public function logout()
	{
		Auth::logout();

		return response()->json(['message' => 'User logged out']);
	}

	public function refresh()
	{
		return $this->createNewToken(Auth::refresh());
	}

	public function userProfile()
	{
		return response()->json(auth()->user());
	}

	protected function createNewToken($token)
	{
		return response()->json([
			'access_token' => $token,
			'token_type' => 'bearer',
			'expires_in' =>  auth('api')->factory()->getTTL() * 60,
			'user' => auth('api')->user()
		]);
	}
}
