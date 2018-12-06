@extends('layouts.simple')

@section('title', 'آموزش لغات')


@section('content')
<!--  <section class="section-a intro text-center" style="background: url('http://localhost/zaban/public/img/vocabs.jpg'); background-position: 0px 0px;">

    <hr class="m-y-md">
    <div class="row">
      <div class="col-md-3">

      </div>
      <div class="col-md-6 text-right">
        <h1>آموزش لغات</h1>
        <h4>دایرهٔ لغات خود را با تکرار و تمرین گسترش دهید.</h4>
      </div>
    </div>
    <hr>
  </section>-->

  <section class="latest-vocabs p-2">
    @if ($albums->isEmpty())
      <div class="container">
        <div class="row">
          <div class="col-md-12">
            <br>
            <div class="jumbotron">
              <p class="lead">متاسفانه بخش فرهنگ لغلات در حال حاضر خالی می‌باشد.</p>
              <hr class="m-y-md">
              <p class="lead text-left">
                <a class="btn btn-primary" href="#" role="button">بازگشت به صفحهٔ نخست <i class="fa fa-chevron-left"></i></a>
              </p>
            </div>
          </div>
        </div>
      </div>
      @else
        <div class="container">
          <div class="row">
            <div class="col-md-12 text-center mt-3 mb-2">
              <h3> دسته بندی‌های فرهنگ مصور</h3>
              <hr>
            </div>
          </div>
          <div class="row mt-5">
            @foreach ($albums as $album)

              <div class="col-md-4 col-sm-6 col-xs-12">
                <a href="{{route('vocabularies', $album->id)}}">
                  <div class="card-deck-wrapper scale mb-4">
                    <div class="card-deck">
                      <div class="card text-center shadow-1">
                        <img draggable="false" class="card-img-top img-responsive course-thumb-img" src="{{URL::asset($album->picture)}}" alt="Card course-thumb-img image cap">
                        <div class="card-block">
                          <h4 class="card-title mb-0">{{$album->title}}</h4>
                          <!--<p class="card-text"><small class="text-muted">آخرین آپدیت {{$album->updated_at->diffForHumans()}}</small></p>-->
                        </div>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            @endforeach

          </div>

          <div class="clearfix">

          </div>
          <br><br>

        </div>
    @endif

  </section>






@endsection
