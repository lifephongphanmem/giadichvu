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
        function ClickCreate(){
            document.getElementById("macskdcreate").value =$('#macskd').val();
            document.getElementById("masothuecreate").value =$('#macskd').val();
        }
        function ConfirmCreate(){
            $('#frm_create').submit();
        }
        function ClickEdit(id){
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/doi_tuong_ap_dung/edit',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        $('#ttdoituong').replaceWith(data.message);
                    }
                    else
                        toastr.error("Không thể chỉnh sửa thông tin đối tượng áp dụng!", "Lỗi!");
                }
            })
        }
        function ClickDelete(id){
            document.getElementById("iddelete").value =id;

        }
        function ConfirmDelete(){
            $('#frm_delete').submit();
        }


    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin đối tượng<small>&nbsp;áp dụng</small> - Cơ sở kinh doanh <small>{{$modelcskd->tencskd}}</small>
    </h3>
    <input type="hidden" name="macskd" id="macskd" value="{{$macskd}}">
    <input type="hidden" name="masothue" id="macskd" value="{{$modelcskd->masothue}}">



    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <button type="button" onclick="ClickCreate()" class="btn btn-default btn-xs mbs" data-target="#create-modal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;
                            Thêm mới</button>

                    </div>

                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Tên đối tượn áp dung</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td>{{$tt->tendoituong}}</td>
                                <td>
                                    <button type="button" onclick="ClickEdit('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#edit-modal" data-toggle="modal"><i class="fa fa-edit"></i>&nbsp;
                                        Chỉnh sửa</button>
                                    <button type="button" onclick="ClickDelete('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
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
    <!--Model create-->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'doi_tuong_ap_dung','id' => 'frm_create'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Giá áp dụng cho loại đối tượng</h4>
                    </div>

                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Đối tượng áp dụng</b></label>
                            <textarea id="tendoituong" class="form-control required" name="tendoituong" cols="30" rows="5" placeholder="Giá áp dụng cho loại đối tượng"></textarea></div>
                    </div>
                    <input type="hidden" name="macskdcreate" id="macskdcreate">
                    <input type="hidden" name="masothuecreate" id="masothuecreate">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ConfirmCreate()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!--Model edit-->
        <div class="modal fade" id="edit-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'doi_tuong_ap_dung/update','id' => 'frm_create'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Chỉnh sửa giá áp dụng cho loại đối tượng</h4>
                    </div>
                    <div id= "ttdoituong">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ConfirmCreate()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

        <!--Modal delete-->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'doi_tuong_ap_dung/delete','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="iddelete" id="iddelete">
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ConfirmDelete()">Đồng ý</button>

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>



@stop