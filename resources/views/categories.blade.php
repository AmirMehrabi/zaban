@extends('layouts.simple')

@section('title', 'دوره ها')


@section('content')

  <section class="latest-vocabs p-2">
    <div class="container">
      <br>
      <div class="row jumbotron">

        <div class="col-md-4">
          <h4>جست و جو: </h4>
        </div>
        <div class="col-md-8">
          {!! Form::open(array('route' => 'categories.search', 'method' => 'post')) !!}
          <div class="input-group">
            {!! Form::text('keyword', null, ['class' => 'form-control form-search', 'placeholder' => 'جست و جو در دوره ها']) !!}
            <span class="input-group-btn">
              <button class="btn btn-default" style="border-radius: 3px 0px 0px 3px;" type="submit"><i class="fa fa-search-plus fa-1-6" aria-hidden="true"></i></button>
            </span>
          </div><!-- /input-group -->
          {!! Form::close() !!}
        </div>
        <hr>
      </div>
      <div class="row">


        <div class="col-md-12 text-center mt-3  mb-2">
          @include('flash::message')
          <h3> دوره ها</h3>
          <hr>
        </div>
      </div>


      <div class="row">
        @foreach ($categories as $category)
          <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            <a href="{{route('category.page', $category->slug)}}" class="">
              <div class="card-deck-wrapper scale mb-2">
                <div class="card-deck">
                  <div class="card">
                    @if (is_null($category->picture))
                      <img class="card-img-top img-responsive course-thumb-img" src="{{URL::asset('img/placeholder.jpg')}}" alt="Card course-thumb-img image cap">
                      @else
                        <img class="card-img-top img-responsive course-thumb-img" src="{{URL::asset($category->picture)}}" alt="Card course-thumb-img image cap">
                    @endif
                    <div class="card-block">
                      <h5 class="card-title mb-0">{{$category->category_name}}</h5>

{{--                       @if (!empty($category->subscription_price) && !is_null($category->subscription_price) )
                        <p>هزینه دوره: <span class="badge badge-primary">{{$category->subscription_price}} ریال</span></p>
                      @endif
--}}

                      <p class="card-text">{!!$category->description!!}</p>

<!--                      @if (Auth::user())
                        @if (Auth::user()->paid != 1)
                          @if ( $category->paid == 0 || $category->paid == 2 )
                            <hr>
                            <div class="alert alert-danger text-center" role="alert">
                              اشتراک این دوره خریداری نشده است
                            </div>
                          @elseif (Auth::user() && $category->paid == 1)
                            <div class="alert alert-success text-center" role="alert">
                              دارای اشتراک
                            </div>
                          @endif
                        @endif
                      @endif-->
                    </div>
                  </div>
                </div>
              </div>
            </a>
          </div>
        @endforeach

      </div>

      {!! $categories->render() !!}
      <div class="clearfix">
      </div>

    </div>
  </section>






@endsection
