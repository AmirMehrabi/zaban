<!-- Logo -->
<a href="{{route('homepage')}}" class="logo">
  <!-- mini logo for sidebar mini 50x50 pixels -->
  <span class="logo-mini"><b>آ</b>ز</span>
  <!-- logo for regular state and mobile devices -->
  <span class="logo-lg"><b>آموزش</b>زبان</span>
</a>

<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top">
  <!-- Sidebar toggle button-->
  <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only">Toggle navigation</span>
  </a>
  <!-- Navbar Right Menu -->
  <div class="navbar-custom-menu">
    <ul class="nav navbar-nav">
      <li class="dropdown user user-menu">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
          <img src="{{Gravatar::get(Auth::user()->email)}}" class="user-image" alt="User Image">
          <span class="hidden-xs">{{Auth::user()->name}}</span>
        </a>
        <ul class="dropdown-menu">
          <!-- User image -->
          <li class="user-header">
            <img src="{{Gravatar::get(Auth::user()->email)}}" class="img-circle" alt="User Image">

            <p>
            {{Auth::user()->name}}
              <small>مدیر سیستم</small>
            </p>
          </li>
          <!-- Menu Body -->

          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{route('profile')}}" target="_blank" class="btn btn-default btn-flat">پروفایل</a>
            </div>
            <div class="pull-right">
              <a href="{{url('logout')}}" class="btn btn-default btn-flat">خروج</a>
            </div>
          </li>
        </ul>
      </li>
      <!-- Control Sidebar Toggle Button -->

    </ul>
  </div>
</nav>
