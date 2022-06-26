<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Services\DepositService;
use Illuminate\Http\Request;

class DepositController extends Controller
{
    public function __construct(protected DepositService $depositService) {}

    public function deposit() {
        
    }
    public function reset() {}
}
