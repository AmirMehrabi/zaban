@extends('layouts.admin')

@section('title', 'مدیریت دوره')

@section('content')



  <div class="content">
      <div class="row">

        <div class="col-md-12 col-xs-12">
          <h2>مدیریت دوره ها</h2>


          <div class="row">
                <!-- Left col -->
                <div class="col-md-12 col-xs-12">
                  <!-- MAP & BOX PANE -->
                  <div class="box box-info">
                    <div class="box-header with-border">
                      <h3 class="box-title">دوره های موجود</h3>

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
                                <th class="hidden-xs">#</th>
                                <th>تیتر</th>
                                <th>متن</th>
                                <th>دروس</th>
                                <th>تعداد سوالات آزمون</th>
                                <th>مدیریت دروس</th>
                                <th class=" text-center"><em class="fa fa-cog"></em></th>
                            </tr>
                          </thead>
                          <tbody>
                            @foreach ($courses as $course)
                              <tr>
                                <td class="hidden-xs">{{$course->id}}</td>
                                <td>
                                  {!! $course->linkToPaddingTitle(route('admin.courses.show', $course->id)) !!}
                                </td>
                                <td>{{$course->excerpt}}</td>
                                <td>
                                  @foreach ($course->lessons as $lesson)
                                    <span class="admin-tag">{{$lesson->title}}</span>
                                  @endforeach
                                </td>
                                <td>{{$course->exams->count()}}</td>
                                <td>

                                  <a href="{{route('admin.courses.show', $course->id)}}" class="label label-default"> {{count($course->lessons)}} درس </a>
                                </td>
                                <td align="center">
                                  <a href="{{route('admin.courses.edit', $course->id)}}" class="label label-info"><em class="fa fa-pencil"></em></a>
                                  <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$course->id}}"><i class="fa fa-trash-o"></i></a>

                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteModal-{{$course->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                          <h4 class="modal-title" id="myModalLabel">حذف دوره</h4>
                                        </div>
                                        <div class="modal-body">
                                          آیا از حذف این دوره اطمینان دارید؟
                                        </div>
                                        <div class="modal-footer">
                                          {!! Form::open(['route' => ['admin.courses.destroy', $course->id],  'method' => 'delete']) !!}
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
                      {!! $courses->render() !!}
                    </div>
                    <!-- /.box-footer -->
                  </div>



                  <!-- /.row -->

                  <!-- TABLE: LATEST ORDERS -->

                  <!-- /.box -->
                </div>

              </div>

      </div>

          </div></div>
@endsection
