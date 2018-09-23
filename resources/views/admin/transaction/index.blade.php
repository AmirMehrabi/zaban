@extends('layouts.admin')

@section('title', 'مدیریت تراکنش ها')


@section('content')



  <div class="content">
      <div class="row">
          <div class="col-md-12 col-xs-12">
            <h2>مدیریت تراکنش ها</h2>
            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <div class="row">
                          <div class="col-md-6">
                            <h3 class="box-title">تراکنش های موجود</h3>

                          </div>
                          <div class="col-md-6">
                            {!! Form::open(['route' => 'admin.transactions.search', 'method' => 'post']) !!}
                            <div class="input-group col-md-12">
                                <input name="keyword" type="text" class="form-control input-md" placeholder="جست و جو بر اساس کد پیگیری" />
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
                              <th>درگاه</th>
                              <th>مبلغ</th>
                              <th>زمان تراکنش</th>
                              <th>کد پیگیری</th>
                              <th>وضعیت</th>
                              <th>IP</th>
                              <!--<th class="text-center"><em class="fa fa-cog"></em></th>-->
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($transactions as  $transaction)
                                <tr>
                                  <td><a href="">{{$transaction->id}}</a></td>
                                  <td>
                                    {{$transaction->name}}
                                  </td>
                                  <td>
                                    {{$transaction->port}}
                                  </td>

                                  <td>
                                    {{$transaction->price}}
                                  </td>

                                  <td>
                                    @if (!is_null($transaction->payment_date))
                                      {{jDate($transaction->payment_date )->format('datetime')}}
                                      @else
                                        به پایان نرسیده
                                    @endif


                                  </td>

                                  <td>
                                    {{$transaction->tracking_code}}
                                  </td>
                                  <td>
                                    @if ($transaction->status == 'SUCCEED')
                                      <span class="label label-success">موفق </span>
                                    @elseif ($transaction->status == 'INIT')
                                        <span class="label label-warning">ناموفق </span>
                                        @else
                                          <span class="label label-default">نامشخص </span>
                                    @endif
                                  </td>
                                  <td>
                                    {{$transaction->ip}}
                                  </td>



<!--                                  <td class="text-center">
                                    <a href="{{route('admin.transactions.edit', $transaction->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$transaction->id}}"><i class="fa fa-trash-o"></i></a>
                                    <div class="modal fade" id="deleteModal-{{$transaction->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            {!! Form::open(['route' => ['admin.transactions.destroy', $transaction->id],  'method' => 'delete']) !!}
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
