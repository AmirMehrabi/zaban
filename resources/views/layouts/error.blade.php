<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>خطا!</title>

    <link href="https://fontup.ir/css?fonts=GanjName:400" rel="stylesheet">
    <link href="https://fontup.ir/css?fonts=Nika:400" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/fonts/WebFonts/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{URL::asset('template/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('template/css/custom.css')}}" >

    @yield('header-assets')
  </head>
  <body>





    @yield('content')


    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <br><br><br>
          <div class="jumbotron">
            <h1 class="display-4">خطا!</h1>
            <hr class="m-y-md">
              <div class="row">
                <div class="col-md-12">
                  <div class="alert alert-danger">
                    <p class="">{{$error}}</p>
                  </div>
                </div>
              </div>
            <hr class="m-y-md">
            <p class="lead">
              <a class="btn btn-primary btn-lg" href="{{route('homepage')}}" role="button">بازگشت به صفحه‌ی نخست</a>
            </p>
          </div>
        </div>
      </div>
    </div>




    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="{{URL::asset('template/js/bootstrap.min.js')}}" ></script>



    @yield('footer-assets')
  </body>
</html>
