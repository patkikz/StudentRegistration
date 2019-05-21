@extends('layouts.app')

@section('title')
    Edit Student
@endsection

@section('content')
<h1>Student's Information</h1>
    <form action="/students/{{$student->id}}" method="POST">
    {{ method_field('PATCH')}}
    {{ csrf_field() }}
    <div class="container-fluid">
        <div class="row">
            <div class="form-group">
                <div class="form-row mx-auto">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Full Name</label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <input type="text" name="last_name" class="form-control @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{$student->last_name}}">
                      
                        @error('last_name')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{$student->first_name}}">
                        
                        @error('first_name')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Middle Name"
                        value="{{$student->middle_name}}">   
                        @error('middle_name')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Gender</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="radio" name="gender" value="0" @if(old('gender')) checked @endif>Male
                            <input type="radio" name="gender" value="1" @if(old('gender')) checked @endif> Female
                        </div>
                    </div>
                    

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Birthdate</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror" value="{{$student->birthdate}}">  
                        </div>
                        @error('birthdate')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    


                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Address</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address" value="{{$student->address}}">
                            
                            @error('address')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                    

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Contact no.</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="contact" value="{{$student->contact}}">
                            
                            @error('contact')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>
                  
                    <br>
                    <br>

                    <div class="form-group">
                        <button type="submit" class="btn btn-success form-control">Submit</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </form>
@endsection