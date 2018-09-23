<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{$setting->fullName}} - @yield('title')</title>

    <link href="https://fontup.ir/css?fonts=GanjName:400" rel="stylesheet">
    <link href="https://fontup.ir/css?fonts=Nika:400" rel="stylesheet">
    <link rel="stylesheet" href="{{URL::asset('css/fonts/WebFonts/style.css')}}">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="{{URL::asset('template/css/bootstrap.min.css')}}" >
    <link rel="stylesheet" href="{{URL::asset('template/css/custom.css')}}" >

    @yield('header-assets')
  </head>
  <body>

    @include('inc.simple-navbar')




    @yield('content')





    <footer>
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">
            <div class="list-unstyled">
              <h5 class="text-white mb-2 footer-h-link"><b>لینک‌های مرتبط</b></h5>
              <li><a href="/faq" class="footer-link">سوالات متداول</a></li>
              <li><a href="#" class="footer-link">قوانین و مقررات</a></li>
              <li><a href="/contact" class="footer-link">تماس با ما</a></li>
              <li><a href="#" class="footer-link">درباره ما</a></li>

            </div>
          </div>
          @foreach ($roots as $root)
            <div class="col-md-3">
              <h5 class="text-white mb-2 footer-h-link"><b>{{$root->title}}</b></h5>

              <div class="list-unstyled">
                @foreach ($root->children as $post)
                  <li><a href="{{route('page', $post->slug)}}" class="footer-link">{{$post->title}}</a></li>
                @endforeach
              </div>
            </div>

          @endforeach

          <div class="col-md-3">
            <h5 class="text-white mb-2 footer-h-link"><b>مجوزها</b></h5>

            <div class="list-unstyled">
                <li>
                  <img id='brgwbrgwdrftsguigwmd' style='cursor:pointer' onclick='window.open("https://trustseal.enamad.ir/Verify.aspx?id=66109&p=hwmbhwmbnbpddrfsjzpg", "Popup","toolbar=no, location=no, statusbar=no, menubar=no, scrollbars=1, resizable=0, width=580, height=600, top=30")' alt='' src='https://trustseal.enamad.ir/logo.aspx?id=66109&p=kzoekzoelznbgthvzpfv'/>
                </li>

            </div>
          </div>




        </div>
        <hr style="border-top: 1px solid #353535 !important;">
        <div class="row">
          <p class="text-white ">کلیه حقوق برای {{$setting->fullName}} محفوظ می‌باشد.</p>
        </div>
      </div>
    </footer>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    <script src="https://npmcdn.com/tether@1.2.4/dist/js/tether.min.js"></script>
    <script src="{{URL::asset('template/js/bootstrap.min.js')}}" ></script>

    <script type="text/javascript">

    $(document).ready(function() {
      $('img').live('contextmenu', function(e){
          return false;
      });
      $('video').live('contextmenu', function(e){
          return false;
      });
      $('audio').live('contextmenu', function(e){
          return false;
      });
    });

    var message="Function Disabled!";

    function clickIE4(){
        if (event.button==2){
            alert(message);
            return false;
        }
    }

    function clickNS4(e){
        if (document.layers||document.getElementById&&!document.all){
            if (e.which==2||e.which==3){
                alert(message);
                return false;
            }
        }
    }

    if (document.layers){
        document.captureEvents(Event.MOUSEDOWN);
        document.onmousedown=clickNS4;
    }
    else if (document.all&&!document.getElementById){
        document.onmousedown=clickIE4;
    }

    document.oncontextmenu=new Function("return false")
    </script>

    @yield('footer-assets')
  </body>
</html>
