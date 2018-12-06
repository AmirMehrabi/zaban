<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Subscription;
use Illuminate\Support\Facades\Redirect;

class SubscriptionController extends Controller
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
    public function index()
    {
        $subscription_fees = Subscription::orderBy('created_at', 'desc')->get();

        return view('admin.subscription.index', compact('subscription_fees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Subscription $subscription)
    {
        return view('admin.subscription.form', compact('subscription'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

      $this->validate($request, [
          'name' => 'required',
          'duration' => 'required',
          'price' => 'required',
      ]);


        $subscription = new Subscription;

        $subscription->name = $request->input('name');
        $subscription->duration = $request->input('duration');
        $subscription->price = $request->input('price');

        $subscription->save();

        flash('اشتراک مورد نظر شما با موفقیت ایجاد شد.');

        return redirect(route('admin.subscription.index'));
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
      $subscription = Subscription::findOrFail($id);
      $subscriptions = Subscription::all();
      return view('admin.subscription.form', compact('subscription'));
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

      $this->validate($request, [
          'name' => 'required',
          'duration' => 'required',
          'price' => 'required',
      ]);


      $subscription = Subscription::findOrFail($id);

      $subscription->name = $request->input('name');
      $subscription->duration = $request->input('duration');
      $subscription->price = $request->input('price');

      $subscription->save();


      flash('اشتراک مورد نظر با موفقیت به روز شد', 'success');
      return redirect::route('admin.subscription.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $subscription = Subscription::findOrFail($id);
      $subscription->delete();
      flash('اشتراک مورد نظر با موفقیت حذف شد.');

      return redirect::back();
    }
}
