<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Question;
use App\Lesson;
use Auth;

use App\Http\Requests;

class QuestionController extends Controller
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
      $questions = Question::all();
      return view('admin.question.index', compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Question $question, Lesson $lesson)
    {
      $lesson = Lesson::all()->pluck('title', 'id');
      return view('admin.question.form', compact('question', 'lesson'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add(Question $question, Lesson $lesson, $id)
    {
      $checked = Lesson::findOrFail($id);
      $lesson = Lesson::all()->pluck('title', 'id');
      return view('admin.question.form', compact('question', 'lesson', 'checked'));
    }


    public function lists(Question $question, $id) {
    $lesson = Lesson::findOrFail($id);
    $questions = $lesson->questions();
    $lessons = Lesson::all()->pluck('title', 'id');

    $user_answers_scores = array_sum($questions->lists('score')->toArray());


    return view('admin.question.list', compact('questions', 'question', 'lessons', 'lesson', 'user_answers_scores'));
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
      ]);

        $question = new Question;
        $question->user_id = Auth::user()->id;
        $question->lesson_id  = $request->input('lesson');
        $question->question   = $request->input('question');
        $question->is_correct = $request->input('is_correct');
        $question->score = $request->input('score');
        $question->opt_1 = $request->input('opt_1');
        $question->opt_2 = $request->input('opt_2');
        $question->opt_3 = $request->input('opt_3');
        $question->opt_4 = $request->input('opt_4');
        $question->save();
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
        $question = Question::findOrFail($id);
        $lesson =  Lesson::all()->pluck('title', 'id');

        return view('admin.question.form', compact('question', 'lesson'));
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
      ]);
        $question = Question::findOrFail($id);
        $question->user_id = Auth::user()->id;
        $question->lesson_id  = $request->input('lesson');
        $question->question   = $request->input('question');
        $question->is_correct = $request->input('is_correct');
        $question->score = $request->input('score');
        $question->opt_1 = $request->input('opt_1');
        $question->opt_2 = $request->input('opt_2');
        $question->opt_3 = $request->input('opt_3');
        $question->opt_4 = $request->input('opt_4');
        $question->save();

        flash('سوال مورد نظر با موفقیت به روز شد');
        return redirect::back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = Question::findOrFail($id);

        $question->delete();

        flash('سوال مورد نظر شما با موفقیت حذف شد', 'info');

        return redirect::back();
    }
}
