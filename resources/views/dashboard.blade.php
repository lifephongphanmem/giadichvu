@extends('main')

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
                    @if(can('dvlt','index') || can('kkdvlt','index'))
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat red-intense">
                            <div class="visual">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="details">
                                <div class="number"></div>
                                <div class="desc">
                                    Giá dịch vụ lưu trú<br>
                                    <?php
                                    $model = \App\KkGDvLt::where('trangthai','Chờ nhận')
                                        ->count()
                                    ?>
                                    <h5>{{(session('admin')->level == 'T')? 'Chờ nhận: '.$model.' hồ sơ' : ''}}</h5>

                                </div>
                            </div>
                            <a class="more" href="
                                {{(session('admin')->level == 'T')? url('xet_duyet_ke_khai_dich_vu_luu_tru/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')
                                : url('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh')}}">
                                Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    @endif
                @endif
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat blue-madison">
                        <div class="visual">
                            <i class="fa fa-car"></i>
                        </div>
                        <div class="details">
                            <div class="number"></div>
                            <div class="desc">
                                Giá vận tải xe khách
                            </div>
                        </div>
                        <a class="more" href="{{url('giahhdv-trongnuoc')}}">
                            Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="dashboard-stat red-intense">
                        <div class="visual">
                            <i class="fa fa-car"></i>
                        </div>
                        <div class="details">
                            <div class="number"></div>
                            <div class="desc">
                                Giá vận tải xe buýt
                            </div>
                        </div>
                        <a class="more" href="">
                            Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                        </a>
                    </div>
                </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat purple-plum">
                            <div class="visual">
                                <i class="fa fa-taxi"></i>
                            </div>
                            <div class="details">
                                <div class="number"></div>
                                <div class="desc">
                                    Giá vận tải xe taxi
                                </div>
                            </div>
                            <a class="more" href="">
                                Xem chi tiết<i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat blue-madison">
                            <div class="visual">
                                <i class="fa fa-truck"></i>
                            </div>
                            <div class="details">
                                <div class="number"></div>
                                <div class="desc">
                                    Giá vận tải chở hàng
                                </div>
                            </div>
                            <a class="more" href="">
                                Xem chi tiết<i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>

            </div>
            <div class="clearfix">
            </div>
        </div>
    </div>

@stop 