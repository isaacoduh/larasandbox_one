<?php

namespace App\Http\Controllers;

use App\Area;
use App\State;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    public function states(Request $request)
    {
        $result = State::has('areas')->whereHas('shops');
        return response()->json($result);
    }

    public function areas(Request $request)
    {
        $state = $request['state'];
        $result = State::find($state)->areas()->whereHas('shops');
        return response()->json($result);
    }

    public function shops(Request $request)
    {
        $area = $request['area'];
        $result = Area::find($area)->shops();
        return response()->json($result);
    }
}
