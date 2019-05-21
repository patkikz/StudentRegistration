@extends('layouts.app')


@section('title')
    Student List
@endsection

@section('content')
    <h1>Students' List</h1>

    @if (count($students) > 1)
    <table>
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
                {!!Form::open(['action' => ['StudentsController@destroy', $s->id], 'method' => 'POST'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                {!!Form::close()!!}
            </td>
        </tr>
            @endforeach
    </table>
        {{$students->links()}}
    @else
        <em>There are no students yet! Add someone now!</em>
    @endif

@endsection