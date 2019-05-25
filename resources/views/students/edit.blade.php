@extends('layouts.app')

@section('title')
    Edit Student
@endsection

@section('content')
<h3>Student's Information</h3>

<div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                       <strong>Edit Student Info
                            <a href="/students" class="btn btn-primary btn-sm float-right">Go back</a></strong> 
                    </div>
    
                    <div class="card-body">
                        <form action="/students/{{$student->id}}" method="POST">
                            {{ method_field('PATCH')}}
                            {{ csrf_field() }}
                            <div class="container-fluid">
                                <div class="row">

                                    <div class="form-group">
                                        <div class="form-row mx-auto">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label class="primary-color">Student No.</label>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <input type="text" class="form-control form-control-sm" value="{{$student->student_no}}" disabled>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-row mx-auto">
                                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                                                <label class="primary-color">Full Name</label>
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                
                                                <input type="text" name="last_name" class="form-control form-control-sm @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{$student->last_name}}">
                                                  
                                                @error('last_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                <input type="text" name="first_name" class="form-control form-control-sm @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{$student->first_name}}">
                                                    
                                                @error('first_name')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                                @enderror
                                            </div>

                                            <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                                                <input type="text" name="middle_name" class="form-control form-control-sm @error('middle_name') is-invalid @enderror" placeholder="Middle Name"
                                                    value="{{$student->middle_name}}">   
                                                    
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
                                            <input type="radio" name="gender" value="Male" {{ ($student->gender=="Male")? "checked" : "" }} class="form-check-input">Male 
                                            
                                            {!! str_repeat('&nbsp;', 5) !!}
                                            
                                            <input type="radio" name="gender" value="Female" {{ ($student->gender=="Female")? "checked" : "" }} class="form-check-input">Female
                                            
                                        </div>  
                                    </div>
                                            
                                                
                                    <div class="form-group row">
                                        <label class="primary-color">Birthdate</label>
                                            <input type="date" name="birthdate" class="form-control form-control-sm @error('birthdate') is-invalid @enderror" value="{{($student->birthdate)->format('Y-m-d')}}">  
                                            @error('birthdate')
                                                <span class="invalid-feedback">
                                                    <strong>{{$message}}</strong>
                                                </span>
                                            @enderror
                                    </div>
                                    
                                    <div class="form-group row">
                                                <label class="primary-color">Address</label>
                                              
                                                    <input type="text" name="address" class="form-control form-control-sm @error('address') is-invalid @enderror" placeholder="address" value="{{$student->address}}">
                                                        
                                                    @error('address')
                                                    <span class="invalid-feedback">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                                
                                            </div>
                                                
                                            <div class="form-group row">
                                                <label class="primary-color">Contact no.</label>
                                                    <input type="text" name="contact" class="form-control form-control-sm @error('contact') is-invalid @enderror" placeholder="contact" value="{{$student->contact}}" maxlength="11">
                                                        
                                                    @error('contact')
                                                    <span class="invalid-feedback">
                                                        <strong>{{$message}}</strong>
                                                    </span>
                                                    @enderror
                                            </div>
                                            
                                            <div class="form-group row">
                                                <button type="submit" class="btn btn-success btn-sm form-control form-control-sm">Submit</button>
                                            </div>    

                                    <div class="form-group">
                                    
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