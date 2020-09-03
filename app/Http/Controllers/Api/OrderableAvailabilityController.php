<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Orderable;
use Illuminate\Http\Request;

class OrderableAvailabilityController extends Controller
{
    public function __invoke($id, Request $request)
    {
        $data = $request->validate([
            'from' => 'required|date_format:Y-m-d|after_or_equal:now',
            'to' => 'required|date_format:Y-m-d|after_or_equal:from'
        ]);
        $orderable = Orderable::findOrFail($id);

        return $orderable->availableFor($data['from'], $data['to']) ? response()->json([]) : response()->json([],404);
    }
}
