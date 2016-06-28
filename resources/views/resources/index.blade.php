<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container page-content">
  <div>
    <a href="{{ url('/admin') }}">Dashboard</a> > Inventory
  </div>

  <h3 class="sub-header">Inventory</h3>
         
  <div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <a class="alert" href="#" data-toggle="modal" data-target="#addInventoryModal">Add Inventory</a>
        </div>
    </div>
    <div class="col-md-12">

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
    </div>

    <!-- Current Equipment -->
    @if (count($resources) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Inventory
            </div>

            <div class="panel-body">
                <table class="table table-hover table-condensed">

                    <!-- Table Headings -->
                    <thead>
                          <th>Item</th>
                          <th>Inventory Tag</th>
                          <th>Serial Number</th>
                          <th>Availability</th>
                          <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($resources as $resource)
                            <tr>
                                <!-- Item Name -->
                                <td class="table-text"><i class="fa fa-fw {{ $resource->category->icon }}"></i> <a href="{{ url('resource/'.$resource->id) }}">{{ $resource->name }}</a></td>
                                <td class="table-text">{{ $resource->inventory_tag }}</td>
                                <td class="table-text">{{ $resource->serial_number }}</td>
                                <td class="table-text">
                                @if ($resource->is_available())
                                    Available
                                @else
                                    OUT
                                @endif
                                </td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('resource/'.$resource->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit"  id="delete-resource-{{ $resource->id }}" class="btn btn-xs btn-danger">
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
    @endif

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addInventoryModal" tabindex="-1" role="dialog" 
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" 
                   data-dismiss="modal">
                       <span aria-hidden="true">&times;</span>
                       <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">
                    Add Inventory
                </h4>
            </div>
            
            {!! Form::open(['url' => 'resources']) !!}

            <div class="modal-body">

                <div class="form-group">
                    {!! Form::label('name', 'Name *') !!}
                    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Canon XA25']) !!}
                </div>

                 <div class="form-group">
                     {!! Form::label('category_id', 'Category *') !!}
                     {!! Form::select('category_id', $categories, null, ['class' => 'form-control']) !!}
                 </div>

                <div class="form-group">
                    {!! Form::label('inventory_tag', 'Inventory Tag *') !!}
                    {!! Form::text('inventory_tag', null, ['class' => 'form-control', 'placeholder' => 'barcode']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('serial_number', 'Serial Number') !!}
                    {!! Form::text('serial_number', null, ['class' => 'form-control', 'placeholder' => 'C02M42XPFH05']) !!}
                </div>

                {!! Form::hidden('is_active', 1) !!}
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <div class="form-group">
                    {!! Form::button('Cancel', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                    {!! Form::submit('Add Inventory', ['class' => 'btn btn-primary']) !!}
                </div>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
