<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Customer;
use App\Models\Place;
use App\Services\CustomerService;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    public function customersForPlace(CustomerService $customerService): Response
    {
        return response($customerService->customersForPlace());
    }
}
