<?php
function attachServiceWorker() {
    // {{-- Service Worker --}}
    // {{-- aktifkan service worker hanya jika aplikasi punya secure connections (untuk menghindari MITM Attack) --}}
    $sw_whitelist = array(
        'localhost',
        '127.0.0.1',
        '::1'
    );

    if(\Request::secure() || in_array($_SERVER['REMOTE_ADDR'], $sw_whitelist)){
        return '
            <script>
                window.__ROOT__ = "'.url('').'";
            </script>
            <script type="text/javascript" src="'.url('/sw.js').'"></script>
        ';
    }

    return "";
}

function timediff($firstTime,$lastTime) {
    //selisih waktu/jam dalam detik
    $firstTime=strtotime($firstTime);
    $lastTime=strtotime($lastTime);
    if($lastTime < $firstTime) {
        $lastTime += 24 * 60 * 60;
    }
    $timeDiff=$lastTime-$firstTime;
    return $timeDiff;
}

function clearWhitespaces($string) {
    return trim(preg_replace('/\s+/s', " ", $string));
}

function htmlValue($string) {
    return
        str_replace('"', "&quot;",
        str_replace("'", '&#39;',
        str_replace('<', '&lt;',
        str_replace('&', "&amp;",
    $string))));
}

function jsValue($string) {
    return
        preg_replace('/\r?\n/', "\\n",
        str_replace('"', "\\\"",
        str_replace("'", "\\'",
        str_replace("\\", "\\\\",
    $string))));
}

function xmlData($string, $cdata=false) {
    $string = str_replace("]]>", "]]]]><![CDATA[>", $string);
    if (!$cdata)
        $string = "<![CDATA[$string]]>";
    return $string;
}


// function compressCSS($code) {
//     $code = self::clearWhitespaces($code);
//     $code = preg_replace('/ ?\{ ?/', "{", $code);
//     $code = preg_replace('/ ?\} ?/', "}", $code);
//     $code = preg_replace('/ ?\; ?/', ";", $code);
//     $code = preg_replace('/ ?\> ?/', ">", $code);
//     $code = preg_replace('/ ?\, ?/', ",", $code);
//     $code = preg_replace('/ ?\: ?/', ":", $code);
//     $code = str_replace(";}", "}", $code);
//     return $code;
// }

function uang($nominal = ''){
    if ($nominal == ''){
        return '';
    }
    else{
        return '&nbsp;'.@number_format($nominal,0,',','.');
    }
}

function get_duplicate_array( $array ) {
    return array_unique( array_diff_assoc( $array, array_unique( $array ) ) );
}

function remove_letter($str =''){
    return preg_replace("/[^0-9,.]/", "", $str);
}

function debug($s='',$die=true){
    echo '<pre>';
    print_r($s);
    echo '</pre>';
    if($die == true){
        die();
    }
}


function jam_tabrakan($s1='',$e1='',$s2='',$e2=''){
    if(
            ($s1 == $s2 || $e1 == $e2) ||
            ($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2) ||
//            ($s1 >= $s2 && $e1 >= $e2 && $s1 <= $e2) ||
            ($s1 >= $s2 && $e1 >= $e2 && $s1 < $e2) ||
            ($s1>=$s2 && $e1<=$e2) ||
            ($s1<=$s2 && $e1>=$e2)
            ){
//        if(($s1 == $s2 || $e1 == $e2)){
//            echo 'Kondisi 1<br>';
//        }
//        if($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2){
//            echo 'Kondisi 2<br>';
//        }
//        if($s1 >= $s2 && $e1 >= $e2 && $s1 < $e2){
//            echo 'Mulai 1 = '.$s1.'<br>';
//            echo 'Selesai 1 = '.$e1.'<br>';
//            echo 'Mulai 2 = '.$s2.'<br>';
//            echo 'Selesai 2 = '.$e2.'<br>';
//            echo 'Kondisi 3<br>';
//        }
//        if($s1>=$s2 && $e1<=$e2){
//            echo 'Kondisi 4<br>';
//        }
//        if($s1<=$s2 && $e1>=$e2){
//            echo 'Kondisi 5<br>';
//        }
        return true;
            }else{
        return false;
            }
//    if(
//            ($s1 == $s2 || $e1 == $e2) ||
//            ($s1 <= $s2 && $e1 <= $e2 && $e1 >= $s2) ||
//            ($s1 >= $s2 && $e1 >= $e2 && $s1 <= $e2) ||
//            ($s1>=$s2 && $e1<=$e2) ||
//            ($s1<=$s2 && $e1>=$e2)
//            ){
//        return true;
//            }else{
//        return false;
//            }
}



function rangesNotOverlapClosed($start_time1,$end_time1,$start_time2,$end_time2){
  $utc = new DateTimeZone('UTC');

  $start1 = new DateTime($start_time1,$utc);
  $end1 = new DateTime($end_time1,$utc);
  if($end1 < $start1)
    throw new Exception('Range is negative.');

  $start2 = new DateTime($start_time2,$utc);
  $end2 = new DateTime($end_time2,$utc);
  if($end2 < $start2)
    throw new Exception('Range is negative.');
  return ($end1 < $start2) || ($end2 < $start1);
}

function rangesNotOverlapOpen($start_time1,$end_time1,$start_time2,$end_time2)
{
  $utc = new DateTimeZone('UTC');

  $start1 = new DateTime($start_time1,$utc);
  $end1 = new DateTime($end_time1,$utc);
  if($end1 < $start1)
    throw new Exception('Range is negative.');

  $start2 = new DateTime($start_time2,$utc);
  $end2 = new DateTime($end_time2,$utc);
  if($end2 < $start2)
    throw new Exception('Range is negative.');

  return ($end1 <= $start2) || ($end2 <= $start1);
}



function spasi($rekursive = 1){
    for($a=1 ; $a <= $rekursive ; $a++){
        echo '&nbsp;';
    }
}

function get_client_ip() {
	$ipaddress = '';
        if($_SERVER['REMOTE_ADDR']){
		$ipaddress = $_SERVER['REMOTE_ADDR'];
        }else{
		$ipaddress = 'UNKNOWN';
        }

	return $ipaddress;
}

    function formatTanggalPanjang($tanggal) {
        if(substr($tanggal, 0,9) != '00-00-000' || substr($tanggal, 0,9) != ''){
            $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
            list($thn,$bln,$tgl)=explode("-",$tanggal);
            $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
            return $tgl." ".$aBulan[$bln]." ".$thn;
        }else{
            return '';
        }
    }

    function formatBulanTahun($tanggal) {
        $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
        list($thn,$bln,$tgl)=explode("-",$tanggal);
        $bln = (($bln >0 ) && ($bln < 10))? substr($bln,1,1): $bln ;
        return $aBulan[$bln]." ".$thn;
    }

function tanggal($date = 1){
    if(substr($date, 0,9) != '00-00-000' || substr($date, 0,9) != '00/00/000' || substr($date, 0,9) != '' || substr($date, 0,9) != NULL ){
        date_default_timezone_set('Asia/Jakarta'); // your reference timezone here
    //    $date = date('Y-m-d', strtotime($date)); // ubah sesuai format penanggalan standart
        $date = date('Y-m-j', strtotime($date)); // ubah sesuai format penanggalan standart
        if($date != '1970-01-01' && $date != '1970-01-1'){
//            echo $date.'<br>';
            $bulan = array ('01'=>'Januari', // array bulan konversi
                    '02'=>'Februari',
                    '03'=>'Maret',
                    '04'=>'April',
                    '05'=>'Mei',
                    '06'=>'Juni',
                    '07'=>'Juli',
                    '08'=>'Agustus',
                    '09'=>'September',
                    '10'=>'Oktober',
                    '11'=>'November',
                    '12'=>'Desember'
            );
            $date = explode ('-',$date); // ubah string menjadi array dengan paramere '-'

            return @$date[2] . ' ' . @$bulan[$date[1]] . ' ' . @$date[0]; // hasil yang di kembalikan}
        }else{
            return '';
        }

    }else{
        return '';
    }
}

function romawi($n = '1'){
    $hasil = '';
    $iromawi = array('','I','II','III','IV','V','VI','VII','VIII','IX','X',
        20=>'XX',30=>'XXX',40=>'XL',50=>'L',60=>'LX',70=>'LXX',80=>'LXXX',
        90=>'XC',100=>'C',200=>'CC',300=>'CCC',400=>'CD',500=>'D',
        600=>'DC',700=>'DCC',800=>'DCCC',900=>'CM',1000=>'M',
        2000=>'MM',3000=>'MMM');

    if(array_key_exists($n,$iromawi)){
        $hasil = $iromawi[$n];
    }elseif($n >= 11 && $n <= 99){
        $i = $n % 10;
        $hasil = $iromawi[$n-$i] . Romawi($n % 10);
    }elseif($n >= 101 && $n <= 999){
        $i = $n % 100;
        $hasil = $iromawi[$n-$i] . Romawi($n % 100);
    }else{
        $i = $n % 1000;
        $hasil = $iromawi[$n-$i] . Romawi($n % 1000);
    }
    return $hasil;
}

function combo_jnskelamin($id ='',$selected=""){
    $h = "<select id='$id' name='$id' style='width:100%'>";
    $h .= '<option value="">Pilih Jenis Kelamin</option>';
    $h .= '<option '.(($selected == '1')?'selected':'').' value="1">Laki-laki</option>';
    $h .= '<option '.(($selected == '2')?'selected':'').' value="2">Perempuan</option>';
    $h .= '</select>';
    return $h;
}


function select_hari($id = 0,$selected=''){
    $hari = array("-", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu","All Day");
    return Form::select($id,$hari,$selected,array('style' => 'width:100%'));
}

function array_hari($id = 0,$selected=''){
    $hari = array("-", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu","Minggu","All Day");
    return $hari;
}

function date_picker($id = 'asa',$value=""){
    return '<script>'
    .'$(document).ready(function(){'
    .'$(".tgl").datetimepicker({format: "YYYY-MM-DD"});'
    .'})</script>'
    .'<input type="text" class="form-control tgl" value="'.$value.'" id="'.$id.'" name="'.$id.'"  placeholder="Masukkan Tanggal">';
}

function tanggal_indonesia(){
    $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
//    $cetak_date = $hari[(int)date("w")] .', '. date("j ") . $bulan[(int)date('m')] . date(" Y");
    $cetak_date = date("j ") . $bulan[(int)date('m')] . date(" Y");
    return $cetak_date ;
}

function sekarang(){
    return date("Y-m-d H:i:s");
}


function modal($sempit = false,$name = 'modal2',$body = 'Modal2',$minus=false){
    $class = ($sempit == false)?'modal-dialog-wide':'modal-dialog';
    $js = '<script>var duplicateChk = {};'
            .'$("div#modal2[class]").each (function (a) {'
            .'if (duplicateChk.hasOwnProperty(this.class)) {'
            .'alert("kembar");$(this).remove();'
            .'} else { duplicateChk[this.class] = "true";}});</script>';

    $min = ($minus == true)?'':'';
    $html =  '<div class="modal fade" id="'.$name.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="'.$class.'">
        <div class="modal-content" id="wadah_modal">
        <div class="modal-header bg-primary">
        <button onclick="claravel_modal_close('."'$name'".')" type="button" aria-hidden="true" class="btn btn-danger pull-right"><i class="glyphicon glyphicon-remove" ></i></button>
            '.$min.'
        <h4 class="modal-title"><b id="judulmodal"></b></h4>
      </div>
      <div class="modal-body">
        <div id="konten'.$body.'"></div>
      </div>
      <div class="modal-footer">
        <div id="footermodal"></div>
      </div>
    </div>
  </div>
</div>';
	return $html;
}

function catat_log($aksi = '',$modul=''){
    $simpan = array(
        'aksi' => $aksi,
        'module' => $modul,
        'user' => \Session::get('user_id'),
        'url' => \Request::url(),
        'waktu' => date("Y-m-d H:i:s")
    );
    $save = \DB::table('application_log')->insert($simpan);
}

function header_dokumen(){
    return '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap.css" />'.
            '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap-theme.css" />'.
            '<link rel="stylesheet" href="'.getBaseURL(true).'/packages/tugumuda/claravel/assets/css/bootstrap-icons.css" />';
}

function hari($hari){
    switch ($hari){
        case '0' :
            return '';
            break;
        case '1' :
            return 'Senin';
            break;
        case '2' :
            return 'Selasa';
            break;
        case '3' :
            return 'Rabu';
            break;
        case '4' :
            return 'Kamis';
            break;
        case '5' :
            return "Jum'at";
            break;
        case '6' :
            return 'Sabtu';
            break;
        case '7' :
            return 'Minggu';
            break;
    }
}

function konversi_hari($hari){
    $hari = date("l", strtotime($hari));
        switch ($hari){
        case 'Monday' :
            return 'Senin';
            break;
        case 'Thuesday' :
            return 'Selasa';
            break;
        case 'Wednesday' :
            return 'Rabu';
            break;
        case 'Thursday' :
            return 'Kamis';
            break;
        case 'Friday' :
            return "Jum'at";
            break;
        case 'Saturday' :
            return 'Sabtu';
            break;
        case 'Sunday' :
            return 'Minggu';
            break;
    }
};

function cekLogin(){
    $user = \Session::get('user_id');
    $role = \Session::get('role_id');
    return (!$user || !$role)?false:TRUE;
    //if (!$user || !$role){die('Invalid Access :: You must sign in first !!<br><br><i>With Love :: Developer</i>');}
}

function cekAjax(){
    if( ! \Request::ajax()) {
        $request_url = urlencode(\Request::path());
        $query_string = Request::getQueryString() ? '&'.Request::getQueryString() : '';

        \App::abort(302, '', ['Location' => url('beranda?tab='.$request_url.$query_string)]);
    }
    // if (!\Request::ajax()){die('Invalid URL Request<br><br><i>With Love :: Developer</i>');}
}

function get_role(){
    return \Session::get('role_id');
}

function user_id(){
    return \Session::get('user_id');
}

//START CREATED BY WIGUNA ON 16 MARET

function inputWarna($id='',$selected=""){
    $a1 = ($selected == 'bg-color-blue')?' selected ':' ';
    $a2 = ($selected == 'bg-color-blueDark')?' selected ':' ';
    $a3 = ($selected == 'bg-color-darken')?' selected ':' ';
    $a4 = ($selected == 'bg-color-green')?' selected ':' ';
    $a5 = ($selected == 'bg-color-greenDark')?' selected ':' ';
    $a6 = ($selected == 'bg-color-orange')?' selected ':' ';
    $a7 = ($selected == 'bg-color-pink')?' selected ':' ';
    $a8 = ($selected == 'bg-color-purple')?' selected ':' ';
    $a9 = ($selected == 'bg-color-yellow')?' selected ':' ';
    $a10 = ($selected == 'bg-color-red')?' selected ':' ';
    $html = '<select id="'.$id.'" name="'.$id.'">
            <option '.$a1.'value="bg-color-blue">Biru</option>
            <option '.$a2.'value="bg-color-blueDark">Biru Gelap</option>
            <option '.$a3.'value="bg-color-darken">Gelap</option>
            <option '.$a4.'value="bg-color-green">Hijau</option>
            <option '.$a5.'value="bg-color-greenDark">Hijau Gelap</option>
            <option '.$a6.'value="bg-color-orange">Jingga</option>
            <option '.$a7.'value="bg-color-pink">Merah Muda</option>
            <option '.$a8.'value="bg-color-purple">Ungu</option>
            <option '.$a9.'value="bg-color-red">Merah</option>
            <option '.$a10.'value="bg-color-yellow">Kuning</option>
            </select>';
    return $html;
}


function isSecure() {
  return
    (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off')
    || $_SERVER['SERVER_PORT'] == 443;
}

function getBaseURL($with_http = false){
    /*
    $url = \Request::url();
    //    $url = str_replace('http://')
    $arrurl = explode('/',$url);
    if ($with_http == false){
        return $arrurl[2];
    }
    else{
        return (isSecure())?'https://'.$arrurl[2].'/':'http://'.$arrurl[2].'/';
        //return 'https://'.$arrurl[2].'/';
    }
    */
    return url();
}

function ambil_angka($a){
    return preg_replace('/[^\p{L}\p{N}\s]/u', '', $a);
}

function getBrowser() {
    $u_agent = $_SERVER['HTTP_USER_AGENT'];
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Internet Explorer';
        $ub = "MSIE";
    }
    elseif(preg_match('/Firefox/i',$u_agent))
    {
        $bname = 'Mozilla Firefox';
        $ub = "Firefox";
    }
    elseif(preg_match('/Chrome/i',$u_agent))
    {
        $bname = 'Google Chrome';
        $ub = "Chrome";
    }
    elseif(preg_match('/Safari/i',$u_agent))
    {
        $bname = 'Apple Safari';
        $ub = "Safari";
    }
    elseif(preg_match('/Opera/i',$u_agent))
    {
        $bname = 'Opera';
        $ub = "Opera";
    }
    elseif(preg_match('/Netscape/i',$u_agent))
    {
        $bname = 'Netscape';
        $ub = "Netscape";
    }

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'userAgent' => $u_agent,
        'name'      => $bname,
        'shortname'      => $ub,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}


function uang_akhir($nominal = ''){
    if ($nominal == ''){
        return 0;
    }
    else{
        if($nominal < 0){
            return '('.@number_format( ($nominal) * (-1) ,0,',','.').')';
        }else{
            return @number_format($nominal,0,',','.');
        }
    }
}

function is_url_exist($url){
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_NOBODY, true);
    curl_exec($ch);
    $code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    if($code == 200){
       $status = true;
    }else{
      $status = false;
    }
    curl_close($ch);
   return $status;
}

function number_format_persen($nominal,$desimal = 0){
    $desimal = (is_integer($nominal))?0:2;
    if(false === $nominal){
        return 100;
    }
    if ($nominal == ''){
        return 0;
    }
    else{
        if($nominal < 0){
            return '('.  @number_format($nominal * (-1),$desimal, "," , ".").')';
//            return '('.  number_format($nominal * (-1),2, "," , ".").')';
        }else{
//            return number_format($nominal,2, "," , ".");
            return @number_format($nominal,$desimal, "," , ".");
        }
    }
}


function td($array=array(),$tr = false){
    $t = ($tr)?'<tr>':'';
    foreach($array as $a){
        $t .= '<td>'.$a.'</td>';
    }
    $t .= ($tr)?'</tr>':'';
    return $t;
}

function th($array=array(),$tr = false){
    $t = ($tr)?'<tr>':'';
    foreach($array as $a){
        $t .= '<th>'.$a.'</th>';
    }
    $t .= ($tr)?'</tr>':'';
    return $t;
}

function array_msort($array, $cols)
{
    $colarr = array();
    foreach ($cols as $col => $order) {
        $colarr[$col] = array();
        foreach ($array as $k => $row) { $colarr[$col]['_'.$k] = strtolower($row[$col]); }
    }
    $eval = 'array_multisort(';
    foreach ($cols as $col => $order) {
        $eval .= '$colarr[\''.$col.'\'],'.$order.',';
    }
    $eval = substr($eval,0,-1).');';
    eval($eval);
    $ret = array();
    foreach ($colarr as $col => $arr) {
        foreach ($arr as $k => $v) {
            $k = substr($k,1);
            if (!isset($ret[$k])) $ret[$k] = $array[$k];
            $ret[$k][$col] = $array[$k][$col];
        }
    }
    return $ret;

}

function fix_view_css(){
    return "<style>table td{padding : 0.5px!important;}.form-group{margin-bottom : 5px!important;}</style>";
}

// tes buat fungsi
function helloworld(){
    return "Hello World";
}

/*combo list tingkat pendidikan*/
function comboTkpendidikan($id="idtkpendid", $sel="", $required="")
{
    // tag pembuka select tkpendidikan
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    // get data dari database table a_tkpendid
    // SELECT * FROM a_tkpendid ORDER BY idtkpendid ASC
    $rs = \DB::table('a_tkpendid')->orderBy('idtkpendid', 'asc')->get();

    // loop tag option (item data table_tkpendid)
    foreach ($rs as $item) {
        $isSel = (($item->idtkpendid==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idtkpendid."\" $isSel >".$item->tkpendid."</option>";
    }

    // tag penutup select tkpendidikan
    $ret.="</select>";

    // return html yang disimpan di var $ret
    return $ret;
}

/*cobo list Agama*/
function comboAgama($id="idagama", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_agama')->orderBy('idagama', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idagama==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idagama."\" $isSel >".$item->agama."</option>";
    }
    $ret.="</select>";
    return $ret;
}

function comboStsmarital($id="idstskawin", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_stskawin')->orderBy('idstskawin', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idstskawin==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idstskawin."\" $isSel >".$item->stskawin."</option>";
    }
    $ret.="</select>";
    return $ret;
}

function comboStsDujan($project_id="idstsdujan", $sel="", $required="")
{
    $dujan = array(
      '1' =>'Cerai',
      '2' =>'Meninggal',
  );
    $html = '<select id="'.$project_id.'" name="'.$project_id.'" class="form-control">';
    $html .= '<option value="">.: Pilihan :.</option>';
    $no=1;
    foreach ($dujan as $dj) {
        // $html .= '<option value='.$no.' '.(($sel==$no)?'selected':'').'>'.$dj.'</option>';
        $isSel = (($no==$sel)?"selected":"");
        $html.="<option value=\"".$no."\" $isSel >".$dj."</option>";
        $no++;
    }
    $html .= '</select>';
    return $html;
}

/*cobo list golongan darah*/
function comboGoldarah($id="idgoldarah", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_goldarah')->orderBy('idgoldarah', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idgoldarah==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idgoldarah."\" $isSel >".$item->goldarah."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list skpd unit*/
function comboSkpdunit($id="idskpd", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_skpd')->where('flag', 1)->where('idparent', '=', '')->orderBy('idskpd', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idskpd==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idskpd."\" $isSel >".$item->skpd."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list sub skpd unit*/
function comboSubskpd($id="idskpd", $sel="", $required="", $parent="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_skpd')->where('idparent', 'like', ''.$parent. '%')->orderBy('idskpd', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idskpd==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idskpd."\" $isSel >".$item->skpd."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list jenis kepegawaian*/
function comboJenkepeg($id="idjenkepeg", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_jenkepeg')->orderBy('jenkepeg', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idjenkepeg==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idjenkepeg."\" $isSel >".$item->jenkepeg."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list jenis kedudukan pegawai*/
function comboJenkedudupeg($id="idjenkedudupeg", $sel="", $required="", $where="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    if ($where != '') {
        $where = ' idjenkedudupeg in (1,21,99)';
        $rs = \DB::table('a_jenkedudupeg')->orderBy('idjenkedudupeg', 'asc')->whereRaw($where)->get();
    } else {
        $rs = \DB::table('a_jenkedudupeg')->orderBy('idjenkedudupeg', 'asc')->get();
    }

    foreach ($rs as $item) {
        $isSel = (($item->idjenkedudupeg==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idjenkedudupeg."\" $isSel >".$item->jenkedudupeg."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list jenis jabatan*/
function comboJenjab($id="idjenjab", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_jenjab')->orderBy('order', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idjenjab==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idjenjab."\" $isSel >".$item->jenjab."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list penetap sk*/
function comboPenetapsk($id="idpenetap", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_penetapsk')->orderBy('jabatan', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->id==$sel)?"selected":"");
        $ret.="<option value=\"".$item->id."\" $isSel >".$item->jabatan."</option>";
    }
    $ret.="</select>";
    return $ret;
}

/*cobo list golongan ruang*/
// tampilan 1 = golru saja, 2 = p3k saja, 3 = semua
function comboGolru($id="idgolru", $sel="", $required="", $tampilan = 1)
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control hitunggaji\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_golruang')->orderBy('idgolru', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idgolru==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idgolru."\" $isSel >".($tampilan== 1 || $tampilan == 3?$item->golru." - ":"").$item->pangkat.
            ($tampilan== 2 || $tampilan == 3?" | ".$item->golru_p3k:"")
        ."</option>";
    }
    $ret.="</select>";
    return $ret;
}

function comboKategori($id ='',$selected=""){
    $h = "<select id='$id' name='$id' class='form-control' style='width:100%'>";
    $h .= '<option value="">.: Pilihan :. </option>';
    $h .= '<option '.(($selected == '1')?'selected':'').' value="1">Pendidikan</option>';
    $h .= '<option '.(($selected == '2')?'selected':'').' value="2">Agama</option>';
    $h .= '<option '.(($selected == '3')?'selected':'').' value="3">Golongan</option>';
    $h .= '</select>';
    return $h;
}

/*cobo list skpd*/
function comboSkpd($id="idskpd", $sel="", $required="", $where="", $holder=".: Pilihan :.")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    if (session('role_id') < 4) {
        $ret.="<option value=\"\">".$holder."</option>";
    } else {
        $ret.="<option value=".session('idskpd').">".$holder."</option>";
    }

    if ($where != '') {
        $rs = \DB::table('a_skpd')->where('flag', 1)->where('idskpd', 'like', ''.$where. '%')->orderBy('idskpd', 'asc')->get();
    } else {
        $rs = \DB::table('a_skpd')->where('flag', 1)->orderBy('idskpd', 'asc')->get();
    }

    foreach ($rs as $item) {
        $nbsp = '';
        $char = strlen($item->idskpd);
        $index = substr($item->idskpd, 0, 2);
        for ($x=0; $x<=$char; $x++) {
            if ($char > 2) {
                $nbsp.='&nbsp;&nbsp;';
            }
        }

        $isSel = (($item->idskpd==$sel)?"selected":"");
        $ret.=($char==2)?"<optgroup label='".$item->skpd."'>":"";
        $ret.="<option value=\"".$item->idskpd."\" $isSel >".$nbsp."".$item->skpd."</option>";
        $ret.=($index != substr($item->idskpd, 0, 2))?"</optgroup>":"";
    }
    $ret.="</select>";
    return $ret;
}

/*combo list bulan*/
function comboBulan($id="bulan", $sel="", $required="", $holder=".: Pilihan :.")
{
    $month2[1] = "Januari";
    $month2[2] = "Februari";
    $month2[3] = "Maret";
    $month2[4] = "April";
    $month2[5] = "Mei";
    $month2[6] = "Juni";
    $month2[7] = "Juli";
    $month2[8] = "Agustus";
    $month2[9] = "September";
    $month2[10] = "Oktober";
    $month2[11] = "November";
    $month2[12] = "Desember";
    $html = "<select name=\"$id\" id=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $now = '';
    $html .= "<option value=''>".$holder."</option>";
    for ($i = 1; $i <= 12; $i++) {
        $bulan = $month2[$i];
        if (strlen($i) == 1) {
            $i = "0" . $i;
        }
        if ($i == $sel) {
            $html .= "<option value='$i' selected>$i | $bulan</option>";
        } else {
            $html .= "<option value='$i'>$i | $bulan</option>";
        }
        $now = 1;
        $now = $now + $i;
    }
    $html .= "</select>";
    return $html;
}

/*combo list tahun*/
function comboTahun($id="tahun", $sel="", $required="", $holder='.: Pilihan :.')
{
    $html="<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $html .= "<option value=''>".$holder."</option>";
    for ($i=date('Y')-5;$i<=date('Y')+30;$i++) {
        $html.="<option value='$i' ".(($i==$sel)?"selected":"").">$i</option>";
    }
    $html.="</select>";
    return $html;
}

/*function combo list status pns*/
function comboStspns($id="idstspeg", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" class=\"it\" $required style=\"width:100%\">";
    $ret.="<option value=\"\" ".(($sel=='')?'selected':'').">.: Pilihan :.</option>";
    $ret.="<option value=\"1\" ".(($sel=='1')?'selected':'').">CPNS</option>";
    $ret.="<option value=\"2\" ".(($sel=='2')?'selected':'').">PNS</option>";
    $ret.="<option value=\"3\" ".(($sel=='3')?'selected':'').">PPPK</option>";
    $ret.="</select>";
    return $ret;
}

/*function untuk mendapatkan nama bulan*/
function formatBulan($bln)
{
    $bln = (($bln >0) && ($bln < 10))? substr($bln, 1, 1): $bln ;
    $aBulan = array(1=> "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $date = $aBulan[$bln];
    return $date;
}

/*function untuk mendapatkan nama skpd*/
function getSkpd($idskpd)
{
    $rs = \DB::table('a_skpd')->where('idskpd', $idskpd)->first();
    if ($rs) {
        if (strlen($idskpd) == 2) {
            return $rs->skpd;
        } else {
            return $rs->path;
        }
    } else {
        return 'Semua Unit Kerja';
    }
}

/*helper sownload*/
function force_download($filename = '', $data = '')
{
    if ($filename == '' or $data == '') {
        return false;
    }

    // Try to determine if the filename includes a file extension.
    // We need it in order to set the MIME type
    if (false === strpos($filename, '.')) {
        return false;
    }

    // Grab the file extension
    $x = explode('.', $filename);
    $extension = end($x);

    // Load the mime types
    if (defined('ENVIRONMENT') and is_file('app/'.ENVIRONMENT.'/mimes.php')) {
        include('app/'.ENVIRONMENT.'/mimes.php');
    } elseif (is_file('app/mimes.php')) {
        include('app/mimes.php');
    }

    // Set a default mime if we can't find it
    if (! isset($mimes[$extension])) {
        $mime = 'application/octet-stream';
    } else {
        $mime = (is_array($mimes[$extension])) ? $mimes[$extension][0] : $mimes[$extension];
    }

    // Generate the server headers
    if (strpos($_SERVER['HTTP_USER_AGENT'], "MSIE") !== false) {
        header('Content-Type: "'.$mime.'"');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header("Content-Transfer-Encoding: binary");
        header('Pragma: public');
        header("Content-Length: ".strlen($data));
    } else {
        header('Content-Type: "'.$mime.'"');
        header('Content-Disposition: attachment; filename="'.$filename.'"');
        header("Content-Transfer-Encoding: binary");
        header('Expires: 0');
        header('Pragma: no-cache');
        header("Content-Length: ".strlen($data));
    }

    exit($data);
}

function comboStatussk($id="statussk",$sel="",$required="",$holder=".: Pilihan :."){
    $html ="<select name=\"$id\" id=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $html.="<option value=\"\">".$holder."</option>";
    $html.="<option value=\"0\" ".(($sel=='0')?"selected":"").">Belum Diproses</option>";
    $html.="<option value=\"2\" ".(($sel=='2')?"selected":"").">Dalam Proses</option>";
    $html.="<option value=\"1\" ".(($sel=='1')?"selected":"").">Proses Selesai</option>";
    $html.="</select>";
    return $html;
}

function tglina($date, $stat = '')
{
    if (($date!='0000-00-00') or ($date!='1970-01-01') or ($date!='')) {
        if($stat == 'en'){
            return date("Y-m-d", strtotime($date));
        }else{
            return date("d-m-Y", strtotime($date));
        }
    } else {
        return "-";
    }
}

function getPenetapsk($id="", $field="")
{
    $data = \DB::table('a_penetapsk')->select('a_penetapsk.*')->where('id', '=', $id)->first();

    if ($field != "") {
        $dt = $data->$field;
    } else {
        $dt = "";
    }

    return $dt;
}

/*get kepala skpd/ penandatangan sk kgb*/
function getKepskpd($idskpd='', $field='')
{
    $where = "a.idjenkedudupeg not in (99,21)";
    if ($idskpd!='') {
        if (strlen($idskpd) == "2") {
            $skpd = substr($idskpd, 0, 2);
            // $where .=" and a.idjenjab = 20 and a.idskpd = \"".$idskpd."\" ";
            $where .=" and a.idjabjbt = \"".$idskpd."\" ";
        } else {
            $skpd = substr($idskpd, 0, 2);
            $where .=" and a.idjabjbt = \"".$idskpd."\" ";
        }
    }

    $rs = \DB::table('tb_01 as a')
    ->select(
        'a.nip',
        \DB::raw("CONCAT(a.gdp,IF(LENGTH(a.gdp)>0,' ',''),a.nama,IF(LENGTH(a.gdb)>0,', ',''),a.gdb) AS nama"),
        'a.idskpd',
        'a.idjenjab',
        'a.idjabjbt',
        'b.skpd',
        'b.jab',
        'b.jab_utuh',
        'c.golru',
        'c.pangkat'
    )
    ->join('a_skpd as b', 'a.idjabjbt', '=', 'b.idskpd')
    ->leftJoin('a_golruang as c', 'a.idgolrupkt', '=', 'c.idgolru')
    ->whereRaw($where)
    ->first();

    if($rs){
        $rs = \DB::table('a_skpd as b')
            ->select(
            'a.nip', \DB::raw("CONCAT(a.gdp,IF(LENGTH(a.gdp)>0,' ',''),a.nama,IF(LENGTH(a.gdb)>0,', ',''),a.gdb) AS nama"),
            'a.idskpd', 'a.idjenjab', 'a.idjabjbt', 'b.skpd', 'c.golru', 'c.pangkat',
            \DB::raw('concat("Plt. ", b.jab) as jab'), \DB::raw('concat("Plt. ", b.jab_utuh) as jab_utuh'))
            ->join('tb_01 as a', 'b.plt_nip', '=', 'a.nip')
            ->leftJoin('a_golruang as c', 'a.idgolrupkt', '=', 'c.idgolru')
            ->whereRaw("b.idskpd = \"".$skpd."\"")
            ->first();
    }

    if ($rs) {
        if ($field!='') {
            return $rs->$field;
        } else {
            return '-';
        }
    } else {
        return '-';
    }
}


/*cobo list jenis pensiun*/
function comboJenpens($id="idjenpens", $sel="", $required="")
{
    $ret = "<select id=\"$id\" name=\"$id\" $required style='width: 100%;' class=\"form-control\">";
    $ret.="<option value=\"\">.: Pilihan :.</option>";

    $rs = \DB::table('a_jenpens')->orderBy('jenpens', 'asc')->get();
    foreach ($rs as $item) {
        $isSel = (($item->idjenpens==$sel)?"selected":"");
        $ret.="<option value=\"".$item->idjenpens."\" $isSel >".$item->jenpens."</option>";
    }
    $ret.="</select>";
    return $ret;
}
