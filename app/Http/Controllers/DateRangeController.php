<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class DateRangeController extends Controller
{
    public function index()
    {
        return view('date_range');
    }

    public function fetch_data(Request $request)
    {
        if($request->ajax())
        {
            if($request->from_date !='' && $request->to_date !='')
            {
                $data = DB::table('students')
                    ->whereBetween('created_at', array([$request->from_date, $request->to_date]))
                    ->get();
            }
            else
            {
                $data = DB::table('students')->orderBy('created_at', 'asc')->get();
            }

            echo json_encode($data);
            
        }
    }
}
