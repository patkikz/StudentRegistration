@extends('layouts.app')


@section('title')
    Student List
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-sm-6">
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
                                <th colspan ="3" style="text-align:center">Actions</th>
                            </tr>
                                @foreach ($students as $s)
                            <tr>
                                <td>{{$s->student_no}}</td>
                                <td>{{$s->last_name}}</td>
                                <td>{{$s->first_name}}</td>
                                <td>{{$s->middle_name}}</td>
                                <td><a href="/students/{{$s->id}}" class="btn btn-primary btn-sm" data-toggle="view" title="View"><i class="fas fa-eye"></i></a></td>
                                <td><a href="/students/{{$s->id}}/edit" class="btn btn-dark btn-sm" data-toggle="view" title="Edit"><i class="fas fa-edit"></i></a></td>
                                <td>
                                    <form action="/students/{{$s->id}}" method="POST">
                                        {{ method_field('DELETE')}}
                                        {{ csrf_field() }}
                                        <button class="btn btn-danger btn-sm" data-toggle="view" title="Remove"><i class="fas fa-trash-alt"></i></button>
                                    </form>
                                    
                                </td>
                            </tr>
                                @endforeach
                        </table>
                        <hr>
                        <div class="float-right">
                            <a href="{{url('/print-pdf')}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-file-pdf"> Export to PDF</i></a>
                            <a href="{{url('/export-excel')}}" class="btn btn-outline-success btn-sm"><i class="fas fa-file-excel"> Export Excel</i></a>
                            <a href="{{url('/generate-word')}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-word">  Export Word</i></a>
                        </div>
                        
                            {{$students->links()}}
                        @else
                            <em>There are no students yet! Add someone now!</em>
                        @endif
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card">
                <div class="card-header"><strong>Inactive Students List</strong></div>
                <div class="card-body">
                    @if (count($inactive) > 0)
                        <table class="table table-striped table-sm">
                            <tr>
                                <th>Student Number</th>
                                <th>Last Name</th>
                                <th>First Name</th>
                                <th>Middle Name</th>
                                <th colspan="2">Action</th>
                            </tr>
                            @foreach ($inactive as $i)
                                <tr>
                                    <td>{{$i->student_no}}</td>
                                    <td>{{$i->last_name}}</td>
                                    <td>{{$i->first_name}}</td>
                                    <td>{{$i->middle_name}}</td>
                                    <td>
                                        <form action="/students/{{$i->id}}/restore" method="POST">
                                            {{ csrf_field() }}
                                            <button class="btn btn-warning btn-sm"><b>Reactivate</b></button>
                                        </form>
                                    </td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete"><b>Delete</b></button>
                                    </td>
                                </tr>

                                <div class="modal fade" id="delete">
                                    <div class="modal-dialog">
                                      <div class="modal-content">
                                  
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                          <h4 class="modal-title">Permanently Delete Student</h4>
                                          <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                  
                                        <!-- Modal body -->
                                        <div class="modal-body">
                                            <p>Are you sure you want to permanently delete <b style="color: red">{{$i->first_name}}</b> from the students list?</p>  
                                        </div>
                                  
                                        <!-- Modal footer -->
                                        
                                        <div class="modal-footer">
                                            <form action="/students/{{$i->id}}/remove" method="POST">
                                                {{method_field('DELETE')}}
                                                {{ csrf_field() }}
                                                <button class="btn btn-danger btn-sm" data-toggle="modal" data-target="#delete">Yes</button>
                                                <button class="btn btn-dark btn-sm" data-dismiss="modal">No</button>
                                            </form>
                                        </div>
                                  
                                      </div>
                                    </div>
                                  </div>
                            @endforeach
                        </table>
                    @else
                        <em>There are no inactive students yet!</em>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script src="text/javascript">
        $(document).ready(function()
        {
            $('[data-toggle="view"]').tooltip(); 
        })
    </script>
@endsection