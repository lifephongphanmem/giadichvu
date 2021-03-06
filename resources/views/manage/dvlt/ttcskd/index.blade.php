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
        function getId(id){
            document.getElementById("iddelete").value=id;
        }

        function ClickDelete(){
            $('#frm_delete').submit();
        }
        function getStopId(id){
            document.getElementById("idstop").value=id;
        }
        function getStartId(id){
            document.getElementById("idstart").value=id;
        }

        function ClickStop(){
            $('#frm_stop').submit();
        }
        function ClickStart(){
            $('#frm_start').submit();
        }
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
                <div class="portlet-title">
                    <div class="actions">

                        @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                            @if(can('dvlt','create'))
                                <a href="{{url('ttcskd_dich_vu_luu_tru/masothue='.$masothue.'/create')}}" class="btn btn-default btn-sm">
                                    <i class="fa fa-plus"></i> Thêm mới </a>
                            @endif
                            <a href="{{url('ttcskd_dich_vu_luu_tru')}}" class="btn btn-default btn-sm">
                                <i class="fa fa-reply"></i> Quay lại</a>
                        @else
                            @if(can('dvlt','create'))
                                <a href="{{url('ttcskd_dich_vu_luu_tru/create')}}" class="btn btn-default btn-sm">
                                    <i class="fa fa-plus"></i> Thêm mới </a>
                            @endif
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <!--th style="text-align: center" width="10%">Ảnh đại diện</th-->
                            <th style="text-align: center">Tên cơ sở kinh doanh</th>
                            <th style="text-align: center">Loại hạng</th>
                            <th style="text-align: center">Số điện thoại</th>
                            <th style="text-align: center">Địa chỉ</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$key + 1}}</td>
                            <!--td align="center" style="vertical-align: middle">
                                <img src="{{ url('images/cskddvlt/'.$tt->toado)}}" width="80%">
                            </td-->
                            <td class="active" >{{$tt->tencskd}}<br>{{$tt->ghichu != '' ? '('.$tt->ghichu.')' : ''}}</td>
                            <td>@if($tt->loaihang == 'K' ) Khác(Nhà nghỉ)
                                @elseif ($tt->loaihang == 'CXD' ) Chưa xác định (Khách sạn chưa xác định sao)
                                @else
                                    {{$tt->loaihang.' sao'}}
                                @endif
                            </td>
                            <td>{{$tt->telkd}}</td>
                            <td>{{$tt->diachikd}}</td>
                            <td>
                                @if(can('dvlt','edit'))
                                <a href="{{url('ttcskd_dich_vu_luu_tru/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                @endif
                                @if($tt->toado != '')
                                    <a href="{{ url('images/cskddvlt/'.$tt->toado)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Giấy công nhận hạng cơ sở lưu trú</a>
                                @else
                                    <p>Doanh nghiệp chưa cập nhật giấy chứng nhận loại hạng</p>
                                @endif
                                @if(can('dvlt','delete'))
                                <!--button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                    Xóa</button-->
                                @endif
                                @if($tt->ghichu == 'Dừng hoạt động')
                                    @if(session('admin')->level == 'T' || session('admin')->level == 'H' || session('admin')->level == 'X')
                                        <button type="button" onclick="getStartId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#start-modal" data-toggle="modal"><i class="fa fa-play"></i>&nbsp;
                                            Hoạt động lại</button>
                                    @endif
                                @else
                                    <button type="button" onclick="getStopId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#stop-modal" data-toggle="modal"><i class="fa fa-stop"></i>&nbsp;
                                        Dừng hoạt động</button>
                                @endif
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
        <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'ttcskd_dich_vu_luu_tru/delete','id' => 'frm_delete'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý xóa?</h4>
                    </div>
                    <input type="hidden" name="iddelete" id="iddelete">
                    <div class="modal-footer">
                        <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="stop-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'ttcskd_dich_vu_luu_tru/stop','id' => 'frm_stop'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý dừng hoạt động của cơ sở kinh doanh?</h4>
                    </div>
                    <div class="modal-body">
                        <p style="color: #000066">Khi dừng hoạt động cơ sở kinh doanh sẽ không thể đăng ký giá của cơ sở kinh doanh này nữa! Thông tin liên hệ quản trị hệ thống!</p>
                    </div>
                    <input type="hidden" name="idstop" id="idstop">
                    <div class="modal-footer">
                        <button type="submit" class="btn blue" onclick="ClickStop()">Đồng ý</button>
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <div class="modal fade" id="start-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'ttcskd_dich_vu_luu_tru/start','id' => 'frm_start'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý kích hoạt lại hoạt động của cơ sở kinh doanh?</h4>
                    </div>
                    {{--<div class="modal-body">--}}
                    {{--</div>--}}
                    <input type="hidden" name="idstart" id="idstart">
                    <div class="modal-footer">
                        <button type="submit" class="btn blue" onclick="ClickStart()">Đồng ý</button>
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    @include('includes.e.modal-confirm')


@stop