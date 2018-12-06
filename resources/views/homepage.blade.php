@extends('layouts.frontend')

@section('title', 'صفحه نخست')


@section('content-section')
  <div class="jumbotron intro text-center" style="background: url('http://localhost/zaban/public/img/multilingual.jpg');">
    <h1>ببین، تمرین کن، یاد بگیر!</h1>
    <p class="lead">آموزش زبان از سطح مقدماتی تا پیشرفته</p>
    <hr class="m-y-md">


    <div class="container">
      <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-8">
          <div class="row">
            <div class="col-md-4">
              <div class="facts-icon pull-right">
                <img src="https://faranesh.com/inc/images/icons/registered.png" alt="">
              </div>
              <div class="facts-number pull-left text-right">
                <span>
                ۹۰۰ </span>دقیقه
                <br>
                آموزش کاربردی
              </div>
            </div>
            <div class="col-md-4">
              <div class="facts-icon pull-right">
                <img src="https://faranesh.com/inc/images/icons/registered.png" alt="">
              </div>
              <div class="facts-number pull-left text-right">
                <span>
                ۲۰ </span>عدد
                <br>
                دورهٔ آموزشی
              </div>
            </div>
            <div class="col-md-4">
              <div class="facts-icon pull-right">
                <img src="https://faranesh.com/inc/images/icons/registered.png" alt="">
              </div>
              <div class="facts-number pull-left text-right">
                <span>
                ۳۰۰ </span>نفر
                <br>
                ثبت نام در دوره
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <section style="background: #fff;">
    <div class="container">
      <div class="row text-center pt-4 pb-4">
        <div class="col-md-3">
          <i class="fa fa-globe fa-4x" aria-hidden="true"></i>
          <h6 class="pt-4">از هر جا و هر مکان</h6>
          <p class="small text-justify">لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم</p>
        </div>
        <div class="col-md-3">
          <i class="fa fa-dollar fa-4x" aria-hidden="true"></i>
          <h6 class="pt-4">کاهش هزینه ها</h6>
          <p class="small text-justify">لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم</p>
        </div>
        <div class="col-md-3">
          <i class="fa fa-line-chart fa-4x" aria-hidden="true"></i>
          <h6 class="pt-4">افزایش بهره وری</h6>
          <p class="small text-justify">لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم</p>
        </div>
        <div class="col-md-3">
          <i class="fa fa-calendar-check-o fa-4x" aria-hidden="true"></i>
          <h6 class="pt-4">صرفه جویی در زمان</h6>
          <p class="small text-justify">لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم لورم ایپسوم</p>
        </div>
      </div>
    </div>
  </section>

  <section>
    <div class="container">


      <div class="row">
        <div class="col-md-12 text-center mt-5 mb-2">
          <h3>آخرین دوره های افزوده شده</h3>
        </div>
      </div>
      <div class="row">
        @foreach ($courses as $course)
          <div class="col-md-4">
            <div class="course-thumbnail bondle-box">
              <img src="{{URL::asset('img/placeholder.jpg')}}" alt="..." class=" course-thumb-img">
              <div class="bondle-box-inner">
              <h3>{{$course->title}}</h3>
              <p>
                با توجه به سطحتان، به صورت مقدماتی، متوسط و یا پیشرفته زبان یاد بگیرید.
              </p>
              <a class="btn btn-primary btn-sm btn-thumbnail" href="{{route('course', $course->id)}}">شروع کن</a>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>


  <section style="background: #fff;">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-center mt-2 mb-2 pt-4 pb-4">
          <h3>آخرین دسته بندی دوره ها</h3>

        </div>
      </div>

      <div class="row mt-2 pb-5">
        @foreach ($categories as $category)
          <div class="col-md-2 text-center">
            <div class="category-thumbnail">
              <a href="{{route('category.page', $category->id)}}"><h5>{{$category->category_name}}</h5></a>
            </div>
          </div>
        @endforeach
      </div>
    </div>
  </section>


  <div class="container">
    <div class="row">
<!--      @foreach ($lessons as $lesson)
        <div class="col-md-12">
          <div class="content-box">
            <h4 >{{$lesson->title}}</h4>
            <hr>
            <p>
              {{$lesson->excerpt}}
            </p>
            <div class="text-left">
              <a href="{{route('lesson', $lesson->id)}}" class="btn btn-primary btn-sm">ادامه</a>
            </div>
          </div>

        </div>
      @endforeach-->
    </div>
  </div>
@endsection
