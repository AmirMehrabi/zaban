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
        <div class="card-deck-wrapper">
          <div class="card-deck p-5 m-5">
            <div class="card">
              <div class="card-block">
                <h4 class="card-title text-danger">خطا!</h4>
                <hr>
                <p class="card-text pt-5 pb-5">{{$error}}</p>
                <!--<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>-->
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
