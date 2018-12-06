<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Group;
use App\Post;

class GroupController extends Controller
{


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
      $groups = Group::paginate(9);
      return view('admin.group.index', compact('groups'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Group $group)
    {
      $posts = Post::all()->lists('title', 'id');
      $group_posts = [];
      return view('admin.group.form', compact('group', 'posts', 'group_posts'));
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
          'name' => 'required|max:255',
          'description' => 'required',
      ]);

        $group = new Group;
        $group->name = $request->input('name');
        $group->description = $request->input('description');

        $group->save();
        $group->posts()->detach();
        $group->posts()->attach($request->input('posts'));

        flash('دسته بندی مورد نظر شما با موفقیت ذخیره شد');
        return redirect(route('admin.groups.index'));
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
      $group = Group::findOrFail($id);
      $posts = Post::all()->lists('title', 'id');
      $group_posts = $group->posts->pluck('id')->toArray();

      return view('admin.group.form', compact('group', 'posts', 'group_posts'));
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
          'name' => 'required|max:255',
          'description' => 'required',
      ]);

      $group = Group::findOrFail($id);
      $group->fill($request->only('name', 'description'));


      $group->save();
      $group->posts()->detach();
      $group->posts()->attach($request->input('posts'));
      flash('دسته بندی مورد نظر شما با موفقیت به روز شد');
      return redirect(route('admin.groups.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $group = Group::findOrFail($id);
      $group->delete();

      flash('دسته بندی مورد نظر با موفقیت حذف شد.');

      return redirect::back();
    }
}
