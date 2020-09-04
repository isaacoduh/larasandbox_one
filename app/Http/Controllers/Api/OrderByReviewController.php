<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderByReviewShowResource;
use App\Order;
use Illuminate\Http\Request;

class OrderByReviewController extends Controller
{
    public function __invoke($reviewKey, Request $request)
    {
        $order = Order::findByReviewKey($reviewKey);
        return $order ? new OrderByReviewShowResource($order) : abort(404);
    }
}
