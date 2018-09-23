<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>سیستم آموزش زبان | @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.6 -->
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/bootstrap/css/bootstrap.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/bootstrap/css/bootstrap-rtl.css')}}">
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/bootstrap/css/custom.css')}}">
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/bootstrap/fonts/WebFonts/style.css')}}">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.css')}} ">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/dist/css/AdminLTE.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{URL::asset('AdminLTE/dist/css/skins/_all-skins.min.css')}}">
  <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}">

  <script src="{{URL::asset('AdminLTE/plugins/jQuery/jquery-2.2.3.min.js')}}"></script>





@yield('header-assets')



</head>
<body class="hold-transition skin-purple sidebar-mini">
<div class="wrapper">

  <header class="main-header">

    @include('partials.adminNavbar')

  </header>
  <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    @include('partials.adminSidebar')
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    @if (session()->has('flash_notification.message'))
        <div class="content">
          <div class="row">
            <div class="col-md-12">
              <div class="alert alert-{{ session('flash_notification.level') }} text-right">
                  <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                  {!! session('flash_notification.message') !!}
              </div>
            </div>

          </div>
        </div>
    @endif

    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  @include('partials.footer')

  <!-- Control Sidebar -->

  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>

</div>
<!-- ./wrapper -->

<!-- jQuery 2.2.3 -->
<!-- Bootstrap 3.3.6 -->
<script src="{{URL::asset('AdminLTE/bootstrap/js/bootstrap.min.js')}}"></script>
<!-- FastClick -->
<script src="{{URL::asset('AdminLTE/plugins/fastclick/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{URL::asset('AdminLTE/dist/js/app.min.js')}}"></script>
<!-- Sparkline -->
<script src="{{URL::asset('AdminLTE/plugins/sparkline/jquery.sparkline.min.js')}}"></script>
<!-- jvectormap -->
<script src="{{URL::asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js')}}"></script>
<script src="{{URL::asset('AdminLTE/plugins/jvectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
<!-- SlimScroll 1.3.0 -->
<script src="{{URL::asset('AdminLTE/plugins/slimScroll/jquery.slimscroll.min.js')}}"></script>
<!-- ChartJS 1.0.1 -->
<script src="{{URL::asset('AdminLTE/plugins/chartjs/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- AdminLTE for demo purposes -->
<script src="{{URL::asset('AdminLTE/dist/js/demo.js')}}"></script>

<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-form-validator/2.3.26/jquery.form-validator.min.js"></script>





@yield('footer-assets')
</body>
</html>
