@extends('layouts.app')

@section('title')
    {{$student->first_name}}'s Information
@endsection
@section('content')

<div class="container-flui p-5">
    <div class="card rounded-0">
    <div class="card-header pb-1">
        <h4>Student Information <a href="/students" class="btn btn-primary btn-sm float-right">Go back</a></h4>
    </div>
    <div class="card-body">
    <div class="row">
    
        <div class="col-lg-6 col-xl-6">
            <div>
                <table class="table table-bordered table-sm">
                    <tr>
                        <td>Student No.</td>
                        <td>{!!$student->student_no!!}</td>
                    </tr>
                    <tr>
                        <td>Full Name</td>
                        <td>{{$student->first_name. " " . $student->middle_name[0]. '.' . " " . $student->last_name}}</td>
                    </tr>
                    <tr>
                        <td>Gender</td>
                        <td>{{$student->gender}}</td>
                    </tr>
                    <tr>
                        <td>Birthday</td>
                        <td>{{($student->birthdate)->format('F d, Y')}}</td>
                    </tr>
                    <tr>
                        <td>Age</td>
                        <td>{{$age}}</td>
                    </tr>
                    <tr>
                        <td>Address</td>
                        <td>{{$student->address}}</td>
                    </tr>
                    <tr>
                        <td>Contact No.</td>
                        <td>{{$student->contact}}</td>
                    </tr>
                </table>
                
            </div>
                <hr>
                <small>Added on {{($student->created_at)->format('F d, Y')}} by <b>{{$student->user->first_name . " " . $student->user->last_name}}</b></small>
                <hr>
            <div class="">
                @if(!Auth::guest())
                    @if(Auth::user()->id == $student->added_by)
                        <a href="/students/{{$student->id}}/edit" class="btn btn-outline-dark btn-sm">Edit</a>
                    
                        <form action="/students/{{$student->id}}" method="POST" class="float-right">
                            {{ method_field('DELETE')}}
                            {{ csrf_field() }}
                            <button class="btn btn-outline-danger btn-sm">Delete</button>
                        </form>
                        {{-- {!!Form::open(['action' => ['PostsController@destroy', $post->id], 
                            'method' => 'POST', 'class' => 'float-right'
                        ])!!}
            
                            {{Form::hidden('_method', 'DELETE')}}
                            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                        {!!Form::close()!!} --}}
                    @endif
                @endif
            </div>
        </div>
    </div>
    </div>
    </div>
    <br />
    
</div>

{{-- <a href="/posts" class="btn btn-outline-dark">Go Back</a>
    
    <br> --}}
    
    

    
@endsection