<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Student;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $student_count = Student::all()->count();
        $resource_count = Resource::all()->count();

        return view('admin')->with(array('student_count'=>$student_count, 'resource_count'=>$resource_count));
    }
}
