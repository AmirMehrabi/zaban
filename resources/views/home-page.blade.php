@extends('layouts.simple')

@section('title', 'صفحه نخست')



@section('content')
<!--  <section class="intro">
    <div class="container-fluid">
      <div class="row pt-5 pb-5 p-4">
        <div class="col-md-5 col-sm-8 col-xs-12 intro-description text-white pt-4 pb-4 text-center">
          <h2 class="intro-primary"><b>زبان انگلیسی را به راحتی بیاموزید</b></h2>
          <hr>
          <h4 class="intro-secondary">در دوره‌های آنلاین ما شرکت کنید و زبان انگلیسی را از پایه تا پیشرفته بیاموزید.</h4>
          <br>
          @if (Auth::guest())
            <a href="{{url('register')}}" class="btn btn-outline-danger">همین حالا شروع کنید</a>
          @elseif (Auth::check())
            <a href="{{route('category.index')}}" class="btn btn-outline-danger">مرور دوره‌ها</a>
          @endif
        </div>
      </div>
    </div>
  </section> -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
    </ol>
    <div class="carousel-inner" role="listbox">
      <div class="carousel-item active">
        <img draggable="false" class="d-block img-fluid"  src="{{URL::asset('intro/01.jpg')}}" alt="First slide">
      </div>
      <div class="carousel-item">
        <img draggable="false" class="d-block img-fluid"  src="{{URL::asset('intro/02.jpg')}}" alt="Second slide">
      </div>
      <div class="carousel-item">
        <img draggable="false" class="d-block img-fluid" src="{{URL::asset('intro/03.jpg')}}" alt="Third slide">
      </div>
      <div class="carousel-item">
        <img draggable="false" class="d-block img-fluid" src="{{URL::asset('intro/04.jpg')}}" alt="Third slide">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="fa fa-angle-left fa-2x gray" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="fa fa-angle-right fa-2x gray" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
<section class="section-b shadow-2" >
  <div class="container">
    <div class="row text-center pt-4 pb-4">
      <div class="col-md-12 mb-5">
        <h2>بهترین راه برای یادگیری زبان</h2>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 flip pt-3">
        <div class="">
          <i class="fa {{$setting->intro1_picture}} fa-4x flip-icon" aria-hidden="true"></i>
        </div>
        <h6 class="pt-4">{{$setting->intro1_title}}</h6>
        <p class="small text-justify  bg-color">{{$setting->intro1_description}} </p>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 flip pt-3">
        <div class="">
          <i class="fa {{$setting->intro2_picture}} fa-4x flip-icon" aria-hidden="true"></i>
        </div>
        <h6 class="pt-4">{{$setting->intro2_title}}</h6>
        <p class="small text-justify  bg-color">{{$setting->intro2_description}} </p>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 flip pt-3">
        <div class="">
          <i class="fa {{$setting->intro3_picture}} fa-4x flip-icon" aria-hidden="true"></i>
        </div>
        <h6 class="pt-4">{{$setting->intro3_title}}</h6>
        <p class="small text-justify  bg-color">{{$setting->intro3_description}} </p>
      </div>
      <div class="col-md-3 col-sm-6 col-xs-12 flip pt-3">
        <div class="">
          <i class="fa {{$setting->intro4_picture}} fa-4x flip-icon" aria-hidden="true"></i>
        </div>
        <h6 class="pt-4">{{$setting->intro4_title}}</h6>
        <p class="small text-justify  bg-color">{{$setting->intro4_description}} </p>
      </div>
    </div>
  </div>
</section>

@if (!empty($post))
<!--  <section class="section-a shadow-2">
    <div class="container">
      <div class="row">
        <div class="col-md-5">
          @if (!empty($post->picture) && !is_null($post->picture))
            <img draggable="false" src="{{URL::asset($post->picture)}}" class="w-100 img-cover scale post-image" alt="">
            @else
              <img draggable="false" src="{{URL::asset('img/placeholder.jpg')}}" class="w-100 img-cover scale post-image" alt="">
          @endif
        </div>
        <div class="col-md-7">
          <p class="mb-1"><b>{{$post->title}}</b></p>
          <p class="text-muted mb-4"><small>نوشته شده توسط روابط عمومی</small></p>
          <div class="text-justify">
            {!! $post->excerpt !!}
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-md-12">
          <a href="{{route('PostBySlug', $post->slug)}}" class="btn btn-link pull-left">ادامهٔ نوشته</a>
        </div>
      </div>
    </div>
  </section>-->
@endif


@if (!empty($categories))
  <section class="section-a shadow-2">
    <div class="container">
      <div class="row mb-3">
        <div class="col-md-12  text-right">
          <h3 class="pull-right">آخرین دوره ها</h3>
          <a href="{{route('category.index')}}" class="btn btn-outline-primary pull-left" style="float:left;">مشاهدهٔ همه</a>
        </div>
      </div>
      <div class="row text-center">
        @foreach ($categories as $category)
          <div class="col-md-2 col-sm-4 col-xs-12 mb-1">
            <a href="{{route('category.page', $category->slug)}}">
              @if (empty($category->picture))
                <img draggable="false" src="{{URL::asset('img/placeholder.jpg')}}" class="w-100 course-thumbnail scale" alt="">
                @else
                  <img draggable="false" src="{{URL::asset($category->picture)}}" class="w-100 course-thumbnail scale" alt="">
              @endif
            </a>
          </div>
        @endforeach
      </div>
    </div>
  </section>
@endif

@endsection
