@extends('layouts.admin')

@section('title', 'صفحه اصلی')


@section('content')
  <!-- Content Header (Page header) -->
  <section class="content-header text-right">
    <h1>
      صفحهٔ مدیریت
      <small>ورژن ۰.۱.۰</small>
    </h1>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Info boxes -->
<!--    <div class="row">
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3>۱۵۰</h3>

              <p>خرید عضویت</p>
            </div>
            <div class="icon">
              <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-green">
            <div class="inner">
              <h3>۱۳<sup style="font-size: 20px">%</sup></h3>

              <p>درصد رشد عضویت</p>
            </div>
            <div class="icon">
              <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3>{{$registered_users_count}}</h3>

              <p>ثبت نام ها</p>
            </div>
            <div class="icon">
              <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-red">
            <div class="inner">
              <h3>۶۵</h3>

              <p>بازدیدکنندگان امروز</p>
            </div>
            <div class="icon">
              <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">اطلاعات بیشتر <i class="fa fa-arrow-circle-left"></i></a>
          </div>
        </div>
      </div>-->

      <div class="row">
        @foreach ($courses as $course)
          <div class="col-md-6">
            @foreach ($course->bestResult as $result)
              <p>{{$result->user_score}}</p>
            @endforeach

          </div>
        @endforeach
      </div>

    <div class="row">
      <!-- Left col -->
      <div class="col-md-6 col-xs-12 ">
        <!-- MAP & BOX PANE -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">آخرین فصل ها</h3>

            <div class="box-tools pull-right">

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>عنوان فصل</th>
                  <th>تعداد دروس</th>
                  <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($courses as $course)
                    <tr>
                      <td><a href="">{{$course->id}}</a></td>
                      <td>
                        {{$course->title}}
                      </td>
                      <td>{{$course->lessons->count()}}</td>
                      <td>
                            <a href="{{route('admin.courses.edit', $course->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModalCourse"><i class="fa fa-trash-o"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModalCourse" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">حذف نشست</h4>
                                  </div>
                                  <div class="modal-body">
                                    آیا از حذف این نشست اطمینان دارید؟
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
          </div>
          <!-- /.box-footer -->
        </div>



        <!-- /.row -->

        <!-- TABLE: LATEST ORDERS -->

        <!-- /.box -->
      </div>

      <div class="col-md-6 col-xs-12 ">
        <!-- MAP & BOX PANE -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">آخرین دروس</h3>

            <div class="box-tools pull-right">

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>عنوان درس</th>
                  <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($lessons as $lesson)
                    <tr>
                      <td><a href="">{{$lesson->id}}</a></td>
                      <td>
                        {{$lesson->title}}
                      </td>

                      <td>
                            <a href="{{route('admin.lessons.edit', $lesson->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModalLesson"><i class="fa fa-trash-o"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModalLesson" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">حذف نشست</h4>
                                  </div>
                                  <div class="modal-body">
                                    آیا از حذف این نشست اطمینان دارید؟
                                  </div>
                                  <div class="modal-footer">
                                    {!! Form::open(['route' => ['admin.lessons.destroy', $lesson->id],  'method' => 'delete']) !!}
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


      <!-- /.col -->
    </div>

    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <div class="col-md-6 col-xs-12 ">
        <!-- MAP & BOX PANE -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">آخرین آلبوم ها</h3>

            <div class="box-tools pull-right">

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>عنوان آلبوم</th>
                  <th>تصویر</th>
                  <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($albums as $album)
                    <tr>
                      <td><a href="">{{$album->id}}</a></td>
                      <td>
                        {{$album->title}}
                      </td>
                      <td> <img src="{{URL::asset($album->picture)}}" class="w-70px" alt=""></td>
                      <td>
                            <a href="{{route('admin.album.edit', $album->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModalAlbum"><i class="fa fa-trash-o"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModalAlbum" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">حذف نشست</h4>
                                  </div>
                                  <div class="modal-body">
                                    آیا از حذف این نشست اطمینان دارید؟
                                  </div>
                                  <div class="modal-footer">
                                    {!! Form::open(['route' => ['admin.album.destroy', $album->id],  'method' => 'delete']) !!}
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

      <div class="col-md-6 col-xs-12 ">
        <!-- MAP & BOX PANE -->
        <div class="box box-info">
          <div class="box-header with-border">
            <h3 class="box-title">آخرین واژگان</h3>

            <div class="box-tools pull-right">

            </div>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <div class="table-responsive">
              <table class="table no-margin">
                <thead>
                <tr>
                  <th>ID</th>
                  <th>واژهٔ فارسی</th>
                  <th>واژهٔ انگلیسی</th>
                  <th>مدیریت</th>
                </tr>
                </thead>
                <tbody>
                  @foreach ($vocabs as $vocab)
                    <tr>
                      <td><a href="">{{$vocab->id}}</a></td>
                      <td>
                        {{$vocab->faName}}
                      </td>
                      <td>
                        {{$vocab->engName}}
                      </td>

                      <td>
                            <a href="{{route('admin.vocabs.edit', $vocab->id)}}" class="label label-info"><i class="fa fa-edit"></i></a>
                            <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModalVocab"><i class="fa fa-trash-o"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModalVocab" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">حذف نشست</h4>
                                  </div>
                                  <div class="modal-body">
                                    آیا از حذف این نشست اطمینان دارید؟
                                  </div>
                                  <div class="modal-footer">
                                    {!! Form::open(['route' => ['admin.vocabs.destroy', $vocab->id],  'method' => 'delete']) !!}
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


      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
@endsection
