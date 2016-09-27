<?php

namespace App\Http\Controllers;

use App\Resource;
use App\Category;
use App\Transaction;


use App\Http\Requests;
use App\Http\Requests\ResourceRequest;
use Illuminate\Http\Request;
use Illuminate\HttpResponse;
use App\Http\Controllers\Controller;
use App\Repositories\ResourceRepository;

use Carbon\Carbon;

class TransactionController extends Controller
{
    /**
     * Display a list of all of the user's students.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $transactions = Transaction::with('student', 'resource')->get();

        return view('admin.transactions.index', compact('transactions'));
    }

    public function destroy($id){
      if($id){
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();
      }
      return redirect()->back();
  }


}
