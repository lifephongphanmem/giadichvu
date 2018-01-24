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
        Thông tin đơn vị quản lý<small> chỉnh sửa</small>
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
                    {!! Form::model($model, ['method' => 'PATCH', 'url'=>'cau_hinh_he_thong/'. $model->id, 'class'=>'horizontal-form','id'=>'update_tttaikhoan']) !!}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mã quan hệ ngân sách</label>
                                    {!!Form::text('maqhns', null, array('id' => 'maqhns','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên đơn vị<span class="require">*</span></label>
                                    {!!Form::text('tendv', null, array('id' => 'tendv','class' => 'form-control required','autofocus'))!!}
                                </div>
                            </div>
                        </div>
                        @if(session('admin')->sadmin == 'ssa')
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Phân loại quản lý</label>
                                    <select class="form-control" name="plql" id="plql">
                                        <option value="TC" {{($model->plql == 'TC' ? 'selected' : '')}}>Tài Chính</option>
                                        <option value="VT" {{($model->plql == 'VT' ? 'selected' : '')}}>Vận Tải</option>
                                        <option value="CT" {{($model->plql == 'CT' ? 'selected' : '')}}>Công Thương</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Cấp đơn vị</label>
                                    <select class="form-control" name="level" id="level">
                                        <option value="T" {{($model->level == 'T' ? 'selected' : '')}}>Cấp Tỉnh</option>
                                        <option value="H" {{($model->level == 'H' ? 'selected' : '')}}>Cấp quận huyện</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ<span class="require">*</span></label>
                                    {!!Form::text('diachi', null, array('id' => 'diachi','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số hồ sơ đã nhận</label>
                                    {!!Form::text('sohsnhan', null, array('id' => 'sohsnhan','class' => 'form-control','data-mask'=>'fdecimal','style'=>'text-align: right'))!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Thông tin liên hệ </label>
                                        <textarea id="ttlh" class="form-control" name="ttlh" cols="10" rows="5"
                                                  placeholder="Thông tin, số điện thoại liên lạc với các bộ phận">{{$model->ttlh}}</textarea>
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
                                    <label class="control-label">Email quản trị<span class="require">*</span></label>
                                    {!!Form::text('emailqt', null, array('id' => 'emailqt','class' => 'form-control required'))!!}
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- END FORM-->
                </div>
            </div>

            <div style="text-align: center">
                <a href="{{url('cau_hinh_he_thong')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
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
            $('input[name="maqhns"]').blur(function(){
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
            })
        }(jQuery));
    </script>
    @include('includes.script.create-header-scripts')
@stop