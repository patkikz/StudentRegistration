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
                    <div class="table-responsive table-sm">
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
                            <a href="{{url('/print-pdf')}}" class="btn btn-outline-danger btn-sm" target="_blank"><i class="fas fa-file-pdf"> Export to PDF</i></a>
                            <a href="{{url('/export-excel')}}" class="btn btn-outline-success btn-sm" target="_blank"><i class="fas fa-file-excel"> Export Excel</i></a>
                            <a href="{{url('/generate-word')}}" class="btn btn-outline-primary btn-sm" target="_blank"><i class="fas fa-file-word">  Export Word</i></a>
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
                <span id="form_result"></span>
                <form id="studentForm" name="studentForm" class="form-horizontal" method="POST">
                    {{ csrf_field() }}
                   <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="student_no" class="col-sm-4 control-label">Student Number</label>
                        <div class="col-sm-12">
                        <input type="text" class="form-control" id="student_no" name="student_no" value="{{$student_id}}" required>
                        </div>
                    </div>
     
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Last Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="last_name" name="last_name" placeholder="Enter Last Name" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">First Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="first_name" name="first_name" placeholder="Enter First Name" class="form-control">
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label class="col-sm-3 control-label">Middle Name</label>
                        <div class="col-sm-12">
                            <input type="text" id="middle_name" name="middle_name" placeholder="Enter Middle Name" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">Gender</label>
                        <div class="col-sm-4">
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="radio" name="gender" id="gender" value="Male" class="form-check-input">Male 
                                            
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

                            <input type="radio" name="gender" id="gender" value="Female" class="form-check-input">Female
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">Birthday</label>
                        <div class="col-sm-12">
                            <input type="date" id="birthdate" name="birthdate" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">Address</label>
                        <div class="col-sm-12">
                            <input type="text" id="address" name="address" placeholder="Enter Middle Address" class="form-control">
                        </div>
                    </div>

                     <div class="form-group">
                        <label class="col-sm-3 control-label">Contact Number</label>
                        <div class="col-sm-12">
                            <input type="text" id="contact" name="contact" placeholder="Enter Middle Contact" class="form-control">
                        </div>
                    </div>
      
                    <div class="col-sm-offset-2 col-sm-10">
                     <input type="hidden" name="action" id="action" />
                    <input type="hidden" name="hidden_id" id="hidden_id" />
                    <input type="submit" name="action_button" id="action_button" class="btn btn-success" value="Add" />
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
            //DataTable
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

            $('#studentForm').on('submit', function(e){
                e.preventDefault();
                if($('#action').val() == 'Add')
                {
                    $.ajax({
                        url: "{{ route('students.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success:function(data)
                        {
                            var html = '';
                            if(data.errors)
                            {
                                html += '<div class="alert alert-danger">';
                                for(var i = 0; i < data.errors.length; i++)
                                {
                                    html += '<p>' + data.errors[i] + '</p>';
                                }
                                html += '</div>';
                            }
                            if(data.success)
                            {
                                html = '<div class="alert alert-success">' + data.success + '</div>';
                                $('#studenForm').empty();
                                $('#student_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                        }
                    })
                }
                if($('#action').val() == 'Edit')
                {
                    $.ajax({
                        url: "{{ route('students.update') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success:function(data)
                        {
                            var html = '';
                            if(data.errors)
                            {
                                html = '<div class="alert alert-danger">';
                                for(var i = 0; i < data.errors.length; i++)
                                {
                                    html += '<p>' + data.errors[i] + '</p>';
                                }
                                html += '</div>';
                            }
                            if(data.success)
                            {
                                html = '<div class="alert alert-success">' + data.success + '</div>';
                                $('#studenForm').empty();
                                $('#student_table').DataTable().ajax.reload();
                            }
                            $('#form_result').html(html);
                        }
                    });
                }
            });
            $(document).on('click', '.edit', function(){
                var id = $(this).attr('id');
                $('#form_result').html('');
                $.ajax({
                    url: "/students/"+id+"/edit",
                    dataType: "json",
                    success:function(dta)
                    {
                        $('#student_no').val(dta.data.student_no);
                        $('#last_name').val(dta.data.last_name);
                        $('#first_name').val(dta.data.first_name);
                        $('#middle_name').val(dta.data.middle_name);
                        $('#gender').val(dta.data.gender);
                        $('#birthdate').val(dta.data.birthdate);
                        $('#address').val(dta.data.address);
                        $('#contact').val(dta.data.contact);
                        $('#hidden_id').val(dta.data.id);
                        $('.modal-title').text("Edit Student");
                        $('#action_button').val("Edit");
                        $('#action').val("Edit");
                        $('#formModal').modal('show');

                        console.log(dta.data);
                    }
                });
            });

            var user_id;
            
            $(document).on('click', '.delete', function(){
                user_id = $(this).attr('id');
                $('#confirmModal').modal('show');
            }); 

            $('#ok_button').click(function(){
                $.ajax({
                    url: "students/destroy/"+user_id,
                    beforeSend:function(){
                        $('#ok_button').text('Deleting...');
                    },
                    success:function(data)
                    {
                        setTimeout(function(){
                            $('#confirmModal').modal('hide');
                            $('#student_table').DataTable().ajax.reload();
                        }, 500);
                    }
                });
            });
        });
    </script>
@endsection

