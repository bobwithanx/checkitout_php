<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Student;
use App\Category;

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
        $students = Student::all();
        $resources = Resource::all();
        $categories = Category::all();

        $student_count = Student::all()->count();
        $resource_count = Resource::all()->count();
        $category_count = Category::all()->count();

        return view('admin', compact('students', 'resources', 'categories', 'student_count', 'resource_count', 'category_count'));
    }
}
