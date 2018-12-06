@extends('layouts.app')

@section('content')
<div class="container">
  <br><br><br>
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="card content-box">
                <div class="panel-heading">ورود</div>
                <div class="panel-body">

                    @if (session('auth_status'))
                        <div class="alert alert-{{ session('auth_status.alert') }}">
                            {{ session('auth_status.message') }}
                        </div>
                    @endif
                    @if (session()->has('flash_notification.message'))
                        <div class="alert alert-{{ session('flash_notification.level') }}">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                            {!! session('flash_notification.message') !!}
                        </div>
                    @endif

                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">آدرس ایمیل</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}">

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">کلمه عبور</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password">

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <div class="checkbox">
                                  <input type="checkbox" name="remember">
                                    <label>
                                        مرا به خاطر بسپار
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fa fa-btn fa-sign-in"></i> ورود
                                </button>
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">فراموشی کلمه عبور؟</a>
                                @if(config('user_activation.allow_resend_token'))
                                    {{--<p class="text-center">--}}
                                        <a class="btn btn-link" href="{{ route('auth.reactivate') }}">ارسال لینک فعال‌سازی </a>
                                    {{--</p>--}}
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
