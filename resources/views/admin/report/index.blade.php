@extends('layouts.admin')

@section('title', 'مدیریت تراکنش ها')


@section('content')



  <div class="content">

    <div class="row">
      <div class="col-md-12 col-xs-12">
        <h2>محبوب‌ترین‌ها</h2>
        <hr>

        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="box box-solid">
              <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">دوره‌های محبوب</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  @foreach ($popular_categories as $popular_category)
                    <div class="col-xs-6 col-md-3 text-center">
                      @if (!empty($popular_category->picture))
                        <img class="card-img-top course-thumbnail-img" src="{{URL::asset($popular_category->picture)}}" alt="Card image cap">

                      @endif

                      <div class="knob-label"><h5>نام دوره: <b><a href="{{route('admin.categories.show', $popular_category->id)}}">{{$popular_category->category_name}}</a></b></h5></div>
                      <hr>
                      <div class="knob-label"><h5>تعداد بازدیدکنندگان: <b>{{$popular_category->visits}} بازدید</b></h5></div>
                    </div>
                  @endforeach
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="box box-solid">
              <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">فصل‌های محبوب</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  @foreach ($popular_courses as $popular_course)
                    <div class="col-xs-6 col-md-3 text-center">
                      @if (!empty($popular_course->picture))
                        <img class="card-img-top course-thumbnail-img" src="{{URL::asset($popular_course->picture)}}" alt="Card image cap">
                      @endif

                      <div class="knob-label"><h5>نام فصل: <b><a href="{{route('admin.courses.show', $popular_course->id)}}">{{$popular_course->title}}</a></b></h5></div>
                      <hr>
                      <div class="knob-label"><h5>دوره:
                        @foreach ($popular_course->category as $course_category)
                          <b>{{$course_category->category_name}}</b>
                        @endforeach
                      </h5></div>
                      <hr>
                      <div class="knob-label"><h5>تعداد بازدیدکنندگان: <b>{{$popular_course->visits}} بازدید</b></h5></div>
                    </div>
                  @endforeach
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12 col-xs-12">
            <div class="box box-solid">
              <div class="box-header">
                <i class="fa fa-bar-chart-o"></i>
                <h3 class="box-title">دروس محبوب</h3>
                <div class="box-tools pull-right">
                  <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                  </button>
                </div>
              </div>
              <!-- /.box-header -->
              <div class="box-body">
                <div class="row">
                  @foreach ($popular_lessons as $popular_lesson)
                    <div class="col-xs-6 col-md-3 text-center">
                      @if (!empty($popular_lesson->picture))
                        <img class="card-img-top course-thumbnail-img" src="{{URL::asset($popular_lesson->picture)}}" alt="Card image cap">

                      @endif

                      <div class="knob-label"><h5>نام درس: <b>{{$popular_lesson->title}}</b></h5></div>
                      <hr>
                      <div class="knob-label"><h5>فصل مربوطه:
                        @foreach ($popular_lesson->courses as $lesson_course)
                          <b>{{$lesson_course->title}}</b>
                        @endforeach
                      </h5></div>
                      <hr>
                      <div class="knob-label"><h5>تعداد بازدیدکنندگان: <b>{{$popular_lesson->visits}} بازدید</b></h5></div>
                    </div>
                  @endforeach
                  <!-- ./col -->
                </div>
                <!-- /.row -->
              </div>
              <!-- /.box-body -->
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
        <div class="col-md-12 col-xs-12">
          <h2>گزارش نمرات برتر</h2>
          <hr>

          <div class="row">
            @foreach ($courses as $course)
              <div class="col-xs-12">
                <div class="box box-solid">
                  <div class="box-header">
                    <i class="fa fa-bar-chart-o"></i>
                    <h3 class="box-title">نمرات برتر {{$course->title}} </h3>
                    <div class="box-tools pull-right">
                      <button type="button" class="btn btn-default btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
                      </button>
                      <button type="button" class="btn btn-default btn-sm" data-widget="remove"><i class="fa fa-times"></i>
                      </button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="row">

                      @foreach ($course->bestResult as $result)
                        @if ($result->user_score > $result->required_score || $result->user_score == $result->required_score)
                          <div class="col-xs-6 col-md-3 text-center">
                            <input type="text" class="knob" value="{{$result->user_score}}"  data-thickness="0.5" data-width="125" data-height="125"  data-fgColor="#00a65a">

                            <div class="knob-label">نمرهٔ مورد نیاز: {{$result->required_score}}</div>
                            <div class="knob-label">کاربر: {{$result->user['name']}}</div>
                            <div class="knob-label">کد کاربر: {{$result->user['id']}}</div>
                          </div>
                          @else
                            <div class="col-xs-6 col-md-3 text-center">
                              <input type="text" class="knob" value="{{$result->user_score}}"  data-thickness="0.5" data-width="125" data-height="125"  data-fgColor="#f56954">

                              <div class="knob-label">نمرهٔ مورد نیاز: {{$result->required_score}}</div>
                              <div class="knob-label">کاربر: {{$result->user['name']}}</div>
                              <div class="knob-label">کد کاربر: {{$result->user['id']}}</div>
                            </div>
                        @endif

                      @endforeach

                      <!-- ./col -->
                    </div>
                    <!-- /.row -->
                  </div>
                  <!-- /.box-body -->
                </div>
                <!-- /.box -->
              </div>
            @endforeach
      <!-- /.col -->
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
