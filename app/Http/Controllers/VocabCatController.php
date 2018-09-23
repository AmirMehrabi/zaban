<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\VocabCat;

class VocabCatController extends Controller
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
        $vocabcats = VocabCat::all();
        return view('admin.vocabcat.index', compact('vocabcats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(VocabCat $vocabcat)
    {
        return view('admin.vocabcat.form', compact('vocabcat'));
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
          'title' => 'required|unique:vocab_cats',
          'picture' => 'required|mimes:jpeg,jpg,png',
      ]);

      if ( $request->hasFile('picture')) {
          // The file
          $file = $request->file('picture');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/picture/category/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $picture = 'picture/category/' . $extention . '/' . $name;
      }

      $album = new VocabCat;

      $album->title = $request->input('title');
      $album->picture = $picture;
      $album->save();

      flash('آلبوم مورد نظر با موفقیت ایجاد شد');

      return Redirect::back();


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
        $vocabcat = VocabCat::findOrFail($id);

        return view('admin.vocabcat.form', compact('vocabcat'));
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
          'title' => 'required|unique:vocab_cats',
          'picture' => 'mimes:jpeg,png|max:500',
      ]);


      if ( $request->hasFile('picture') ) {
          // The file
          $file = $request->file('picture');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/picture/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $picture = 'picture/' . $extention . '/' . $name;
      }

      $album = VocabCat::findOrFail($id);
      $album->title = $request->input('title');
      if ($request->hasFile('picture')) {
        $album->picture = $picture;
      }

      $album->save();

      flash('لغت مورد نظر شما به روز رسانی شد');

      return Redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $album = VocabCat::findOrFail($id);

      $album->delete();

      flash('آلبوم مورد نظر با موفقیت حذف شد.');

      return Redirect::back();
    }
}
