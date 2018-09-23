@extends('layouts.simple')

@section('title', 'آزمون دوره ' . $course->title)

@section('header-assets')

  <style media="screen">
    body{
      background: #f1f1f1;
    }
  </style>

@endsection

@section('content')
  <br>
  @if (count($errors) > 0)
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
        </div>
      </div>
    </div>

  @endif

  <div class="container">
    @if (session()->has('flash_notification.message'))
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="alert alert-{{ session('flash_notification.level') }}">
              <button type="button" class="close pull-left" data-dismiss="alert" aria-hidden="true">&times;</button>
              {!! session('flash_notification.message') !!}
          </div>
        </div>
      </div>

    @endif

  </div>
  @if(!empty($result))
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="content-box">
<!--            <p>
              شما تا به حال به {{count($user_answers)}} سوال از این درس پاسخ داده اید.
            </p>
            <p>
              {{$result->correct_responses}} عدد از جواب های شما درست می‌باشند
            </p>-->
            <div class="row">
              <div class="col-md-6 col-xs-12">
                <p>
                  درصد مورد نیاز برای پاس کردن آزمون: {{$result->required_score}}٪
                </p>
              </div>
              <div class="col-md-6 col-xs-12">
                <p>درصد سوالات صحیح پاسخ داده شده: {{$result->user_score}}٪</p>

              </div>
            </div>



            @if ($result->user_score >= $result->required_score)
              <!--<p>درصد گذرانده شده: {{$result->user_score}}</p>-->
              <div class="alert alert-success" role="alert">
                <button type="button" class="close pull-left" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <strong>تبریک میگوییم! </strong> شما این دوره را با موفقیت گذرانده اید.
              </div>
              <div class="progress">
                <div class="progress-bar " role="progressbar" style="width: {{$result->user_score}}%; line-height: 30px; height: 30px;" aria-valuenow="{{$result->user_score}}" aria-valuemin="0" aria-valuemax="100">{{$result->user_score}}درصد گذرانده شده</div>
              </div>

            @elseif ($result->user_score <= $result->required_score)
                <div class="alert alert-danger" role="alert">
                  <button type="button" class="close pull-left" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                  <strong>متاسفیم!</strong> شما موفق به گذراندن این دوره نشدید!
                </div>
                <div class="progress">
                  <div class="progress-bar  bg-danger" role="progressbar" style="width: {{$result->user_score}}%; line-height: 30px; height: 30px;" aria-valuenow="{{$result->user_score}}" aria-valuemin="0" aria-valuemax="100">{{$result->user_score}}درصد گذرانده شده</div>
                </div>


            @endif

          </div>
        </div>
      </div>
    </div>
  @endif





  @if (Auth::user()->paid == 1 || $category->paid == 1)
    @if (!$exams->isEmpty())
      <div class="container">
        <div class="">
          <h4>سوالات</h4>
          <hr>

          <p>
            این آزمون شامل {{count($exams)}} سوال می‌باشد.
          </p>

          <div class="row ltr">
            <div class="col-md-12">
              <div class="">
                {!! Form::open(['route' => ['course.exam.submit', $course->id], 'id' => 'form1']) !!}
                  @foreach ($exams as $key => $exam)
                    <div class="content-box">
                      <p class="mt-3 mb-3">
                        <b>* </b> <b>{{$exam->question}}</b>
                      </p>
                      <div class="row">
                        @if (!empty($exam->question_pic) && !is_null($exam->question_pic))
                          <div class="col-md-6">
                            <a href="{{URL::asset($exam->question_pic)}}" data-toggle="lightbox" data-title="" data-footer="">
                                <img src="{{URL::asset($exam->question_pic)}}" class="img-fluid img-responsive w-100 exam-pic" style="max-height: 200px; object-fit: cover;" alt="">
                            </a>

                          </div>
                        @endif

                        @if (!empty($exam->question_audio) && !is_null($exam->question_audio))
                          <div class="col-md-6">
                            <audio controls="controls" class="w-100 pt-5 mt-5">
                              Your browser does not support the <code>audio</code> element.
                              <source src="{{URL::asset($exam->question_audio)}}" type="">
                            </audio>
                          </div>
                        @endif
                      </div>
                      <br>
                    <!--<hr>

                        <fieldset class="form-group"><b>*</b>
                          <label for="exampleInputEmail1">Answer:</label>-->
                          <div class="form-group">

                            <div class="control-group">
                                <div class="controls">
                                  <input type="hidden" name="submitted_exams[]" value="{{$exam->id}}">
                                    <div class="row">
                                      <label class="radio inline col-md-3">
                                          <input type="radio" name="{{$exam->id}}" value="1" data-validation="required" required />
                                          {{$exam->opt_1}}
                                          @if (!empty($exam->pic_1))
                                            <a href="{{URL::asset($exam->pic_1)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                <img src="{{URL::asset($exam->pic_1)}}" class="img-fluid img-responsive w-100 exam-pic">
                                            </a>
                                          @endif
                                      </label>
                                      <label class="radio inline col-md-3">
                                          <input type="radio" name="{{$exam->id}}" value="2" data-validation="required" />
                                          {{$exam->opt_2}}
                                          @if (!empty($exam->pic_2))
                                            <a href="{{URL::asset($exam->pic_2)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                <img src="{{URL::asset($exam->pic_2)}}" class="img-fluid img-responsive w-100 exam-pic">
                                            </a>
                                          @endif
                                      </label>
                                      <label class="radio inline col-md-3">
                                          <input type="radio" name="{{$exam->id}}" value="3" data-validation="required" />
                                          {{$exam->opt_3}}
                                          @if (!empty($exam->pic_3))
                                            <a href="{{URL::asset($exam->pic_3)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                <img src="{{URL::asset($exam->pic_3)}}" class="img-fluid img-responsive w-100 exam-pic">
                                            </a>
                                          @endif
                                      </label>
                                      <label class="radio inline col-md-3">
                                          <input type="radio" name="{{$exam->id}}" value="4" data-validation="required" />
                                          {{$exam->opt_4}}
                                          @if (!empty($exam->pic_4))
                                            <a href="{{URL::asset($exam->pic_4)}}" data-toggle="lightbox" data-title="" data-footer="">
                                                <img src="{{URL::asset($exam->pic_4)}}" class="img-fluid img-responsive w-100 exam-pic">
                                            </a>
                                          @endif
                                      </label>
                                    </div>
                                </div>
                            </div>
                              <!--{!! Form::select('answer', [$exam->opt_1, $exam->opt_2, $exam->opt_3, $exam->opt_4], $exam->is_correct, ['class' => 'form-control']) !!}-->
                          </div>

                        </fieldset>
                        <div class="text-left clearfix">
                        </div>
                    </div>

                  @endforeach
                  <div class="text-left clearfix">
                    {!! Form::submit('ارسال', ['class' => 'btn btn-success pull-left GanjName']) !!}
                  </div>
                  <br>
                {!! Form::close() !!}
              </div>
            </div>
          </div>

        </div>
      </div>
    @elseif (Auth::user()->paid == 0 || $category->paid == 0)
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="jumbotron">

                <p>برای شرکت در آزمون‌ها باید اقدام به خرید اشتراک نمایید</p>
              </div>
            </div>
          </div>
        </div>
      @elseif (Auth::user()->paid == 2 || $category->paid == 2)
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="jumbotron">

                <p>برای شرکت در آزمون‌ها باید اقدام به خرید اشتراک نمایید</p>
              </div>
            </div>
          </div>
        </div>
      @else
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              <div class="jumbotron">
                <p>آزمون این دوره شامل هیچ سوالی نمی‌باشد</p> <p><a href="{{route('homepage')}}">بازگشت به صفحهٔ نخست</a> - <a href="{{route('course', $course->id)}}">بازگشت به دورهٔ {{$course->title}}</a></p>
              </div>
              <br>

            </div>
          </div>
        </div>
    @endif
  @endif

@endsection


@section('footer-assets')
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-fa_IR.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.17.0/dist/jquery.validate.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.js"></script>

<script type="text/javascript">
$(document).on('click', '[data-toggle="lightbox"]', function(event) {
  event.preventDefault();
  $(this).ekkoLightbox();
});
</script>

<script>
// only for demo purposes
$.validator.setDefaults({
  submitHandler: function() {
    alert("submitted!");
  }
});
$(document).ready(function() {
  $("#form1").validate();
  $("#selecttest").validate();
});
</script>

<script type="text/javascript">

</script>
@endsection
