@extends('layouts.admin')

@section('title', $vocab->exists ? 'ویرایش '.$vocab->engName : 'ایجاد واژه')


@section('header-assets')
  <link rel="stylesheet" href="css/master.css{{URL::asset('css/rtl-grid.css')}}">
@endsection




@section('title', $vocab->exists ? 'ویرایش لغت ' . $vocab->faName : 'ایجاد لغت')



@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header text-right">
    <h1>
      مدیریت واژگان
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="box box-info">
          <div class="box-header">
            <h3 class="box-title">{{$vocab->exists ? 'ویرایش واژه ' . $vocab->faName : 'ایجاد واژهٔ جدید'}}
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

            {!! Form::model($vocab, [
              'method' => $vocab->exists ? 'put' : 'post',
              'route'  => $vocab->exists ? ['admin.vocabs.update', $vocab->id] : ['admin.vocabs.store'],
              'files' => 'true'
              ]) !!}
            <!-- tools box -->
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">لغت انگلیسی</label>
                  {!! Form::text('engName', $vocab->engName, ['class' => 'form-control', 'placeholder' => 'نوشتار انگلیسی لغت را اینجا وارد کنید']) !!}
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">لغت فارسی</label>
                  {!! Form::text('faName', $vocab->faName, ['class' => 'form-control', 'placeholder' => 'نوشتار فارسی لغت را اینجا وارد کنید']) !!}
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label for="">دسته بندی</label>
                  <div class="form-group">
                    {!! Form::select('vocabcat_id', $vocabcats, null, ['class' => 'form-control']) !!}

                  </div>
                </div>
              </div>
            </div>

            @if ($vocab->exists)
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="">ترتیب</label>

                  </div>
                </div>
                <div class="col-md-5">
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
                <div class="col-md-7">
                  <div class="form-group">

                    <div class="form-group">
                      {!! Form::select('orderPage', [
                        '' => ''
                        ] + $orderPages->lists('engName', 'id')->toArray(), null, ['class' => 'form-control']) !!}
                    </div>
                  </div>
                </div>
              </div>
            @endif



            <div class="row">
              <hr>

              @if (!empty($vocab->picture))
                <div class="col-md-3">
                  <div class="form-group">
                    <label for="">صوت تلفظ</label>
                    <div class="form-group">
                    {!! Form::file('picture', ['class' => 'form-control']) !!}
                    </div>
                  </div>
                </div>
                <div class="col-md-3">
                  <div class="form-group">
                    <label for=""></label>
                    <audio controls style="max-width: 100%; min-width: 100%;">
                      <source src="{{URL::asset($vocab->pronunciation)}}" type="audio/ogg">
                    Your browser does not support the audio element.
                    </audio>
                  </div>
                </div>
                @else
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="">صوت تلفظ</label>
                      <div class="form-group">
                      {!! Form::file('pronunciation', ['class' => 'form-control']) !!}
                      </div>
                    </div>
                  </div>
              @endif

              @if (!empty($vocab->picture))
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

                    <img src="{{URL::asset($vocab->picture)}}" class="img-responsive" alt="">
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
              <div class="col-md-12 text-left">
                <hr>
                @if ($vocab->exists)
                  <a href="{{route('admin.vocabs.index')}}" class="btn btn-link " style="margin-left: 10px;">انصراف</a>
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
