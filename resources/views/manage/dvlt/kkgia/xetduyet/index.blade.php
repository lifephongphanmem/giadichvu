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

            /*$('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var thanghs = $('#thanghs').val();
                var pl = $('#pl').val();
                var url = '/xet_duyet_ke_khai_dich_vu_luu_tru/thang='+thanghs+'&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });
            $('#thanghs').change(function() {
                var namhs = $('#namhs').val();
                var thanghs = $('#thanghs').val();
                var pl = $('#pl').val();
                var url = '/xet_duyet_ke_khai_dich_vu_luu_tru/thang='+thanghs+'&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });
            $('#pl').change(function() {
                var namhs = $('#namhs').val();
                var thanghs = $('#thanghs').val();
                var pl = $('#pl').val();
                var url = '/xet_duyet_ke_khai_dich_vu_luu_tru/thang='+thanghs+'&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });*/
            $('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var pl = $('#pl').val();
                var url = '/xet_duyet_ke_khai_dich_vu_luu_tru?&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });
            $('#pl').change(function() {
                var namhs = $('#namhs').val();
                var pl = $('#pl').val();
                var url = '/xet_duyet_ke_khai_dich_vu_luu_tru?&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });

        });
        function confirmTraLai(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/xdkkgiadvlt/tralai',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#tttralai').replaceWith(data.message);
                    }
                }
            })
        }
        function ClickTraLai(){
            if($('#lydo').val() != ''){
                toastr.success("Hồ sơ đã được trả lại!", "Thành công!");
                $("#frm_tralai").unbind('submit').submit();
            }else{
                toastr.error("Bạn cần nhập lý do trả lại hồ sơ", "Lỗi!!!");
                $("#frm_tralai").submit(function (e) {
                    e.preventDefault();
                });
            }

        }
        function confirmNhanHs(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/xdkkgiadvlt/nhanhs',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttnhanhs').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin nhận hồ sơ giá phòng nghỉ!", "Lỗi!");
                }
            })
        }
        function ClickNhanHs(){
            $('#frm_nhanhs').submit();
        }

        function confirmNhanHsedit(mahs){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(mahs);

            $.ajax({
                url: '/xdkkgiadvlt/nhanhsedit',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahs: mahs
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttnhanhsedit').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin nhận hồ sơ giá phòng nghỉ!", "Lỗi!");
                }
            })
        }

        function ClickNhanHsedit(){
            $('#frm_nhanhsedit').submit();
        }

        function confirmHuyduyet(mahs){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(mahs);

            $.ajax({
                url: '/xdkkgiadvlt/tthuyduyet',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    mahs: mahs
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#tthuyduyet').replaceWith(data.message);
                    }
                }
            })
        }
        function ClickHuyDuyet(){
            $('#frm_huyduyet').submit();
        }

    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai giá<small>&nbsp;dịch vụ lưu trú</small>
    </h3>
    <div class="row">
        <div class="col-md-2">
            <div class="form-group">
                <select name="namhs" id="namhs" class="form-control">
                    @if ($nam_start = intval(date('Y')) - 5 ) @endif
                    @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                    @for($i = $nam_start; $i <= $nam_stop; $i++)
                        <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                    @endfor
                </select>
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                <select name="pl" id="pl" class="form-control">
                    <option value="cho_nhan" {{$pl == 'cho_nhan' ? 'selected' : ''}}>Hồ sơ kê khai giá dịch vụ đang chờ nhận</option>
                    <option value="duyet" {{$pl == 'duyet' ? 'selected' : ''}}>Hồ sơ kê khai giá dịch vụ đã duyệt</option>
                    <option value="cong_bo" {{$pl == 'cong_bo' ? 'selected' : ''}}>Hồ sơ kê khai giá dịch vụ đã công bố</option>
                    <option value="bi_tra_lai" {{$pl == 'bi_tra_lai' ? 'selected' : ''}}>Hồ sơ kê khai giá dịch vụ bị trả lại</option>
                </select>
            </div>
        </div>

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
                            <th style="text-align: center ; margin: auto" width="2%">STT</th>
                            <th style="text-align: center" width="20%">Cơ sở kinh doanh</th>
                            <th style="text-align: center" width="8%">Ngày<br> kê khai</th>
                            <th style="text-align: center" width="8%">Ngày thực hiện<br>mức giá</th>
                            <th style="text-align: center" width="8%">Số công văn</th>
                            <th style="text-align: center" width="15%">Người chuyển</th>
                            <th style="text-align: center" width="15%">Trạng thái</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td class="active">{{$tt->tencskd}}<br>
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
                                @if($tt->trangthai == "Chờ chuyển")
                                <td align="center"><span class="badge badge-warning">{{$tt->trangthai}}</span></td>
                                @elseif($tt->trangthai == 'Chờ duyệt')
                                    <td align="center"><span class="badge badge-warning">{{$tt->trangthai}}</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @elseif($tt->trangthai == 'Chờ nhận')
                                    <td align="center"><span class="badge badge-warning">{{$tt->trangthai}}</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @elseif($tt->trangthai == 'Bị trả lại')
                                    <td align="center">
                                        <span class="badge badge-danger">{{$tt->trangthai}}</span><br>&nbsp;
                                    </td>
                                @else
                                    <td align="center">
                                        <span class="badge badge-success">{{$tt->trangthai}}</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @endif
                                <td>
                                    @if($tt->phanloai=='DINHKEM')
                                        <a href="{{url('/data/uploads/attack/'.$tt->filedk)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    @elseif($tt->phanloai == 'DT')
                                        <a href="{{url('ke_khai_dich_vu_luu_tru/report_ke_khai/khach_san/'.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    @else
                                        <a href="{{url('ke_khai_dich_vu_luu_tru/report_ke_khai/'.$tt->mahs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    @endif
                                    @if(can('kkdvlt','approve'))
                                        @if($tt->trangthai !='Bị trả lại')
                                        @if($tt->trangthai == 'Chờ nhận')
                                            <button type="button" onclick="confirmTraLai({{$tt->id}})" class="btn btn-default btn-xs mbs" data-target="#tralai-modal" data-toggle="modal"><i class="fa fa-reply"></i>&nbsp;
                                                Trả lại</button>
                                            <button type="button" onclick="confirmNhanHs({{$tt->id}})" class="btn btn-default btn-xs mbs" data-target="#nhanhs-modal" data-toggle="modal"><i class="fa fa-share"></i>&nbsp;
                                                Nhận hồ sơ</button>
                                                <a href="{{url('ke_khai_dich_vu_luu_tru/'.$tt->macskd.'/hsdakk')}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Thông tin hồ sơ đã kê khai</a>

                                        @else
                                            <button type="button" onclick="confirmNhanHsedit({{$tt->mahs}})" class="btn btn-default btn-xs mbs" data-target="#nhanhsedit-modal" data-toggle="modal"><i class="fa fa-edit"></i>&nbsp;
                                                Chỉnh sửa TT nhận</button>
                                            <button type="button" onclick="confirmHuyduyet({{$tt->mahs}})" class="btn btn-default btn-xs mbs" data-target="#huyduyet-modal" data-toggle="modal"><i class="fa fa-stop"></i>&nbsp;
                                                Huỷ duyệt HS</button>
                                        @endif
                                        @endif

                                    @endif
                                        <a href="{{url('ke_khai_dich_vu_luu_tru/'.$tt->mahs.'/history')}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Lịch sử</a>


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