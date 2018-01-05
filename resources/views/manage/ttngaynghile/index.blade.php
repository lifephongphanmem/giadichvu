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
    <!--Date new-->
    <!--script src="{{url('minhtran/jquery.min.js')}}"></script-->
    <script src="{{url('minhtran/jquery.inputmask.bundle.min.js')}}"></script>

    <script>
        $(document).ready(function(){
            $(":input").inputmask();
        });
    </script>
    <!--End date new-->
    <script>
        jQuery(document).ready(function() {
            TableManaged.init();
        });
        $(function(){

            $('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var url = '/thongtinngaynghile?&nam='+namhs;

                window.location.href = url;
            });

        });
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }
        function ClickCreate(){
            var str = '';
            var ok = true;

            if($('#mota').val()==''){
                str += ' - Mô tả<br>';
                ok = false;
            }
            if($('#tungay').val()==''){
                str += ' - Từ ngày<br>';
                ok = false;
            }
            if($('#denngay').val()==''){
                str += '  - Đến ngày <br>';
                ok = false;
            }
            if ( ok == false){
                toastr.error("Thông tin không được để trống <br>" + str , "Lỗi!");
                $("#frm_create").submit(function (e) {
                    e.preventDefault();
                });
            }
            else{
                $("#frm_create").unbind('submit').submit();
            }
        }

    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin<small>&nbsp;ngày nghỉ lễ</small>
    </h3>

    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <button type="button" class="btn btn-default btn-sm" data-target="#create-modal" data-toggle="modal"><i class="fa fa-plus"></i>&nbsp;Thêm mới</button>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <select name="namhs" id="namhs" class="form-control">
                                        @if ($nam_start = intval(date('Y')) - 5 ) @endif
                                        @if ($nam_stop = intval(date('Y')) + 1 ) @endif
                                        @for($i = $nam_start; $i <= $nam_stop; $i++)
                                            <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center">Mô tả</th>
                            <th style="text-align: center">Áp dụng từ ngày</th>
                            <th style="text-align: center">Áp dụng đến ngày</th>
                            <th style="text-align: center">Số ngày nghỉ</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td>{{$tt->mota}}</td>
                                <td>{{getDayVn($tt->ngaytu)}}</td>
                                <td>{{getDayVn($tt->ngayden)}}</td>
                                <td>{{$tt->songaynghi}}</td>
                                <td>


                                <a href="{{url('ke_khai_dich_vu_luu_tru/khach_san/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>

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
    <!--Model create-->
        <div id="create-modal" tabindex="-1" role="dialog" aria-hidden="true" class="modal fade">
            <div class="modal-dialog">
                {!! Form::open(['url'=>'thongtinngaynghile','id' => 'frm_create'])!!}
                <div class="modal-content">
                    <div class="modal-header modal-header-primary">
                        <button type="button" data-dismiss="modal" aria-hidden="true"
                                class="close">&times;</button>
                        <h4 id="modal-header-primary-label" class="modal-title">Thêm mới thông tin ngày nghỉ</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label class="col-md-3 control-label"><b>Mô tả</b></label>
                                <div class="col-md-9 ">
                                    {!!Form::text('mota',null, array('id' => 'mota','class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><b>Từ ngày</b></label>
                                <div class="col-md-9">
                                    {!!Form::text('ngaytu',null, array('id' => 'tungay','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-md-3 control-label"><b>Đến ngày</b></label>
                                <div class="col-md-9 ">
                                    {!!Form::text('ngayden',null, array('id' => 'denngay','data-inputmask'=>"'alias': 'date'",'class' => 'form-control required'))!!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-md-3 control-label"><b>Số ngày nghỉ</b></label>
                                <div class="col-md-9 ">
                                    <select id="songaynghi" name="songaynghi" class="form-control">
                                        @if ($songay_start = '1' ) @endif
                                        @if ($songay_stop = '10') @endif
                                        @for($i = $songay_start; $i <= $songay_stop; $i++)
                                            <option value="{{$i}}">{{$i}}</option>
                                        @endfor
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" data-dismiss="modal" class="btn btn-default">Hủy thao tác</button>
                        <button type="submit" data-dismiss="modal" class="btn btn-success" onclick="ClickCreate()">Đồng ý</button>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>

    <!--Model chuyển hs chậm-->
        <div class="modal fade" id="chuyenhscham-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/chuyenhscham','id' => 'frm_chuyenhscham'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý chuyển hồ sơ bị chậm?</h4>
                    </div>
                    <input type="hidden" name="idchuyenhscham" id="idchuyenhscham">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickChuyenHsCham()">Đồng ý</button>

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
                {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/delete','id' => 'frm_delete'])!!}
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title">Đồng ý xóa?</h4>
                </div>
                <input type="hidden" name="iddelete" id="iddelete">
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                    <button type="submit" class="btn blue" onclick="ClickDelete()">Đồng ý</button>

                </div>
                {!! Form::close() !!}
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop