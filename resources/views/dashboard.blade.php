@extends('layouts.app')

@section('title')
    {{Auth::user()->first_name}}'s Dashboard
@endsection
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard
                    <a href="/students" class="btn btn-primary btn-sm float-right">View All Students</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="card-columns">
                        <div class="card bg-primary text-white">
                            <div class="card-body" style="text-align:center">
                                <div>
                                    <h1>
                                        <i class="fas fa-users">{!!str_repeat('&nbsp;', 2)!!}<span class="float-right">{{$all}}</span></i> 
                                    </h1>
                                </div>       
                            </div>
                            <div class="card-footer text-center">
                                <strong>All Students</strong>
                            </div>
                        </div>
                        
                        <div class="card bg-success text-white">
                            <div class="card-body" style="text-align:center">
                                <div>
                                    <h1>
                                        <i class="fas fa-user">{!!str_repeat('&nbsp;', 2)!!}<span class="float-right">{{$active}}</span></i> 
                                    </h1>
                                </div>       
                            </div>
                            <div class="card-footer text-center">
                                <strong>Active Students</strong>
                            </div>
                        </div> 
                        
                        <div class="card bg-danger text-white">
                            <div class="card-body text-center">
                                <div>
                                    <h1>
                                        <i class="fas fa-user-slash">{!!str_repeat('&nbsp;',2)!!}<span class="float-right">{{$inactive}}</span></i>
                                    </h1>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <strong>Inactive Students</strong>
                            </div>
                        </div>
                    </div>
                        
                    <h1 class="text-center">{{ $chart1->options['chart_title'] }}</h1>
                    {!! $chart1->renderHtml() !!}

                    <hr>
                    
                    <h1 class="text-center">{{ $chart2->options['chart_title'] }}</h1>
                    {!! $chart2->renderHtml() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! $chart1->renderChartJsLibrary() !!}
{!! $chart1->renderJs() !!} 
{!! $chart2->renderChartJsLibrary() !!}
{!! $chart2->renderJs() !!}    
@endsection
