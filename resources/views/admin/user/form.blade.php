@extends('layouts.admin')

@section('title', $user->exists ? 'ویرایش '.$user->name : 'ایجاد کاربر')


@section('header-assets')
  <link rel="stylesheet" href="{{URL::asset('css/rtl-grid.css')}}">
@endsection


@section('title', 'صفحه اصلی')


@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header text-right">
    <h1>
      مدیریت کاربر ها
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$user->exists ? 'ویرایش کاربر ' . $user->title : 'افزودن کاربر جدید'}}
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
          <!-- /.box-header -->
          <div class="box-body pad">
            {!! Form::model($user, [
              'method' => $user->exists ? 'put' : 'post',
              'route'  => $user->exists ? ['admin.users.update', $user->id] : ['admin.users.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">نام و نام خانوادگی</label>
                  {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'نام و نام خانوادگی']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">ایمیل</label>
                  {!! Form::text('email', $user->email, ['class' => 'form-control', 'placeholder' => 'رایانامه']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">استان</label>
                  {!! Form::text('state', $user->state, ['class' => 'form-control', 'placeholder' => 'استان']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">شهر</label>
                  {!! Form::text('city', $user->city, ['class' => 'form-control', 'placeholder' => 'شهر']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">نقش کاربر</label>
                  {!! Form::select('role', $roles, null, ['multiple' => 'false', 'class' => 'selectpicker form-control', 'data-live-search' => 'true']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">نقش کاربر</label>
                  {!! Form::select('active', [1 => 'Activated',  0 => 'Deactivated'], $user->active,  ['multiple' => 'false', 'class' => 'selectpicker form-control', 'data-live-search' => 'true']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">کلمه عبور</label>
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'کلمه عبور خود را وارد کنید']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">کلمه عبور</label>
                  {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'تکرار کلمه عبور خود را وارد کنید']) !!}
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12 text-left">
                @if ($user->exists)
                  <a href="{{route('admin.users.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
                @endif
                  {{Form::submit('ارسال', ['class' => 'btn btn-success pull-left'])}}
              </div>
            </div>

            {{Form::close()}}
          </div>



          </div>
        </div>
        <!-- /.box -->
      </div>
      <!-- /.col-->
    </div>
    <!-- ./row -->
  </section>
  <!-- /.content -->


@endsection


@section('footer-assets')
  <script src="{{URL::asset('AdminLTE/dist/js/app.min.js')}}"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="{{URL::asset('AdminLTE/dist/js/demo.js')}}"></script>

  @section('footer-assets')
    <script src="{{URL::asset('vendor/unisharp/laravel-ckeditor/ckeditor.js')}}"></script>
    <script>
        CKEDITOR.replace('excerpt');
        CKEDITOR.replace('body'   );
    </script>
  @endsection


@endsection
