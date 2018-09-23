<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Exam;
use Auth;
use Illuminate\Support\Facades\Redirect;
use App\Course;

class ExamController extends Controller
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
      $exams = Exam::all();
      return view('admin.exam.index', compact('exams'));
    }

    public function lists(Exam $exam, $id) {
      $course = Course::findOrFail($id);
      $exams = $course->exams();
      $courses = Course::all()->pluck('title', 'id');
      $user_answers_scores = array_sum($exams->lists('score')->toArray());


      return view('admin.exam.list', compact('exams', 'exam', 'courses', 'course', 'user_answers_scores'));
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

      $this->validate($request, [
          'question' => 'required',
          'is_correct' => 'required',
          'score' => 'required|integer',
          'opt_1' => 'required',
          'opt_2' => 'required',
          'opt_3' => 'required',
          'opt_4' => 'required',
          'question_pic' => 'mimes:jpeg,png|max:500',
          'question_audio' => 'mimes:mpga,ogg,wav',
      ]);

        $exam = new Exam;
        $exam->user_id = Auth::user()->id;
        $exam->course_id  = $request->input('course');
        $exam->question   = $request->input('question');
        $exam->is_correct = $request->input('is_correct');
        $exam->score = $request->input('score');
        $exam->opt_1 = $request->input('opt_1');
        $exam->opt_2 = $request->input('opt_2');
        $exam->opt_3 = $request->input('opt_3');
        $exam->opt_4 = $request->input('opt_4');

        if ( $request->hasFile('question_pic') ) {
            // The file
            $question_pic = $request->file('question_pic');
            $extention = $question_pic->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('question_pic')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/exam/' . $extention;
            $question_pic->move($location, $name);
            $question_pic = 'exam/' . $extention . '/' . $name;
            $exam->question_pic = $question_pic;
        }

        if ( $request->hasFile('question_audio') ) {
            // The file
            $question_audio = $request->file('question_audio');
            $extention = $question_audio->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('question_audio')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/exam/' . $extention;
            $question_audio->move($location, $name);
            $question_audio = 'exam/' . $extention . '/' . $name;
            $exam->question_audio = $question_audio;
        }

        if ( $request->hasFile('pic_1') ) {
            // The file
            $pic_1 = $request->file('pic_1');
            $extention = $pic_1->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_1')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/exam/' . $extention;
            $pic_1->move($location, $name);
            $pic_1 = 'exam/' . $extention . '/' . $name;
            $exam->pic_1 = $pic_1;
        }


        if ($request->hasFile('pic_2')) {
          // The file
          $pic_2 = $request->file('pic_2');
          $extention = $pic_2->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_2')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/exam/' . $extention;
          $pic_2->move($location, $name);
          $pic_2 = 'exam/' . $extention . '/' . $name;
          $exam->pic_2 = $pic_2;
        }


        if ($request->hasFile('pic_3')) {
          // The file
          $pic_3 = $request->file('pic_3');
          $extention = $pic_3->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_3')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/exam/' . $extention;
          $pic_3->move($location, $name);
          $pic_3 = 'exam/' . $extention . '/' . $name;
          $exam->pic_3 = $pic_3;
        }

        if ($request->hasFile('pic_4')) {
          // The file
          $pic_4 = $request->file('pic_4');
          $extention = $pic_4->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_4')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/exam/' . $extention;
          $pic_4->move($location, $name);
          $pic_4 = 'exam/' . $extention . '/' . $name;
          $exam->pic_4 = $pic_4;
        }


        $exam->save();
        flash('سوال مورد نظر شما با موفقیت ذخیره شد');
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

      $exam =Exam::findOrFail($id);
      $course = Course::all()->pluck('title', 'id');

      return view('admin.exam.form', compact('course', 'exam', ''));
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
          'question' => 'required',
          'is_correct' => 'required',
          'score' => 'required|integer',
          'opt_1' => 'required',
          'opt_2' => 'required',
          'opt_3' => 'required',
          'opt_4' => 'required',
          'question_pic' => 'mimes:jpeg,png|max:500',
          'question_audio' => 'mimes:mpga,ogg,wav',
      ]);

        $exam = Exam::findOrFail($id);
        $exam->user_id = Auth::user()->id;
        $exam->question   = $request->input('question');
        $exam->is_correct = $request->input('is_correct');
        $exam->score = $request->input('score');
        $exam->opt_1 = $request->input('opt_1');
        $exam->opt_2 = $request->input('opt_2');
        $exam->opt_3 = $request->input('opt_3');
        $exam->opt_4 = $request->input('opt_4');

        if ( $request->hasFile('question_pic') ) {
            // The file
            $question_pic = $request->file('question_pic');
            $extention = $question_pic->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('question_pic')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/exam/' . $extention;
            $question_pic->move($location, $name);
            $question_pic = 'exam/' . $extention . '/' . $name;
            $exam->question_pic = $question_pic;
        }

        if ( $request->hasFile('question_audio') ) {
            // The file
            $question_audio = $request->file('question_audio');
            $extention = $question_audio->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('question_audio')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/exam/' . $extention;
            $question_audio->move($location, $name);
            $question_audio = 'exam/' . $extention . '/' . $name;
            $exam->question_audio = $question_audio;
        }



        if ( $request->hasFile('pic_1') ) {
            // The file
            $pic_1 = $request->file('pic_1');
            $extention = $pic_1->getClientOriginalExtension();
            $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_1')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
            $public_path = public_path();
            $location = $public_path . '/exam/' . $extention;
            $pic_1->move($location, $name);
            $pic_1 = 'exam/' . $extention . '/' . $name;
            $exam->pic_1 = $pic_1;
        }


        if ($request->hasFile('pic_2')) {
          // The file
          $pic_2 = $request->file('pic_2');
          $extention = $pic_2->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_2')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/exam/' . $extention;
          $pic_2->move($location, $name);
          $pic_2 = 'exam/' . $extention . '/' . $name;
          $exam->pic_2 = $pic_2;
        }


        if ($request->hasFile('pic_3')) {
          // The file
          $pic_3 = $request->file('pic_3');
          $extention = $pic_3->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_3')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/exam/' . $extention;
          $pic_3->move($location, $name);
          $pic_3 = 'exam/' . $extention . '/' . $name;
          $exam->pic_3 = $pic_3;
        }

        if ($request->hasFile('pic_4')) {
          // The file
          $pic_4 = $request->file('pic_4');
          $extention = $pic_4->getClientOriginalExtension();
          $name = mt_rand(100000, 999999) . ' - ' . pathinfo($request->file('pic_4')->getClientOriginalName(), PATHINFO_FILENAME) . '.' . $extention;
          $public_path = public_path();
          $location = $public_path . '/exam/' . $extention;
          $pic_4->move($location, $name);
          $pic_4 = 'exam/' . $extention . '/' . $name;
          $exam->pic_4 = $pic_4;
        }


        $exam->save();

        flash('سوال مورد نظر با موفقیت به روز شد');
        return redirect::back();    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $exam = Exam::findOrFail($id);
      $exam->delete();

      flash('سوال مورد نظر با موفقیت حذف شد.');

      return redirect::back();
    }
}
