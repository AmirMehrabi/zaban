@extends('layouts.app')

@section('content')


  <style media="screen">
  .panel-table .panel-body{
    padding:0;
  }

  .panel-table .panel-body .table-bordered{
    border-style: none;
    margin:0;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type {
      text-align:center;
      width: 100px;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:last-of-type,
  .panel-table .panel-body .table-bordered > tbody > tr > td:last-of-type {
    border-right: 0px;
  }

  .panel-table .panel-body .table-bordered > thead > tr > th:first-of-type,
  .panel-table .panel-body .table-bordered > tbody > tr > td:first-of-type {
    border-left: 0px;
  }

  .panel-table .panel-body .table-bordered > tbody > tr:first-of-type > td{
    border-bottom: 0px;
  }

  .panel-table .panel-body .table-bordered > thead > tr:first-of-type > th{
    border-top: 0px;
  }

  .panel-table .panel-footer .pagination{
    margin:0;
  }

  /*
  used to vertically center elements, may need modification if you're not using default sizes.
  */
  .panel-table .panel-footer .col{
   line-height: 34px;
   height: 34px;
  }

  .panel-table .panel-heading .col h3{
   line-height: 30px;
   height: 30px;
  }

  .panel-table .panel-body .table-bordered > tbody > tr > td{
    line-height: 34px;
  }
  th {
    text-align: right;
}

.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9,.col-md-10,.col-md-11,.col-md-12 {
  float: right;
}
  </style>
  <div class="container">
      <div class="row">

          <div class="col-md-12">
            <h1>درس های موجود</h1>

            <table class="table table-hover rtl text-right">
                <thead>
                  <tr>
                    <th class=" text-right">
                      تیتر
                    </th>

                    <th class=" text-right">
                      نویسنده
                    </th>
                    <th class=" text-right">
                      تاریخ نشر
                    </th>
                    <th class=" text-right">
                      نوع دوره
                    </th>
                    <th class=" text-right">
                      ویرایش
                    </th>
                    <th class=" text-right">
                      حذف
                    </th>
                  </tr>
                </thead>
                <tbody>

                  <tr>
                    <td>
                      <b>
                        <a href="#">تست تست</a>
                      </b>

                    </td>

                    <td>
                      امیر مهرابیان
                    </td>

                    <td>
                        <p>
                          دوره
                        </p>
                    </td>
                    <td style="min-width: 100px;">
                      دو روز پیش
                      <hr style="margin-top:5px; margin-bottom: 5px;">
                      ۱۷/۰۴/۱۳۹۵
                    </td>
                    <td>
                      <a href="#">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                    </td>
                    <td>
                      <a href="#">
                        <span class="glyphicon glyphicon-remove"></span>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>
                        <a href="#">تست تست</a>
                      </b>

                    </td>

                    <td>
                      امیر مهرابیان
                    </td>

                    <td>
                        <p>
                          درس
                        </p>
                    </td>
                    <td style="min-width: 100px;">
                      دو روز پیش
                      <hr style="margin-top:5px; margin-bottom: 5px;">
                      ۱۷/۰۴/۱۳۹۵
                    </td>
                    <td>
                      <a href="#">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                    </td>
                    <td>
                      <a href="#">
                        <span class="glyphicon glyphicon-remove"></span>
                      </a>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <b>
                        <a href="#">تست تست</a>
                      </b>

                    </td>

                    <td>
                      امیر مهرابیان
                    </td>

                    <td>
                        <p>
                          سوال
                        </p>
                    </td>
                    <td style="min-width: 100px;">
                      دو روز پیش
                      <hr style="margin-top:5px; margin-bottom: 5px;">
                      ۱۷/۰۴/۱۳۹۵
                    </td>
                    <td>
                      <a href="#">
                        <span class="glyphicon glyphicon-edit"></span>
                      </a>
                    </td>
                    <td>
                      <a href="#">
                        <span class="glyphicon glyphicon-remove"></span>
                      </a>
                    </td>
                  </tr>

                </tbody>
              </table>

  </div></div></div>
@endsection
