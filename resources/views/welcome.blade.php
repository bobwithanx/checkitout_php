@extends('layouts.app')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.1/bootstrap3-typeahead.min.js"></script>

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
                            <div class="input-group">
                                <span class="input-group-btn">
                                <a href="{{ url('/students/browse') }}" data-toggle="modal" data-target="#lookupStudentModal" class="btn btn-default"><i class="fa fa-search"></i></a>
                                </span>
                                {!! Form::text('student_id', null, ['placeholder' => 'Scan or type a STUDENT ID number', 'class'=>'typeahead form-control', 'id'=>'student_id', 'autofocus', 'autocomplete'=>'off']) !!}
                                <span class="input-group-btn">
                                    {{Form::button('<i class="fa fa-arrow-right"></i>', array('type' => 'submit', 'class' => 'btn btn-primary'))}}
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

{{-- <script type="text/javascript">

  $(document).ready(function () {

      $('.typeahead').autocomplete({
        source:'{!!URL::route('autocomplete')!!}',
        minlength:1,
        autoFocus:true,
        select:function(e,ui)
        {
          alert(ui);
      }
  });
  });
</script>

 --}}


<script type="text/javascript">
    var path = "{{ route('autocomplete') }}";
    $('input.typeahead').typeahead({
        source:  function (query, process) {
            return $.get(path, { query: query }, function (data) {
                return process(data);
            });
        },
        displayText: function(item){ return item.id_number + ' - ' + item.first_name + ' ' + item.last_name;},
        // displayText: function(item){ return item.id_number;},
        // afterSelect: function(val) { this.$element.val(""); },
    });

</script>


<!-- Modal -->
<div class="modal fade" id="lookupStudentModal" tabindex="-1" role="dialog" aria-labelledby="lookupStudentModal" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Browse Students</h4>
            </div>
            <!-- Edit Student Form -->
            <div class="modal-body">

                </div>
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>{{ Form::close() }}
            </div>
        </div>
    </div>

@endsection
