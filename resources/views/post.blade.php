@extends('layouts.simple')

@section('title', 'نوشته ها | '.$post->title)


@section('content')



  <section class="section-b">

    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="row">
            <div class="col-lg-12">
              <div class=" p-2">
                <h5>{{$post->title}}</h5>
                <span class="text-muted">{{ jDate::forge($post->created_at)->format('%d %B %Y') }} - {{$post->created_at->diffForHumans()}}</span>
                <hr>
                <div class="row">
                  <div class="col-md-12">
                    @if (!empty($post->picture) && !is_null($post->picture))
                      <img src="{{URL::asset($post->picture)}}" class="img-responsive w-100 news-image"  alt="">
                      <hr>
                    @endif
                  </div>
                  <div class="col-md-12">
                    {!! $post->body !!}
                  </div>
                  <div class="clearfix">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>






@endsection
