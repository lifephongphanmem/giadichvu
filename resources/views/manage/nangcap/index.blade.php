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
        function InputMask(){
            //$(function(){
            // Input Mask
            if($.isFunction($.fn.inputmask))
            {
                $("[data-mask]").each(function(i, el)
                {
                    var $this = $(el),
                            mask = $this.data('mask').toString(),
                            opts = {
                                numericInput: attrDefault($this, 'numeric', false),
                                radixPoint: attrDefault($this, 'radixPoint', ''),
                                rightAlignNumerics: attrDefault($this, 'numericAlign', 'left') == 'right'
                            },
                            placeholder = attrDefault($this, 'placeholder', ''),
                            is_regex = attrDefault($this, 'isRegex', '');


                    if(placeholder.length)
                    {
                        opts[placeholder] = placeholder;
                    }

                    switch(mask.toLowerCase())
                    {
                        case "phone":
                            mask = "(999) 999-9999";
                            break;

                        case "currency":
                        case "rcurrency":

                            var sign = attrDefault($this, 'sign', '$');;

                            mask = "999,999,999.99";

                            if($this.data('mask').toLowerCase() == 'rcurrency')
                            {
                                mask += ' ' + sign;
                            }
                            else
                            {
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
                                autoGroup		: true,
                                groupSize		: 3,
                                radixPoint		: attrDefault($this, 'rad', '.'),
                                groupSeparator	: attrDefault($this, 'dec', ',')
                            });
                    }

                    if(is_regex)
                    {
                        opts.regex = mask;
                        mask = 'Regex';
                    }

                    $this.inputmask(mask, opts);
                });
            }
            //});
        }
        $(function(){

            $('#phanloai').change(function() {
                var phanloai = $('#phanloai').val();
                var url = '/nangcap?&phanloai='+phanloai;

                window.location.href = url;
            });
            $('#nam').change(function() {
                var phanloai = $('#phanloai').val();
                var namhs = $('#nam').val();
                var thang = $('#thang').val();
                var url = '/nangcap?&phanloai='+phanloai+'&thang='+thang+'&nam='+namhs;

                window.location.href = url;
            });
            $('#thang').change(function() {
                var phanloai = $('#phanloai').val();
                var namhs = $('#nam').val();
                var thang = $('#thang').val();
                var url = '/nangcap?&phanloai='+phanloai+'&thang='+thang+'&nam='+namhs;

                window.location.href = url;
            });

        });
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai giá<small>&nbsp;dịch vụ lưu trú</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('nangcapdl?&phanloai='.$phanloai.'&thang='.$thang.'&nam='.$nam)}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Update DL</a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="phanloai" id="phanloai" class="form-control">
                                    <option value="CHS" {{$phanloai == 'CHS' ? 'selected' : ''}}>Chuyển hồ sơ</option>
                                    <option value="TLHS" {{$phanloai == 'TLHS' ? 'selected' : ''}}>Trả lại hồ sơ</option>
                                    <option value="NHS" {{$phanloai == 'NHS' ? 'selected' : ''}}>Nhận hồ sơ</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="thang" id="thang" class="form-control">
                                    <option value="01" {{$thang == '01' ? 'selected' : ''}}>Tháng 01</option>
                                    <option value="02" {{$thang == '02' ? 'selected' : ''}}>Tháng 02</option>
                                    <option value="03" {{$thang == '03' ? 'selected' : ''}}>Tháng 03</option>
                                    <option value="04" {{$thang == '04' ? 'selected' : ''}}>Tháng 04</option>
                                    <option value="05" {{$thang == '05' ? 'selected' : ''}}>Tháng 05</option>
                                    <option value="06" {{$thang == '06' ? 'selected' : ''}}>Tháng 06</option>
                                    <option value="07" {{$thang == '07' ? 'selected' : ''}}>Tháng 07</option>
                                    <option value="08" {{$thang == '08' ? 'selected' : ''}}>Tháng 08</option>
                                    <option value="09" {{$thang == '09' ? 'selected' : ''}}>Tháng 09</option>
                                    <option value="10" {{$thang == '10' ? 'selected' : ''}}>Tháng 10</option>
                                    <option value="11" {{$thang == '11' ? 'selected' : ''}}>Tháng 11</option>
                                    <option value="12" {{$thang == '12' ? 'selected' : ''}}>Tháng 12</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <select name="nam" id="nam" class="form-control">
                                    @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                    @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                                        <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center ; margin: auto" width="2%">STT</th>
                            <th style="text-align: center">Tên dn</th>
                            <th style="text-align: center">Tên cskd</th>
                            <th style="text-align: center">Loai hạng</th>
                            <th style="text-align: center">Ngày<br> kê khai</th>
                            <th style="text-align: center">Ngày thực hiện<br>mức giá</th>
                            <th style="text-align: center" width="8%">Số công văn</th>
                            <th style="text-align: center" width="15%">Người chuyển</th>
                            <th style="text-align: center" width="15%">Username</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td class="active">{{$tt->tendn}}</td>
                                <td>{{$tt->tencskd}}</td>
                                <td>
                                    @if($tt->loaihang == 'K' ) Khác(Nhà nghỉ)
                                    @elseif ($tt->loaihang == 'CXD' ) Chưa xác định (Khách sạn chưa xác định sao)
                                    @else
                                        {{$tt->loaihang.' sao'}}
                                    @endif
                                    <br>Mã kê khai: {{$tt->mahs}}
                                <br>Mã số thuế: {{$tt->masothue}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                <td style="text-align: center" class="danger">{{$tt->socv}}</td>
                                <td style="text-align: center">{{$tt->ttnguoinop}}</td>
                                <td style="text-align: center">{{$tt->name.'('.$tt->username.')'}}</td>

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
    <!--Model chuyển-->
        <div class="modal fade" id="tralai-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'xet_duyet_ke_khai_dich_vu_luu_tru/tralai','id' => 'frm_tralai'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý trả lại hồ sơ?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="tttralai">
                            </div>
                        <div class="form-group">
                            <label><b>Lý do trả lại</b></label>
                            <textarea id="lydo" class="form-control" name="lydo" cols="30" rows="8"></textarea></div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickTraLai()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    <!--Model nhận hs-->
    <div class="modal fade" id="nhanhs-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'xet_duyet_ke_khai_dich_vu_luu_tru/nhanhs','id' => 'frm_nhanhs'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý nhận hồ sơ?</h4>
                </div>
                <div class="modal-body" id="ttnhanhs">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ClickNhanHs()">Đồng ý</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Model nhận hs edit-->
    <div class="modal fade" id="nhanhsedit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'xet_duyet_ke_khai_dich_vu_luu_tru/nhanhsedit','id' => 'frm_nhanhsedit'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa thông tin nhận hồ sơ?</h4>
                </div>
                <div class="modal-body" id="ttnhanhsedit">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ClickNhanHsedit()">Đồng ý</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Model huỷ duyệt-->
    <div class="modal fade" id="huyduyet-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'xet_duyet_ke_khai_dich_vu_luu_tru/huyduyet','id' => 'frm_huyduyet'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý huỷ duyệt hồ sơ?</h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label style="color: blue"><b>Hồ sơ sẽ chuyển về trạng thái chờ xét duyệt, hồ sơ lưu bên trang công bố sẽ bị xoá bỏ. Đồng thời trong lịch sử hồ sơ sẽ lưu lại vết hồ sơ bị huỷ duyệt</b></label>
                    </div>
                    <div class="form-group" id="tthuyduyet">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickHuyDuyet()">Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>

    @include('includes.script.create-header-scripts')
@stop