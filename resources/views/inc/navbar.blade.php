<nav class="navbar navbar-toggleable-md navbar-light bg-faded">
  <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav">

      <li class="nav-item">
        <a class="nav-link" href="{{route('homepage')}}"><i class="fa fa-home"></i> صفحه نخست </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('category.index')}}"><i class="fa fa-book"></i> دوره ها </a>
      </li>

      <li class="nav-item">
        <a class="nav-link" href="{{route('vocabulary')}}"><i class="fa fa-language"></i> فرهنگ لغات </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('posts.archive')}}"><i class="fa fa-newspaper-o"></i> اخبار </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="{{route('contact')}}"><i class="fa fa-address-book"></i> تماس با ما </a>
      </li>


<!--      @if (Auth::guest())
        <li class="nav-item">
          <a class="nav-link" href="{{url('login')}}">ورود</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="{{url('register')}}">ثبت نام</a>
        </li>
        @else
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="http://example.com" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              {{ Auth::user()->name }} <span class="caret"></span>
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <a class="dropdown-item" href="{{url('admin')}}">صفحه مدیریت</a>
              <a class="dropdown-item" href="{{url('logout')}}">خروج</a>
            </div>
          </li>
      @endif-->
    </ul>
  </div>
</nav>
