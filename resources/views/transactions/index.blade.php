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
    $('#transactionTable').DataTable({
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
  <div class="col-sm-2">
        @include('layouts.navigation-db')
    </div>

    <div class="col-sm-10">
      <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fa fa-fw fa-users"></span> Transactions
    </div>
    <div class="panel-body">

            <table class="table table-hover table-condensed" id="transactionTable">
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
                <tbody>@foreach ($transactions as $transaction)
                    <tr>
                        <!-- Equipment Name -->
                        <td class="table-text">{{ $transaction->id }}</td>
                        <td class="table-text">{{ $transaction->student->full_name }}</td>
                        <td class="table-text">{{ $transaction->resource->name }}</td>
                        <td class="table-text">{{ $transaction->created_at }}</td>
                        <td class="table-text">{{ $transaction->returned_at }}</td>
                        @if (Auth::user()->name == 'Admin')
                        <td>
                        {!! Form::open(['method' => 'DELETE', 'action' => ['TransactionController@destroy', $transaction->id], 'id'=>'delete-transaction-'.$transaction->id.'-form', 'style'=>'display:inline;']) !!}

                            <a href="#" class="confirm-box btn btn-danger btn-xs" id="delete-transaction-{{ $transaction->id }}"><i class="fa fa-trash"></i></a>
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
