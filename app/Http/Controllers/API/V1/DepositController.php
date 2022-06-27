<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Users\DepositRequest;
use App\Http\Resources\User\UserResource;
use App\Services\DepositService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct(protected DepositService $depositService) {}

    public function deposit(DepositRequest $request) {
        $user = $this->depositService->deposit($request->convertToDto());

        if (is_null($user)) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => "Error occurred while depositing coin into user's account"
                ],
                400
            );
        }
        return (new UserResource($user))->additional(
            [
                'status' => 'success',
                'message' => "Deposit added successfully",
            ]
        )->response();
    }
    
    public function reset() {
        $user = $this->depositService->reset();

        if (is_null($user)) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => "Error occurred while resetting user's deposit"
                ],
                400
            );
        }
        return (new UserResource($user))->additional(
            [
                'status' => 'success',
                'message' => "Deposit resetted successfully",
            ]
        )->response();
    }
}
