@extends('layouts.simple')

@section('title', 'پرداخت')

@section('header-assets')

  <link rel="stylesheet" href="{{URL::asset('player/css/mediaelementplayer.css')}}">
<!--  <link href="http://vjs.zencdn.net/5.19.2/video-js.css" rel="stylesheet">

<script src="http://vjs.zencdn.net/ie8/1.1.2/videojs-ie8.min.js"></script>-->
@endsection
@section('content')

<style media="screen">

</style>



  <div class="container">

    <div class="row">
      <div class="col-md-12">

        @if (session()->has('flash_notification.message'))
          <br><br>
          <div class="alert alert-{{ session('flash_notification.level') }} text-right">
              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

              {!! session('flash_notification.message') !!}
          </div>
        @endif
        <div class="card-deck-wrapper">
          <div class="card-deck p-5 m-5">
            <div class="card">
              <div class="card-block">
                <h4 class="card-title">تماس با ما</h4>
                <hr>
                <p class="card-text">برای تماس با ما می‌توانید از فرم زیر استفاده کنید.</p>
                <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
                {!! Form::open(['route' => 'contact.post']) !!}
                <div class="row">
                      <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                          <input class="form-control" name="name" placeholder="نام" type="text" required autofocus />
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6" style="padding-bottom: 10px;">
                          <input class="form-control" name="family_name" placeholder="نام خانوادگی" type="text" required />
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                          <input class="form-control" name="email" placeholder="ایمیل" type="email" required />
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12" style="padding-bottom: 10px;">
                          <input class="form-control" name="subject" placeholder="موضوع" type="text" required />
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12 col-md-12 col-sm-12">
                          <textarea name="message" style="resize:vertical;" class="form-control" placeholder="پیغام" rows="6" name="comment" required></textarea>
                      </div>
                  </div>
                  <br>
                  <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                      <button type="submit" class="btn btn-primary pull-left">ارسال</button>
                    </div>
                  </div>
                  {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>





@endsection


@section('footer-assets')

  <script src="{{URL::asset('player/js/mediaelement-and-player.js')}}"></script>
  <script src="{{URL::asset('player/js/demo.js')}}"></script>

  <script type="text/javascript">
  $(document).ready(function(){
      persian={0:'۰',1:'۱',2:'۲',3:'۳',4:'۴',5:'۵',6:'۶',7:'۷',8:'۸',9:'۹'};
  	function traverse(el){
  		if(el.nodeType==3){
  			var list=el.data.match(/[0-9]/g);
  			if(list!=null && list.length!=0){
  				for(var i=0;i<list.length;i++)
  					el.data=el.data.replace(list[i],persian[list[i]]);
  			}
  		}
  		for(var i=0;i<el.childNodes.length;i++){
  			traverse(el.childNodes[i]);
  		}
  	}
      traverse(document.body);
  });
  </script>


@endsection
