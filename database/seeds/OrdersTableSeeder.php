<?php

use App\Order;
use App\Orderable;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Orderable::all()->each(function(Orderable $orderable){
            $order = factory(Order::class)->make();
            $orders = collect([$order]);
            for($i = 0; $i < random_int(1,20); $i++){
                $from = (clone $order->to)->addDays(random_int(1,14));
                $to = (clone $from)->addDays(random_int(0,14));

                $order = Order::make([
                    'from' => $from,
                    'to' => $to
                ]);
                $orders->push($order);
            }
            $orderable->orders()->saveMany($orders);
        });
    }
}
