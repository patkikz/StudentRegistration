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
                    <button type="button" name="create_student" id="create_student" class="btn btn-primary btn-sm float-right">Add Student</button>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-sm" id="student_table">
                            <thead>
                                <tr>
                                    <th>Student Number</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                        <hr>
                        <div class="float-right">
                            <a href="{{url('/print-pdf')}}" class="btn btn-outline-danger btn-sm"><i class="fas fa-file-pdf"> Export to PDF</i></a>
                            <a href="{{url('/export-excel')}}" class="btn btn-outline-success btn-sm"><i class="fas fa-file-excel"> Export Excel</i></a>
                            <a href="{{url('/generate-word')}}" class="btn btn-outline-primary btn-sm"><i class="fas fa-file-word">  Export Word</i></a>
                        </div>
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
                                            <button class="btn btn-success btn-sm"><b>Reactivate</b></button>
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

{{-- Modal here --}}
<div class="modal fade" id="formModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="modelHeading"></h4>
            </div>
            <div class="modal-body">
                <form id="studentForm" name="studentForm" class="form-horizontal">
                   <input type="hidden" name="product_id" id="product_id">
                    <div class="form-group">
                        <label for="name" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-12">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name" value="" maxlength="50" required="">
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Details</label>
                        <div class="col-sm-12">
                            <textarea id="detail" name="detail" required="" placeholder="Enter Details" class="form-control"></textarea>
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <button type="submit" class="btn btn-primary" id="saveBtn" value="create">Save changes
                     </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div id="confirmModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h2 class="modal-title">Confirmation</h2>
            </div>
            <div class="modal-body">
                <h4 class="text-center" style="margin:0;">Are you sure you want to remove this data?</h4>
            </div>
            <div class="modal-footer">
             <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">OK</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function()
        {
            //DataTable Trigger
            $('#student_table').DataTable({
                processing: true,
                serverSide: true,
                ajax:{
                    url: "{{ route('students.index') }}",
                },
                columns:[
                    {data: 'student_no', name: 'student_no'},
                    {data: 'last_name', name: 'last_name'},
                    {data: 'first_name', name: 'first_name'},
                    {data: 'middle_name', name: 'middle_name'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
            
            //Create Modal

            $('#create_student').click(function()
            {
                $('.modal-title').text("Add New Student");
                $('#action_button').val("Add");
                $('#action').val("Add");
                $('#formModal').modal('show');
            });


            //Delete Modal
            var student_id;

            $(document).on

        });
    </script>
@endsection

