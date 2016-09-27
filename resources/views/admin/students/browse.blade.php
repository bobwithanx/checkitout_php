<!-- resources/views/students/index.blade.php -->

@extends('layouts.modal')

@section('content')

<script>
$(document).ready(function(){
    $('#studentTable').DataTable({
        "lengthChange": false,
        "order": [[ 1, 'asc' ]],
    } );
});
</script>

<style>

    .table
    { border-left: none;
        border-right: none;
        border-top: none;}
  </style>

<div class="modal-content">
  <div class="row">

    <div class="col-sm-12">
      <div class="panel panel-default">
        <div class="panel-heading">
            <span class="fa fa-fw fa-users"></span> Students
    </div>
    <div class="panel-body">

            <table class="table table-hover table-condensed" id="studentTable">
                <!-- Table Headings -->
                <thead>
                    <th>Name</th>
                    <th>ID Number</th>
                    <th>Loans</th>
                    @if (Auth::user()->name == 'Admin')
                    <th>Actions</th>
                    @endif
                </thead>
                <!-- Table Body -->
                <tbody>@foreach ($students as $student)
                    <tr>
                        <!-- Equipment Name -->
                        <td class="table-text">
                            <a href="{{ url('students/'.$student->id) }}">{{ $student->full_name }}</a>
                        </td>
                        <td class="table-text">{{ $student->id_number }}</td>
                        <td class="table-text">{{ $student->transactions_current()->count() }}
                            <span class="text-muted">({{ $student->transactions()->count() }} total)</span>
                        </td>
                        <!-- Delete Button -->
                            @if (Auth::user()->name == 'Admin')
                            <td>
                            <a href="{{route('students.edit', $student->id)}}" data-toggle="modal" data-target="#addStudentModal" class="btn btn-xs btn-warning"><i class="fa fa-pencil"></i></a>
                                {!! Form::open(['method' => 'DELETE', 'action' => ['StudentController@destroy', $student->id], 'id'=>'delete-student-'.$student->id.'-form', 'style'=>'display:inline;']) !!}

                                <a href="#" class="confirm-box btn btn-danger btn-xs" id="delete-student-{{ $student->id }}"><i class="fa fa-trash"></i></a>
                            {{ Form::close() }}
                        </td>
                        @endif
                    </tr>@endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Add Student</h4>
            </div>

            {!! Form::open(['url' => 'students']) !!}

            <div class="modal-body">
                @include('students._form')
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Student</button>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="importStudentsModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <!-- Modal Header -->
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                    <span class="sr-only">Close</span>
                </button>
                <h4 class="modal-title" id="myModalLabel">Import Students</h4>
            </div>
            
            <!-- New Student Form -->
            {!! Form::open(['url' => '/students/import', 'files' => true]) !!}
                <!-- Modal Body -->
                <div class="modal-body">
                    <p>Upload a text file with a list of the students (one per line) that you would like to import, using the following format:</p>
                    <code>
                        last_name,first_name,id_number
                    </code>
                    <div>&nbsp;
                    </div>
                    <div class="form-group">
                        {!! Form::label('Import File *') !!}
                        {!! Form::file('csv', null) !!}
                    </div>
                </div>
                                                
                <!-- Modal Footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Import Students</button>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>

@endsection
