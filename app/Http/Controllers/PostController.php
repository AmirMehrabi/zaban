<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\News;
use App\User;

class PostController extends Controller
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
        $posts = News::orderBy('created_at', 'desc')->paginate(9);
        return view('admin.post.index', compact('posts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(News $post)
    {
        $authors = User::pluck('name', 'id');
        return view('admin.post.form', compact('post', 'authors'));
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
          'author_id' => 'required',
          'category_id' => 'required',
          'picture' => 'required|mimes:jpeg,png|max:500',
          'excerpt' => 'required',
          'body' => 'required',
          'is_special' => 'required',
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
      }

      $post = new News;
      $post->title = $request->input('title');
      $post->author_id = $request->input('author_id');
      $post->category_id = $request->input('category_id');
      $post->picture = $picture;
      $post->excerpt = $request->input('excerpt');
      $post->body = $request->input('body');
      $post->is_special = $request->input('is_special');

      $post->save();

      flash('پست مورد نظر شما با موفقیت ایجاد شد');

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
        $post = News::findOrFail($id);
        $authors = User::pluck('name', 'id');
        return view('admin.post.form', compact('post', 'authors'));
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
        $post = News::findOrFail($id);
        $post->fill($request->all());
        $post->save();

        flash('صفحهٔ مورد نظر با موفقیت به روز شد');
        return redirect::route('admin.posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = News::findOrFail($id);
        $post->delete();

        flash('نوشته مورد نظر با موفقیت حذف شد.');

        return redirect::back();
    }
}
