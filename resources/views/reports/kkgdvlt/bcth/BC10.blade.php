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
        span {
            text-transform: uppercase;
            font-weight: bold;
        }

        @media print {
            .in{
                display: none !important;
            }
        }
    </style>
    <link rel="shortcut icon" href="{{ url('images/LIFESOFT.png')}}" type="image/x-icon">
</head>

<div class="in" style="margin-left: 20px;">
    <input type="submit" onclick=" window.print()" value="In báo cáo"  />
</div>

<body style="font:normal 14px Times, serif;">

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td colspan="2" style="text-transform: uppercase;">
            <b>{{(isset($modelcqcq)? $modelcqcq->tendv : '')}}</b>
        </td>
        <td colspan="6">
            <b>CỘNG HÒA XÃ HỘI CHỦ NGHĨA VIỆT NAM</b><br>
        </td>
    </tr>
    <tr>
        <td colspan="2" style="text-transform: uppercase;">
            --------
        </td>
        <td colspan="6">
            <b><i><u>Độc lập - Tự do - Hạnh phúc</u></i></b>
        </td>
    </tr>
</table>

<table width="96%" border="0" cellspacing="0" cellpadding="8" style="margin:0 auto 20px; text-align: center;">
    <tr>
        <td colspan="8" style="text-align: center; font-weight: bold; font-size: 16px;">
            BÁO CÁO THỐNG KÊ CƠ SỞ KINH DOANH DỪNG HOẠT ĐỘNG
        </td>
    </tr>
</table>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
    <thead>
    <tr>
        <th>STT</th>
        <th>Doanh nghiệp</th>
        <th>Mã số thuế</th>
        <th>Tên cơ sở kinh doanh</th>
        <th>Thời gian dừng hoạt động</th>
    </tr>
    </thead>
    <tbody>
    @foreach($model as $key=>$cskd)
        <tr>
            <td style="text-align: center">{{$key+1}}</td>
            <td>{{$cskd->tendn}}</td>
            <td>{{$cskd->masothue}}</td>
            <td>{{$cskd->tencskd}}</td>
            <td>{{getDateTime($cskd->updated_at)}}</td>
        </tr>
    @endforeach
    </tbody>
    <tr>
        <th style="text-align: left" colspan="8">
            {{'Tổng cộng: '. count($model).' hồ sơ.'}}
        </th>
    </tr>

</table>

<table width="96%" border="0" cellspacing="0" cellpadding="8">
    <tr>
        <td style="text-align: left;" width="50%">

        </td>

        <td style="text-align: center;" width="50%">
            <b>GIÁM ĐỐC</b></br>(Ký tên và đóng dấu)
        </td>
    </tr>

    <tr>
        <td style="text-align: left;" width="50%">

        </td>

        <td style="text-align: center;text-transform: uppercase; " width="50%">
            </br></br></br></br></br>
        </td>
    </tr>
</table>
</body>
</html>