@extends('main')

@section('custom-style')

@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <!--cript src="{{url('assets/admin/pages/scripts/form-validation.js')}}"></script-->

@stop

@section('content')
    <h3 class="page-title">
        Thông tin đơn vị quản lý<small> thêm mới</small>
    </h3>
    <!-- END PAGE HEADER-->

    <!-- BEGIN DASHBOARD STATS -->
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <!--div class="portlet-title">
                </div-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!! Form::open(['url'=>'danh_muc_don_vi_quan_ly', 'id' => 'create_dmdvql', 'class'=>'horizontal-form']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên đơn vị<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="tendv" id="tendv" autofocus/>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã quan hệ ngân sách<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="maqhns" id="maqhns">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Phân loại quản lý<span class="require">*</span></label>
                                        <select class="form-control" name="plql" id="plql">
                                            <option value="TC">Tài Chính</option>
                                            <option value="VT">Vận Tải</option>
                                            <option value="CT">Công Thương</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ trụ sở</label>
                                        <input type="text" class="form-control" name="diachi" id="diachi">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Cấp đơn vị</label>
                                        <select class="form-control" name="level" id="level">
                                            <option value="T">Cấp Tỉnh</option>
                                            <option value="H">Cấp quận huyện</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số hồ sơ đã nhận</label>
                                        {!!Form::text('sohsnhan', '0', array('id' => 'sohsnhan','class' => 'form-control','data-mask'=>'fdecimal','style'=>'text-align: right'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Thông tin liên hệ </label>
                                        <textarea id="ttlh" class="form-control" name="ttlh" cols="10" rows="5"
                                                  placeholder="Thông tin, số điện thoại liên lạc với các bộ phận"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Username<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="taikhoan" id="taikhoan">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mật khẩu<span class="require">*</span></label>
                                        {!!Form::text('password', null, array('id' => 'password','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email quản lý<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="email" id="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email quản trị<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="emailqt" id="emailqt">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div style="text-align: center">
                <a href="{{url('danh_muc_don_vi_quan_ly')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create_dmdvql").validate({
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
        $('input[name="taikhoan"]').change(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: '/checktaikhoan',
                data: {
                    _token: CSRF_TOKEN,
                    user:$(this).val()
                },
                success: function (respond) {
                    if(respond != 'ok'){
                        toastr.error("Bạn cần nhập lại username", "Username nhập vào đã tồn tại!!!");
                        $('input[name="taikhoan"]').val('');
                        $('input[name="taikhoan"]').focus();
                    }else
                        toastr.success("Username sử dụng được!", "Thành công!");
                }

            });
        });
        $('input[name="maqhns"]').change(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: '/checkmaqhns',
                data: {
                    _token: CSRF_TOKEN,
                    maqhns:$(this).val()
                },
                success: function (respond) {
                    if(respond != 'ok'){
                        toastr.error("Bạn cần nhập lại mã quan hệ ngân sách", "Mã quan hệ ngân sách nhập vào đã tồn tại!!!");
                        $('input[name="maqhns"]').val('');
                        $('input[name="maqhns"]').focus();
                    }else
                        toastr.success("Mã quan hệ ngân sách sử dụng được!", "Thành công!");
                }

            });
        });
    </script>
    @include('includes.script.create-header-scripts')
@stop