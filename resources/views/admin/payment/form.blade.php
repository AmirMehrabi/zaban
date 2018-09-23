@extends('layouts.admin')


@section('header-assets')
  <link rel="stylesheet" href="{{URL::asset('css/rtl-grid.css')}}">
@endsection


@section('title', 'صفحه اصلی')


@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header text-right">
    <h1>
      مدیریت آلبوم ها
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$user->exists ? 'ویرایش آلبوم ' . $user->title : 'افزودن آلبوم جدید'}}
            </h3>
            <hr>
          <!-- /.box-header -->
          <div class="box-body pad">
            {!! Form::model($user, [
              'method' => $user->exists ? 'put' : 'post',
              'route'  => $user->exists ? ['admin.posts.update', $user->id] : ['admin.posts.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">نام و نام خانوادگی</label>
                  {!! Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'تیتر نوشته را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">ایمیل</label>
                  {!! Form::text('name', $user->email, ['class' => 'form-control', 'placeholder' => 'تیتر نوشته را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">کلمه عبور</label>
                  {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'تیتر نوشته را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>

            
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  {{Form::submit('ارسال', ['class' => 'btn btn-success pull-left'])}}
                </div>
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
