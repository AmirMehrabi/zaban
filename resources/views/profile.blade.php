@extends('layouts.simple')

@section('title', 'نوشته ها')


@section('header-assets')
  <link rel="stylesheet" href="{{'AdminLTE/dist/css/AdminLTE.css'}}">

<style media="screen">
  body {
    font-family: 'IRANSans-web' !IMPORTANT;
    background: #f1f1f1;
  }
</style>
@endsection

@section('content')



  <br>
<div class="container">
    <!-- Content Header (Page header) -->


    <!-- Main content -->
    <section class="container">

      @include('flash::message')

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">پروفایل کاربری</h3>
            </div>
            <div class="box-body box-profile text-center">

              <img class="profile-user-img img-responsive img-circle" src="{{Gravatar::get(Auth::user()->email)}}" alt="User profile picture">

              <p class="profile-username text-center">{{Auth::user()->name}}</p>

              <p>زمان عضویت: {{Auth::user()->created_at->diffForHumans()}}</p>

              <!-- Button trigger modal -->
              <button type="button" class="btn btn-primary btn-block" data-toggle="modal" data-target="#exampleModalLong">
                تغییر کلمهٔ عبور
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLongTitle">تغییر کلمهٔ عبور</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body text-right">
                      در صورت اطمینان از خواسته‌ی خود، کلمهٔ عبور جدید خود را در فرم زیر وارد کنید.
                    </div>


                      {!! Form::open(['route' => 'profile.updatePassword', 'method' => 'post']) !!}



                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">کلمه عبور</label>
                        {!! Form::password('password', ['class' => 'form-control', 'placeholder' => 'کلمه‌ٔ عبور']) !!}
                      </fieldset>

                      <fieldset class="form-group">
                        <label for="exampleInputPassword1">تائید کلمهٔ عبور</label>
                        {!! Form::password('password_confirmation', ['class' => 'form-control', 'placeholder' => 'تکرار کلمهٔ عبور']) !!}
                      </fieldset>







                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">بستن</button>
                      {!! Form::submit('تغییر کلمه عبور', ['class' => 'btn btn-primary']) !!}

                    </div>
                    {!! Form::close() !!}
                  </div>
                </div>
              </div>





            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

          <!-- About Me Box -->
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">وضعیت اشتراک</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              @if (Auth::user()->paid == 1)
                <p>وضعیت: <br> <span class="badge badge-pill badge-primary">دارای اشتراک</span> @if (Auth::user()->is_admin != 1)
                  <span class="badge badge-pill badge-success">{{Auth::user()->remaining}} روز باقی مانده</span>
                @endif </p>
              @elseif (Auth::user()->paid == 0)
                  <p>وضعیت: <span class="badge badge-pill badge-warning">اشتراک به اتمام رسیده</span></p>
                @elseif (Auth::user()->paid == 2)
                  <p>وضعیت: <span class="badge badge-pill badge-danger">تا کنون اشتراکی خریداری نشده</span></p>
                @elseif (Auth::guest())
                  <p>شما هنوز وارد سیستم نشده اید.</p>
              @endif



            </div>
            <!-- /.box-body -->
          </div>
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">خرید اشتراک</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <ul class="list-unstyled">
                @foreach ($subscription_fees as $subscription)
                  <li>
                    {!! Form::open(['route' => 'checkout', 'method' => 'post']) !!}
                        {!! Form::hidden('id', $subscription->id) !!}
                        {!! Form::submit($subscription->name, ['class' => 'btn btn-block btn-success mt-1']) !!}
                    {!! Form::close() !!}
                  </li>
                @endforeach

              </ul>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
        <!-- /.col -->
        <div class="col-md-9">
          @if (count($results))
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">خلاصه فعالیت ها</h3>
                <table class="table table-condensed">
                  <tr>
                    <th class="text-center" style="width: 10px"><small>#</small></th>
                    <th class="text-center"><small>نام فصل</small></th>
                    <th class="text-center"><small>تعداد کل سوالات</small></th>
                    <th class="text-center"><small>سوالات صحیح پاسخ داده شده</small></th>
                    <th class="text-center"><small>حدنصاب نمره قبولی</small></th>
                    <th class="text-center" style="min-width: 250px;"><small>نمره کسب شده</small></th>
                  </tr>
                   @foreach ($results as $result)
                    @if (count($result->course))
                      <tr>

                        <td class="text-center">#</td>
                        <td class="text-center">{{$result->course->title or 'نامشخص / حذف شده'}}</td>
                        <td class="text-center">{{$result->questions or 'نامشخص / حذف شده'}}</td>
                        <td class="text-center">{{$result->correct_responses or 'نامشخص / حذف شده'}}</td>
                        <td class="text-center">
                          {{$result->required_score }} %
                        </td>
                        <td class="text-center">
                          <div class="progress progress-xs">
                            <div class="progress-bar {{$result->user_score >= $result->required_score ? 'progress-bar-success' : 'progress-bar-danger'}}" style="width: {{$result->user_score}}%"></div>
                          </div>
                        </td>
                        <td class="text-center"><span class="badge {{$result->user_score >= $result->required_score ? 'bg-green' : 'bg-red'}}">{{$result->user_score}}%</span></td>
                      </tr>
                    @endif

                  @endforeach


                </table>
              </div>

              <!-- /.box-body -->
            </div>

            @else
                <!-- /.box-body -->
              </div>
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">خلاصه فعالیت ها</h3>
                  <br><br>
                  <p class="lead">در حال حاضر فعالیتی وجود ندارد</p>
                </div>

                <!-- /.box-body -->
              </div>
          @endif

          @if (count($subscriptions))
            <div class="box box-primary">
              <div class="box-header with-border">
                <h3 class="box-title">اشتراک دوره‌ها</h3>
                <table class="table table-condensed">
                  <tr>
                    <th class="text-center" style="width: 10px"><small>#</small></th>
                    <th class="text-center"><small>نام دوره</small></th>
                    <th class="text-center"><small>تاریخ پرداخت</small></th>
                    <th class="text-center"><small>تاریخ انقضا</small></th>
                    <th class="text-center"><small>هزینه</small></th>
                  </tr>
                  @foreach ($subscriptions as $subscription_single)
                    <tr>
                      <td class="text-center">{{$subscription_single->id}}</td>
                      <td class="text-center">{{$subscription_single->category->category_name}}</td>
                      <td class="text-center">{{jDate($subscription_single->payment_date )->format('date')}}</td>
                      <td class="text-center">{{jDate($subscription_single->expiration_date )->format('date')}}</td>
                      <td class="text-center">
                        {{$subscription_single->category->subscription_price}} ریال
                      </td>
                    </tr>
                  @endforeach


                </table>
              </div>

              <!-- /.box-body -->
            </div>
            @else
              <div class="box box-primary">
                <div class="box-header with-border">
                  <h3 class="box-title">اشتراک دوره‌ها</h3>
                  <br><br>
                  <p class="lead">در حال حاضر اشتراکی برای دوره‌ها موجود نیست</p>
                </div>

                <!-- /.box-body -->
              </div>
          @endif



          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>
    <!-- /.content -->
  </div>






@endsection
