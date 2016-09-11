@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
            <div class="row">
            @if (Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        <a href="{{ url('/login') }}">Login</a>
                    </div>
                </div>
        @else
                <div class="panel panel-default">
                    <div class="panel-body">
                        {!! Form::open(['url' => '/students/search']) !!}
                            <div class="input-group">
                                {!! Form::text('student_id', null, ['placeholder' => 'Scan or type a STUDENT ID number', 'class'=>'form-control', 'id'=>'student_id', 'autofocus']) !!}
                                <span class="input-group-btn">
                                {{Form::button('<i class="fa fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-primary'))}}</span>
                            </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div>
                </div>
                @if (Auth::user()->name == 'Admin')
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
                        <div class="panel-body">
                            <a href="{{ url('/admin') }}">Setup</a>
                        </div>
                    </div>
                </div>
                @endif
            @endif
        </div>
    </div>
</div>
@endsection
