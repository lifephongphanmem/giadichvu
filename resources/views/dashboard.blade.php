@extends('main')
@section('autoload')
    <!--meta http-equiv="refresh" content="60"-->
@stop

@section('custom-style')
    <style type="text/css">
        table, p {

        }
        table tr td:first-child {
            text-align: center;
        }
        td, th {
            padding: 10px;
        }
    </style>
@stop

@section('custom-script')

@stop

@section('content')
<!-- BEGIN CONTENT -->
<h3 class="page-title">
    Màn hình<small> điều khiển và thống kê</small>
</h3>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->

<div class="row">
    @if(canGeneral('dvlt','dvlt'))
        @if(can('dvlt','index'))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-building"></i>
                    </div>
                    <div class="details">
                        <div class="number"></div>
                        Thay đổi thông tin DN DVLT
                        <div class="desc">
                            <h5>Chờ nhận: {{$sl['cnttdndvlt']}} hồ sơ</h5>
                            @if(session('admin')->level == 'DVLT')
                            <h5>Bị trả lại {{$sl['btlttdndvlt']}} hồ sơ</h5>
                            @endif
                        </div>
                    </div>
                    <a class="more" href="
                    {{(session('admin')->level == 'T' || session('admin')->level == 'H' ) ? url('xetduyet_thaydoi_ttdoanhnghiep')
                    : url('ttdn_dich_vu_luu_tru')}}">
                        Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
        @if(can('kkdvlt','index'))
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat red-intense">
                <div class="visual">
                    <i class="fa fa-building"></i>
                </div>
                <div class="details">
                    <div class="number"></div>
                    Kê khai giá dịch vụ lưu trú
                    <div class="desc">

                        <h5>Chờ nhận: {{$sl['cnkkgdvlt']}} hồ sơ</h5>
                        @if(session('admin')->level == 'DVLT')
                            <h5>Bị trả lại {{$sl['btlkkgdvlt']}} hồ sơ</h5>
                        @endif

                    </div>
                </div>
                <a class="more" href="
                    {{(session('admin')->level == 'T')? url('xet_duyet_ke_khai_dich_vu_luu_tru')
                    : url('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh')}}">
                    Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
        @endif
    @endif
    @if(can('dvvtxk','index') || can('dvvtxb','index') || can('dvvtxtx','index') || can('dvvtch','index')  )
        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <div class="dashboard-stat purple-plum">
                <div class="visual">
                    <i class="fa fa-car"></i>
                </div>
                <div class="details">
                    <div class="number"></div>
                    Thay đổi thông tin DN DVVT
                    <div class="desc">
                        <h5>Chờ nhận: {{$sl['cnkkgdvlt']}} hồ sơ</h5>
                        @if(session('admin')->level == 'DVLT')
                            <h5>Bị trả lại {{$sl['btlkkgdvlt']}} hồ sơ</h5>
                        @endif
                    </div>
                </div>
                <a class="more" href="
                        {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('xetduyet_thaydoi_thongtindoanhnghiep/phanloai=dich_vu_van_tai')
                        : url('dich_vu_van_tai/thong_tin_don_vi')}}">
                    Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                </a>
            </div>
        </div>
    @endif
    @if(can('kkdvvtxk','index'))
        @if(canshow('dvvt','vtxk'))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-car"></i>
                    </div>
                    <div class="details">
                        <div class="number"></div>
                        Kê khai giá vận tải xe khách
                        <div class="desc">
                            <h5>Chờ nhận: {{$sl['cnkkgvtxk']}} hồ sơ</h5>
                            @if(session('admin')->level == 'DVVT')
                                <h5>Bị trả lại {{$sl['btlkkgvtxk']}} hồ sơ</h5>
                            @endif
                        </div>
                    </div>
                    <a class="more" href="
                        {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('/dich_vu_van_tai/dich_vu_xe_khach/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')
                        : url('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/'.'nam='.date('Y'))}}">
                        Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
    @endif
    @if(can('kkdvvtxb','index'))
        @if(canshow('dvvt','vtxb'))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat red-intense">
                    <div class="visual">
                        <i class="fa fa-car"></i>
                    </div>
                    <div class="details">
                        <div class="number"></div>
                        Kê khai giá vận tải xe buýt
                        <div class="desc">
                            <h5>Chờ nhận: {{$sl['cnkkgvtxb']}} hồ sơ</h5>
                            @if(session('admin')->level == 'DVVT')
                                <h5>Bị trả lại {{$sl['btlkkgvtxb']}} hồ sơ</h5>
                            @endif
                        </div>
                    </div>
                    <a class="more" href="
                        {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('/dich_vu_van_tai/dich_vu_xe_bus/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')
                        : url('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/'.'nam='.date('Y'))}}">
                        Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
    @endif
    @if(can('kkdvvtxtx','index'))
        @if(canshow('dvvt','vtxtx'))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat purple-plum">
                    <div class="visual">
                        <i class="fa fa-taxi"></i>
                    </div>
                    <div class="details">
                        <div class="number"></div>
                        Kê khai giá vận tải xe taxi
                        <div class="desc">
                            <h5>Chờ nhận {{$sl['cnkkgvtxtx']}} hồ sơ</h5>
                            @if(session('admin')->level == 'DVVT')
                                <h5>Bị trả lại {{$sl['btlkkgvtxtx']}} hồ sơ</h5>
                            @endif
                        </div>
                    </div>
                    <a class="more" href="
                        {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('/dich_vu_van_tai/dich_vu_xe_taxi/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')
                        : url('/dich_vu_van_tai/dich_vu_xe_taxi/ke_khai/'.'nam='.date('Y'))}}">
                        Xem chi tiết<i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
    @endif
    @if(can('kkdvvtch','index'))
        @if(canshow('dvvt','vtch'))
            <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                <div class="dashboard-stat blue-madison">
                    <div class="visual">
                        <i class="fa fa-truck"></i>
                    </div>
                    <div class="details">
                        <div class="number"></div>
                        Kê khai giá vận tải khác
                        <div class="desc">
                            <h5>Chờ nhận: {{$sl['cnkkgvtkhac']}} hồ sơ</h5>
                            @if(session('admin')->level == 'DVVT')
                                <h5>Bị trả lại {{$sl['btlkkgvtkhac']}} hồ sơ</h5>
                            @endif
                        </div>
                    </div>
                    <a class="more" href="
                        {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('/dich_vu_van_tai/dich_vu_cho_hang/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')
                        : url('/dich_vu_van_tai/dich_vu_cho_hang/ke_khai/'.'nam='.date('Y'))}}">
                        Xem chi tiết<i class="m-icon-swapright m-icon-white"></i>
                    </a>
                </div>
            </div>
        @endif
    @endif
</div>
<div class="row">
    <div class="col-md-12">
        <div class="note note-success">
            <p>Công ty LifeSoft chân thành cảm ơn quý khách hàng đã tin tưởng sử dụng phần mềm của công ty.
                Thay mặt toàn bộ cán bộ nhân viên trong công ty gửi đến khách hàng lời chúc sức khỏe- thành công</p>
            <p>Nhằm chăm sóc, hổ trợ khách hàng nhanh chóng và tiện dụng nhất công ty xin cung cấp thông tin các cán bộ hỗ trợ khách hàng trong quá trình sử dụng.
                Mọi vấn đề khúc mắc khách hàng có thẻ gọi điện thoại trực tiếp cho cán bộ để được hỗ trợ nhanh nhất có thể!</p>
            <!--p>Số điện thoại công ty: <b>024 3634 3951</b></p-->
            <p>Phụ trách khối kỹ thuật:<b> Phó giám đốc:  Trần Ngọc Hiếu </b>- tel: <b>096 8206844</b></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <p style="font-weight: bold;font-size: 18px;color: blue">Phòng TKBT I - quản lý địa bàn các tỉnh phía Nam</p>
        <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;" >
            <tr>
                <th width="2%">STT</th>
                <th width="50%">Họ và tên <br>cán bộ</th>
                <th>Chức vụ</th>
                <th width="20%">Số điện thoại liên lạc</th>
            </tr>
            <tr>
                <td style="text-align: center">1</td>
                <td style="font-weight: bold;">Nguyễn Xuân Trường</td>
                <td>Trưởng phòng</td>
                <td>0917 737456</td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td style="font-weight: bold">Hoàng Ngọc Long</td>
                <td>Phó phòng</td>
                <td>0985 365683</td>
            </tr>
            <tr>
                <td style="text-align: center">3</td>
                <td style="font-weight: bold">Triệu Hồng Đạt</td>
                <td>Nhân viên</td>
                <td>093 6368122</td>
            </tr>
            <tr>
                <td style="text-align: center">4</td>
                <td style="font-weight: bold">Nguyễn Văn Hiển</td>
                <td>Nhân viên</td>
                <td>0975 500274</td>
            </tr>
        </table>
    </div>
    <div class="col-md-6">
        <p style="font-weight: bold;font-size: 18px;color: blue">Phòng TKBT II - quản lý địa bàn các tỉnh phía Bắc </p>
        <table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
            <tr>
                <th width="2%">STT</th>
                <th width="50%">Họ và tên <br>cán bộ</th>
                <th>Chức vụ</th>
                <th width="20%">Số điện thoại liên lạc</th>
            </tr>
            <tr>
                <td style="text-align: center">1</td>
                <td style="font-weight: bold">Nguyễn Văn Nguyên</td>
                <td>Trưởng phòng</td>
                <td>0979 785068</td>
            </tr>
            <tr>
                <td style="text-align: center">2</td>
                <td style="font-weight: bold">Hoàng Văn Sáng</td>
                <td>Phó phòng</td>
                <td>0974 090556</td>
            </tr>
            <tr>
                <td style="text-align: center">3</td>
                <td style="font-weight: bold">Nguyễn Văn Dũng</td>
                <td>Nhân viên</td>
                <td>0986 012094</td>
            </tr>
            <tr>
                <td style="text-align: center">4</td>
                <td style="font-weight: bold">Nguyễn Văn Đạt</td>
                <td>Nhân viên</td>
                <td>0966 305 359</td>
            </tr>
        </table>
    </div>
</div>
<div class="clearfix">
</div>
@stop