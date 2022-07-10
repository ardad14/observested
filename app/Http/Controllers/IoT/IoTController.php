<?php

namespace App\Http\Controllers\IoT;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCustomer;
use App\Jobs\ProductMakeOrder;
use App\Jobs\UserMakeOrder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class IoTController extends Controller
{
    public function userMakeOrder(Request $request): Response
    {
        $data = $request->only(['customerId', 'placeId', 'spendMoney']);
        $this->dispatch(new UserMakeOrder($data['customerId'], $data['placeId'], $data['spendMoney']));

        return response(true);
    }

    public function productOrder(Request $request): Response
    {
        $data = $request->only(['productId', 'placeId', 'amount']);
        $this->dispatch(new ProductMakeOrder($data['productId'], $data['placeId'], $data['amount']));

        return response(true);
    }

    public function createCustomer(Request $request): Response
    {
        $data = $request->only(['name', 'surname', 'age']);
        $this->dispatch(new CreateCustomer($data['name'], $data['surname'], $data['age']));

        return response(true);
    }
}
