<?php

namespace App\Http\Controllers;

use App\Student;
use App\Exports\StudentsExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;

use Alert;
use Carbon\Carbon;
use PDF;
use PdfReport;
use DB;
use Exception;

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

        $students = Student::where('added_by', auth()->id())->orderBy('id', 'asc')->paginate(10);
        $inactive = Student::where('added_by', auth()->id())->onlyTrashed()->orderBy('id', 'asc')->paginate(10);
        return view('students.index', compact('students','inactive'));
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
        $students = Student::where('created_at', '>' , $startOfYear)->where('created_at', '<', $endOfYear)->withTrashed()->get();

        if(Student::count() != 0)
        {
            $latest = Student::latest()->first()->id;   
        }
        else
        {
            $latest = Student::latest()->first();
        }
        
        $count = count($students) + 1001;

        $latest = $latest + 1;

        $date = Carbon::now();

        $first = Carbon::parse($date)->format('Y-m');

        $student_id = $first . '-' . $count . '-' . $latest; 

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
                'student_no' => 'required|unique:students',
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

        if(auth()->user()->id !== $student->added_by)
        {
            alert()->error('Unauthorized Page');
            return redirect('/students');    
        }
  
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
            alert()->error('Unauthorized Page');
            return redirect('/students');    
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
                'contact' => 'required|regex:/^[0-9]+$/|min:11|max:11',
            ]));
        
        alert()->success('Student Updated Successfully!');
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
        if(auth()->user()->id !== $student->added_by)
        {
            alert()->error('Unauthorized Page');
            return redirect('/students');    
        }

        $student->delete();

        alert()->info('Student Removed!');
        return redirect('/students');
    }

    //This will generate pdf file using barryvdh-laravel-dompdf
    public function print()
    {
      $added_by = auth()->id();
        $studentList = Student::where('added_by', $added_by)->get();
        

       // This  $data array will be passed to our PDF blade
       $data = [
          'title' => 'Student List',
          'heading' => 'List of All students',
          'content' => $studentList        
            ];
        
        $pdf = PDF::loadView('pdf_view', $data);  
        return $pdf->download('student_list.pdf');

    }


    // This will export data from database to excel using maatwebsite/excel
    public function export() 
    {
        return Excel::download(new StudentsExport, 'student_list.xlsx');
    }

    //This will create a word document
    public function generateDocx()
    {
        $added_by = auth()->id();
        $studentList = Student::where('added_by', $added_by)->get();

        $headers = array(
            "Content-type"=>"application/xml",
            "Content-Disposition"=>"attachment;Filename=student_list.doc"
        );
        
        $content = '<html>';
        $content .= '<head><meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <style>
        body 
        {
            text-align: center;
        }

        table {
          border-collapse: collapse;
          width: 100%;
        }
        
        table, th, td {
          border: 1px solid black;
        }
        
        th, td {
          text-align: center;
          padding: 5px;
          white-space: nowrap;
        }
        
        tr:nth-child(even) {background-color: #f2f2f2;}
        </style></head>
        <body>
            <h1>Student List</h1>
            <div style="overflow-x:auto;">
            <table>
                <tr>
                    <th>Student No.</th>
                    <th>Full Name</th>
                    <th>Gender</th>
                    <th>Birthday</th>
                    <th>Address</th>
                    <th>Contact No.</th>
                </tr>
                ';

        foreach ($studentList as $sl)
        {
            $content .= '<tr>';
            $content .= '<td>'. $sl->student_no .'</td>';
            $content .= '<td>'. $sl->first_name . " ". $sl->middle_name[0] . ". ". $sl->last_name .'</td>';
            $content .= '<td>'. $sl->gender.'</td>';
            $content .= '<td>'. ($sl->birthdate)->format('F d, Y').'</td>';
            $content .= '<td>'. $sl->address.'</td>';
            $content .= '<td>'. $sl->contact.'</td>';
            $content .= '</tr>';
        }
        $content .= '
            </table>
            </div>
        </body>
        </html>';
    
    return \Response::make($content,200, $headers);
    }  
    
    public function reactivate($id)
    {
        $added_by = auth()->id();

        if(auth()->user()->id !== $added_by)
        {
            alert()->error('Unauthorized Page');
            return redirect('/students');    
        }
        

        $student= Student::where('added_by', $added_by)->withTrashed()->findOrFail($id)->restore();   

        alert()->success('Student Reactivated!');
        return redirect('/students');
    }

    public function permanentDelete($id)
    {
        $added_by = auth()->id();

        $student = Student::where('added_by', $added_by)->withTrashed()->findOrFail($id)->forceDelete();

        alert()->warning('Student Permanently Removed!');

        return redirect('/students');
    }
}