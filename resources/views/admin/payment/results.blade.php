@extends('layouts.admin')

@section('title', 'مدیریت لغات')


@section('content')



  <div class="content">
      <div class="row">



          <div class="col-md-12 col-xs-12">
            <h2>گزارش فعالیت</h2>


            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {!! session('flash_notification.message') !!}
                </div>
            @endif

            <div class="row">
        <div class="col-xs-12">
          <div class="box">
            <div class="box-header">
              <h3 class="box-title">گزارش فعالیت های کاربر {{$user->name}}</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <table class="table table-condensed">
                <tr>
                  <th style="width: 10px">#</th>
                  <th>نام دوره</th>
                  <th>تعداد کل سوالات</th>
                  <th>سوالات صحیح پاسخ داده شده</th>
                  <th>نمره مورد نیاز</th>
                  <th style="min-width: 250px;">نمره کسب شده</th>
                </tr>
                @foreach ($results as $result)
                  <tr>
                    <td>1.</td>
                    <td>{{$result->course->title}}</td>
                    <td>{{$result->questions}}</td>
                    <td>{{$result->correct_responses}}</td>
                    <td>
                      {{$result->required_score}} %
                    </td>
                    <td>
                      <div class="progress progress-xs">
                        <div class="progress-bar {{$result->user_score >= $result->required_score ? 'progress-bar-success' : 'progress-bar-danger'}}" style="width: {{$result->user_score}}%"></div>
                      </div>
                    </td>
                    <td><span class="badge {{$result->user_score >= $result->required_score ? 'bg-green' : 'bg-red'}}">{{$result->user_score}}%</span></td>
                  </tr>
                @endforeach


              </table>
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
        </div>
      </div>




  </div>
</div>
</div>
@endsection
