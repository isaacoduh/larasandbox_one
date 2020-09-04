<?php

namespace App\Http\Controllers\Api;

use App\Address;
use App\Http\Controllers\Controller;
use App\Orderable;
use App\Order;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function __invoke(Request $request)
    {
        $data = $request->validate([
            'orders' => 'required|array|min:1',
            'orders.*.orderable_id' => 'required|exists:orderables,id',
            'orders.*.from' => 'required|date|after_or_equal:today',
            'orders.*.to' => 'required|date|after_or_equal:orders.*.from',
            'customer.first_names' => 'required|min:2',
            'customer.last_name' => 'required|min:2',
            'customer.street' => 'required|min:3',
            'customer.city' => 'required|min:2',
            'customer.email' => 'required|email',
            'customer.country' => 'required|min:2',
            'customer.state' => 'required|min:2',
            'customer.zip' => 'required|min:2'
        ]);
        $data = array_merge($data, $request->validate([
            'orders.*' => ['required', function($attribute, $value, $fail){
                $orderable = Orderable::findOrFail($value['orderable_id']);
                if(!$orderable->availableFor($value['from'], $value['to'])){
                    $fail("The Object is not available in given dates!");
                }
            }]
        ]));

        $ordersData = $data['orders'];
        $addressData = $data['customer'];

        $orders = collect($ordersData)->map(function($orderData) use ($addressData){
            $orderable = Orderable::findOrFail($orderData['orderable_id']);
            $order = new Order();
            $order->from = $orderData['from'];
            $order->to = $orderData['to'];

            $order->price = $orderable->priceFor($order->from, $order->to)['total'];
            $order->orderable()->associate($orderable);
            $order->address()->associate(Address::create($addressData));

            $order->save();

            return $order;
        });

        return $orders;
    }
}
