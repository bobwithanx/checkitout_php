<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Student;
use App\Category;
use App\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;


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

    public function home()
    {
        // $students = DB::table('students')->where('transactions.returned_at', null);
       $students = Transaction::with('student')->where('returned_at', null)->get();

       $students = Student::has('open_transactions')->get();
       // dd($students->toArray());

        // $students = Student::whereNull('transactions.returned_at');

        return view('welcome', compact('students'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function autocomplete(Request $request)
    {
        $data = Student::select("first_name", "last_name", "id_number")
        ->where("first_name","LIKE","%{$request->input('query')}%")
        ->orWhere("last_name","LIKE","%{$request->input('query')}%")
        ->orWhere("id_number","LIKE","%{$request->input('query')}%")
        ->get();

        return response()->json($data);
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
