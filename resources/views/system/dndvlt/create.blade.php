@extends('main')

@section('custom-style')

@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <!--cript src="{{url('assets/admin/pages/scripts/form-validation.js')}}"></script-->

@stop

@section('content')
    <h3 class="page-title">
        Thông tin doanh nghiệp dung cấp dịch vụ lưu trú<small> thêm mới</small>
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
                    {!! Form::open(['url'=>'dn_dichvu_luutru', 'id' => 'create_dndvlt', 'class'=>'horizontal-form']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên doanh nghiệp<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="tendn" id="tendn" autofocus/>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã số thuế<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="masothue" id="masothue">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số điện thoại trụ sở chính</label>
                                        <input type="text" class="form-control" name="teldn" id="teldn">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số fax trụ sở chính</label>
                                        <input type="text" class="form-control" name="faxdn" id="faxdn">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ trụ sở</label>
                                        <input type="text" class="form-control" name="diachidn" id="diachidn">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email quản lý</label>
                                        <input type="text" class="form-control" name="email" id="email">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nơi đăng ký nộp thuế</label>
                                        <input type="text" class="form-control" name="noidknopthue" id="noidknopthue">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Giấy phép đăng ký kinh doanh<span class="require">*</span></label>
                                        <input type="text" class="form-control" name="giayphepkd" id="giayphepkd">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Link chia sẻ giấy phép đăng ký kinh doanh<span class="require">*</span></label>
                                        <input type="text" class="form-control" name="tailieu" id="tailieu">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Chức danh người ký</label>
                                        <input type="text" class="form-control required" name="chucdanhky" id="chucdanhky">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Họ và tên người ký</label>
                                        <input type="text" class="form-control" name="nguoiky" id="nguoiky">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa danh</label>
                                        <input type="text" class="form-control" name="diadanh" id="diadanh">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị quản lý:</label>
                                        <select class="form-control select2me required" id="cqcq" name="cqcq">
                                            <option value="">--Chọn đơn vị--</option>
                                            @foreach($modelpb as $ttpb)
                                                <option value="{{$ttpb->maqhns}}">{{$ttpb->tendv}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tài khoản truy cập<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="username" id="username">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mật khẩu<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="password" id="password">
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END FORM-->
                </div>
            </div>

            <div style="text-align: center">
                <a href="{{url('dn_dichvu_luutru')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Hoàn thành</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#create_dndvlt").validate({
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
            $('input[name="masothue"]').blur(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'GET',
                    url: '/checkmasothue',
                    data: {
                        _token: CSRF_TOKEN,
                        masothue:$(this).val(),
                        pl: 'DVLT'
                    },
                    success: function (respond) {
                        if(respond != 'ok'){
                            toastr.error("Bạn cần nhập lại mã số thuế", "Mã số thuế nhập vào đã tồn tại!!!");
                            $('input[name="masothue"]').val('');
                            $('input[name="masothue"]').focus();
                        }else
                            toastr.success("Mã số thuế sử dụng được!", "Thành công!");
                    }

                });
            })
            $('input[name="username"]').change(function(){
                var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
                $.ajax({
                    type: 'GET',
                    url: '/checkuser',
                    data: {
                        _token: CSRF_TOKEN,
                        user:$(this).val()

                    },
                    success: function (respond) {
                        if(respond != 'ok'){
                            toastr.error("Bạn cần nhập tài khoản khác", "Tài khoản nhập vào đã tồn tại!!!");
                            $('input[name="username"]').val('');
                            $('input[name="username"]').focus();
                        }else
                            toastr.success("Tài khoản sử dụng được!", "Thành công!");
                    }

                });
            })
        }(jQuery));
    </script>
@stop