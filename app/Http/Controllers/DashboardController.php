<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Student;

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

        return view('dashboard', compact('all', 'active', 'inactive'));
    }
}
