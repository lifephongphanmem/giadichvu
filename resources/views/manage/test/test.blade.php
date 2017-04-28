@extends('main')

@section('custom-style')
@stop


@section('custom-script')
    <!-- BEGIN PAGE LEVEL PLUGINS -->
    <script src="{{url('minhtran/jquery.min.js')}}"></script>
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>


    <!-- END PAGE LEVEL PLUGINS -->

    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>

@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai hồ sơ<small>&nbsp;giá dịch vụ lưu trú</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        {!! Form::open(['url'=>'testday', 'id' => 'create_kkdvlt', 'class'=>'horizontal-form']) !!}
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->

                <!-- BEGIN PORTLET-->

                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                            <div class="form-body">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Default Datepicker</label>
                                    <div class="col-md-3">
                                        {!!Form::text('ngaynhap',\Carbon\Carbon::now()->format('d/m/Y'), array('id' => 'ngaynhap','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3">Default Datepicker</label>
                                    <div class="col-md-3">
                                        {!!Form::text('ngayapdung',null, array('id' => 'ngayapdung','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
                                    </div>
                                </div>

                            </div>

                        <!-- END FORM-->
                    </div>
                    <button type="submit" class="btn green"><i class="fa fa-check"></i> Hoàn thành</button>
                <!-- END PORTLET-->
                    {!! Form::close() !!}
                    <!--/row-->



            </div>


            <!-- END EXAMPLE TABLE PORTLET-->

        </div>


    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->
    <div class="clearfix">
    </div>

    <!--Validate Form-->






@stop