@extends('main')

@section('custom-style')

@stop


@section('custom-script')

@stop

@section('content')


    <h3 class="page-title">
        Thông tin doanh nghiệp cung cấp <small>dịch vụ lưu trú</small>
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
                        @if(can('dvlt','edit'))
                            <a href="{{url('ttdn_dich_vu_luu_tru/'.$model->id.'/edit')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Chỉnh sửa </a>
                        @endif
                        <!--a href="" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a-->
                    </div>
                </div>
                <div class="portlet-body">
                    <table id="user" class="table table-bordered table-striped">
                        <tbody>
                        <tr>
                            <td style="width:15%">
                                <b>Tên doanh nghiệp</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->tendn}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Mã số thuế</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->masothue}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Địa chỉ trụ sở chính</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->diachidn}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Điện thoại trụ sở chính</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->teldn}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Số fax trụ sở chính</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->faxdn}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Nơi đăng ký nộp thuế</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->noidknopthue}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Chức danh người ký</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->chucdanh}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Họ và tên người ký</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->nguoiky}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Địa danh</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->diadanh}}
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