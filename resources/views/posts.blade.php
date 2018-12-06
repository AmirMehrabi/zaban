@extends('layouts.simple')

@section('title', 'نوشته ها')

@section('header-assets')

  <style media="screen">
    body{
      background: #f1f1f1;
    }
  </style>

@endsection
@section('content')


  <section class="archive-posts">
    <div class="container">

      @if (session()->has('flash_notification.message'))
          <div class="alert alert-{{ session('flash_notification.level') }}">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

              {!! session('flash_notification.message') !!}
          </div>
      @endif

      @if (count($errors) > 0)
        <div class="row">
          @foreach ($errors->all() as $error)
            <div class="col-md-12">
              <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <p class="m-0">{{ $error }}</p>
              </div>
            </div>
          @endforeach
        </div>
      @endif

      <div class="row">
        <div class="col-md-9">
          <div class="header">
            <p> آرشیو نوشته ها</p>
          </div>

          <div class="row">


            @foreach ($posts as $post)
              <div class="col-lg-12">
                <div class=" bondle-box p-2 scale">
                  <h5>{{$post->title}}</h5>
                  <span class="text-muted">{{ jDate::forge($post->created_at)->format('%d %B %Y') }} - {{$post->created_at->diffForHumans()}}</span>
                  <hr>
                  <div class="row">
                    <div class="col-md-3">
                      <img src="{{URL::asset($post->picture)}}" class="img-responsive w-100" alt="">
                    </div>
                    <div class="col-md-9">
                      {!! $post->excerpt !!}

                    </div>
                  </div>
                  <a href="{{route('PostBySlug', $post->slug)}}" class="btn btn-primary pull-left btn-sm">ادامهٔ نوشته <i class="fa fa-chevron-left"></i></a>
                </div>
              </div>
            @endforeach







          </div>

          {!! $posts->render() !!}
        </div>
        <div class="col-md-3">
          <div class="header">
            <p>ما در شبکه های اجتماعی</p>
          </div>
          <div class="social-icons text-center">
            <span class="fa fa-facebook-square fa-fb fa-3x"></span>
            <span class="fa fa-twitter-square fa-3x"></span>
            <span class="fa fa-instagram fa-3x"></span>
            <span class="fa fa-google-plus-square fa-3x"></span>
            <span class="fa fa-rss fa-3x"></span>
          </div>
          <br>
          <br>
          <br>
          <div class="header">
            <p>خبرنامهٔ ما</p>
          </div>
          <div class="form-group text-center">
            {!! Form::open(['route' => 'subscription.submit']) !!}
              <p for="">آخرین اخبار ما را در ایمیل خود دریافت کنید</p>
              {!! Form::email('email', null, ['class' => 'form-control mb-2 text-center', 'placeholder' => 'ایمیل خود را وارد کنید']) !!}
              {!! Form::submit('عضویت در خبرنامه', ['class' => 'btn btn-success  btn-block']) !!}
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>






@endsection
