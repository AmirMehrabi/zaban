<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Payment;
use App\User;
use DB;

class TransactionController extends Controller
{



      /**
       * Create a new controller instance.
       *
       * @return void
       */
      public function __construct()
      {
          $this->middleware('auth');
          if (Auth::check()) {
            if (!Auth::user()->is('admin')) {
              flash('شما مجوز دسترسی به صفحهٔ مدیریت را ندارید');
              return Redirect::to(url('login'))->send();
            }
          }
      }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

      $transactions = DB::table('gateway_transactions')->get();
      foreach ($transactions as $transaction) {

        if (count(Payment::where('ref_id', $transaction->ref_id)->get())) {
          $transaction->pay = Payment::where('ref_id', $transaction->ref_id)->first();
          $transaction->name = User::where('id', $transaction->pay->user_id)->first()->name;
        }
        else {
          $transaction->name = 'نامشخص';
        }

      }
      return view('admin.transaction.index', compact('transactions'));
    }

    public function search(Request $request) {
      $transactions = DB::table('gateway_transactions')->get();

      foreach ($transactions as $transaction) {
        if (count(Payment::where('ref_id', $transaction->ref_id)->get())) {
          $transaction->pay = Payment::where('ref_id', $transaction->ref_id)->first();
          $transaction->name = User::where('id', $transaction->pay->user_id)->first()->name;
        }
        else {
          $transaction->name = 'نامشخص';
        }

      }


      $transactions = DB::table('gateway_transactions')->where('tracking_code', 'LIKE', '%' . $request->input('keyword') . '%')->orWhere('id', 'LIKE', $request->input('keyword'))->orderBy('created_at', 'desc')->get();

      return view('admin.transaction.index', compact('transactions'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
