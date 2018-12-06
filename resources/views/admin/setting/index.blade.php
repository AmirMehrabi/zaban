@extends('layouts.admin')

@section('title', 'مدیریت صفحه‌ها')


@section('content')



  <div class="content">
      <div class="row">
          <div class="col-md-12 col-xs-12">
            <!--<h2>مدیریت صفحه ها</h2>-->
            <div class="row">
                  <!-- Left col -->
                  <div class="col-md-12 col-xs-12">
                    <!-- MAP & BOX PANE -->
                    <div class="box box-info">
                      <div class="box-header with-border">
                        <h3 class="box-title">تنظیمات وب‌سایت</h3>

                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <!-- /.box-header -->
                      <div class="box-body">
                        <div class="row">
                          {!! Form::model($setting, [
                            'method' => $setting->exists ? 'put' : 'post',
                            'route'  => $setting->exists ? ['admin.settings.update', $setting->id] : ['admin.settings.store'],
                            'files' => 'true'
                            ]) !!}
                          <div class="col-md-12">
                            <form>
                              <fieldset class="form-group">
                                <label for="exampleInputEmail1">نام کوتاه وب‌سایت</label>
                                {!! Form::text('shortName', $setting->short_name, ['class' => 'form-control', 'placeholder' => 'مثال: آموزش زبان']) !!}
                              </fieldset>


                              <fieldset class="form-group">
                                <label for="exampleInputEmail1">نام بلند وب‌سایت</label>
                                {!! Form::text('fullName', $setting->short_name, ['class' => 'form-control', 'placeholder' => 'مثال: موسسه آموزش زبان ققنوس']) !!}
                              </fieldset>

<!--
                              <fieldset class="form-group">
                                <label for="exampleSelect1">جهت صفحات</label>
                                <select class="form-control" id="exampleSelect1">
                                  <option>فارسی</option>
                                  <option>English</option>
                                </select>
                              </fieldset>-->

                              <br>
                              <hr>
                              <br>

                              <div class="row">
                                <div class="col-md-3">
                                  <fieldset class="form-group">
                                    <label for="exampleInputFile">مقدمه اول</label>

                                    <!--<input type="file" class="form-control-file" id="exampleInputFile">-->


                                    {!! Form::text('intro1_picture', $setting->intro1_picture, ['class' => 'form-control', 'placeholder' => 'تصویر مقدمه (Font Awesome)']) !!}
                                    {!! Form::text('intro1_title', $setting->intro1_title, ['class' => 'form-control', 'placeholder' => 'تیتر مقدمه']) !!}
                                    {!! Form::text('intro1_description', $setting->intro1_description, ['class' => 'form-control', 'placeholder' => 'توضیحات مقدمه']) !!}

                                  </fieldset>
                                </div>
                                <div class="col-md-3">
                                  <fieldset class="form-group">
                                    <label for="exampleInputFile">مقدمه دوم</label>

                                    <!--<input type="file" class="form-control-file" id="exampleInputFile">-->


                                    {!! Form::text('intro2_picture', $setting->intro2_picture, ['class' => 'form-control', 'placeholder' => 'تصویر مقدمه (Font Awesome)']) !!}
                                    {!! Form::text('intro2_title', $setting->intro2_title, ['class' => 'form-control', 'placeholder' => 'تیتر مقدمه']) !!}
                                    {!! Form::text('intro2_description', $setting->intro2_description, ['class' => 'form-control', 'placeholder' => 'توضیحات مقدمه']) !!}

                                  </fieldset>
                                </div>
                                <div class="col-md-3">
                                  <fieldset class="form-group">
                                    <label for="exampleInputFile">مقدمه سوم</label>

                                    <!--<input type="file" class="form-control-file" id="exampleInputFile">-->


                                    {!! Form::text('intro3_picture', $setting->intro3_picture, ['class' => 'form-control', 'placeholder' => 'تصویر مقدمه (Font Awesome)']) !!}
                                    {!! Form::text('intro3_title', $setting->intro3_title, ['class' => 'form-control', 'placeholder' => 'تیتر مقدمه']) !!}
                                    {!! Form::text('intro3_description', $setting->intro3_description, ['class' => 'form-control', 'placeholder' => 'توضیحات مقدمه']) !!}

                                  </fieldset>
                                </div>
                                <div class="col-md-3">
                                  <fieldset class="form-group">
                                    <label for="exampleInputFile">مقدمه چهارم</label>

                                    <!--<input type="file" class="form-control-file" id="exampleInputFile">-->

                                    {!! Form::text('intro4_picture', $setting->intro4_picture, ['class' => 'form-control', 'placeholder' => 'تصویر مقدمه (Font Awesome)']) !!}
                                    {!! Form::text('intro4_title', $setting->intro4_title, ['class' => 'form-control', 'placeholder' => 'تیتر مقدمه']) !!}
                                    {!! Form::text('intro4_description', $setting->intro4_description, ['class' => 'form-control', 'placeholder' => 'توضیحات مقدمه']) !!}

                                  </fieldset>
                                </div>
                                <div class="col-md-12">
                                  <p class="text-muted">برای تصویر های مربوط به «تصویر مقدمه» باید از کلاس‌های <a href="http://fontawesome.io/icons/">Font Awesome</a> استفاده کنید. مثال: fa-fog</p>

                                </div>
                              </div>


                              {{Form::submit('ارسال', ['class' => 'btn btn-success pull-left'])}}
                            </form>
                          </div>
                          {{Form::close()}}
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
