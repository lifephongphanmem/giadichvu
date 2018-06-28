@if(canGeneral('dvvt','vtxk') || canGeneral('dvvt','vtxb') || canGeneral('dvvt','vtxtx') || canGeneral('dvvt','vtch'))
@if(can('dvvtxk','index') ||can('dvvtxb','index')|| can('dvvtxtx','index')|| can('dvvtch','index'))
    <li>
        <a href="">
            <i class="fa fa-laptop"></i>
            <span class="title">Dịch vụ vận tải</span>
            <span class="arrow "></span>
        </a>
        <ul class="sub-menu">
            @if(can('dvvt','index'))
                <li><a href="{{url('thongtindoanhnghiep')}}">Thông tin doanh nghiệp</a></li>
            @endif
            @if(canGeneral('dvvt','vtxk') && (can('dvvtxk','index') || can('kkdvvtxk','index')))
                @if(canshow('dvvt','vtxk'))
                    <li>
                        <a href="">Vận tải hành khách bằng xe ôtô theo tuyến cố định<span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            @if(can('dvvtxk','index'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_khach/danh_muc')}}">Danh mục dịch vụ</a></li>
                                <!--li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_khach/danh_muc_hl')}}">Danh mục giá hàng lý</a></li-->
                            @endif
                            @if(can('kkdvvtxk','create'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_khach/ke_khai/'.'nam='.date('Y'))}}">Kê khai giá dịch vụ</a></li>
                            @endif
                            @if(session('admin')->level =='T' || session('admin')->level =='H')
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_khach/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')}}">Hồ sơ kê khai</a></li>
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_khach/tim_kiem/maxa=all&nam='.date('Y'))}}">Tìm kiếm thông tin kê khai</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            @if(canGeneral('dvvt','vtxb') &&( can('dvvtxb','index') || can('kkdvvtxb','index')))
                @if(canshow('dvvt','vtxb'))
                    <li>
                        <a href="">Vận tải hành khách bằng xe buýt theo tuyến cố định<span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            @if(can('dvvtxb','index'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_bus/danh_muc')}}">Danh mục dịch vụ</a></li>
                            @endif
                            @if(can('kkdvvtxb','create'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_bus/ke_khai/'.'nam='.date('Y'))}}">Kê khai giá dịch vụ</a></li>
                            @endif
                            @if(session('admin')->level =='T' || session('admin')->level =='H')
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_bus/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')}}">Hồ sơ kê khai</a></li>
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_bus/tim_kiem/maxa=all&nam='.date('Y'))}}">Tìm kiếm thông tin kê khai</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            @if(canGeneral('dvvt','vtxtx') && (can('dvvtxtx','index') || can('kkdvvtxtx','index')))
                @if(canshow('dvvt','vtxtx'))
                    <li>
                        <a href="">Vận tải hành khách bằng xe taxi<span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            @if(can('dvvtxtx','index'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_taxi/danh_muc')}}">Danh mục dịch vụ</a></li>
                            @endif
                            @if(can('kkdvvtxtx','create'))
                                <!--li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_taxi/ke_khai/nam='.date('Y'))}}">Kê khai giá dịch vụ</a></li--><!--Thay thế Form mới-->
                                @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                                    <li><a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi')}}">Kê khai giá dịch vụ taxi</a></li>
                                @else
                                    <li><a href="{{url('/ke_khai_dich_vu_van_tai/xe_taxi/nam='.date('Y'))}}">Kê khai giá dịch vụ taxi</a></li>
                                @endif

                            @endif
                            @if(session('admin')->level =='T' || session('admin')->level =='H')
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_taxi/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')}}">Hồ sơ kê khai</a></li>
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_xe_taxi/tim_kiem/maxa=all&nam='.date('Y'))}}">Tìm kiếm thông tin kê khai</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

            @if(canGeneral('dvvt','vtch') &&(can('dvvtch','index') || can('kkdvvtch','index')))
                @if(canshow('dvvt','vtch'))
                    <li>
                        <a href="">Dịch vụ vận tải khác<span class="arrow"></span> </a>
                        <ul class="sub-menu">
                            @if(can('dvvtch','index'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_cho_hang/danh_muc')}}">Danh mục dịch vụ</a></li>
                            @endif
                            @if(can('kkdvvtch','create'))
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_cho_hang/ke_khai/'.'nam='.date('Y'))}}">Kê khai giá dịch vụ</a></li>
                            @endif
                            @if(session('admin')->level =='T' || session('admin')->level =='H')
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_cho_hang/xet_duyet/'.'thang='.date('m').'&nam='.date('Y').'&pl=cho_nhan')}}">Hồ sơ kê khai</a></li>
                                <li><a href="{{url('/dich_vu_van_tai/dich_vu_cho_hang/tim_kiem/maxa=all&nam='.date('Y'))}}">Tìm kiếm thông tin kê khai</a></li>
                            @endif
                        </ul>
                    </li>
                @endif
            @endif

        </ul>
    </li>
@endif
@endif