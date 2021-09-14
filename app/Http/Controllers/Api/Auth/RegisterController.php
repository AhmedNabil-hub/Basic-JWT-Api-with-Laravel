<?php

namespace App\Http\Controllers\Api\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Api\Controller;
use Illuminate\Support\Facades\Validator;


class RegisterController extends Controller
{
  public function register(Request $request)
	{
		$validator = Validator::make($request->all(), [
			'name' => 'required|string',
			'email' => 'required|email|unique:users,email',
			'password' => 'required|string|min:8|confirmed',
			'password_confirmation' => 'required'
		]);

		if($validator->fails()) {
			return response()->json($validator->errors(), 400);
		}

		$user = User::create(array_merge(
			$validator->validated(),
			['password' => Hash::make($request->password)]
		));

		return response()->json([
			'message' => 'User successfully registered',
			'user' => User::find($user->id)
		], 201);
	}
}
