<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Faq;
use Illuminate\Support\Facades\Redirect;

class FaqController extends Controller
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
      $faqs = Faq::paginate(9);
      return view('admin.faq.index', compact('faqs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Faq $faq)
    {
        return view('admin.faq.form', compact('faq'));
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
          'question' => 'required',
          'answer' => 'required',
      ]);

      $faq = new Faq;
      $faq->question = $request->input('question');
      $faq->answer = $request->input('answer');
      $faq->save();

      flash('سوال و جواب مورد نظر شما با موفقیت ایجاد شد');

      return Redirect::route('admin.faqs.index');
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
        $faq = Faq::findOrFail($id);

        return view('admin.faq.form', compact('faq'));
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
          'question' => 'required',
          'answer' => 'required',
      ]);

      $faq = Faq::findOrFail($id);

      $faq->fill($request->all());

      $faq->save();

      flash('صفحهٔ مورد نظر با موفقیت به روز شد');

      return redirect::back();
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
