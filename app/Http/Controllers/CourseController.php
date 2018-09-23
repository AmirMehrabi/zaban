<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Course;
use App\Lesson;
use App\Question;
use App\Category;
use Auth;

use App\Http\Requests;

class CourseController extends Controller
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
    public function index(Course $course)
    {
        $courses = Course::paginate(19);
        return view('admin.course.index', compact('courses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Course $course)
    {

        $lessons = Lesson::all()->lists('title', 'id','class');
        $courses = Course::all()->pluck('title', 'id');
        $course_lessons = [];
        $orderPages = Course::all();
        return view('admin.course.form', compact('course', 'orderPages', 'lessons', 'courses', 'course_lessons'));
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
          'title' => 'required|max:255',
          'description' => 'required',
          'picture' => 'mimes:jpeg,png|max:500',
          'video' => 'mimes:mp4,mov,ogg,webm|max:40000',
      ]);
        $course = new Course;
        $course->title = $request->input('title');
        $course->description = $request->input('description');
        $course->required_course = $request->input('required_course');
        $course->required_score = $request->input('required_score');
        $lessons = $request->input('lessons');
        if ( $request->hasFile('picture') ) {
            $file = $request->file('picture');
            $extention = $file->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/courses/picture/' . $extention;
            $file->move($location, $name);
            $picture = 'courses/picture/' . $extention . '/' . $name;
            $course->picture = $picture;
        }
        if ( $request->hasFile('video') ) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('video')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/courses/video/' . $extention;
            $file->move($location, $name);
            $video = 'courses/video/' . $extention . '/' . $name;
            $course->video = $video;
        }




        $course->save();

        $this->updatePageOrder($course, $request);
        $course->lessons()->detach();
        $course->lessons()->attach($request->input('lessons'));

        if (!empty($request->input('category_id'))) {
          $course->category()->detach();
          $course->category()->attach($request->input('category_id'));
        }



        flash('دورهٔ مورد نظر شما با موفقیت ذخیره شد');
        return redirect(route('admin.categories.show', $request->input('category_id')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::findOrFail($id);
        $lessons = $course->lessons;
        return view('admin.course.lessons', compact('course', 'lessons'));
    }

    public function createLesson(Lesson $lesson, Question $question, $id) {

      $courses = Course::all()->pluck('title', 'id');
      $course = Course::find($id);
      $lessons = $course->lessons->pluck('title', 'id');
      $course_lessons = [];

      return view('admin.course.lessonForm', compact('lesson', 'question', 'lessons', 'course'));
    }

    public function editLesson($id, $courseId)
    {
      $lesson = Lesson::findOrFail($id);
      $courses = Course::find($courseId);
      $lessons = $courses->lessons->pluck('title', 'id');


      $questions = Lesson::findOrFail($id)->questions;
      $course = $lesson->courses->first();
      $orderPages = $courses->lessons;
      return view('admin.course.lessonForm', compact('lesson', 'course',  'lessons', 'questions', 'orderPages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $course = Course::findOrFail($id);
        $category = $course->category()->first();
        $lessons = Lesson::all()->lists('title', 'id');
        $courses = $category->courses->lists('title', 'id');
        $course_lessons = $course->lessons->pluck('id')->toArray();

        $category = $course->category()->first();
        if (!empty($category) && ! is_null($category)) {
          $orderPages = Category::find($category->id)->courses()->get();
        }
        else {
          $orderPages = Course::all();
        }


        return view('admin.course.form', compact('course', 'orderPages', 'lessons', 'courses', 'course_lessons'));
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
          'title' => 'required|max:255',
          'description' => 'required',
          'picture' => 'mimes:jpeg,png|max:500',
          'video' => 'mimes:mp4,mov,ogg,webm|max:400000',
      ]);
      $course = Course::findOrFail($id);
      $category = $course->category()->first();
      $course->fill($request->only(['title', 'required_course', 'description', 'required_score']));

      if ( $request->hasFile('picture') ) {
          $file = $request->file('picture');
          $extention = $file->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('picture')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/courses/picture/' . $extention;
          $file->move($location, $name);
          $picture = 'courses/picture/' . $extention . '/' . $name;
          $course->picture = $picture;
      }
      if ( $request->hasFile('video') ) {
          $file = $request->file('video');
          $extention = $file->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('video')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/courses/video/' . $extention;
          $file->move($location, $name);
          $video = 'courses/video/' . $extention . '/' . $name;
          $course->video = $video;
      }

      if ($response = $this->updatePageOrder($course, $request)) {
        return $response;
      }


      $course->save();
      $course->lessons()->detach();
      $course->lessons()->attach($request->input('lessons'));
      flash('دورهٔ مورد نظر شما با موفقیت به روز شد');
      return redirect(route('admin.categories.show', $category->id));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $course = Course::findOrFail($id);

      foreach ($course->children as $child) {
        $child->makeRoot();
      }

      $course->delete();
      flash('دوره مورد نظر با موفقیت حذف شد.');
      return Redirect::back();
    }

    protected function updatePageOrder(Course $course, Request $request)
    {
      if ($request->has('order', 'orderPage')) {
        try {
          $course->updateOrder($request->input('order'), $request->input('orderPage'));
        } catch (MoveNotPossibleException $e) {
          flash('نمیتوان یک صفحه را زیرمجموعهٔ خودش قرار داد', 'danger');
          return redirect::back();
        }
      }
    }
}
