@extends('layouts.frontend')

@section('content-section')


  @if (!empty($user_answers))
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
            <p>
              برای پاس کردن این آزمون به ۲۰ نمره نیاز دارید. در حال حاضر {{$user_answers_scores}} نمره کسب کرده اید.
            </p>
            <div class="progress">
              <div class="progress-bar" role="progressbar" style="width: {{$correct_user_answers_sum}}%" aria-valuenow="{{$correct_user_answers_sum}}" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  @endif



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

  </div>

  <div class="container">
    <div class="">
      <h4>سوالات</h4>
      <hr>

      <p>
        این آزمون شامل {{count($exams)}} سوال می‌باشد.
      </p>
      @foreach ($exams as $number =>$exam )
        <div class="row">
          <div class="col-md-12">
            <div class="content-box">
              <p>
                <b>سوال: </b>{{$exam->question}}
              </p>

  <!--                    <div class="progress">
                <div class="progress-bar" role="progressbar" style="width: {{$exam->percent}}%" aria-valuenow="{{$exam->percent}}" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <br>
              <br>-->
              {!! Form::open(['route' => ['course.exam.submit', $course->id]]) !!}
              {!! Form::hidden('id', $exam->id) !!}

  <!--                  {{$exam->percent}}-->
  <hr>

                <fieldset class="form-group">
                  <label for="exampleInputEmail1">انتخاب پاسخ:</label>
                  <div class="form-group">

                    <div class="control-group">
                        <div class="controls">
                            <label class="radio inline col-md-3">
                                <input type="radio" name="answer" value="1"/>
                                {{$exam->opt_1}}
                            </label>
                            <label class="radio inline col-md-3">
                                <input type="radio" name="answer" value="2"/>
                                {{$exam->opt_2}}
                            </label>
                            <label class="radio inline col-md-3">
                                <input type="radio" name="answer" value="3"/>
                                {{$exam->opt_3}}
                            </label>
                            <label class="radio inline col-md-3">
                                <input type="radio" name="answer" value="4"/>
                                {{$exam->opt_4}}
                            </label>
                        </div>
                    </div>
                      <!--{!! Form::select('answer', [$exam->opt_1, $exam->opt_2, $exam->opt_3, $exam->opt_4], $exam->is_correct, ['class' => 'form-control']) !!}-->
                  </div>

                </fieldset>


  <!--                      <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios1" value="1" checked>
                    {{$exam->opt_1}}
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios2" value="2">
                    {{$exam->opt_2}}
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="3">
                    {{$exam->opt_3}}
                  </label>
                </div>
                <div class="radio">
                  <label>
                    <input type="radio" name="optionsRadios" id="optionsRadios3" value="4">
                    {{$exam->opt_4}}
                  </label>
                </div>-->
                <div class="text-left clearfix">
                  {!! Form::submit('ارسال', ['class' => 'btn btn-default pull-left']) !!}
                </div>
              {!! Form::close() !!}
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </div>
@endsection


@section('footer-assets')
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>


@endsection
