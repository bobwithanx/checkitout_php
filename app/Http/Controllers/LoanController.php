<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Category;
use App\Loan;


use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;
use App\Repositories\ResourceRepository;

use Carbon\Carbon;

class LoanController extends Controller
{
    /**
     * Display a list of all of the user's students.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $loans = Loan::with('student', 'resource')->get();

        return view('admin.loans.index', compact('loans'));
    }

    public function destroy($id){
      if($id){
        $loan = Loan::findOrFail($id);
        $loan->delete();
      }
      return redirect()->back();
  }


}
