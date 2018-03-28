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
        function kkgia(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgiadvvtxtx/kkgiadv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttkkgia').replaceWith(data.message);
                        InputMask();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin giá dịch vụ!", "Lỗi!");
                }
            })
        }
        function upkkgia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgiadvvtxtx/upkkgiadv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idkkgia"]').val(),
                    giakklk: $('input[name="giakklk"]').val(),
                    trenkmlk: $('input[name="trenkmlk"]').val(),
                    giakklkden: $('input[name="giakklkden"]').val(),
                    giakklktl: $('input[name="giakklktl"]').val(),
                    giakk: $('input[name="giakk"]').val(),
                    trenkm: $('input[name="trenkm"]').val(),
                    giakkden: $('input[name="giakkden"]').val(),
                    giakktl: $('input[name="giakktl"]').val(),
                    masothue: $('input[name="masothue"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Cập nhật giá dịch vụ thành công", "Thành công!");
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
        function clearForm(){
            $('#tendichvucreate').val('');
            $('#qcclcreate').val('');
            //$('#dvtcreate').val('');
            $('#ghichucreate').val('');
        }
        function createttdv(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgiadvvtxtx/storedv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    tendichvu: $('input[name="tendichvucreate"]').val(),
                    qccl: $('input[name="qcclcreate"]').val(),
                    dvt: $('input[name="dvtcreate"]').val(),
                    ghichu: $('textarea[name="ghichucreate"]').val(),
                    masothue: $('input[name="masothue"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        $('#create-ttdv').modal("hide");
                        toastr.success("Bổ xung thông tin thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                    }else
                        toastr.error("Không bổ xung được thông tin dịch vụ!", "Lỗi!");
                }
            })
        }
        function editTtPh(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgiadvvtxtx/editdv',
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
                url: '/kkgiadvvtxtx/updatedv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="idedit"]').val(),
                    tendichvu: $('input[name="tendichvuedit"]').val(),
                    qccl: $('input[name="qccledit"]').val(),
                    dvt: $('input[name="dvtedit"]').val(),
                    ghichu: $('textarea[name="ghichuedit"]').val(),
                    masothue: $('input[name="masothue"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        toastr.success("Chỉnh sửa thông tin dịch vụ thành công", "Thành công!");
                        $('#modal-edit').modal("hide");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });

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
                url: '/kkgiadvvtxtx/deldv',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('input[name="iddelete"]').val(),
                    masothue: $('input[name="masothue"]').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        toastr.success("Bạn đã xóa thông tin dịch vụ thành công!", "Thành công!");
                        $('#modal-delete').modal("hide");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                    }
                    else
                        toastr.error("Bạn cần kiểm tra lại thông tin vừa xóa!", "Lỗi!");
                }
            })

        }

    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai hồ sơ<small>&nbsp;giá dịch vụ vận tải xe taxi</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::open(['url'=>'/ke_khai_dich_vu_van_tai/xe_taxi', 'id' => 'create_kkdvvttx', 'class'=>'horizontal-form']) !!}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">

                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin hồ sơ</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngaynhap" id="ngaynhap" class="form-control required" autofocus-->
                                {!!Form::text('ngaynhap',\Carbon\Carbon::now()->format('d/m/Y'), array('id' => 'ngaynhap','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required','autofocus'))!!}
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-error">
                                <label class="control-label">Ngày thực hiện mức giá kê khai<span class="require">*</span></label>
                                <!--input type="date" name="ngayhieuluc" id="ngayhieuluc" class="form-control required"-->
                                {!!Form::text('ngayhieuluc',null, array('id' => 'ngayhieuluc','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
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
                            <div class="form-group has-error">
                                <label class="control-label">Số công văn liền kề</label>
                                <input type="text" name="socvlk" id="socvlk" class="form-control" value="{{isset($modelcb) ? $modelcb->socv : '' }}">

                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ngày nhập số công văn liền kề<span class="require">*</span></label>
                                {!!Form::text('ngaynhaplk',(isset($modelcb) ? date('d/m/Y',  strtotime($modelcb->ngaynhap)) : ''), array('id' => 'ngaynhaplk','data-inputmask'=>"'alias': 'date'",'class' => 'form-control'))!!}

                            </div>
                        </div>

                    </div>
                    <input type="hidden" name="masothue" id="masothue" value="{{$modeldn->masothue}}">
                    <input type="hidden" name="cqcq" id="cqcq" value="{{$modeldn->cqcq}}">
                    {!! Form::close() !!}
                    <!--/row-->
                    <h4 class="form-section" style="color: #0000ff">Thông tin chi tiết hồ sơ</h4>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" data-target="#create-ttdv" data-toggle="modal" class="btn btn-success btn-xs" onclick="clearForm()"><i class="fa fa-plus"></i>&nbsp;Kê khai bổ xung dịch vụ cung cấp</button>
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
                                    <th style="text-align: center" width="15%">Tên cung ứng<br> dịch vụ</th>
                                    <th style="text-align: center" width="15%">Quy cách<br> chất lượng</th>
                                    <th style="text-align: center" width="5%">Đơn vị<br> tính</th>
                                    <th style="text-align: center">Giá <br>mở cửa<br>liền kề</th>
                                    <th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>liền kề</th>
                                    <th style="text-align: center">Giá từ <br>km 31<br> trở lên<br>liền kề</th>
                                    <th style="text-align: center">Giá <br>mở cửa<br>kê khai</th>
                                    <th style="text-align: center">Giá km <br>tiếp theo <br>đến km 30<br>kê khai</th>
                                    <th style="text-align: center">Giá từ <br>km 31 <br>trở lên<br>kê khai</th>
                                    <th style="text-align: center">Thao tác</th>
                                </tr>

                                </thead>
                                <tbody>
                                @foreach($model as $key=>$tt)
                                    <tr>
                                        <td align="center">{{$key + 1}}</td>
                                        <td class="active">{{$tt->tendichvu}}</td>
                                        <td>{{$tt->qccl}}</td>
                                        <td align="center">{{$tt->dvt}}</td>
                                        <td align="right">{{number_format($tt->giakklk).'/'.$tt->trenkmlk.'km'}}</td>
                                        <td align="right">{{number_format($tt->giakklkden)}}</td>
                                        <td align="right">{{number_format($tt->giakklktl)}}</td>
                                        <td align="right">{{number_format($tt->giakk).'/'.$tt->trenkm.'km'}}</td>
                                        <td align="right">{{number_format($tt->giakkden)}}</td>
                                        <td align="right">{{number_format($tt->giakktl)}}</td>
                                        <td>
                                            <button type="button" data-target="#modal-kkgia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="kkgia({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Kê khai giá</button>
                                            <button type="button" data-target="#modal-edit" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="editTtPh({{$tt->id}});"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa thông tin</button>
                                            <button type="button" data-target="#modal-pagia" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="get_pag('{{$tt->madichvu}}')"><i class="fa fa-edit"></i>&nbsp;Phương án giá</button>
                                            <button type="button" data-target="#modal-delete" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="getid({{$tt->id}});" ><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label class="control-label">Các yếu tố chi phí cấu thành giá (đối với kê khai lần đầu); phân tích nguyên nhân, nêu rõ biến động của các yếu tố hình thành giá tác động làm tăng hoặc giảm giá (đối với kê khai lại).</label>
                                <div>
                                    <textarea id="yeuto" class="form-control" name="yeuto" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group"><label class="control-label">Các trường hợp ưu đãi, giảm giá; điều kiện áp dụng giá (nếu có).</label>
                                <div>
                                    <textarea id="uudai" class="form-control" name="uudai" cols="30" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- END EXAMPLE TABLE PORTLET-->
            <div style="text-align: center">
                @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                    <a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi/masothue='.$modeldn->masothue.'&nam='.date('Y'))}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                @else
                    <a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi/nam='.date('Y'))}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                @endif
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
                    <h4 class="modal-title">Kê khai giá dịch vụ</h4>
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
    <div class="modal fade bs-modal-lg" id="create-ttdv" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Thêm mới thông tin dịch vụ vận tải taxi</h4>
                </div>
                <div class="modal-body" id="ttpthemmoi">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Tên cung ứng dịch vụ</b><span class="require">*</span></label>
                                <div><input type="text" name="tendichvucreate" id="tendichvucreate" class="form-control" ></div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Quy cách chất lượng</b><span class="require">*</span></label>
                                <div><input type="text" name="qcclcreate" id="qcclcreate" class="form-control" ></div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group"><label for="selGender" class="control-label"><b>Đơn vị tính</b><span class="require">*</span></label>
                                <div><input type="text" name="dvtcreate" id="dvtcreate" class="form-control" value="đồng"></div>
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
                    <button type="button" class="btn btn-primary" onclick="createttdv()">Bổ xung</button>
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
                    <h4 class="modal-title">Chỉnh sửa thông tin dịch vụ</h4>
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
                    <h4 class="modal-title">Đồng ý xóa thông tin dịch vụ?</h4>
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

    <!--Modal phương án giá-->
    @include('manage.dvvt.dvxtx.templates.phuongangia')

    <!--Script phương án giá-->
    <script>
        function update_pagia(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgiadvvtxtx/update_pag_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    madichvu:$('#madichvu').val(),
                    nguyengia: $('#nguyengia').val(),
                    tongkm:$('#tongkm').val(),
                    kmcokhach:$('#kmcokhach').val(),
                    khauhao:$('#khauhao').val(),
                    baohiem:$('#baohiem').val(),
                    baohiempt:$('#baohiempt').val(),
                    baohiemtnds:$('#baohiemtnds').val(),
                    lainganhang:$('#lainganhang').val(),
                    thuevp:$('#thuevp').val(),
                    suachualon:$('#suachualon').val(),
                    samlop:$('#samlop').val(),
                    dangkiem:$('#dangkiem').val(),
                    quanly:$('#quanly').val(),
                    banhang:$('#banhang').val(),
                    luonglaixe:$('#luonglaixe').val(),
                    nhienlieuchinh:$('#nhienlieuchinh').val(),
                    nhienlieuboitron:$('#nhienlieuboitron').val(),
                    chiphibdcs:$('#chiphibdcs').val(),
                    //giakekhai:$('#giakekhai').val(),
                    //doanhthu:$('#doanhthu').val(),
                    phiduongbo:$('#phiduongbo').val(),
                    loinhuan:$('#loinhuan').val(),
                    suachuatx:$('#suachuatx').val(),
                    ghichu_pag:$('#ghichu_pag').val()
                },
                dataType: 'JSON',
                success: function () {
                    toastr.success('Thao tác thành công.','Thành công!');
                },
                error: function(message){
                    toastr.error(message,'Lỗi!');
                }
            });
        }

        function get_pag(madichvu){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/kkgiadvvtxtx/get_pag_temp',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    madichvu: madichvu
                },
                dataType: 'JSON',
                success: function (data) {
                    $('#nguyengia').val(data.nguyengia);
                    $('#tongkm').val(data.tongkm);
                    $('#kmcokhach').val(data.kmcokhach);
                    $('#khauhao').val(data.khauhao);
                    $('#baohiem').val(data.baohiem);
                    $('#baohiempt').val(data.baohiempt);
                    $('#baohiemtnds').val(data.baohiemtnds);
                    $('#lainganhang').val(data.lainganhang);
                    $('#thuevp').val(data.thuevp);
                    $('#suachualon').val(data.suachualon);
                    $('#samlop').val(data.samlop);
                    $('#dangkiem').val(data.dangkiem);
                    $('#quanly').val(data.quanly);
                    $('#banhang').val(data.banhang);
                    $('#luonglaixe').val(data.luonglaixe);
                    $('#nhienlieuchinh').val(data.nhienlieuchinh);
                    $('#nhienlieuboitron').val(data.nhienlieuboitron);
                    $('#chiphibdcs').val(data.chiphibdcs);
                    $('#phiduongbo').val(data.phiduongbo);
                    $('#loinhuan').val(data.loinhuan);
                    $('#suachuatx').val(data.suachuatx);
                    $('#ghichu_pag').val(data.ghichu_pag);
                    $('#madichvu').val(madichvu);
                    InputMask();
                    tongchiphi();
                    thuevat()
                },
                error: function(message){
                    toastr.error(message,'Lỗi!');
                }
            });
        }
    </script>
    @include('includes.script.create-header-scripts')
@stop