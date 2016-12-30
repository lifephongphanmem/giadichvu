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
                var macskd = $('#masothue').val();
                var url = '{{$url}}'+'tim_kiem/masothue='+macskd+'&nam='+namhs;
                window.location.href = url;
            });
            $('#masothue').change(function(){
                var namhs = $('#namhs').val();
                var macskd = $('#masothue').val();
                var url = '{{$url}}'+'tim_kiem/masothue='+macskd+'&nam='+namhs;
                window.location.href = url;
            });
        });
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Tìm kiếm thông tin giá vận tải hành khách bằng<small>&nbsp;xe taxi</small>
    </h3>
    @include('manage.dvvt.template.search')
@stop


