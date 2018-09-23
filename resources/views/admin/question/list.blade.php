@extends('layouts.admin')

@section('content')

  <style media="screen">
  .col-xs-1, .col-xs-2, .col-xs-3, .col-xs-4, .col-xs-5, .col-xs-6, .col-xs-7, .col-xs-8, .col-xs-9,.col-xs-10,.col-xs-11,.col-xs-12,
  .col-sm-1, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9,.col-sm-10,.col-sm-11,.col-sm-12,
  .col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9,.col-md-10,.col-md-11,.col-md-12,
  .col-lg-1, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9,.col-lg-10,.col-lg-11,.col-lg-12 {
    float: right;
  }
  </style>

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
            <h2 class="page-header">افزودن سوال به  {{$lesson->title}} </h2>

            <div class="content-box">
              <p>
                برای گذراندن این آزمون، کاربر باید حداقل {{$lesson->min_grade}} نمره کسب کند. در حال حاضر سوالات این آزمون مجموعا شامل {{$user_answers_scores}} نمره می‌باشند.
              </p>
            </div>
            <hr>
            <div class="content-box">
              {!! Form::model($question, [
                'method' => 'post',
                'route'  => ['admin.questions.store'],
                'files' => 'true'
                ]) !!}
              <fieldset class="form-group">
                {!! Form::hidden('lesson', $lesson->id) !!}
              </fieldset>


              <fieldset class="form-group">
                <label for="formGroupExampleInput">سوال</label>
                <input type="text" name="question" class="form-control" id="formGroupExampleInput" placeholder="سوال خود را وارد کنید." value="{{$question->question}}">
              </fieldset>
              <fieldset class="form-group">
                <label for="formGroupExampleInput">نمره</label>
                {!! Form::number('score', $question->score, ['class' => 'form-control']) !!}
              </fieldset>
              <hr>
              <div class="row text-center">
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_1" class="form-control" placeholder="گزینه اول" value="{{$question->opt_1}}">
                    {!! Form::radio('is_correct', 1) !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_2" class="form-control" placeholder="گزینه دوم" value="{{$question->opt_2}}">
                    {!! Form::radio('is_correct', 2) !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_3" class="form-control" placeholder="گزینه سوم" value="{{$question->opt_3}}">
                    {!! Form::radio('is_correct', 3) !!}
                  </fieldset>
                </div>
                <div class="col-md-3">
                  <fieldset class="form-group">
                    <input type="text" name="opt_4" class="form-control" placeholder="گزینه چهارم" value="{{$question->opt_4}}">
                    {!! Form::radio('is_correct', 4) !!}
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
              <h2 class="page-header">مدیریت سوال‌های درس {{$lesson->title}} </h2>
              @if (empty($lesson->questions))
                <p>در حال حاضر سوالی برای این درس وجود ندارد. برای ایجاد سوال <a href="#">اینجا</a> کلیک کنید.</p>
              @endif


              @if (!empty($lesson->questions))
                @foreach ($lesson->questions as $question)
                  <div class="row">
                    <div class="col-md-12">
                      <div class="content-box">
                        <h4>سوال: {{$question->question}}</h4>
                        <div class="row text-center">
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_1" class="form-control" id="formGroupExampleInput" placeholder="گزینه اول" value="{{$question->opt_1}}" readonly>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_2" class="form-control" id="formGroupExampleInput" placeholder="گزینه دوم" value="{{$question->opt_2}}" readonly>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_3" class="form-control" id="formGroupExampleInput" placeholder="گزینه سوم" value="{{$question->opt_3}}" readonly>
                            </fieldset>
                          </div>
                          <div class="col-md-3">
                            <fieldset class="form-group">
                              <input type="text" name="opt_4" class="form-control" id="formGroupExampleInput" placeholder="گزینه چهارم" value="{{$question->opt_4}}" readonly>
                            </fieldset>
                          </div>
                        </div>
                        <div class="row">
                          <div class="col-md-6 text-right">
                            گزینه صحیح: {{$question->is_correct}}
                          </div>
                          <div class="col-md-6 text-left">
                            <a href="{{route('admin.questions.edit', $question->id)}}" class="btn btn-info btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#myModal-{{$question->id}}"><i class="fa fa-trash" aria-hidden="true"></i></button>

                            <!-- Modal -->
                            <div id="myModal-{{$question->id}}" class="modal fade" role="dialog">
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
                                    {!! Form::open(['method' => 'delete', 'route' => ['admin.questions.destroy', $question->id]]) !!}
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
