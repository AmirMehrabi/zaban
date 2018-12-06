@extends('layouts.simple')

@section('title', 'دوره '.$category->category_name)


@section('content')


  <section class="vocab-list p-0">
    <div class="container">
      <br>
      <div class="row jumbotron">

        <div class="col-md-4">
          <h4>جست و جو: </h4>
        </div>
        <div class="col-md-8">
          {!! Form::open(array('route' => 'course.search', 'method' => 'post')) !!}
          <div class="input-group">
            {!! Form::text('keyword', null, ['class' => 'form-control form-search', 'placeholder' => 'جست و جو در این دوره']) !!}
          {!! Form::hidden('slug', $category->slug) !!}
            <span class="input-group-btn">
              <button class="btn btn-default" style="border-radius: 3px 0px 0px 3px;" type="submit"><i class="fa fa-search-plus fa-1-6" aria-hidden="true"></i></button>
            </span>
          </div><!-- /input-group -->
          {!! Form::close() !!}
        </div>
        <hr>
      </div>

      @include('flash::message')

      <div class="row">
        <div class="col-md-12 text-center mt-5 mb-2">
          <h3> دوره {{$category->category_name}}</h3>
          <hr>
        </div>
      </div>
      @if (Auth::user())
        @if (Auth::user()->paid == 0 || Auth::user()->paid == 2)
          @if ($category->paid == 0 || $category->paid == 2)
            <div class="jumbotron">
              <h4>توجه</h4>
              <hr>
              <p>برای مشاهده‌ی این دوره نیاز به خرید اشتراک دارید. لطفا یا به صورت ماهانه و یا فصلی اقدام به خرید اشتراک کنید.</p>
              <p><strong>به یاد داشته باشید</strong> با خرید اشتراک وب‌سایت می‌توانید به تمام دوره‌ها و بخش‌های وب‌سایت دسترسی داشته باشید. برای خرید اشتراک وب‌سایت به <a href="{{route('profile')}}">پروفایل کاربری</a> خود مراجعه کنید.</p>
<!--
              <p>و یا برای خرید اشتراک تنها این دوره به قیمت {{$category->subscription_price}} ریال، <a href="{{route('checkoutCategory', $category->slug)}}">اینجا </a> کلیک کنید.</p>
-->
            </div>
          @endif
        @endif


      @endif
      @foreach (array_chunk($courses->all(), 3) as $threeCourses)
        <div class="row">
          @foreach ($threeCourses as $course)
            <div class=" col-md-4 col-sm-6 col-xs-12 text-center">
              <div class="card-deck-wrapper mb-3">
                <a href="{{route('course', $course->slug)}}">
                  <div class="card-deck scale">
                    <div class="card">
                      <!--<img class="card-img-top w-100" src="{{URL::asset('img/placeholder.jpg')}}" alt="Card image cap">-->
                      <div class="card-block">
                        <h5 class="card-title mb-0">{{$course->title}}</h5>
                        <p class="card-text"><small class="text-muted">{{$course->updated_at->diffForHumans()}}</small></p>
                        <p class="card-text">{!! $course->description !!}</p>
                        @if (empty($course->description))
                          <p class="card-text text-muted">توضیحاتی برای این دوره وجود ندارد</p>
                        @endif

                        @if (!is_null($course->allowed) && $course->allowed === 0)
                          <span class="badge badge-default">پیش نیاز گذرانده نشده</span>
                        @endif
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          @endforeach
        </div>
      @endforeach
      @if ($courses->isEmpty())
        <div class="row">
          <div class="col-md-12">
            <div class="jumbotron">
              <p>متاسفانه در حال حاضر این دوره خالی می‌باشد. <a href="{{route('category.index')}}">بازگشت به صفحهٔ دوره ها</a></p>
            </div>
          </div>
        </div>

      @endif
    </div>
  </section>






@endsection
