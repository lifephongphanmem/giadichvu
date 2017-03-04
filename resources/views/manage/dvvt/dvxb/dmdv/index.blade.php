<?php
/**
 * Created by PhpStorm.
 * User: MyloveCoi
 * Date: 22/04/2016
 * Time: 2:59 PM
 */
        ?>
@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop

@section('custom-script')
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
        Vận tải hành khách bằng xe buýt<small> theo tuyến cố định</small>
    </h3>
    <input type="hidden" name="masothue" id="masothue" value="{{$masothue}}">
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if($per['create'])
                            <button type="button" id="_btnThemDV" class="btn btn-default btn-sm" onclick="addDVXK()" ><i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                        @endif
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                                <thead>
                                    <tr>
                                        <th style="text-align: center" width="2%">STT</th>
                                        <!--th style="text-align: center">Điểm xuất phát</th>
                                        <th style="text-align: center">Điểm đến</th-->
                                        <th style="text-align: center">Mô tả dịch vụ</th>
                                        <th style="text-align: center">Quy cách chất lượng</th>
                                        <th style="text-align: center">Đơn vị tính lượt</th>
                                        <th style="text-align: center">Đơn vị tính tháng</th>
                                        <th style="text-align: center">Ghi chú</th>
                                        <th style="text-align: center">Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody id="noidung">
                                    @foreach($model as $key=>$dv)
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <!--td name="diemdau">{{$dv->diemdau}}</td>
                                            <td name="diemcuoi">{{$dv->diemcuoi}}</td-->
                                            <td name="tendichvu" class="active">{{$dv->tendichvu}}</td>
                                            <td name="qccl">{{$dv->qccl}}</td>
                                            <td name="dvtluot" style="text-align: center">{{$dv->dvtluot}}</td>
                                            <td name="dvtthang" style="text-align: center"> {{$dv->dvtthang}}</td>
                                            <td name="ghichu">{{$dv->ghichu}}</td>
                                            <td>
                                                @if($per['edit'])
                                                    <button type="button" class="btn btn-default btn-xs mbs" onclick="editDVXK({{$dv->id}})"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>
                                                @endif
                                                @if($per['delete'])
                                                    <button type="button" onclick="confirmDel('{{$dv->id}}')" class="btn btn-default btn-xs mbs" data-target="#del-modal-confirm" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                                    Xóa</button>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!--Modal thông tin dịch vụ vận tải xe buýt-->

    <div class="modal fade bs-modal-lg" id="dvxk-modal-confirm" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin dịch vụ vận tải xe buýt</h4>
                </div>
                <div class="modal-body">
                    @include('manage.dvvt.template.dmdvxb')
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" id="submit" name="submit" value="submit" class="btn btn-primary" onclick="confirmDVXK()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>

        function confirmDVXK(){
            var valid=true;
            var message='';
            //var diemdau= $('#diemdau').val();
            //var diemcuoi= $('#diemcuoi').val();
            var tendichvu= $('#tendichvu').val();
            var dvtluot= $('#dvtluot').val();
            var dvtthang= $('#dvtthang').val();


            if(tendichvu==''){
                valid=false;
                message +='Tên dịch vụ không được bỏ trống \n';
            }

            if(dvtluot==''){
                valid=false;
                message +='Đơn vị tính vé lượt không được bỏ trống \n';
            }

            if(dvtthang==''){
                valid=false;
                message +='Đơn vị tính vé tháng không được bỏ trống \n';
            }

            //return false;
            if(valid){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '{{$url}}'+'danh_muc/add',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        tendichvu: tendichvu,
                        qccl: $('#qccl').val(),
                        masothue: $('#masothue').val(),
                        dvtluot: dvtluot,
                        dvtthang: dvtthang,
                        ghichu: $('#ghichu').val(),
                        id: $('#iddv').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if (data.status == 'success') {
                            location.reload();
                        }
                    },
                    error: function(message){
                        alert(message);
                    }
                });
                $('#dvxk-modal-confirm').modal('hide');
            }else{
                alert(message);
            }
            return valid;
        }

        function editDVXK(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'danh_muc/get',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#tendichvu').val(data.tendichvu);
                    $('#qccl').val(data.qccl);
                    $('#dvtluot').val(data.dvtluot);
                    $('#dvtthang').val(data.dvtthang);
                    $('#ghichu').val(data.ghichu);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
            $('#iddv').attr('value',id);
            $('#dvxk-modal-confirm').modal('show');
        }

        function addDVXK(){
            $('#iddv').attr('value',0);
            //$('#diemdau').attr('value','');
            //$('#diemcuoi').attr('value','');
            $('#tendichvu').attr('value','');
            $('#qccl').attr('value','');
            $('#dvtluot').attr('value','');
            $('#dvtthang').attr('value','');
            $('#ghichu').attr('value','');
            $('#dvxk-modal-confirm').modal('show');
        }
    </script>
    @include('manage.dvvt.template.modal-delete-dm')
@stop


