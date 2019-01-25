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
    </script>
@stop

@section('content')

    <h3 class="page-title">
        Hoạt động kê khai giá<small>&nbsp;dịch vụ lưu trú</small> - Cơ sở kinh doanh <small>{{$modelcskd->tencskd}}</small>
    </h3>



    <!-- END PAGE HEADER-->
    <div class="row">
        <div class="col-md-12">
            <!-- BEGIN EXAMPLE TABLE PORTLET-->
            <div class="portlet box">
                <div class="portlet-title">
                    <div class="actions">
                        <a href="{{url('thongtinhoatdongcskd')}}" class="btn btn-default btn-sm"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
                    </div>

                </div>
                <div class="portlet-body">
                    <div class="portlet-body">
                    <table class="table table-striped table-bordered table-hover" id="sample_3">
                        <thead>
                        <tr>
                            <th style="text-align: center" width="2%">STT</th>
                            <th style="text-align: center" width="10%">Hồ sơ/<br>Mã hồ sơ</th>
                            <th style="text-align: center">Ngày kê khai/<br>Ngày thực hiện<br>mức giá kê khai</th>
                            <th style="text-align: center">Số công văn/<br>Số công văn<br> liền kề</th>
                            <th style="text-align: center">Người chuyển</th>
                            <th style="text-align: center">Hoạt động</th>
                            <th style="text-align: center" width="10%">Thao tác</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($model as $key=>$tt)
                            <tr>
                                <td style="text-align: center">{{$key+1}}</td>
                                <td>Hồ sơ: @if($tt->plhs == 'GG') Giảm giá @elseif($tt->plhs == 'LD') 'Lần đầu' @else Tăng giá @endif <br>
                                Mã hồ sơ: <b>{{$tt->mahs}}</b>
                                </td>
                                <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}<br> - {{getDayVn($tt->ngayhieuluc)}}</td>
                                <td style="text-align: center" class="active">{{$tt->socv}}<br> - {{$tt->socvlk}}</td>
                                <td style="text-align: center">{{$tt->ttnguoinop}}
                                <br>Thời gian chuyển:<br><b>{{getDateTime($tt->ngaychuyen)}}</td>
                                    @if($tt->action == 'Trả lại hồ sơ')
                                        <td>{{$tt->action}}<br>Thời gian trả hồ sơ: <b>{{getDateTime($tt->created_at)}}</b><br>
                                        Lý do trả lại: <br>{{$tt->lydo}}</td>
                                    @elseif($tt->action == 'Huỷ duyệt hồ sơ')
                                        <td>{{$tt->action}}<br>Thời gian huỷ duyệt hồ sơ: <b>{{getDateTime($tt->created_at)}}</b>
                                    @else
                                        <td>{{$tt->action}}<b>
                                    @endif
                                <td>
                                    @if($tt->phanloai == 'DT')
                                        <a href="{{url('ke_khai_dich_vu_luu_tru/historyks/mahsh='.$tt->mahsh)}}"target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem HS tại thời điểm này</a>
                                    @else
                                        <a href="{{url('ke_khai_dich_vu_luu_tru/history/mahsh='.$tt->mahsh)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Xem HS tại thời điểm này</a>
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
                    {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/chuyen','id' => 'frm_chuyen'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Đồng ý chuyển hồ sơ?</h4>
                    </div>
                    <div class="modal-body">
                        <p style="color: #000066">Hồ sơ chuyển sau 17h sẽ tính ngày hôm sau,
                            thời gian xét duyệt hồ sơ là {{getGeneralConfigs()['thoihan_lt']}} ngày</p>
                        <div class="form-group">
                            <label><b>Thông tin người nộp</b></label>
                            <textarea id="ttnguoinop" class="form-control required" name="ttnguoinop" cols="30" rows="5" placeholder="Họ và tên người chuyển- Số ĐT liên lạc- Email lien lạc"></textarea></div>
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

    <!--Model copy-->
        <div class="modal fade" id="copy-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    {!! Form::open(['url'=>'ke_khai_dich_vu_luu_tru/copy','id' => 'frm_chuyen'])!!}
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Sao chép hồ sơ kê khai?</h4>
                    </div>
                    <div class="modal-body">
                        <p style="color: #000066"><u>Ghi chú</u>: Chức năng này sẽ hỗ trợ kê khai nhanh giá dịch vụ, chương trình sẽ tự động sao chép thông tin từ hồ sơ kê khai đã được duyệt
                            và chuyển các thông tin vào màn hình kê khai mới.Các mức giá kê khai liền kề sẽ tự động lấy từ thông tin kê khai sao chép chuyển vào</p>
                    <input type="hidden" name="macskdcp" id="macskdcp" value="">
                    <div class="modal-footer">
                        <button type="button" class="btn default" data-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn blue" onclick="ClickCopy()">Đồng ý</button>

                    </div>
                    {!! Form::close() !!}
                    </div>
                    <!-- /.modal-content -->
                </div>
                <!-- /.modal-dialog -->
            </div>
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