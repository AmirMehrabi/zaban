<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use App\User;
use App\Post;
use Auth;
use Baum\MoveNotPossibleException;

class PageController extends Controller
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
      $pages = Post::paginate(9);
      return view('admin.page.index', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
      $authors = User::pluck('name', 'id');
      $orderPages = Post::all();
      return view('admin.page.form', compact('post', 'orderPages', 'authors'));
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
          'title' => 'required',
          'excerpt' => 'required',
          'body' => 'required',
          'is_special' => 'required',
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
          $location = $public_path . '/posts/picture/' . $extention;
          // Move file to /public/audio/mp3 and save it as my-audio-song.mp3
          $file->move($location, $name);
          // Save link to the file /audio/mp3/my-audio-song.mp3
          // So in your view you can link to it.
          $picture = 'posts/picture/' . $extention . '/' . $name;

          $post->picture = $picture;
      }

      $post = new Post;
      $post->title = $request->input('title');
      $post->author_id = 1;
      $post->excerpt = $request->input('excerpt');
      $post->body = $request->input('body');
      $post->is_special = $request->input('is_special');

      $post->save();

      $this->updatePageOrder($post, $request);



      flash('پست مورد نظر شما با موفقیت ایجاد شد');

      return Redirect::route('admin.pages.index');
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
      $post = Post::findOrFail($id);
      $authors = User::pluck('name', 'id');
      $orderPages = Post::all();
      return view('admin.page.form', compact('post', 'authors', 'orderPages'));
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
          'title' => 'required',
          'excerpt' => 'required',
          'body' => 'required',
          'picture' => 'mimes:jpeg,png|max:500',
      ]);
      $post = Post::findOrFail($id);

      if ($response = $this->updatePageOrder($post, $request)) {
        return $response;
      }
      $post->fill($request->all());

      $post->save();



      flash('صفحهٔ مورد نظر با موفقیت به روز شد');


      return redirect::route('admin.pages.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $post = Post::findOrFail($id);

      foreach ($post->children as $child) {
        $child->makeRoot();
      }
      $post->delete();

      flash('نوشته مورد نظر با موفقیت حذف شد.');

      return redirect::back();
    }


    protected function updatePageOrder(Post $post, Request $request)
    {
      if ($request->has('order', 'orderPage')) {
        try {
          $post->updateOrder($request->input('order'), $request->input('orderPage'));
        } catch (MoveNotPossibleException $e) {
          flash('نمیتوان یک صفحه را زیرمجموعهٔ خودش قرار داد', 'warning');
          return redirect::back();
        }

      }
    }
}
