<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

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
                $data = Student::whereBetween('created_at', [$request->from_date, $request->to_date])->get();
            }
            else
            {
                $data = Student::orderBy('created_at', 'asc')->get();
            }

            echo json_encode($data);
            
        }
    }
}
