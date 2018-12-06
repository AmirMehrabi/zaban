<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Lesson;
use App\Question;
use App\Course;
use App\Vocabulary;
use App\VocabCat;
use App\User;
use App\Result;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::orderBy('created_at', 'desc')->paginate(3);
        $lessons = Lesson::orderBy('created_at', 'desc')->paginate(3);
        $vocabs = Vocabulary::orderBy('created_at', 'desc')->paginate(3);
        $albums = VocabCat::orderBy('created_at', 'desc')->paginate(3);
        $users_counter = User::all()->count();
        $courses_counter = Course::all()->count();
        $lessons_counter = Lesson::all()->count();
        $registered_users_count = User::where('created_at', '>=', Carbon::now()->startOfMonth())->count();

        foreach ($courses as $course) {
          $course->bestResult = Result::where('course_id', $course->id)->orderBy('user_score')->take(3)->get();
        }


        return view('home', compact('courses', 'lessons', 'vocabs', 'albums', 'users_counter', 'lessons_counter', 'courses_counter', 'registered_users_count'));
    }

}
