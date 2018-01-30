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
        $(function(){

            $('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var masothue = $('#masothue').val();
                var url = '/search_ke_khai_dich_vu_luu_tru/doanh_nghiep=all&co_so_kinh_doanh=all'+'&namhs='+namhs;
                window.location.href = url;
            });
            $('#masothue').change(function() {
                var namhs = $('#namhs').val();
                var masothue = $('#masothue').val();
                var url = '/search_ke_khai_dich_vu_luu_tru/doanh_nghiep='+ masothue +'&co_so_kinh_doanh=all'+'&namhs='+namhs;
                window.location.href = url;
            });
            $('#cskd').change(function(){
                var namhs = $('#namhs').val();
                var masothue = $('#masothue').val();
                var macskd = $('#cskd').val();
                var url = '/search_ke_khai_dich_vu_luu_tru/doanh_nghiep='+ masothue +'&co_so_kinh_doanh='+macskd+'&namhs='+namhs;
                window.location.href = url;
            });
        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Tìm kiếm thông tin kê khai giá<small>&nbsp;dịch vụ lưu trú</small>
    </h3>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <select name="namhs" id="namhs" class="form-control">
                    @if ($nam_start = intval(date('Y')) - 5 ) @endif
                    @if ($nam_stop = intval(date('Y'))) ) @endif
                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                        <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-5">
            <div class="form-group">
                <select class="form-control select2me" id="masothue" name="masothue">
                    <option value="all" selected>-- Nhập thông tin doanh nghiệp --</option>
                    @foreach($dn as $tt)
                        <option value="{{$tt->masothue}}" {{$tt->masothue == $masothue ? 'selected' : ''}}>{{$tt->tendn}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @if($masothue != 'all')
        <div class="col-md-5">
            <div class="form-group">
                <select class="form-control select2me" id="cskd" name="cskd">
                    <option value="all" selected>-- Nhập thông tin cơ sở kinh doanh --</option>
                    @foreach($cskd as $ks)
                        <option value="{{$ks->macskd}}" {{$ks->macskd == $macskd ? 'selected' : ''}}>{{$ks->tencskd}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        @endif
    </div>
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
                            <th style="text-align: center">Ngày kê khai</th>
                            <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                            <th style="text-align: center">Số công văn</th>
                            <th style="text-align: center">Số công văn liền kề</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td class="active">{{$tt->tencskd}}<br>Mã số thuế: {{$tt->masothue}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                <td style="text-align: center" class="active">{{$tt->socv}}</td>
                                <td style="text-align: center">{{$tt->socvlk}}</td>
                                <td>
                                    <a href="{{url('ke_khai_dich_vu_luu_tru/report_ke_khai/'.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
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
    <div class="clearfix"></div>
@stop