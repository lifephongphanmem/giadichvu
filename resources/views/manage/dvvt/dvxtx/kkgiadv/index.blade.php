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
        $(function(){

            $('#namhs').change(function() {
                var namhs = $('#namhs').val();
                var masothue = $('#masothue').val();
                var url = '/ke_khai_dich_vu_van_tai/xe_taxi/masothue='+masothue+'&nam='+namhs;

                window.location.href = url;
            });

        });
        function getId(id){
            document.getElementById("iddelete").value=id;
        }
        function ClickDelete(){
            $('#frm_delete').submit();
        }

        function confirmChuyen(id) {
            document.getElementById("idchuyen").value =id;
        }
        function ClickChuyen(){
            if($('#ttnguoinop').val() != ''){
                toastr.success("Hồ sơ đã được chuyển!", "Thành công!");
                $('#frm_chuyen').submit();
            }else{
                toastr.error("Bạn cần nhập thông tin người chuyển", "Lỗi!!!");
            }

        }

        function viewLyDo(id) {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            //alert(id);
            $.ajax({
                url: '/kkgdvlt/viewlydo',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: id
                },
                dataType: 'JSON',
                success: function (data) {
                    if(data.status == 'success') {
                        $('#lydo').replaceWith(data.message);
                    }
                }
            })
        }

        function InPAG(masokk){
            var url='/dich_vu_van_tai/dich_vu_xe_taxi/inPAG/ma_so='+ masokk;
            window.open(url,'_blank');
        }

    </script>
@stop

@section('content')

    <h3 class="page-title">
        Thông tin kê khai giá<small>&nbsp;dịch vụ vận tải xe taxi</small> - Doanh nghiệp <small>{{$modeldn->tendonvi}}</small>
    </h3>
    <input type="hidden" name="masothue" id="masothue" value="{{$modeldn->masothue}}">


    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi/masothue='.$modeldn->masothue.'/create')}}" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Kê khai mới </a>
                        @if(session('admin')->level == 'T' || session('admin')->level == 'H')
                            <a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi')}}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                        @endif
                    </div>

                </div>
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
                            <th style="text-align: center">Ngày kê khai</th>
                            <th style="text-align: center">Ngày thực hiện<br>mức giá kê khai</th>
                            <th style="text-align: center">Số công văn</th>
                            <th style="text-align: center">Số công văn<br> liền kề</th>
                            <th style="text-align: center">Người chuyển</th>
                            <th style="text-align: center">Trạng thái</th>
                            <th style="text-align: center" width="25%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}</td>
                                <td style="text-align: center">{{getDayVn($tt->ngayhieuluc)}}</td>
                                <td style="text-align: center" class="active">{{$tt->socv}}</td>
                                <td style="text-align: center">{{$tt->socvlk}}</td>
                                <td style="text-align: center">{{$tt->ttnguoinop.' - '.$tt->telnguoinop.' - '. $tt->faxnguoinop}}</td>
                                    @if($tt->trangthai == "Chờ chuyển")
                                <td align="center"><span class="badge badge-warning">{{$tt->trangthai}}</span></td>
                                @elseif($tt->trangthai == 'Chờ duyệt')
                                    <td align="center"><span class="badge badge-blue">{{$tt->trangthai}}</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @elseif($tt->trangthai == 'Chờ nhận')
                                    <td align="center"><span class="badge badge-warning">{{$tt->trangthai}}</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @elseif($tt->trangthai == 'Bị trả lại')
                                    <td align="center">
                                        <span class="badge badge-danger">{{$tt->trangthai}}</span><br>&nbsp;
                                    </td>
                                @else
                                    <td align="center">
                                        <span class="badge badge-success">{{$tt->trangthai}}</span>
                                        <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</b>
                                    </td>
                                @endif
                                <td>
                                    <a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi/report_ke_khai/'.$tt->masokk)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem chi tiết</a>
                                    <button type="button" onclick="InPAG('{{$tt->masokk}}')" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Phương án giá</button>
                                    @if($tt->trangthai == 'Chờ chuyển' || $tt->trangthai == 'Bị trả lại')
                                        @if(can('kkdvvtxtx','create'))
                                        <a href="{{url('ke_khai_dich_vu_van_tai/xe_taxi/'.$tt->id.'/edit')}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                                        @endif
                                        @if(can('kkdvvtxtx','delete'))
                                        <button type="button" onclick="getId('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#delete-modal" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;
                                            Xóa</button>
                                        @endif
                                        @if(can('kkdvvtxtx','approve'))
                                        <button type="button" onclick="confirmChuyen('{{$tt->id}}')" class="btn btn-default btn-xs mbs" data-target="#chuyen-modal" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;
                                            Chuyển</button>
                                        @endif
                                        @if( $tt->trangthai == 'Bị trả lại')
                                        <button type="button" data-target="#lydo-modal" data-toggle="modal" class="btn btn-default btn-xs mbs" onclick="viewLyDo({{$tt->id}});"><i class="fa fa-search"></i>&nbsp;Lý do trả lại</button>
                                        @endif
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
    <!--Model chuyển-->
        <div class="modal fade" id="chuyen-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'/ke_khai_dich_vu_van_tai/xe_taxi/chuyen','id' => 'frm_chuyen'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý chuyển hồ sơ?</h4>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label><b>Thông tin người nộp</b></label>
                            <input type="text" name="ttnguoinop" id="ttnguoinop" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label><b>Số điện thoại người nộp</b></label>
                            <input type="tel" name="telnguoinop" id="telnguoinop" class="form-control required">
                        </div>
                        <div class="form-group">
                            <label><b>Số fax người nộp</b></label>
                            <input type="tel" name="faxnguoinop" id="faxnguoinop" class="form-control required">
                        </div>
                    </div>
                    <input type="hidden" name="idchuyen" id="idchuyen">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickChuyen()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>

    <!--Model lý do-->
    <div class="modal fade" id="lydo-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title"><b>Lý do trả lại hồ sơ?</b></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <textarea id="lydo" class="form-control" name="lydo" cols="30" rows="5"></textarea></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

        <!--Modal delete-->
    <div class="modal fade" id="delete-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                {!! Form::open(['url'=>'ke_khai_dich_vu_van_tai/xe_taxi/delete','id' => 'frm_delete'])!!}
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