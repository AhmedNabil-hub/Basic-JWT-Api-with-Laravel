<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;

class JWTMiddleware
{
	public function handle(Request $request, Closure $next)
	{
		try {
			$user = JWTAuth::parseToken()->authenticate();
		} catch (\Exception $e) {
			if ($e instanceof TokenInvalidException) {
				return response()->json([
					'error' => 'Token is Invalid'
				]);
			} elseif ($e instanceof TokenExpiredException) {
				return response()->json([
					'error' => 'Token is Expired'
				]);
			} else {
				return response()->json([
					'error' => 'Authorization Token is not found'
				]);
			}
		}

		return $next($request);
	}
}
