<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Dto\Request\Product\CreateDto;
use App\Domain\Dto\Request\Product\UpdateDto;
use App\Models\Product;
use App\Repositories\Product\IProductRepository;
use Illuminate\Database\Eloquent\Collection;

final class ProductService
{
    public function __construct(
        private IProductRepository $productRepository
    ) {
    }

    public function index(): Collection
    {
        return $this->productRepository->get();
    }

    public function create(CreateDto $dto): ?Product
    {
        return $this->productRepository->create($dto->toArray());
    }

    public function show(string $uniqueId): ?Product
    {
        return $this->productRepository
            ->findOne([Product::ID => $uniqueId]);
    }

    public function update(UpdateDto $dto, string $uniqueId): ?Product
    {
        $product = $this->productRepository->findOne([
            Product::ID => $uniqueId,
            Product::SELLER_ID => request()->user()->id,
        ]);

        if (!$product) {
            return null;
        }

        $this->productRepository
            ->update(
                $dto->filled(),
                $product->id
            );

        return $this->productRepository->findOne([Product::ID => $uniqueId]);
    }

    public function destroy(string $uniqueId): int
    {
        $product = $this->productRepository->findOne([
            Product::ID => $uniqueId,
            Product::SELLER_ID => request()->user()->id,
        ]); 

        if (!$product) {
            return 0;
        }
        return $this->productRepository
            ->deleteWhere([Product::ID => $uniqueId]);
    }
}
