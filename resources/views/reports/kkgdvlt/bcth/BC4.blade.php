<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html lang="vi">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{$pageTitle}}</title>
    <style type="text/css">
        body {
            font: normal 14px/16px time, serif;
        }

        table, p {
            width: 98%;
            margin: auto;
        }

        table tr td:first-child {
            text-align: center;
        }

        td, th {
            padding: 10px;
        }
        p{
            padding: 5px;
        }
        span{
            text-transform: uppercase;
            font-weight: bold;

        }
    </style>
</head>
<body style="font:normal 14px Times, serif;">

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td width="40%" style="text-transform: uppercase;">
            <b>{{(isset($modelcqcq)? $modelcqcq->tendv : '')}}</b><br>
            --------<br>
        </td>
        <td>
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br>
            <b><i><u>Độc lập - Tự do - Hạnh phúc</u></i></b><br>
        </td>
    </tr>
</table>

<p style="text-align: center; font-weight: bold; font-size: 16px;">BÁO CÁO THỐNG KÊ CHI TIẾT ĐƠN VỊ KÊ KHAI GIÁ</p>
<p style="text-align: center; font-weight: bold;">Từ ngày: {{getDayVn($input['ngaytu'])}} đến ngày {{getDayVn($input['ngayden'])}} </p>
<p style="text-align: center; font-weight: bold;">Tên đơn vị: {{$m_donvi->tendn}}</p>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
    <tr>
        <th>STT</th>
        <th>Loại phòng</th>
        <th>Quy cách chất lượng</th>
        <th>Số hiệu phòng</th>
        <th>Mức giá kê khai liền kề</th>
        <th>Mức giá kê</th>
        <th>Mức tăng giảm</th>
        <th>Tỷ lệ (%)</th>
    </tr>

    @foreach($model as $cskd)
        <tr>
            <th style="text-align: left" colspan="8">
                {{$cskd->tencskd}}-Loại hạng {{$cskd->loaihang}}-ngày kê khai {{getDayVn($cskd->ngaynhap)}}- ngày thực hiện mức giá kê khai {{getDayVn($cskd->ngayhieuluc)}}
                - Trạng thái hồ sơ {{$cskd->trangthai}}
            </th>
        </tr>
        <?php $m_kk=$modelctkk->where('mahs',$cskd->mahs) ?>
            <?php $i=1;?>
        @foreach($m_kk as $key=>$ctkk)
            <tr>
                <th style="text-align: center">{{$i++}}</th>
                <th style="text-align: left">{{$ctkk->loaip}}</th>
                <th style="text-align: left">{{$ctkk->qccl}}</th>
                <th style="text-align: left">{{$ctkk->sohieu}}</th>
                <th style="text-align: right">{{number_format($ctkk->mucgialk)}}</th>
                <th style="text-align: right">{{number_format($ctkk->mucgiakk)}}</th>
                <th style="text-align: right">
                    <?php
                    if($ctkk->mucgialk>0)
                        if($ctkk->mucgialk>$ctkk->mucgiakk)
                            echo '-'.number_format($ctkk->mucgialk-$ctkk->mucgiakk);
                        else
                            echo number_format($ctkk->mucgiakk-$ctkk->mucgialk);
                    ?>
                </th>
                <th style="text-align: right">
                    <?php
                    if($ctkk->mucgialk>0)
                        if($ctkk->mucgialk>$ctkk->mucgiakk)
                            echo '-'.round(($ctkk->mucgialk-$ctkk->mucgiakk)/$ctkk->mucgialk * 100, 2) . '%';
                        else
                            echo round(($ctkk->mucgiakk-$ctkk->mucgialk)/$ctkk->mucgiakk*100,2) . '%';
                    ?>
                </th>
            </tr>

        @endforeach
    @endforeach
    <tr>
        <th style="text-align: left" colspan="8">
            {{'Tổng cộng: '. count($model).' hồ sơ.'}}
        </th>
    </tr>

</table>
<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:20px auto; text-align: center;">
    <tr>
        <td style="text-align: left;" width="30%">

        </td>
        <td style="text-align: center;text-transform: uppercase; " width="70%">
            <b></b><br>
        </td>
    </tr>

</table>
</body>
</html>