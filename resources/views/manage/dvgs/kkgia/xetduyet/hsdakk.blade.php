<!DOCTYPE html>
<html>
<head>
    <title>Thông tin hồ sơ đã kê khai</title>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
</head>
<body style="font-size: 14px;">

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr>
        <td>
            <h3>Doanh nghiệp: {{$modeldn->tendn}}</h3>
            <b>Tên cơ sở kinh doanh: {{$modelcskd->tencskd}}<br><br>
        </td>
    </tr>
</table>

<br><br>
<p style="margin-left: 20px"> Tìm thấy <b>{{count($model)}}</b> bản lưu </p>
<table width="96%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr bgcolor="#efefef" style="text-align: center">
        <td><b>STT</b></td>
        <td><b>Phân loại hồ sơ</b></td>
        <td><b>Ngày kê khai - Ngày áp dụng</b></td>
        <td><b>Số công văn</b></td>
        <td><b>Số công văn liền kề </b></td>
        <td><b>Thao tác</b></td>
    </tr>
    @foreach($model as $key=>$tt)
        <tr>
            <td style="text-align: center">{{$key+1}}</td>
            <td style="text-align: center">
                @if($tt->plhs == 'GG') Giảm giá @elseif($tt->plhs == 'LD') 'Lần đầu' @else Tăng giá @endif
            </td>
            <td style="text-align: center">{{getDayVn($tt->ngaynhap)}}- {{getDayVn($tt->ngayhieuluc)}}</td>
            <td style="text-align: center">{{$tt->socv}}</td>
            <td style="text-align: center">{{$tt->socvlk}}</td>
            <td>
                <a href="{{url('/ke_khai_dich_vu_luu_tru/report_ke_khai/'.$tt->mahs)}}" target="_blank" style="background-color: #eee">Xem HS tại thời điểm này</a>
            </td>
        </tr>
    @endforeach


</table>
</body>
</html>