<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')

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
                <i class="fa fa-2x text-muted {{ $resource->category->icon }} category"></i>
                <span class="h3">{{ $resource->name }}</span>
            </div>
            <div class="resource-metadata">
                <div class="text-muted">Inventory Tag</div>
                <div>{{ $resource->inventory_tag }}</div>
            </div>
            <hr>
<div class="resource-metadata">
    <div class="text-muted">Serial Number</div>
    <div>{{ $resource->serial_number }}</div>
</div>
         
</div>
<div class="col-xs-9">

    <!-- Bootstrap Boilerplate... -->

{{--     <div class="panel-body">
        Display Validation Errors
        @include('common.errors')
    </div>
 --}}

 @include('errors.list')

    <!-- Current Equipment -->
    <div class="panel panel-default" style="max-height: 100vmin; overflow-y: scroll;">
            <div class="panel-heading">
                Lending History
            </div>

            <div class="panel-body">
                <table class="table table-hover table-condensed" id="historyTable">

                    <!-- Table Headings -->
                    <thead>
                        <tr>
                          <th>Person</th>
                          <th>Checked Out</th>
                          <th>Returned</th>
                          <th>Actions</th>
                        </tr>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                    @foreach ($resource->transactions as $transaction)

                            <tr>
                                <!-- Item Name -->
                                <td class="table-text"><a href="{{ url('students/'.$transaction->student->id)}}">{{ $transaction->student->full_name }}</a> <small class="text-muted">{{ $transaction->student->id_number }}</small></td>
                                <td class="table-text">{{ $transaction->created_at }}</td>
                                <td class="table-text">{{ $transaction->returned_at }}</td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('resources/'.$resource->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" class="btn btn-xs btn-danger">
                                            <i class="fa fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
