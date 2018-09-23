@extends('layouts.simple')

@section('title', 'فصل ' . $course->title)

@section('header-assets')

  <link rel="stylesheet" href="{{URL::asset('player/css/mediaelementplayer.css')}}">
<!--  <link href="http://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet">

<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>-->
@endsection
@section('content')

<style media="screen">
  .video-js {
    width: 100%;
  }

  #container {
      padding: 0 20px 50px;
  }
  .error {
      color: red;
  }
  a {
      word-wrap: break-word;
  }



  #player2-container .mejs__time-buffering, #player2-container .mejs__time-current, #player2-container .mejs__time-handle,
  #player2-container .mejs__time-loaded, #player2-container .mejs__time-hovered, #player2-container .mejs__time-marker, #player2-container .mejs__time-total {
      height: 2px;
  }

  #player2-container .mejs__time-total {
      margin-top: 9px;
  }
  #player2-container .mejs__time-handle {
      left: -5px;
      width: 12px;
      height: 12px;
      border-radius: 50%;
      background: #ffffff;
      top: -5px;
      cursor: pointer;
      display: block;
      position: absolute;
      z-index: 2;
      border: none;
  }
  #player2-container .mejs__time-handle-content {
      top: 0;
      left: 0;
      width: 12px;
      height: 12px;
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

  @if ($course->allowed == 0)
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br>
          <div class="jumbotron shadow-2">
            <h3>فصل {{$course->title}}</h3>
            <hr>
            <p>متاسفانه شما پیش‌نیاز این فصل را با موفقیت نگذرانده‌اید. برای انتقال به فصل پیش‌نیاز <a href="{{route('course', $prerequisite->slug)}}">اینجا</a> کلیک کنید.</p>
            <p>با آرزوی موفقیت.</p>
            <hr>
            <p>نام فصل پیش نیاز: {{$prerequisite->title}}</p>
            <a href="{{route('course', $prerequisite->slug)}}" class="btn btn-primary pull-left">انتقال به فصل پیش‌نیاز</a>

          </div>
          <br>
        </div>
      </div>
    </div>
    @else
      <section class="">
            <div class="container-fluid bg-white">
              <div class="row">
                <div class="col-md-4">
                  <div class="card-deck-wrapper">
                    <div class="card-deck">
                      <div class="card">
                        @if (!empty($course->picture))
                          <img class="card-img-top course-thumbnail-img w-100" src="{{URL::asset($course->picture)}}" alt="Card image cap">
                        @endif
                        <div class="card-block">
                          <h4 class="card-title">{{$course->title}}</h4>
                          <p class="card-text text-muted">{!!$course->description!!}</p>
                          @if (empty($course->description))
                            <p class="text-muted">توضیحاتی برای این فصل وجود ندارد.</p>
                          @endif
                          <!--<small class="text-muted">آخرین آپدیت {{$course->updated_at->diffForHumans()}}</small>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-8">
                  <div class="card-deck-wrapper">
                    <div class="card-deck">
                      <div class="card">
                        <div class="card-block">
                          @if (!empty($course->video))
                            <video class="courseVideo w-100" class="w-100" controls>
                              <source src="{{URL::asset($course->video)}}" type="video/webm">
                              <source src="{{URL::asset($course->video)}}" type="video/mp4">
                              I'm sorry; your browser doesn't support HTML5 video in WebM with VP8/VP9 or MP4 with H.264.
                            </video>

<!--                            <video id="player1" style="max-width:100%;" class="w-100" preload="none" controls controlsList="nodownload">
                                <source src="{{URL::asset($course->video)}}" type="video/mp4">
                            </video>

                            <video src="{{URL::asset($course->video)}}" style="max-width:100%;" class="w-100" preload="none" controls controlsList="nodownload" poster="posterimage.jpg">

                            </video>-->

                            @else


                              <video id="courseVideo" style="max-width:100%;" class="w-100" preload="none" controls controlsList="nodownload">
                                  <source src="{{URL::asset('placeholder.mp4')}}" type="video/mp4">
                                  <track srclang="en" kind="subtitles" src="mediaelement.vtt">
                                  <track srclang="en" kind="chapters" src="chapters.vtt">
                              </video>

                          @endif
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

              </div>


            </div>
            <hr>
            <div class="col-md-12">
              <div class="content-box text-left">
                <a href="{{route('category.page', $category->slug)}}" class="btn btn-outline-primary"> بازگشت به صفحهٔ دوره</a>

              </div>
            </div>


            <br><hr><br>
          </section>



          @if (Auth::guest())
            <section class="section-a">
              <div class="container bg-light">
                <div class="row">
                  <div class="col-md-12">
                    <div class="jumbotron shadow-2">
                      برای مشاهدهٔ دروس لطفا وارد سیستم شوید
                    </div>

                  </div>
                </div>
              </div>
            </section>
          @elseif (Auth::user())
            @if (Auth::user()->paid == 1 || $category->paid == 1)
              <section class="section-a">
                <div class="container bg-light">
                  <div class="row">
                    <div class="col-md-12">
                      <h3 class="pb-3 ">دروس این فصل:</h3>
                      <div id="accordion" role="tablist" aria-multiselectable="true">
                        @if ($lessons->isEmpty())
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-empty">
                              <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapse-empty" aria-expanded="true" aria-controls="collapse-empty">
                                  <i class="fa fa-play-circle" aria-hidden="true"></i> دروس خالی است
                                </a>
                              </h5>
                            </div>

                            <div id="collapse-empty" class="collapse show" role="tabpanel" aria-labelledby="heading-empty">
                              <div class="card-block">
                                <div class="row">
                                  <div class="col-md-12">
              <!--                              <video controls style="width: 100%;">
                                      <source src="{{URL::asset('placeholder.mp4')}}" type="video/mp4">
                                      Your browser does not support HTML5 video.
                                    </video>-->

                                  </div>
                                  <div class="col-md-12">
                                    در حال حاضر درسی در این فصل وجود ندارد.
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                        @endif
                        @foreach ($lessons as $key => $lesson)
                          <div class="card">
                            <div class="card-header" role="tab" id="heading-{{$key}}">
                              <h5 class="mb-0">
                                <a class="{{$key == 1 ? 'collapsed' : ''}}" data-toggle="collapse" data-parent="#accordion" href="#collapse-{{$key}}" aria-expanded="true" aria-controls="collapse-{{$key}}">
                                  @if ($lesson->allowed === 0)
                                    <i class="fa fa-lock" aria-hidden="true"></i>
                                    @else
                                      <i class="fa fa-play-circle" aria-hidden="true"></i>
                                  @endif
                                  {{$lesson->title}}
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
                                    @if ($lesson->allowed === 0)
                                      <p>قبل از مشاهدهٔ این درس باید پیش نیازش را گذرانده باشید.</p>
                                      @else
                                        {!! $lesson->body !!}
                                        <hr>
                                        <a href="{{route('lesson', $lesson->slug)}}" class="btn btn-primary btn-sm pull-left"> ادامهٰ درس <i class="fa fa-arrow-left" aria-hidden="true"></i></a>
                                      @endif
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>

                        @endforeach
                        @if ( !$course->exams->isEmpty() )
                          <div class="card">
                            <div class="card-header" role="tab" id="headingFour">
                              <h5 class="mb-0">
                                <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                  <i class="fa fa-file-text-o ml-1" aria-hidden="true"></i>  آزمون فصل
                                </a>
                              </h5>
                            </div>
                            <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour">
                              <div class="card-block">
                                برای شرکت در آزمون <a href="{{route('course.exam', $course->id)}}">اینجا</a> کلیک کنید.
                              </div>
                            </div>
                          </div>
                          @elseif ($course->exams->isEmpty())
                            <div class="card">
                              <div class="card-header" role="tab" id="headingEmptyExam">
                                <h5 class="mb-0">
                                  <a class="collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseEmptyExam" aria-expanded="false" aria-controls="collapseEmptyExam">
                                    <i class="fa fa-file-text-o ml-1" aria-hidden="true"></i>  آزمون فصل
                                  </a>
                                </h5>
                              </div>
                              <div id="collapseEmptyExam" class="collapse" role="tabpanel" aria-labelledby="headingEmptyExam">
                                <div class="card-block">
                                  برای این فصل، در حال حاضر آزمونی وجود ندارد.
                                </div>
                              </div>
                            </div>
                        @endif
                      </div>
                    </div>
                  </div>
                </div>
              </section>
            @elseif (Auth::user()->paid == 2 || $category->paid == 2 || Auth::user()->paid == 0 || $category->paid == 0)
                <section class="section-a">
                  <div class="container bg-light">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="jumbotron shadow-2">
                          برای مشاهدهٔ دروس لطفا اقدام به <a href="{{route('profile')}}">خرید اشتراک</a> کنید
                        </div>
                      </div>
                    </div>
                  </div>
                </section>
            @endif





          @endif


<!--          <section class="section-b">
            <div class="container bg-white">
              <div class="row">
                <div class="col-md-12">
                  <h3>دیگر فصل های این مجموعه</h3>
                </div>
              </div>

              <div class="row">
              </div>
            </div>
          </section>-->
  @endif





@endsection


@section('footer-assets')

  <script src="{{URL::asset('player/js/player.js')}}"></script>
  <script src="{{URL::asset('player/js/demo.js')}}"></script>
  <script type="text/javascript">
  $(document).ready(function(){
     $('#courseVideo').bind('contextmenu',function() { return false; });
  });
  </script>

@endsection
