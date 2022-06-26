<?php

namespace App\Domain\Dto\Request\Auth;

use App\Http\Requests\Auth\RegisterRequest;
use Spatie\DataTransferObject\DataTransferObject;

class RegisterDto extends DataTransferObject
{
    /**
     * First come the fields which cannot be nullable
     */
    public string $username;
    public string $password; 

    public static function fromRequest(RegisterRequest $request): RegisterDto
    {
        return new self(
            [
                'name' => $request->name,
                'password' => $request->password
            ]
        );
    }
}
