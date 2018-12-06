@extends('layouts.simple')

@section('title', 'آزمون درس ' . $lesson->title)


@section('header-assets')

  <style media="screen">
    body{
      background: #f1f1f1;
    }
  </style>

@endsection

@section('content')


  @if (count($user_answers))
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="content-box">
            <p>
              شما تا به حال به {{count($user_answers)}} سوال از این درس پاسخ داده اید.
            </p>
            <p>
              {{$user_correct_answers}} عدد از جواب های شما درست می‌باشند
            </p>

            @if ($passed_exam_percent >= $lesson->min_grade)
              <div class="alert alert-success" role="alert">
                <button type="button" class="close pull-left" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>تبریک میگوییم! </strong> شما این دوره را با موفقیت گذرانده اید.
              </div>
              @else
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close pull-left" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>متاسفیم!</strong> شما موفق به گذراندن این دوره نشدید!
                </div>
            @endif

            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: {{$passed_exam_percent}}%" aria-valuenow="{{$passed_exam_percent}}" aria-valuemin="0" aria-valuemax="100">{{$passed_exam_percent}}درصد گذرانده شده</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif

<div class="container">
</div>


  <div class="container">
    @if (session()->has('flash_notification.message'))
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-{{ session('flash_notification.level') }}">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('flash_notification.message') !!}
          </div>
        </div>
      </div>

    @endif

    @if (Auth::user()->paid == 1 || $category->paid == 1)
      <div class="row">
        <div class="col-md-12">
          <div class="container">
            <div class="">
              <br>
              <h4>سوالات</h4>
              <hr>

              <p>
                این آزمون شامل {{count($questions)}} سوال می‌باشد.
              </p>

              <div class="row">
                <div class="col-md-12">
                  <div class="">
                    {!! Form::open(['route' => ['lesson.exam.submit', $lesson->id]]) !!}
                      @foreach ($questions as $key => $question)
                        <div class="content-box">
                          <p>
                            <b>سوال: </b>{{$question->question}}
                          </p>


                        <!-- {{$question->percent}} -->
                        <hr>

                            <fieldset class="form-group">{{$question->id}}
                              <label for="exampleInputEmail1">انتخاب پاسخ:</label>
                              <div class="form-group">

                                <div class="control-group">
                                    <div class="row controls">
                                      <input type="hidden" name="submitted_exams[]" value="{{$question->id}}">
                                        <label class="radio inline col-md-3">
                                            <input type="radio" name="{{$question->id}}" value="1"  />
                                            {{$question->opt_1}}
                                            @if (!empty($question->pic_1))
                                              <a href="{{URL::asset($question->pic_1)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                  <img src="{{URL::asset($question->pic_1)}}" class="img-fluid img-responsive w-100 exam-pic">
                                              </a>
                                            @endif
                                        </label>
                                        <label class="radio inline col-md-3">
                                            <input type="radio" name="{{$question->id}}" value="2" />
                                            {{$question->opt_2}}
                                            @if (!empty($question->pic_2))
                                              <a href="{{URL::asset($question->pic_2)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                  <img src="{{URL::asset($question->pic_2)}}" class="img-fluid img-responsive w-100 exam-pic">
                                              </a>
                                            @endif
                                        </label>
                                        <label class="radio inline col-md-3">
                                            <input type="radio" name="{{$question->id}}" value="3"  />
                                            {{$question->opt_3}}
                                            @if (!empty($question->pic_3))
                                              <a href="{{URL::asset($question->pic_3)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                  <img src="{{URL::asset($question->pic_3)}}" class="img-fluid img-responsive w-100 exam-pic">
                                              </a>
                                            @endif
                                        </label>
                                        <label class="radio inline col-md-3">
                                            <input type="radio" name="{{$question->id}}" value="4" />
                                            {{$question->opt_4}}
                                            @if (!empty($question->pic_4))
                                              <a href="{{URL::asset($question->pic_4)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                  <img src="{{URL::asset($question->pic_4)}}" class="img-fluid img-responsive w-100 exam-pic">
                                              </a>
                                            @endif
                                        </label>
                                    </div>
                                </div>
                                  <!--{!! Form::select('answer', [$question->opt_1, $question->opt_2, $question->opt_3, $question->opt_4], $question->is_correct, ['class' => 'form-control']) !!}-->
                              </div>

                            </fieldset>
                            <div class="text-left clearfix">
                            </div>
                        </div>

                      @endforeach
                      <div class="text-left clearfix">
                        {!! Form::submit('ارسال', ['class' => 'btn btn-success pull-left']) !!}
                      </div>
                      <br>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>

            </div>
          </div>


        </div>
      </div>

    @elseif (Auth::user()->paid == 0 || Auth::user()->paid == 2 || $category->paid == 0 || $category->paid == 2)
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron">
              <p>برای شرکت در آزمون‌ها باید اقدام به خرید اشتراک نمایید.</p>
            </div>
          </div>
        </div>
    @endif
  </div>


@endsection


@section('footer-assets')
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>

  <script src="//cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>
  <script>

      // Add validator
      $.formUtils.addValidator({
          name : 'even',
          validatorFunction : function(value, $el, config, language, $form) {
              return parseInt(value, 10) % 2 === 0;
          },
          errorMessage : 'You have to answer an even number',
          errorMessageKey: 'badEvenNumber'
      });

      // Initiate form validation
      $.validate();

  </script>

@endsection
