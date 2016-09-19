<?php

namespace App\Http\Controllers;

use App\Student;
use App\Resource;
use App\Category;
use App\Transaction;

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
      $students =  Student::with('openTransactionsCount')->get();

      return view('students.index', compact('students'));
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

      return view('students.browse', compact('students'));
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->all());

        return redirect('students');
    }

    public function edit($id)
    {
      $student = Student::findOrFail($id);

      return view('students.edit', compact('student'));
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

        Transaction::create(array(
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
      $transaction = Transaction::findOrFail($request->transaction_id);

      $resource = Resource::findOrFail($transaction->resource_id);
      $resource->is_available = true;
      $resource->save();

      $transaction->returned_at = Carbon::now();
      $transaction->save();

      return redirect('/students/' . $transaction->student->id);
    }

    public function destroy(Student $students)
    {
      $this->authorize('destroy', $students);
      $students->delete();

      return redirect('/students');
    }

    public function destroyTransaction(Request $request, Student $student, Transaction $transaction)
    {
      // $this->authorize('destroy', $transaction);
      $student_id = $transaction->student->id;
      $transaction->delete();

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
      $current_loans = $student->transactions()->with('resource', 'resource.category')->current()->get();
      $history = $student->transactions()->with('resource', 'resource.category')->history()->get();

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

      return view('students.history', compact('student', 'resources'));
    }
  }
