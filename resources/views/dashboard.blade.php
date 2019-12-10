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
<h3 class="page-title">
    Thông tin hỗ trợ<small></small>
</h3>
<!-- END PAGE HEADER-->
<!-- BEGIN DASHBOARD STATS -->
<div class="row">
    <div class="col-md-12">
        <div class="well">
            <p>Công ty LifeSoft chân thành cảm ơn quý khách hàng đã tin tưởng sử dụng phần mềm của công ty.
                Thay mặt toàn bộ cán bộ nhân viên trong công ty gửi đến khách hàng lời chúc sức khỏe- thành công</p>
            <p>Nhằm chăm sóc, hỗ trợ khách hàng nhanh chóng và tiện dụng nhất công ty xin cung cấp thông tin các cán bộ hỗ trợ khách hàng trong quá trình sử dụng.
                Mọi vấn đề khúc mắc khách hàng có thể liên hệ trực tiếp cho cán bộ để được hỗ trợ!</p>
            <!--p>Số điện thoại công ty: <b>024 3634 3951</b></p-->
            <p>Phụ trách khối kỹ thuật:<b> Phó giám đốc:  Trần Ngọc Hiếu </b>- tel: <b>096 8206844</b></p>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-6">
        <!-- BEGIN PORTLET -->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Phòng TKBT I - quản lý địa bàn các tỉnh phía Nam</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr class="uppercase">
                            <th colspan="2">
                                Cán bộ hỗ trợ
                            </th>
                            <th>
                                TEL
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Nguyễn Xuân Trường</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0917 737456</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Hoàng Ngọc Long</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0985 365683</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Tạ Đình Hữu</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0917 179993</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Trần Đức Long</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0396 074886</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
    <div class="col-md-6">
        <!-- BEGIN PORTLET -->
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption caption-md">
                    <i class="icon-bar-chart theme-font hide"></i>
                    <span class="caption-subject font-blue-madison bold uppercase">Phòng TKBT II - quản lý địa bàn các tỉnh phía Bắc </span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="table-scrollable table-scrollable-borderless">
                    <table class="table table-hover table-light">
                        <thead>
                        <tr class="uppercase">
                            <th colspan="2" style="text-transform: uppercase">
                                Cán bộ hỗ trợ
                            </th>
                            <th>
                                TEL
                            </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Hoàng Văn Sáng</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0974 090 556</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Nguyễn Văn Dũng</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0986 012094</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Nguyễn Văn Đạt</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0966 305 359</span>
                            </td>
                        </tr>
                        <tr>
                            <td class="fit">
                                <img class="user-pic" src="{{url('images/avatar/default-user.png')}}">
                            </td>
                            <td>
                                <a href="" class="primary-link">Ngô Thế Dương</a>
                            </td>
                            <td style="text-align: center">
                                <span class="bold theme-font">0916 678 911</span>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END PORTLET -->
    </div>
</div>
<div class="clearfix">
</div>
@stop