@extends('layouts.app')

@section('title')
    Add Student
@endsection

@section('content')
  <form action=""></form>
    <div class="container-fluid">
        <div class="row">
            <div class="form-group">
                <div class="form-row mx-auto">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Full Name</label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                         <input type="text" name="last_name" placeholder="Last Name" class="">
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            {{Form::text('first_name', '', ['class' => ($errors->has('first_name')) ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm input-label rounded-0', 'placeholder' => 'First Name'])}}
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                             {{Form::text('middle_name', '', ['class' => ($errors->has('middle_name')) ? 'form-control form-control-sm is-invalid' : 'form-control form-control-sm input-label rounded-0', 'placeholder' => 'Middle Initial', 'maxlength' => 1])}}
                    </div>
                </div>
            </div>
        </div>
    </div>
   
@endsection