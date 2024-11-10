<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrdersRequest;
use App\Service\Orders\OrdersService;

class OrdersController extends Controller
{
    public function convert(OrdersRequest $request, OrdersService $orderService)
    {
        $inputData = $request->all();
        $orderService->validate($inputData);
        $inputData['price'] = $orderService->convert($inputData['currency'], $inputData['price']);
        $inputData['currency'] = 'TWD';

        return response()->json($inputData, 200);
    }
}
