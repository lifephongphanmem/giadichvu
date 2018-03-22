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

<table width="96%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr>
        <td>Phân loại hồ sơ: @if($model->plhs == 'GG') Giảm giá @elseif($model->plhs == 'LD') 'Lần đầu' @else Tăng giá @endif</td>
        <td>Ngày kê khai: {{getDayVn($model->ngaynhap)}}</td>
        <td>Ngày áp dụng: {{getDayVn($model->ngayhieuluc)}}</td>
    </tr>
    <tr>
        <td>Số công văn : {{$model->socv}}</td>
        <td>Số công văn liền kề: {{$model->socvlk}}</td>
        <td>Ngày số công văn liền kề: {{getDayVn($model->ngaycvlk)}}</td>

    </tr>

</table>
<br>
<table width="96%" border="1" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr bgcolor="#efefef" style="text-align: center">
        <td><b>STT</b></td>
        <td><b>Loại phòng- quy cách chất lượng</b></td>
        <td><b>Số hiệu phòng</b></td>
        <td><b>Đối tươpng</b></td>
        <td><b>Áp dụng</b></td>
        <td><b>Mức giá liền kề</b></td>
        <td><b>Mức giá kê khai</b></td>
        <td><b>Ghi chú</b></td>
    </tr>
    @foreach($modelct as $key=>$tt)
        <tr>
            <th style="text-align: center">{{$key+1}}</th>
            <th style="text-align: left">{{$tt->loaip.'-'.$tt->qccl}}</th>
            <th style="text-align: left">{{$tt->sohieu}}</th>
            <th style="text-align: left">{{$tt->tendoituong}}</th>
            <th style="text-align: left">{{$tt->apdung}}</th>
            <th style="text-align: right">{{number_format($tt->mucgialk)}}</th>
            <th style="text-align: right">{{number_format($tt->mucgiakk)}}</th>
            <th>{{$tt->ghichu}}</th>
        </tr>
    @endforeach


</table>
<br>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="border-collapse: collapse; margin: auto;">
    <tr><td>Thông tin kê khai:</td>

    </tr>
    <tr><td>{!! nl2br(e($model->ghichu)) !!}</td></tr>
</table>
<div class="col-md-12" style="text-align: center">
    <a href="{{url('ke_khai_dich_vu_luu_tru/'.$model->mahs.'/history')}}">Quay lại</a>
</div>
</body>
</html>