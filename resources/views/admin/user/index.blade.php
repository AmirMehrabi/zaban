@extends('layouts.admin')

@section('title', 'مدیریت کاربران')


@section('content')



  <div class="content">
      <div class="row">
          <div class="col-md-12 col-xs-12">
            <h2>مدیریت کاربر ها</h2>
            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <div class="row">
                          <div class="col-md-6">
                            <h3 class="box-title">کاربر های موجود</h3>

                          </div>
                          <div class="col-md-6">
                            {!! Form::open(['route' => 'admin.users.search', 'method' => 'post']) !!}
                            <div class="input-group col-md-12">
                                <input name="keyword" type="text" class="form-control input-md" placeholder="جست و جو بر اساس نام" />
                                <span class="input-group-btn">
                                    <button class="btn btn-info btn-md" type="submit">
                                        <i class="glyphicon glyphicon-search"></i>
                                    </button>
                                </span>
                            </div>
                            {!! Form::close() !!}

                          </div>
                        </div>



                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="table-responsive">
                          <table class="table no-margin">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>نام کاربر</th>
                              <th>تاریخ آخرین فعالیت</th>
                              <th>ایمیل کاربر</th>
                              <th>تاریخ ثبت نام</th>
                              <th><em class="fa fa-user-circle"></em> نقش</th>
                              <th><em class="fa fa-area-chart"></em> فعالیت ها</th>
                              <th class="text-center"><em class="fa fa-cog"></em></th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($users as $counti => $user)
                                <tr>
                                  <td><a href="">{{$user->id}}</a></td>
                                  <td>
                                    {{$user->name}}
                                  </td>
                                  <td class="text-center">
                                    {{ $user->updated_at }} <br>
                                    {{$user->updated_at->diffForHumans()}}
                                  </td>

                                  <td>
                                    {{$user->email}}
                                  </td>

                                  <td>
                                    {{jDate($user->created_at )->format('date')}}
                                  </td>

                                  <td>
                                    @foreach ($user->roles as $role)
                                      <span class="label label-default">{{$role->name}} </span>
                                    @endforeach
                                  </td>

                                  <td>
                                    <a href="{{route('admin.users.show', $user->id)}}" class="label label-default"> گزارش فعالیت‌ها </a>
                                  </td>

                                  <td class="text-center">
                                    <a href="{{route('admin.users.edit', $user->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$user->id}}"><i class="fa fa-trash-o"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal-{{$user->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                      <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title" id="myModalLabel">حذف پست</h4>
                                          </div>
                                          <div class="modal-body">
                                            آیا از حذف این پست اطمینان دارید؟
                                          </div>
                                          <div class="modal-footer">
                                            {!! Form::open(['route' => ['admin.users.destroy', $user->id],  'method' => 'delete']) !!}
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">خیر</button>
                                            {!! Form::submit('بله', ['class' => 'btn btn-danger pull-left']) !!}
                                            {!! Form::close() !!}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>

                                </tr>
                              @endforeach

                            </tbody>
                          </table>
                        </div>
                        <!-- /.table-responsive -->
                      </div>

                      <!-- /.box-body -->

                      <div class="box-footer clearfix">
                      </div>
                      <!-- /.box-footer -->
                    </div>



                    <!-- /.row -->

                    <!-- TABLE: LATEST ORDERS -->

                    <!-- /.box -->
                  </div>
                  <!-- /.col -->

                  <div class="col-md-4">
                    <!-- Info Boxes Style 2 -->




                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>




  </div>
</div>
</div>
@endsection
