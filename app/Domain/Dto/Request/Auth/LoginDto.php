<?php

namespace App\Domain\Dto\Request\Auth;

use App\Domain\Traits\Fillable;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Spatie\DataTransferObject\DataTransferObject;

class LoginDto extends DataTransferObject
{
    use Fillable;
    
    /**
     * First come the fields which cannot be nullable
     */
    public string $username;
    public string $password;

    public static function fromRequest(LoginRequest $request): LoginDto
    {
        return new self(
            [
                User::USERNAME => $request->username,
                User::PASSWORD => $request->password
            ]
        );
    }
}
