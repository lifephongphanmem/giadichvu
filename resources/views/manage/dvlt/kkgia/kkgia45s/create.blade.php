@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!--Date-->
    <link type="text/css" rel="stylesheet" href="{{ url('vendors/bootstrap-datepicker/css/datepicker.css') }}">
    <!--End Date-->

@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->

    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/media/js/jquery.dataTables.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js')}}"></script>


    <!-- END PAGE LEVEL PLUGINS -->
    <script src="{{url('assets/admin/pages/scripts/table-managed.js')}}"></script>

    <!--Date>
    <script type="text/javascript" src="{{ url('js/jquery-1.10.2.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/bootstrap-datepicker/js/bootstrap-datepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('vendors/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/main.js') }}"></script>

    <End Date-->
    <!--Date new-->
    <!--script src="{{url('minhtran/jquery.min.js')}}"></script-->
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>
    <!--End date new-->
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

    </script>
    <script>
        function checkngay(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert($('select[name="plhs"]').val());
            $.ajax({
                url: '/ajax/checkngay',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    ngaynhap: $('input[name="ngaynhap"]').val(),
                    ngayhieuluc: $('input[name="ngayhieuluc"]').val(),
                    plhs: $('select[name="plhs"]').val()

                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Ngày hiệu lực có thể sử dụng được", "Thành công!");
                    }else {
                        toastr.error("Bạn cần kiểm tra lại ngày có hiệu lực!", "Lỗi!");
                        $('input[name="ngayhieuluc"]').val('');
                    }
                }
            })

        }
        function checkngaykk(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/ajax/checkngaykk',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    ngaynhap: $('input[name="ngaynhap"]').val()

                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Ngày kê khai có thể sử dụng được", "Thành công!");
                    }else {
                        toastr.error("Bạn cần kiểm tra lại ngày có kê khai, ngày kê khai không được nhỏ hơn ngày hiện tại! ", "Lỗi!");
                        var today = new Date();
                        var dd = today.getDate();
                        var mm = today.getMonth()+1;//January is 0!
                        var yyyy = today.getFullYear();
                        if(dd<10){dd='0'+dd}
                        if(mm<10){mm='0'+mm}
                        $('input[name="ngaynhap"]').val(dd+'/'+mm+'/'+yyyy);
                        $('input[name="ngayhieuluc"]').val('');
                    }
                }
            })

        }
        function clearngay(){
            var today = new Date();
            var dd = today.getDate();
            var mm = today.getMonth()+1;//January is 0!
            var yyyy = today.getFullYear();
            if(dd<10){dd='0'+dd}
            if(mm<10){mm='0'+mm}
            $('input[name="ngaynhap"]').val(dd+'/'+mm+'/'+yyyy);
            $('input[name="ngayhieuluc"]').val('');
        }

        function kkgia(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgdvlt45s/kkgia',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id,
                    ttcb:  $('#ttcb').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttkkgia').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin giá phòng nghỉ!", "Lỗi!");
                }
            })
        }
        function upkkgia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt45s/upkkgia',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idkkgia"]').val(),
                    mucgialk: $('input[name="mucgialk"]').val(),
                    mucgiakk: $('input[name="mucgiakk"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật giá phòng nghỉ thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-kkgia').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })

        }
        function clearAdd(){
            $('#apdungadd').val('');
            $('#mucgialkadd').val('0');
            $('#mucgiakkadd').val('0');
            $('#ghichuadd').val('');
        }
        function addttp(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt45s/addttp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    maloaip: $('select[name="maloaipadd"]').val(),
                    tendoituong: $('select[name="tendoituongadd"]').val(),
                    apdung: $('textarea[name="apdungadd"]').val(),
                    mucgialk: $('input[name="mucgialkadd"]').val(),
                    mucgiakk: $('input[name="mucgiakkadd"]').val(),
                    ghichu: $('textarea[name="ghichuadd"]').val(),
                    macskd: $('input[name="macskd"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật giá phòng nghỉ thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-add').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })

        }

        function editTtPh(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgdvlt45s/editttp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttpedit').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin phòng nghỉ!", "Lỗi!");
                }
            })
        }

        function getid(id){
            document.getElementById("iddelete").value=id;
        }
        function deleteRow() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt45s/deletettp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin kê khai giá phòng nghỉ thành công!", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });

                    $('#modal-delete').modal("hide");

                    //}
                }
            })
        }
        function updatettp(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt45s/updatettp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    loaip: $('select[name="loaipedit"]').val(),
                    qccl:$('textarea[name="qccledit"]').val(),
                    sohieu:$('textarea[name="sohieuedit"]').val(),
                    tendoituong: $('select[name="tendoituongedit"]').val(),
                    apdung: $('textarea[name="apdungedit"]').val(),
                    mucgialk: $('input[name="mucgialkedit"]').val(),
                    mucgiakk: $('input[name="mucgiakkedit"]').val(),
                    ghichu: $('textarea[name="ghichuedit"]').val(),
                    macskd: $('input[name="macskd"]').val(),
                    id: $('input[name="idedit"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã chỉnh sửa thông tin kê khai giá phòng nghỉ thành công!", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });

                    $('#modal-edit').modal("hide");

                    //}
                }
            })
        }
    </script>

@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai hồ sơ giá dịch vụ lưu trú<small>&nbsp;khách sạn có yếu tố nước ngoài quản lý</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/khach_san', 'id' => 'create_kkdvlt', 'class'=>'horizontal-form']) !!}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">
                <input type="hidden" name="ngaychange" id="ngaychange">
                <input type="hidden" name="ttcb" id="ttcb" value="{{isset($modelcb) ? 'yes' : 'no'}}">
                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Hồ sơ kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngaynhap" id="ngaynhap" class="form-control required" autofocus-->
                                {!! Form::select(
                                'plhs',
                                array(
                                'LD' => 'Lần đầu',
                                'GG' => 'Giảm giá',
                                'TG' => 'Tăng giá',
                                ),isset($modelcb) ? 'GG' : 'LD',
                                array('id' => 'plhs', 'class' => 'form-control','onchange'=>"clearngay()"))
                                !!}
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngaynhap" id="ngaynhap" class="form-control required" autofocus-->
                                {!!Form::text('ngaynhap',$ngaynhap, array('id' => 'ngaynhap','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','onchange'=>"checkngaykk()"))!!}
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-error">
                                <label class="control-label">Ngày thực hiện mức giá kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngayhieuluc" id="ngayhieuluc" class="form-control required"-->
                                {!!Form::text('ngayhieuluc',null, array('id' => 'ngayhieuluc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','onchange'=>"checkngay()"))!!}
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn<span class="require">*</span></label>
                                <input type="text" name="socv" id="socv" class="form-control required">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Đơn vị tính<span class="require">*</span></label>
                                <select class="form-control" name="dvt" id="dvt">
                                    <option value="no">--Chọn đơn vị tính--</option>
                                    <option value="Đồng/phòng/ngày đêm">Đồng/phòng/ngày đêm</option>
                                    <option value="Đồng/phòng/tuần">Đồng/phòng/tuần</option>
                                    <option value="Đồng/phòng/tháng">Đồng/phòng/tháng</option>
                                    <option value="Đồng/căn hộ/ngày đêm">Đồng/căn hộ/ngày đêm</option>
                                    <option value="Đồng/căn hộ/tuần">Đồng/căn hộ/tuần</option>
                                    <option value="Đồng/căn hộ/tháng">Đồng/căn hộ/tháng</option>
                                </select>
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    @if(isset($modelcb))
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số công văn liền kề</label>
                                    <!--p style="color: #000088"><b>{{$modelcb->socv}}</b></p-->
                                    <input type="text" name="socvlk" id="socvlk" class="form-control" value="{{isset($modelcb) ? $modelcb->socv : '' }}">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Ngày nhập số công văn liền kề<span class="require">*</span></label>
                                    <!--p style="color: #000088"><b>{{getDayVn($modelcb->ngaynhap)}}</b></p-->
                                    {!!Form::text('ngaycvlk',(isset($modelcb) ? date('d/m/Y',  strtotime($modelcb->ngaynhap)) : ''), array('id' => 'ngaycvlk','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn liền kề</label>
                                <input type="text" name="socvlk" id="socvlk" class="form-control" value="{{isset($modelcb) ? $modelcb->socv : '' }}">

                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày nhập số công văn liền kề<span class="require">*</span></label>
                                {!!Form::text('ngaycvlk',(isset($modelcb) ? date('d/m/Y',  strtotime($modelcb->ngaynhap)) : ''), array('id' => 'ngaycvlk','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                    @endif
                    <input type="hidden" name="macskd" id="macskd" value="{{$modelcskd->macskd}}">
                    <input type="hidden" name="masothue" id="masothue" value="{{$modelcskd->masothue}}">
                    <input type="hidden" name="cqcq" id="cqcq" value="{{$modelcskd->cqcq}}">
                    {!! Form::close() !!}
                    <!--/row-->
                    <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <!--button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()"><i class="fa fa-plus"></i>&nbsp;Kê khai bổ xung phòng</button-->
                                &nbsp;
                                <button type="button" data-target="#modal-add" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearAdd()"><i class="fa fa-plus"></i>&nbsp;Kê khai giá theo đối tượng áp dụng</button>
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dsts">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center">Loại phòng<br>Quy cách chất lượng</th>
                                    <th style="text-align: center">Đối tượng</th>
                                    <th style="text-align: center">Áp dụng</th>
                                    <th style="text-align: center">Mức giá liền kề</th>
                                    <th style="text-align: center">Mức giá kê khai</th>
                                    <th style="text-align: center">Ghi chú</th>
                                    <th style="text-align: center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modelttdv as $key=>$ph)
                                    <tr>
                                        <td align="center">{{$key + 1}}</td>
                                        <td class="active">{{$ph->loaip.'-'.$ph->qccl}}</td>
                                        <td>{{$ph->tendoituong}}</td>
                                        <td>{{$ph->apdung}}</td>
                                        <td align="right">{{number_format($ph->mucgialk)}}</td>
                                        <td align="right">{{number_format($ph->mucgiakk)}}</td>
                                        <td>{{$ph->ghichu}}</td>
                                        <td>
                                            <button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia({{$ph->id}});"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>
                                            <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh({{$ph->id}});"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</button>
                                            <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$ph->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label">Thông tin kê khai</label>
                                <div>
                                        <textarea id="ghichu" class="form-control" name="ghichu" cols="30" rows="5"
                                                  placeholder="-Phụ thu, Thuế VAT">{{isset($modelcb) ? $modelcb->ghichu : '' }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
            <div style="text-align: center">
                <a href="{{url('ke_khai_dich_vu_luu_tru/co_so_kinh_doanh='.$modelcskd->macskd.'&nam='.date('Y'))}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
            </div>
        </div>
    </div>
    <!-- BEGIN DASHBOARD STATS -->
    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>
    <!--Validate Form-->
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create_kkdvlt").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>
    <!-- modal add ttp-->
    <div class="modal fade bs-modal-lg" id="modal-add" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Kê khai giá theo đối tượng áp dụng</h4>
                </div>
                <div class="modal-body" id="ttpthemmoi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Loại phòng</b><span class="require">*</span></label>
                                <div>
                                    <select id="maloaipadd" name="maloaipadd" class="form-control">
                                        @foreach($modelttp as $ttp)
                                            <option value="{{$ttp->maloaip}}">{{$ttp->loaip}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Đối tượng áp dụng</b><span class="require">*</span></label>
                                <div>
                                    <select id="tendoituongadd" name="tendoituongadd" class="form-control">
                                        @foreach($modeldtad as $dt)
                                            <option value="{{$dt->tendoituong}}">{{$dt->tendoituong}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Áp dụng</b><span class="require">*</span></label>
                                <div><textarea id="apdungadd" class="form-control" name="apdungadd" cols="30" rows="3"></textarea></div>
                            </div>
                        </div>
                    </div>
                    <!--div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Giá liền kề</b><span class="require">*</span></label>
                                <div><input type="text" name="mucgialkadd" id="mucgialkadd" class="form-control" data-mask="fdecimal" value="0" style="text-align: right">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Giá kê khai</b><span class="require">*</span></label>
                                <div><input type="text" name="mucgiakkadd" id="mucgiakkadd" class="form-control" data-mask="fdecimal" value="0"  style="text-align: right"></div>
                            </div>
                        </div>
                    </div-->
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Ghi chú</b><span class="require">*</span></label>
                                <div><textarea id="ghichuadd" class="form-control" name="ghichuadd" cols="30" rows="3"></textarea></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="addttp()">Thêm mới</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Modal kê khai giá-->
    <div class="modal fade" id="modal-kkgia" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Kê khai giá phòng nghỉ</h4>
                </div>
                <div class="modal-body" id="ttkkgia">
                </div>

                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="upkkgia()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <!--Model dialog edit-->
    <div class="modal fade bs-modal-lg" id="modal-edit" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa thông tin phòng nghỉ</h4>
                </div>
                <div class="modal-body" id="ttpedit">
                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="updatettp()">Cập nhật</button>
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
                    <h4 class="modal-title">Đồng ý xóa thông tin kê khai giá phòng nghỉ?</h4>
                </div>
                <input type="hidden" id="iddelete" name="iddelete">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="deleteRow()">Đồng ý</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    @include('includes.script.create-header-scripts')


@stop