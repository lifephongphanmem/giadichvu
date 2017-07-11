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
                            @if(!isset($modeltttd))
                            <a href="{{url('ttdn_dich_vu_luu_tru/'.$model->id.'/edit')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Thay đổi thông tin </a>
                            @elseif($modeltttd->trangthai != 'Chờ duyệt')
                                <a href="{{url('ttdn_dich_vu_luu_tru/'.$modeltttd->id.'/chinhsua')}}" class="btn btn-default btn-sm">
                                    <i class="fa fa-edit"></i> Chỉnh sửa thông tin </a>
                                <a href="{{url('ttdn_dich_vu_luu_tru/'.$modeltttd->id.'/chuyen')}}" class="btn btn-default btn-sm">
                                    <i class="fa fa-share-square-o"></i> Chuyển thông tin</a>
                            @endif
                        @endif
                        <!--a href="" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a-->
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-6">
                        <table id="user" class="table table-bordered table-striped">
                            <tbody>
                            <tr>
                                <td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin hiện tại</b></td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Cơ quan chủ quản</b>
                                </td>
                                <td style="width:35%">

                                <span class="text-muted"><b>{{$model->tencqcq}}</b>
                                </span>
                                </td>
                            </tr>
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
                                    <b>Email quản lý</b>
                                </td>
                                <td style="width:35%">
                                <span class="text-muted">{{$model->email}}
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
                                    <b>Giấy phép kinh doanh</b>
                                </td>
                                <td style="width:35%">
                                <span class="text-muted">{{$model->giayphepkd}}
                                </span>
                                </td>
                            </tr>
                            <tr>
                                <td style="width:15%">
                                    <b>Link chia sẻ giấy phép đăng ký kinh doanh</b>
                                </td>
                                <td style="width:35%">
                                <span class="text-muted"><a href="{{$model->tailieu}}" target="_blank">Xem chi tiết</a>
                                </span>
                                </td>
                            </tr>

                            <tr>
                                <td style="width:15%">
                                    <b>Chức danh người ký</b>
                                </td>
                                <td style="width:35%">
                                <span class="text-muted">{{$model->chucdanhky}}
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
                        @if(isset($modeltttd))
                        <div class="col-md-6">
                            <table id="user" class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin thay đổi</b></td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Cơ quan chủ quản</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted"><b>{{$modeltttd->tencqcq}}</b>
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Tên doanh nghiệp</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->tendn}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Mã số thuế</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->masothue}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Địa chỉ trụ sở chính</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->diachi}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Điện thoại trụ sở chính</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->tel}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Số fax trụ sở chính</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->fax}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Email quản lý</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->email}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Nơi đăng ký nộp thuế</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->noidknopthue}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Giấy phép kinh doanh</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->giayphepkd}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Link chia sẻ giấy phép đăng ký kinh doanh</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted"><a href="{{$modeltttd->tailieu}}" target="_blank">Xem chi tiết</a>
                                </span>
                                    </td>
                                </tr>

                                <tr>
                                    <td style="width:15%">
                                        <b>Chức danh người ký</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->chucdanhky}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Họ và tên người ký</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->nguoiky}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Địa danh</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->diadanh}}
                                </span>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        @endif
                    </div>
                    @if(isset($modeltttd))
                    @if($modeltttd->trangthai == 'Bị trả lại')
                    <div class="row">
                        <div class="col-md-12">
                           <h3 style="font-weight: bold; color: #ff0000">Hồ sơ bị trả lại</h3>
                            <p>Lý do: {{$modeltttd->lydo}}</p>
                        </div>
                    </div>
                    @endif
                    @endif
                </div>
            </div>
        </div>
    </div>
@stop