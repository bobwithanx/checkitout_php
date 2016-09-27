@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-xs-12 col-sm-10 col-sm-offset-1">
            @if (Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        <a href="{{ url('/login') }}">Login</a>
                    </div>
                </div>
            @else
                <div class="panel panel-info  welcome-panel">
                    <div class="panel-heading panel-well">
                        <h2 class="text-center">Equipment Check Out</h2>
                        {!! Form::open(['url' => '/students/search', 'id'=>'student_lookup']) !!}
                            <div class="input-group" id="lookup_fields">
                            <span class="input-group-addon" id="basic-addon1">
                                  <i class="fa fa-user"></i>
                                </span>
                                {!! Form::text('student_id', null, ['placeholder' => 'Search for name or Student ID', 'class'=>'form-control typeahead', 'id'=>'student_id', 'autofocus', 'autocomplete'=>'off']) !!}
                                <span class="input-group-btn">
                                    {{Form::button('<i class="fa fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
                                </span>
                                </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div>
                </div>

                @if ($errors->count())
                <!-- Display Validation Errors -->
                @include('common.errors')
                @endif

                </div>
                <div class="col-xs-12 col-sm-10 col-sm-offset-1">
                    @if ($students->count())
                    <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Loans
                    </div>
                    <table class="table" id="currentTable">
                        <!-- Table Body -->
                        <tbody>
                            @foreach ( $students as $student )
                            <tr class="table-row">
                                <!-- Equipment Name -->
                                <td class="table-text">
                                    <a href="{{ url('students/' . $student->id) }}">{{ $student->full_name }}</a>
                                </td>
                                <td class="table-text text-muted">
                                    {{ $student->id_number }}
                                </td>
                                <td>
                                    <span class="badge">{{ $student->open_transactions()->count() }} {{ str_plural('item', $student->open_transactions()->count()) }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @endif
                </div>

                @if (Auth::user()->name == 'Admin')
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
                        <div class="panel-body">
                            <a href="{{ url('/admin') }}">Setup</a>
                        </div>
                    </div>
                @endif
            </div>

            @endif
        </div>
    </div>
</div>

<script type="text/javascript">
    $('input.typeahead').autocomplete({
        serviceUrl: '{{ route('autocompleteStudent') }}',
        onSelect: function (suggestion) {
            $("#student_id").val(suggestion.data);
        },
    })
</script>

@endsection
