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
                        @if(!isset($modeltttd))
                            <a href="{{url('dich_vu_van_tai/thong_tin_don_vi/'.$model->id.'/edit')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Thay đổi thông tin </a>
                        @elseif($modeltttd->trangthai == 'Bị trả lại')
                            <a href="{{url('dich_vu_van_tai/thong_tin_don_vi/'.$modeltttd->id.'/chinhsua')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-edit"></i> Chỉnh sửa thông tin </a>
                        @endif

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
                                <span class="text-muted">{{$model->dienthoai}}
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
                                <b>Giấy đăng ký kinh doanh</b>
                            </td>
                            <td style="width:35%">
                                    <span class="text-muted">{{$model->giayphepkd}}
                                    </span>
                            </td>
                        </tr>
                        <tr>
                            <td style="width:15%">
                                <b>Link chia sẻ giấy đăng ký kinh doanh</b>
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
                        @if(isset($modeltttd))
                            <div class="col-md-6">
                            <table id="user" class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td colspan="2" style="text-align: center;color: #5b9bd1"><b>Thông tin thay đổi</b></td>
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
                                        <b>Nơi đăng ký nộp thuế</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted">{{$modeltttd->noidknopthue}}
                                </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Giấy đăng ký kinh doanh</b>
                                    </td>
                                    <td style="width:35%">
                                    <span class="text-muted">{{$modeltttd->giayphepkd}}
                                    </span>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        <b>Link chia sẻ giấy đăng ký kinh doanh</b>
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
                                <tr>
                                    <td style="width:15%">
                                        <b>Trang chủ</b>
                                    </td>
                                    <td style="width:35%">
                                <span class="text-muted"><a href="http://{{$modeltttd->link}}" target="_blank">{{$modeltttd->link}}</a>
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
                                                <input type="checkbox" {{ (isset($settingtttd->dvvt->vtxk) && $settingtttd->dvvt->vtxk == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxk]"/> Vận tải xe khách </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($settingtttd->dvvt->vtxb) && $settingtttd->dvvt->vtxb == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxb]"/> Vận tải xe buýt </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($settingtttd->dvvt->vtxtx) && $settingtttd->dvvt->vtxtx == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxtx]"/> Vận tải xe taxi </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($settingtttd->dvvt->vtch) && $settingtttd->dvvt->vtch == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtch]"/> Vận tải chở hàng</label>
                                        </div>
                                    </div>
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
                                    <h5>Hồ sơ bị trả lại</h5>
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


