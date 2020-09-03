<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderableIndexResource;
use App\Http\Resources\OrderableShowResource;
use Illuminate\Http\Request;
use App\Orderable;

class OrderableController extends Controller
{
    public function index()
    {
        return OrderableIndexResource::collection(
            Orderable::all()
        );
    }

    public function show($id)
    {
        return new OrderableShowResource(Orderable::findOrFail($id));
    }
}
