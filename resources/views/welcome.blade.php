@extends('layouts.app')

@section('content')

<script>
//once the modal has been shown
$('#lookupStudentModal').on('shown.bs.modal', function() {
           //Get the datatable which has previously been initialized
           var dataTable= $('#studentTable').DataTable();
            //recalculate the dimensions
            dataTable.columns.adjust().responsive.recalc();

        });
</script>

<div class="container">
    <div class="row">
        <div class="col-xs-8 col-xs-offset-2 col-sm-6 col-sm-offset-3">
            <div class="row">
            @if (Auth::guest())
                <div class="panel panel-default">
                    <div class="panel-heading">Dashboard</div>
                    <div class="panel-body">
                        <a href="{{ url('/login') }}">Login</a>
                    </div>
                </div>
            @else
                <div class="panel panel-info">
                    <div class="panel-heading">
                        Check Out Equipment
                    </div>

                    <div class="panel-body">
                        @if ($errors->count())
                            <!-- Display Validation Errors -->
                            @include('common.errors')
                        @endif
                        {!! Form::open(['url' => '/students/search']) !!}
                            <div class="input-group" id="student_lookup">
                            <span class="input-group-addon" id="basic-addon1">
                                  <i class="fa fa-user"></i>
                                </span>
                                {!! Form::text('student_id', null, ['placeholder' => 'Enter a STUDENT ID number', 'class'=>'form-control typeahead', 'id'=>'student_id', 'autofocus', 'autocomplete'=>'off']) !!}
                                <span class="input-group-btn">
                                    {{Form::button('<i class="fa fa-search"></i>', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
                                </span>
                                </div><!-- /input-group -->
                        {!! Form::close() !!}
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        Current Loans
                    </div>
                    <table class="table table-hover" id="transactionTable">
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
                                    {{ $student->open_transactions()->count() }} {{ str_plural('item', $student->open_transactions()->count()) }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @if (Auth::user()->name == 'Admin')
                    <div class="panel panel-default">
                        <div class="panel-heading">Dashboard</div>
                        <div class="panel-body">
                            <a href="{{ url('/admin') }}">Setup</a>
                        </div>
                    </div>
                </div>
                @endif
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
