<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





Route::group(['middleware' => ['auth', 'payment']], function()
{

  Route::get('test', 'PagesController@test');


  Route::get('/profile', ['as' => 'profile', 'uses' => 'PagesController@profile']);

  Route::post('/profile/update', ['as' => 'profile.updatePassword', 'uses' => 'PagesController@profileUpdate']);

  Route::get('/lesson/{slug}', ['as' => 'lesson', 'uses' => 'PagesController@lesson']);

  Route::get('/lesson/{slug}/exam', ['as' => 'lesson.exam', 'uses' => 'PagesController@lessonExam']);

  /*Route::post('/lesson/{slug}/exam/submit', ['as' => 'submit.exam', 'uses' => 'PagesController@submit_exam']);*/

  Route::post('/lesson/{id}/exam/submit', ['as' => 'lesson.exam.submit', 'uses' => 'PagesController@submit_lesson_exam']);

  Route::get('/course/{id}/exam', ['as' => 'course.exam', 'uses' => 'PagesController@courseExam']);

  Route::post('/course/{id}/exam/submit', ['as' => 'course.exam.submit', 'uses' => 'PagesController@submit_course_exam']);

  Route::get('/vocabulary/{id}', ['as' => 'vocabularies', 'uses' => 'PagesController@vocabPage']);


  Route::get('checkout/{slug}', ['as' => 'checkoutCategory', 'uses' => 'PagesController@checkoutCategory']);

  Route::post('checkout', ['as' => 'checkout', 'uses' => 'PagesController@checkout']);


  Route::get('paymentTest', ['as' => 'paymentTest', 'uses' => 'PagesController@paymentTest']);

  Route::post('payment', ['as' => 'payment', 'uses' => 'PagesController@payment']);

  Route::post('paymentCategory', ['as' => 'paymentCategory', 'uses' => 'PagesController@paymentCategory']);

  Route::get('testpayment', ['as' => 'testpayment', 'uses' => 'PagesController@testpayment']);

  Route::any('callback', 'PagesController@callbackFromBank');

  Route::any('callbackCategory', 'PagesController@callbackFromBankCategory');



});

Route::group(['middleware' => ['payment']], function()
{
  Route::get('/profile', ['as' => 'profile', 'uses' => 'PagesController@profile']);


  Route::get('/course/{slug}', ['as' => 'course', 'uses' => 'PagesController@course']);


  /*Route::post('/course/{id}/exam/submit', ['as' => 'course.exam.submit', 'uses' => 'PagesController@submit_course_exam']);*/




  /*Category routes*/

  Route::get('/archive/courses', ['as' => 'category.index', 'uses' => 'PagesController@categoryIndex']);

  Route::get('/archive/courses/search', ['as' => 'category.search.index', 'uses' => 'PagesController@categoryIndex']);

  Route::post('/archive/courses/search', ['as' => 'categories.search', 'uses' => 'PagesController@searchCategory']);

  /*end of search*/


  Route::get('/archive/courses/{slug}', ['as' => 'category.page', 'uses' => 'PagesController@categoryPage']);

  Route::get('/archive/course/search', ['as' => 'course.search.index', 'uses' => 'PagesController@categoryIndex']);

  Route::post('/archive/course/search', ['as' => 'course.search', 'uses' => 'PagesController@searchCategoryPage']);



  /*Vocabulary routes*/

  Route::get('/vocabulary', ['as' => 'vocabulary', 'uses' => 'PagesController@vocabIndex']);


});




Route::get('/', ['as' => 'homepage', 'uses' => 'PagesController@index']);

Route::get('/home', ['as' => 'homepage', 'uses' => 'PagesController@index']);

Route::get('/faq', ['as' => 'faq', 'uses' => 'PagesController@faq']);

Route::get('/contact', ['as' => 'contact', 'uses' => 'PagesController@contact']);

Route::post('/contact', ['as' => 'contact.post', 'uses' => 'PagesController@post_contact']);

/*Posts routes*/

Route::get('/posts/archive', ['as' => 'posts.archive', 'uses' => 'PagesController@Posts']);


Route::get('/post/{slug}', ['as' => 'PostBySlug', 'uses' => 'PagesController@PostBySlug']);

/*Route::get('/post/{id}', ['as' => 'post', 'uses' => 'PagesController@Post']);*/

Route::get('/page/{slug}', ['as' => 'page', 'uses' => 'PagesController@page']);

Route::post('subscribe', ['as' => 'subscription.submit', 'uses' => 'PagesController@SubmitSubscriber']);

Route::get('dashboard', ['as' => 'dashboard', 'uses' => 'PagesController@dashboard']);

Route::post('admin/users/search', ['as' => 'admin.users.search', 'uses' => 'UserController@search']);
Route::resource('admin/users', 'UserController');

Route::resource('admin/settings', 'SettingController');

Route::resource('admin/reports/stats', 'ReportStatController');

Route::resource('admin/reports/courses', 'ReportController');

Route::resource('admin/payments', 'PaymentController', ['except' => 'show']);

Route::resource('admin/faqs', 'FaqController', ['except' => 'show']);

Route::resource('admin/posts', 'PostController', ['except' => 'show' ]);

Route::get('admin/categories/{categoryId}/editCourse/{id}', ['as' => 'admin.categories.editCourse', 'uses' => 'CategoryController@editCourse']);
Route::get('admin/categories/createCourse/{id}', ['as' => 'admin.categories.createCourse', 'uses' => 'CategoryController@createCourse']);

/*search*/


Route::resource('admin/categories', 'CategoryController');

Route::resource('admin/lessons', 'LessonController', ['except' => 'show' ]);

Route::get('admin/courses/{courseId}/editLesson/{id}', ['as' => 'admin.courses.editLesson', 'uses' => 'CourseController@editLesson']);
Route::get('admin/courses/createLesson/{id}', ['as' => 'admin.courses.createLesson', 'uses' => 'CourseController@createLesson']);
Route::resource('admin/courses', 'CourseController');

Route::resource('admin/pages', 'PageController');

Route::resource('admin/groups', 'GroupController');

Route::resource('admin/vocabs', 'VocabController', ['except' => 'show' ]);

Route::resource('admin/album', 'VocabCatController', ['except' => 'show' ]);

Route::get('admin/exams/add/{id}', ['as' => 'admin.exams.add', 'uses' => 'ExamController@add']);

Route::get('admin/exams/{id}/lists', ['as' => 'admin.exams.lists', 'uses' => 'ExamController@lists']);

Route::resource('admin/exams', 'ExamController', ['except' => 'show' ]);

Route::get('admin/questions/add/{id}', ['as' => 'admin.questions.add', 'uses' => 'QuestionController@add']);

Route::get('admin/questions/{id}/lists', ['as' => 'admin.questions.lists', 'uses' => 'QuestionController@lists']);

Route::resource('admin/questions', 'QuestionController', ['except' => 'show' ]);

Route::post('admin/transactions/search', ['as' => 'admin.transactions.search', 'uses' => 'TransactionController@search']);
Route::resource('admin/transactions', 'TransactionController');


Route::resource('admin/messages', 'ContactController');

Route::resource('admin/subscription', 'SubscriptionController');





Route::get('/admin', ['as' => 'admin', 'uses' => 'HomeController@index']);



Route::auth();




 /*Test routes*/
/*Route::get('test/{id}', 'PagesController@tests');*/
 /*Test routes*/




/* Extra routes */



Route::get('testcat', 'PagesController@testcat');

Route::get('form', 'PagesController@testForm');

Route::get('ajax', 'PagesController@ajax');

Route::post('ajax/post', 'PagesController@ajaxpost');

Route::get('add-roles', 'PagesController@roles');

Route::post('test/submit/{id}', ['as' => 'submit.test', 'uses' => 'PagesController@submitTest']);

Route::get('/upload', 'PagesController@get_upload');

Route::get('/error', function(){
  return view('layouts.error');
});

/*End of extra routes*/

Route::get('activate/{token}', 'ActivationsController@activate')
     ->name('auth.activate')
     ->middleware('web');

Route::get('/activation/resend', 'ActivationsController@getResend')
     ->name('auth.reactivate')
     ->middleware('web');

Route::post('/activation/resend', 'ActivationsController@postResend')
     ->name('auth.reactivate')
     ->middleware('web');
