@extends('layouts.app')

@section('title')
    Add Student
@endsection

@section('content')
<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       <strong>Fill-up the following <a href="/students" class="btn btn-primary btn-sm float-right">Go back</a></strong> 
                    </div>
    
                    <div class="card-body">
                        <form action="/students" method="POST">
                           
                            {{ csrf_field() }}
                            <div class="container-fluid">
                                <div class="row">

                                        <div class="form-group">
                                                <div class="form-row mx-auto">
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <label class="primary-color">Student No.</label>
                                                    </div>
        
                                                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                        <input type="text" name="student_no" class="form-control form-control-sm @error('student_no') is-invalid @enderror" value="{{$student_id}}" readonly>

                                                        @error('student_no')
                                                        <span class="invalid-feedback">
                                                            <strong>{{$message}}</strong>
                                                        </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>

                                    <div class="form-group">
                                        <div class="form-row mx-auto">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label class="primary-color">Full Name</label>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                <input type="text" name="last_name" class="form-control form-control-sm @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name')}}">
                                                  
                                                @error('last_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                <input type="text" name="first_name" class="form-control form-control-sm @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name') }}">
                                                    
                                                @error('first_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                <input type="text" name="middle_name" class="form-control form-control-sm  @error('middle_name') is-invalid @enderror" placeholder="Middle Name"
                                                    value="{{ old('middle_name')}}">   
                                                    
                                                @error('middle_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            
                                <div class="form-group">
                                    <label class="primary-color">Gender</label>
                                        <div class="form-inline">
                                            <input type="radio" name="gender" value="Male" @if(!old('gender')) checked @endif class="form-check-input">Male 
                                            
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        
                                            <input type="radio" name="gender" value="Female" @if(old('gender')) checked @endif class="form-check-input">Female
                                            
                                        </div>  
                                    </div>
                                            
                                                
                                    <div class="form-group row">
                                        <label class="primary-color">Birthdate</label>
                                        {!! str_repeat('&nbsp', 20)!!} <span>Age: <b id="age"></b></span>
                                            <input type="date" id="birth_date" name="birthdate" class="form-control form-control-sm @error('birthdate') is-invalid @enderror" value="{{ old('birthdate')}}">  
                                            @error('birthdate')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    
                                    <div class="form-group row">
                                                <label class="primary-color">Address</label>
                                              
                                                    <input type="text" name="address" class="form-control form-control-sm @error('address') is-invalid @enderror" placeholder="address" value="{{ old('address') }}">
                                                        
                                                    @error('address')
                                                    <span class="invalid-feedback">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                                
                                            </div>
                                                
                                            <div class="form-group row">
                                                <label class="primary-color">Contact no.</label>
                                                    <input type="text" name="contact" class="form-control form-control-sm @error('contact') is-invalid @enderror" placeholder="contact" value="{{ old('contact')}}" maxlength="11">
                                                        
                                                    @error('contact')
                                                    <span class="invalid-feedback">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                            
                                            <div class="form-group row">
                                                <button type="submit" class="btn btn-success btn-sm form-control form-control-sm">Submit</button>
                                            </div>    
                                                
                            </div>
                                </div>
                            </div>
                        </form> 
                    </div>
                </div>
            </div>
        </div>
    </div> 
@endsection

@section('scripts')

    <script>
    $(document).ready(function(){
        $("#birth_date").change(function(){
           var value = $("#birth_date").val();
            var dob = new Date(value);
            var today = new Date();
            var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
            if(isNaN(age)) {
                age=0;
            }
            else{
                age=age;
            }
            $('#age').html(age);
        }); 
    });
    </script>
@endsection