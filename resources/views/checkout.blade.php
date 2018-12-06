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
        <div class="card m-5">

          <div class="card-block">
            <p class="text-muted">توجه: این پیش نمایش تنها جنبهٔ اطلاع رسانی دارد و وجهه قانونی ندارد.</p>
            {!! Form::open(['route' => 'payment']) !!}
            <table class="table table-hover table-bordered" style="direction: rtl;">
              <thead class="thead-default">
                <tr>
                  <th class="text-right">#</th>
                  <th class="text-right">عنوان</th>
                  <th class="text-right">تعداد</th>
                  <th class="text-right">قیمت</th>
                  <th class="text-right">قیمت کل(ریال)</th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <th scope="row">1</th>
                  <td>{{$name}}</td>
                  {!! Form::hidden('name', $name) !!}
                  <td>1</td>
                  <td>{{$price}}</td>
                  <td>{{$price}}</td>
                </tr>


                <tr class="text-center">
                  <td colspan="3">جمع کل</td>
                  <td colspan="2">{{$price}}</td>
                </tr>

                <tr class="text-center">
                  <td colspan="3">مالیات بر ارزش افزوده</td>
                  <td colspan="2">{{$tax}}</td>
                </tr>
                <tr class="text-center">
                  <td colspan="3">قابل پرداخت</td>
                  <td colspan="2">{{$total}}</td>
                  {!! Form::hidden('total', $total) !!}
                  {!! Form::hidden('duration', $duration) !!}
                  {!! Form::hidden('user_id', Auth::user()->id) !!}
                </tr>
              </tbody>
            </table>

            {!! Form::submit('انتقال به درگاه بانک', ['class' => 'btn btn-danger pull-left']) !!}
            {!! Form::close() !!}
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
