@extends('layouts.admin')

@section('title', 'مدیریت اشتراکان')


@section('content')



  <div class="content">
      <div class="row">
          <div class="col-md-12 col-xs-12">
            <h2>مدیریت اشتراک ها</h2>
            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">اشتراک های موجود</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="table-responsive">
                          <table class="table no-margin">
                            <thead>
                            <tr>
                              <th>#</th>
                              <th>عنوان</th>
                              <th>مبلغ(ریال)</th>
                              <th>مدت زمان(روز)</th>
                              <th>تاریخ ایجاد</th>
                              <th class="text-center"><em class="fa fa-cog"></em></th>
                              <!--<th class="text-center"><em class="fa fa-cog"></em></th>-->
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($subscription_fees as  $subscription)
                                <tr>
                                  <td><a href="">{{$subscription->id}}</a></td>
                                  <td>
                                    {{$subscription->name}}
                                  </td>

                                  <td>
                                    {{$subscription->price}}
                                  </td>

                                  <td>
                                    {{$subscription->duration}}
                                  </td>

                                  <td>
                                    {{jDate($subscription->created_at )->format('datetime')}}
                                  </td>

                                  <td class="text-center">
                                    <a href="{{route('admin.subscription.edit', $subscription->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$subscription->id}}"><i class="fa fa-trash-o"></i></a>
                                    <!-- Modal -->
                                    <div class="modal fade" id="deleteModal-{{$subscription->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            {!! Form::open(['route' => ['admin.subscription.destroy', $subscription->id],  'method' => 'delete']) !!}
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">خیر</button>
                                            {!! Form::submit('بله', ['class' => 'btn btn-danger pull-left']) !!}
                                            {!! Form::close() !!}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>



<!--                                  <td class="text-center">
                                    <a href="{{route('admin.subscription.edit', $subscription->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$subscription->id}}"><i class="fa fa-trash-o"></i></a>
                                    <div class="modal fade" id="deleteModal-{{$subscription->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            {!! Form::open(['route' => ['admin.subscription.destroy', $subscription->id],  'method' => 'delete']) !!}
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">خیر</button>
                                            {!! Form::submit('بله', ['class' => 'btn btn-danger pull-left']) !!}
                                            {!! Form::close() !!}
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  </td>-->

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
