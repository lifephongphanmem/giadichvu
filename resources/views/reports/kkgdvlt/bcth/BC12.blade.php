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
            BÁO CÁO HỒ SƠ KÊ KHAI GIÁ BỊ TRẢ LẠI
        </td>
    </tr>
</table>
<p style="text-align: center">Từ ngày {{getDayVn($input['ngaytu'])}} - Đến ngày {{getDayVn($input['ngayden'])}}</p>

<table cellspacing="0" cellpadding="0" border="1" style="margin: 20px auto; border-collapse: collapse;">
    <tr>
        <th>STT</th>
        <th width="30%">Tên doanh nghiệp<br>Tên cơ sở kinh doanh</th>
        <th width="15%">Số hồ sơ<br>Ngày chuyển</th>
        <th>Lý do trả lại- Ngày trả lại</th>
    </tr>
    @foreach($model as $key=>$tt)
    <tr>
        <td>{{$key+1}}</td>
        <td>Doanh nghiệp: {{$tt->tendn}}<br>Cơ sở Kinh doanh: {{$tt->tencskd}}</td>
        <td>Số hồ sơ: {{$tt->socv}}<br>Ngày chuyển: {{getDateTime($tt->ngaychuyen)}}</td>
        <td>Lý do: {{$tt->lydo}}<br>Ngày trả lại: {{getDateTime($tt->created_at)}}</td>
    </tr>
    @endforeach

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