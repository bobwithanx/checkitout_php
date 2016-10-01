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


button#searchButton.btn.btn-default.active {
    background: green !important;
    color: #fff;
}

</style>

<script>
    $(document).ready(function(){
        $('#historyTable').DataTable({
            "lengthChange": false,
            "filter":       false,
            "bSort":        false,
            "language": {
                "infoEmpty":    "",
                "emptyTable":   "No items have been borrowed.",
            },
        } );
        $('#currentTable').DataTable({
            "lengthChange": false,
            "filter":       false,
            "bSort":        false,
            "language": {
                "infoEmpty":    "",
                "emptyTable":   "No items are on loan.",
            },
        } );
        $('.collapse').collapse("hide");
        // $('div.dataTables_filter input').focus();
    });

</script>

<div class="details-header">
    <div class="container page-content">
        <div class="row">
            <div class="col-xs-12">
                <div class="sub-header">
                    <div><span class="h3">{{ $student->full_name }}</span>
                        <span class="label label-default label-student-id"><i class="fa fa-tag"></i> {{ $student->id_number }}
                        </span>

{{--                         <span class="small text-muted">{{ $student->id_number }}</span>
 --}}                    </div>
                </div>

                <div class="sub-tabs">

                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#current" aria-controls="current" role="tab" data-toggle="tab"><i class="fa fa-briefcase"></i>&nbsp;Current</a></li>
                        <li role="presentation"><a href="#history" aria-controls="history" role="tab" data-toggle="tab"><i class="fa fa-history"></i> History</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container page-content">
    <div class="row">
        <div class="col-xs-12">
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="current">
                    <div class="row">
                        <div class="col-sm-6">
                            {!! Form::open(['url' => 'students/' . $student->id . '/borrow', 'id'=>'add_inventory']) !!}
                            <div class="input-group">
                                <span class="input-group-addon">
                                <i class="fa fa-tag"></i>
                                </span>
                                {!! Form::text('inventory_tag', null, ['placeholder' => 'Enter INVENTORY TAG', 'id'=>'inventory_tag', 'class'=>'form-control typeahead', 'autofocus', 'autocomplete'=>'off']) !!}
                                <span class="input-group-btn">
                                    {{Form::button('<i class="fa fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-success', 'id'=>'goButton'))}}
                                </span>
                            </div><!-- /input-group -->
                            {!! Form::close() !!}
                        </div>
                    </div>
                    <table class="table currentTable" id="currentTable">
                        <thead>
                            <th>Item</th>
                            <th>Inventory Tag</th>
                            <th>Borrowed</th>
                            <th>Actions</th>
                        </thead>
                        <tbody>
                             @foreach ( $current_loans as $loan )
                            <tr class="table-row">
                                <!-- Equipment Name -->
                                <td class="table-text">
                                    <i class="fa fa-fw text-muted {{ $loan->resource->category->icon }} category"></i>
                                    <a href="{{ url('resources/'.$loan->resource->id) }}">{{ $loan->resource->name }}</a>
                                </td>
                                <td class="table-text">
                                    <span class="text-muted inventory-tag">{{ $loan->resource->inventory_tag }}</span>
                                </td>
                                <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="{{ $loan->created_at }}">
                                    @if ($loan->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                    Today, {{ $loan->created_at->format('g:i a') }}
                                    @elseif ($loan->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                                    Yesterday, {{ $loan->created_at->format('g:i a') }}
                                    @elseif ($loan->created_at->diffInDays(Carbon\Carbon::now())
                                    < 7) {{ $loan->created_at->format('l, g:i a') }}
                                    @else
                                    {{ $loan->created_at->format('M j Y, g:i a') }}
                                    @endif</td>

                                    <td>
                                        {{ Form::open(['method' => 'POST', 'url' => 'students/' . $student->id . '/return']) }}
                                        {{ Form::hidden('loan_id', $loan->id)}}
                                    {{ Form::button('<i class="fa fa-calendar-check-o"></i> Check In ', array('type' => 'submit', 'class' => 'btn btn-default btn-xs')) }}
                                    {{ Form::close() }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div role="tabpanel" class="tab-pane" id="history">
                    <table class="table historyTable" id="historyTable">
                        <!-- Table Headings -->
                        <thead>
                            <th>Resource</th>
                            <th>Inventory Tag</th>
                            <th>Borrowed</th>
                            <th>Returned</th>
                            @if (Auth::user()->name == 'Admin')
                                <th>Actions</th>
                            @endif
                        </thead>
                        <!-- Table Body -->
                        <tbody>
                            @foreach ($history as $loan)
                            <tr class="table-row">
                                <!-- Equipment Name -->
                                <td class="table-text">
                                    <i class="fa fa-fw text-muted {{ $loan->resource->category->icon }}"></i>
                                    <a href="{{ url('resources/'.$loan->resource->id) }}">{{ $loan->resource->name }}</a>
                                </td>
                                <td class="table-text">
                                    <span class="text-muted">{{ $loan->resource->inventory_tag }}</span>
                                </td>
                                <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="{{ $loan->created_at }}">
                                    @if ($loan->created_at->diffInDays(Carbon\Carbon::now()) == 0)
                                    Today, {{ $loan->created_at->format('g:i a') }}
                                    @elseif ($loan->created_at->diffInDays(Carbon\Carbon::now()) == 1)
                                    Yesterday, {{ $loan->created_at->format('g:i a') }}
                                    @elseif ($loan->created_at->diffInDays(Carbon\Carbon::now())
                                    < 7) {{ $loan->created_at->format('l, g:i a') }}
                                    @else
                                    {{ $loan->created_at->format('M j Y, g:i a') }}
                                    @endif</td>
                                <td class="table-text text-muted" data-toggle="tooltip" data-container="td" data-placement="top" title="{{ $loan->returned_at }}">
                                    @if ($loan->returned_at->diffInDays(Carbon\Carbon::now()) == 0)
                                    Today, {{ $loan->returned_at->format('g:i a') }}
                                    @elseif ($loan->returned_at->diffInDays(Carbon\Carbon::now()) == 1)
                                    Yesterday, {{ $loan->returned_at->format('g:i a') }}
                                    @elseif ($loan->created_at->diffInDays(Carbon\Carbon::now())
                                    < 7) {{ $loan->created_at->format('l, g:i a') }}
                                    @else
                                    {{ $loan->returned_at->format('M j Y, g:i a') }}
                                    @endif
                                </td>
                                @if (Auth::user()->name == 'Admin')
                                    <td>
                                        <form action="{{ url('loans/'.$loan->id) }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button type="submit" class="btn btn-xs btn-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>
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
</div>

<script>
    $('input.typeahead').autocomplete({
        serviceUrl: '{{ route('autocompleteResource') }}',
        onSelect: function (suggestion) {
            $("#inventory_tag").val(suggestion.data);
        },
    })
</script>

@endsection
