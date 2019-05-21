@extends('layouts.app')


@section('title')
    Student List
@endsection

@section('content')
    <h1>Students' List <a href="/students/create"><button class="float-right btn btn-primary">Add Student</button></a></h1>
    
    @if (count($students) > 0)
    <table class="table table-striped">
        <tr>
            <th>Student Number</th>
            <th>Last Name</th>
            <th>First Name</th>
            <th>Middle Name</th>
            <th colspan = "2">Action</th>
        </tr>
            @foreach ($students as $s)
        <tr>
            <td>{{$s->id}}</td>
            <td>{{$s->last_name}}</td>
            <td>{{$s->first_name}}</td>
            <td>{{$s->middle_name}}</td>
            <td><a href="/students/{{$s->id}}/edit" class="btn btn-dark">Edit</a></td>
            <td>
                <form action="/students/{{$s->id}}" method="POST">
                    {{ method_field('DELETE')}}
                    {{ csrf_field() }}
                    <button class="btn btn-danger">Delete</button>
                </form>
                
            </td>
        </tr>
            @endforeach
    </table>
        {{$students->links()}}
    @else
        <em>There are no students yet! Add someone now!</em>
    @endif

@endsection