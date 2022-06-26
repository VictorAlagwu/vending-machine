<?php

use App\Domain\Enums\UserRoles\UserRoles;
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
        Schema::create('users', function (Blueprint $table) {
            $table->uuid(User::ID)->primary();
            $table->string(User::USERNAME);
            $table->string(User::PASSWORD);
            $table->integer(User::DEPOSIT)->default(0);
            $table->string(User::ROLE)->default(UserRoles::BUYER);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
