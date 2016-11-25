<div class="portlet-body">
    <table class="table table-striped table-bordered table-hover" id="sample_3">
        <thead>
        <tr>
            <th style="text-align: center" width="2%">STT</th>
            <th style="text-align: center">Ngày kê khai</th>
            <th style="text-align: center">Ngày thực hiên<br>mức giá kê khai</th>
            <th style="text-align: center">Số công văn</th>
            <th style="text-align: center">Số công văn <br>liền kề</th>
            <th style="text-align: center">Người chuyển</th>
            <th style="text-align: center">Trạng thái</th>
            <th style="text-align: center" width="25%">Thao tác</th>
        </tr>
        </thead>
        <tbody id="noidung">
        <?php $i=1;?>
        @foreach($model as $kk)
            <tr>
                <td style="text-align: center">{{$i++}}</td>
                <td style="text-align: center">{{getDayVn($kk->ngaynhap)}}</td>
                <td style="text-align: center">{{getDayVn($kk->ngayhieuluc)}}</td>
                <td style="text-align: center" class="active">{{$kk->socv}}
                    @if($kk->trangthai == 'Chờ duyệt')
                        <br>Số hồ sơ:<br><b>{{$kk->sohsnhan}}</b>
                        <br>Thời gian nhận:<br><b>{{getDayVn($kk->ngaynhan)}}</b>
                    @endif
                </td>
                <td style="text-align: center">{{$kk->socvlk .' - '. (getDayVn($kk->ngaynhaplk)=='01/01/1970'?'':getDayVn($kk->ngaynhaplk))}}</td>
                <td style="text-align: center">{{$kk->ttnguoinop}}
                <td align="center">
                    @if($kk->trangthai == "Chờ chuyển")
                        <span class="badge badge-warning">{{$kk->trangthai}}</span>
                    @elseif($kk->trangthai == 'Chờ duyệt')
                        <span class="badge badge-blue">{{$kk->trangthai}}</span>
                        <br>Thời gian nhận:<br><b>{{getDateTime($kk->ngaynhan)}}</b>
                    @elseif($kk->trangthai == 'Bị trả lại')
                        <span class="badge badge-danger">{{$kk->trangthai}}</span><br>&nbsp;
                    @elseif($kk->trangthai == 'Duyệt')
                        <span class="badge badge-success">{{$kk->trangthai}}</span>
                    @else
                        <span class="badge badge-info">{{$kk->trangthai}}</span>
                        <br>Thời gian chuyển:<br><b>{{getDateTime($kk->ngaychuyen)}}</b>
                    @endif
                </td>

                <td>
                    <button type="button" onclick="InChiTiet('{{$kk->masokk}}')" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Chi tiết</button>
                    <button type="button" onclick="InPAG('{{$kk->masokk}}')" class="btn btn-default btn-xs mbs"><i class="fa fa-eye"></i>&nbsp;Phương án giá</button>
                    @if($kk->trangthai == "Chờ chuyển")
                        @if($per['edit'])
                            <a href="{{url($url.'ke_khai/edit/'.$kk->id)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                        @endif
                        @if($per['approve'])
                            <button type="button" onclick="confirmChuyen('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#chuyendvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Chuyển</button>
                        @endif
                        @if($per['delete'])
                            <button type="button" onclick="confirmDel('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#del-modal-confirm" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                        @endif
                    @elseif($kk->trangthai == 'Chờ nhận')
                        <!--button type="button" onclick="TTNguoiChuyen('{{$kk->ttnguoinop}}')" class="btn btn-default btn-xs mbs" data-target="#chuyendvvt-modal-confirm" data-toggle="modal"><i class="fa fa-user"></i>&nbsp;Người chuyển</button-->
                    @elseif($kk->trangthai == 'Bị trả lại')
                        @if($per['edit'])
                            <a href="{{url($url.'ke_khai/edit/'.$kk->id)}}" class="btn btn-default btn-xs mbs"><i class="fa fa-edit"></i>&nbsp;Chỉnh sửa</a>
                        @endif
                        <button type="button" onclick="LyDoTraLai('{{$kk->lydo}}')" class="btn btn-default btn-xs mbs" data-target="#tradvvt-modal-confirm" data-toggle="modal"><i class="fa fa-list"></i>&nbsp;Lý do trả lại</button>

                        @if($per['approve'])
                            <button type="button" onclick="confirmChuyen('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#chuyendvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Chuyển</button>
                        @endif
                        @if($per['delete'])
                            <button type="button" onclick="confirmDel('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#del-modal-confirm" data-toggle="modal"><i class="fa fa-trash-o"></i>&nbsp;Xóa</button>
                        @endif
                    @endif
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>