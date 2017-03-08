<?php
/**
 * Created by PhpStorm.
 * User: MyloveCoi
 * Date: 18/04/2016
 * Time: 10:43 AM
 */
 ?>
@extends('main')

@section('custom-style')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>

@stop

@section('custom-script')
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
    <h3>{{$tendonvi}} - Kê khai giá vận tải hành khách bằng xe ôtô<small> theo tuyến cố định</small></h3>
    <div class="row">
        <div class="col-md-12">
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        @if($per['create'])
                            <a href="{{url($url.'ke_khai/create/ma_so='.$masothue)}}" class="btn btn-default btn-sm"><i class="fa fa-plus"></i> Kê khai giá mới</a>
                        @endif
                    </div>
                    @include('manage.dvvt.template.indexkkdv_boloc')
                </div>
                @include('manage.dvvt.template.indexkkdv')
            </div>
        </div>
    </div>

    <script>
        $(function(){
            $('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var url = '{{$url}}' + 'ke_khai/nam='+namhs;
                window.location.href = url;
            });
        });

        function InChiTiet(masokk){
            var url='{{$url}}'+'in/ma_so='+ masokk;
            window.open(url,'_blank');
        }

        function InPAG(masokk){
            var url='{{$url}}'+'inPAG/ma_so='+ masokk;
            window.open(url,'_blank');
        }
    </script>
    @include('manage.dvvt.template.modal-delete')
    @include('manage.dvvt.template.modal-chuyen')
    @include('manage.dvvt.template.modal-tralai')
@stop


