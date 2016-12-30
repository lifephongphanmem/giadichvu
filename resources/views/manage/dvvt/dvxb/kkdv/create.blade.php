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
@stop

@section('content-dv')
    <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>
    <div class="row" id="noidung">
        <div class="col-md-12">
            <table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                <thead>
                    <tr>
                        <th style="text-align: center;width: 2%">STT</th>
                        <th style="text-align: center">Mô tả dịch vụ</th>
                        <th style="text-align: center">Quy cách</br>chất lượng</th>
                        <th style="text-align: center">Mức giá</br>vé lượt</br>liền kề</th>
                        <th style="text-align: center">Mức giá</br>vé lượt</br>kê khai</th>
                        <th style="text-align: center">Mức giá</br>vé tháng</br>liền kề</th>
                        <th style="text-align: center">Mức giá</br>vé tháng</br>kê khai</th>
                        <th style="text-align: center;width: 20%">Thao tác</th>
                    </tr>
                </thead>
                <tbody >
                <?php $i=1?>
                @foreach($model as $dv)
                    <tr>
                        <td style="text-align: center;">{{$i++}}</td>
                        <td name="tendichvu" class="active">{{$dv->tendichvu}}</td>
                        <td name="qccl">{{$dv->qccl}}</td>
                        <td name="giakklkluot" style="text-align: right">{{number_format($dv->giakklkluot)}}</td>
                        <td name="giakkluot" style="text-align: right">{{number_format($dv->giakkluot)}}</td>
                        <td name="giakklkthang" style="text-align: right">{{number_format($dv->giakklkthang)}}</td>
                        <td name="giakkthang" style="text-align: right">{{number_format($dv->giakkthang)}}</td>
                        <td>
                            <button type="button" data-target="#modal-create"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="editItem(this,'{{$dv->id}}')"><i
                                        class="fa fa-edit"></i>&nbsp;Kê khai giá
                            </button>
                            <button type="button" data-target="#modal-pagia-create"
                                    data-toggle="modal" class="btn btn-default btn-xs mbs"
                                    onclick="getpag_temp('{{$dv->madichvu}}')"><i class="fa fa-edit"></i>&nbsp;Phương án giá
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
        Kê khai giá vận tải hành khách bằng xe buýttheo tuyến cố định<small> thêm mới</small>
    </h3>
    <div class="row">
        {!! Form::open(['url'=>$url.'ke_khai/store', 'id' => 'create-kkdvxb','class'=>'horizontal-form form-validate','method'=>'patch']) !!}
        <div class="col-md-12">
            <div class="portlet box blue">
                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    @include('manage.dvvt.template.createkkdv')
                </div>
            </div>
            <div style="text-align: center">
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <a href="{{url('dich_vu_van_tai/dich_vu_xe_bus/ke_khai/nam='.date('Y'))}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

    <!--Validate Form-->
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create-kkdvxb").validate({
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

    <!--Modal Wide Width-->
    <div id="modal-create" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header modal-header-primary">
                    <button type="button" data-dismiss="modal" aria-hidden="true" class="close">&times;</button>
                    <h4 id="modal-header-primary-label" class="modal-title">Kê khai giá dịch vụ</h4>
                </div>
                <div class="modal-body" id="ttgiaph">
                        <div class="form-group">
                            <label class="form-control-label"><b>Mức giá vé lượt kê khai liền kề</b><span class="require">*</span></label>
                            <input type="text" style="text-align: right" id="giakklkluot" name="giakklkluot" class="form-control" data-mask="fdecimal">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"><b>Mức giá vé lượt kê khai</b><span class="require">*</span></label>
                            <input type="text" style="text-align: right" id="giakkluot" name="giakkluot" class="form-control" data-mask="fdecimal">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"><b>Mức giá vé tháng kê khai liền kề</b><span class="require">*</span></label>
                            <input type="text" style="text-align: right" id="giakklkthang" name="giakklkthang" class="form-control" data-mask="fdecimal">
                        </div>
                        <div class="form-group">
                            <label class="form-control-label"><b>Mức giá vé tháng kê khai</b><span class="require">*</span></label>
                            <input type="text" style="text-align: right" id="giakkthang" name="giakkthang" class="form-control" data-mask="fdecimal">
                        </div>
                        <input type="hidden" id="iddv" name="iddv"/>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                    <button type="submit" data-dismiss="modal" class="btn btn-primary" onclick="updategia()">Đồng ý</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        function editItem(e, id){
            var tr=$(e).closest('tr');
            $('#giakklkluot').attr('value',tr.find('td[name=giakklkluot]').text());
            $('#giakkluot').attr('value',tr.find('td[name=giakkluot]').text());
            $('#giakklkthang').attr('value',tr.find('td[name=giakklkthang]').text());
            $('#giakkthang').attr('value',tr.find('td[name=giakkthang]').text());
            $('#iddv').attr('value',id);
        }

        function updategia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'thao_tac/updategiadv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    giakklkluot: $('#giakklkluot').val(),
                    giakkluot: $('#giakkluot').val(),
                    giakklkthang: $('#giakklkthang').val(),
                    giakkthang: $('#giakkthang').val(),
                    id: $('#iddv').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    //alert(data.message);
                    if (data.status == 'success') {
                        $('#noidung').replaceWith(data.message);
                        InputMask();
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                    }
                },
                error: function(message){
                    alert(message);
                }
            });
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

