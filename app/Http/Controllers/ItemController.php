<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Yajra\DataTables\Datatables;
use App\Item;


class ItemController extends Controller
{
    public function index(Request $request)
    {
        if($request->ajax()){
            $data = Item::latest()->get();
            return Datatables::of($data)->addIndexColumn()->addColumn('action', function($row){
                $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Edit" class="edit btn btn-primary btn-sm editItem">Edit</a>';

                $btn = $btn . ' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="' . $row->id . '" data-original-title="Delete" class="btn btn-danger btn-sm deleteItem">Delete</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
        }

        return view('items', compact('items'));
    }

    public function store(Request $request)
    {
        Item::updateOrCreate(
            ['id' => $request->Item_id],
            ['name' => $request->name, 'description' => $request->description]
        );

        return response()->json(['success' => 'Item saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Item::find($id)->delete();

        return response()->json(['success' => 'Item deleted successfully.']);
    }
}
