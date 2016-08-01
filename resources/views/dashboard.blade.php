@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">


        <div class="col-md-6">
         <div class="panel panel-primary">
            <div class="panel-heading">
                Database Administration
            </div>
            <div class="panel-body">
                <a href="{{ url('students') }}" class="btn btn-sq-lg btn-default">
                    <i class="fa fa-user fa-5x"></i><br/>
                    Update Students
                </a>
                <a href="{{ url('resources') }}" class="btn btn-sq-lg btn-default">
                    <i class="fa fa-video-camera fa-5x"></i><br/>
                    Update Resources
                </a>
                <a href="{{ url('categories') }}" class="btn btn-sq-lg btn-default">
                    <i class="fa fa-tag fa-5x"></i><br/>
                    Update Categories
                </a>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
