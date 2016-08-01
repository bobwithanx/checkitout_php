@extends('layouts.app')

@section('content')

<div class="container">
  <div class="row">
    <div class="col-sm-3 col-md-3 col-lg-2">
      @include('layouts.navigation-db', [$student_count, $resource_count, $category_count])
  </div>

  <div class="col-sm-9 col-md-9 col-lg-10">
    <div class="panel panel-default">
                <div class="panel-heading">Admin</div>
                <div class="list-group">
                <a class="list-group-item" href="{{ url('/resources/') }}">Resources <i class="fa fa-fw fa-angle-right" aria-hidden="true"></i><span class="badge">{{ $resources->count() }}</span></a>
                    <a class="list-group-item" href="{{ url('/students/') }}">Students <i class="fa fa-fw fa-angle-right" aria-hidden="true"></i><span class="badge">{{ $students->count() }}</span></a>
                    <a class="list-group-item" href="{{ url('/categories/') }}">Categories <i class="fa fa-fw fa-angle-right" aria-hidden="true"></i><span class="badge">{{ $categories->count() }}</span></a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
