<?php

namespace App\Http\Controllers;

use App\State;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function areas(Request $request)
    {
        $page = $request['page'];
        $offset = $request['offset'];
        $search = $request['search'];
        $state = $request['state'];
        $areas = State::find($state)->areas()->take(10)->skip($offset)->get();
        $data = [];
        foreach($areas as $area){
            $data[] = array("id" => $area->id, "text" => $area->name);
        }
        $result["results"] = $data;
        $result["pagination"] = array("more" => $areas->count() >= 20);
        return response()->json($result);
    }

    public function states(Request $request)
    {
        $page = $request['page'];
        $offset = $request['offset'];
        $search = $request['search'];
        $states = State::take(10)->skip($offset)->get();
        $data = [];
        foreach($states as $state){
            $data[] = array("id" => $state->id, "text" => $state->name);
        }
        $result["results"] = $data;
        $result["pagination"] = array("more" => $states->count() >= 10);
        return response()->json($result);
    }
}
