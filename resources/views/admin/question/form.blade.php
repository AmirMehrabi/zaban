@extends('layouts.app')


@section('header-assets')
  <link rel="stylesheet" href="css/master.css{{URL::asset('css/rtl-grid.css')}}">
@endsection



@section('content')

  <div class="container">
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

                  @if (session()->has('flash_notification.message'))
                      <div class="alert alert-{{ session('flash_notification.level') }}">
                          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                          {!! session('flash_notification.message') !!}
                      </div>
                  @endif

                  <h2 class="page-header">{{$question->exists ? 'ویرایش سوال ' : 'ایجاد سوال'}}</h2>

                  {!! Form::model($question, [
                    'method' => $question->exists ? 'put' : 'post',
                    'route'  => $question->exists ? ['admin.questions.update', $question->id] : ['admin.questions.store'],
                    'files' => 'true'
                    ]) !!}
                    <div class="row">
                      <br>
                      <div class="col-md-12">
                        <fieldset class="form-group">
                          <label for="exampleTextarea">درس مرتبط</label>
                          {!! Form::select('lesson', $lesson,  $question->lesson->id, ['class' => 'selectpicker form-control', 'data-live-search' => 'true', 'placeholder' => 'یک گزینه را انتخاب کنید.', 'disabled']) !!}
                          {!! Form::hidden('lesson', $question->lesson->id) !!}

                        </fieldset>


                        <fieldset class="form-group">
                          <label for="formGroupExampleInput">سوال</label>
                          <input type="text" name="question" class="form-control" id="formGroupExampleInput" placeholder="سوال خود را وارد کنید." value="{{$question->question}}">
                        </fieldset>
                        <fieldset class="form-group">
                          <label for="formGroupExampleInput">نمره</label>
                          {!! Form::number('score', $question->score, ['class' => 'form-control']) !!}
                        </fieldset>
                        <hr>
                      </div>
                    </div>

                    <div class="row text-center">
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_1" class="form-control" id="formGroupExampleInput" placeholder="گزینه اول" value="{{$question->opt_1}}">
                          {!! Form::radio('is_correct', 1) !!}
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_2" class="form-control" id="formGroupExampleInput" placeholder="گزینه دوم" value="{{$question->opt_2}}">
                          {!! Form::radio('is_correct', 2) !!}
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_3" class="form-control" id="formGroupExampleInput" placeholder="گزینه سوم" value="{{$question->opt_3}}">
                          {!! Form::radio('is_correct', 3) !!}
                        </fieldset>
                      </div>
                      <div class="col-md-3">
                        <fieldset class="form-group">
                          <input type="text" name="opt_4" class="form-control" id="formGroupExampleInput" placeholder="گزینه چهارم" value="{{$question->opt_4}}">
                          {!! Form::radio('is_correct', 4) !!}
                        </fieldset>
                      </div>
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

  <script src="{{URL::asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  <script>
      CKEDITOR.replace( 'body' );
  </script>
@endsection
