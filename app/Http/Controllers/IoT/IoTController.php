<?php

namespace App\Http\Controllers\IoT;

use App\Http\Controllers\Controller;
use App\Jobs\CreateCustomer;
use App\Jobs\ProductMakeOrder;
use App\Jobs\UserMakeOrder;
use Illuminate\Http\Request;

class IoTController extends Controller
{
    public function userMakeOrder(Request $request)
    {
        $data = $request->only(['customerId', 'placeId', 'spendMoney']);
        $this->dispatch(new UserMakeOrder($data['customerId'], $data['placeId'], $data['spendMoney']));

        response(true);
    }

    public function productOrder(Request $request)
    {
        $data = $request->only(['productId', 'placeId', 'amount']);
        $this->dispatch(new ProductMakeOrder($data['productId'], $data['placeId'], $data['amount']));

        response(true);
    }

    public function createCustomer(Request $request)
    {
        $data = $request->only(['name', 'surname', 'age']);
        $this->dispatch(new CreateCustomer($data['name'], $data['surname'], $data['age']));

        response(true);
    }
}
