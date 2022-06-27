<?php

namespace Tests;

use App\Domain\Enums\UserRoles\UserRoles;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

trait WithStubUserWithSellerRole
{
    protected User $user;
    protected ?string $token;

    public function createStubUserWithSellerRole()
    {
        $user = User::create([
            'id' => '5e48fc85-6e08-4022-8ebf-faf152b63252',
            'username' => 'test_seller',
            'password' => Hash::make('password'),
            'role' => UserRoles::SELLER
        ]);

        return $this->user = $user;
    }

    public function loginStubUserWithSellerRole()
    {
        $this->createStubUserWithSellerRole();
        $response = $this->postJson('api/v1/auth/login', [
            'username' => 'test_seller',
            'password' => 'password',
        ]);
        $this->token = $response->getData()->access_token;
        return (object) [
            'token' => $this->token,
            'user' => $response->getData()->data
        ];
    }

    public function deleteStubUserWithSellerRole()
    {
        $this->user->products->each->delete();
        $this->user->delete();
    }
}
