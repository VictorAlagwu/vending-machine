<?php

namespace App\Domain\Dto\Request\Product;

use App\Domain\Traits\Fillable;
use App\Http\Requests\Products\PurchaseRequest;
use App\Models\Product;
use Spatie\DataTransferObject\DataTransferObject;

class PurchaseDto extends DataTransferObject
{
    use Fillable;
    /**
     * First come the fields which cannot be nullable
     */
    public string $product_id;
    public int $quantity;

    public static function fromRequest(PurchaseRequest $request): PurchaseDto
    {
        return new self(
            [
                'product_id' => $request->product_id,
                'quantity' => $request->quantity
            ]
        );
    }
}
