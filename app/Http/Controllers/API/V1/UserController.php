<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\CreateRequest;
use App\Http\Requests\Users\UpdateRequest;
use App\Http\Resources\User\UserResource;
use App\Http\Resources\User\UsersCollection;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(private UserService $userService)
    {
    }

    public function index(): JsonResponse
    {
        return (new UsersCollection(
            $this->userService->index(request()->query('limit') ?? 20)
        ))->additional(
            [
                'status' => 'success',
                'message' => "List of users",
            ]
        )->response();
    }

    public function store(CreateRequest $request): JsonResponse
    {
        $user = $this->userService->create($request->convertToDto());

        if (is_null($user)) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while creating a user'
                ],
                400
            );
        }
        return (new UserResource($user))->additional(
            [
                'status' => 'success',
                'message' => 'User created successfully',
            ]
        )->response();
    }

    public function show(string $uniqueId): JsonResponse
    {
        $user = $this->userService->show($uniqueId);
        if (! $user) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => "Unable to fetch user"
                ],
                404
            );
        }
        return (new UserResource($user))->additional(
            [
                'status' => 'success',
                'message' => "User detail",
            ]
        )->response();
    }

    public function update(UpdateRequest $request, string $uniqueId): JsonResponse
    {
        $product = $this->userService->update($request->convertToDto(), $uniqueId);

        if (is_null($product)) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => "Error occurred while updating user"
                ],
                400
            );
        }
        return (new UserResource($product))->additional(
            [
                'status' => 'success',
                'message' => "User updated successfully",
            ]
        )->response();
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $response = $this->userService->destroy($uniqueId);

        if (!$response || $response === 0) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Unable to delete user'
                ],
                400
            );
        }
        return response()->json(
            [
                'status' => 'success',
                'message' => 'User deleted',
            ],
            200
        );
    }
}
