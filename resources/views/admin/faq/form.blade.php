@extends('layouts.admin')

@section('title', $faq->exists ? 'ویرایش '.$faq->title : 'ایجاد صفحه')


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
            <h3 class="box-title">{{$faq->exists ? 'ویرایش صفحه ' . $faq->title : 'افزودن صفحه جدید'}}
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
            {!! Form::model($faq, [
              'method' => $faq->exists ? 'put' : 'faq',
              'route'  => $faq->exists ? ['admin.faqs.update', $faq->id] : ['admin.faqs.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">سوال</label>
                  {!! Form::text('question', $faq->question, ['class' => 'form-control', 'placeholder' => ' سوال را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label for="">جواب</label>
                  {!! Form::text('answer', $faq->answer, ['class' => 'form-control', 'placeholder' => ' جواب را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>









            <div class="row">
              <div class="col-md-12 text-left">
                @if ($faq->exists)
                  <a href="{{route('admin.faqs.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
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
