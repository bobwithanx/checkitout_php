@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    <div class="list-group">
                        <a class="list-group-item" href="{{ url('/resources/') }}">Inventory <i class="fa fa-fw fa-angle-right" aria-hidden="true"></i><span class="badge">{{ $resource_count }}</span></a>
                        <a class="list-group-item" href="{{ url('/students/') }}">Students <i class="fa fa-fw fa-angle-right" aria-hidden="true"></i><span class="badge">{{ $student_count }}</span></a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
