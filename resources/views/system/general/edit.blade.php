@extends('main')

@section('custom-style')

@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <!--cript src="{{url('assets/admin/pages/scripts/form-validation.js')}}"></script-->

@stop

@section('content')


    <h3 class="page-title">
        Cấu hình hệ thống<small> chỉnh sửa</small>
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
                    {!! Form::model($model,['url'=>'cau_hinh_he_thong/'. $model->id, 'class'=>'horizontal-form','id'=>'update_tthethong']) !!}
                            <meta name="csrf-token" content="{{ csrf_token() }}" />
                            <input type="hidden" name="_method" value="PATCH">
                            <input type="hidden" name="_token" value="{{ csrf_token()}}">
                        <div class="form-body">
                            <div class="row">
                                <!--div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã quan hệ ngân sách<span class="require">*</span></label>
                                        {!!Form::text('maqhns', null, array('id' => 'maqhns','class' => 'form-control', 'readonly'))!!}
                                    </div>
                                </div-->
                                @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị quản lý<span class="require">*</span></label>
                                        {!!Form::text('tendonvilt', null, array('id' => 'tendonvilt','class' => 'form-control', 'readonly'))!!}
                                    </div>
                                </div>
                                @endif
                                <!--/span-->
                                @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'savt')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị quản lý<span class="require">*</span></label>
                                        {!!Form::text('tendonvivt', null, array('id' => 'tendonvivt','class' => 'form-control', 'readonly'))!!}
                                    </div>
                                </div>
                                @endif
                                <!--/span-->
                            </div>
                            <!--div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ</label>
                                        {!!Form::text('diachi', null, array('id' => 'diachi','class' => 'form-control'))!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Thủ trưởng đơn vị</label>
                                        {!!Form::text('thutruong', null, array('id' => 'thutruong','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Kế toán</label>
                                        {!!Form::text('ketoan', null, array('id' => 'ketoan','class' => 'form-control'))!!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Người lập biểu</label>
                                        {!!Form::text('nguoilapbieu', null, array('id' => 'nguoilapbieu','class' => 'form-control'))!!}
                                    </div>
                                </div>
                            </div-->
                            <!--div class="row">
                                @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'salt')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số hồ sơ đã nhận dịch vụ lưu trú</label>
                                        {!!Form::text('sodvlt', null, array('id' => 'sodvlt','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                    </div>
                                </div>
                                @endif
                                @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'savt')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số hồ sơ đã nhận dịch vụ vận tải</label>
                                        {!!Form::text('sodvvt', null, array('id' => 'sodvvt','class' => 'form-control','data-mask'=>'fdecimal'))!!}
                                    </div>
                                </div>
                                @endif
                            </div-->
                            @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'satc')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Thông tin liên lạc dịch vụ lưu trú</label>
                                        <textarea id="ttlhlt" class="form-control" name="ttlhlt" cols="10" rows="5"
                                                  placeholder="Thông tin, số điện thoại liên lạc với các bộ phận">{{$model->ttlhlt}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'savt')
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label class="control-label">Thông tin liên lạc dịch vụ vận tải</label>
                                        <textarea id="ttlhvt" class="form-control" name="ttlhvt" cols="10" rows="5"
                                                  placeholder="Thông tin, số điện thoại liên lạc với các bộ phận">{{$model->ttlhvt}}</textarea>
                                    </div>
                                </div>
                            </div>
                            @endif

                        </div>

                    <!-- END FORM-->
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">
                    <a href="{{url('cau_hinh_he_thong')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                    <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <script type="text/javascript">
        function validateForm(){

            var validator = $("#update_tthethong").validate({
                rules: {
                    ten:"required"
                },
                messages: {
                    ten: "Chưa nhập dữ liệu",
                }
            });
        }
    </script>
@stop