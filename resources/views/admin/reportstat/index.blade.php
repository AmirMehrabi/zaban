@extends('layouts.admin')

@section('title', 'مدیریت تراکنش ها')


@section('content')



  <div class="content">

    <div class="row">
      <div class="col-md-12 col-xs-12">
        <h2>آمار بازدیدکنندگان</h2>
        <hr>

        <div class="row">
                <div class="col-lg-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-aqua">
                    <div class="inner">
                      @if (!empty($dayPageViews))
                          <h3>{{$dayPageViews}}</h3>
                          @else
                            <h3>نامشخص</h3>
                      @endif


                      <p>بازدید امروز</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-green">
                    <div class="inner">
                      @if (!empty($weekPageViews))
                          <h3>{{$weekPageViews}}</h3>
                          @else
                            <h3>نامشخص</h3>
                      @endif
                      <p>بازدید این هفته</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-yellow">
                    <div class="inner">
                      @if (!empty($monthPageViews))
                          <h3>{{$monthPageViews}}</h3>
                          @else
                            <h3>نامشخص</h3>
                      @endif
                      <p>بازدید این ماه</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-6 col-xs-12">
                  <!-- small box -->
                  <div class="small-box bg-red">
                    <div class="inner">
                      @if (!empty($monthPageViews))
                          <h3>{{$monthPageViews}}</h3>
                          @else
                            <h3>نامشخص</h3>
                      @endif

                      <p>مجموع بازدیدکنندگان امسال</p>
                    </div>
                    <div class="icon">
                      <i class="ion ion-stats-bars"></i>
                    </div>
                  </div>
                </div>
                <!-- ./col -->
              </div>






      </div>
    </div>

    </div>





@endsection



@section('footer-assets')



  <script src="{{URL::asset('AdminLTE/plugins/knob/jquery.knob.js')}}"></script>
<!-- Sparkline -->
<!-- page script -->
<script>
  $(function () {
    /* jQueryKnob */

    $(".knob").knob({
      "readOnly":true,
      change : function (value) {
       //console.log("change : " + value);
       },
       release : function (value) {
       console.log("release : " + value);
       },
       cancel : function () {
       console.log("cancel : " + this.value);
       },
      draw: function () {
      }
    });
    /* END JQUERY KNOB */

    //INITIALIZE SPARKLINE CHARTS
    $(".sparkline").each(function () {
      var $this = $(this);
      $this.sparkline('html', $this.data());
    });



  });



</script>
@endsection
