<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\Products\CreateRequest;
use App\Http\Requests\Products\UpdateRequest;
use App\Http\Resources\Product\ProductResource;
use App\Http\Resources\Product\ProductsCollection;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function __construct(private ProductService $productService)
    {
    }

    public function index(): JsonResponse
    {
        return (new ProductsCollection(
            $this->productService->index(request()->query('limit') ?? 20)
        ))->additional(
            [
                'status' => 'success',
                'message' => "List of products",
            ]
        )->response();
    }

    public function store(CreateRequest $request): JsonResponse
    {
        $product = $this->productService->create($request->convertToDto());

        if (is_null($product)) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while creating a product'
                ],
                400
            );
        }
        return (new ProductResource($product))->additional(
            [
                'status' => 'success',
                'message' => 'Product created successfully',
            ]
        )->response();
    }

    public function show(string $uniqueId): JsonResponse
    {
        $product = $this->productService->show($uniqueId);
        if (!$product) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => "Unable to fetch product"
                ],
                404
            );
        }
        return (new ProductResource($product))->additional(
            [
                'status' => 'success',
                'message' => "Product detail",
            ]
        )->response();
    }

    public function update(UpdateRequest $request, string $uniqueId): JsonResponse
    {
        $product = $this->productService->update($request->convertToDto(), $uniqueId);

        if (is_null($product)) {
            return response()->json(
                [
                    'status' => "error",
                    'message' => "Error occurred while updating product"
                ],
                400
            );
        }
        return (new ProductResource($product))->additional(
            [
                'status' => 'success',
                'message' => "Product updated successfully",
            ]
        )->response();
    }

    public function destroy(string $uniqueId): JsonResponse
    {
        $response = $this->productService->destroy($uniqueId);

        if (!$response) {
            return response()->json(
                [
                    'status' => 'error',
                    'message' => 'Error occurred while deleting product'
                ],
                400
            );
        }
        return response()->json(
            [
                'status' => 'success',
                'message' => 'Product deleted',
            ],
            200
        );
    }
}
