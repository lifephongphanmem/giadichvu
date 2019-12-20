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
                var loaihang = '&loaihang='+$('#loaihang').val();
                var tencskd = '&tencskd='+ $('#tencskd').val();
                var diachikd = '&diachikd='+ $('#diachikd').val();
                var paginate = '&paginate='+ $('#paginate').val();
                var url = '/giadichvuluutru?'+loaihang + tencskd + diachikd + paginate;
                window.location.href = url;
            });
            $('#tencskd').change(function() {
                var loaihang = '&loaihang='+$('#loaihang').val();
                var tencskd = '&tencskd='+ $('#tencskd').val();
                var diachikd = '&diachikd='+ $('#diachikd').val();
                var paginate = '&paginate='+ $('#paginate').val();
                var url = '/giadichvuluutru?'+loaihang + tencskd + diachikd + paginate;
                window.location.href = url;
            });
            $('#diachikd').change(function() {
                var loaihang = '&loaihang='+$('#loaihang').val();
                var tencskd = '&tencskd='+ $('#tencskd').val();
                var diachikd = '&diachikd='+ $('#diachikd').val();
                var paginate = '&paginate='+ $('#paginate').val();
                var url = '/giadichvuluutru?'+loaihang + tencskd + diachikd + paginate;
                window.location.href = url;
            });
            $('#paginate').change(function() {
                var loaihang = '&loaihang='+$('#loaihang').val();
                var tencskd = '&tencskd='+ $('#tencskd').val();
                var diachikd = '&diachikd='+ $('#diachikd').val();
                var paginate = '&paginate='+ $('#paginate').val();
                var url = '/giadichvuluutru?'+loaihang + tencskd + diachikd + paginate;
                window.location.href = url;
            });
        });
    </script>
@stop

@section('content-cb')
    <div class="container">
        <div class="row margin-top-10">
            <div class=" col-sm-12">
                <!-- BEGIN PORTLET-->
                <div class="portlet light">
                    <div class="portlet-title">
                        <div class="caption caption-md">
                            <i class="icon-bar-chart theme-font hide"></i>
                            <span class="caption-subject theme-font bold uppercase">Dịch vụ lưu trú</span>
                        </div>
                        <div class="actions">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Loại hạng<span class="require">*</span></label>
                                    <select id="loaihang" name="loaihang" class="form-control">
                                        <option value="all">--Tất cả--</option>
                                        <option value="1" {{$inputs['loaihang'] == 1 ? 'selected' : ''}}>1 sao</option>
                                        <option value="2" {{$inputs['loaihang'] == 2 ? 'selected' : ''}}>2 sao</option>
                                        <option value="3" {{$inputs['loaihang'] == 3 ? 'selected' : ''}}>3 sao</option>
                                        <option value="4" {{$inputs['loaihang'] == 4 ? 'selected' : ''}}>4 sao</option>
                                        <option value="5" {{$inputs['loaihang'] == 5 ? 'selected' : ''}}>5 sao</option>
                                        <option value="K" {{$inputs['loaihang'] == 'K' ? 'selected' : ''}}>Khác (Nhà nghỉ)</option>
                                        <option value="CXD" {{$inputs['loaihang'] == 'CXD' ? 'selected' : ''}}>Chưa xác định (Khách sạn chưa xác định sao)</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label class="control-label">Tên cơ sở kinh doanh<span class="require">*</span></label>
                                    {!! Form::text('tencskd', $inputs['tencskd'], ['id' => 'tencskd', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label">Địa chỉ<span class="require">*</span></label>
                                    {!! Form::text('diachikd', $inputs['diachikd'], ['id' => 'diachikd', 'class' => 'form-control']) !!}
                                </div>
                            </div>
                        </div>
                        {{--<table class="table table-striped table-bordered table-hover" id="sample_3">--}}
                            {{--<thead>--}}
                            {{--<tr>--}}
                                {{--<th style="text-align: center" width="2%">STT</th>--}}
                                {{--<th style="text-align: center" width="10%">Hình ảnh đại diện</th>--}}
                                {{--<th style="text-align: center" width="30%">Tên cơ sở kinh doanh</th>--}}
                                {{--<th style="text-align: center" width="20%">Địa chỉ</th>--}}
                                {{--<th style="text-align: center">Trang chủ</th>--}}
                                {{--<th style="text-align: center" width="10%">Thao tác</th>--}}
                            {{--</tr>--}}
                            {{--</thead>--}}
                            {{--<tbody>--}}
                            {{--@foreach($model as $key=>$tt)--}}
                                {{--<tr>--}}
                                    {{--<td align="center">{{$key+1}}</td>--}}
                                    {{--<td align="center" style="vertical-align: middle">--}}
                                        {{--<img src="{{ url('images/cskddvlt/'.$tt->toado)}}" width="96">--}}
                                    {{--</td>--}}
                                    {{--<td>{{$tt->tencskd}}<br><b>({{$tt->ghichu}})</b></td>--}}
                                    {{--<td>{{$tt->diachikd}}</td>--}}
                                    {{--<td><a href="{{$tt->link}}" target="_blank">{{$tt->link}}</a></td>--}}
                                    {{--<td>--}}
                                        {{--@if($tt->ghichu != 'Dừng hoạt động')--}}
                                            {{--<a href="{{url('giadichvuluutru/'.$tt->macskd)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Thông tin kê khai giá </a>--}}
                                            {{--@if($tt->toado != '')--}}
                                                {{--<br><a href="{{ url('images/cskddvlt/'.$tt->toado)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Giấy công nhận hạng cơ sở lưu trú</a>--}}
                                            {{--@else--}}
                                                {{--<br><p>Doanh nghiệp chưa cập nhật giấy chứng nhận loại hạng</p>--}}
                                            {{--@endif--}}
                                        {{--@endif--}}
                                    {{--</td>--}}
                                {{--</tr>--}}
                            {{--@endforeach--}}
                            {{--</tbody>--}}
                        {{--</table>--}}
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <label>
                                    Hiển thị
                                    <div class="select2-container form-control input-xsmall input-inline" >
                                        <select class="form-control" name="paginate" id="paginate" >
                                            <option value="5" {{$inputs['paginate'] == 5 ? 'selected' : ''}}>5</option>
                                            <option value="20" {{$inputs['paginate'] == 20 ? 'selected' : ''}}>20</option>
                                            <option value="50" {{$inputs['paginate'] == 50 ? 'selected' : ''}}>50</option>
                                            <option value="100" {{$inputs['paginate'] == 100? 'selected' : ''}}>100</option>
                                        </select>
                                    </div>
                                    thông tin
                                </label>
                            </div>
                        </div></br>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover">
                                <thead>
                                <tr>
                                    <th style="text-align: center" width="2%">STT</th>
                                    <th style="text-align: center" width="10%">Hình ảnh đại diện</th>
                                    <th style="text-align: center" width="30%">Tên cơ sở kinh doanh</th>
                                    <th style="text-align: center" width="20%">Địa chỉ</th>
                                    <th style="text-align: center">Trang chủ</th>
                                    <th style="text-align: center" width="10%">Thao tác</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($model as $key=>$tt)
                                    <tr>
                                        <td align="center">{{$key+1}}</td>
                                        <td align="center" style="vertical-align: middle">
                                            <img src="{{ url('images/cskddvlt/'.$tt->toado)}}" width="96">
                                        </td>
                                        <td>{{$tt->tencskd}}<br><b>{{$tt->ghichu}}</b></td>
                                        <td>{{$tt->diachikd}}</td>
                                        <td><a href="{{$tt->link}}" target="_blank">{{$tt->link}}</a></td>
                                        <td>
                                            @if($tt->ghichu != 'Dừng hoạt động')
                                                <a href="{{url('giadichvuluutru/'.$tt->macskd)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Thông tin kê khai giá </a>
                                                @if($tt->toado != '')
                                                    <br><a href="{{ url('images/cskddvlt/'.$tt->toado)}}" target="_blank" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Giấy công nhận hạng cơ sở lưu trú</a>
                                                @else
                                                    <br><p>Doanh nghiệp chưa cập nhật giấy chứng nhận loại hạng</p>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            @if(count($model) != 0)
                                <div class="col-md-5 col-sm-12">
                                    <div class="dataTables_info" id="sample_3_info" role="status" aria-live="polite">
                                        Hiển thị 1 đến {{$model->count()}} trên {{$model->total()}} thông tin
                                    </div>
                                </div>
                                <div class="col-md-7 col-sm-12">
                                    <div class="dataTables_paginate paging_simple_numbers" id="sample_3_paginate">
                                        {{$model->appends(['loaihang' => $inputs['loaihang'],
                                                       'tencskd'=>$inputs['tencskd'],
                                                       'paginate'=>$inputs['paginate'],
                                    ])->links()}}
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
    </div>
@stop 