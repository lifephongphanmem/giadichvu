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
        function  getSelectedCheckboxes(){

            var ids = '';
            $.each($("input[name='ck_value']:checked"), function(){
                ids += ($(this).attr('value')) + '-';
            });
            return ids = ids.substring(0, ids.length - 1);

        }
        function multiLock() {

            var ids = getSelectedCheckboxes();
            if(ids == '') {
                $('#btnMultiLockUser').attr('data-target', '#notid-modal-confirm');
            }else {

                $('#btnMultiLockUser').attr('data-target', '#lockuser-modal-confirm');
                $('#frmLockUser').attr('action', "{{ url('users/lock')}}/" + ids);
            }

        }
        function multiUnLock() {

            var ids = getSelectedCheckboxes();
            if(ids == '') {
                $('#btnMultiUnLockUser').attr('data-target', '#notid-modal-confirm');
            }else {
                $('#btnMultiUnLockUser').attr('data-target', '#unlockuser-modal-confirm');
                $('#frmUnLockUser').attr('action', "{{ url('users/unlock')}}/" + ids);
            }

        }

        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        $(function(){

            $('#phanloai').change(function() {
                var pl = $('#phanloai').val();
                var url = '/users/pl='+pl;

                //var url = current_path_url;
                window.location.href = url;
            });
            $('#dvct').change(function() {
                var dvct = $('#dvct').val();
                var url = '/users/pl=su-dung/dv='+dvct;

                //var url = current_path_url;
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
        Thông tin doanh nghiêp cung cấp <small>&nbsp;dịch vụ lưu trú</small>
    </h3>
    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <!--a href="{{url('dn_dichvu_luutru/create')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Thêm mới </a-->
                            <a href="{{url('dn_dichvu_luutru/print')}}" class="btn btn-default btn-sm" target="_blank">
                                <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Tên doanh nghiệp</th>
                            <th style="text-align: center">Mã số thuế</th>
                            <th style="text-align: center">Số điện thoại<br>trụ sở</th>
                            <th style="text-align: center">Số fax trụ sở</th>
                            <th style="text-align: center">Địa chỉ trụ sở</th>
                            <th style="text-align: center" width="20%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                        <tr class="odd gradeX">
                            <td style="text-align: center">{{$key + 1}}</td>
                            <td class="active" >{{$tt->tendn}}</td>
                            <td>{{$tt->masothue}}</td>
                            <td>{{$tt->teldn}}</td>
                            <td>{{$tt->faxdn}}</td>
                            <td>{{$tt->diachidn}}</td>
                            <td>
                                <a href="{{url('dn_dichvu_luutru/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                @if(session('admin')->sadmin =='ssa')
                                <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                    Xóa</button>
                                @endif
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
                    {!! Form::open(['url'=>'dn_dichvu_luutru/delete','id' => 'frm_delete'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý xóa?</h4>
                    </div>
                    <input type="hidden" name="iddelete" id="iddelete">
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
    </div>

    @include('includes.e.modal-confirm')


@stop