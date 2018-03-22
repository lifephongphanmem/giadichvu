@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
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

@stop

@section('content')

    <h3 class="page-title">
        Cấu hình <small>&nbsp;chức năng của chương trình</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">

        <div class="col-md-12">

            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            {!! Form::open(['url' => 'setting'])!!}
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label class="control-label">Url trang công bố<span class="require">*</span></label>
                        {!!Form::text('urlwebcb', $model->urlwebcb, array('id' => 'urlwebcb','class' => 'form-control','autofocus'))!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Thời hạn duyệt hồ sơ dvlt<span class="require">*</span></label>
                        {!!Form::text('thoihan_lt', $model->thoihan_lt, array('id' => 'thoihan_lt','class' => 'form-control','autofocus'))!!}
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Thời hạn duyệt hồ sơ dvvt<span class="require">*</span></label>
                        {!!Form::text('thoihan_vt', $model->thoihan_vt, array('id' => 'thoihan_vt','class' => 'form-control','autofocus'))!!}
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Thời hạn duyệt hồ sơ giá sữa<span class="require">*</span></label>
                        {!!Form::text('thoihan_ct', $model->thoihan_ct, array('id' => 'thoihan_ct','class' => 'form-control','autofocus'))!!}
                    </div>
                </div>
            </div>
            <div class="portlet box blue">

                <div class="portlet-body">
                        <div class="table-toolbar">
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <h4 style="text-align: center">Dịch vụ lưu trú</h4>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="table-checkbox" width="5%">
                                            <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                        </th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvlt->dvlt) && $setting->dvlt->dvlt == 1) ? 'checked' : '' }} value="1" name="roles[dvlt][dvlt]"/></td>
                                        <td>Dịch vụ lưu trú</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <h4 style="text-align: center">Dịch vụ vận tải</h4>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="table-checkbox" width="5%">
                                            <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                        </th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvvt->vtxk) && $setting->dvvt->vtxk == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxk]"/></td>
                                        <td>Vận tải xe khách</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvvt->vtxb) && $setting->dvvt->vtxb == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxb]"/></td>
                                        <td>Vận tải xe buýt</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvvt->vtxtx) && $setting->dvvt->vtxtx == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtxtx]"/></td>
                                        <td>Vận tải xe taxi</td>
                                    </tr>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvvt->vtch) && $setting->dvvt->vtch == 1) ? 'checked' : '' }} value="1" name="roles[dvvt][vtch]"/></td>
                                        <td>Vận tải chở hàng</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <h4 style="text-align: center">Kê khai giá sữa</h4>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="table-checkbox" width="5%">
                                            <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                        </th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvgs->dvgs) && $setting->dvgs->dvgs == 1) ? 'checked' : '' }} value="1" name="roles[dvgs][dvgs]"/></td>
                                        <td>Kê khai giá sữa</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-3">
                                <h4 style="text-align: center">Kê khai giá thức ăn chăn nuôi</h4>
                                <table class="table table-striped table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th class="table-checkbox" width="5%">
                                            <!--input type="checkbox" class="group-checkable" data-set="#sample_3 .checkboxes"/-->
                                        </th>
                                        <th>Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td><input type="checkbox" {{ (isset($setting->dvtacn->dvtacn) && $setting->dvtacn->dvtacn == 1) ? 'checked' : '' }} value="1" name="roles[dvtacn][dvtacn]"/></td>
                                        <td>Kê khai thức ăn chăn nuôi</td>
                                    </tr>

                                    </tbody>
                                </table>
                            </div>

                        </div>

                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->

            </div>
        </div>
        <div class="row" style="text-align: center">
            <div class="col-md-12">
                <a href="{{url('cau_hinh_he_thong')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                <button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i>&nbsp;Nhập lại</button>
                <button type="submit" class="btn btn-primary"><i class="fa fa-check"></i> Cập nhật</button>
            </div>
        </div>
        {!! Form::close() !!}

        <!-- BEGIN DASHBOARD STATS -->

        <!-- END DASHBOARD STATS -->
        <div class="clearfix"></div>



@stop