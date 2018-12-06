@extends('layouts.admin')

@section('title', 'مدیریت پیغام ها')


@section('content')



  <div class="content">
      <div class="row">
          <div class="col-md-12 col-xs-12">
            <h2>مدیریت پیغام ها</h2>
            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <div class="row">
                          <div class="col-md-6">
                            <h3 class="box-title">پیغام های موجود</h3>

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
                              <th>نام</th>
                              <th>نام خانوادگی</th>
                              <th>ایمیل</th>
                              <th>تاریخ ارسال پیام</th>
                              <th>موضوع</th>
                              <th>پیغام</th>
                              <!--<th class="text-center"><em class="fa fa-cog"></em></th>-->
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($messages as  $message)
                                <tr>
                                  <td><a href="">{{$message->id}}</a></td>
                                  <td>
                                    {{$message->name}}
                                  </td>

                                  <td>
                                    {{$message->family_name}}
                                  </td>

                                  <td>
                                    {{$message->email}}
                                  </td>
                                  <td>
                                    {{ jDate::forge($message->created_at)->format('%d %B %Y') }} - {{$message->created_at->diffForHumans()}}
                                  </td>

                                  <td>
                                    {{$message->subject}}
                                  </td>
                                  <td>
                                    {{$message->message}}

                                  </td>




<!--                                  <td class="text-center">
                                    <a href="{{route('admin.transactions.edit', $message->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                    <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$message->id}}"><i class="fa fa-trash-o"></i></a>
                                    <div class="modal fade" id="deleteModal-{{$message->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                            {!! Form::open(['route' => ['admin.transactions.destroy', $message->id],  'method' => 'delete']) !!}
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
