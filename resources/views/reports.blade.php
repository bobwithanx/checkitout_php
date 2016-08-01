@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4">
         <div class="panel panel-default">
            <div class="panel-heading">
                On Loan
                <span class="badge pull-right"></span>
            </div>
            <ul class="list-group">
                @foreach ($categories as $category)
                @if ($category->resources()->onLoan()->count())
                <li class="list-group-item">
                    {{ $category->name }}
                    <a href="{{ url('resources/'.$category->id) }}" class="badge">{{ $category->resources()->onLoan()->count() }}</a>
                </li>
                @endif
                @endforeach
            </ul>
        </div>
    </div>
    <div class="col-md-4">
     <div class="panel panel-default">
        <div class="panel-heading">
        <a href="{{ url('resources') }}">All Resources
            <span class="badge pull-right">{{ $resources->count() }}</span></a>
        </div>
        <ul class="list-group">
            @foreach ($categories as $category)
            <a href="{{ url('resources?filter='. urlencode($category->name))}}" class="list-group-item">
                <i class="fa fa-fw {{ $category->icon }}"></i> {{ $category->name }}
                <span class="badge">{{ $category->resources()->count() }}</span>
            </a>
            @endforeach
        </ul>
    </div>
</div>
</div>
</div>
@endsection
