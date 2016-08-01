<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container page-content">
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
    <div class="panel panel-default" style="max-height: 100vmin; overflow-y: scroll;">
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
