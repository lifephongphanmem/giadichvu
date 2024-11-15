<?php
function getPermissionDefault($level)
{
    $roles = array();

    $roles['T'] = array(
        'dvlt' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtxk' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtxb' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtxtx' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtch' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvgs' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvtacn' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvlt' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtxk' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtxb' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtxtx' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtch' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvgs' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
        'kkdvtacn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
    );
    $roles['H'] = array(
        'dvlt' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtxk' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtxb' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtxtx' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvvtch' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvgs' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'dvtacn' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvlt' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtxk' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtxb' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtxtx' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvvtch' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
        'kkdvgs' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),

        'kkdvtacn' => array(
            'index' => 1,
            'create' => 0,
            'edit' => 0,
            'delete' => 0,
            'approve' => 1
        ),
    );
    $roles['DVLT'] = array(
        'dvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkdvlt' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
    );
    $roles['DVVT'] = array(
        'dvvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkdvvtxk' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
        'dvvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkdvvtxb' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
        'dvvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkdvvtxtx' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
        'dvvtch' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkdvvtch' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
    );
    $roles['DVGS'] = array(
        'dvgs' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
        ),
        'kkdvgs' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
    );
    $roles['DVTACN'] = array(
        'dvtacn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
        'kkdvtacn' => array(
            'index' => 1,
            'create' => 1,
            'edit' => 1,
            'delete' => 1,
            'approve' => 1
        ),
    );
    return json_encode($roles[$level]);
}

function getNam()
{
    $a_nam = [];
    for ($i = date('Y') - 10; $i <= date('Y') + 1; $i++)
        $a_nam[$i] = $i;
    return $a_nam;
}

function getDayVn($date)
{
    if ($date != null || $date != '')
        $newday = date('d/m/Y', strtotime($date));
    else
        $newday = '';
    return $newday;
}
function getDateTime($date)
{
    if ($date != null)
        $newday = date('d/m/Y H:i:s', strtotime($date));
    else
        $newday = '';
    return $newday;
}

function getDbl($obj)
{
    $obj = str_replace(',', '', $obj);
    $obj = str_replace('.', '', $obj);
    if (is_numeric($obj)) {
        return $obj;
    } else
        return 0;
}

function can($module = null, $action = null)
{
    $permission = !empty(session('admin')->permission) ? session('admin')->permission : getPermissionDefault(session('admin')->level);
    $permission = json_decode($permission, true);

    //check permission
    if (isset($permission[$module][$action]) && $permission[$module][$action] == 1 || session('admin')->sadmin == 'ssa') {
        return true;
    } else
        return false;
}


function canGeneral($module = null, $action = null)
{
    $model = \App\GeneralConfigs::first();
    $setting = json_decode($model->setting, true);

    if (isset($setting[$module][$action]) && $setting[$module][$action] == 1)
        return true;
    else
        return false;
}

function canDvCc($module = null, $action = null)
{
    $permission = !empty(session('ttdnvt')->dvcc) ? session('ttdnvt')->dvcc : getDvCcDefault('T');
    $permission = json_decode($permission, true);

    //check permission
    if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
        return true;
    } else
        return false;
}

function canDV($perm = null, $module = null, $action = null)
{
    if ($perm == '') {
        return false;
    } else {
        $permission = json_decode($perm, true);
        if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
            return true;
        } else
            return false;
    }
}

function getGeneralConfigs()
{
    return \App\GeneralConfigs::all()->first()->toArray();
}

function getDouble($str)
{
    $sKQ = 0;
    $str = str_replace(',', '', $str);
    $str = str_replace('.', '', $str);
    //if (is_double($str))
    $sKQ = $str;
    return floatval($sKQ);
}

function canDVVT($setting = null, $module = null, $action = null)
{
    $setting = json_decode($setting, true);

    //check permission
    if (isset($setting[$module][$action]) && $setting[$module][$action] == 1) {
        return true;
    } else
        return false;
}

function canshow($module = null, $action = null)
{
    $permission = !empty(session('admin')->dvvtcc) ? session('admin')->dvvtcc : '{"dvvt":{"vtxk":"1","vtxb":"1","vtxtx":"1","vtch":"1"}}';
    $permission = json_decode($permission, true);

    //check permission
    if (isset($permission[$module][$action]) && $permission[$module][$action] == 1) {
        return true;
    } else
        return false;
}

function chuyenkhongdau($str)
{
    if (!$str) return false;
    $utf8 = array(
        'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ|Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
        'd' => 'đ|Đ',
        'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ|É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
        'i' => 'í|ì|ỉ|ĩ|ị|Í|Ì|Ỉ|Ĩ|Ị',
        'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ|Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
        'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự|Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
        'y' => 'ý|ỳ|ỷ|ỹ|ỵ|Ý|Ỳ|Ỷ|Ỹ|Ỵ',
    );
    foreach ($utf8 as $ascii => $uni) $str = preg_replace("/($uni)/i", $ascii, $str);
    return $str;
}

function chuanhoachuoi($text)
{
    $text = strtolower(chuyenkhongdau($text));
    $text = str_replace("ß", "ss", $text);
    $text = str_replace("%", "", $text);
    $text = preg_replace("/[^_a-zA-Z0-9 -]/", "", $text);
    $text = str_replace(array('%20', ' '), '-', $text);
    $text = str_replace("----", "-", $text);
    $text = str_replace("---", "-", $text);
    $text = str_replace("--", "-", $text);
    return $text;
}

function chuanhoatruong($text)
{
    $text = strtolower(chuyenkhongdau($text));
    $text = str_replace("ß", "ss", $text);
    $text = str_replace("%", "", $text);
    $text = preg_replace("/[^_a-zA-Z0-9 -]/", "", $text);
    $text = str_replace(array('%20', ' '), '_', $text);
    $text = str_replace("----", "_", $text);
    $text = str_replace("---", "_", $text);
    $text = str_replace("--", "_", $text);
    return $text;
}

function getAddMap($diachi)
{
    $str = chuyenkhongdau($diachi);
    $str = str_replace(' ', '+', $str);
    $geocode = file_get_contents('http://maps.google.com/maps/api/geocode/json?address=' . $str . '&sensor=false');
    $output = json_decode($geocode);
    if ($output->status == 'OK') {
        $kq = $output->results[0]->geometry->location->lat . ',' . $output->results[0]->geometry->location->lng;
    } else {
        $kq = '';
    }
    return $kq;
}

function getPhanTram1($giatri, $thaydoi)
{
    $kq = 0;
    if ($thaydoi == 0 || $giatri == 0) {
        return '';
    }
    if ($giatri < $thaydoi) {
        $kq = round((($thaydoi - $giatri) / $giatri) * 100, 2) . '%';
    } else {
        $kq = '-' . round((($giatri - $thaydoi) / $giatri) * 100, 2) . '%';
    }
    return $kq;
}

function getPhanTram2($giatri, $thaydoi)
{
    if ($thaydoi == 0 || $giatri == 0) {
        return '';
    }
    return round(($thaydoi / $giatri) * 100, 2) . '%';
}

function getDateToDb($value)
{
    if ($value == '') {
        return null;
    }
    $str =  strtotime(str_replace('/', '-', $value));
    $kq = date('Y-m-d', $str);
    return $kq;
}

function getMoneyToDb($value)
{
    $kq = str_replace(',', '', $value);
    $kq = str_replace('.', '', $kq);
    return $kq;
}

function getRandomPassword()
{
    $bytes = random_bytes(3); // length in bytes
    $kq = (bin2hex($bytes));
    return $kq;
}

function getSoNnSelectOptions()
{

    $start = '1';
    $stop = '10';
    $options = array();

    for ($i = $start; $i <= $stop; $i++) {

        $options[$i] = $i;
    }
    return $options;
}

function getNgayHieuLuc($ngaynhap)
{
    $dayngaynhap = date('D', strtotime($ngaynhap));
    if ($dayngaynhap == 'Thu') {
        $ngayhieuluc  =  date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 5, date("Y")));
    } elseif ($dayngaynhap == 'Fri') {
        $ngayhieuluc  =  date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 5, date("Y")));
    } elseif ($dayngaynhap == 'Sat') {
        $ngayhieuluc  =  date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 4, date("Y")));
    } else {
        $ngayhieuluc  =  date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 3, date("Y")));
    }
    return $ngayhieuluc;
}
function getNgayHieuLucLT($ngaynhap)
{
    $dayngaynhap = date('D', strtotime($ngaynhap));
    $thoihan = isset(getGeneralConfigs()['thoihan_lt']) || getGeneralConfigs()['thoihan_lt'] != 0 ? getGeneralConfigs()['thoihan_lt'] : 2;

    $modelchecknn = \App\TtNgayNghiLe::where('ngaytu', '<=', $ngaynhap)
        ->where('ngayden', '>=', $ngaynhap)->first();
    if (count((array) $modelchecknn) > 0)
        $ngaynghi = $modelchecknn->songaynghi;
    else
        $ngaynghi = 0;

    if ($dayngaynhap == 'Thu') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 2 + $thoihan + $ngaynghi, date("Y")));
    } elseif ($dayngaynhap == 'Fri') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 2 + $thoihan + $ngaynghi, date("Y")));
    } elseif ($dayngaynhap == 'Sat') {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + 1 + $thoihan + $ngaynghi, date("Y")));
    } else {
        $ngayhieuluc = date('Y-m-d', mktime(0, 0, 0, date("m"), date("d") + $thoihan + $ngaynghi, date("Y")));
    }
    return $ngayhieuluc;
}

function getTtPhong($str)
{
    $str = str_replace(',', ', ', $str);
    $str = str_replace('.', '. ', $str);
    $str = str_replace(';', '; ', $str);
    $str = str_replace('-', '- ', $str);
    return $str;
}

function getThXdHsDvLt($ngaychuyen, $ngayduyet)
{
    //Kiểm tra giờ chuyển quá 16h thì sang ngày sau
    //if (date('H', strtotime($ngaychuyen)) > 16) {
    //Không tính ngày chuyển hs, ngày tiếp theo sẽ là ngày xét duyệt
    $date = date_create($ngaychuyen);
    $datenew = date_modify($date, "+1 days");
    $ngaychuyen = date_format($datenew, "Y-m-d");
    /*} else {
        $ngaychuyen = date("Y-m-d",strtotime($ngaychuyen));
    }*/
    $ngaylv = 0;
    while (strtotime($ngaychuyen) <= strtotime($ngayduyet)) {
        $checkngay = \App\TtNgayNghiLe::where('ngaytu', '<=', $ngaychuyen)
            ->where('ngayden', '>=', $ngaychuyen)->first();
        if (count((array)$checkngay) > 0)
            $ngaylv = $ngaylv;
        elseif (date('D', strtotime($ngaychuyen)) == 'Sat')
            $ngaylv = $ngaylv;
        elseif (date('D', strtotime($ngaychuyen)) == 'Sun')
            $ngaylv = $ngaylv;
        else
            $ngaylv = $ngaylv + 1;
        $datestart = date_create($ngaychuyen);
        $datestartnew = date_modify($datestart, "+1 days");
        $ngaychuyen = date_format($datestartnew, "Y-m-d");
    }
    if ($ngaylv < getGeneralConfigs()['thoihan_lt']) {
        $thoihan = 'Trước thời hạn';
    } elseif ($ngaylv == getGeneralConfigs()['thoihan_lt']) {
        $thoihan = 'Đúng thời hạn';
    } else {
        $thoihan = 'Quá thời hạn';
    }
    return $thoihan;
}
function guitin($YourPhone, $content)
{
    $APIKey = "1D6D739D178D0BC1F10A6FF3BFB3F9";
    $SecretKey = "E1C6228918BFC383CB96DBAF3C6514";
    $ch = curl_init();


    $SampleXml = "<RQST>"
        . "<APIKEY>" . $APIKey . "</APIKEY>"
        . "<SECRETKEY>" . $SecretKey . "</SECRETKEY>"
        . "<SMSTYPE>2</SMSTYPE>"
        . "<CONTENT>" . $content . "</CONTENT>"
        . "<BRANDNAME>QCAO_ONLINE</BRANDNAME>"
        . "<CONTACTS>"
        . "<CUSTOMER>"
        . "<PHONE>" . $YourPhone . "</PHONE>"
        . "</CUSTOMER>"
        . "</CONTACTS>"
        . "</RQST>";


    curl_setopt($ch, CURLOPT_URL,            "http://api.esms.vn/MainService.svc/xml/SendMultipleMessage_V4/");
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_POST,           1);
    curl_setopt($ch, CURLOPT_POSTFIELDS,     $SampleXml);
    curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: text/plain'));

    $result = curl_exec($ch);
    $xml = simplexml_load_string($result);

    if ($xml === false) {
        die('Error parsing XML');
    }
    print "Ket qua goi API: " . $xml->CodeResult . "\n";
}

function  guitinjson($YourPhone, $Content)
{

    $APIKey = "1D6D739D178D0BC1F10A6FF3BFB3F9";
    $SecretKey = "E1C6228918BFC383CB96DBAF3C6514";

    $SendContent = urlencode($Content);
    $data = "http://rest.esms.vn/MainService.svc/json/SendMultipleMessage_V4_get?Phone=$YourPhone&ApiKey=$APIKey&SecretKey=$SecretKey&Content=$SendContent&Brandname=STCKhanhHoa&SmsType=2";
    $curl = curl_init($data);
    curl_setopt($curl, CURLOPT_FAILONERROR, true);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);

    $obj = json_decode($result, true);
    if ($obj['CodeResult'] == 100) {
        print "<br>";
        print "CodeResult:" . $obj['CodeResult'];
        print "<br>";
        print "CountRegenerate:" . $obj['CountRegenerate'];
        print "<br>";
        print "SMSID:" . $obj['SMSID'];
        print "<br>";
    } else {
        print "ErrorMessage:" . $obj['ErrorMessage'];
    }
}
