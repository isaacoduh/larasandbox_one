<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Orderable;
use Illuminate\Http\Request;


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


        return response()->json([
            'data' => $orderable->priceFor($data['from'], $data['to'])
        ]);
    }
}
