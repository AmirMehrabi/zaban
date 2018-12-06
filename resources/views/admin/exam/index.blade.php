@extends('layouts.admin')

@section('title', 'مدیریت آزمون')

@section('content')



  <div class="content">
      <div class="row">

          <div class="col-md-12 col-xs-12">
            <h1>سوال های موجود</h1>


            @if (session()->has('flash_notification.message'))
                <div class="alert alert-{{ session('flash_notification.level') }}">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>

                    {!! session('flash_notification.message') !!}
                </div>
            @endif


              <div class="panel panel-default panel-table">
                <div class="panel-heading">
                  <div class="row">
                    <div class="col col-md-12 col-xs-12 text-right">
                      <a href="{{route('admin.exams.create')}}" class="btn btn-sm btn-primary btn-create pull-left">افزودن سوال جدید</a>
                    </div>
                  </div>
                </div>
                <div class="panel-body">
                  <table class="table table-striped table-bordered table-list">
                    <thead>
                      <tr>

                          <th class="hidden-xs">#</th>
                          <th>سوال</th>
                          <th>گزینه اول</th>
                          <th>گزینه دوم</th>
                          <th>گزینه سوم</th>
                          <th>گزینه چهارم</th>
                          <th class=" text-center"><em class="fa fa-cog"></em></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($exams as $exam)
                        <tr>
                          <td class="hidden-xs">{{$exam->id}}</td>
                          <td><b>{{$exam->question}}</b></td>
                          <td><b>{{$exam->opt_1}}</b></td>
                          <td><b>{{$exam->opt_2}}</b></td>
                          <td><b>{{$exam->opt_3}}</b></td>
                          <td><b>{{$exam->opt_4}}</b></td>

                          <td align="center">
                            <a href="{{route('admin.exams.edit', $exam->id)}}" class="label label-default"><em class="fa fa-pencil"></em></a>
                            <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$exam->id}}"><i class="fa fa-trash-o"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{$exam->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">حذف سوال</h4>
                                  </div>
                                  <div class="modal-body">
                                    آیا از حذف این سوال اطمینان دارید؟
                                  </div>
                                  <div class="modal-footer">
                                    {!! Form::open(['route' => ['admin.exams.destroy', $exam->id],  'method' => 'delete']) !!}
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

              </div>

  </div></div></div>
@endsection
