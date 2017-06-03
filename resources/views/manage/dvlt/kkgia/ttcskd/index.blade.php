@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>
    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });

    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin cơ sở kinh doanh <small>&nbsp;dịch vụ lưu trú</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Tên cơ sở kinh doanh</th>
                            <th style="text-align: center">Loại hạng</th>
                            <th style="text-align: center">Số điện thoại</th>
                            <th style="text-align: center">Địa chỉ</th>
                            <th style="text-align: center" width="20%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$key + 1}}</td>
                            <td class="active" >{{$tt->tencskd}}</td>
                            <td>@if($tt->loaihang == 'K' ) Khác(Nhà nghỉ)
                                @elseif ($tt->loaihang == 'CXD' ) Chưa xác định (Khách sạn chưa xác định sao)
                                @else  {{$tt->loaihang.' sao'}}
                                @endif
                            </td>
                            <td>{{$tt->telkd}}</td>
                            <td>{{$tt->diachikd}}</td>
                            <td>
                                <a href="{{url('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$tt->macskd.'&nam='. date('Y'))}}" class="btn btn-default btn-xs mbs"><i class="fa fa-plus"></i>&nbsp;Kê khai giá dịch vụ</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
@stop