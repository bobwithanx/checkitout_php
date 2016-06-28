<!-- resources/views/students/student.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container page-content">
  <div>
    <a href="{{ url('/admin') }}">Dashboard</a> > <a href="{{ url('/students') }}">Students</a> > {{ $student->first_name }} {{ $student->last_name }}
  </div>

  <h3 class="sub-header">{{ $student->first_name }} {{ $student->last_name }} <small>{{ $student->id_number }}</small></h3>
         
  <div class="row">
    <div class="col-md-12">
        <div class="pull-right">
        {!! Form::open(['url' => 'student/' . $student->id . '/borrow']) !!}

        <div class="form-group">
            {!! Form::hidden('student_id', $student->id) !!}
            {!! Form::label('resource_id', 'Resources:') !!}
            {!! Form::select('resource_id', $resources, null, []) !!}

            {!! Form::submit('Borrow', ['class' => 'btn btn-xs btn-primary']) !!}
        </div>
        <div class="form-group">
            {!! Form::text('name', null, ['placeholder' => 'Quick Scan']) !!}

            or <a href="#" data-toggle="modal" data-target="#addStudentModal">Browse Items</a>
        </div>

        {!! Form::close() !!}
    </div>
</div>

    <div class="col-md-12">

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
    </div>

    <!-- Current Student -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Loans
            </div>

            <div class="panel-body">
                <table class="table table-hover table-condensed">

                    <!-- Table Headings -->
                    <thead>
                        <th>Item</th>
                        <th>Inventory Tag</th>
                        <th>Borrowed</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($student->transactions as $transaction)
                            <tr>
                                <!-- Equipment Name -->
                                <td class="table-text">					
                                    <i class="fa fa-fw text-muted {{ $transaction->resource->category->icon }}"></i>
                                    <a href="{{ url('resource/'.$transaction->resource->id) }}">{{ $transaction->resource->name }}</a>
                                </td>
                                <td class="table-text text-muted">{{ $transaction->resource->inventory_tag }}
                                </td>
                                <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="transaction.time_out"> {{ $transaction->updated_at }} </td>
                                <td><small><i class="fa fa-calendar-check-o text-info"></i> check in</small></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

@endsection
