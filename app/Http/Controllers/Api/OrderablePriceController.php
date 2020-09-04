<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Orderable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderablePriceController extends Controller
{
    /**
     * Handle incoming request
     */
    public function __invoke($id, Request $request)
    {
        $orderable = Orderable::findOrFail($id);
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d',
            'to' => 'required|date_format:Y-m-d|after_or_equal:fro'
        ]);
        $days = (new Carbon($data['from']))->diffInDays(new Carbon($data['to'])) + 1;
        $price = $days * $orderable->price;

        return response()->json([
            'data' => [
                'total' => $price,
                'breakdown' => [
                    $orderable->price->$days
                ]
            ]
        ]);
    }
}
