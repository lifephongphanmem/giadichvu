@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <script type="text/javascript" src="{{url('assets/global/plugins/select2/select2.min.js')}}"></script>

@stop

@section('content')


    <h3 class="page-title">
        Thông tin doanh nghiệp cung cấp dịch vụ lưu trú<small> chỉnh sửa</small>
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
                    {!! Form::model($model, ['method' => 'PATCH', 'url'=>'dn_dichvu_luutru/'. $model->id, 'class'=>'horizontal-form','id'=>'update_tttaikhoan']) !!}
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên doanh nghiệp<span class="require">*</span></label>
                                        {!!Form::text('tendn', null, array('id' => 'tendn','class' => 'form-control required','autofocus'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã số thuế</label>
                                        {!!Form::text('masothue', null, array('id' => 'masothue','class' => 'form-control'))!!}
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số điện thoại trụ sở chính</label>
                                        {!!Form::text('teldn', null, array('id' => 'teldn','class' => 'form-control'))!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số fax trụ sở chính</label>
                                        {!!Form::text('faxdn', null, array('id' => 'faxdn','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ trụ sở<span class="require">*</span></label>
                                        {!!Form::text('diachidn', null, array('id' => 'diachidn','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email quản lý<span class="require">*</span></label>
                                        {!!Form::text('email', null, array('id' => 'email','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nơi đăng ký nộp thuế<span class="require">*</span></label>
                                        {!!Form::text('noidknopthue', null, array('id' => 'noidknopthue','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Giấy phép đăng ký kinh doanh<span class="require">*</span></label>
                                        {!!Form::text('giayphepkd', null, array('id' => 'giayphepkd','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Link chia sẻ giấy phép đăng ký kinh doanh<span class="require">*</span></label>
                                        {!!Form::text('tailieu', null, array('id' => 'tailieu','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị trục thuộc</label>
                                        <select class="form-control select2me required" id="cqcq" name="cqcq">
                                            <option value="">--Chọn đơn vị--</option>
                                            @foreach($modelpb as $ttpb)
                                                <option value="{{$ttpb->maqhns}}" {{$ttpb->maqhns == $model->cqcq ? 'selected' : ''}}>{{$ttpb->tendv}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Chức danh người ký<span class="require">*</span></label>
                                        {!!Form::text('chucdanhky', null, array('id' => 'chucdanhky','class' => 'form-control required'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Họ và tên người ký<span class="require">*</span></label>
                                        {!!Form::text('nguoiky', null, array('id' => 'nguoiky','class' => 'form-control'))!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa danh<span class="require">*</span></label>
                                        {!!Form::text('diadanh', null, array('id' => 'diadanh','class' => 'form-control required'))!!}
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
                <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_tttaikhoan").validate({
                rules: {
                    name :"required",
                },
                messages: {
                    name :"Chưa nhập dữ liệu",
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
        }(jQuery));
    </script>
@stop