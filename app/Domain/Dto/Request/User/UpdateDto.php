<?php

namespace App\Domain\Dto\Request\User;

use App\Domain\Traits\Fillable;
use App\Http\Requests\Users\UpdateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class UpdateDto extends DataTransferObject
{
    use Fillable;
    /**
     * First come the fields which cannot be nullable
     */
    public ?string $username;
    public ?string $password; 
    public ?int $deposit; 

    public static function fromRequest(UpdateRequest $request): UpdateDto
    {
        return new self(
            [
                User::USERNAME => $request->username,
                User::PASSWORD => Hash::make($request->password),
                User::DEPOSIT => $request->deposit,
            ]
        );
    }
}
