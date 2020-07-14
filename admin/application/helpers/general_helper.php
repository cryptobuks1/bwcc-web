<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if ( ! function_exists('debugCode')){
	function debugCode($r=array(),$f=TRUE){
	  echo "<pre>";
	  print_r($r);
	  echo "</pre>";

	  if($f==TRUE) 
	     die;
	}
}

if( ! function_exists('getRandomWord')){
	function getRandomWord($len = 10) {
	    $word = array_merge(range('a', 'z'), range('A', 'Z'));
	    shuffle($word);
	    return substr(implode($word), 0, $len);
	}
}
if( ! function_exists('getRandomWord2')){
	function getRandomWord2($len = 6) {
	    $word = array_merge(range('A', 'Z'), range(10, 99));
	    shuffle($word);
	    return substr(implode($word), 0, $len);
	}
}

if( ! function_exists('ai_url')){
	function ai_url($len = 10) {
	    // $url = "http://103.101.224.73:1000";
		$url = "http://api-dev.aipos.co.id";
	    return $url;
	}
}

if( ! function_exists('sKey')){
	function sKey($par = "") {
		if ($par <> "") {
			$keyword = str_replace(" ", "%20", $par);
		}else{
			$keyword = "";
		}
		return $keyword;
	}
}

if ( ! function_exists('okHeader')) {
	function okHeader($dataArray){
		foreach ($dataArray as $key => $value) {
			$hresponse[$key] = $value;
		}
		return $hresponse;
	}
}

if ( ! function_exists('okHeader')) {
	function decodeData($paging){
		$result = json_decode($paging);
		return $result;
	}

}

if ( ! function_exists('status_return')) {
	function status_return($status,$msg){
		return json_encode(array("status" => $status , "msg" => $msg));		
	}
}


if ( ! function_exists('checkSideBar')) {
	function checkSideBar($session,$name = "",$second = ""){
		$side = "";
        $CI =& get_instance();    
		$side = $CI->session->$session;
		
		if (empty($second)) {
			return $side[$name];
		}else{
			return $side[$name][$second];
		}
	}
}

if(!function_exists('add_date')) {
   function add_date($date) {
		$date = date_create($date);
		$date = date_format($date,"Y-m-d");
		return $date;
   }
}

if(!function_exists('dateFormat')) {
   function dateFormat($date) {
		$date = date_create($date);
		$date = date_format($date,"Y/m/d");
		return $date;
   }
}

if(!function_exists('status')) {
   function status($data) {
		if($data == '1'){
			$status = '<label style="color:red;">Inactive</label>';
		}else{
			$status = '<label style="color:green;">Active</label>';
		}
		return $status;
   }
}

if(!function_exists('status_word')) {
   function status_word($data) {
		if($data == 'Active'){
			$status = '<label style="color:green;">Active</label>';
		}else{
			$status = '<label style="color:red;">Inactive</label>';
		}
		return $status;
   }
}

if( ! function_exists('sNominal')){
	function sNominal($par = "") {
		if ($par <> "") {
			$keyword = str_replace(",", "", $par);
		}else{
			$keyword = "";
		}
		return $keyword;
	}
}


if( ! function_exists('chCheck')){
	function chCheck($par1, $par2, $par3, $par4 = "") {
		if ($par1 == $par2) {
			$return = $par3;
		}else{
			if ($par4 <> "") {
				$return = $par4;
			}else{
				$return = "";
			}
		}
		return $return;
	}
}

if( ! function_exists('sNilai')){
	function sNilai($par = "") {
		if ($par <> "") {
			$keyword = str_replace(".", "", $par);
		}else{
			$keyword = "";
		}
		return $keyword;
	}
}

if ( ! function_exists('getLoginData')) {
	function getLoginData($param=null){
		$side = "";
        $CI =& get_instance();    
		$side = $CI->session->sessionData;
		// var_dump($side);
		if($side){
			//debugCode($side);
		if($param==null){
			return $side;
		}else{
			return $side[$param];
		}
		}else{

		return false;
		}
	}
}

if ( ! function_exists('flashdata_check')) {
	function flashdata_check($param=""){
		$side = "";
        $CI =& get_instance();
        $result = $CI->session->flashdata($param);
        return $result;
	}
}

if ( ! function_exists('flashdata_notif')) {
	function flashdata_notif($param = "", $trueparam = "", $costum_message = ""){
		$side = "";
        $CI =& get_instance();
        $result = $CI->session->flashdata($param);
        $html = "";
        if ($result == $trueparam) {
        	if ($costum_message) { // Costum Message
        		$html = '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<i class="icon-tick"></i><strong>Congratulations!</strong> '.$costum_message.'
					</div>';
        	}else{
        		$html = '<div class="alert alert-success">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<i class="icon-tick"></i><strong>Congratulations!</strong> Action Success.
					</div>';
        	}
        	$CI->session->flashdata($param);
        }elseif($result == "No" AND $result <> ""){
			$html = '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<i class="icon-warning2"></i><strong>Oh snap!</strong> Action Failed.
					</div>';
        }elseif($result <> "No" AND $result <> ""){
        	$html = '<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
						<i class="icon-warning2"></i><strong>Oh snap!</strong> '.$result.'
					</div>';
        }

        return $html;
	}
}

function custom_notif($type = "success",$name="", $message = ""){
	//HOW TO USE BELOW
	//custom_notif("success","Nave of Session Success","Hello");
	//custom_notif("failed","Nave of Session Failed","Hello");

	$CI =& get_instance();
	$html = "";
	if ($type == "success") {
		if ($message <> "") {
			$html = array(
				"type"	=> "Notif",
				"html"	=> '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<i class="icon-tick"></i><strong>Sukses!</strong> '.$message.'
				</div>'
			);
		}else{
			$html = array(
				"type"	=> "Notif",
				"html"	=> '<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<i class="icon-tick"></i><strong>Sukses!</strong> Action Success.
				</div>'
			);
		}
		$CI->session->set_flashdata($name, $html);
	}elseif($type == "failed"){
		if ($message <> "") {
			$html = array(
				"type" => "Notif",
				"html" => '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<i class="icon-warning2"></i><strong>Oh snap!</strong> '.$message.'
				</div>'
			);
		}else{
			$html = array(
				"type" => "Notif",
				"html"	=> '<div class="alert alert-danger">
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
				<span aria-hidden="true">&times;</span>
				</button>
				<i class="icon-warning2"></i><strong>Oh snap!</strong> Action Failed.
				</div>'
			);
		}
		$CI->session->set_flashdata($name, $html);
	}
}

function return_custom_notif(){
	$CI =& get_instance();
	$flashData = $CI->session->flashdata();
	$html = "";
	foreach ($flashData as $key => $value) {
		if ($value['type'] == "Notif") {
			$html.=$value['html'];
		}
	}
	return $html;
}

if(!function_exists('encrypt_decrypt')){
	function encrypt_decrypt($action, $string) {
		$output = false;
		$encrypt_method = "AES-256-CBC";
		$secret_key = 'd9b9f2e4a4abdbeb5987f697c15f9671';
		$secret_iv = 'ae2f0e96fd0f6cb1bda97bb00316b3b0';
		// hash
		$key = hash('sha256', $secret_key);
		
		// iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
		$iv = substr(hash('sha256', $secret_iv), 0, 16);
		if ( $action == 'encrypt' ) {
			$output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
			$output = base64_encode($output);
		} else if( $action == 'decrypt' ) {
			$output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
		}
		return $output;
	}
}

function check_selected($par1, $par2){
	if ($par1 == $par2) {
		$return = "selected";
	}else{
		$return = "";
	}
	return $return;
}

function is_checked($par1, $par2){
	if ($par1 == $par2) {
		$return = "checked";
	}else{
		$return = "";
	}
	return $return;	
}

function defaultFormEmail(){
	$email = "event@ticketing.com";
	return $email;
}

function defaultFormName(){
	$email = "Ticketing";
	return $email;
}

function checkMemberLogin(){
	$CI =& get_instance();
	
	if (empty($CI->session->userdata['sessionMember'])) {
		redirect();
	}
}

function orderNumberFormat($date, $idOrder){
	$order = "OD-".date("Ymd",strtotime($date))."-".$idOrder;
	return $order;
}

function stats_order_html($payment_status){
	$status_payment = "";
	if ($payment_status == 0) {
		$status_payment = '<span class="badge badge-bdr badge-warning">Waiting for Payment</span>';
	}elseif($payment_status == 1){
		$status_payment = '<span class="badge badge-bdr badge-info">Waiting Admin to Approve</span>';
	}elseif($payment_status == 2){
		$status_payment = '<span class="badge badge-bdr badge-success">Accepted</span>';
	}else{
		$status_payment = '<span class="badge badge-bdr badge-danger">Rejected</span>';
	}
	return $status_payment;
}

function type_inout_html($type){
	if ($type == 1) {
		$html = '<span class="badge badge-bdr badge-success">IN</span>';
	}else{
		$html = '<span class="badge badge-bdr badge-danger">Out</span>';
	}
	return $html;
}

function generateEticketNumber(){	 
	$rand = getRandomWord2();
	$enum = "E-".rand(100,999).$rand;
	return $enum;

}

function daysByNumber($number){
	if ($number == 1) {
		$days = "Monday";
	}

	if ($number == 2) {
		$days = "Tuesday";
	}

	if ($number == 3) {
		$days = "Wednesday";
	}

	if ($number == 4) {
		$days = "Thursday";
	}

	if ($number == 5) {
		$days = "Friday";
	}

	if ($number == 6) {
		$days = "Saturday";
	}

	if ($number == 7) {
		$days = "Sunday";
	}

	return $days;
}


if (!function_exists('bulan')) {
    function bulan(){
        $bulan = Date('m');
        switch ($bulan) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
            default:
                $bulan = Date('F');
                break;
        }
        return $bulan;
    }
}




function guid($include_braces = false) {
    if (function_exists('com_create_guid')) {
        if ($include_braces === true) {
            return com_create_guid();
        } else {
            return substr(com_create_guid(), 1, 36);
        }
    } else {
        mt_srand((double) microtime() * 10000);
        $charid = strtoupper(md5(uniqid(rand(), true)));
       
        $guid = substr($charid,  0, 8) . '-' .
                substr($charid,  8, 4) . '-' .
                substr($charid, 12, 4) . '-' .
                substr($charid, 16, 4) . '-' .
                substr($charid, 20, 12);
 
        if ($include_braces) {
            $guid = '{' . $guid . '}';
        }
   
        return $guid;
    }
}

function random($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}