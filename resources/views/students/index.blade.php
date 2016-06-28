<!-- resources/views/students/index.blade.php -->

@extends('layouts.app')

@section('content')

<div class="container page-content">
  <div>
    <a href="{{ url('/admin') }}">Dashboard</a> > Students
  </div>

  <h3 class="sub-header">Students</h3>

  <div class="row">
    <div class="col-md-12">
        <div class="pull-right">
            <a class="alert" href="#" data-toggle="modal" data-target="#addStudentModal">Add Student</a>
        </div>
    </div>
    <div class="col-md-12">

    <!-- Bootstrap Boilerplate... -->

    <div class="panel-body">
        <!-- Display Validation Errors -->
        @include('common.errors')
    </div>

    <!-- Current Student -->
    @if (count($students) > 0)
        <div class="panel panel-default">
            <div class="panel-heading">
                Current Students
            </div>

            <div class="panel-body">
                <table class="table table-hover table-condensed">

                    <!-- Table Headings -->
                    <thead>
                        <th>Person</th>
                        <th>ID Number</th>
                        <th>Group</th>
                        <th>Grade Level</th>
                        <th>Current Loans</th>
                        <th>Actions</th>
                    </thead>

                    <!-- Table Body -->
                    <tbody>
                        @foreach ($students as $student)
                            <tr>
                                <!-- Equipment Name -->
                                <td class="table-text"><a href="{{ url('student/'.$student->id) }}">{{ $student->first_name }} {{ $student->last_name }}</a></td>
                                <td class="table-text">{{ $student->id_number }}</td>
                                <td class="table-text">{{ $student->group->name }}</td>
                                <td class="table-text">{{ $student->grade_level->name }}</td>
                                <td class="table-text">{{ $student->transactions()->count() }}</td>

                                <!-- Delete Button -->
                                <td>
                                    <form action="{{ url('student/'.$student->id) }}" method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}

                                        <button type="submit" id="delete-student-{{ $student->id }}" class="btn btn-xs btn-danger">
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
    @endif

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="addStudentModal" tabindex="-1" role="dialog" 
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
                    Add Student
                </h4>
            </div>
            
            <!-- New Student Form -->
            <form action="{{ url('student') }}" method="POST" class="form-horizontal">
                {{ csrf_field() }}
 
            <!-- Modal Body -->
            <div class="modal-body">
 
                <!-- Equipment Name -->
                <div class="form-group">
            <label for="first_name">First Name *</label>
                    <input type="text" name="first_name" id="first_name" class="form-control" placeholder="Calvin">
                </div>
                <div class="form-group">
            <label for="last_name">Last Name *</label>
                    <input type="text" name="last_name" id="last_name" class="form-control" placeholder="Camera">
                </div>
                <div class="form-group">
            <label for="id_number">ID Number *</label>
                    <input type="text" name="id_number" id="id_number" class="form-control" placeholder="BARCODE">
                </div>
                <div class="form-group">
            <label for="group_id">Group</label>
                    <select class="form-control" name="group_id" id="group_id">
                        <option value="" selected></option>
                        @foreach ($groups as $group)
                            <option value="{{ $group->id }}">{{ $group->name}}</option>
                        @endforeach
                    </select>
                </div>
                    <div class="form-group">
                <label for="grade_level_id">Grade Level</label>
                        <select class="form-control" name="grade_level_id" id="grade_level_id">
                            <option value="" selected></option>
                            @foreach ($grade_levels as $grade_level)
                                <option value="{{ $grade_level->id }}">{{ $grade_level->name}}</option>
                            @endforeach
                        </select>
                    </div>
            <input type="hidden" name="is_active" id="is_active" class="form-control" checked value=1>
            </div>

            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">
                    Cancel
                </button>
                <button type="submit" class="btn btn-primary">
                    Add Student
                </button>
            </div>
            </form>
        </div>
    </div>
</div>



@endsection
