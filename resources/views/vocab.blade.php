@extends('layouts.simple')

@section('title', 'آموزش لغات - دسته بندی ' . $album->title)


@section('content')

@if (Auth::guest())
  <section class="vocab-list p-0">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mt-5 mb-2">
          <h3> {{$album->title}}</h3>
          <hr>

        </div>
        <div class="col-md-12">
          <div class="jumbotron shadow-2">
            برای مشاهده این دسته بندی لطفا وارد سیستم شوید.
          </div>
        </div>
      </div>
    </div>
  </section>
  @elseif (Auth::user()->paid == 2 || Auth::user()->paid == 0)
    <section class="vocab-list p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mt-5 mb-2">
            <h3>{{$album->title}}</h3>
            <hr>
          </div>
          <div class="col-md-12">
            <div class="jumbotron shadow-2">
              برای مشاهده این دسته بندی لطفا از طریق <a href="{{route('profile' )}}">پنل کاربری</a> خود اقدام به خرید اشتراک کنید.
            </div>
          </div>

        </div>
      </div>
    </section>
  @elseif (Auth::user()->paid == 1)
    <section class="vocab-list p-0">
      <div class="container">
        <div class="row">
          <div class="col-md-12 text-center mt-5 mb-2">
            <h3> دسته بندی {{$album->title}}</h3>
            <hr>
          </div>
        </div>
        @foreach (array_chunk($vocabs->all(), 4) as $threeVocabs)
          <div class="row">
            @foreach ($threeVocabs as $vocab)
              <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
                <div class="course-thumbnail bondle-box">
                  <a href="{{URL::asset($vocab->picture)}}" data-toggle="lightbox" data-title="" data-footer="">
                      <img draggable="false" src="{{URL::asset($vocab->picture)}}" class="course-thumb-img"  alt="">
                  </a>
                  <div class="vocab-box p-0">
                  <p class="m-0 p-1">{{$vocab->engName}}</p>
                  <audio controls controlsList="nodownload" style="max-width: 100%; min-width: 100%; margin-bottom: -8px;">
                    <source src="{{URL::asset($vocab->pronunciation)}}" type="audio/ogg">
                  Your browser does not support the audio element.
                  </audio>
                  </div>
                </div>
              </div>
            @endforeach
          </div>
        @endforeach
        @if ($vocabs->isEmpty())
          <br>
            <p>متاسفانه در حال حاضر این آلبوم خالی می‌باشد. <a href="{{route('vocabulary')}}">بازگشت به صفحهٔ آلبوم ها</a></p>
          <br>
        @endif
      </div>
    </section>
@endif



@endsection

@section('footer-assets')
  <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.1.1/ekko-lightbox.js"></script>

  <script type="text/javascript">
  $(document).on('click', '[data-toggle="lightbox"]', function(event) {
    event.preventDefault();
    $(this).ekkoLightbox();
  });
  </script>
@endsection
