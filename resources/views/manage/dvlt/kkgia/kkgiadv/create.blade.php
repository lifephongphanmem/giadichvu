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

        // </editor-fold>
    </script>
    <script>
        function kkgia(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgdvlt/kkgia',
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
                url: '/kkgdvlt/upkkgia',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idkkgia"]').val(),
                    tents: $('input[name="tentsedit"]').val(),
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
        function checkngay(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
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
        function clearngay(){
            //$('input[name="ngaynhap"]').val() = $('input[name="ngaynhapdf"]').val();
            $('input[name="ngayhieuluc"]').val('');
        }
        function clearForm(){
            $('#loaipcreate').val('');
            $('#qcclcreate').val('');
            $('#sohieucreate').val('');
            $('#ghichucreate').val('');
        }
        function createttp(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt/storettp',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    loaip: $('input[name="loaipcreate"]').val(),
                    qccl: $('textarea[name="qcclcreate"]').val(),
                    sohieu: $('textarea[name="sohieucreate"]').val(),
                    ghichu: $('textarea[name="ghichucreate"]').val(),
                    macskd: $('input[name="macskd"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Bổ xung thông tin thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-create').modal("hide");

                    }
                }
            })
        }
        function editTtPh(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgdvlt/editttp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttpedit').replaceWith(data.message);
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin phòng nghỉ!", "Lỗi!");
                }
            })
        }

        function updatets() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt/update',
                type: 'POST',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idedit"]').val(),
                    loaip: $('input[name="loaipedit"]').val(),
                    qccl: $('textarea[name="qccledit"]').val(),
                    sohieu: $('textarea[name="sohieuedit"]').val(),
                    ghichu: $('textarea[name="ghichuedit"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Chỉnh sửa thông tin phòng nghỉ thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-edit').modal("hide");

                    } else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                }
            })
        }
        function getid(id){
            document.getElementById("iddelete").value=id;
        }
        function deleteRow() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgdvlt/delete',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    //if(data.status == 'success') {
                    toastr.success("Bạn đã xóa thông tin phòng nghỉ thành công!", "Thành công!");
                    $('#dsts').replaceWith(data.message);
                    jQuery(document).ready(function() {
                        TableManaged.init();
                    });

                    $('#modal-delete').modal("hide");

                    //}
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
                        $('#ngaynhap').val(dd+'/'+mm+'/'+yyyy);
                        $('input[name="ngayhieuluc"]').val('');
                    }
                }
            })

        }


    </script>
    <script>
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
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai hồ sơ giá<small> dịch vụ lưu trú</small>
        <h5>{{$modeldn->tendn}}- Mã số thuế: {{$modeldn->masothue}} kê khai giá DVLT cơ sở kinh doanh {{$modelcskd->tencskd}}</h5>
    </h3>
    <hr>
    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru', 'id' => 'create_kkdvlt', 'class'=>'horizontal-form','files'=>true,'enctype'=>'multipart/form-data']) !!}
        <meta name="csrf-token" content="{{ csrf_token() }}" />
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
                                @if(isset($modelcb))
                                    {!! Form::select(
                                    'plhs',
                                    array(
                                    'GG' => 'Giảm giá',
                                    'TG' => 'Tăng giá',
                                    ),isset($modelcb) ? 'GG' : 'LD',
                                    array('id' => 'plhs', 'class' => 'form-control','onchange'=>"clearngay()"))
                                    !!}
                                @else
                                    {!! Form::select(
                                    'plhs',
                                    array(
                                    'LD' => 'Lần đầu',
                                    'GG' => 'Giảm giá',
                                    'TG' => 'Tăng giá',
                                    ),isset($modelcb) ? 'GG' : 'LD',
                                    array('id' => 'plhs', 'class' => 'form-control','onchange'=>"clearngay()"))
                                    !!}
                                @endif
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Đơn vị quản lý</label>
                                <select class="form-control" name="cqcq" id="cqcq" required>
                                    @foreach($modelcq as $tt)
                                        <option value="{{$tt->maqhns}}" {{$tt->maqhns==$modeldn->cqcq? "selected":""}}>{{$tt->tendv}}</option>
                                    @endforeach
                                </select>
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
                            <div class="form-group">
                                <label class="control-label">Ngày thực hiện mức giá kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngayhieuluc" id="ngayhieuluc" class="form-control required"-->
                                {!!Form::text('ngayhieuluc',$ngayhieuluc, array('id' => 'ngayhieuluc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','onchange'=>"checkngay()"))!!}
                                <!--Form::text('ngayhieuluc',$ngayhieuluc, array('id' => 'ngayhieuluc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','onchange'=>"checkngay()"))-->
                            </div>
                        </div>
                        <!--/span-->

                    </div>

                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số công văn<span class="require">*</span></label>
                                <input type="text" name="socv" id="socv" class="form-control required" autofocus>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Đơn vị tính<span class="require">*</span></label>
                                <select class="form-control" name="dvt" id="dvt">
                                    <option value="no" {{isset($modelcb) && $modelcb->dvt == 'no' ? 'selected' : ''}}>--Chọn đơn vị tính--</option>
                                    <option value="Đồng/giường/ngày đêm" {{isset($modelcb) && $modelcb->dvt == 'Đồng/giường/ngày đêm' ? 'selected' : ''}}>Đồng/giường/ngày đêm</option>
                                    <option value="Đồng/phòng/ngày đêm" {{isset($modelcb) && $modelcb->dvt == 'Đồng/phòng/ngày đêm' ? 'selected' : ''}}>Đồng/phòng/ngày đêm</option>
                                    <option value="Đồng/phòng/tuần" {{isset($modelcb) && $modelcb->dvt == 'Đồng/phòng/tuần' ? 'selected' : ''}}>Đồng/phòng/tuần</option>
                                    <option value="Đồng/phòng/tháng" {{isset($modelcb) && $modelcb->dvt == 'Đồng/phòng/tháng' ? 'selected' : ''}}>Đồng/phòng/tháng</option>
                                    <option value="Đồng/căn hộ/ngày đêm" {{isset($modelcb) && $modelcb->dvt == 'Đồng/căn hộ/ngày đêm' ? 'selected' : ''}}>Đồng/căn hộ/ngày đêm</option>
                                    <option value="Đồng/căn hộ/tuần" {{isset($modelcb) && $modelcb->dvt == 'Đồng/căn hộ/tuần' ? 'selected' : ''}}>Đồng/căn hộ/tuần</option>
                                    <option value="Đồng/căn hộ/tháng" {{isset($modelcb) && $modelcb->dvt == 'Đồng/căn hộ/tháng' ? 'selected' : ''}}>Đồng/căn hộ/tháng</option>

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
                                    <!--input type="date" name="ngaycvlk" id="ngaycvlk" class="form-control" value="{{isset($modelcb) ? $modelcb->ngaynhap : '' }}"-->
                                    {!!Form::text('ngaycvlk',(isset($modelcb) ? date('d/m/Y',  strtotime($modelcb->ngaynhap)) : ''), array('id' => 'ngaycvlk','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                    @endif
                    <div class="row">
                        @if(isset($modelcb))
                            @if($modelcb->giaycnhangcs != '')
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Giấy công nhận hạng cơ sở lưu trú</label>
                                    <a href="{{ url('images/cskddvlt/hangcslt/'.$modelcb->giaycnhangcs)}}" target="_blank">{{$modelcb->giaycnhangcs}}</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="checkbox" name="checkgiaycncs" value="checkgiaycncs"> <label>Xóa bỏ file giấy chứng nhận hạng</label>
                                </div>
                            </div>
                            @endif
                    </div>
                                <div class="row">

                            @if($modelcb->filedk1 != '')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Giấy công nhận hạng cơ sở lưu trú</label>
                                        <a href="{{ url('images/cskddvlt/hangcslt/'.$modelcb->filedk1)}}" target="_blank">{{$modelcb->filedk1}}</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="checkfiledk1" value="checkfiledk1"> <label>Xóa bỏ file giấy chứng nhận hạng</label>
                                    </div>
                                </div>
                            @endif
                                </div>
                    <div class="row">
                                @if($modelcb->filedk2 != '')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Giấy công nhận hạng cơ sở lưu trú</label>
                                        <a href="{{ url('images/cskddvlt/hangcslt/'.$modelcb->filedk2)}}" target="_blank">{{$modelcb->filedk2}}</a>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input type="checkbox" name="checkfiledk2" value="checkfiledk2"> <label>Xóa bỏ file giấy chứng nhận hạng</label>
                                    </div>
                                </div>
                            @endif
                    </div>
                    <div class="row">
                                @if($modelcb->filedk3 != '')
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="control-label">Giấy công nhận hạng cơ sở lưu trú</label>
                                            <a href="{{ url('images/cskddvlt/hangcslt/'.$modelcb->filedk3)}}" target="_blank">{{$modelcb->filedk3}}</a>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="checkbox" name="checkfiledk3" value="checkfiledk3"> <label>Xóa bỏ file giấy chứng nhận hạng</label>
                                        </div>
                                    </div>
                                @endif
                    </div>
                            <input type="hidden" name="giaycnhangcsplus" id="giaycnhangcsplus" value="{{$modelcb->giaycnhangcs}}">
                            <input type="hidden" name="filedk1plus" id="filedk1plus" value="{{$modelcb->filedk1}}">
                            <input type="hidden" name="filedk2plus" id="filedk2plus" value="{{$modelcb->filedk2}}">
                            <input type="hidden" name="filedk3plus" id="filedk3plus" value="{{$modelcb->filedk3}}">
                        @else
                            <input type="hidden" name="giaycnhangcsplus" id="giaycnhangcsplus" value="">
                            <input type="hidden" name="filedk1plus" id="filedk1plus" value="">
                            <input type="hidden" name="filedk2plus" id="filedk2plus" value="">
                            <input type="hidden" name="filedk3plus" id="filedk3plus" value="">
                        @endif

                        <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">File công nhận hạng cơ sở lưu trú<span class="require">*</span></label>
                                    {!!Form::file('giaycnhangcs',array('id'=>'giaycnhangcs','class' => 'passvalid','accept'=>'image/*'))!!}
                                </div>
                                <div class="form-group">
                                    <label class="control-label">File công nhận hạng cơ sở lưu trú<span class="require">*</span></label>
                                    {!!Form::file('filedk1',array('id'=>'filedk1','class' => 'passvalid','accept'=>'image/*'))!!}
                                </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">File công nhận hạng cơ sở lưu trú<span class="require">*</span></label>
                                {!!Form::file('filedk2',array('id'=>'filedk2','class' => 'passvalid','accept'=>'image/*'))!!}
                            </div>
                            <div class="form-group">
                                <label class="control-label">File công nhận hạng cơ sở lưu trú<span class="require">*</span></label>
                                {!!Form::file('filedk3',array('id'=>'filedk3','class' => 'passvalid','accept'=>'image/*'))!!}
                            </div>
                        </div>
                        </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Số quyết định giấy công nhận hạng cơ sở lưu trú</label>
                                <input type="text" name="soqdgiaycnhangcs" id="soqdgiaycnhangcs" class="form-control" value="{{isset($modelcb) ? $modelcb->soqdgiaycnhangcs : '' }}">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giấy công nhận hạng cơ sở lưu trú có hiệu lực từ ngày<span class="require">*</span></label>
                                {!!Form::text('giaycnhangcstungay',(isset($modelcb) ? ($modelcb->giaycnhangcstungay != '' ? date('d/m/Y',  strtotime($modelcb->giaycnhangcstungay)) : ''): ''), array('id' => 'giaycnhangcstungay','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label class="control-label">Giấy công nhận hạng cơ sở lưu trú có hiệu lực đến ngày<span class="require">*</span></label>
                                {!!Form::text('giaycnhangcsdenngay',(isset($modelcb) ? ($modelcb->giaycnhangcsdenngay != '' ? date('d/m/Y',  strtotime($modelcb->giaycnhangcsdenngay)) : '') : ''), array('id' => 'giaycnhangcsdenngay','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}
                            </div>
                        </div>
                    </div>
                    <input type="hidden" name="macskd" id="macskd" value="{{$modelcskd->macskd}}">
                    <input type="hidden" name="masothue" id="masothue" value="{{$modeldn->masothue}}">
                    <!--input type="hidden" name="cqcq" id="cqcq" value="{{$modeldn->cqcq}}"-->
                    <input type="hidden" name="tencskd" id="tencskd" value="{{$modelcskd->tencskd}}">
                    <input type="hidden" name="tendn" id="tendn" value="{{$modeldn->tendn}}">
                    <input type="hidden" name="loaihang" id="loaihang" value="{{$modelcskd->loaihang}}">

                    {!! Form::close() !!}
                    <!--/row-->
                    <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" data-target="#modal-create" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()"><i class="fa fa-plus"></i>&nbsp;Kê khai cập nhật thông tin phòng phòng</button>
                                &nbsp;
                            </div>
                        </div>
                    </div>

                    <div class="row" id="dsts">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th style="text-align: center">STT</th>
                                    <th style="text-align: center">Loại phòng<br>Quy cách chất lượng</th>
                                    <th style="text-align: center">Số hiệu phòng</th>
                                    <th style="text-align: center">Ghi chú</th>
                                    <th style="text-align: center">Mức giá liền kề</th>
                                    <th style="text-align: center">Mức giá kê khai</th>
                                    <th style="text-align: center">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($modeldsph as $key=>$ph)
                                    <tr>
                                        <td align="center">{{$key + 1}}</td>
                                        <td class="active">{{$ph->loaip.'-'.$ph->qccl}}</td>
                                        <td>{{$ph->sohieu}}</td>
                                        <td>{{$ph->ghichu}}</td>
                                        <td align="right">{{number_format($ph->mucgialk)}}</td>
                                        <td align="right">{{number_format($ph->mucgiakk)}}</td>
                                        <td>
                                            <button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia({{$ph->id}});"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>
                                            <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh({{$ph->id}});"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>
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
    <!--Model them moi ttp-->
    <div class="modal fade bs-modal-lg" id="modal-create" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin phòng nghỉ- quy cách chất lượng</h4>
                </div>
                <div class="modal-body" id="ttpthemmoi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Loại phòng</b><span class="require">*</span></label>
                                <div><input type="text" name="loaipcreate" id="loaipcreate" class="form-control" ></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Quy cách chất lượng</b><span class="require">*</span></label>
                                <div><textarea id="qcclcreate" class="form-control" name="qcclcreate" cols="30" rows="3"></textarea></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Số hiệu phòng</b><span class="require">*</span></label>
                                <div><textarea id="sohieucreate" class="form-control" name="sohieucreate" cols="30" rows="3"></textarea></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Ghi chú</b><span class="require">*</span></label>
                                <div><textarea id="ghichucreate" class="form-control" name="ghichucreate" cols="30" rows="3"></textarea></div>
                            </div>
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-default">Thoát</button>
                    <button type="button" class="btn btn-primary" onclick="createttp()">Cập nhật</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!--Modal chỉnh sửa ttp-->
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
                    <button type="button" class="btn btn-primary" onclick="updatets()">Cập nhật</button>
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
                    <h4 class="modal-title">Đồng ý xóa thông tin phòng nghỉ?</h4>
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