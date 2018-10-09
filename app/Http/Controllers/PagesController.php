<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Bican\Roles\Models\Role;
use App\Course;
use App\Lesson;
use App\Answer;
use App\Question;
use Auth;
use App\Faq;
use App\Category;
use App\Vocabulary;
use App\VocabCat;
use App\Exam;
use App\Response;
use App\Result;
use App\News;
use App\Payment;
use App\User;
use App\LessonPrerequisite;
use Image;
use jDate;
use Carbon\Carbon;
use App\Group;
use App\Post;
use Storage;
use Illuminate\Support\Facades\Input;
Use App\Subscriber;
use DB;
use App\Subscription;
use App\Contact;
use Tracker;
use App\CourseSubscription;
use Illuminate\Support\Facades\Validator;


use App\Http\Requests;

class PagesController extends Controller
{

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
/*    function get_percent($array) {
      foreach ($array as $single) {
        $single->percent = 100 / sizeof($array) ;
        echo round($single->percent, 1);
        echo '<br>';
      }
    }*/

    /*$this->middleware(['auth', 'payment'], ['except' => array('index', 'vocabulary')]);*/
  }

  public function index(){





    $lessons = Lesson::orderBy('created_at', 'desc')->take(3)->get();
    $courses = Course::orderBy('created_at', 'desc')->where('required_course', NULL)->take(6)->get();
    $categories = Category::orderBy('created_at', 'desc')->take(6)->get();
    $post = News::orderBy('created_at', 'desc')->first();
    $groups = Group::all();
    $roots = Post::roots()->get();


    return view('home-page', compact('lessons', 'roots', 'groups', 'courses', 'categories', 'post'));
  }

  public function contact(){
    return view('contact');
  }

  public function faq(){

    $faqs = Faq::all();
    return view('faq', compact('faqs'));
  }

  public function post_contact(Request $request){
    $message = new Contact;
    $message->name = $request->input('name');
    $message->family_name = $request->input('family_name');
    $message->email = $request->input('email');
    $message->subject = $request->input('subject');
    $message->message = $request->input('message');

    $message->save();

    flash('پیغام شما با موفقیت ثبت شد.');

    return redirect::back();
  }

  public function profile() {
    $user = User::findOrFail(Auth::user()->id);
    $results = Result::where('user_id', $user->id)->get();
    $subscription_fees = Subscription::orderBy('created_at', 'desc')->get();
    $subscriptions = $user->courseSubscriptions->where('activated', 1);

    foreach ($subscriptions as $subscription) {
      $subscription->category = Category::findOrFail($subscription->category_id);
    }

    return view('profile', compact('user', 'results', 'subscription_fees', 'subscriptions'));
  }

  public function profileUpdate(Request $request) {



    $validator = Validator::make($request->all(), [
      'password' => 'required|confirmed'
    ]);


    if($validator->passes()){

        $user = User::find(Auth::user()->id);

        $user->password = bcrypt($request->get('password'));
        $user->save();
        flash('رمز عبور شما با موفقیت به روز رسانی شد', 'success');
        return Redirect()->back();
        dd($user);
    }else {
        flash('کلمه عبور و کلمه عبور تکرار شده با هم مطابقت ندارند', 'warning');
        return Redirect()->back()->withErrors($validator)->withInput();
    }


  }

  public function posts(){
    $posts = News::orderBy('created_at', 'desc')->paginate(9);
    return view('posts', compact('posts'));
  }

  public function post($id){
    $post = News::findOrFail($id);
    return view('post', compact('post'));
  }

  public function PostBySlug($slug){
    $post = News::whereSlug($slug)->first();
    return view('post', compact('post'));
  }

  public function page($slug){
    $post = Post::whereSlug($slug)->firstOrFail();
    return view('post', compact('post'));
  }

  public function vocabIndex(){
    $albums = VocabCat::paginate(10);
    return view('vocabs', compact('albums'));
  }


  public function vocabPage($id){
    $vocabs = VocabCat::findOrFail($id)->vocabs()->orderBy('rgt')->get();
    $album = VocabCat::findOrFail($id);
    return view('vocab', compact('vocabs', 'album'));
  }

    public function searchCategory(Request $request) {
      $categories = Category::SearchByKeyword($request->input('keyword'))->orderBy('rgt')->paginate(20);
      if (count($categories)) {
        foreach ($categories as $category) {
          $paid = null;
          if (Auth::user()) {
            $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
            if (!is_null($paid)) {
              $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
              if (Carbon::now() > $expiration_date) {
                $category->current_date = Carbon::now();
                $category->expiration_date = $expiration_date;
                $category->paid = 0;
                /*اشتراک به اتمام رسیده*/
              }
              elseif (Carbon::now() < $expiration_date) {
                $category->current_date = Carbon::now();
                $category->expiration_date = $expiration_date;
                $category->remaining = $category->expiration_date->diffInDays($category->current_date);
                $category->paid = 1;
                /*دارای اشتراک*/
              }
            }
            elseif (is_null($paid)) {
              $category->paid = 2;
              /*تا کنون اشتراک خریداری نشده*/
            }
          }
          /*end of subscription*/
          /*end of subscription*/
        }
        return view('categories', compact('categories'));
      }
      else {
        flash('متاسفانه جست و جوی شما نتیجه‌ای در بر نداشت.', 'warning');
        return redirect()->back();
      }
    }

    public function categoryIndex(){
      $categories = Category::orderBy('rgt')->paginate(10);

      foreach ($categories as $category) {
        $paid = null;
        if (Auth::user()) {
          $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
          if (!is_null($paid)) {
            $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
            if (Carbon::now() > $expiration_date) {
              $category->current_date = Carbon::now();
              $category->expiration_date = $expiration_date;
              $category->paid = 0;
              /*اشتراک به اتمام رسیده*/
            }
            elseif (Carbon::now() < $expiration_date) {
              $category->current_date = Carbon::now();
              $category->expiration_date = $expiration_date;
              $category->remaining = $category->expiration_date->diffInDays($category->current_date);
              $category->paid = 1;
              /*دارای اشتراک*/
            }
          }
          elseif (is_null($paid)) {
            $category->paid = 2;
            /*تا کنون اشتراک خریداری نشده*/
          }
        }
        /*end of subscription*/
        /*end of subscription*/
      }
      return view('categories', compact('categories'));
    }


















      public function categoryPage($slug){
        $category = Category::whereSlug($slug)->firstOrFail();
        $category->visits = $category->visits + 1;
        $category->save();
        $courses = $category->courses()->orderBy('lft')->get();


        /*end of subscription*/

        foreach ($courses as $course) {
          $course->allowed = 1;
          $prerequisite = Course::find($course->required_course);
          if (Auth::user()) {
            $previous_result = Result::where('user_id', Auth::user()->id)->where('course_id', $course->required_course)->first();
          }

          if (!is_null($prerequisite)) {
            $course->allowed = 0;
          }
          if (!empty($previous_result)) {
            if ($previous_result->user_score >= $previous_result->required_score) {
              $course->allowed = 1;
            }
            else {
              $course->allowed = 0;
            }
          }
        }

        return view('category', compact('courses', 'category'));
      }




      public function searchCategoryPage(Request $request){
        $category = Category::whereSlug($request->input('slug'))->firstOrFail();
        $category->visits = $category->visits + 1;
        $category->save();
        $courses = $category->courses()->SearchByKeyword($request->input('keyword'))->orderBy('lft')->get();
        if (count($courses)) {


          $paid = null;
          if (Auth::user()) {
            $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
            if (!is_null($paid)) {
              $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
              if (Carbon::now() > $expiration_date) {
                $category->current_date = Carbon::now();
                $category->expiration_date = $expiration_date;
                $category->paid = 0;
                /*اشتراک به اتمام رسیده*/
              }
              elseif (Carbon::now() < $expiration_date) {
                $category->current_date = Carbon::now();
                $category->expiration_date = $expiration_date;
                $category->remaining = $category->expiration_date->diffInDays($category->current_date);
                $category->paid = 1;
                /*دارای اشتراک*/
              }
            }
            elseif (is_null($paid)) {
              $category->paid = 2;
              /*تا کنون اشتراک خریداری نشده*/
            }
          }
          /*end of subscription*/

          foreach ($courses as $course) {
            $course->allowed = 1;
            $prerequisite = Course::find($course->required_course);
            if (Auth::user()) {
              $previous_result = Result::where('user_id', Auth::user()->id)->where('course_id', $course->required_course)->first();
            }

            if (!is_null($prerequisite)) {
              $course->allowed = 0;
            }
            if (!empty($previous_result)) {
              if ($previous_result->user_score >= $previous_result->required_score) {
                $course->allowed = 1;
              }
              else {
                $course->allowed = 0;
              }
            }
          }

          return view('category', compact('courses', 'category'));
        }
        else {
          flash('جست و جوی شما نتیجه‌ای در بر نداشت', 'warning');
          return redirect()->back();
        }


      }








  public function course($slug){
    $course = Course::whereSlug($slug)->firstOrFail();

    $category = $course->category->first();

    $paid = null;
    if (Auth::user()) {
      $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
      if (!is_null($paid)) {
        $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
        if (Carbon::now() > $expiration_date) {
          $category->current_date = Carbon::now();
          $category->expiration_date = $expiration_date;
          $category->paid = 0;
          /*اشتراک به اتمام رسیده*/
        }
        elseif (Carbon::now() < $expiration_date) {
          $category->current_date = Carbon::now();
          $category->expiration_date = $expiration_date;
          $category->remaining = $category->expiration_date->diffInDays($category->current_date);
          $category->paid = 1;
          /*دارای اشتراک*/
        }
      }
      elseif (is_null($paid)) {
        $category->paid = 2;
        /*تا کنون اشتراک خریداری نشده*/
      }
    }
    /*end of subscription*/


    $course->visits = $course->visits + 1;
    $course->save();
    $lessons = $course->lessons;
    $exams = $course->exams;
    $prerequisite = Course::find($course->required_course);

    if (Auth::user()) {
      $previous_result = Result::where('user_id', Auth::user()->id)->where('course_id', $course->required_course)->first();
    }


    $course->allowed = 1;
    if (!empty($previous_result)) {
      if ($previous_result->user_score >= $previous_result->required_score) {
        $course->allowed = 1;
      }
      else {
        $course->allowed = 0;
      }

    }
    elseif(!empty($prerequisite) && empty($previous_result)) {
      $course->allowed = 0;
    }


    foreach ($lessons as $lesson) {
      $lesson->allowed = 1;

      if (!is_null($lesson->prerequisite_lesson)) {
        if (Auth::user()) {
          $allowed = LessonPrerequisite::where('lesson_id', $lesson->prerequisite_lesson)->where('user_id', Auth::user()->id)->first();
        }
        if (!empty($allowed)) {
          $lesson->allowed = 1;
        }
        else {
          $lesson->allowed = 0;
        }
      }
    }


    return view('course', compact('course', 'paid', 'exams', 'lessons', 'previous_result', 'category', 'prerequisite'));
  }


























  public function lesson($slug) {
    $lesson = Lesson::whereSlug($slug)->firstOrFail();
    $lesson->visits = $lesson->visits + 1;
    $lesson->save();
    $courses = $lesson->courses;
    $course = $lesson->courses->first();
    $category = $course->category->first();







    $paid = null;
    if (Auth::user()) {
      $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
      if (!is_null($paid)) {
        $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
        if (Carbon::now() > $expiration_date) {
          $category->current_date = Carbon::now();
          $category->expiration_date = $expiration_date;
          $category->paid = 0;
          /*اشتراک به اتمام رسیده*/
        }
        elseif (Carbon::now() < $expiration_date) {
          $category->current_date = Carbon::now();
          $category->expiration_date = $expiration_date;
          $category->remaining = $category->expiration_date->diffInDays($category->current_date);
          $category->paid = 1;
          /*دارای اشتراک*/
        }
      }
      elseif (is_null($paid)) {
        $category->paid = 2;
        /*تا کنون اشتراک خریداری نشده*/
      }
    }











    $lesson->allowed = 1;
    $questions = $lesson->questions;
    $questions_ids = $lesson->questions->pluck('id');

    $user_answers = Answer::whereIn('question_id', $questions_ids)->where('user_id', 1)->paginate(10);


    $prerequisite = LessonPrerequisite::where('lesson_id', $lesson->id)->where('user_id', Auth::user()->id)->first();


    if (!is_null($lesson->prerequisite_lesson)) {
      $allowed = LessonPrerequisite::where('lesson_id', $lesson->prerequisite_lesson)->where('user_id', Auth::user()->id)->first();
      if (!empty($allowed)) {
        $lesson->allowed = 1;

      }
      else {
        $lesson->allowed = 0;
      }
    }

    if (empty($prerequisite) && $lesson->allowed == 1) {
      $prerequisite = new LessonPrerequisite;
      $prerequisite->user_id = Auth::user()->id;
      $prerequisite->lesson_id = $lesson->id;
      $prerequisite->save();
    }

    return view('lesson', compact('lesson', 'category', 'questions', 'user_answers', 'courses'));

  }


  public function lessonExam($slug) {
    $lesson = Lesson::whereSlug($slug)->firstOrFail();
    $questions = $lesson->questions;

    $course = $lesson->courses->first();

    $category = $course->category->first();

    $paid = null;
    if (Auth::user()) {
      $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
      if (!is_null($paid)) {
        $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
        if (Carbon::now() > $expiration_date) {
          $category->current_date = Carbon::now();
          $category->expiration_date = $expiration_date;
          $category->paid = 0;
          /*اشتراک به اتمام رسیده*/
        }
        elseif (Carbon::now() < $expiration_date) {
          $category->current_date = Carbon::now();
          $category->expiration_date = $expiration_date;
          $category->remaining = $category->expiration_date->diffInDays($category->current_date);
          $category->paid = 1;
          /*دارای اشتراک*/
        }
      }
      elseif (is_null($paid)) {
        $category->paid = 2;
        /*تا کنون اشتراک خریداری نشده*/
      }
    }
    /*end of subscription*/

    $correct_answers = $questions->pluck('is_correct')->toArray();
    $questions_ids = $lesson->questions->pluck('id');

    $user_answers = Answer::whereIn('question_id', $questions_ids)->where('user_id', Auth::user()->id)->paginate(10);

    foreach ($user_answers as $user_answer) {
      $qstns = Question::where('id', $user_answer->question_id)->first();
      if ($user_answer->answer == $qstns->is_correct) {
       $user_answer->score = $qstns->score;
       $user_answer->correct = true;
      }
      else {
        $user_answer->score = 0 ;
        $user_answer->correct = false;
      }
    }

    $user_correct_answers = array_sum($user_answers->lists('correct')->toArray()); /*number of answers that user has given correctly*/
    $user_answers_scores = array_sum($user_answers->lists('score')->toArray()); /*Scores that user earned by answering following question*/
    $min_grade_required = $lesson->min_grade;


    $correct_user_answers = $user_answers->whereIn('answer', $correct_answers);



    foreach ($correct_user_answers as $correct_user_answer) {
      $correct_user_answer->percent = 100 / sizeof($correct_user_answers);
     round($correct_user_answer->percent, 1);
    }



    $correct_answers_sum =  sizeof($correct_answers);
    $correct_user_answers_sum =  sizeof($correct_user_answers);

    $each_question = 100 / count($correct_answers);
    $passed_exam_percent =  round($each_question * $user_correct_answers);

    if ($questions->isEmpty()) {
      flash('آزمونی برای این درس تعریف نشده است', 'warning');
      return redirect::back();
    }
    else {
      return view('exam', compact('lesson', 'category', 'passed_exam_percent', 'questions', 'user_answers', 'min_grade_required', 'user_correct_answers', 'correct_user_answers', 'correct_user_answers_sum', 'user_answers_scores'));
    }

  }

  public function roles(){
    if (Auth::check()) {
      $user_count = User::count();
      if ( $user_count == 1) {

        $adminRole = Role::create([
            'name' => 'Admin',
            'slug' => 'admin',
            'description' => '', // optional
            'level' => 1, // optional, set to 1 by default
        ]);

        $moderatorRole = Role::create([
            'name' => 'Subscriber',
            'slug' => 'subscriber',
            'level' => 2,
        ]);

      }
      return $user_count;
    }


    return 'true';
  }





  public function submitTest(Request $request, $id){

    $question = Question::findOrFail($id);
    $given_answer = $request->input('optionsRadios');
    $previous_answer = Answer::where('question_id', $question->id)->where('user_id', Auth::user()->id)->first();

    if (!empty($previous_answer)) {
      $previous_answer->delete();
    }

    $answer = new Answer([
      'question_id' => $question->id,
      'user_id' => Auth::user()->id,
      'answer'  => $given_answer,
    ]);

    if ($given_answer == $question->is_correct) {
      flash('جواب شما صحیح بود', 'success');
    }
    else {
      flash('جواب شما صحیح نبود', 'warning');
    }

    return Redirect::back();
  }


  public function tests(Request $requset, $id){
    $question = Question::findOrFail($id);
    return view('courseExam', compact('question'));
  }


  public function ajax(){
    return view('courseExam');
  }

  public function ajaxpost() {
    // Getting all post data
    if(Request::ajax()) {
      return 'true';
    }
  }


  public function test(){

    if (Auth::user()->paid == 1) {
      $paid = Payment::where('user_id', Auth::user()->id)->where('activated', 1)->orderBy('created_at', 'desc')->first();
      $payment = new Payment;
      $payment->user_id = Auth::user()->id;
      $payment->ref_id = 123;
      $payment->payment_date = $paid->expiration_date;
      $payment->duration = 1;
      $payment->expiration_date = Carbon::parse($paid->expiration_date)->addDays($payment->duration);
      $payment->activated = 0;
      $payment->save();
    }
    else {
      $payment = new Payment;
      $payment->user_id = Auth::user()->id;
      $payment->ref_id = 124;
      $payment->payment_date = Carbon::now();
      $payment->duration = 1;
      $payment->expiration_date = Carbon::now()->addDays($payment->duration);
      $payment->activated = 0;
      $payment->save();
    }



    return response()->json($payment);

    /*dd($payment);*/


    $checkout = DB::table('gateway_transactions')->orderBy('created_at', 'desc')->first();




  }

  public function get_upload(){
    $course = Course::orderBy('created_at', 'desc')->first();
    $picture = storage_path('private/' . $course->picture);
    return view('test', compact('course', 'picture'));
  }


  public function testForm(Lesson $lesson, Question $question) {
    return view('admin.lesson.form2', compact('lesson', 'question'));
  }


  public function submit_exam(Request $request, $slug){
    $lesson = Lesson::whereSlug($slug)->firstOrFail();
    $questions = $lesson->questions;
    $question = Question::findOrFail($request->get('id'));

    $given_answer = $request->input('answer');

    $previous_answer = Answer::where('question_id', $question->id)->where('user_id', Auth::user()->id)->first();
    if (!empty($previous_answer)) {
      $previous_answer->delete();
    }

    $answer = new Answer([
      'question_id' => $question->id,
      'user_id' => Auth::user()->id,
      'answer'  => $given_answer,
    ]);
    $answer->save();
    if ($given_answer == $question->is_correct) {
      flash('جواب شما صحیح بود', 'success');
    }
    else {
      flash('جواب شما صحیح نبود', 'warning');
    }
    return redirect::back();


  }


    public function courseExam($id){
      $course = Course::findOrFail($id);
      $exams_count = count(Exam::where('course_id', $id)->get());



      $category = $course->category->first();

      $paid = null;
      if (Auth::user()) {
        $paid = CourseSubscription::where('user_id', Auth::user()->id)->where('activated', 1)->where('category_id', $category->id)->orderBy('created_at', 'desc')->first();
        if (!is_null($paid)) {
          $expiration_date = Carbon::parse($paid->payment_date)->addDays($paid->duration);
          if (Carbon::now() > $expiration_date) {
            $category->current_date = Carbon::now();
            $category->expiration_date = $expiration_date;
            $category->paid = 0;
            /*اشتراک به اتمام رسیده*/
          }
          elseif (Carbon::now() < $expiration_date) {
            $category->current_date = Carbon::now();
            $category->expiration_date = $expiration_date;
            $category->remaining = $category->expiration_date->diffInDays($category->current_date);
            $category->paid = 1;
            /*دارای اشتراک*/
          }
        }
        elseif (is_null($paid)) {
          $category->paid = 2;
          /*تا کنون اشتراک خریداری نشده*/
        }
      }
      /*end of subscription*/






      if ($exams_count < 6) {
        $exams = Exam::where('course_id', $id)->get();
      }
      else {
        $exams = Exam::where('course_id', $id)->get()->random(5);
      }


      $exams_ids = Course::findOrFail($id)->exams->pluck('id');
      $user_answers = Response::whereIn('exam_id', $exams_ids)->where('user_id', Auth::user()->id)->paginate(10);
      $result = Result::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();


      return view('courseExam', compact('exams', 'category', 'result', 'course' ,'user_answers'));
    }



    public function submit_course_exam(Request $request, $id) {
      $exam_ids = $request->input('submitted_exams');

      $course = Course::findOrFail($id);
      $exams = Exam::where('course_id', $id)->findMany($request->input('submitted_exams'));

      $submitted_exams = $request->input('submitted_exams');
      foreach ($submitted_exams as $submitted_exam) {
        $input = $submitted_exam;
        $exam = Exam::findOrFail($input);

        $given_answer = $request->input($input);
          if (empty($given_answer)) {
            flash('پاسخ دادن به تمامی سوالات الزامی است.', 'warning');
            return redirect::back()->withInput(Input::all());
          }
        $previous_answers = Response::where('exam_id', $exam->id)->where('user_id', Auth::user()->id)->paginate(50);
        if (!empty($previous_answers)) {
          foreach ($previous_answers as $answer) {
            $answer->delete();
          }
        }



        if ($given_answer == $exam->is_correct) {
          $is_correct = 1;
        }
        else {
          $is_correct = 0;
        }

        $answer = new Response([
          'exam_id' => $exam->id,
          'user_id' => Auth::user()->id,
          'answer'  => $given_answer,
          'is_correct' => $is_correct,
        ]);

        $answer->save();
      }



      $correct_answers = $exams->pluck('is_correct')->toArray();
      $exams_ids = Exam::where('course_id', $id)->findMany($request->input('submitted_exams'))->lists('id');


      $user_answers = Response::whereIn('exam_id', $exams_ids)->where('user_id', Auth::user()->id)->take(10)->get();

      $user_correct_answers = array_sum($user_answers->lists('is_correct')->toArray()); /*number of answers that user has given correctly*/
      $user_answers_scores = array_sum($user_answers->lists('score')->toArray()); /*Scores that user earned by answering following question*/
      $min_grade_required = $course->required_score;

      $each_question = 100 / count($correct_answers);
      $passed_exam_percent =  round($each_question * $user_correct_answers);

      $previous_result = Result::where('course_id', $course->id)->where('user_id', Auth::user()->id)->first();

      $result = new Result;

      $result->course_id = $course->id;
      $result->user_id = Auth::user()->id;
      $result->questions = count($correct_answers);
      $result->correct_responses = $user_correct_answers;
      $result->required_score = $min_grade_required;
      $result->user_score = $passed_exam_percent;


      if (!empty($previous_result) && $previous_result->user_score <= $result->user_score) {

        $previous_result->delete();
        $result->save();
        flash('تبریک! توانستید نمرهٔ بهتری از دفعهٔ پیش به دست آورید.', 'success');
      }
      elseif (!empty($previous_result) && $previous_result->user_score >= $result->user_score) {
        flash('متاسفانه شما موفق به دریافت نمرهٔ بالاتری از دفعه پیش نشدید', 'warning');
      }
      else {
        $result->save();
      }

      return Redirect::back();

    }





/*

public function submit_course_exam(Request $request, $id){

  $exams = Course::findOrFail($id)->exams;

  $exam = Exam::findOrFail($request->input('id'));

  $given_answer = $request->input('answer');

  $previous_answer = Response::where('exam_id', $exam->id)->where('user_id', Auth::user()->id)->first();
  if (!empty($previous_answer)) {
    $previous_answer->delete();
  }

  if ($given_answer == $exam->is_correct) {
    $is_correct = 1;
  }
  else {
    $is_correct = 0;
  }

  $answer = new Response([
    'exam_id' => $exam->id,
    'user_id' => Auth::user()->id,
    'answer'  => $given_answer,
    'is_correct' => $is_correct,
  ]);
  $answer->save();
  if ($given_answer == $exam->is_correct) {
    flash('جواب شما صحیح بود', 'success');
  }
  else {
    flash('جواب شما صحیح نبود', 'warning');
  }
  return redirect::back();
}


*/


    public function checkout(Request $request){
      $subscription = Subscription::findOrFail($request->input('id'));
      $duration = $subscription->duration;
      $price = $subscription->price;
      $name = $subscription->name;
      $tax = $price * 9 / 100;
      $total = $tax + $price;
      return view('checkout', compact('tax', 'name', 'price', 'duration', 'total'));
    }

    public function checkoutCategory($slug){
      $category = Category::whereSlug($slug)->firstOrFail();

      $duration = $category->subscription_duration;
      $price = $category->subscription_price;
      $tax = $price * 9 / 100;
      $total = $tax + $price;
      return view('checkoutCategory', compact('category', 'tax', 'price', 'duration', 'total'));
    }


    public function payment(Request $request){
      try {
    		$gateway = \Gateway::mellat();
    		$gateway->setCallback(('callback'));
    		$gateway->price($request->input('total'))->ready();
    		$refId =  $sgateway->refId();
    		$transID = $gateway->transactionId();

    		// Your code here


        if (Auth::user()->paid == 1) {
          $paid = Payment::where('user_id', Auth::user()->id)->where('activated', 1)->orderBy('created_at', 'desc')->first();
          $payment = new Payment;
          $payment->user_id = Auth::user()->id;
          $payment->ref_id = $refId;
          $payment->payment_date = Carbon::parse($paid->expiration_date);
          $payment->duration = $request->input('duration');
          $payment->expiration_date = Carbon::parse($paid->expiration_date)->addDays($payment->duration);

          $payment->activated = 0;
          $payment->save();
        }
        else {
          $payment = new Payment;
          $payment->user_id = $request->input('user_id');
          $payment->duration = $request->input('duration');
          $payment->ref_id = $refId;
          $payment->payment_date = Carbon::now();
          $payment_date = Carbon::parse();
          $payment->expiration_date = Carbon::parse()->addDays($request->input('duration'));
          $payment->activated = 0;
          $payment->save();
        }


    		return $gateway->redirect();

    	}


      catch (RetryException $e)
     {
         dd($e->getMessage());
     }
      catch (PortNotFoundException $e)
     {
         dd($e->getMessage());
     }
      catch (InvalidRequestException $e)
     {
         dd($e->getMessage());
     }
      catch (NotFoundTransactionException $e)
     {
         dd($e->getMessage());
     }
      catch (Exception $e)
     {
         dd($e->getMessage());
     }


    }

    public function paymentCategory(Request $request){
      try {
        $category = Category::whereSlug($request->input('slug'))->firstOrFail();
    		$gateway = \Gateway::mellat();
    		$gateway->setCallback(('callbackCategory'));
    		$gateway->price($category->subscription_price)->ready();
    		$refId =  $gateway->refId();
    		$transID = $gateway->transactionId();

    		// Your code here




        $payment = new CourseSubscription;
        $payment->user_id = $request->input('user_id');
        $payment->category_id = $category->id;
        $payment->duration = $category->subscription_duration;
        $payment->ref_id = $refId;
        $payment->payment_date = Carbon::now();
        $payment_date = Carbon::parse();
        $payment->expiration_date = Carbon::parse()->addDays($request->input('duration'));
        $payment->activated = 0;
        $payment->save();



    		return $gateway->redirect();

    	}       catch (RetryException $e)
           {
               dd($e->getMessage());
           }
            catch (PortNotFoundException $e)
           {
               dd($e->getMessage());
           }
            catch (InvalidRequestException $e)
           {
               dd($e->getMessage());
           }
            catch (NotFoundTransactionException $e)
           {
               dd($e->getMessage());
           }
            catch (Exception $e)
           {
               dd($e->getMessage());
           }
    }


    public function callbackFromBank() {
      try {
    		$gateway = \Gateway::verify();
    		$trackingCode = $gateway->trackingCode();
    		$refId = $gateway->refId();
    		$cardNumber = $gateway->cardNumber();

    		// عملیات خرید با موفقیت انجام شده است
    		// در اینجا کالا درخواستی را به کاربر ارائه میکنم

        $subscribe = Payment::where('user_id', Auth::user()->id)->where('ref_id', $refId)->first();
        $subscribe->activated = 1;
        $subscribe->save();

        flash('اشتراک مورد نظر با موفقیت خریداری شد.');
        return redirect(route('profile'));


    	} catch (Exception $e) {
        $error = $e->getMessage();
        return view('bank-result', compact('error'));
    	}

    }


    public function callbackFromBankCategory() {
      try {

    		$gateway = \Gateway::verify();
    		$trackingCode = $gateway->trackingCode();
    		$refId = $gateway->refId();
    		$cardNumber = $gateway->cardNumber();

    		// عملیات خرید با موفقیت انجام شده است
    		// در اینجا کالا درخواستی را به کاربر ارائه میکنم

        $subscribe = CourseSubscription::where('user_id', Auth::user()->id)->where('ref_id', $refId)->orderBy('created_at', 'desc')->first();
        $subscribe->activated = 1;
        $subscribe->save();
        $category = Category::findOrFail($subscribe->category_id);

        flash('اشتراک مورد نظر با موفقیت خریداری شد.');
        return redirect(route('category.page', $category->slug));


    	} catch (Exception $e) {
        $error = $e->getMessage();
        return view('bank-result', compact('error'));
    	}

    }






        public function paymentTest(Request $request){
          try {
        		$gateway = \Gateway::zarinpal();
        		$gateway->setCallback(('callback/'));
        		$gateway->price(1000)->ready();
        		$refId =  $gateway->refId();
        		$transID = $gateway->transactionId();

        		// Your code here



        		return $gateway->redirect();

        	} catch (Exception $e) {

            $error = $e->getMessage();
            return view('bank-result', compact('error'));
        	}
        }

    public function submit_lesson_exam(Request $request, $id) {
      $course = Lesson::findOrFail($id);
      $exams = Question::where('lesson_id', $id)->findMany($request->input('submitted_exams'));


      $submitted_exams = $request->input('submitted_exams');


      foreach ($submitted_exams as $submitted_exam) {
        $input = $submitted_exam;
        $exam = Question::findOrFail($input);

        $given_answer = $request->input($input);
        if (empty($given_answer)) {
          flash('باید به تمامی سوالات این درس پاسخ دهید', 'warning');
          return redirect::back();
        }

        $previous_answers = Answer::where('question_id', $exam->id)->where('user_id', Auth::user()->id)->paginate(50);
        if (!empty($previous_answers)) {
          foreach ($previous_answers as $answer) {
            $answer->delete();
          }
        }


        if ($given_answer == $exam->is_correct) {
          $is_correct = 1;
        }
        else {
          $is_correct = 0;
        }

        $answer = new Answer([
          'question_id' => $exam->id,
          'user_id' => Auth::user()->id,
          'answer'  => $given_answer,
        ]);
        $answer->save();

      }


      $correct_answers = $exams->pluck('is_correct')->toArray();
      $exams_ids = Question::where('lesson_id', $id)->findMany($request->input('submitted_exams'))->lists('id');
      $user_answers = Answer::whereIn('question_id', $exams_ids)->where('user_id', Auth::user()->id)->take(10)->get();


      $user_correct_answers = array_sum($user_answers->lists('is_correct')->toArray()); /*number of answers that user has given correctly*/
      $user_answers_scores = array_sum($user_answers->lists('score')->toArray()); /*Scores that user earned by answering following question*/
      $min_grade_required = $course->required_score;

      $each_question = 100 / count($correct_answers);
      $passed_exam_percent =  round($each_question * $user_correct_answers);


      return Redirect::back();

    }

    public function SubmitSubscriber(Request $request) {
      $this->validate($request, [
          'email' => 'required|email|unique:subscribers',
      ]);

      $subscriber = new Subscriber;
      $subscriber->email = $request->input('email');

      $subscriber->save();
      flash('متشکریم. شما با موفقیت در خبرنامه عضو شدید.');

      return Redirect::back();
    }



  public function testcat(){
    $test = Exam::findOrFail(1)->responses;
    dd($test);

  }





}
