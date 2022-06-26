<?php

namespace App\Domain\Dto\Request\User;

use App\Domain\Enums\UserRoles\UserRoles;
use App\Http\Requests\Users\CreateRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\DataTransferObject\DataTransferObject;

class CreateDto extends DataTransferObject
{
    /**
     * First come the fields which cannot be nullable
     */
    public string $username;
    public string $password; 
    public ?int $deposit; 
    public ?string $role; 

    public static function fromRequest(CreateRequest $request): CreateDto
    {
        return new self(
            [
                User::USERNAME => $request->username,
                User::PASSWORD => Hash::make($request->password),
                User::DEPOSIT => $request->role === UserRoles::SELLER ? 0 : $request->deposit,
                User::ROLE => $request->role ?? UserRoles::BUYER
            ]
        );
    }
}
