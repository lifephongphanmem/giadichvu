<?php
/**
 * Created by PhpStorm.
 * User: MyloveCoi
 * Date: 18/04/2016
 * Time: 10:45 AM
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
    <!--Date new-->
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>
    <!--End date new-->
@stop

@section('content-dv')
    <div class="row" id="noidung">
        <div class="col-md-12">
            <table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                <thead>
                <tr>
                    <th style="text-align: center" width="2%">STT</th>
                    <th style="text-align: center">Loại xe</th>
                    <th style="text-align: center">Mô tả dịch vụ</th>
                    <th style="text-align: center">Giá liền kề</th>
                    <th style="text-align: center">Giá kê khai</th>
                    <th style="text-align: center">Giá hành lý</br>vượt quy định</th>
                    <th style="text-align: center" width="20%">Thao tác</th>
                </tr>
                </thead>
                <tbody >
                @foreach($model as $key=>$dv)
                    <tr>
                        <td style="text-align: center">{{$key + 1}}</td>
                        <td name="loaixe">{{$dv->loaixe}}</td>
                        <td name="tendichvu" class="active">{{$dv->tendichvu}}</td>
                        <td name="giakklk" style="text-align: right">{{number_format($dv->giakklk)}}</td>
                        <td name="giakk" style="text-align: right">{{number_format($dv->giakk)}}</td>
                        <td name="giahl" style="text-align: right">{{number_format($dv->giahl)}}</td>
                        <td>
                            <button type="button" data-target="#modal-create"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="get_kkgia({{$dv->id}})"><i class="fa fa-edit"></i>&nbsp;Kê khai giá
                            </button>

                            <button type="button" data-target="#modal-pagia-create"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="editpagia('{{$dv->madichvu}}')"><i class="fa fa-edit"></i>&nbsp;Phương án giá
                            </button>

                            <button type="button" data-target="#modal-dichvu"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="get_dichvu({{$dv->id}})"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin
                            </button>

                            <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$dv->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('content')
    <h3 class="page-title">
        Kê khai giá vận tải hành khách bằng xe ôtô theo tuyến cố định<small> thêm mới</small>
    </h3>
    <div class="row">
        {!! Form::open(['url'=>$url.'ke_khai/store', 'id' => 'create-kkdvxk','class'=>'horizontal-form form-validate','method'=>'patch']) !!}
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    @include('manage.dvvt.template.createkkdv')
                    <input type="hidden" name="masothue" id="masothue" value="{{$masothue}}">
                    <input type="hidden" name="cqcq" id="cqcq" value="{{$cqcq}}">
                </div>
            </div>
            <div style="text-align: center">
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <a href="{{url('dich_vu_van_tai/dich_vu_xe_khach/ke_khai/nam='.date('Y'))}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!--Validate Form-->
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create-kkdvxk").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>

    @include('includes.script.create-header-scripts')
    @include('manage.dvvt.template.phuongangia_temp')

    <!--Modal Wide Width-->
    <div class="modal fade bs-modal-lg" id="modal-dichvu" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin dịch vụ vận tải</h4>
                </div>
                <div class="modal-body">
                    @include('manage.dvvt.template.dmdvxk')
                    <input type="hidden" id="iddv" name="iddv"/>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="update_dichvu()">Cập nhật</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Model them moi-->
    <div class="modal fade bs-modal" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin dịch vụ vận tải</h4>
                </div>
                <div class="modal-body" id="ttpthemmoi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Mức giá kê khai liền kề</b><span class="require">*</span></label>
                                <input type="text" style="text-align: right" id="giakklk" name="giakklk" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Mức giá kê khai</b><span class="require">*</span></label>
                                <input type="text" style="text-align: right" id="giakk" name="giakk" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Mức giá hành lý</b><span class="require">*</span></label>
                                <input type="text" style="text-align: right" id="giahl" name="giahl" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="idkk" name="idkk"/>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="kkgia()">Bổ xung</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Modal Wide Width-->
    <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin dịch vụ vận tải?</h4>
                </div>
                <input type="hidden" id="id_del" name="id_del">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="deleteRow()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <script>
        function get_kkgia(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/get_giadv_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#giakklk').val(data.giakklk);
                    $('#giahl').val(data.giahl);
                    $('#giakk').val(data.giakk);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
            $('#idkk').attr('value',id);
        }

        function kkgia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/kkgia_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masothue: $('#masothue').val(),
                    giakklk: $('#giakklk').val(),
                    giakk: $('#giakk').val(),
                    giahl:$('#giahl').val(),
                    id: $('#idkk').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#noidung').replaceWith(data.message);
                        InputMask();
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                    }
                },
                error: function(message){
                    toastr.error(message);
                }
            });
            $('#modal-create').modal('hide');
        }

        function get_dichvu(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/get_giadv_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#loaixe').val(data.loaixe);
                    $('#tendichvu').val(data.tendichvu);
                    $('#qccl').val(data.qccl);
                    $('#dvt').val(data.dvt);
                    $('#ghichu').val(data.ghichu);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
            $('#iddv').attr('value',id);
        }

        function update_dichvu(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/update_giadv_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masothue: $('#masothue').val(),
                    loaixe: $('#loaixe').val(),
                    tendichvu: $('#tendichvu').val(),
                    qccl: $('#qccl').val(),
                    dvt: $('#dvt').val(),
                    ghichu: $('#ghichu').val(),
                    id: $('#iddv').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#noidung').replaceWith(data.message);
                        InputMask();
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                    }
                },
                error: function(message){
                    toastr.error(message);
                }
            });
            $('#modal-dichvu').modal('hide');
        }

        function clearForm(){
            $('#loaixe').val('');
            $('#tendichvu').val('');
            $('#qccl').val('');
            $('#dvt').val('');
            $('#ghichu').val('');
            $('#iddv').val(0);
        }

        function deleteRow(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/del_giadv_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masothue: $('#masothue').val(),
                    id: $('#id_del').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#noidung').replaceWith(data.message);
                        InputMask();
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                    }
                },
                error: function(message){
                    toastr.error(message,'Lỗi!');
                }
            });
            $('#modal-delete').modal('hide');
        }

        function getid(id){
            document.getElementById("id_del").value=id;
        }
        // <editor-fold defaultstate="collapsed" desc="--InPutMask--">
        function InputMask() {
            //$(function(){
            // Input Mask
            if ($.isFunction($.fn.inputmask)) {
                $("[data-mask]").each(function (i, el) {
                    var $this = $(el),
                            mask = $this.data('mask').toString(),
                            opts = {
                                numericInput: attrDefault($this, 'numeric', false),
                                radixPoint: attrDefault($this, 'radixPoint', ''),
                                rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
                            },
                            placeholder = attrDefault($this, 'placeholder', ''),
                            is_regex = attrDefault($this, 'isRegex', '');


                    if (placeholder.length) {
                        opts[placeholder] = placeholder;
                    }

                    switch (mask.toLowerCase()) {
                        case "phone":
                            mask = "(999) 999-9999";
                            break;

                        case "currency":
                        case "rcurrency":

                            var sign = attrDefault($this, 'sign', '$');
                            ;

                            mask = "999,999,999.99";

                            if ($this.data('mask').toLowerCase() == 'rcurrency') {
                                mask += ' ' + sign;
                            }
                            else {
                                mask = sign + ' ' + mask;
                            }

                            opts.numericInput = true;
                            opts.rightAlignNumerics = false;
                            opts.radixPoint = '.';
                            break;

                        case "email":
                            mask = 'Regex';
                            opts.regex = "[a-zA-Z0-9._%-]+@[a-zA-Z0-9-]+\\.[a-zA-Z]{2,4}";
                            break;

                        case "fdecimal":
                            mask = 'decimal';
                            $.extend(opts, {
                                autoGroup: true,
                                groupSize: 3,
                                radixPoint: attrDefault($this, 'rad', '.'),
                                groupSeparator: attrDefault($this, 'dec', ',')
                            });
                    }

                    if (is_regex) {
                        opts.regex = mask;
                        mask = 'Regex';
                    }

                    $this.inputmask(mask, opts);
                });
            }
            //});
        }
        // </editor-fold>
    </script>
@stop

