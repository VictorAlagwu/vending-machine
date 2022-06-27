<?php

declare(strict_types=1);

namespace App\Services;

use App\Domain\Dto\Request\Product\PurchaseDto;
use App\Domain\Dto\Value\Purchase\PurchaseResponseDto;
use App\Models\Product;
use App\Models\User;
use App\Repositories\Product\IProductRepository;
use App\Repositories\User\IUserRepository;
use Illuminate\Support\Facades\DB;

final class PurchaseService
{
    public function __construct(
        private IUserRepository $userRepository,
        private IProductRepository $productRepository
    ){}

    public function purchase(PurchaseDto $dto)
    {
        DB::beginTransaction();
        try {
            $product = $this->productRepository->findOne([Product::ID => $dto->product_id]);
            $user = $this->userRepository->findOne([User::ID => auth()->user()->id]);

            if ($product->amount_available < $dto->quantity) {
                return new PurchaseResponseDto(false, "The available quantity of " . $product->name . " is not up to your required quantity", null);
            }

            $totalCost = $dto->quantity * $product->cost;
            if ($totalCost > $user->deposit) {
                return new PurchaseResponseDto(false, "The deposit available in your account is not sufficient from this transaction", null);
            }

            $this->userRepository
                ->where(
                    [User::ID => request()->user()->id],
                )->decrement(User::DEPOSIT, $totalCost);

            $this->productRepository
                ->where(
                    [Product::ID =>  $dto->product_id],
                )->decrement(PRODUCT::AMOUNT_AVAILABLE, $dto->quantity);
            $currentBalance = (int) $this->userRepository->findOne([User::ID => auth()->user()->id])->deposit;
   
            $payload = [
                'product' =>  $this->productRepository->findOne([Product::ID => $dto->product_id]),
                'total_cost' => $totalCost,
                'balance' => $this->getCoinsNeededForBalance($currentBalance),
            ];
            DB::commit();
            return new PurchaseResponseDto(true, "Purchase successfully completed", collect($payload));
        } catch (\Throwable $exception) {
            DB::rollback();
            return new PurchaseResponseDto(
                false,
                $exception->getMessage(),
                collect([])
            );
        }
    }

    private function getCoinsNeededForBalance(int $amount): array
    {
        $accceptedCoins = [5, 10, 20, 50, 100];
        $balanceInCoin = [];
        $balance = $amount;
        if ($amount < 5) {
            return [$amount];
        }
        $startPoint = count($accceptedCoins) - 1;
        while ($startPoint >= 0) {
            if ($balance >= $accceptedCoins[$startPoint]) {
                $balance -= $accceptedCoins[$startPoint];
                array_push($balanceInCoin, $accceptedCoins[$startPoint]);
            }

            if ($balance < $accceptedCoins[$startPoint]) {
                $startPoint--;
            }
        }
        return $balanceInCoin;
    }
}
