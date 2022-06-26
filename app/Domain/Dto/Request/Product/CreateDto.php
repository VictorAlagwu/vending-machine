<?php

namespace App\Domain\Dto\Request\Product;

use App\Http\Requests\Products\CreateRequest;
use App\Models\Product;
use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject
{
    /**
     * First come the fields which cannot be nullable
     */
    public string $name;
    public int $amount_available; 
    public int $cost; 
    public string $seller_id; 

    public static function fromRequest(CreateRequest $request): CreateDto
    {
        return new self(
            [
                Product::NAME => $request->name,
                Product::AMOUNT_AVAILABLE => $request->amount_available,
                Product::COST => $request->cost,
                Product::SELLER_ID => auth()->user()->id,
            ]
        );
    }
}
