<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')

<script>$(document).ready(function(){
    $('#historyTable').DataTable({
        "lengthChange": false,
        "filter": false,
        "order": [[ 2, 'desc' ]],
        "language": {
            "infoEmpty":    "",
            "emptyTable":   "No one has borrowed this item.",
        },
    } );
    $('.collapse').collapse("hide");
        // $('div.dataTables_filter input').focus();
    });</script>

    <div class="details-header">
        <div class="container page-content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="sub-header">
                        <h3>{{ $resource->name }}
                        </h3>
                        <div>
                            <span class="label label-primary" style="margin-right: 10px;">
                                <i class="fa fa-fw fa-tag"></i> {{ $resource->inventory_tag }}
                            </span>
                            <span class="label label-default" style="margin-right: 10px;">
                                <i class="fa fa-fw {{ $resource->category->icon }}"></i> {{ $resource->category->name }}
                            </span>
                            @if ($resource->serial_number)
                            <span class="label label-default">
                                SN: {{ $resource->serial_number }}
                            </span>
                            @endif
                        </div>
                    </div>
                    <div class="sub-tabs">

                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active single-tab"><a href="#current" aria-controls="current" role="tab"><i class="fa fa-fw fa-history"></i>&nbsp;Loan History <span class="badge tab-badge"></span></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
<div class="container page-content">
    <div class="row">
        <div class="col-xs-12">

    <!-- Bootstrap Boilerplate... -->

{{--     <div class="panel-body">
        Display Validation Errors
        @include('common.errors')
    </div>
 --}}

 @include('errors.list')

    <!-- Current Equipment -->
<div class="tab-content">
                <table class="table table-condensed historyTable" id="historyTable">

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
                    @foreach ($history as $loan)
                            <tr>
                                <!-- Item Name -->
                                <td class="table-text"><a href="{{ url('/admin/students/'.$loan->student->id)}}">{{ $loan->student->full_name }}</a> <small class="text-muted">{{ $loan->student->id_number }}</small></td>
                                <td class="table-text">{{ $loan->created_at }}</td>
                                <td class="table-text">{{ $loan->returned_at }}</td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('/admin/loans/'.$loan->id) }}" method="POST">
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

</div>


@endsection
