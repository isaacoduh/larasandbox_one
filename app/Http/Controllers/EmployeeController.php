<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Employee;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('employees.index');
    }

    public function getEmployees(Request $request)
    {
        ### Read Value
        $draw = $request->get('draw');
        $start = $request->get('start');
        $rowPerPage = $request->get('length');

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column'];
        $columnName = $columnName_arr[$columnIndex]['data'];
        $columnSortOrder = $order_arr[0]['dir'];
        $searchValue = $search_arr['value'];

        $totalRecords = Employee::select('count(*) as totalcount')->count();
        $totalRecordswithFilter = Employee::select('count(*) as totalcount')->where('name','like', '%' .$searchValue . '%')->count();

        // Fetch Records
        $records = Employee::orderBy($columnName, $columnSortOrder)
            ->where('employees.name', 'like', '%' .$searchValue . '%')
            ->select('employees.*')
            ->skip($start)
            ->take($rowPerPage)
            ->get();
        $data_arr = array();
        $serialnos = $start+1;
        foreach($records as $record)
        {
            $id = $record->id;
            $username = $record->username;
            $name = $record->name;
            $email = $record->email;
            $data_arr[] = array("id" => $id, "username" => $username, "name" => $name, "email" => $email);
        }

        $response = array("draw" => intval($draw), 'totalRecords' => $totalRecords,  'totalRecordsFilter' => $totalRecordswithFilter, 'data' => $data_arr);
        // return response()->json($response);
        echo json_encode($response);
        exit;
    }

    public function changeStatus(Request $request)
    {
        $employee = Employee::find($request->user_id);
        $employee->status = $request->status;
        $employee->save();

        return response()->json(['success' => 'Status change successful']);
    }
}
