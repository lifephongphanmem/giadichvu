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
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        $(function(){
            $('#phanloai').change(function() {
                var current_path_url = '/xetduyet_thaydoi_ttdoanhnghiep?';
                var pl = '&phanloai='+$('#phanloai').val();
                var url = current_path_url+pl;
                window.location.href = url;
            });
        })
        function ClickDelete(){
            $('#frm_delete').submit();
        }
    </script>
@stop

@section('content')
    <h3 class="page-title">
        Quản lý thay đổi <small>&nbsp;thông tin doanh nghiệp</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-body">
                    @if(session('admin')->sadmin == 'ssa' || session('admin')->sadmin == 'sa')
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <select class="form-control" name="phanloai" id="phanloai">
                                    @if(canGeneral('dvlt','dvlt') )
                                    <option value="DVLT" {{($phanloai == "DVLT") ? 'selected' : ''}}>Dịch vụ lưu trú</option>
                                    @endif
                                    @if(canGeneral('dvvt','vtxk') || canGeneral('dvvt','vtxb') || canGeneral('dvvt','vtxtx') || canGeneral('dvvt','vtch'))
                                    <option value="DVVT" {{($phanloai == "DVVT") ? 'selected' : ''}}>Dịch vụ vận tải</option>
                                    @endif
                                    @if(canGeneral('dvgs','dvgs'))
                                    <option value="DVGS" {{($phanloai == "DVGS") ? 'selected' : ''}}>Dịch vụ giá sữa</option>
                                    @endif
                                    @if(canGeneral('dvtacn','dvtacn'))
                                    <option value="DVTACN" {{($phanloai == "DVTACN") ? 'selected' : ''}}>Dịch vụ thức ăn chăn nuôi</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="portlet-body">
                        <div class="table-toolbar">

                        </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Ngày thay đổi</th>
                            <th style="text-align: center">Tên doanh nghiệp</th>
                            <th style="text-align: center">Mã số thuế</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr class="odd gradeX">
                                <td style="text-align: center">{{$key + 1}}</td>
                                <td style="text-align: center">{{getDateTime($tt->updated_at)}}</td>
                                <td class="active" >{{$tt->tendn}}</td>
                                <td>{{$tt->masothue}}</td>
                                <td>
                                    <a href="{{url('xetduyet_thaydoi_ttdoanhnghiep/'.$tt->id)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                        Xóa</button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
            <!-- END EXAMPLE TABLE PORTLET-->
        </div>
    </div>

    <!-- BEGIN DASHBOARD STATS -->

    <!-- END DASHBOARD STATS -->

    <div class="clearfix"></div>
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'xetduyet_thaydoi_thongtindoanhnghiep/delete','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input hidden type="text" name="iddelete" id="iddelete">
                <div class="modal-footer">
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>


@stop