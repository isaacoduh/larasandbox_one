<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Startup;
use App\Http\Resources\StartupResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StartupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startups = Startup::all();
        return response(['startups' => StartupResource::collection($startups), 'message' => 'Retrieved Successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'sector' => 'required|max:255',
            'founded' => 'required|max:255',
            'headquarters' => 'required|max:255',
            'bio' => 'required'
        ]);

        if($validator->fails()){
            return response(['error' => $validator->errors(), 'Validation Error']);
        }

        $startup = Startup::create($data);

        return response(['startup' => new StartupResource($startup), 'message' => 'Created Successfully'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function show(Startup $startup)
    {
        return response(['startup' => new StartupResource($startup), 'message' => 'Retrieved Successfully'],200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startup $startup)
    {
        $startup->update($request->all());
        return response(['startup' => new StartupResource($startup), 'message' => 'Retrived and Updated Successfully'],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startup $startup)
    {
        $startup->delete();

        return response(['message' => 'Deleted']);
    }
}
