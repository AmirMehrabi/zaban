<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use App\Lesson;
use App\Course;
use App\Question;
use Auth;

use App\Http\Requests;

class LessonController extends Controller
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
      $lessons = Lesson::paginate(10);
      return view('admin.lesson.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lesson $lesson, Question $question)
    {
        $lessons = Lesson::all()->pluck('title', 'id');
        $courses = Course::all()->pluck('title', 'id');
        $course_lessons = [];
        $orderPages = Lesson::all();

        return view('admin.lesson.form', compact('lesson', 'question', 'lessons', 'orderPages'));
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
            'min_grade' => 'required|integer',
            'attachment' => 'mimes:jpeg,png|max:500',
            'video' => 'mimes:mp4,mov,ogg,webm | max:40000',
        ]);
        $lesson = new Lesson;
        $lesson->title = $request->input('title');
        $lesson->excerpt = $request->input('excerpt');
        $lesson->body = $request->input('body');
        $lesson->min_grade = $request->input('min_grade');

        if (!empty($request->input('prerequisite_lesson'))) {
          $lesson->prerequisite_lesson = $request->input('prerequisite_lesson');
        }

        if ($request->hasFile('attachment')) {
          if ($request->file('attachment')->isValid()) {
            $file = $request->file('attachment');
            $lesson->attach($file);
            $destinationPath = 'uploads';
            $ran_string = str_random(4);
            $file->move($destinationPath,$ran_string.'-'.$file->getClientOriginalName());
          }
        }

        if ( $request->hasFile('video') ) {
            $file = $request->file('video');
            $extention = $file->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('video')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/video/' . $extention;
            $file->move($location, $name);
            $video = 'video/' . $extention . '/' . $name;
            $lesson->video = $video;
        }

        $lesson->save();


        $lesson->courses()->detach();
        $lesson->courses()->attach($request->input('course'));

        flash('درس مورد نظر با موفقیت ایجاد شد.');

        /*return redirect(route('admin.courses.show', $request->input('course')));*/
        return redirect::back();

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
    public function edit($id, $courseId = null)
    {
      $lesson = Lesson::findOrFail($id);
      $lessons = Lesson::all()->pluck('title', 'id');
      $questions = Lesson::findOrFail($id)->questions;
      $course = $lesson->course;

      $orderPages = Lesson::all();
      return view('admin.lesson.form', compact('lesson', 'lessons', 'questions', 'orderPages'));
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
          'title' => 'required ',
          'excerpt' => 'required',
          'body' => 'required',
          'min_grade' => 'required|integer',
          'attachment' => 'mimes:jpeg,png|max:500',
          'video' => 'mimes:mp4,mov,ogg,webm | max:40000',
      ]);

      $lesson = Lesson::findOrFail($id);

      if ($response = $this->updatePageOrder($lesson, $request)) {
        return $response;
      }

      $lesson->fill($request->only('title', 'excerpt', 'body', 'min_grade', 'prerequisite_lesson'));
      if ( $request->hasFile('video') ) {
          $file = $request->file('video');
          $extention = $file->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('video')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/lessons/video/' . $extention;
          $file->move($location, $name);
          $video = 'lessons/video/' . $extention . '/' . $name;
          $lesson->video = $video;
      }

      $lesson->save();
      $lesson->courses()->detach();
      $lesson->courses()->attach($request->input('course'));
      flash('سوال شما با موفقیت به روز شد');
      return redirect::back();
    }

    public function lessons_edit($id) {
      $lesson = Lesson::findOrFail($id);
      $questions = Lesson::findOrFail($id)->questions;
      return view('admin.lesson.form', compact('lesson', 'questions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $lesson = Lesson::findOrFail($id);

      $lesson->delete();

      flash('درس مورد نظر با موفقیت حذف شد.');

      return Redirect::back();
    }


    protected function updatePageOrder(Lesson $lesson, Request $request)
    {
      if ($request->has('order', 'orderPage')) {
        try {
          $lesson->updateOrder($request->input('order'), $request->input('orderPage'));
        } catch (MoveNotPossibleException $e) {
          flash('نمیتوان یک صفحه را زیرمجموعهٔ خودش قرار داد', 'danger');
          return redirect::back();
        }
      }
    }



}
