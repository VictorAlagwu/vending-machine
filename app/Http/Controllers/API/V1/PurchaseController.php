<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\PurchaseRequest;
use App\Services\PurchaseService;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
    public function __construct(protected PurchaseService $purchaseService)
    {
    }

    public function buyProduct(PurchaseRequest $request)
    {
        $response = $this->purchaseService->purchase($request->convertToDto());
        if (!$response->status) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => $response->message
                ],
                400
            );
        }

        return response()->json(
            [
                'status' => 'success',
                'message' =>  $response->message,
                'data' => $response->data
            ],
            200
        );
    }
}
