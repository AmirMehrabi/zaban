@extends('layouts.simple')

@section('title', 'نوشته ها')


@section('header-assets')
  <link rel="stylesheet" href="{{'AdminLTE/dist/css/AdminLTE.css'}}">

<style media="screen">
  body {
    font-family: 'IRANSans-web' !IMPORTANT;
    background: #f1f1f1;
  }
</style>
@endsection

@section('content')



  <br>
<div class="container">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="container">

      <div class="row">

        <!-- /.col -->
        <div class="col-md-12">
          <h3>سوال و جواب‌های متداول</h3>
          <hr>
          <div id="accordion" role="tablist">
            @foreach ($faqs as $key => $faq)

              <div class="card">
                <div class="card-header" role="tab" id="heading-{{$key}}">
                  <h5 class="mb-0">
                    <a data-toggle="collapse" href="#collapse-{{$key}}" aria-expanded="true" aria-controls="collapse-{{$key}}">
                      {{$faq->question}}
                    </a>
                  </h5>
                </div>

                <div id="collapse-{{$key}}" class="collapse" role="tabpanel" aria-labelledby="heading-{{$key}}" data-parent="#accordion">
                  <div class="card-body">
                    <p class="p-2">
                      {{$faq->answer}}
                    </p>
                  </div>
                </div>
              </div>
            @endforeach



<!--            <div class="card">
              <div class="card-header" role="tab" id="headingTwo">
                <h5 class="mb-0">
                  <a class="collapsed" data-toggle="collapse" href="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                    چگونه متوجه شویم كه از چه دوره ای باید شروع كرد؟
                  </a>
                </h5>
              </div>
              <div id="collapseTwo" class="collapse" role="tabpanel" aria-labelledby="headingTwo" data-parent="#accordion">
                <div class="card-body">
                  <p class="p-2">
                    با تماشای فیلم ابتدای فصول هر دوره میتوانید متوجه شوید كه چه دوره ای برای شما مناسب است.
                  </p>
                </div>
              </div>
            </div>-->



<!--
<div class="card">
  <div class="card-header" role="tab" id="headingThree">
    <h5 class="mb-0">
      <a class="collapsed" data-toggle="collapse" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
        تیتر سومین سوال متداول
      </a>
    </h5>
  </div>
  <div id="collapseThree" class="collapse" role="tabpanel" aria-labelledby="headingThree" data-parent="#accordion">
    <div class="card-body">
      <p class="p-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
    </div>
  </div>
</div>






<div class="card">
  <div class="card-header" role="tab" id="headingFour">
    <h5 class="mb-0">
      <a class="collapsed" data-toggle="collapse" href="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
        تیتر سوالات متداول اینجا قرار می‌گیرند.
      </a>
    </h5>
  </div>
  <div id="collapseFour" class="collapse" role="tabpanel" aria-labelledby="headingFour" data-parent="#accordion">
    <div class="card-body">
      <p class="p-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-header" role="tab" id="headingFive">
    <h5 class="mb-0">
      <a class="collapsed" data-toggle="collapse" href="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
        تیتر سوالات متداول اینجا قرار می‌گیرند.
      </a>
    </h5>
  </div>
  <div id="collapseFive" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordion">
    <div class="card-body">
      <p class="p-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-header" role="tab" id="headingSic">
    <h5 class="mb-0">
      <a class="collapsed" data-toggle="collapse" href="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
        تیتر سوالات متداول اینجا قرار می‌گیرند.
      </a>
    </h5>
  </div>
  <div id="collapseSix" class="collapse" role="tabpanel" aria-labelledby="headingSic" data-parent="#accordion">
    <div class="card-body">
      <p class="p-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
    </div>
  </div>
</div>


<div class="card">
  <div class="card-header" role="tab" id="headingSeven">
    <h5 class="mb-0">
      <a class="collapsed" data-toggle="collapse" href="#collapseSeven" aria-expanded="false" aria-controls="collapseSeven">
        تیتر سوالات متداول اینجا قرار می‌گیرند.
      </a>
    </h5>
  </div>
  <div id="collapseSeven" class="collapse" role="tabpanel" aria-labelledby="headingSeven" data-parent="#accordion">
    <div class="card-body">
      <p class="p-2">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ و با استفاده از طراحان گرافیک است. چاپگرها و متون بلکه روزنامه و مجله در ستون و سطرآنچنان که لازم است و برای شرایط فعلی تکنولوژی مورد نیاز و کاربردهای متنوع با هدف بهبود ابزارهای کاربردی می باشد. کتابهای زیادی در شصت و سه درصد گذشته، حال و آینده شناخت فراوان جامعه و متخصصان را می طلبد تا با نرم افزارها شناخت بیشتری را برای طراحان رایانه ای علی الخصوص طراحان خلاقی و فرهنگ پیشرو در زبان فارسی ایجاد کرد. در این صورت می توان امید داشت که تمام و دشواری موجود در ارائه راهکارها و شرایط سخت تایپ به پایان رسد وزمان مورد نیاز شامل حروفچینی دستاوردهای اصلی و جوابگوی سوالات پیوسته اهل دنیای موجود طراحی اساسا مورد استفاده قرار گیرد.</p>
    </div>
  </div>
</div>
-->

          </div>


          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>






@endsection
