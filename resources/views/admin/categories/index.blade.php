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
        $('#categoryTable').DataTable({
            "lengthChange": false,
            "pageLength": 15,
            "order": [[ 0, 'asc' ]],
        } );
    });
</script>

<style>
    .table
    { border-left: none;
        border-right: none;
        border-top: none;}

/*        .dataTables_wrapper .dataTables_filter {
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
@include('errors.list')

  <div class="row">
    <div class="col-sm-12">

    <!-- Bootstrap Boilerplate... -->

{{--     <div class="panel-body">
        Display Validation Errors
        @include('common.errors')
    </div>
 --}}
    <!-- Current Equipment -->
        <div class="panel panel-default">
            <div class="panel-heading">
                <span class="fa fa-fw fa-tags"></span> Categories
                <div class="pull-right">
                <a class="alert" href="#" data-toggle="modal" data-target="#addCategoryModal"><i class="fa fa-plus-circle"></i> add category</a>
                </div>
            </div>
            <div class="panel-body">

                <table class="table table-hover table-condensed" id="categoryTable">

                    <!-- Table Headings -->
                    <thead>
                          <th>Name</th>
                          <th>Icon</th>
                          <th>Items</th>
                          <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <!-- Item Name -->
                                <td class="table-text">{{ $category->name }}</td>
                                <td class="table-text"><i class="fa fa-fw {{ $category->icon }}"></i>&nbsp;&nbsp;<span class="text-muted">{{ $category->icon }}</span></td>
                                <td class="table-text text-muted">{{ $category->resources()->count() }} <a href="{{ url('/admin/resources?filter='. urlencode($category->name))}}"><i class="fa fa-arrow-circle-right"></i></a></td>

                                <!-- Delete Button -->
                                <td>
                                <a href="{{route('admin.categories.edit',$category->id)}}" data-toggle="modal" data-target="#addCategoryModal" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>

{!! Form::open(['method' => 'DELETE', 'action' => ['CategoryController@destroy', $category->id], 'id'=>'delete-category-'.$category->id.'-form', 'style'=>'display:inline;']) !!}

<a href="#" class="confirm-box btn btn-danger btn-xs" id="delete-category-{{ $category->id }}"><i class="fa fa-trash"></i></a>
                                        </button>
                                        {{ Form::close() }}
                                    </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                </div>
        </div>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" role="dialog"
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
                    Add Category
                </h4>
            </div>

            {!! Form::open(['url' => 'categories']) !!}

            <div class="modal-body">
                @include('admin.categories._form')
            </div>

                <div class="modal-footer">
                    <div class="form-group">
                        {!! Form::button('Cancel', ['class' => 'btn btn-default', 'data-dismiss' => 'modal']) !!}
                        {!! Form::submit('Add Category', ['class' => 'btn btn-primary']) !!}
                    </div>
                </div>
            {!! Form::close() !!}
    </div>
</div>

@endsection
