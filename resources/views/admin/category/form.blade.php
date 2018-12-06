@extends('layouts.admin')

@section('title', $category->exists ? 'ویرایش '.$category->category_name : 'ایجاد دوره')


@section('content')


  <section class="content-header text-right">
    <h1>
      مدیریت دوره ها
    </h1>

  </section>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$category->exists ? 'ویرایش دوره ' . $category->category_name : 'ایجاد دورهٔ جدید'}}
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

            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! session('flash_notification.message') !!}
                </div>
            @endif

            {!! Form::model($category, [
              'method' => $category->exists ? 'put' : 'post',
              'route'  => $category->exists ? ['admin.categories.update', $category->id] : ['admin.categories.store'],
              'files' => 'true'
              ]) !!}

              <fieldset class="form-group">
                <label for="exampleInputEmail1">عنوان</label>
                {!! Form::text('category_name', null, ['class' => 'form-control', 'placeholder' => 'عنوان دوره اینجا قرار می‌گیرد']) !!}
              </fieldset>


              <fieldset class="form-group">
                <label for="exampleTextarea">توضیحات</label>
                {!! Form::textarea('description', null, ['class' => 'form-control', 'id' => 'body']); !!}
              </fieldset>



              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">قیمت(ریال)</label>
                    {!! Form::text('subscription_price', $category->subscription_price, ['class' => 'form-control', 'placeholder' => 'مثال: ۱۰۰۰۰۰']) !!}
                  </div>
                </div>
              </div>


              @if (!empty($category->picture))
                <div class="row">
                  <div class="col-md-3">
                    <fieldset class="form-group">
                      <label for="exampleTextarea">تصویر دوره</label>
                      {!! Form::file('picture', ['class' => 'form-control']) !!}
                    </fieldset>
                  </div>
                  <div class="col-md-3">
                    <fieldset class="form-group">
                      <label for="exampleTextarea">تصویر دوره</label>
                      <img src="{{URL::asset($category->picture)}}" class="img-responsive" alt="">
                    </fieldset>
                  </div>

                </div>
                @else
                  <fieldset class="form-group">
                    <label for="exampleTextarea">تصویر دوره</label>
                    {!! Form::file('picture', ['class' => 'form-control']) !!}
                  </fieldset>
              @endif

              @if ($category->exists)
                <fieldset class="form-group">
                  <label for="exampleTextarea">لیست فصل‌های زیرمجموعه</label>
                  {!! Form::select('courses[]', $courses, $category_courses, ['multiple' => 'true', 'class' => 'selectpicker form-control', 'data-live-search' => 'true']) !!}
                </fieldset>
              @endif

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
                        ] + $orderPages->lists('category_name', 'id')->toArray(), null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-md-12 text-left">
                  @if ($category->exists)
                    <a href="{{route('admin.categories.index')}}" class="btn btn-secondary">انصراف</a>
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
