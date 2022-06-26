<?php

namespace Database\Seeders;

use App\Domain\Enums\UserRoles\UserRoles;
use App\Models\User;
use App\Repositories\User\IUserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function __construct(protected IUserRepository $userRepository)
    {
    }
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $password = Hash::make('secret');

        $seller = [
            User::USERNAME => 'demo_seller',
            User::PASSWORD => $password,
            User::ROLE => UserRoles::SELLER,
        ];
        $this->userRepository->create($seller);

        $sellerTwo = [
            User::USERNAME => 'demo_seller_two',
            User::PASSWORD => $password,
            User::ROLE => UserRoles::SELLER,
        ];
        $this->userRepository->create($sellerTwo);


        $buyer = [
            User::USERNAME => 'demo_buyer',
            User::PASSWORD => $password,
            User::ROLE => UserRoles::BUYER,
            User::DEPOSIT => 100
        ];
        $this->userRepository->create($buyer);

        $buyerTwo = [
            User::USERNAME => 'demo_buyer_two',
            User::PASSWORD => $password,
            User::ROLE => UserRoles::BUYER,
            User::DEPOSIT => 50
        ];
        $this->userRepository->create($buyerTwo);
    }
}
