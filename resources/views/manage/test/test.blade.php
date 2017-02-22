@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css')}}"/>
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script type="text/javascript" src="{{url('assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js')}}"></script>
    <script src="{{url('assets/admin/pages/scripts/components-pickers.js')}}"></script>

    <!-- END PAGE LEVEL PLUGINS -->

<script>
    jQuery(document).ready(function() {
        ComponentsPickers.init();
    });
</script>

@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai hồ sơ<small>&nbsp;giá dịch vụ lưu trú</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru', 'id' => 'create_kkdvlt', 'class'=>'horizontal-form']) !!}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

                <!-- BEGIN PORTLET-->

                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Default Datepicker</label>
                                    <div class="col-md-3">
                                        <input class="form-control form-control-inline input-medium date-picker" size="16" type="text" value=""/>
                                    <span class="help-block">
                                    Select date </span>
                                    </div>
                                </div>

                            </div>

                        <!-- END FORM-->
                    </div>
                <!-- END PORTLET-->
                    {!! Form::close() !!}
                    <!--/row-->



                </div>


            <!-- END EXAMPLE TABLE PORTLET-->

        </div>

    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>

    <!--Validate Form-->






@stop