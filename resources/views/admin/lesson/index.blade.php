@extends('layouts.admin')

@section('title', 'مدیریت دروس')

@section('content')



  <div class="content">
      <div class="row">


  <div class="col-md-12 col-xs-12<">
    <h2>مدیریت دروس</h2>




    <div class="row">
          <!-- Left col -->
          <div class="col-md-12 col-xs-12<">
            <!-- MAP & BOX PANE -->
            <div class="box box-info">
              <div class="box-header with-border">
                <h3 class="box-title">درس های موجود</h3>

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
                          <th>دوره ها</th>
                          <th>تعداد سوالات</th>
                          <th class=" text-center"><em class="fa fa-cog"></em></th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($lessons as $lesson)
                        <tr>
                          <td class="hidden-xs">{{$lesson->id}}</td>
                          <td>{{$lesson->title}}</td>
                          <td>{{$lesson->excerpt}}</td>
                          <td>
                            @foreach ($lesson->courses as $course)
                              <span class="admin-tag">{{$course->title}}</span>
                            @endforeach

                          </td>
                          <td>
                            <span>{{$lesson->questions->count()}} سوال</span>
                            </ul>

                          </td>
                          <td align="center">
                            <a href="{{route('admin.lessons.edit', $lesson->id)}}" class="label label-info"><em class="fa fa-pencil"></em></a>
                            <a href="#" class="label label-danger" data-toggle="modal" data-target="#deleteModal-{{$lesson->id}}"><i class="fa fa-trash-o"></i></a>

                            <!-- Modal -->
                            <div class="modal fade" id="deleteModal-{{$lesson->id}}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                              <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title" id="myModalLabel">حذف درس</h4>
                                  </div>
                                  <div class="modal-body">
                                    آیا از حذف این درس اطمینان دارید؟
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
                {!! $lessons->render() !!}
              </div>
              <!-- /.box-footer -->
            </div>



            <!-- /.row -->

            <!-- TABLE: LATEST ORDERS -->

            <!-- /.box -->
          </div>

        </div>

</div>
</div>
</div>
@endsection


@section('footer-assets')
  <script type="text/javascript">
  $(document).ready(function(){
      persian={0:'۰',1:'۱',2:'۲',3:'۳',4:'۴',5:'۵',6:'۶',7:'۷',8:'۸',9:'۹'};
  	function traverse(el){
  		if(el.nodeType==3){
  			var list=el.data.match(/[0-9]/g);
  			if(list!=null && list.length!=0){
  				for(var i=0;i<list.length;i++)
  					el.data=el.data.replace(list[i],persian[list[i]]);
  			}
  		}
  		for(var i=0;i<el.childNodes.length;i++){
  			traverse(el.childNodes[i]);
  		}
  	}
      traverse(document.body);
  });
  </script>
@endsection
