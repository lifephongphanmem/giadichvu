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
                    <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                        <div class="dashboard-stat red-intense">
                            <div class="visual">
                                <i class="fa fa-building"></i>
                            </div>
                            <div class="details">
                                <div class="number"></div>
                                <div class="desc">
                                    Giá dịch vụ lưu trú
                                </div>
                            </div>
                            <a class="more" href="{{url('thongtin-giathitruong')}}">
                                Xem chi tiết <i class="m-icon-swapright m-icon-white"></i>
                            </a>
                        </div>
                    </div>
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