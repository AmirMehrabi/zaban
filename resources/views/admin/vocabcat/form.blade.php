@extends('layouts.admin')

@section('title', $vocabcat->exists ? 'ویرایش '.$vocabcat->title : 'ایجاد آلبوم')


@section('title', 'صفحه اصلی')


@section('header-assets')
  <link rel="stylesheet" href="{{URL::asset('css/rtl-grid.css')}}">
@endsection



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
            <h3 class="box-title">{{$vocabcat->exists ? 'ویرایش آلبوم ' . $vocabcat->title : 'افزودن آلبوم جدید'}}
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

            {!! Form::model($vocabcat, [
              'method' => $vocabcat->exists ? 'put' : 'post',
              'route'  => $vocabcat->exists ? ['admin.album.update', $vocabcat->id] : ['admin.album.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">نام آلبوم</label>
                  {!! Form::text('title', $vocabcat->engName, ['class' => 'form-control', 'placeholder' => 'نام آلبوم را اینجا وارد کنید']) !!}
                </div>
              </div>
              @if (!empty($vocabcat->picture))
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">تصویر واژه</label>
                    <div class="form-group">
                    {!! Form::file('picture', ['class' => 'form-control']) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <img src="{{URL::asset($vocabcat->picture)}}" class="img-responsive" alt="">
                  </div>
                </div>
                @else
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">تصویر واژه</label>
                      <div class="form-group">
                      {!! Form::file('picture', ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
              @endif
            </div>


            <div class="row">
              <div class="col-md-12">
                <hr>
                @if ($vocabcat->exists)
                  <a href="{{route('admin.album.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
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


@endsection
