<nav class="navbar navbar-toggleable-md navbar-light bg-faded shadow-2">
  <button class="navbar-toggler navbar-toggler-left" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="{{route('homepage')}}">
    <img src="{{URL::asset('img/logo4.png')}}" height="40" class="d-inline-block align-top" alt="">
    <!--{{$setting->fullName}}-->
  </a>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav ml-auto">
      <li class="nav-item {{ Request::is('/') ? 'active' : '' }}">
        <a class="nav-link" href="{{route('homepage')}}">صفحهٔ نخست <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item {{ Request::is('archive/courses')  ? 'active' : '' }}">
        <a class="nav-link" href="{{route('category.index')}}">دوره ها</a>
      </li>
      <li class="nav-item {{ Request::is('vocabulary'  ) ?'active' : '' }}">
        <a class="nav-link" href="{{route('vocabulary')}}">فرهنگ مصور</a>
      </li>


      <li class="nav-item {{ Request::is('contact')  ? 'active' : '' }}">
        <a class="nav-link" href="{{route('contact')}}">تماس با ما</a>
      </li>

    </ul>
    <ul class="navbar-nav">
      @if (Auth::check())
        <li class="dropdown">
          <a class="btn btn-link dropdown-toggle IRANSans" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
           {{Auth::user()->name}}
          </a>
          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
            @if (Auth::user()->hasRole('admin'))
              <a class="dropdown-item" href="{{route('admin')}}">پنل مدیریت</a>
            @endif
            <a class="dropdown-item" href="{{route('profile')}}">پروفایل کاربری</a>
            <a class="dropdown-item" href="{{url('logout')}}">خروج</a>
          </div>
        </li>
      @elseif (Auth::guest())

        <li class="nav-item">
          <a href="{{url('login')}}" class="btn btn-outline-primary ml-1"><i class="fa fa-sign-in"></i> ورود </a>
        </li>
        <li class="nav-item">
          <a href="{{url('register')}}" class="btn btn-primary "><i class="fa fa-user-plus"></i> ثبت نام </a>
        </li>
      @endif


    </ul>
  </div>
</nav>
