@extends('layouts.admin')

@section('title', $lesson->exists ? 'ویرایش '.$lesson->title : 'ایجاد درس')


@section('header-assets')
  <link rel="stylesheet" href="{{URL::asset('css/rtl-grid.css')}}">
@endsection

@section('content')



  <section class="content-header text-right">
    <h1>
      مدیریت دروس
    </h1>

  </section>

  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$lesson->exists ? 'ویرایش دسته بندی ' . $lesson->title : 'ایجاد واژهٔ جدید'}}
            </h3>
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



            {!! Form::model($lesson, [
              'method' => $lesson->exists ? 'put' : 'post',
              'route'  => $lesson->exists ? ['admin.lessons.update', $lesson->id] : ['admin.lessons.store'],
              'files' => 'true'
              ]) !!}
              <fieldset class="form-group">
                <label for="exampleInputEmail1">تیتر</label>
                {!! Form::text('title', null, ['class' => 'form-control', 'placeholder' => 'تیتر دروس اینجا قرار می‌گیرد']) !!}
              </fieldset>
              <fieldset class="form-group">
                <label for="exampleInputPassword1">خلاصه</label>
                {!! Form::text('excerpt', null, ['class' => 'form-control', 'placeholder' => 'خلاصه‌ای از درس']); !!}
              </fieldset>
              <fieldset class="form-group hidden">
                <label for="exampleInputPassword1">حداقل نمرهٔ مورد نیاز</label>
                {!! Form::text('min_grade', 60, ['class' => 'form-control', 'placeholder' => 'حداقل نمره‌ای که برای پاس شدن در آزمون نیاز است']); !!}
              </fieldset>

              <fieldset class="form-group">
                <label for="exampleTextarea">درس پیش نیاز</label>
                {!! Form::select('prerequisite_lesson', $lessons, $lesson->prerequisite_lesson, [ 'class' => 'selectpicker form-control', 'data-live-search' => 'true']) !!}
              </fieldset>

              <fieldset class="form-group">
                <label for="exampleTextarea">بدنه/متن</label>
                {!! Form::textarea('body', null, ['class' => 'form-control', 'placeholder' => 'متن درس', 'id' => 'body']); !!}
              </fieldset>
              <fieldset class="form-group">
                <div class="row">
                  <div class="col-md-6">
                    <label for="exampleTextarea">ضمیمه</label>
                    {!! Form::file('video', ['class' => 'form-control', 'placeholder form-control' => 'متن درس', 'id' => 'body', 'class' => 'btn btn-default']); !!}
                  </div>
                  @if ($lesson->exists && isset($lesson->video))
                    <div class="col-md-6">
                      <video style="width: 100%;" controls>
                        <source src="{{URL::asset('placeholder.mp4')}}" type="video/mp4">
                        Your browser does not support HTML5 video.
                      </video>
                    </div>
                  @endif

                </div>
                <div class="row">
                  <div class="col-md-12 text-left">
                     <hr>
                     @if ($lesson->exists)
                       <a href="{{route('admin.lessons.index')}}" class="btn btn-secondary">انصراف</a>
                       <a href="{{route('admin.questions.lists', $lesson->id)}}" class="btn btn-success">مدیریت آزمون</a>
                     @endif
                    {!! Form::submit('ذخیره', ['class' => 'btn btn-primary ']) !!}


                  </div>
                </div>
              </fieldset>
          </div>


        </div>
      </div>
    </div>
    {!! Form::close() !!}

    @if ($lesson->exists)

      <br><hr><br>

      <div class="row">
        <div class="col-md-12">

        </div>
      </div>
    @endif
  </div>



@endsection


@section('footer-assets')
  <!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/css/bootstrap-select.min.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.2/js/bootstrap-select.min.js"></script>
  <script src="{{URL::asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
  <script>
      CKEDITOR.replace( 'body' );
  </script>
@endsection
