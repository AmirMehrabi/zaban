<!-- sidebar: style can be found in sidebar.less -->
<section class="sidebar">
  <!-- Sidebar user panel -->
  <div class="user-panel">
    <div class="pull-left image">
      <img src="{{Gravatar::get(Auth::user()->email)}}" class="img-circle" alt="User Image">
    </div>
    <div class="pull-left info">
      <p>{{Auth::user()->name}}</p>
      <a href="#"><i class="fa fa-circle text-success"></i> آنلاین</a>
    </div>
  </div>
  <!-- search form -->
  <form action="#" method="get" class="sidebar-form">
    <div class="input-group">
      <input type="text" name="q" class="form-control" placeholder="جست و جو">
          <span class="input-group-btn">
            <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
            </button>
          </span>
    </div>
  </form>
  <!-- /.search form -->
  <!-- sidebar menu: : style can be found in sidebar.less -->
  <ul class="sidebar-menu">
    <li class="header">منوی مدیریت</li>
    <li class="{{Request::is('admin') ? ' active' : null}}"> <a href="{{url('/admin')}}"><i class="fa fa-dashboard"></i><span>داشبورد</span> </a></li>

    <li class="{{Request::is('admin/transactions') ? ' active' : null}}"> <a href="{{url('/admin/transactions')}}"><i class="fa fa-exchange"></i><span>تراکنش ها</span> </a></li>

    <li class="{{Request::is('admin/messages') ? ' active' : null}}"> <a href="{{url('/admin/messages')}}"><i class="fa fa-envelope"></i><span>پیغام‌های کاربران</span> </a></li>

    <li class="{{Request::is('admin/reports') ? ' active' : null}}"> <a href="{{url('/admin/reports/courses')}}"><i class="fa fa-bar-chart-o"></i><span>گزارش نمرات برتر</span> </a></li>

    <li class="{{Request::is('admin/reports') ? ' active' : null}}"> <a href="{{url('/admin/reports/stats')}}"><i class="fa fa-bar-chart-o"></i><span>گزارش بازدیدها</span> </a></li>

    <li class="{{Request::is('admin/settings') ? ' active' : null}}"> <a href="{{url('/admin/settings')}}"><i class="fa fa-cog"></i><span>تنظیمات وب‌سایت</span> </a></li>


    <li class="{{ Request::is('admin/subscription') ||  Request::is('admin/subscription/create')  ? ' active' : null  || Request::is('admin/subscription/create') ? ' active' : null}} treeview">
      <a href="{{route('admin.users.index')}}">
      <i class="fa fa-user"></i><span>پلن‌های اشتراک</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{Request::is('admin/subscription') ? ' active' : null}}"><a href="{{url('admin/subscription')}}"></i> مدیریت پلن ها</a></li>
        <li class="{{Request::is('admin/subscription/create') ? ' active' : null}}"><a href="{{url('admin/subscription/create')}}"></i> افزودن پلن ها</a></li>
      </ul>

    <li class="{{ Request::is('admin/users') ||  Request::is('admin/users/create')  ? ' active' : null  || Request::is('admin/users/create') ? ' active' : null}} treeview">
      <a href="{{route('admin.users.index')}}">
      <i class="fa fa-user"></i><span>کاربران</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{Request::is('admin/users') ? ' active' : null}}"><a href="{{url('admin/users')}}"></i> مدیریت کاربران</a></li>
        <li class="{{Request::is('admin/users/create') ? ' active' : null}}"><a href="{{url('admin/users/create')}}"></i> افزودن کاربر</a></li>
      </ul>
    </li>

    <li class="header">مدیریت بخش ها</li>



    <li class="{{ Request::is('admin/courses') ||  Request::is('admin/courses/create') || Request::is('admin/categories') ||  Request::is('admin/categories/create') ? ' active' : null  || Request::is('admin/courses/create') ? ' active' : null}} treeview">
      <a href="{{route('admin.courses.index')}}">
      <i class="fa fa-language"></i><span>دوره ها</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
<!--        <li class="{{Request::is('admin/courses') ? ' active' : null}}"><a href="{{url('admin/courses')}}"></i> مدیریت دوره ها</a></li>
        <li class="{{Request::is('admin/courses/create') ? ' active' : null}}"><a href="{{url('admin/courses/create')}}"></i> افزودن دوره</a></li>-->
        <li class="{{Request::is('admin/categories') ? ' active' : null}}"><a href="{{url('admin/categories')}}"></i> دوره ها</a></li>
        <li class="{{Request::is('admin/categories/create') ? ' active' : null}}"><a href="{{url('admin/categories/create')}}"></i> افزودن دوره</a></li>
      </ul>
    </li>




        <li class="{{ Request::is('admin/vocabs') ||  Request::is('admin/vocabs/create') || Request::is('admin/album') || Request::is('admin/album/create') ? ' active' : null }} treeview">
          <a href="{{route('admin.vocabs.index')}}">
          <i class="fa fa-language"></i><span>فرهنگ مصور</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{Request::is('admin/vocabs') ? ' active' : null}}"><a href="{{url('admin/vocabs')}}"></i> مدیریت واژگان</a></li>
            <li class="{{Request::is('admin/vocabs/create') ? ' active' : null}}"><a href="{{url('admin/vocabs/create')}}"></i> افزودن واژه</a></li>
            <li class="{{Request::is('admin/album') ? ' active' : null}}"><a href="{{url('admin/album')}}"></i>مدیریت دسته بندی ها</a></li>
            <li class="{{Request::is('admin/album/create') ? ' active' : null}}"><a href="{{url('admin/album/create')}}"></i> افزودن دسته بندی</a></li>
          </ul>
        </li>


<!--    <li class="{{ Request::is('admin/lessons') ||  Request::is('admin/lessons/create') ? ' active' : null  || Request::is('admin/lessons/create') ? ' active' : null}} treeview">
      <a href="{{route('admin.lessons.index')}}">
      <i class="fa fa-language"></i><span>دروس</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{Request::is('admin/lessons') ? ' active' : null}}"><a href="{{url('admin/lessons')}}"></i> مدیریت دروس</a></li>
        <li class="{{Request::is('admin/lessons/create') ? ' active' : null}}"><a href="{{url('admin/lessons/create')}}"></i> افزودن درس</a></li>
      </ul>
    </li>-->



    <li class="{{ Request::is('admin/posts') || Request::is('admin/posts/create') ? ' active' : null  || Request::is('admin/posts/create') ? ' active' : null}} treeview">
      <a href="{{route('admin.posts.index')}}">
        <i class="fa fa-picture-o"></i><span>نوشته ها</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{Request::is('admin/posts') ? ' active' : null}}"><a href="{{url('admin/posts')}}"></i>مدیریت نوشته ها</a></li>
        <li class="{{Request::is('admin/posts/create') ? ' active' : null}}"><a href="{{url('admin/posts/create')}}"></i> افزودن نوشته</a></li>
      </ul>
    </li>


    <li class="{{ Request::is('admin/pages') || Request::is('admin/pages/create') ? ' active' : null  || Request::is('admin/posts/create') ? ' active' : null || Request::is('admin/groups') ? ' active' : null || Request::is('admin/groups/create') ? ' active' : null}} treeview">
      <a href="{{route('admin.posts.index')}}">
        <i class="fa fa-picture-o"></i><span>صفحات پانویس</span>
        <span class="pull-right-container">
          <i class="fa fa-angle-left pull-right"></i>
        </span>
      </a>
      <ul class="treeview-menu">
        <li class="{{Request::is('admin/pages') ? ' active' : null}}"><a href="{{url('admin/pages')}}"></i>مدیریت صفحات</a></li>
        <li class="{{Request::is('admin/pages/create') ? ' active' : null}}"><a href="{{url('admin/pages/create')}}"></i> افزودن صفحه</a></li>
<!--        <li class="{{Request::is('admin/groups') ? ' active' : null}}"><a href="{{url('admin/groups')}}"></i>مدیریت دسته بندی ها</a></li>
        <li class="{{Request::is('admin/groups/create') ? ' active' : null}}"><a href="{{url('admin/groups/create')}}"></i> افزودن دسته بندی</a></li>-->
      </ul>
    </li>






<!--    <li class="header">فیلتر سوالات</li>
    <li><a href="#"> <span>تمامی سوالات</span> <i class="fa fa-circle-o text-white"></i></a></li>
    <li><a href="#"> <span>تائید نشده</span> <i class="fa fa-circle-o text-red"></i></a></li>
    <li><a href="#"> <span>در انتظار پاسخ</span> <i class="fa fa-circle-o text-yellow"></i></a></li>
    <li><a href="#"> <span>پاسخ داده شده</span> <i class="fa fa-circle-o text-green"></i></a></li>-->
  </ul>
</section>
<!-- /.sidebar -->
