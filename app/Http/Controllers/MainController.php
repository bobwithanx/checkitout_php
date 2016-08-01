<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Student;
use App\Category;
use App\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;


class MainController extends Controller
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

    public function borrow(Request $request)
    {
        $student = Student::findByStudentId($request->student_id);

        return redirect('/students/'.$student->id);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $students = Transaction::all()
        ->where('returned_at', null);
        // ->groupBy('student.full_name');

        // $resources = Transaction::all()
        // ->where('returned_at', null);
        // ->groupBy('resource.category.name');
        // $categories = Category::all();
        $resources = Resource::all()->where('transactions.returned_at', null);
        $categories = Category::all()->where('resources.transactions.returned_at', null)->sortBy('name');

        $student_count = Student::all()->count();
        $resource_count = Resource::all()->count();
        $category_count = Category::all()->count();

        return view('dashboard', compact('students', 'resources', 'categories', 'student_count', 'resource_count', 'category_count'));
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function reports()
    {
        $students = Transaction::all()
        ->where('returned_at', null);
        // ->groupBy('student.full_name');

        // $resources = Transaction::all()
        // ->where('returned_at', null);
        // ->groupBy('resource.category.name');
        // $categories = Category::all();
        $resources = Resource::all()->where('transactions.returned_at', null);
        $categories = Category::all()->where('resources.transactions.returned_at', null)->sortBy('name');

        return view('reports', compact('students', 'resources', 'categories'));
    }

}
