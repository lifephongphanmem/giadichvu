@extends('main')

@section('custom-style')
    <!-- put the custom style for this page here -->
    <link rel="stylesheet" href="{{ url('vendors/DataTables/media/css/jquery.dataTables.css') }}">
    <!-- <link rel="stylesheet" href="{{ url('vendors/DataTables/extensions/TableTools/css/dataTables.tableTools.min.css') }}">-->
    <link rel="stylesheet" href="{{ url('vendors/DataTables/media/css/dataTables.bootstrap.css') }}">

@stop

@section('custom-script')
    <!-- put the custom script for this page here -->
    <script type="text/javascript" src="{{ url('vendors/DataTables/media/js/jquery.dataTables.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/DataTables/media/js/dataTables.bootstrap.js') }}"></script>
    <!-- <script type="text/javascript" src="{{ url('vendors/DataTables/extensions/TableTools/js/dataTables.tableTools.min.js') }}"></script> -->
    <script type="text/javascript" src="{{ url('js/table-datatables.js') }}"></script>

@stop

@section('content')
    <h3 class="page-title">
        Thông tin doanh nghiệp cung cấp <small>dịch vụ vận tải</small>
    </h3>
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="caption">
                    </div>
                    <div class="actions">
                        <a href="{{url('dich_vu_van_tai/thong_tin_don_vi/'.$model->id.'/edit')}}" class="btn btn-default btn-sm">
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
                                <b>Tên doanh nghiệp</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->tendonvi}}
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
                                <span class="text-muted">{{$model->diachi}}
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
                                <span class="text-muted">{{$model->fax}}
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Nơi đăng ký nộp thuế</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">{{$model->dknopthue}}
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
                        <tr>
                            <td style="width:15%">
                                <b>Trang chủ</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted"><a href="http://{{$model->link}}" target="_blank">{{$model->link}}</a>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Cung cấp dịch vụ</b>
                            </td>
                            <td style="width:35%">
                                <span class="text-muted">
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtxk) && $setting->dvvt->vtxk == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxk]"/> Vận tải xe khách </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtxb) && $setting->dvvt->vtxb == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxb]"/> Vận tải xe buýt </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtxtx) && $setting->dvvt->vtxtx == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxtx]"/> Vận tải xe taxi </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtch) && $setting->dvvt->vtch == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtch]"/> Vận tải chở hàng</label>
                                        </div>
                                    </div>
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


