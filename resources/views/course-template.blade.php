@extends('layouts.frontend')

@section('title', 'دوره ' . $course->title)


@section('content-section')



  @if ($course->allowed == 0)
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="jumbotron">
            <h3>دوره {{$course->title}}</h3>
            <hr>
            <p>متاسفانه شما دورهٔ پیش نیاز این بخش را با موفقیت نگذرانده اید. برای انتقال به دورهٔ پیش نیاز <a href="{{route('course', $course->required_course)}}">اینجا</a> کلیک کنید.</p>
            <p>با آرزوی موفقیت.</p>

          </div>
          <br>
        </div>
      </div>
    </div>
    @else
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    {!! session('flash_notification.message') !!}
                </div>
            @endif
            <div class="">
              <br>
              <h3>عنوان دوره: <b>{{$course->title}}</b></h3>
              <hr>
              <div class="row">
                <div class="col-md-6">
                  <p>
                    توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.
                  </p>
                  <p>
                    توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.
                  </p>
                  <p>
    توضیحات دوره در این قسمت قرار خواهد گرفت.توضیحات دوره در این قسمت قرار خواهد گرفت.
                  </p>
                </div>
                <div class="col-md-6">
                  <img src="{{URL::asset('img/placeholder.jpg')}}" class="w-100" style="height: 300px;" alt="">
                </div>
              </div>

              <hr>

              <h3>دروس این دوره:</h3>
              <br>

            </div>
            </div>
        </div>

        @if ($lessons->isEmpty())
          <div class="row">
            <div class="col-md-12">
              <br>
              <div class="jumbotron">
                <p>هنوز درسی در این دوره وجود ندارد</p>
              </div>
              <br>
            </div>
          </div>
          @else
            <div class="row">
              <div class="col-md-12">
                <div id="accordion" role="tablist" aria-multiselectable="true">
                  @foreach ($lessons as $key => $lesson)
                    <div class="card">
                      <div class="card-header" role="tab" id="heading-{{$key}}">
                        <h5 class="mb-0">
                          <a class="{{$key == 1 ? 'collapsed' : ''}}" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$key}}" aria-expanded="true" aria-controls="collapse-{{$key}}">
                            <i class="fa fa-play-circle" aria-hidden="true"></i> {{$lesson->title}}
                          </a>
                        </h5>
                      </div>

                      <div id="collapse-{{$key}}" class="collapse {{$key == 0 ? 'show' : null}}" role="tabpanel" aria-labelledby="heading-{{$key}}">
                        <div class="card-block">
                          <div class="row">
                            <div class="col-md-12">
<!--                              <video controls style="width: 100%;">
                                <source src="{{URL::asset('placeholder.mp4')}}" type="video/mp4">
                                Your browser does not support HTML5 video.
                              </video>-->

                            </div>
                            <div class="col-md-12">
                              {!! $lesson->body !!}
                              <hr>
                              <a href="{{route('lesson', $lesson->id)}}" class="btn btn-primary btn-sm pull-left"> ادامهٰ درس <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                            </div>

                            @if (!$lesson->questions->isEmpty())
                              <div class="col-md-12">
                                <div class="content-box">
                                  <h2> آزمون</h2>
                                  <hr>
                                  برای شرکت در آزمون این درس <a href="{{route('lesson.exam', $lesson->id)}}">اینجا</a> کلیک کنید.
                                </div>
                              </div>
                            @endif

                          </div>
                        </div>
                      </div>
                    </div>
                  @endforeach
                </div>
              </div>
            </div>
        @endif


        <div class="row">
          <div class="col-md-12">
            <div class="content-box">
              <h2> آزمون</h2>
              <hr>
              برای شرکت در آزمون این دوره <a href="{{route('course.exam', $course->id)}}">اینجا</a> کلیک کنید.
            </div>
          </div>
        </div>
      </div>
  @endif





@endsection


@section('footer-assets')

@endsection
