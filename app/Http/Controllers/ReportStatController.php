<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;
use App\Course;
use App\Result;
use App\Lesson;
use App\Category;
use Tracker;

class ReportStatController extends Controller
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

        $dayPageViews = count(Tracker::q(60 * 24)) ;


        $visitor = Tracker::currentSession();


        $weekPageViews = count(Tracker::q(60 * 24 * 7));

        $monthPageViews = count(Tracker::q(2592000));

        $yearPageViews = count(Tracker::q(31636000));



        $popular_courses = Course::orderBy('visits', 'desc')->take(4)->get();

        $popular_lessons = Lesson::orderBy('visits', 'desc')->take(4)->get();

        $popular_categories = Category::orderBy('visits', 'desc')->take(4)->get();


        $courses = Course::orderBy('created_at', 'desc')->paginate(12);


        foreach ($courses as $course) {
          $course->bestResult = Result::where('course_id', $course->id)->orderBy('user_score')->take(3)->get();
        }

        return view('admin.reportstat.index', compact('courses', 'popular_courses', 'yearPageViews', 'popular_lessons', 'popular_categories', 'dayPageViews', 'weekPageViews', 'monthPageViews'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
