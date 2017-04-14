@extends('main')

@section('custom-style')
    <!-- put the custom style for this page here -->
@stop


@section('custom-script')
    <!-- put the custom script for this page here -->
    <script type="text/javascript" src="{{ url('vendors/jquery-validate/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ url('js/form-validation.js') }}"></script>
@stop

@section('content')
    <h3 class="page-title">
        Thông tin doanh nghiệp cung cấp dịch vụ vận tải<small> chỉnh sửa</small>
    </h3>
    <div class="row center">
        <div class="col-md-12 center">
            <!-- BEGIN VALIDATION STATES-->
            <div class="portlet box blue">
                <!--div class="portlet-title">
                </div-->
                <div class="portlet-body form">
                    <!-- BEGIN FORM-->
                    {!! Form::model($model, ['method' => 'PATCH', 'url'=>'dich_vu_van_tai/thong_tin_don_vi/'. $model->id.'/capnhat', 'class'=>'horizontal-form','id'=>'update_ttdndvvt']) !!}
                    <meta name="csrf-token" content="{{ csrf_token() }}" />
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Mã số thuế</label>
                                    {!!Form::text('masothue', null, array('id' => 'masothue','class' => 'form-control','readonly'=>'true'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên doanh nghiệp<span class="require">*</span></label>
                                    {!!Form::text('tendn', null, array('id' => 'tendn','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <!--/span-->

                            <!--/span-->
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số điện thoại trụ sở chính</label>
                                    {!!Form::text('tel', null, array('id' => 'dienthoai','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Số fax trụ sở chính</label>
                                    {!!Form::text('fax', null, array('id' => 'fax','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ trụ sở<span class="require">*</span></label>
                                    {!!Form::text('diachi', null, array('id' => 'diachi','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Nơi đăng ký nộp thuế<span class="require">*</span></label>
                                    {!!Form::text('noidknopthue', null, array('id' => 'dknopthue','class' => 'form-control'))!!}
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
                                    <label class="control-label">Chức danh người ký<span class="require">*</span></label>
                                    {!!Form::text('chucdanhky', null, array('id' => 'chucdanh','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Họ và tên người ký<span class="require">*</span></label>
                                    {!!Form::text('nguoiky', null, array('id' => 'nguoiky','class' => 'form-control'))!!}
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Trang chủ<span class="require">*</span></label>
                                    {!!Form::text('link', null, array('id' => 'link','class' => 'form-control'))!!}
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Địa danh<span class="require">*</span></label>
                                    {!!Form::text('diadanh', null, array('id' => 'diadanh','class' => 'form-control'))!!}
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Cung cấp dịch vụ</label>
                                    <div class="input-group">
                                        <div class="icheck-inline">
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtxk) && $setting->dvvt->vtxk == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxk]"/> Vận tải xe khách </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtxb) && $setting->dvvt->vtxb == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxb]"/> Vận tải xe buýt </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtxtx) && $setting->dvvt->vtxtx == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxtx]"/> Vận tải xe taxi </label>
                                            <label>
                                                <input type="checkbox" {{ (isset($setting->dvvt->vtch) && $setting->dvvt->vtch == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtch]"/> Vận tải chở hàng</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @if(session('admin')->level == 'T' || session('admin') == 'H')
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Đơn vị quản lý<span class="require">*</span></label>
                                        <select class="form-control" name="cqcq" id="cqcq" required>
                                            <option value="">--Chọn đơn vị quản lý--</option>
                                            @foreach($ttcqcq as $tt)
                                                <option value="{{$tt->maqhns}}" {{($tt->maqhns == $model->cqcq) ? 'selected' : ''}}>{{$tt->tendv}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @else
                                <input type="hidden" name="cqcq" id="cqcq" value="{{$model->cqcq}}">
                                <input type="hidden" name="masothue" id="masothue" value="{{$model->masothue}}">
                            @endif
                        </div>
                    </div>
                    <!-- END FORM-->
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="col-md-12">
                    <a href="{{url('dich_vu_van_tai/thong_tin_don_vi')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
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

            var validator = $("#update_ttdndvvt").validate({
                rules: {
                    name :"required"
                },
                messages: {
                    name :"Chưa nhập dữ liệu"
                }
            });
        }
    </script>
@stop

