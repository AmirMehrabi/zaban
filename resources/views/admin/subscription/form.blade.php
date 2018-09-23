@extends('layouts.admin')

@section('title', $subscription->exists ? 'ویرایش '.$subscription->name : 'ایجاد کاربر')


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
            <h3 class="box-title">{{$subscription->exists ? 'ویرایش کاربر ' . $subscription->title : 'افزودن کاربر جدید'}}
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
            {!! Form::model($subscription, [
              'method' => $subscription->exists ? 'put' : 'post',
              'route'  => $subscription->exists ? ['admin.subscription.update', $subscription->id] : ['admin.subscription.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">عنوان اشتراک</label>
                  {!! Form::text('name', $subscription->name, ['class' => 'form-control', 'placeholder' => 'مثال: اشتراک یک ماهه']) !!}
                </div>
              </div>
            </div>


            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">مدت زمان(روز)</label>
                  {!! Form::text('duration', $subscription->duration, ['class' => 'form-control', 'placeholder' => 'مثال: ۳۰']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">قیمت(ریال)</label>
                  {!! Form::text('price', $subscription->price, ['class' => 'form-control', 'placeholder' => 'مثال: ۱۰۰۰۰۰']) !!}
                </div>
              </div>
            </div>






            <div class="row">
              <div class="col-md-12 text-left">
                @if ($subscription->exists)
                  <a href="{{route('admin.subscription.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
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
