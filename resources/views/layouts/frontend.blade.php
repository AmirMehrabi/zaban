<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>@yield('title')</title>

    <link href="https://fontup.ir/css?fonts=GanjName:400" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/fonts/WebFonts/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css"  crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{URL::asset('css/styles.css')}}" media="screen" title="custom styles" charset="utf-8">
  </head>
  <body>

    <section style=" box-shadow: -2px 2px 1px #E8E8E8,2px 2px 1px #E0E0E0;">
      <div class="top-header">
        <div class="container">
          <div class="row">
            <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 top-header-item">
              <h2>زبان</h2>
              <p>به راحتی زبان یاد بگیرید</p>
            </div>
            <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12 align-middle" style="padding: 18px 0px 0px 0px;">
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group row">
                    <div class="col-10">
                      <input class="form-control" type="search" placeholder="دورهٔ مورد نظر خود را جست و جو کنید" id="example-search-input">
                    </div>
                  </div>
                </div>
                <div class="col-md-6">
                  {{-- <a href="#" class="btn btn-default pull-left">تدریس در اینجا</a> --}}
                  @if (Auth::user())
                    <a href="{{url('logout')}}" class="btn btn-warning pull-left">خروج</a>
                    <a href="{{url('profile')}}" class="btn btn-primary pull-left ml-1">پروفایل کاربری</a>

                    @else
                      <a href="{{url('login')}}" class="btn btn-primary pull-left">ثبت نام <i class="fa fa-user-plus"></i></a>

                      <a href="{{url('login')}}" class="btn btn-success pull-left ml-1">ورود <i class="fa fa-sign-in"></i></a>
                  @endif

                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="container">
        @include('inc.navbar')
      </div>
    </section>





    @yield('content-section')



    <section class="footer">

      <div class="center-block">
        <div class="container">
          <div class="row">
            <div class="col-md-3">
            </div>
            <div class="col-md-6">
              <h1 class="light">دیده بان نت</h1>
              <hr>
              <p>تمامی حقوق این وب‌سایت/وب‌اپلیکیشن برای <a href="#">دیده بان نت</a> محفوظ است.</p>
            </div>
          </div>
        </div>
      </div>


    </section>
    <script src="https://code.jquery.com/jquery-3.2.1.js" integrity="" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" integrity="sha384-DztdAPBWPRXSA/3eYEEUWrWCy7G5KFbe8fFjk5JAIxUYHKkDx6Qin1DkWx51bBrb" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" integrity="sha384-vBWWzlZJ8ea9aCX4pEW3rVHjgjt7zpkNpZk+02D9phzyeVkE+jo0ieGizqPLForn" crossorigin="anonymous"></script>
    @yield('footer-assets')
  </body>
</html>
