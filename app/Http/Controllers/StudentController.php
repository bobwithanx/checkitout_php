<?php

namespace App\Http\Controllers;

use App\Student;
use App\Resource;
use App\Category;
use App\Loan;

use App\Http\Requests;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;
use App\Repositories\StudentRepository;

use Carbon\Carbon;

class StudentController extends Controller
{
    /**
     * Display a list of all of the user's students.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
      $students =  Student::with('openLoansCount')->get();

      return view('admin.students.index', compact('students'));
    }

    public function autocompleteStudent(Request $request)
    {
      $data = Student::select("first_name", "last_name", "id_number")
      ->where("first_name","LIKE","%{$request->input('query')}%")
      ->orWhere("last_name","LIKE","%{$request->input('query')}%")
      ->orWhere("id_number","LIKE","%{$request->input('query')}%")
      ->get();

      foreach ($data as $query)
      {
        $results[] = [ 'data' => $query->id_number, 'value' => $query->first_name.' '.$query->last_name . ' ('.$query->id_number . ')' ];
      }

      $results_format[] = [ "query" => "Unit", 'suggestions' => $results ];

      return response()->json($results_format[0]);
    }


    /**
     * Display a list of all of the user's students.
     *
     * @param  Request  $request
     * @return Response
     */
    public function browse(Request $request)
    {
      $students =  Student::all();

      return view('admin.students.browse', compact('students'));
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->all());

        return redirect('students');
    }

    public function edit($id)
    {
      $student = Student::findOrFail($id);

      return view('admin.students.edit', compact('student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id, StudentRequest $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
      // $rules = array(
      //   'name'       => 'required',
      // );
      // $validator = Validator::make(Input::all(), $rules);

      //   // process the login
      // if ($validator->fails()) {
      //   return Redirect::to('students/' . $id . '/edit')
      //   ->withErrors($validator)
      //   ->withInput(Input::except('password'));
      // } else {
            // store

        $student = Student::findOrFail($id);
        $student->update($request->all());

            // redirect
        return redirect('students');
      }
    // }

    public function searchStudent(Request $request)
    {
      $student = Student::findByStudentId($request->student_id);
      if(!empty($student)) {
        return redirect('/students/' . $student->id);
      }
      else {
        return redirect()->back();
      }
    }

    public function borrowItem($student_id, Request $request)
    {
      $resource = Resource::findByInventoryTag($request->inventory_tag);

      if(!empty($resource)) {

        Loan::create(array(
          'student_id' => $student_id,
          'resource_id' => $resource->id
        ));

        $resource->is_available = false;
        $resource->save();

        return redirect('/students/' . $student_id);
      }
      else {
        return redirect()->back();
      }
    }

    public function returnItem(Request $request)
    {
      $loan = Loan::findOrFail($request->loan_id);

      $resource = Resource::findOrFail($loan->resource_id);
      $resource->is_available = true;
      $resource->save();

      $loan->returned_at = Carbon::now();
      $loan->save();

      return redirect('/students/' . $loan->student->id);
    }

    public function destroy(Student $students)
    {
      $this->authorize('destroy', $students);
      $students->delete();

      return redirect('/students');
    }

    public function destroyLoan(Request $request, Student $student, Loan $loan)
    {
      // $this->authorize('destroy', $loan);
      $student_id = $loan->student->id;
      $loan->delete();

      return redirect('/student/' . $student_id);
    }

    public function show($id)
    {
      if ($id < 100000) {
        $student = Student::findOrFail($id);
      }
      else {
        $student = Student::findByStudentId($request->student_id);
      }
      $current_loans = $student->loans()->with('resource', 'resource.category')->current()->get();
      $history = $student->loans()->with('resource', 'resource.category')->history()->get();

      // $resources = Resource::available()->lists('name', 'id');

      return view('admin.students.show', compact('student', 'current_loans', 'history', 'resources'));
    }

    public function showProfile($id)
    {
      if ($id < 100000) {
        $student = Student::findOrFail($id);
      }
      else {
        $student = Student::findByStudentId($request->student_id);
      }
      $current_loans = $student->loans()->with('resource', 'resource.category')->current()->get();
      $history = $student->loans()->with('resource', 'resource.category')->history()->get();

      // $resources = Resource::available()->lists('name', 'id');

      return view('students.show', compact('student', 'current_loans', 'history', 'resources'));
    }

    public function import(Request $request)
    {
      $csvFilePath = $request->file('csv')->getRealPath();

      if (($handle = fopen($csvFilePath,'r')) !== FALSE)
      {
        while (($data = fgetcsv($handle, 1000, ',')) !==FALSE)
        {
          $student = new Student();
          $student->last_name = $data[0];
          $student->first_name = $data[1];
          $student->id_number = $data[2];
          $student->save();
        }
        fclose($handle);
      }

      return redirect('/students');
    }

    public function showHistory($id)
    {
      $student = Student::findOrFail($id);
      $resources = Resource::available()->lists('name', 'id');

      return view('admin.students.history', compact('student', 'resources'));
    }
  }
