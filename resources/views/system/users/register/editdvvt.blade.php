@extends('main')

@section('custom-style')

@stop


@section('custom-script')
    <script type="text/javascript" src="{{url('assets/global/plugins/jquery-validation/js/jquery.validate.min.js')}}"></script>
    <!--cript src="{{url('assets/admin/pages/scripts/form-validation.js')}}"></script-->
    <link href="{{url('assets/global/plugins/icheck/skins/all.css"')}} rel="stylesheet"/>
    <script>
        function getId(id){
            document.getElementById("idregister").value=id;
        }
        function ClickCreate(){
            $('#frm_create').submit();
        }
    </script>

@stop

@section('content')
    <h3 class="page-title">
        Chỉnh sửa thông tin doanh nghiệp dung cấp dịch vụ vận tải<small> đăng ký tài khoản</small>
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
                    {!! Form::model($model, ['method' => 'PATCH', 'url'=>'users/register/dvvt/'. $model->id, 'class'=>'horizontal-form','id'=>'update_register']) !!}
                    <!-- BEGIN FORM-->
                        <meta name="csrf-token" content="{{ csrf_token() }}" />
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tên doanh nghiệp<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="tendn" id="tendn" value="{{$model->tendn}}" autofocus>
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Mã số thuế<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="masothue" id="masothue" value="{{$model->masothue}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số điện thoại trụ sở chính</label>
                                        <input type="text" class="form-control required" name="teldn" id="teldn" value="{{$model->tel}}">
                                    </div>
                                </div>
                                <!--/span-->
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Số fax trụ sở chính</label>
                                        <input type="text" class="form-control required" name="faxdn" id="faxdn" value="{{$model->fax}}">
                                    </div>
                                </div>
                                <!--/span-->
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Email</label>
                                        <input type="text" class="form-control required" name="emaildn" id="emaildn" value="{{$model->email}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Địa chỉ trụ sở</label>
                                        <input type="text" class="form-control required" name="diachidn" id="diachidn" value="{{$model->diachi}}">
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Nơi đăng ký nộp thuế</label>
                                        <input type="text" class="form-control required" name="noidknopthue" id="noidknopthue" value="{{$model->noidknopthue}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Giấy phép kinh doanh</label>
                                        <input type="text" class="form-control required" name="giayphepkd" id="giayphepkd" value="{{$model->giayphepkd}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Cung cấp dịch vụ</label>
                                        <div class="input-group">
                                            <div class="icheck-inline">
                                                <label>
                                                    <input type="checkbox" value="1" {{$model->dvxk == 1 ? 'checked' : ''}} name="roles[dvvt][vtxk]"> Vận tải xe khách </label>
                                                <label>
                                                    <input type="checkbox" value="1" {{$model->dvxb == 1 ? 'checked' : ''}} name="roles[dvvt][vtxb]"> Vận tải xe buýt </label>
                                                <label>
                                                    <input type="checkbox" value="1" {{$model->dvxtx == 1 ? 'checked' : ''}} name="roles[dvvt][vtxtx]"> Vận tải xe taxi </label>
                                                <label>
                                                    <input type="checkbox" value="1" {{$model->dvk == 1 ? 'checked' : ''}} name="roles[dvvt][vtch]"> Vận tải chở hàng</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Link giấy phép đăng ký kinh doanh<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="tailieu" id="tailieu" value="{{$model->tailieu}}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Cơ quan chủ quản</label>
                                        <select class="form-control" id="cqcq" name="cqcq">
                                            @foreach($cqcq as $tt)
                                                <option value="{{$tt->maqhns}}" {{($tt->maqhns == $model->cqcq) ? 'selected' : ''}} >{{$tt->tendv}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label">Tài khoản truy cập<span class="require">*</span></label>
                                        <input type="text" class="form-control required" name="username" id="username" value="{{$model->username}}">
                                    </div>
                                </div>

                            </div>
                        </div>
                    <!-- END FORM-->
                </div>
            </div>
            <div class="row" style="text-align: center">
                <div class="cod-md-12">
                    <a href="{{url('users/register?&phanloai=DVVT')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                    <button type="submit" class="btn green" onclick="validateForm()"><i class="fa fa-check"></i> Cập nhật</button>
                </div>
            </div>
            {!! Form::close() !!}
            <!-- END VALIDATION STATES-->
        </div>
    </div>
    <div class="clearfix"></div>
    <script type="text/javascript">
        function validateForm(){
            var validator = $("#update_register").validate({
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
        $('input[name="masothue"]').change(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: '/checkrgmasothue',
                data: {
                    _token: CSRF_TOKEN,
                    masothue:$(this).val(),
                    pl: 'DVVT'
                },
                success: function (respond) {
                    //alert(respond);
                    if(respond != 'ok'){
                        toastr.error("Bạn cần nhập lại mã số thuế", "Mã số thuế nhập vào đã tồn tại hoặc đã được đăng ký!!!");
                        $('input[name="masothue"]').val('');
                        $('input[name="masothue"]').focus();
                    }else
                        toastr.success("Mã số thuế sử dụng được!", "Thành công!");
                }
            });
        });

        $('input[name="username"]').change(function(){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                type: 'GET',
                url: '/checkrguser',
                data: {
                    _token: CSRF_TOKEN,
                    user:$(this).val(),
                    pl: 'DVLT'
                },
                success: function (respond) {
                    if(respond != 'ok'){
                        toastr.error("Bạn cần nhập lại tài khoản đăng ký", "Tài khoản đăng ký nhập vào đã tồn tại hoặc đã được đăng ký!!!");
                        $('input[name="username"]').val('');
                        $('#username').focus();
                    }else
                        toastr.success("Tài khoản đăng ký sử dụng được!", "Thành công!");
                }

            });
        });
    </script>


@stop