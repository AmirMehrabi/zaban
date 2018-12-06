@extends('layouts.simple')

@section('title', 'درس '.$lesson->title)

@section('header-assets')
  <link href="http://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet">

<!-- If you'd like to support IE8 -->
<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>
@endsection
@section('content')
<style media="screen">
  .video-js {
    width: 100%;
  }

  video::-internal-media-controls-download-button {
    display:none;
  }

  video::-webkit-media-controls-enclosure {
    overflow:hidden;
  }

  video::-webkit-media-controls-panel {
    width: calc(100% + 30px); /* Adjust as needed */
  }
</style>
  @if (Auth::guest())
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron m-4">
            <p>برای مشاهدهٔ این درس لطفا به سیستم وارد شوید</p>
          </div>
        </div>

      </div>
    </div>

  @elseif (Auth::user()->paid == 1 || $category->paid == 1)
    @if ($lesson->allowed == 0)
      <br>
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron">
              <h1>متاسفیم.</h1>
              <p>شما پیش نیاز این درس را نگذرانده اید. برای ورود به درس پیش نیاز <a href="{{route('lesson', $lesson->prerequisite_lesson)}}">اینجا</a> کلیک کنید.</p>
            </div>
          </div>
        </div>
      </div>
      <br>
      @else
        <br><br>
        <div class="container">
          <div class="row">
            <div class="col-md-12">
              @if (session()->has('flash_notification.message'))
                  <div class="alert alert-{{ session('flash_notification.level') }}">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                      {!! session('flash_notification.message') !!}
                  </div>
              @endif
              <div class="content-box">
                <div class="row">
                  <div class="col-md-6">
                    <h3> <b>{{$lesson->title}}</b></h3>
                    <hr>

                    <h5>
                      {{$lesson->excerpt}}
                    </h5>
                      {!!$lesson->body!!}
                  </div>
                  <div class="col-md-6">
                    @if (!empty($lesson->video))

                      <video id="lessonVideo" style="width: 100%;" controls>
                        <source src="{{URL::asset($lesson->video)}}" type="video/mp4">
                        Your browser does not support HTML5 video.
                      </video>
                      @else
                        <video id="my-video" class="video-js" controls preload="auto" class="w-100"
                        poster="" data-setup="{}">
                          <source src="{{URL::asset('placeholder.mp4')}}" type='video/mp4'>
                          <p class="vjs-no-js">
                            To view this video please enable JavaScript, and consider upgrading to a web browser that
                            <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a>
                          </p>
                        </video>
                    @endif
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-12">
              <div class="content-box text-left">
                @foreach ($courses as $course)
                  <a href="{{route('course', $course->slug)}}" class="btn btn-outline-primary"> بازگشت به صفحهٔ فصل</a>
                  <!--<a href="{{route('category.page', $course->id)}}" class="btn btn-outline-primary">بازگشت به صفحهٔ دوره</a> -->
                @endforeach

              </div>
            </div>
          </div>


          @if (!$questions->isEmpty())
            <div class="row">
              <div class="col-md-12">
                <div class="content-box">
                  <h2> آزمون</h2>
                  <hr>
                  برای شرکت در آزمون این درس <a href="{{route('lesson.exam', $lesson->slug)}}">اینجا</a> کلیک کنید.
                </div>
              </div>
            </div>
          @endif


        </div>
    @endif
  @elseif (Auth::user()->paid == 2 || Auth::user()->paid == 0)
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="jumbotron m-4">
            <p>برای مشاهدهٔ این درس لطفا از طریق <a href="{{route('profile', Auth::user()->id )}}">پنل کاربری</a> خود اقدام به خرید اشتراک کنید.</p>
          </div>
        </div>
      </div>
    </div>
  @endif






@endsection


@section('footer-assets')
  <script type="text/javascript">
  $(document).ready(function(){
     $('#lessonVideo').bind('contextmenu',function() { return false; });
  });
  </script>
@endsection
