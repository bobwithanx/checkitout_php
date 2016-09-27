<!-- resources/views/inventory.blade.php -->

@extends('layouts.modal')

@section('content')

<div class="modal-content">

    @include('errors.list')

<div class="modal-header">
    <h4>Edit Category</h4>
</div>

<div class="modal-body">
    {!! Form::model($category, ['method' => 'PATCH', 'action' => ['CategoryController@update', $category->id]]) !!}

    @include('admin.categories._form')

</div>
<div class="modal-footer">
	<button data-dismiss="modal" class="btn btn-default">Cancel</button>
	<button type="submit" class="btn btn-primary">Save</button>

    {{ Form::close() }}
</div>

@endsection
