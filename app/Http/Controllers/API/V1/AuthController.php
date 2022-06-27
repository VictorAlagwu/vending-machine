<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\LogoutAllSessionsRequest;
use App\Http\Resources\User\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function __construct(
        protected UserService $userService
    ) {
    }

    public function login(LoginRequest $request): JsonResponse
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }
        $hasExistingSessions = $user->tokens()->get()->where(function($query) {
            if($query->created_at->diffInMinutes(now()) < config('sanctum.expiration')) {
                return $query;
            };
        })->count();
        if ($hasExistingSessions > 0) {
            return response()->json([
                'status' => 'error',
                'message' => 'There is already an active session using your account'
            ], 400);
        }
        $token = $user->createToken('authToken')->plainTextToken;

        return (new UserResource($user))->additional([
            'status' => 'success',
            'access_token' => $token,
            'token_type' => 'bearer',
            'message' => 'User logged in',
        ])->response();
    }

    public function logout(): JsonResponse
    {
        request()->user()->currentAccessToken()->delete();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User successfully signed out',
            ]
        );
    }

    public function logoutAllSessions(LogoutAllSessionsRequest $request): JsonResponse
    {
        $user = User::where('username', $request->username)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user->tokens()->delete();

        return response()->json(
            [
                'status' => 'success',
                'message' => 'User successfully logged out all sessions',
            ]
        );
    }
}
