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

        $(function(){
            $('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var thanghs = $('#thanghs').val();
                var pl = $('#pl').val();
                var url = '{{$url}}'+'xet_duyet/thang='+thanghs+'&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });
            $('#thanghs').change(function() {
                var namhs = $('#namhs').val();
                var thanghs = $('#thanghs').val();
                var pl = $('#pl').val();
                var url = '{{$url}}'+'xet_duyet/thang='+thanghs+'&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });
            $('#pl').change(function() {
                var namhs = $('#namhs').val();
                var thanghs = $('#thanghs').val();
                var pl = $('#pl').val();
                var url = '{{$url}}'+'xet_duyet/thang='+thanghs+'&nam='+namhs+'&pl='+pl;

                window.location.href = url;
            });

        });
    </script>

@stop

@section('content')
    <h3 class="page-title">
        Thông tin kê khai giá dịch vụ vận tải<small> khác</small>
    </h3>
    @include('manage.dvvt.template.indexkkdvth')
    @include('manage.dvvt.template.modal-chuyen')
    @include('manage.dvvt.template.modal-tralai')
    @include('manage.dvvt.template.modal-nhanhs')
@stop


