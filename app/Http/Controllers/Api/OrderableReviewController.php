<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderableReviewIndexResource;
use App\Orderable;
use Illuminate\Http\Request;

class OrderableReviewController extends Controller
{
    public function __invoke($id, Request $request)
    {
        $orderable = Orderable::findOrFail($id);
        return OrderableReviewIndexResource::collection($orderable->reviews()->latest()->get());
    }
}
