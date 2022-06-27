<?php

namespace Tests\Feature\User;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Tests\WithStubUserWithSellerRole;

class SellerTest extends TestCase
{
    use DatabaseMigrations;
    use WithStubUserWithSellerRole;
    // use WithStubUserWithBuyerRole;

    public function test_user_with_seller_role_can_create_product()
    {
        $this->loginStubUserWithSellerRole();
        $token = $this->token;

        $initialize = $this->withHeaders([
            'Authorization' => 'Bearer ' . $token,
        ])->json('POST', 'api/v1/products', [
            "name" => "TestProduct",
            "amount_available" => 2,
            "cost" => 10
        ]);
       
        $initialize->assertSuccessful();
        $this->deleteStubUserWithSellerRole();
    }
}
