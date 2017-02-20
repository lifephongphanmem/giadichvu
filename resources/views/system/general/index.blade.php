@extends('main')

@section('custom-style')

@stop


@section('custom-script')

@stop

@section('content')


    <h3 class="page-title">
        Thông tin <small>cấu hình hệ thống</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        <a href="{{url('cau_hinh_he_thong/'.$model->id.'/edit')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-edit"></i> Chỉnh sửa </a>
                        <!--a href="" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a-->

                    </div>
                </div>
                <div class="portlet-body">
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td style="width:15%">
                                <b>Đơn vị quản lý</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->tendv}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Mã quan hệ ngân sách</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->maqhns}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Địa chỉ </b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->diachi}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Số hồ sơ nhận </b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->sohsnhan}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Thông tin liên lạc </b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{!! nl2br(e($model->ttlh)) !!}
                                </span>
                            </td>
                        </tr>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@stop