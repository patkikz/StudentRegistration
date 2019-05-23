@extends('layouts.app')


@section('title')
    Student List
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                   <strong>Student's List</strong> 
                    <a href="/students/create" class="btn btn-primary btn-sm float-right">Add Student</a>
                </div>

                <div class="card-body">
                        @if (count($students) > 0)
                        <table class="table table-striped table-sm">
                            <tr>
                                <th>Student Number</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th colspan = "2">Action</th>
                            </tr>
                                @foreach ($students as $s)
                            <tr>
                                <td><a href="/students/{{$s->id}}">{{$s->student_no}}</a></td>
                                <td>{{$s->last_name}}</td>
                                <td>{{$s->first_name}}</td>
                                <td>{{$s->middle_name}}</td>
                                <td><a href="/students/{{$s->id}}/edit" class="btn btn-outline-dark btn-sm">Edit</a></td>
                                <td>
                                    <form action="/students/{{$s->id}}" method="POST">
                                        {{ method_field('DELETE')}}
                                        {{ csrf_field() }}
                                        <button class="btn btn-outline-danger btn-sm">Delete</button>
                                    </form>
                                    
                                </td>
                            </tr>
                                @endforeach
                        </table>
                            {{$students->links()}}
                        @else
                            <em>There are no students yet! Add someone now!</em>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection