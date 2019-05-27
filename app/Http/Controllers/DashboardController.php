<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class DashboardController extends Controller
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
        $added_by = auth()->id();
        $all = Student::where('added_by', $added_by)->withTrashed()->count();
        $active = Student::where('added_by', $added_by)->count();
        $inactive = Student::where('added_by', $added_by)->onlyTrashed()->count();

        $chart_options = [
            'chart_title' => 'Student count per day',
            'report_type' => 'group_by_date',
            'model' => 'App\Student',
            'group_by_field' => 'created_at',
            'group_by_period' => 'day',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);

        $chart_options = [
            'chart_title' => 'Students by gender',
            'report_type' => 'group_by_string',
            'model' => 'App\Student',
            'group_by_field' => 'gender',
            'chart_type' => 'doughnut',
            'filter_field' => 'created_at',
            'filter_period' => 'month', // show users only registered this month
        ];
    
        $chart2 = new LaravelChart($chart_options);
        

        return view('dashboard', compact('all', 'active', 'inactive', 'chart1', 'chart2'));
    }
}
