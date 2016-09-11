<!-- resources/views/students/student.blade.php -->@extends('layouts.app')

@section('content')

<style>

    .table
    { border-left: none;
        border-right: none;
        border-top: none;}

.sub-header h1 {
    margin-top: 10px;
}
</style>

<script>$(document).ready(function(){
        $('#historyTable').DataTable({
            "lengthChange": false,
            "filter": false,
            "order": [[ 2, 'desc' ]],
        } );
        $('.collapse').collapse("hide");
        // $('div.dataTables_filter input').focus();
    });</script>

<div class="container page-content">
    <div class="row">
        <div class="col-xs-3">
            <div class="sub-header">
                <h3>{{ $student->full_name }}
                   {{--  <small class="h4 text-muted"><span class="label label-info">{{ $student->id_number }}</span></small> --}}
                </h3>
                <div class="h4 text-muted">
                    {{ $student->id_number }}
                </div>
                    <hr>
                <div class="row">
                    <div class="text-muted text-center col-xs-4 summary-count">
                        <h2>
                            {{ $current_loans->count() }}
                        </h2>
                        Current
                    </div>
                    <div class="text-muted text-center col-xs-4 summary-count">
                        <h2>
                        {{ $history->count() }}
                        </h2>
                        History
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xs-9">

            <div>

              <!-- Nav tabs -->
              <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active"><a href="#current" aria-controls="current" role="tab" data-toggle="tab"><i class="fa fa-fw fa-briefcase"></i>&nbsp;Current</a></li>
                <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><i class="fa fa-fw fa-history"></i> History</a></li>
            </ul>

            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="current">
                    <div class="row">
                    <div class="col-sm-6">
                            {!! Form::open(['url' => 'students/' . $student->id . '/borrow']) !!}
                            <div class="input-group">
                                {!! Form::text('inventory_tag', null, ['placeholder' => 'Enter INVENTORY TAG', 'class'=>'form-control', 'autofocus']) !!}
                                <span class="input-group-btn">
                                    {{Form::button('<i class="fa fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-success'))}}</span>
                            </div><!-- /input-group -->
                            {!! Form::close() !!}
                        </div>
                    </div>
<hr>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                        Current Loans
                        </div>
                            <table class="table table-hover" id="transactionTable">
                                <!-- Table Body -->
                                <tbody>
                                    @foreach ( $current_loans as $transaction )
                                    <tr class="table-row">
                                        <!-- Equipment Name -->
                                        <td class="table-text">
                                            <i class="fa fa-fw text-muted {{ $transaction->resource->category->icon }} category"></i>
                                            <a href="{{ url('resources/'.$transaction->resource->id) }}">{{ $transaction->resource->name }}</a>
                                            <small class="text-muted inventory-tag">{{ $transaction->resource->inventory_tag }}</small>
                                        </td>
                                        <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="{{ $transaction->created_at }}">
                                            @if ($transaction->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                            Today, {{ $transaction->created_at->format('g:i a') }}
                                            @elseif ($transaction->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                                            Yesterday, {{ $transaction->created_at->format('g:i a') }}
                                            @elseif ($transaction->created_at->diffInDays(Carbon\Carbon::now())
                                            < 7) {{ $transaction->created_at->format('l, g:i a') }}
                                            @else
                                            {{ $transaction->created_at->format('M j Y, g:i a') }}
                                            @endif</td>

                                            <td>
                                                {{ Form::open(['method' => 'POST', 'url' => 'students/' . $student->id . '/return']) }}
                                                {{ Form::hidden('transaction_id', $transaction->id)}}
                                            {{ Form::button('<i class="fa fa-calendar-check-o"></i> Check In ', array('type' => 'submit', 'class' => 'btn btn-default btn-xs')) }}
                                            {{ Form::close() }}
                                        </td>
                                    </tr>
                                    @endforeach
</tbody>
</table>
</div>

        {{--
            <div class="panel-body">--}}
                <!-- Display Validation Errors -->{{--                     @include('common.errors')
 --}}{{--
            </div>--}}
            <!-- Current Student -->

    </div>
    <div role="tabpanel" class="tab-pane" id="history">

            <div class="panel panel-default">
                <div class="panel-heading">
                    Loan History
                </div>
                <div class="panel-body">
                    <table class="table table-hover table-condensed" id="historyTable">
                        <!-- Table Headings -->
                        <thead>
                            <th>Resource</th>
                            <th>Borrowed</th>
                            <th>Returned</th>
                        </thead>
                        <!-- Table Body -->
                        <tbody>
{{--                             Array: {{ dd($student->transactions()->history()->get())}}
 --}}
                        @foreach ($history as $transaction)
                                <tr class="table-row">
                                    <!-- Equipment Name -->
                                    <td class="table-text">
                                        <i class="fa fa-fw text-muted {{ $transaction->resource->category->icon }}"></i>
                                        <a href="{{ url('resources/'.$transaction->resource->id) }}">{{ $transaction->resource->name }}</a>
                                        <small class="text-muted">{{ $transaction->resource->inventory_tag }}</small>
                                    </td>
                                    <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="{{ $transaction->created_at }}">
                                        @if ($transaction->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                        Today, {{ $transaction->created_at->format('g:i a') }}
                                        @elseif ($transaction->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                                        Yesterday, {{ $transaction->created_at->format('g:i a') }}
                                        @elseif ($transaction->created_at->diffInDays(Carbon\Carbon::now())
                                        < 7) {{ $transaction->created_at->format('l, g:i a') }}
                                        @else
                                        {{ $transaction->created_at->format('M j Y, g:i a') }}
                                        @endif</td>
                                        <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="{{ $transaction->returned_at }}">
                                            @if ($transaction->returned_at->diffInDays(Carbon\Carbon::now()) == 0)
                                            Today, {{ $transaction->returned_at->format('g:i a') }}
                                            @elseif ($transaction->returned_at->diffInDays(Carbon\Carbon::now()) == 1)
                                            Yesterday, {{ $transaction->returned_at->format('g:i a') }}
                                            @elseif ($transaction->created_at->diffInDays(Carbon\Carbon::now())
                                            < 7) {{ $transaction->created_at->format('l, g:i a') }}
                                            @else
                                            {{ $transaction->returned_at->format('M j Y, g:i a') }}
                                            @endif</td>
{{--
                                            <td>
                                                <form action="{{ url('students/' . $student->id . '/transaction/'.$transaction->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                                    <button type="submit" id="delete-transaction-{{ $transaction->id }}" class="btn btn-xs btn-muted outline btn-muted-danger">
                                                        <i class="fa fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>--}}
                                        </tr>@endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

{{--     {!! Form::open(['url' => 'students/' . $student->id . '/borrow']) !!}
    {!! Form::hidden('student_id', $student->id) !!}
    {!! Form::select('resource_id', $resources, null, []) !!}
    {!! Form::submit('Borrow', ['class' => 'btn btn-xs btn-primary']) !!}
    {!! Form::close() !!}
 --}}
</div>


</div>

    <!-- Modal -->
    <div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">
                        <span aria-hidden="true">&times;</span>
                        <span class="sr-only">Close</span>
                    </button>
                    <h4 class="modal-title" id="myModalLabel">Edit Student</h4>
                </div>
                <!-- Edit Student Form -->
                <div class="modal-body">{{ Form::model($student, array('route' => array('students.update', $student->id), 'method' => 'PATCH')) }}

{{--      {{ Form::open(['method' => 'POST', 'url' => 'students/' . $student->id, 'class' => 'form-horizontal']) }}
 --}}
                    <!-- Modal Body -->
                    <div class="form-group">{!! Form::label('first_name', 'First Name *', ['class'=>'control-label']) !!}
            {!! Form::text('first_name', $student->first_name, ['class'=>'form-control']) !!}</div>
                    <div class="form-group">{!! Form::label('last_name', 'Last Name *') !!}
            {!! Form::text('last_name', $student->last_name, ['class'=>'form-control']) !!}</div>
                    <div class="form-group">{!! Form::label('id_number', 'ID Number *') !!}
            {!! Form::text('id_number', $student->id_number, ['class'=>'form-control']) !!}</div>
                    <div class="form-group">{!! Form::checkbox('is_active', 1, $student->is_active ) !!}
            {!! Form::label('is_active', 'Active?') !!}</div>


{{--
                    <div class="form-group">
                        <label for="group_id">Group</label>
                        <select class="form-control" name="group_id" id="group_id">
                            <option value="" selected></option>@foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name}}</option>@endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="grade_level_id">Grade Level</label>
                        <select class="form-control" name="grade_level_id" id="grade_level_id">
                            <option value="" selected></option>@foreach ($grade_levels as $grade_level)
                            <option value="{{ $grade_level->id }}">{{ $grade_level->name}}</option>@endforeach
                        </select>
                    </div>--}}
                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>{{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
