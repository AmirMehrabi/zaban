@extends('layouts.admin')

@section('title', 'مدیریت آلبوم‌ها')


@section('content')



  <div class="content">
      <div class="row">

          <div class="col-md-12 col-xs-12">
            <h2>مدیریت آلبوم ها</h2>

            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">آلبوم های موجود</h3>

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
                              <th>نام آلبوم</th>
                              <th>عکس</th>
                              <th class="text-center"><em class="fa fa-cog"></em></th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($vocabcats as $counti => $vocabcat)
                                <tr>
                                  <td><a href="">{{$vocabcat->id}}</a></td>
                                  <td>
                                    {{$vocabcat->title}}
                                  </td>


                                  <td>
                                    <img src="{{URL::asset($vocabcat->picture)}}" class="w-100px" alt="">
                                  </td>

                                  <td class="text-center">
                                        <a href="{{route('admin.album.edit', $vocabcat->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$vocabcat->id}}"><i class="fa fa-trash-o"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal-{{$vocabcat->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                          <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                              <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title" id="myModalLabel">حذف دسته بندی</h4>
                                              </div>
                                              <div class="modal-body">
                                                آیا از حذف این دسته بندی اطمینان دارید؟
                                              </div>
                                              <div class="modal-footer">
                                                {!! Form::open(['route' => ['admin.album.destroy', $vocabcat->id],  'method' => 'delete']) !!}
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

                    <!-- /.info-box -->

                    <!-- /.info-box -->

                    <!-- /.info-box -->

                    <!-- /.info-box -->


                    <!-- /.box -->

                    <!-- PRODUCT LIST -->

                    <!-- /.box -->
                  </div>
                  <!-- /.col -->
                </div>




  </div>
</div>
</div>
@endsection
