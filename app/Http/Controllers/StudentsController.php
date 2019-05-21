<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;
use Alert;

class StudentsController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
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
        return view('students.create');

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
                'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
                'middle_name' => 'min:2',
                'gender' => 'required',
                'birthdate' => 'required',
                'address' => 'required',
                'contact' => 'required',
            ]
        );
        
        $request['added_by'] = auth()->id(); 

        Student::create($request);

        alert()->success('Added');
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
        return view('students.show', compact('student'));
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
            'first_name' => 'required|min:2',
                'last_name' => 'required|min:2',
                'middle_name' => 'min:2',
                'gender' => 'required',
                'birthdate' => 'required',
                'address' => 'required',
                'contact' => 'required',
            ]));
        
        alert()->success('Edited!');
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

        return redirect('/students')->with('Student Removed!');
    }
}
