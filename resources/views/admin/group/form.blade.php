@extends('layouts.admin')

@section('title', $group->exists ? 'ویرایش '.$group->category_name : 'ایجاد دسته بندی')


@section('content')


  <section class="content-header text-right">
    <h1>
      مدیریت دسته بندی ها
    </h1>

  </section>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$group->exists ? 'ویرایش دسته بندی ' . $group->name : 'ایجاد دسته بندیٔ جدید'}}
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

            {!! Form::model($group, [
              'method' => $group->exists ? 'put' : 'post',
              'route'  => $group->exists ? ['admin.groups.update', $group->id] : ['admin.groups.store'],
              'files' => 'true'
              ]) !!}

              <fieldset class="form-group">
                <label for="exampleInputEmail1">عنوان</label>
                {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'عنوان دسته بندی اینجا قرار می‌گیرد.']) !!}
              </fieldset>


              <fieldset class="form-group">
                <label for="exampleTextarea">توضیحات</label>
                {!! Form::textarea('description', null, ['class' => 'form-control', 'placeholder' => 'متن دوره', 'id' => 'body']); !!}
              </fieldset>


              <fieldset class="form-group">
                <label for="exampleTextarea">صفحه ها</label>
                {!! Form::select('posts[]', $posts, $group_posts, ['multiple' => 'true', 'class' => 'selectpicker form-control', 'data-live-search' => 'true']) !!}
              </fieldset>
              <div class="row">
                <div class="col-md-12 text-left">
                  @if ($group->exists)
                    <a href="{{route('admin.groups.index')}}" class="btn btn-secondary">انصراف</a>
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
