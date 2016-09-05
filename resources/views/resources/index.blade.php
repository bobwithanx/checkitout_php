<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')

<script>
    $(document).on('click', '.confirm-box', function(event) {
        bootbox.confirm('Are you sure?', function(result) {if (result) {  $( "#"+event.target.id+'-form' ).submit();    }});
    }
    );
</script>

<script>
    $(document).ready(function(){
        $('#resourceTable').DataTable({
            "lengthChange": false,
            "order": [[ 4, 'des' ]],
            "aoColumnDefs" : [ {
              'bSortable' : false,
              'aTargets' : [ 5 ]
            } ],
            "oSearch": {"sSearch": "{{ $filter }}", "bSmart": false},
            // "sDom": 'frtilp'
        } );
    });
</script>

<style>

.table
{ border-left: none;
border-right: none; 
border-top: none;}

/*.dataTables_wrapper .dataTables_filter {
  margin-top: 10px;
  margin-right: 10px;
}

.dataTables_wrapper .dataTables_length {
  margin-top: 10px;
  margin-left: 10px;
}

.dataTables_info {
  margin-left: 10px;
}

.dataTables_paginate {
  margin-right: 10px !important;
}
*/
</style>

<div class="container page-content">

  <div class="row">
    <div class="col-sm-2">
      @include('layouts.navigation-db')
    </div>

    <div class="col-sm-10">
      <div class="panel panel-default">
        <div class="panel-heading">
          <span class="fa fa-fw fa-gears"></span> Resources
          <div class="pull-right">
            <a class="alert" href="#" data-toggle="modal" data-target="#importResourceModal"><i class="fa fa-upload"></i> import resources</a>
            <a class="alert" href="#" data-toggle="modal" data-target="#addResourceModal"><i class="fa fa-plus-circle"></i> add resource</a>
          </div>
        </div>
        <div class="panel-body">
        <table class="table table-hover table-condensed" id="resourceTable">

                    <!-- Table Headings -->
                    <thead>
                          <th>Name</th>
                          <th>Tag</th>
                          <th class="hidden-xs hidden-sm hidden-md">Serial Number</th>
                          <th class="hidden-xs hidden-sm hidden-md">Category</th>
                          <th>Availability</th>
                          @if (Auth::user()->name == 'Admin')
                          <th>Actions</th>
                          @endif
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($resources as $resource)
                          @if ($resource->is_available)
                            <tr class="table-row">
                          @else
                            <tr class="table-row">
                          @endif
                          <!-- Item Name -->
                          <td class="table-text"><a href="{{ url('resources/'.$resource->id) }}"><i class="fa fa-fw {{ $resource->category->icon }}"></i> {{ $resource->name }}</a>
                                </td>
                                <td class="table-text">{{ $resource->inventory_tag }}</td>
                                <td class="table-text hidden-xs hidden-sm hidden-md">{{ $resource->serial_number }}</td>
                                <td class="table-text hidden-xs hidden-sm hidden-md">{{ $resource->category->name }}</td>
                                <td class="table-text">
                                @if ($resource->is_available)
                                    <span class="label label-info">Available</span>
                                @else
                                  <span class="label label-default">On Loan</span>
                                @endif
                                </td>
                                @if (Auth::user()->name == 'Admin')
                                <td>
                                 <a href="{{route('resources.edit', $resource->id)}}" data-toggle="modal" data-target="#addResourceModal" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                 {!! Form::open(['method' => 'DELETE', 'action' => ['ResourceController@destroy', $resource->id], 'id'=>'delete-resource-'.$resource->id.'-form', 'style'=>'display:inline;']) !!}
                                 <a href="#" class="confirm-box btn btn-danger btn-xs" id="delete-resource-{{ $resource->id }}"><i class="fa fa-trash"></i></a>
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

<!-- Modal -->
<div class="modal fade" id="addResourceModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Resource</h4>
            </div>
            
            {!! Form::open(['url' => 'resources']) !!}

            <div class="modal-body">
              @include('resources._form')
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Add Resource</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importResourceModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">&times;</span>
          <span class="sr-only">Close</span>
        </button>
        <h4 class="modal-title" id="myModalLabel">Import Equipment</h4>
      </div>

      {!! Form::open(['url' => '/resources/import', 'files' => true]) !!}
      <!-- Modal Body -->
      <div class="modal-body">
        <p>Upload a text file with a list of the equipment (one per line) that you would like to import, using the following format:</p>
        <code>
          name,category,inventory_tag,serial_number
        </code>
        <p>Note: Serial Number is optional</p>
        <div>&nbsp;
        </div>
        <div class="form-group">
          {!! Form::label('Import File *') !!}
          {!! Form::file('csv', null) !!}
        </div>
      </div>

      <!-- Modal Footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
        <button type="submit" class="btn btn-primary">Import Equipment</button>
      </div>
      {!! Form::close() !!}
    </div>
  </div>
</div>

@endsection
