@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
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

    </script>
    <script>
        function editItem(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/ttphong/edit',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#tttsedit').replaceWith(data.message);
                        $('#tentsedit').focus();
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin phòng nghỉ!", "Lỗi!");
                }
            })
        }

        function updatets() {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '/ttphong/update',
                type: 'GET',
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
                    //$('#modal-wide-width').dialog('close');
                    if (data.status == 'success') {
                        toastr.success("Chỉnh sửa thông tin phòng nghỉ thành công", "Thành công!");
                        $('#dsts').replaceWith(data.message);
                        jQuery(document).ready(function() {
                            TableManaged.init();
                        });
                        $('#modal-wide-width').modal("hide");

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
                url: '/ttphong/delete',
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

                    $('#modal-delete-ts').modal("hide");

                    //}
                }
            })
        }
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Kê khai thông tin cơ sở kinh doanh dịch vụ lưu trú<small> thêm mới</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::open(['url'=>'ttcskd_dich_vu_luu_tru', 'id' => 'create_ttcskd_dvlt', 'class'=>'horizontal-form','files'=>true,'enctype'=>'multipart/form-data']) !!}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box blue">

                <div class="portlet-body">
                    <h4 class="form-section" style="color: #0000ff">Thông tin cơ sở kinh doanh</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Tên cơ sở kinh doanh<span class="require">*</span></label>
                                <input type="text" id="tencskd" name="tencskd" class="form-control required" autofocus>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Loại hạng<span class="require">*</span></label>
                                <select id="loaihang" name="loaihang" class="form-control">
                                    <option value="1">1 sao</option>
                                    <option value="2">2 sao</option>
                                    <option value="3" selected>3 sao</option>
                                    <option value="4">4 sao</option>
                                    <option value="5">5 sao</option>
                                    <option value="K">Khác (Nhà nghỉ)</option>
                                    <option value="CXD">Chưa xác định (Khách sạn chưa xác định sao)</option>
                                </select>
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <!--/row-->
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Số điện thoai<span class="require">*</span></label>
                                <input type="text" id="telkd" name="telkd" class="form-control">
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-error">
                                <label class="control-label">Địa chỉ</label>
                                <input type="text" id="diachikd" name="diachikd" class="form-control">
                            </div>
                        </div>
                        <!--/span-->
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Trang chủ<span class="require">*</span></label>
                                <input type="text" id="link" name="link" class="form-control">
                            </div>
                        </div>
                        <!--div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Ảnh đại diện<span class="require">*</span></label>
                                {!!Form::file('toado',array('id'=>'toado','class' => 'passvalid','accept'=>'image/*'))!!}
                            </div>
                        </div-->
                        <input type="hidden" name="cqcq" id="cqcq" value="{{$ttdn->cqcq}}">
                        <input type="hidden" name="masothue" id="masothue" value="{{$ttdn->masothue}}">

                    </div>

                    {!! Form::close() !!}
                    <!--/row-->
                    <h4 class="form-section" style="color: #0000ff">Thông tin phòng nghỉ- quy cách- chất lượng</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Loại phòng<span class="require">*</span></label>
                                <input type="text" id="loaip" name="loaip" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="control-label">Quy cách chất lượng</label>
                                <textarea id="qccl" class="form-control" name="qccl" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <!--/span-->
                        <div class="col-md-6">
                            <div class="form-group has-error">
                                <label class="control-label">Số hiệu phòng</label>
                                <textarea id="sohieu" class="form-control" name="sohieu" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                        <!--/span-->
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="control-label">Ghi chú</label>
                                <textarea id="ghichu" class="form-control" name="ghichu" cols="30" rows="3"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="button" id="capnhatts" name="capnhatts" class="btn btn-primary">Cập nhật</button>
                                &nbsp;
                            </div>
                        </div>
                    </div>
                    <div class="row" id="dsts">
                        <div class="col-md-12">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th width="2%" style="text-align: center">STT</th>
                                    <th style="text-align: center">Loại phòng</th>
                                    <th style="text-align: center">Quy cách chất lượng</th>
                                    <th style="text-align: center">Số hiệu phòng</th>
                                    <th style="text-align: center">Ghi chú</th>
                                    <th style="text-align: center" width="20%">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

            </div>

            <!-- END EXAMPLE TABLE PORTLET-->
            <div style="text-align: center">
                @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                    <a href="{{url('ttcskd_dich_vu_luu_tru/masothue='.$masothue)}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                @else
                    <a href="{{url('ttcskd_dich_vu_luu_tru')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
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

            var validator = $("#create_ttcskd_dvlt").validate({
                rules: {
                    ten :"required"
                },
                messages: {
                    ten :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>


    <script>
        jQuery(document).ready(function($) {
            $('button[name="capnhatts"]').click(function(){
                //alert($('input[name="tents"]').val());
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    url: '/ttphong/store',
                    type: 'GET',
                    data: {
                        _token: CSRF_TOKEN,
                        loaip: $('input[name="loaip"]').val(),
                        qccl: $('textarea[name="qccl"]').val(),
                        sohieu: $('textarea[name="sohieu"]').val(),
                        ghichu: $('textarea[name="ghichu"]').val(),
                        masothue: $('input[name="masothue"]').val()
                    },
                    dataType: 'JSON',
                    success: function (data) {
                        if(data.status == 'success') {
                            toastr.success("Cập nhật thông phòng nghỉ thành công", "Thành công!");
                            $('#dsts').replaceWith(data.message);
                            $('#loaip').val('');
                            $('#qccl').val('');
                            $('#sohieu').val('');
                            $('#ghichu').val('');
                            $('#loaip').focus();
                            jQuery(document).ready(function() {
                                TableManaged.init();
                            });
                        }
                        else
                            toastr.error("Bạn cần kiểm tra lại thông tin vừa nhập!", "Lỗi!");
                    }
                })
            });

        }(jQuery));
    </script>
    <!--Modal Wide Width-->
    <div class="modal fade bs-modal-lg" id="modal-wide-width" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Chỉnh sửa thông tin phòng nghỉ- quy cách chất lượng</h4>
                </div>
                <div class="modal-body" id="tttsedit">
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
    <div class="modal fade" id="modal-delete-ts" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog ">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa thông tin tài sản?</h4>
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