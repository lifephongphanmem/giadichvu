
<div class="row">
    <div class="col-md-2">
        <div class="form-group">
            <select name="thanghs" id="thanghs" class="form-control">
                <option value="01" {{$thang == '01' ? 'selected' : ''}}>Tháng 01</option>
                <option value="02" {{$thang == '02' ? 'selected' : ''}}>Tháng 02</option>
                <option value="03" {{$thang == '03' ? 'selected' : ''}}>Tháng 03</option>
                <option value="04" {{$thang == '04' ? 'selected' : ''}}>Tháng 04</option>
                <option value="05" {{$thang == '05' ? 'selected' : ''}}>Tháng 05</option>
                <option value="06" {{$thang == '06' ? 'selected' : ''}}>Tháng 06</option>
                <option value="07" {{$thang == '07' ? 'selected' : ''}}>Tháng 07</option>
                <option value="08" {{$thang == '08' ? 'selected' : ''}}>Tháng 08</option>
                <option value="09" {{$thang == '09' ? 'selected' : ''}}>Tháng 09</option>
                <option value="10" {{$thang == '10' ? 'selected' : ''}}>Tháng 10</option>
                <option value="11" {{$thang == '11' ? 'selected' : ''}}>Tháng 11</option>
                <option value="12" {{$thang == '12' ? 'selected' : ''}}>Tháng 12</option>
            </select>
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <select name="namhs" id="namhs" class="form-control">
                @if ($nam_start = intval(date('Y')) - 5 ) @endif
                @if ($nam_stop = intval(date('Y')) ) @endif
                @for($i = $nam_start; $i <= $nam_stop; $i++)
                    <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>Năm {{$i}}</option>
                @endfor
            </select>
        </div>
    </div>
    <div class="col-md-5">
        <div class="form-group">
            <select name="pl" id="pl" class="form-control">
                <option value="cho_nhan" {{$pl == 'cho_nhan' ? 'selected' : ''}}>Hồ sơ kê khai giá dịch vụ đang chờ nhận</option>
                <option value="cong_bo" {{$pl == 'cong_bo' ? 'selected' : ''}}>Hồ sơ kê khai giá dịch vụ đã công bố</option>
            </select>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="portlet box">
                <div class="portlet-body">
                <table id="sample_3" class="table table-hover table-striped table-bordered table-advanced tablesorter">
                    <thead>
                    <tr>
                        <th style="width: 2%; text-align: center">STT</th>
                        <th style="text-align: center">Đơn vị kê khai</th>
                        <th style="text-align: center">Ngày kê khai</th>
                        <th style="text-align: center">Áp dụng từ ngày</th>
                        <th style="text-align: center">Số công văn</th>
                        <th style="text-align: center">Người chuyển</th>
                        <th style="width: 15%;text-align: center">Trạng thái</th>
                        <th style="width: 20%;text-align: center">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($model as $kk)
                        <tr>
                            <td style="text-align: center">{{$i++}}</td>
                            <td class="active">{{$kk->tendonvi}}</td>
                            <td style="text-align: center">{{getDayVn($kk->ngaynhap)}}</td>
                            <td style="text-align: center">{{getDayVn($kk->ngayhieuluc)}}</td>
                            <td style="text-align: center" class="danger">{{$kk->socv}}
                                @if($kk->trangthai == 'Chờ duyệt')
                                    <br>Số hồ sơ:<br><b>{{$kk->sohsnhan}}</b>
                                    <br>Thời gian nhận:<br><b>{{getDayVn($kk->ngaynhan)}}</b>
                                @endif
                            </td>
                            <td style="text-align: center">{{$kk->ttnguoinop}}
                            </td>
                            <td align="center">

                                @if($kk->trangthai == 'Chờ duyệt')
                                    <span class="badge badge-blue">{{$kk->trangthai}}</span>
                                    <br>Thời gian nhận:<br><b>{{getDayVn($kk->ngaynhan)}}</b>
                                @elseif($kk->trangthai == 'Duyệt')
                                    <span class="badge badge-success">{{$kk->trangthai}}</span>
                                @elseif($kk->trangthai == 'Chờ nhận')
                                    <span class="badge badge-info">{{$kk->trangthai}}</span>
                                    <br>Thời gian chuyển:<br><b>{{getDateTime($kk->ngaychuyen)}}</b>
                                @elseif($kk->trangthai == 'Đang công bố')
                                    <span class="badge badge-success">{{$kk->trangthai}}</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" onclick="InChiTiet('{{$kk->masokk}}')" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Chi tiết</button>
                                <button type="button" onclick="InPAG('{{$kk->masokk}}')" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Phương án giá</button>
                                @if($per['approve'])
                                    @if($kk->trangthai == 'Chờ nhận')
                                        <!--button type="button" onclick="TTNguoiChuyen('{{$kk->ttnguoinop}}')" class="btn btn-default btn-xs mbs" data-target="#chuyendvvt-modal-confirm" data-toggle="modal"><i class="fa fa-user"></i>&nbsp;Người chuyển</button-->
                                        <button type="button" onclick="confirmNhan('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#nhandvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Nhận hồ sơ</button>
                                        <button type="button" onclick="confirmTraLai('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#tradvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Trả lại</button>
                                    @elseif($kk->trangthai == 'Đang công bố')
                                        <button type="button" onclick="confirmNhanCS('{{$kk->id.'?'.$kk->sohsnhan.'?'.$kk->ngaynhan}}')" class="btn btn-default btn-xs mbs" data-target="#nhandvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Chỉnh sửa</button>
                                    @endif
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script>
    function InChiTiet(masokk){
        var url='{{$url}}'+'in/ma_so='+ masokk;
        window.open(url,'_blank');
    }

    function InPAG(masokk){
        var url='{{$url}}'+'inPAG/ma_so='+ masokk;
        window.open(url,'_blank');
    }
</script>
