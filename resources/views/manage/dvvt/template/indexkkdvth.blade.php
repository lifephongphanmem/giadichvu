
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
                    <option value="{{$i}}" {{$i == $nam ? 'selected' : ''}}>{{$i}}</option>
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
                        <th style="width: 2%; padding: 10px; background: #efefef">STT</th>
                        <th>Đơn vị kê khai</th>
                        <th>Ngày kê khai</th>
                        <th>Áp dụng từ ngày</th>
                        <th>Số công văn</th>
                        <th>Thông tin người nộp</th>
                        <th style="width: 15%">Trạng thái</th>
                        <th style="width: 20%">Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i=1 ?>
                    @foreach($model as $kk)
                        <tr>
                            <td style="text-align: center">{{$i++}}</td>
                            <td>{{$kk->tendonvi}}</td>
                            <td>{{getDayVn($kk->ngaynhap)}}</td>
                            <td>{{getDayVn($kk->ngayhieuluc)}}</td>
                            <td>{{$kk->socv}}
                                @if($kk->trangthai == 'Chờ duyệt')
                                    <br>Số hồ sơ:<br><b>{{$kk->sohsnhan}}</b>
                                    <br>Thời gian nhận:<br><b>{{getDayVn($kk->ngaynhan)}}</b>
                                @endif
                            </td>
                            <td>{{$kk->ttnguoinop}}
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
                                @if($kk->trangthai == 'Chờ nhận')
                                    <button type="button" onclick="TTNguoiChuyen('{{$kk->ttnguoinop}}')" class="btn btn-default btn-xs mbs" data-target="#chuyendvvt-modal-confirm" data-toggle="modal"><i class="fa fa-user"></i>&nbsp;Người chuyển</button>
                                    <button type="button" onclick="confirmNhan('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#nhandvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Nhận hồ sơ</button>
                                    <button type="button" onclick="confirmTraLai('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#tradvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Trả lại</button>
                                @elseif($kk->trangthai == 'Chờ duyệt')
                                    <button type="button" onclick="comfirmDuyet('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#duyeths-modal-confirm" data-toggle="modal"><i class="fa fa-check-square"></i>&nbsp;Duyệt hồ sơ</button>
                                    <button type="button" onclick="confirmTraLai('{{$kk->id}}')" class="btn btn-default btn-xs mbs" data-target="#tradvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Trả lại</button>
                                    <button type="button" onclick="confirmNhanCS('{{$kk->id.'?'.$kk->sohsnhan.'?'.$kk->ngaynhan}}')" class="btn btn-default btn-xs mbs" data-target="#nhandvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Chỉnh sửa</button>
                                @elseif($kk->trangthai == 'Đang công bố')
                                    <button type="button" onclick="confirmNhanCS('{{$kk->id.'?'.$kk->sohsnhan.'?'.$kk->ngaynhan}}')" class="btn btn-default btn-xs mbs" data-target="#nhandvvt-modal-confirm" data-toggle="modal"><i class="fa fa-share-square-o"></i>&nbsp;Chỉnh sửa</button>
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
        var url='{{$url}}'+'in/'+ masokk;
        window.open(url,'_blank');
    }

    function InPAG(masokk){
        var url='{{$url}}'+'inPAG/'+ masokk;
        window.open(url,'_blank');
    }

    function clickNhanHS(){
        //alert($('#ngaynhan').val()=='');
        if($('#ngaynhan').val()==''){
            alert('Ngày nhận hồ sơ không hợp lệ');
            return false;
        }
        //url: '/dvvantai/kkdvxk/nhanhs',
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $.ajax({
            url: '{{$url}}'+'xet_duyet/duyet',
            type: 'GET',
            data: {
                _token: CSRF_TOKEN,
                id: $('#idnhan').val(),
                sohsnhan: $('#sohsnhan').val(),
                ngaynhan: $('#ngaynhan').val()
            },
            dataType: 'JSON',
            success: function (data) {
                if (data.status == 'success') {
                    //alert('Nhận bảng kê khai thành công.');
                    location.reload();
                }
            },
            error: function (message) {
                alert(message);
            }
        })
    }

    function clickTraDVVT() {
        //$('#frmTraLai').attr('action', "dvvantai/thaotackkdvxk/tralai/" + id);
        if ($('#idtra').attr('value') != 'null') {
            var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                url: '{{$url}}'+'xet_duyet/tra_lai',
                type: 'GET',
                data: {
                    _token: CSRF_TOKEN,
                    id: $('#idtra').val(),
                    lydo: $('#lydotra').val()
                },
                dataType: 'JSON',
                success: function (data) {
                    if (data.status == 'success') {
                        alert('Trả lại bảng kê khai thành công.');
                        location.reload();
                    }
                },
                error: function (message) {
                    alert(message);
                }
            })
        }
    }

    function confirmNhan(id) {
        $('#idnhan').attr('value', id);
        var sohs = '{{(getGeneralConfigs()['sodvvt'] + 1)}}';
        var today = new Date();
        //alert(sohs);
        var dd = today.getDate();
        var mm = today.getMonth()+1; //January is 0!
        var yyyy = today.getFullYear();

        if(dd<10) {
            dd='0'+dd
        }

        if(mm<10) {
            mm='0'+mm
        }

        $('#ngaynhan').attr('value', yyyy+'-'+ mm+'-'+dd);
        $('#sohsnhan').attr('value', sohs);
    }

    function confirmNhanCS(str){
        var aKQ=str.split('?');
        $('#idnhan').attr('value', aKQ[0]);
        $('#sohsnhan').attr('value', aKQ[1]);
        $('#ngaynhan').attr('value', aKQ[2]);
    }

    function confirmChuyen(id) {
        //$('#idkk').attr('value', id);
    }

    function comfirmDuyet(id){
        $('#idduyet').attr('value', id);
    }

    function confirmTraLai(id) {
        $('#idtra').attr('value', id);
    }

    function LyDoTraLai(str){
        $('#lydotra').attr('value', str);
        $('#idtra').attr('value', 'null');
    }

    function TTNguoiChuyen(str){
        $('#ttnguoinop').attr('value', str);
        $('#idkk').attr('value', 'null');
    }

</script>
