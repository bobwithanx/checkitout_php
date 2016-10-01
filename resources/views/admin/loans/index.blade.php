@extends('layouts.app')

@section('content')

<script>
    $(document).on('click', '.confirm-box', function(event) {
        bootbox.confirm('Are you sure?', function(result) {if (result == true) {  $( "#"+event.target.id+'-form' ).submit();    }});
    }
    );
</script>

<script>
$(document).ready(function(){
    $('#loanTable').DataTable({
        "lengthChange": false,
        "order": [[ 0, 'desc' ]],
    } );
});
</script>

<style>

    .table
    { border-left: none;
        border-right: none;
        border-top: none;}
  </style>

<div class="container page-content">
  <div class="row">
    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fa fa-fw fa-exchange"></span> Loans
    </div>
    <div class="panel-body">

            <table class="table table-hover table-condensed" id="loanTable">
                <!-- Table Headings -->
                <thead>
                <th>ID</th>
                    <th>Student</th>
                    <th>Resource</th>
                    <th>Created At</th>
                    <th>Returned At</th>
                    <th>Actions</th>
                </thead>
                <!-- Table Body -->
                <tbody>@foreach ($loans as $loan)
                    <tr>
                        <!-- Equipment Name -->
                        <td class="table-text">{{ $loan->id }}</td>
                        <td class="table-text">{{ $loan->student->full_name }}</td>
                        <td class="table-text">{{ $loan->resource->name }}</td>
                        <td class="table-text">{{ $loan->created_at }}</td>
                        <td class="table-text">{{ $loan->returned_at }}</td>
                        @if (Auth::user()->name == 'Admin')
                        <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['LoanController@destroy', $loan->id], 'id'=>'delete-loan-'.$loan->id.'-form', 'style'=>'display:inline;']) !!}

                        <button type="submit" class=" btn btn-danger btn-xs" id="delete-loan-{{ $loan->id }}"><i class="fa fa-trash"></i></a>
                        {{ Form::close() }}
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

@endsection
