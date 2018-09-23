@extends('layouts.admin')

@section('title', $post->exists ? 'ویرایش '.$post->title : 'ایجاد صفحه')


@section('header-assets')
  <link rel="stylesheet" href="{{URL::asset('css/rtl-grid.css')}}">
@endsection


@section('title', 'صفحه اصلی')


@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header text-right">
    <h1>
      مدیریت صفحات
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$post->exists ? 'ویرایش صفحه ' . $post->title : 'افزودن صفحه جدید'}}
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
            {!! Form::model($post, [
              'method' => $post->exists ? 'put' : 'post',
              'route'  => $post->exists ? ['admin.pages.update', $post->id] : ['admin.pages.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">تیتر</label>
                  {!! Form::text('title', $post->engName, ['class' => 'form-control', 'placeholder' => 'تیتر نوشته را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>

            <div class="row">

              @if (!empty($post->picture))
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">تصویر</label>
                    <div class="form-group">
                    {!! Form::file('picture', ['class' => 'form-control']) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <img src="{{URL::asset($post->picture)}}" class="img-responsive" alt="">
                  </div>
                </div>
                @else
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">تصویر صفحه</label>
                      <div class="form-group">
                      {!! Form::file('picture', ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
              @endif
            </div>
            <div class="row hidden" >
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">نوع نوشته</label>
                  {!! Form::select('is_special', [0 => 'نوشته معمولی', 1 => 'نوشته ویژه'], 0, ['class' => 'form-control', 'placeholder' => 'نوشتهٔ معمولی یا ویژه']) !!}
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">خلاصهٔ نوشته</label>
                  {!! Form::textarea('excerpt', null, ['class' => 'form-control', 'placeholder' => 'تیتر نوشته را اینجا وارد کنید']) !!}
                </div>
              </div>
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">متن کامل</label>
                  <div class="form-group">
                  {!! Form::textarea('body', null, ['class' => 'form-control']) !!}
                  </div>
                </div>
              </div>
            </div>

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
                      'after' => 'بعد از',
                      'childOf' => 'زیرمجموعهٔ'
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


            <div class="row">
              <div class="col-md-12 text-left">
                @if ($post->exists)
                  <a href="{{route('admin.pages.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
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
