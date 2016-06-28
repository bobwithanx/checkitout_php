<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container page-content">
  <div>
    <a href="{{ url('/admin') }}">Dashboard</a> > <a href="{{ url('/resources') }}">Inventory</a> > {{ $resource->name }}
  </div>

  <h3 class="sub-header">{{ $resource->name }} <small>{{ $resource->inventory_tag }}</small></h3>
@if( ! empty($resource['serial_number']))
    <div>Serial Number: {{ $resource->serial_number }}</div>
@endif
         
  <div class="row">
    <div class="col-md-12">

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
    </div>

    <!-- Current Equipment -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Lending History
            </div>

            <div class="panel-body">
                <table class="table table-hover table-condensed">

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

                            <tr>
                                <!-- Item Name -->
                                <td class="table-text"></td>
                                <td class="table-text"></td>
                                <td class="table-text"></td>

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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
