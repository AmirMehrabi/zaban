@extends('layouts.admin')


@section('header-assets')
  <link rel="stylesheet" href="css/master.css{{URL::asset('css/rtl-grid.css')}}">
@endsection



@section('content')



  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="content-box">
          @if (count($errors) > 0)
            <div class="row">
              @foreach ($errors->all() as $error)
                <div class="col-md-6">
                  <div class="alert alert-danger">
                    <p class="">{{ $error }}</p>
                  </div>
                </div>
              @endforeach
            </div>
          @endif


                  <h2 class="page-header">{{$exam->exists ? 'ویرایش سوال ' : 'ایجاد سوال'}}</h2>

                  {!! Form::model($exam, [
                    'method' => $exam->exists ? 'put' : 'post',
                    'route'  => $exam->exists ? ['admin.exams.update', $exam->id] : ['admin.questions.store'],
                    'files' => 'true'
                    ]) !!}
                    <div class="row">
                      <br>
                      <div class="col-md-12">
                        <fieldset class="form-group">
                          <label for="exampleTextarea">دوره مرتبط</label>
                          {!! Form::select('course', $course, $exam->course->id  , ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'placeholder' => 'یک گزینه را انتخاب کنید.', 'disabled' ]) !!}

                        </fieldset>

                        <fieldset class="form-group">
                          <label for="formGroupExampleInput">سوال</label>
                          <input type="text" name="question" class="form-control" id="formGroupExampleInput" placeholder="سوال خود را وارد کنید." value="{{$exam->question}}">
                        </fieldset>

                        <div class="row">
                          <hr>
                          <div class="col-md-6">
                            <fieldset class="form-group">
                              <label for="formGroupExampleInput">تصویر سوال</label>
                              {!! Form::file('question_pic') !!}
                              @if (!empty($exam->question_pic) && !is_null($exam->question_pic))
                                <img src="{{URL::asset($exam->question_pic)}}" class="img-fluid img-responsive w-100" style="max-height: 200px; object-fit: cover;" alt="">
                              @endif
                            </fieldset>
                          </div>
                          <div class="col-md-6">
                            <fieldset class="form-group">
                              <label for="formGroupExampleInput">صوت سوال</label>
                              {!! Form::file('question_audio') !!}
                              @if (!empty($exam->question_audio) && !is_null($exam->question_audio))
                                <br><br>
                                <audio controls="controls" class="w-100" style="width: 100%;">
                                  Your browser does not support the <code>audio</code> element.
                                  <source src="{{URL::asset($exam->question_audio)}}" type="">
                                </audio>
                              @endif
                            </fieldset>
                          </div>
                        </div>
                        <fieldset class="form-group hidden">
                          <label for="formGroupExampleInput">نمره</label>
                          {!! Form::number('score', $exam->score, ['class' => 'form-control']) !!}
                        </fieldset>
                        <hr>
                      </div>
                    </div>

                    <div class="row text-center">
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_1" class="form-control" id="formGroupExampleInput" placeholder="گزینه اول" value="{{$exam->opt_1}}">
                          {!! Form::radio('is_correct', 1) !!}
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_2" class="form-control" id="formGroupExampleInput" placeholder="گزینه دوم" value="{{$exam->opt_2}}">
                          {!! Form::radio('is_correct', 2) !!}
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_3" class="form-control" id="formGroupExampleInput" placeholder="گزینه سوم" value="{{$exam->opt_3}}">
                          {!! Form::radio('is_correct', 3) !!}
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_4" class="form-control" id="formGroupExampleInput" placeholder="گزینه چهارم" value="{{$exam->opt_4}}">
                          {!! Form::radio('is_correct', 4) !!}
                        </fieldset>
                      </div>
                    </div>

                    <div class="row text-center">
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          {!! Form::file('pic_1') !!}
                          @if (!empty($exam->pic_1))
                            <img src="{{URL::asset($exam->pic_1)}}" class="w-100 img-responsive" alt="">
                          @endif
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          {!! Form::file('pic_2') !!}
                          @if (!empty($exam->pic_2))
                            <img src="{{URL::asset($exam->pic_2)}}" class="w-100 img-responsive" alt="">
                          @endif
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          {!! Form::file('pic_3') !!}
                          @if (!empty($exam->pic_3))
                            <img src="{{URL::asset($exam->pic_3)}}" class="w-100 img-responsive" alt="">
                          @endif
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          {!! Form::file('pic_4') !!}
                          @if (!empty($exam->pic_4))
                            <img src="{{URL::asset($exam->pic_4)}}" class="w-100 img-responsive" alt="">
                          @endif
                        </fieldset>
                      </div>
                    </div>

                    <div class="row">
                      <div class="col-md-12">
                        {!! Form::submit('ذخیره', ['class' => 'btn btn-primary pull-left']) !!}
                        {!! Form::close() !!}
                      </div>
                    </div>



        </div>
      </div>
      <hr>
    </div>


  </div>
  <br>
@endsection


@section('footer-assets')
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/i18n/defaults-*.min.js"></script>


@endsection
