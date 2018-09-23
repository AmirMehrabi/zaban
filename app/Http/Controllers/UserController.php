<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use App\Category;
use App\Result;
use Bican\Roles\Models\Role;
use Illuminate\Support\Facades\Redirect;
use Auth;

class UserController extends Controller
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
      $users = User::all();

      foreach ($users as $key => $user) {
        $user->results = Result::where('user_id', $user->id)->get();
      }
      return view('admin.user.index', compact('users'));
    }


    public function search(Request $request) {


      $users = User::where('name', 'LIKE', '%' . $request->input('keyword') . '%')->orWhere('email', 'LIKE', '%' . $request->input('keyword') . '%')->orderBy('created_at', 'desc')->get();

      return view('admin.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(User $user)
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.user.form', compact('user', 'roles'));
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
          'email' => 'required|email|unique:users',
          'password' => 'required|confirmed',
      ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->active = $request->input('active');
        $user->password = bcrypt($request->input('password'));
        $user->save();

        $user->attachRole($request->input('role'));

        flash('کاربر مورد نظر با موفقیت ایجاد شد');
        return redirect::route('admin.users.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::findOrFail($id);
        $results = Result::where('user_id', $user->id)->get();

        foreach ($user->courseSubscriptions as $CourseSubscription) {
          $CourseSubscription->name = Category::findOrFail($CourseSubscription->category_id);
        }


        return view('admin.user.results', compact('user', 'results'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::findOrFail($id);
        $users = User::all();
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.user.form', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Requests\UpdateUserRequest $request, $id)
    {
      $user = User::findOrFail($id);

      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->active = $request->input('active');
      $user->password = bcrypt($request->input('password'));

      $user->save();

      $user->detachAllRoles();
      $user->attachRole($request->input('role'));

      flash('کاربر شما با موفقیت به روز شد.', 'success');
      return redirect::route('admin.users.index');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        flash('کاربر مورد نظر با موفقیت حذف شد.');

        return redirect::back();
    }
}
