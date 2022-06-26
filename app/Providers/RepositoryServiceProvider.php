<?php

namespace App\Providers;

use App\Repositories\Product\IProductRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\User\IUserRepository;
use App\Repositories\User\UserRepository;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
     /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::singleton(IUserRepository::class, UserRepository::class);
        App::singleton(IProductRepository::class, ProductRepository::class);
    }
}
