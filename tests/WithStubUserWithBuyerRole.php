<?php

namespace Tests;

use App\Domain\Enums\UserRoles\UserRoles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait WithStubUserWithBuyerRole
{
    protected User $user;
    protected ?string $token;

    public function createStubUserWithBuyerRole()
    {
        $user = User::create([
            'id' => '5e48fc85-6e08-4022-8ebf-faf152b63252',
            'username' => 'test_buyer',
            'password' => Hash::make('password'),
            'role' => UserRoles::BUYER,
            'deposit' => 40,
        ]);

        return $this->user = $user;
    }

    public function loginStubUserWithBuyerRole()
    {
        $this->createStubUserWithBuyerRole();
        $response = $this->postJson('api/v1/auth/login', [
            'username' => 'test_buyer',
            'password' => 'password',
        ]);
        $this->token = $response->getData()->access_token;
        return (object) [
            'token' => $this->token,
            'user' => $response->getData()->data
        ];
    }

    public function deleteStubUserWithBuyerRole()
    {
        $this->user->delete();
    }
}
