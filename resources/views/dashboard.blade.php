@extends('main')
@section('autoload')
    <meta http-equiv="refresh" content="60">
@stop

@section('custom-style')

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
                                {{(session('admin')->level == 'T' || session('admin')->level == 'H' ) ? url('xetduyet_thaydoi_thongtindoanhnghiep/phanloai=dich_vu_luu_tru')
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
                @if(canGeneral('dvgs','dvgs'))
                    @if(can('dvgs','index'))
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple-plum">
                                <div class="visual">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="details">
                                    <div class="number"></div>
                                    Thay đổi thông tin DN Sữa
                                    <div class="desc">
                                        <h5>Chờ nhận: {{$sl['cnttdndvgs']}} hồ sơ</h5>
                                        @if(session('admin')->level == 'DVGS')
                                            <h5>Bị trả lại {{$sl['btlttdndvgs']}} hồ sơ</h5>
                                        @endif
                                    </div>
                                </div>
                                <a class="more" href="
                            {{(session('admin')->level == 'T' || session('admin')->level == 'H' ) ? url('xetduyet_thaydoi_ttdoanhnghiep')
                            : url('thong_tin_dn_kkgsua')}}">
                                    Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if(can('dvgs','index'))
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red-intense">
                                <div class="visual">
                                    <i class="fa fa-building"></i>
                                </div>
                                <div class="details">
                                    <div class="number"></div>
                                    Kê khai giá mặt hàng sữa
                                    <div class="desc">

                                        <h5>Chờ nhận: {{$sl['cnkkgs']}} hồ sơ</h5>
                                        @if(session('admin')->level == 'DVGS')
                                            <h5>Bị trả lại {{$sl['btlkkgs']}} hồ sơ</h5>
                                        @endif

                                    </div>
                                </div>
                                <a class="more" href="
                            {{(session('admin')->level == 'T')? url('xet_duyet_ke_khai_gia_sua')
                            : url('ke_khai_gia_sua')}}">
                                    Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                @if(canGeneral('dvtacn','dvtacn'))
                    @if(can('dvtacn','index')  )
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple-plum">
                                <div class="visual">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="details">
                                    <div class="number"></div>
                                    Thay đổi thông tin DVTACN
                                    <div class="desc">
                                        <h5>Chờ nhận: {{$sl['cnttdndvtacn']}} hồ sơ</h5>
                                        @if(session('admin')->level == 'DVTACN')
                                            <h5>Bị trả lại {{$sl['btlttdndvtacn']}} hồ sơ</h5>
                                        @endif
                                    </div>
                                </div>
                                <a class="more" href="
                                    {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('xetduyet_thaydoi_ttdoanhnghiep?&phanloai=DVTACN')
                                    : url('ttdn_thuc_an_chan_nuoi')}}">
                                    Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                    @if(can('kkdvtacn','index'))
                        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue-madison">
                                <div class="visual">
                                    <i class="fa fa-car"></i>
                                </div>
                                <div class="details">
                                    <div class="number"></div>
                                    Kê khai giá thức ăn chăn nuôi
                                    <div class="desc">
                                        <h5>Chờ nhận: {{$sl['cnkkgtacn']}} hồ sơ</h5>
                                        @if(session('admin')->level == 'DVTACN')
                                            <h5>Bị trả lại {{$sl['btlkkgtacn']}} hồ sơ</h5>
                                        @endif
                                    </div>
                                </div>
                                <a class="more" href="
                                {{(session('admin')->level == 'T' || session('admin')->level == 'H')? url('xd_ke_khai_thucan_channuoi')
                                : url('ke_khai_thuc_an_chan_nuoi')}}">
                                    Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
            </div>
            <div class="clearfix">
            </div>


@stop 