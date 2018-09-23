@extends('layouts.admin')

@section('content')


  <div class="content">
    <div class="row">
      <div class="col-md-12">
        @if (count($errors) > 0)
          @foreach ($errors->all() as $error)
            <div class="col-md-4">
              <div class="alert alert-danger">
                <p class="">{{ $error }}</p>
              </div>
            </div>

          @endforeach
        @endif

          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h2 class="page-header">افزودن سوال به  {{$course->title}} </h2>

            <div class="content-box">
              <p>
                <b>توجه:</b> برای گذراندن این آزمون کاربر باید حداقل ۶۰٪ نمرات را کسب کند.
              </p>
            </div>
            <hr>
            <div class="content-box">
              {!! Form::model($exam, [
                'method' => 'post',
                'route'  => ['admin.exams.store'],
                'files' => 'true'
                ]) !!}
              <fieldset class="form-group">
                {!! Form::hidden('course', $course->id) !!}
              </fieldset>


              <fieldset class="form-group">
                <label for="formGroupExampleInput">سوال</label>
                <input type="text" name="question" class="form-control" id="formGroupExampleInput" placeholder="سوال خود را وارد کنید." value="{{$exam->question}}">
              </fieldset>


              <div class="row">
                <hr>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="formGroupExampleInput">تصویر سوال</label>
                    {!! Form::file('question_pic') !!}
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset class="form-group">
                    <label for="formGroupExampleInput">صوت سوال</label>
                    {!! Form::file('question_audio') !!}
                  </fieldset>
                </div>
              </div>
              <fieldset class="form-group hidden">
                <label for="formGroupExampleInput">نمره</label>
                {!! Form::number('score', 2, ['class' => 'form-control']) !!}
              </fieldset>
              <hr>
              <div class="row text-center">
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_1" class="form-control" placeholder="گزینه اول" value="{{$exam->opt_1}}">
                    {!! Form::radio('is_correct', 1) !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_2" class="form-control" placeholder="گزینه دوم" value="{{$exam->opt_2}}">
                    {!! Form::radio('is_correct', 2) !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_3" class="form-control" placeholder="گزینه سوم" value="{{$exam->opt_3}}">
                    {!! Form::radio('is_correct', 3) !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_4" class="form-control" placeholder="گزینه چهارم" value="{{$exam->opt_4}}">
                    {!! Form::radio('is_correct', 4) !!}
                  </fieldset>
                </div>
              </div>



              <div class="row text-center">
                <div class="col-md-3">
                  <fieldset class="form-group">
                    {!! Form::file('pic_1') !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    {!! Form::file('pic_2') !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    {!! Form::file('pic_3') !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    {!! Form::file('pic_4') !!}
                  </fieldset>
                </div>
              </div>
              {!! Form::submit('ذخیره', ['class' => 'btn btn-primary pull-left']) !!}
              {!! Form::close() !!}

              <div class="clearfix">

              </div>
            </div>
          </div>
        </div>

          <div class="row">
            <div class="col-md-12">
              <h2 class="page-header">مدیریت سوال‌های درس {{$course->title}} </h2>
              @if (empty($course->exams))
                <p>در حال حاضر سوالی برای این درس وجود ندارد. برای ایجاد سوال <a href="#">اینجا</a> کلیک کنید.</p>
              @endif


              @if (!empty($course->exams))
                @foreach ($course->exams as $exam)
                  <div class="row">
                    <div class="col-md-12">
                      <div class="content-box">
                        <h4>سوال: {{$exam->question}}</h4>
                        <div class="row text-center">
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_1" class="form-control" id="formGroupExampleInput" placeholder="گزینه اول" value="{{$exam->opt_1}}" readonly>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_2" class="form-control" id="formGroupExampleInput" placeholder="گزینه دوم" value="{{$exam->opt_2}}" readonly>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_3" class="form-control" id="formGroupExampleInput" placeholder="گزینه سوم" value="{{$exam->opt_3}}" readonly>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_4" class="form-control" id="formGroupExampleInput" placeholder="گزینه چهارم" value="{{$exam->opt_4}}" readonly>
                            </fieldset>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 text-right">
                            گزینه صحیح: {{$exam->is_correct}}
                          </div>
                          <div class="col-md-6 text-left">
                            <a href="{{route('admin.exams.edit', $exam->id)}}" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal-{{$exam->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>

                            <!-- Modal -->
                            <div id="myModal-{{$exam->id}}" class="modal fade" role="dialog">
                              <div class="modal-dialog">

                                <!-- Modal content-->
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <h4 class="modal-title">حذف سوال</h4>
                                  </div>
                                  <div class="modal-body text-right">
                                    <p>آیا مطمئن به حذف این سوال هستید؟</p>
                                  </div>
                                  <div class="modal-footer">
                                    {!! Form::open(['method' => 'delete', 'route' => ['admin.exams.destroy', $exam->id]]) !!}
                                      {!! Form::submit('حذف سوال', ['class' => 'btn btn-danger btn-sm pull-left']) !!}
                                    {!! Form::close() !!}
                                    <button type="button" class="btn btn-default btn-sm pull-left" data-dismiss="modal">بازگشت</button>
                                  </div>
                                </div>

                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                @endforeach
              @endif
              <hr>
            </div>
          </div>
      </div>
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
