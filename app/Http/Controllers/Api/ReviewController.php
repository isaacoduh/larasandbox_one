<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ReviewResource;
use App\Order;
use App\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function show($id)
    {
        return new ReviewResource(Review::findOrFail($id));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id' => 'required|size:36|unique:reviews',
            'content' => 'required|min:2',
            'rating' => 'required|in:1,2,3,4,5'
        ]);

        $order = Order::findByReviewKey($data['id']);

        if(null == $order){
            return abort(404);
        }

        $order->review_key = '';
        $order->save();

        $review = Review::make($data);
        $review->order_id = $order->id;
        $review->orderable_id = $order->orderable_id;
        $review->save();

        return new ReviewResource($review);
    }

}
