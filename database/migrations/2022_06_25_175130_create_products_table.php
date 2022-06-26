<?php

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid(Product::ID)->primary();
            $table->string(Product::NAME);
            $table->integer(Product::AMOUNT_AVAILABLE);
            $table->integer(Product::COST);
            $table->uuid(Product::SELLER_ID)->index();
            $table->timestamps();

            $table->foreign(Product::SELLER_ID)
                ->references(User::ID)
                ->on(User::getTableName());
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(Product::getTableName());
    }
};
