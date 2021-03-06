@extends('maincongbo')

@section('custom-style-cb')
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{url('assets/global/plugins/select2/select2.css')}}"/>
    <!-- END THEME STYLES -->
@stop


@section('custom-script-cb')
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
            $('#loaihang').change(function() {
                var loaihang = $('#loaihang').val();
                var url = '/giadichvuluutru?&loaihang='+loaihang;
                window.location.href = url;
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="note note-info note-bordered">
            <div class="row">
                <div class="col-md-4">
                    <img class="img-responsive"
                         src="{{ url('images/cskddvlt/'.$modelcskd->toado)}}" width="150">
                </div>
                <div class="col-md-8">
                    <h3><b>{{$modelcskd->tencskd}}</b></h3>
                    <div class="ratings" style="color: #ec0;">
                        <p>
                            @if($modelcskd->loaihang == '1')
                                <span class="glyphicon glyphicon-star"></span>
                            @elseif($modelcskd->loaihang == '2')
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            @elseif($modelcskd->loaihang == '3')
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            @elseif($modelcskd->loaihang == '4')
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            @elseif($modelcskd->loaihang == '5')
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                                <span class="glyphicon glyphicon-star"></span>
                            @elseif($modelcskd->loaihang == 'K' ) Khác(Nhà nghỉ)
                            @elseif ($modelcskd->loaihang == 'CXD' ) Chưa xác định (Khách sạn chưa xác định sao)
                            @endif
                        </p>
                    </div>
                    <ul class="contact-info">
                        @if($modelcskd->link !='')
                            <li><i class="glyphicon glyphicon-cloud-upload"></i><a href="{{$modelcskd->link}}" target="_blank"> {{$modelcskd->link}}</a> </li>
                        @endif
                        <li><i class="glyphicon glyphicon-map-marker"></i> {{$modelcskd->diachikd}}</li>
                        <li><i class="glyphicon glyphicon-earphone"></i> {{$modelcskd->telkd}}</li>
                    </ul>
                    @if(!isset($modelcb))
                        <p>Hiện tại doanh nghiệp chưa kê khai giá dịch vụ cho {{$modelcq->tendv}}</p>
                    @else
                    <p>Ngày áp dụng mức giá <b>{{getDayVn($modelcb->ngayhieuluc)}}</b> - {{$modelcq->tendv}} đã nhận hồ sơ vào ngày {{getDayVn($modelcb->ngaynhan)}}</p>
                    <br>
                        @if($model->giaycnhangcs != '')
                            <a href="{{ url('images/cskddvlt/hangcslt/'.$model->giaycnhangcs)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Giấy công nhận hạng cơ sở lưu trú</a>
                        @else
                        <p>Doanh nghiệp chưa cập nhật giấy chứng nhận loại hạng theo hồ sơ kê khai</p>
                        @endif
                    @endif
                </div>
            </div>
        </div>
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject theme-font bold uppercase">Thông tin kê khai giá dịch vụ</span>
                        </div>
                        <div class="actions">
                            @if(isset($modelcb))
                                <a href="{{url('giadichvuluutru/'.$modelcskd->macskd.'/history')}}" class="btn green" target="_blank"><i class="fa fa-eye"></i> Thông tin kê khai gần đây</a>
                            @endif
                        </div>
                    </div>
                    @if(count($modelcb) > 0 && $modelcb->phanloai != 'DT')
                    <div class="portlet-body">
                        <table class="table table-striped table-bordered table-hover" id="sample_3">
                            <thead>
                            <tr>
                                <th style="text-align: center" width="2%">STT</th>
                                <th style="text-align: center">Loại phòng</th>
                                <th style="text-align: center">Quy cách chất lượng</th>
                                <th style="text-align: center" >Số hiệu phòng</th>
                                <th style="text-align: center" width="10%">Giá kê khai</th>
                                <th style="text-align: center">Ghi chú</th>
                            </tr>
                            </thead>
                            <tbody>

                            @if($modelcbct !='')
                                @foreach($modelcbct as $key=>$tt)
                                    <tr>
                                        <td style="text-align: center">{{$key+1}}</td>
                                        <td>{{$tt->loaip}}</td>
                                        <td>{{$tt->qccl}}</td>
                                        <td>{{getTtPhong($tt->sohieu)}}</td>
                                        <th style="text-align: right">{{number_format($tt->mucgiakk)}}</th>
                                        <th>{!! nl2br(e($tt->ghichu))!!}</th>
                                    </tr>
                                @endforeach
                            @endif

                            </tbody>
                        </table>
                        @if(isset($modelcb))
                        <p>{!! nl2br(e($modelcb->ghichu)) !!}</p>
                        @endif
                    </div>
                    @else
                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover" id="sample_3">
                                <thead>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center">Loại phòng</th>
                                    <th style="text-align: center">Quy cách chất lượng</th>
                                    <th style="text-align: center" >Số hiệu phòng</th>
                                    <th style="text-align: center" >Đối tượng</th>
                                    <th style="text-align: center" >Áp dụng</th>
                                    <th style="text-align: center" width="10%">Giá kê khai</th>
                                    <th style="text-align: center" >Ghi chú</th>
                                </tr>
                                </thead>
                                <tbody>

                                @if($modelcbct !='')
                                    @foreach($modelcbct as $key=>$tt)
                                        <tr>
                                            <td style="text-align: center">{{$key+1}}</td>
                                            <td>{{$tt->loaip}}</td>
                                            <td>{{$tt->qccl}}</td>
                                            <td>{{getTtPhong($tt->sohieu)}}</td>
                                            <td>{{$tt->tendoituong}}</td>
                                            <td>{{$tt->apdung}}</td>
                                            <th style="text-align: right">{{number_format($tt->mucgiakk)}}</th>
                                            <th style="text-align: right">{{$tt->ghichu}}</th>
                                        </tr>
                                    @endforeach
                                @endif

                                </tbody>
                            </table>
                            @if(isset($modelcb))
                                <p>{!! nl2br(e($modelcb->ghichu)) !!}</p>
                            @endif
                        </div>
                    @endif
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
    <div style="text-align: center">
        <a href="{{url('giadichvuluutru')}}" class="btn btn-danger"><i class="fa fa-reply"></i>&nbsp;Quay lại</a>
    </div>
@stop 