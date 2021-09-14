<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;

class LoginController extends Controller
{
  public function login(Request $request)
	{
		// $creds = $request->only(['email', 'password']);

		// if (!$token = Auth::attempt($creds)) {
		// 	return response()->json(['error' => "Invalid email or password"], 401);
		// }

		// return response()->json(['token' => $token]);

		$validator = Validator::make($request->all(), [
			'email' => 'required|email',
			'password' => 'required|string|min:8'
		]);

		if($validator->fails()) {
			return response()->json($validator->errors(), 422);
		}

		if (! $token = auth('api')->attempt($validator->validated())) {
			return response()->json(['error' => 'Unauthorized'], 401);
		}

		return $this->createNewToken($token);
	}
}
