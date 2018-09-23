<nav class="navbar navbar-default navbar-top">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand navbar-brand-name" href="{{route('homepage')}}">سیستم آموزشی LMS</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li class=""><a href="{{route('archive')}}">پرسش‌ها <span class="sr-only">(current)</span></a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">دسته‌بندی‌ها <span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a href="{{route('category.contract')}}">قرارداد</a></li>
            <li><a href="{{route('category.debt')}}">وصول مطالبات</a></li>
            <li><a href="{{route('category.criminal')}}">کیفری</a></li>
            <li><a href="{{route('category.judical')}}">قضایی</a></li>
            <li><a href="{{route('category.civilian')}}">ملکی</a></li>
            <li><a href="{{route('category.domestic')}}">خانوادگی</a></li>
            <li><a href="{{route('category.registration')}}">ثبت احوال</a></li>
          </ul>
        </li>
      </ul>
      <div class="navbar-form navbar-right">
        {!! Form::open(array('route' => 'search', 'method' => 'post')) !!}
        <div class="input-group">
          {!! Form::text('keyword', null, ['class' => 'form-control form-search', 'placeholder' => 'جست و جو در پرسش‌ها']) !!}
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><i class="fa fa-search-plus fa-1-6" aria-hidden="true"></i></button>
          </span>
        </div><!-- /input-group -->
        {!! Form::close() !!}




      </div>

      <ul class="nav navbar-nav navbar-left">
        <li class=""><a href="{{route('about')}}">دربارهٔ ما</a></li>
        <li class=""><a href="{{route('contact')}}">تماس با ما</a></li>
          <li>
              <p class="navbar-btn pl-1">
                  <a href="{{route('followup')}}" class="btn btn-default "><i class="fa fa-flag" aria-hidden="true"></i> پیگیری </a>
              </p>
          </li>
          <li>
              <p class="navbar-btn">
                  <a href="{{route('topic.add')}}" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> طرح پرسش جدید</a>
              </p>
          </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>
