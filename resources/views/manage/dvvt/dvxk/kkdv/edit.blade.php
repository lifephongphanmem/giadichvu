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
    <script src="{{url('assets/admin/pages/scripts/table-managed-m.js')}}"></script>
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
            TableManaged_m.init();
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
    <script>
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
                    <th style="text-align: center">Ghi chú</th>
                    <th style="text-align: center" width="25%">Thao tác</th>
                </tr>
                </thead>
                <tbody >
                @foreach($modeldv as $key=>$dv)
                    <tr>
                        <td style="text-align: center">{{$key+1}}</td>
                        <td name="loaixe">{{$dv->loaixe}}</td>
                        <td name="tendichvu" class="active">{{$dv->tendichvu}}</td>
                        <td name="giakklk" style="text-align: right">{{number_format($dv->giakklk)}}</td>
                        <td name="giakk" style="text-align: right">{{number_format($dv->giakk)}}</td>
                        <td style="text-align: right">{!! nl2br(e($dv->ghichu)) !!}</td>
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
                                    onclick="get_dichvu({{$dv->id}})"><i class="fa fa-edit"></i>&nbsp;Sửa thông tin
                            </button>

                            <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="getid({{$dv->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <h4 class="form-section" style="color: #0000ff">Thông tin giá hàng lý vượt quy định</h4>
        </div>
    </div>

    <div class="row" id="kkgiahl">
        <div class="col-md-12">
            <table id="sample_4" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                <thead>
                <tr>
                    <th style="text-align: center" width="2%">STT</th>
                    <th style="text-align: center">Mô tả dịch vụ</th>
                    <th style="text-align: center">Giá liền kề</th>
                    <th style="text-align: center">Giá kê khai</th>
                    <th style="text-align: center" width="25%">Thao tác</th>
                </tr>
                </thead>
                <tbody >
                @foreach($model_hl as $key=>$dv)
                    <tr>
                        <td style="text-align: center">{{$key + 1}}</td>
                        <td name="tendichvu" class="active">{{$dv->tendichvu}}</td>
                        <td style="text-align: right">{{number_format($dv->giahllk)}}</td>
                        <td style="text-align: right">{{number_format($dv->giahl)}}</td>
                        <td>
                            <button type="button" data-target="#modal-create-hl"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="get_giahl({{$dv->id}})"><i class="fa fa-edit"></i>&nbsp;Kê khai giá
                            </button>

                            <button type="button" data-target="#modal-delete-hl"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="get_giahl_id({{$dv->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa
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
        Kê khai giá vận tải hành khách bằng xe ôtô theo tuyến cố định<small> chỉnh sửa</small>
    </h3>
    <div class="row">
        {!! Form::open(['url'=>$url.'ke_khai/update/'.$model->id, 'id' => 'create-kkdvxk','class'=>'horizontal-form form-validate','method'=>'patch']) !!}
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-body pan">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    @include('manage.dvvt.template.editkkdv')
                    <input type="hidden" name="masothue" id="masothue" value="{{$model->masothue}}"/>
                    <input type="hidden" id="masokk" name="masokk" value="{{$model->masokk}}"/>
                </div>
            </div>
            <div style="text-align: center">
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <a href="{{url('dich_vu_van_tai/dich_vu_xe_khach/ke_khai/nam='.date('Y'))}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    @include('includes.script.create-header-scripts')

    <!--Modal Wide Width-->
    <div class="modal fade bs-modal-lg" id="modal-dichvu" tabindex="-1" aria-labelledby="myModalLabel" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin dịch vụ vận tải</h4>
                </div>
                <div class="modal-body">
                    <!--div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label"><b>Điểm xuất phát</b><span class="require">*</span></label>
            {!!Form::text('diemdau', null, array('id' => 'diemdau','class' => 'form-control','required'=>'required'))!!}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label class="form-control-label"><b>Điểm cuối</b><span class="require">*</span></label>
            {!!Form::text('diemcuoi', null, array('id' => 'diemcuoi','class' => 'form-control','required'=>'required'))!!}
        </div>
    </div>
</div-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><b>Loại xe</b><span class="require">*</span></label>
                                {!! Form::select('loaixe',[
                                'Xe 4 chỗ' => 'Xe 4 chỗ',
                                'Xe 7 chỗ' => 'Xe 7 chỗ',
                                'Xe 16 chỗ' => 'Xe 16 chỗ',
                                'Xe 29 chỗ' => 'Xe 29 chỗ',
                                'Xe 45 chỗ' => 'Xe 45 chỗ',
                                'Loại xe khác' => 'Loại xe khác'
                                ],null, ['id' => 'loaixe','class' => 'form-control','required'=>'required']) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><b>Mô tả dịch vụ</b><span class="require">*</span></label>
                                {!!Form::text('tendichvu', null, array('id' => 'tendichvu','class' => 'form-control','required'=>'required'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Quy cách chất lượng dịch vụ</b></label>
                                {!!Form::textarea('qccl', null, array('id' => 'qccl','class' => 'form-control','rows'=>'3'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><b>Số km</b></label>
                                {!!Form::text('sokm', null, array('id' => 'sokm','class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-control-label"><b>Đơn vị tính</b><span class="require">*</span></label>
                                {!!Form::text('dvt', null, array('id' => 'dvt','class' => 'form-control','required'=>'required'))!!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Ghi chú</b></label>
                                {!!Form::textarea('ghichudv', null, array('id' => 'ghichudv','class' => 'form-control','rows'=>'2'))!!}
                            </div>
                        </div>
                    </div>
                    <input type="hidden" id="madichvu" name="madichvu"/>
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

    <!--Modal Wide Width-->
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

    <!--Model them moi-->
    <div class="modal fade bs-modal" id="modal-create-hl" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thông tin giá hành lý</h4>
                </div>
                <div class="modal-body" id="ttpthemmoi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Mức giá kê khai liền kề</b><span class="require">*</span></label>
                                <input type="text" style="text-align: right" id="giahllk" name="giahllk" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="form-control-label"><b>Mức giá kê khai</b><span class="require">*</span></label>
                                <input type="text" style="text-align: right" id="giahl" name="giahl" class="form-control" data-mask="fdecimal">
                            </div>
                        </div>
                    </div>

                    <input type="hidden" id="idhl" name="idhl"/>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="kkgiahl()">Bổ xung</button>
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

    <!--Modal Wide Width-->
    <div class="modal fade" id="modal-delete-hl" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin giá hàng lý?</h4>
                </div>
                <input type="hidden" id="id_del_hl" name="id_del_hl">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="deleteRow_hl()">Đồng ý</button>
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
                url: '{{$url}}'+'thao_tac/get_giadv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#giakklk').val(data.giakklk);
                    $('#giakk').val(data.giakk);
                    $('#giahl').val(data.giahl);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
            $('#iddv').attr('value',id);
        }

        function kkgia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/kkgia',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masokk:$('#masokk').val(),
                    masothue:$('#masothue').val(),
                    giakklk:$('#giakklk').val(),
                    giahl:$('#giahl').val(),
                    giakk:$('#giakk').val(),
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
            $('#modal-create').modal('hide');
        }

        function get_dichvu(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/get_giadv',
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
                    $('#ghichudv').val(data.ghichu);
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
                url: '{{$url}}'+'thao_tac/update_giadv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masokk:$('#masokk').val(),
                    masothue:$('#masothue').val(),
                    loaixe:$('#loaixe').val(),
                    tendichvu:$('#tendichvu').val(),
                    qccl: $('#qccl').val(),
                    dvt: $('#dvt').val(),
                    ghichu: $('#ghichudv').val(),
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
                url: '{{$url}}'+'thao_tac/del_giadv',
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

        function get_giahl(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/get_giahl',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#giahllk').val(data.giahllk);
                    $('#giahl').val(data.giahl);
                },
                error: function (message) {
                    toastr.error(message, 'Lỗi!');
                }
            });
            $('#idhl').attr('value',id);
        }

        function kkgiahl(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/update_giahl',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masothue: $('#masothue').val(),
                    masokk:$('#masokk').val(),
                    giahllk: $('#giahllk').val(),
                    giahl:$('#giahl').val(),
                    id: $('#idhl').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#kkgiahl').replaceWith(data.message);
                        InputMask();
                        jQuery(document).ready(function() {
                            TableManaged_m.init();
                        });
                    }
                },
                error: function(message){
                    toastr.error(message);
                }
            });
            $('#modal-create-hl').modal('hide');
        }

        function deleteRow_hl(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/del_giahl_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    masothue: $('#masothue').val(),
                    id: $('#id_del_hl').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#kkgiahl').replaceWith(data.message);
                        InputMask();
                        jQuery(document).ready(function() {
                            TableManaged_m.init();
                        });
                    }
                },
                error: function(message){
                    toastr.error(message,'Lỗi!');
                }
            });
            $('#modal-delete-hl').modal('hide');
        }

        function get_giahl_id(id){
            document.getElementById("id_del_hl").value=id;
        }
    </script>

    <!--Modal phương án giá-->
    @include('manage.dvvt.dvxk.templates.phuongangia')

    <!--Script phương án giá-->
    <script>
        function update_pagia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/updatepag',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    sanluong:$('#sanluong').val(),
                    cpnguyenlieutt:$('#cpnguyenlieutt').val(),
                    cpcongnhantt:$('#cpcongnhantt').val(),
                    cpkhauhaott:$('#cpkhauhaott').val(),
                    cpsanxuatdt:$('#cpsanxuatdt').val(),
                    cpsanxuatc:$('#cpsanxuatc').val(),
                    cptaichinh:$('#cptaichinh').val(),
                    cpbanhang:$('#cpbanhang').val(),
                    cpquanly:$('#cpquanly').val(),
                    loinhuan:$('#loinhuan').val(),
                    giaitrinh:$('#giaitrinh').val(),
                    id: $('#idpag').val()
                },
                dataType: 'JSON',
                success: function () {},
                error: function(message){
                    alert(message);
                }
            });
        }

        function editpagia(madichvu){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: '{{$url}}'+'thao_tac/getpag',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    madichvu: madichvu,
                    masokk: $('#masokk').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#sanluong').val(data.sanluong);
                    $('#cpnguyenlieutt').val(data.cpnguyenlieutt);
                    $('#cpcongnhantt').val(data.cpcongnhantt);
                    $('#cpkhauhaott').val(data.cpkhauhaott);
                    $('#cpsanxuatdt').val(data.cpsanxuatdt);
                    $('#cpsanxuatc').val(data.cpsanxuatc);
                    $('#cptaichinh').val(data.cptaichinh);
                    $('#cpbanhang').val(data.cpbanhang);
                    $('#cpquanly').val(data.cpquanly);
                    $('#giaitrinh').val(data.giaitrinh);
                    $('#loinhuan').val(data.loinhuan);
                    $('#idpag').val(data.id);
                    //$('#header_pag').innerHTML = "Nội dung" + data.loinhuan; khoog chạy
                    document.getElementById("header_pag").innerHTML = "Kê khai phương án giá: " + data.tuyenduong;
                    InputMask();
                    tongchiphi();
                    thuevat()
                },
                error: function(message){
                    alert(message);
                }
            });
        }
    </script>
@stop
