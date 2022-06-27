<?php

namespace App\Domain\Dto\Request\User;

use App\Domain\Traits\Fillable;
use App\Http\Requests\Users\DepositRequest;
use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class DepositDto extends DataTransferObject
{
    /**
     * First come the fields which cannot be nullable
     */
    public int $amount; 

    public static function fromRequest(DepositRequest $request): DepositDto
    {
        return new self(
            [
                'amount' => $request->amount,
            ]
        );
    }
}
