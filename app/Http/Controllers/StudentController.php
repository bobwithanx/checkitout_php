<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;

use App\Student;
use App\Group;
use App\GradeLevel;
use App\Transaction;
use App\Repositories\StudentRepository;

class StudentController extends Controller
{
    /**
     * The student repository instance.
     *
     * @var StudentRepository
     */
    protected $students;

    /**
     * Create a new controller instance.
     *
     * @param  StudentRepository  $tasks
     * @return void
     */
    public function __construct(StudentRepository $students)
    {
        $this->middleware('auth');

        $this->students = $students;
    }

    /**
     * Display a list of all of the user's students.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('students.index', array(
            'students' => Student::all(),
            'groups' => Group::all(),
            'grade_levels' => GradeLevel::all(),
        ));
    }
    
    public function store(Request $request)
    {
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'id_number' => 'required|max:255',
            'group_id' => 'integer',
            'grade_level_id' => 'integer',
            'is_active' => 'boolean',
            ]);

        Student::create(array(
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'id_number' => $request->id_number,
            'group_id' => $request->group_id,
            'grade_level_id' => $request->grade_level_id,
            'is_active' => $request->is_active,
            ));

        return redirect('/students');
    }

    public function borrow(Request $request)
    {
        // dd($request->all());
        Transaction::create($request->all());

        // $this->validate($request, [
        //     'student_id' => 'integer',
        //     'resource_id' => 'integer',
        //     ]);

        // Transaction::create(array(
        //     'student_id' => $request->student_id,
        //     'resource_id' => $request->resource_id,
        // ));

        return redirect('/student/' . $request->student_id);
    }

    public function destroy(Request $request, Student $student)
      {
          $this->authorize('destroy', $student);
          $student->delete();

          return redirect('/students');
      }

      public function show($id)
      {  
          $student = Student::findOrFail($id);
          $resources = \App\Resource::lists('name', 'id');
      
          return view('students.show', compact('student', 'resources'));
      }
}
