<!DOCTYPE html>
<html>
<head>
    <title>Lịch sử hồ sơ kê khai</title>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
</head>
<body style="font-size: 14px;">

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr>
        <td>
            <h3>Doanh nghiệp: {{$modeldn->tendn}}</h3>
            <b>Tên cơ sở kinh doanh: {{$modelcskd->tencskd}}<br><br>
                <b>Mã kê khai: {{$model->mahs}}</b>
        </td>
    </tr>
</table>

<br><br>
<p style="margin-left: 20px"> Tìm thấy <b>{{count($modelhis)}}</b> bản lưu </p>
<table width="96%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr bgcolor="#efefef" style="text-align: center">
        <td><b>STT</b></td>
        <td><b>Phân loại hồ sơ</b></td>
        <td><b>Ngày kê khai - Ngày áp dụng</b></td>
        <td><b>Số công văn - Số công văn liền kề </b></td>
        <td><b>Thông tin chuyển hồ sơ</b></td>
        <td><b>Thông tin nhận hồ sơ</b></td>
        <td><b>Hành động</b></td>
        <td><b>Thao tác</b></td>
    </tr>
    @foreach($modelhis as $key=>$tt)
        <tr>
            <td style="text-align: center">{{$key+1}}</td>
            <td style="text-align: center">
                @if($tt->plhs == 'GG') Giảm giá @elseif($tt->plhs == 'LD') 'Lần đầu' @else Tăng giá @endif
            </td>
            <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}- {{getDayVn($tt->ngayhieuluc)}}</td>
            <td style="text-align: center">{{$tt->socv}}- {{$tt->socvlk}}</td>
            <td>{{$tt->ttnguoinop}} <br> Thời gian chuyển: <br><b>{{getDateTime($tt->ngaychuyen)}}</b></td>
            @if($tt->sohsnhan != '' && $tt->ngaynhan != '')
            <td>Số hồ sơ nhận: {{$tt->sohsnhan}} <br> Thời gian nhận:{{getDayVn($tt->created_at)}} </td>
            @else
                <td></td>
            @endif
            @if($tt->action == 'Trả lại hồ sơ')
                <td>{{$tt->action}}<br>Thời gian trả hồ sơ: <b>{{getDateTime($tt->created_at)}}</b><br>
                    Lý do trả lại: <br>{{$tt->lydo}}</td>
            @elseif($tt->action == 'Huỷ duyệt hồ sơ')
                <td>{{$tt->action}}<br>Thời gian huỷ duyệt hồ sơ: <b>{{getDateTime($tt->created_at)}}</b>
            @else
                <td>{{$tt->action}}<b>
            @endif
            <td>
                @if($tt->action != 'Huỷ duyệt hồ sơ')
                    @if($tt->phanloai == 'DT')
                        <a href="{{url('ke_khai_dich_vu_luu_tru/historyks/mahsh='.$tt->mahsh)}}" style="background-color: #eee">Xem HS tại thời điểm này</a>
                    @else
                        <a href="{{url('ke_khai_dich_vu_luu_tru/history/mahsh='.$tt->mahsh)}}" style="background-color: #eee">Xem HS tại thời điểm này</a>
                    @endif
                @endif
            </td>
        </tr>
    @endforeach


</table>
</body>
</html>