<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

use Alert;
use Carbon\Carbon;
use PdfMerger;

class StudentsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $students = Student::where('added_by', auth()->id())->orderBy('created_at')->paginate(10);
        return view('students.index', compact('students'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $startOfYear = Carbon::now()->startOfYear();
        $endOfYear = Carbon::now()->endOfYear();
        $students = Student::where('created_at', '>' , $startOfYear)->where('created_at', '<', $endOfYear)->get();
        
        $count = count($students) + 1;

        $student_id = Carbon::now()->toDateString() . '-' . $count;   
        return view('students.create', compact('student_id'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $request = request()->validate(
            [
                'student_no' => 'required',
                'first_name' => 'required|min:2|regex:/^[\pL\s\-]+$/u|max:255',
                'last_name' => 'required|min:2|regex:/^[\pL\s\-]+$/u|max:255',
                'middle_name' => 'min:2|regex:/^[\pL\s\-]+$/u|max:255',
                'gender' => 'required',
                'birthdate' => 'required',
                'address' => 'required',
                'contact' => 'required|regex:/^[0-9]+$/|min:11',
            ]
        );
        
        $request['added_by'] = auth()->id(); 

        Student::create($request);

        alert()->success('Student Added Successfully!');
        return redirect('/students');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function show(Student $student)
    {
        $dateOfBirth = $student->birthdate;
        $age = Carbon::parse($dateOfBirth)->age;
  
        return view('students.show', compact('student', 'age'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
          if(auth()->user()->id !== $student->added_by)
        {
            return redirect('/students')->with('error', 'Unauthorized Page');    
        }
        return view('students.edit', compact('student'));
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Student $student)
    {
        $student->update(request()->validate(
            [
            'first_name' => 'required|min:2|regex:/^[\pL\s\-]+$/u|max:255',
                'last_name' => 'required|min:2|regex:/^[\pL\s\-]+$/u|max:255',
                'middle_name' => 'min:2|regex:/^[\pL\s\-]+$/u|max:255',
                'gender' => 'required',
                'birthdate' => 'required',
                'address' => 'required',
                'contact' => 'required|regex:/^[0-9]+$/|min:11',
            ]));
        
        alert()->success('Student Updated Successfully!')->persistent('Close');
        return redirect('/students');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Student  $student
     * @return \Illuminate\Http\Response
     */
    public function destroy(Student $student)
    {
        $student->delete();

        alert()->info('Student Removed!');
        return redirect('/students');
    }
}
