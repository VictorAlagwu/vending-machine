<?php

namespace Tests\Feature\User;

use App\Domain\Enums\UserRoles\UserRoles;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;
use Tests\WithStubUserWithBuyerRole;

class BuyerTest extends TestCase
{
    use DatabaseMigrations;
    use WithStubUserWithBuyerRole;

    public function test_user_with_buyer_role_can_be_deposit_coin()
    {
        $this->loginStubUserWithBuyerRole();
        $token = $this->token;

        $initialize = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/v1/deposit', [
            'amount' => 20
        ]);
        $initialize->assertSuccessful();
        $this->deleteStubUserWithBuyerRole();
    }

    public function test_user_without_buyer_role_cannot_deposit_coin()
    {
        $this->loginStubUserWithBuyerRole();
        $token = $this->token;

        $initialize = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/v1/deposit', [
            'amount' => 20
        ]);
        $initialize->assertSuccessful();
        $this->deleteStubUserWithBuyerRole();
    }

    public function test_buyer_can_buy_product_with_sufficient_fund()
    {
        $seller = User::create([
            'id' => '5e48fc85-6e08-4022-8ebf-faf152b63252',
            'username' => 'test_seller',
            'password' => Hash::make('password'),
            'role' => UserRoles::SELLER,
        ]);

        $product = Product::create([
            'id' => 'aed8fc85-6e08-4022-8ebf-saf152b63252',
            'name' => 'TestProduct',
            'amount_available' => 2,
            'cost' => 30,
            'seller_id' => $seller->id,
        ]);

        $this->loginStubUserWithBuyerRole();
        $token = $this->token;
        $initialize = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/v1/buy', [
            'product_id' => $product->id,
            'quantity' => 1
        ]);
        $initialize->assertSuccessful();
        $this->deleteStubUserWithBuyerRole();
    }

    public function test_buyer_cannot_buy_product_with_insufficient_fund()
    {
        $seller = User::create([
            'id' => '5e48fc85-6e08-4022-8ebf-faf152b63252',
            'username' => 'test_seller',
            'password' => Hash::make('password'),
            'role' => UserRoles::SELLER,
        ]);

        $product = Product::create([
            'id' => 'aed8fc85-6e08-4022-8ebf-saf152b63252',
            'name' => 'TestProduct',
            'amount_available' => 2,
            'cost' => 30,
            'seller_id' => $seller->id,
        ]);

        $this->loginStubUserWithBuyerRole();
        $token = $this->token;



        $initialize = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/v1/buy', [
            'product_id' => $product->id,
            'quantity' => 2
        ]);
        $initialize->assertStatus(400)
            ->assertJsonPath('message', 'The deposit available in your account is not sufficient from this transaction');;
        $this->deleteStubUserWithBuyerRole();
    }

     public function test_user_without_buyer_role_cannot_create_product()
    {
        $this->loginStubUserWithBuyerRole();
        $token = $this->token;

        $initialize = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/v1/products', [
            "name" => "TestProductTwo",
            "amount_available" => 2,
            "cost" => 10
        ]);
        $initialize->assertStatus(403);
        $this->deleteStubUserWithBuyerRole();
    }
}
