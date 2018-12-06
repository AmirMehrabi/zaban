<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Category;
use App\Course;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Lesson;
use Baum\MoveNotPossibleException;


class CategoryController extends Controller
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
      $categories = Category::paginate(9);
      return view('admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Category $category)
    {
      $courses = Course::all()->lists('title', 'id');
      $category_courses = [];
      $orderPages = Category::all();

      return view('admin.category.form', compact('orderPages', 'category', 'courses', 'category_courses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      $last_category = Category::orderBy('created_at', 'desc')->first();
      $this->validate($request, [
          'category_name' => 'required|max:255|unique:categories',
          'description' => 'required',
          'picture' => 'mimes:jpeg,png|max:500',
      ]);
        $category = new Category;

        if ( $request->hasFile('picture') ) {
            $file = $request->file('picture');
            $extention = $file->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/categories/picture/' . $extention;
            $file->move($location, $name);
            $picture = 'categories/picture/' . $extention . '/' . $name;
            $category->picture = $picture;
        }

        $category->category_name = $request->input('category_name');
        $category->description = $request->input('description');
        $category->subscription_price = $request->input('subscription_price');
        $category->subscription_duration = 3650;
        if (empty($last_category) || is_null($last_category)) {
          $category->category_id = 1;
        }
        else {
          $category->category_id = $last_category->id + 1;
        }

        $lessons = $request->input('courses');

        $category->save();
        $category->courses()->detach();
        $category->courses()->attach($request->input('lessons'));

        $this->updatePageOrder($category, $request);

        flash('دسته بندی مورد نظر شما با موفقیت ذخیره شد');
        return redirect(route('admin.categories.index'));
      }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      $category = Category::findOrFail($id);
      $courses = $category->courses()->get();
      return view('admin.category.courses', compact('category', 'courses'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        $courses = Course::all()->lists('title', 'id');
        $category_courses = $category->courses->pluck('id')->toArray();

        $orderPages = Category::all();

        return view('admin.category.form', compact('orderPages', 'category', 'courses', 'category_courses'));
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
          'category_name' => 'required|max:255',
          'description' => 'required',
          'picture' => 'mimes:jpeg,png|max:500',
      ]);

      $category = Category::findOrFail($id);
      if ($response = $this->updatePageOrder($category, $request)) {
        return $response;
      }
      $category->fill($request->only('category_name', 'description', 'subscription_price'));
      if ( $request->hasFile('picture') ) {
          $file = $request->file('picture');
          $extention = $file->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/categories/picture/' . $extention;
          $file->move($location, $name);
          $picture = 'categories/picture/' . $extention . '/' . $name;
          $category->picture = $picture;
      }

      $category->save();
      $category->courses()->detach();
      $category->courses()->attach($request->input('courses'));
      flash('دورهٔ مورد نظر شما با موفقیت به روز شد');
      return redirect(route('admin.categories.index'));

    }

    /**
     * Create a course
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function createCourse(Category $category, Course $course, $id){
      $category = Category::findOrFail($id);
      $lessons = Lesson::all()->lists('title', 'id','class');
      $courses = $category->courses->lists('title', 'id');

      $category_courses = [];
      $course_lessons = [];
      return view('admin.category.courseForm', compact('category', 'course_lessons', 'courses', 'category_courses', 'course', 'lessons'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        flash('دسته بندی مورد نظر با موفقیت حذف شد.');
        return redirect::back();
    }

    protected function updatePageOrder(Category $category, Request $request)
    {
      if ($request->has('order', 'orderPage')) {
        try {
          $category->updateOrder($request->input('order'), $request->input('orderPage'));
        } catch (MoveNotPossibleException $e) {
          flash('نمیتوان یک صفحه را زیرمجموعهٔ خودش قرار داد', 'danger');
          return redirect::back();
        }
      }
    }


}
