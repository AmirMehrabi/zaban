<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\Vocabulary;
use App\VocabCat;
use Auth;
use Baum\MoveNotPossibleException;

class VocabController extends Controller
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
      $vocabs = Vocabulary::all();
      return view('admin.vocab.index', compact('vocabs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Vocabulary $vocab)
    {
        $vocabcats = Vocabcat::pluck('title', 'id');
        $orderPages = Vocabulary::all();
        return view('admin.vocab.form', compact('vocab', 'vocabcats', 'orderPages'));
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
          'faName' => 'required',
          'engName' => 'required',
          'vocabcat_id' => 'required',
          'picture' => 'required|mimes:jpeg,png|max:500',
          'pronunciation' => 'required|mimes:mpga,ogg,wav|max:1024',
      ]);

      if ( $request->hasFile('picture') &&  $request->hasFile('pronunciation')) {
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

      if ( $request->hasFile('pronunciation') ) {
          // The file
          $file = $request->file('pronunciation');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pronunciation')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/audio/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $sound = 'audio/' . $extention . '/' . $name;
      }

      $vocab = new Vocabulary;
      $vocab->vocabcat_id = $request->input('vocabcat_id');
      $vocab->faName = $request->input('faName');
      $vocab->engName = $request->input('engName');
      $vocab->picture = $picture;
      $vocab->pronunciation = $sound;

      $vocab->save();

      $this->updatePageOrder($vocab, $request);

      flash('واژهٔ جدید با موفقیت افزوده شد');

      return Redirect::route('admin.vocabs.edit', $vocab->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vocab = Vocabulary::findOrFail($id);
        $vocabcat = Vocabulary::findOrFail($id)->vocabcat_id;
        $vocabcats = Vocabcat::pluck('title', 'id');
        $orderPages = Vocabcat::where('id', $vocabcat)->first()->vocabs;
        return view('admin.vocab.form', compact('vocab', 'vocabcats', 'vocabcat', 'orderPages'));
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
          'faName' => 'required',
          'engName' => 'required',
          'vocabcat_id' => 'required',
          'picture' => 'mimes:jpeg,png|max:500',
          'pronunciation' => 'mimes:mpga,ogg,wav|max:1024',
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

      if ( $request->hasFile('pronunciation') ) {
          // The file
          $file = $request->file('pronunciation');
          // File extension
          $extention = $file->getClientOriginalExtension();
          // File name ex: my-audio-song.mp3
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pronunciation')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          // Path
          $public_path = public_path();
          // Save location /public/audio/mp3
          $location = $public_path . '/audio/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $sound = 'audio/' . $extention . '/' . $name;
      }

      $vocab = Vocabulary::findOrFail($id);
      if ($response = $this->updatePageOrder($vocab, $request)) {
        return $response;
      }


      $vocab->faName = $request->input('faName');
      $vocab->engName = $request->input('engName');
      $vocab->vocabcat_id = $request->input('vocabcat_id');

      if ($request->hasFile('pronunciation')) {
        $vocab->pronunciation = $sound;
      }

      if ($request->hasFile('picture')) {
        $vocab->picture = $picture;
      }

      $vocab->save();


      flash('لغت مورد نظر شما به روز رسانی شد');

      return Redirect::route('admin.vocabs.edit', $vocab->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vocab = Vocabulary::findOrFail($id);

        $vocab->delete();

        flash('واژهٔ مورد نظر با موفقیت حذف شد.');

        return Redirect::back();
    }


    protected function updatePageOrder(Vocabulary $vocabulary, Request $request)
    {
      if ($request->has('order', 'orderPage')) {
        try {
          $vocabulary->updateOrder($request->input('order'), $request->input('orderPage'));
        } catch (MoveNotPossibleException $e) {
          flash('نمیتوان یک صفحه را زیرمجموعهٔ خودش قرار داد', 'danger');
          return redirect::back();
        }
      }
    }
}
