<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\DepositController;
use App\Http\Controllers\API\V1\ProductController;
use App\Http\Controllers\API\V1\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// API Routes
Route::group(
    ['middleware' => ['api'], 'prefix' => 'v1'],
    function () {
        /** Authentication Routes **/
        Route::prefix('auth')->group(function () {
            Route::post('/login', [AuthController::class, 'login']);
            Route::post('/logout', [AuthController::class, 'logout'])->middleware(['auth:sanctum']);
            Route::post('/logout/all', [AuthController::class, 'logoutAllSessions'])->middleware(['auth:sanctum']);
        });

        Route::prefix('users')->group(function () {
            Route::post('/', [UserController::class, 'store']);
        });
        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::prefix('users')->group(function () {
                Route::get('', [UserController::class, 'index']);
                Route::get('/{id}', [UserController::class, 'show']);
                Route::put('/{id}', [UserController::class, 'update']);
                Route::delete('/{id}', [UserController::class, 'destroy']);
            });

            //Products
            Route::group([
                'prefix' => 'products',
            ], function () {
                Route::get('/', [ProductController::class, 'index']);
                Route::get('/{id}', [ProductController::class, 'show']);
                Route::post('/', [ProductController::class, 'store'])->middleware(['is_seller']);
                Route::put('/{id}', [ProductController::class, 'update'])->middleware(['is_seller']);
                Route::delete('/{id}', [ProductController::class, 'destroy'])->middleware(['is_seller']);
            });

            Route::post('/deposit', [DepositController::class, 'store'])->middleware(['is_buyer']);
            Route::post('/reset', [DepositController::class, 'refreshDeposit
            '])->middleware(['is_buyer']);
        });
    }
);
