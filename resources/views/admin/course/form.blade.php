@extends('layouts.admin')

@section('title', $course->exists ? 'ویرایش '.$course->title : 'ایجاد فصل')

@section('header-assets')
  <link rel="stylesheet" href="{{URL::asset('css/rtl-grid.css')}}">
@endsection


@section('content')
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h4 class="box-title">{{$course->exists ? 'ویرایش فصل ' . $course->title : 'افزودن فصل'}}</h4>
            <hr>
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


            {!! Form::model($course, [
              'method' => $course->exists ? 'put' : 'post',
              'route'  => $course->exists ? ['admin.courses.update', $course->id] : ['admin.courses.store'],
              'files' => 'true'
              ]) !!}

              <fieldset class="form-group">
                <label for="exampleInputEmail1">تیتر</label>
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'عنوان فصل اینجا قرار می‌گیرد']) !!}
              </fieldset>


              <fieldset class="form-group">
                <label for="exampleTextarea">خلاصه</label>
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'متن فصل', 'id' => 'body']); !!}
              </fieldset>

              <div class="row">
                <hr>

                @if (!empty($course->video))
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">فیلم فصل</label>
                      <div class="form-group">
                      {!! Form::file('video', ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for=""></label>
                      <video class="courseVideo" class="w-100" style="max-width: 100%;" controls>
                        <source src="{{URL::asset($course->video)}}" type="video/webm">
                        <source src="{{URL::asset($course->video)}}" type="video/mp4">
                        I'm sorry; your browser doesn't support HTML5 video in WebM with VP8/VP9 or MP4 with H.264.
                      </video>
                    </div>
                  </div>
                  @else
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">فیلم فصل</label>
                        <div class="form-group">
                        {!! Form::file('video', ['class' => 'form-control']) !!}
                        </div>
                      </div>
                    </div>
                @endif

                @if (!empty($course->picture))
                  <div class="col-md-3">
                    <div class="form-group">
                      <label for="">تصویر فصل</label>
                      <div class="form-group">
                      {!! Form::file('picture', ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-3">
                    <div class="form-group">
                      <img style="max-width: 100%;" src="{{URL::asset($course->picture)}}" class="img-responsive" alt="">
                    </div>
                  </div>
                  @else
                    <div class="col-md-6">
                      <div class="form-group">
                        <label for="">تصویر فصل</label>
                        <div class="form-group">
                        {!! Form::file('picture', ['class' => 'form-control']) !!}
                        </div>
                      </div>
                    </div>
                @endif

              </div>

              <fieldset class="form-group">
                <label for="exampleTextarea">درصد نمره مورد نیاز برای قبولی</label>
                {!! Form::number('required_score', $course->required_score, ['multiple' => 'true', 'class' => 'selectpicker form-control', 'data-live-search' => 'true', 'min' => '1', 'max' => '100']) !!}
              </fieldset>

              <fieldset class="form-group">
                <label for="exampleTextarea">دروس</label>
                {!! Form::select('lessons[]', $lessons, $course_lessons, ['multiple' => 'true', 'class' => 'selectpicker form-control', 'data-live-search' => 'true']) !!}
              </fieldset>

              <fieldset class="form-group">
                <label for="exampleTextarea">فصل پیش نیاز</label>
                {!! Form::select('required_course', $courses, $course->required_course, [ 'class' => 'selectpicker form-control', 'data-live-search' => 'true', 'multiple']) !!}
              </fieldset>

              @if ($course->exists)
                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="">ترتیب</label>
                      <div class="form-group">

                      </div>
                    </div>
                  </div>
                  <div class="col-md-2">
                    <div class="form-group">
                      <div class="form-group">
                        {!! Form::select('order', [
                          '' => '',
                          'before' => 'قبل از',
                          'after' => 'بعد از'
                        ], null, ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                  <div class="col-md-5">
                    <div class="form-group">

                      <div class="form-group">
                        {!! Form::select('orderPage', [
                          '' => ''
                          ] + $orderPages->lists('padded_title', 'id')->toArray(), null, ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
                </div>
              @endif

              <div class="row">
                <div class="col-md-12 text-left">
                  @if ($course->exists)
                    <a href="{{route('admin.courses.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
                    <a href="{{route('admin.exams.lists', $course->id)}}" class="btn btn-success " style="margin-left: 10px;">مدیریت آزمون</a>
                  @endif
                  {!! Form::submit('ذخیره', ['class' => 'btn btn-primary pull-left']) !!}

                </div>
              </div>

            {!! Form::close() !!}
          </div>
          <div class="clearfix">

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

  <script src="{{URL::asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  <script>
      CKEDITOR.replace( 'body' );
  </script>
@endsection
