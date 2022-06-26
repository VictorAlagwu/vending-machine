<?php

namespace App\Domain\Dto\Request\Product;

use App\Domain\Traits\Fillable;
use App\Http\Requests\Products\UpdateRequest;
use App\Models\Product;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateDto extends DataTransferObject
{
    use Fillable;
    /**
     * First come the fields which cannot be nullable
     */
    public ?string $name;
    public ?int $amount_available; 
    public ?int $cost; 

    public static function fromRequest(UpdateRequest $request): UpdateDto
    {
        return new self(
            [
                Product::NAME => $request->name,
                Product::AMOUNT_AVAILABLE => $request->amount_available,
                Product::COST => $request->cost
            ]
        );
    }
}
