@extends('layouts.app')

@section('title')
    Add Student
@endsection

@section('content')
  <form action="/students" method="POST">
    {{ csrf_field() }}
    <!--  Error handle -->
    @if($errors->any())
    <div class="row collapse">
        <ul class="alert-box warning radius">
            @foreach($errors->all() as $error)
                <li> {{ $error }} </li>
            @endforeach
        </ul>
    </div>
    @endif

    <div class="container-fluid">
        <div class="row">
            <div class="form-group">
                <div class="form-row mx-auto">
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Full Name</label>
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <input type="text" name="last_name" class="form-control  @error('last_name') is-invalid @enderror" placeholder="Last Name" value="{{ old('last_name') }}">
                        
                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            
                      
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" placeholder="First Name" value="{{ old('first_name')}}" >

                        @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                        <input type="text" name="middle_name" class="form-control @error('middle_name') is-invalid @enderror" placeholder="Middle Name" >

                        @error('middle_name')
                        <span class="invalid-feedback">
                            <strong>{{$message}}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Gender</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="radio" name="gender" value="0" class="@error('gender') is-invalid @enderror">Male
                            <input type="radio" name="gender" value="1" class="@error('gender') is-invalid @enderror" >Female
                        </div>                      
                    </div>
                    

                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Birthdate</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="date" name="birthdate" class="form-control @error('birthdate') is-invalid @enderror"   value="{{ old('birthdate') }}">  
                            @error('birthdate')
                            <span class="invalid-feedback">
                                <strong>{{$message}}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
                        <label class="primary-color">Address</label>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-4 col-xl-4">
                            <input type="text" name="address" class="form-control @error('address') is-invalid @enderror" placeholder="address" value="{{ old('address') }}">   

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
                            <input type="text" name="contact" class="form-control @error('contact') is-invalid @enderror" placeholder="contact" value="{{ old('contact') }}">
                            
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