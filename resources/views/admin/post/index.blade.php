@extends('layouts.admin')

@section('title', 'مدیریت نوشته‌ها')


@section('content')



  <div class="content">
      <div class="row">



          <div class="col-md-12 col-xs-12">
            <h2>مدیریت نوشته ها</h2>


            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">نوشته های موجود</h3>

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
                              <th>نام نوشته</th>
                              <th>خلاصه</th>
                              <th>تعداد بازدیدکنندگان</th>

                              <th>عکس</th>

                              <th>نوع نوشته</th>
                              <th class="text-center"><em class="fa fa-cog"></em></th>
                            </tr>
                            </thead>
                            <tbody>
                              @foreach ($posts as $counti => $post)
                                <tr>
                                  <td><a href="">{{$post->id}}</a></td>
                                  <td>
                                    {{$post->title}}
                                  </td>


                                  <td>
                                    {!!$post->excerpt!!}
                                  </td>
                                  <td>
                                    {{$post->viewers_counter}}
                                  </td>
                                  <td>
                                    <img src="{{URL::asset($post->picture)}}" class="w-100px" alt="">
                                  </td>
                                  <td>
                                    @if ($post->is_special === 0)
                                      <span class="label label-default">نوشتهٔ معمولی </span>
                                    @elseif ($post->is_special === 1)
                                      <span class="label label-success">نوشتهٔ ویژه </span>
                                    @endif

                                  </td>



                                  <td class="text-center">


                                        <a href="{{route('admin.posts.edit', $post->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                                        <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$post->id}}"><i class="fa fa-trash-o"></i></a>

                                        <!-- Modal -->
                                        <div class="modal fade" id="deleteModal-{{$post->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
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
                                                {!! Form::open(['route' => ['admin.posts.destroy', $post->id],  'method' => 'delete']) !!}
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
