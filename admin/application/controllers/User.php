<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_loket");
		$this->load->model("M_poli");
		$this->load->model("M_pembayaran");
	}

	function makePassword(){
		$data['title']		= "Change Password";
		$data['content']	= "front/front_page/change_password/buat_password";
		$this->load->view('front/layout_display', $data);
	}

	function changeSuccess(){
		$data['title']		= "Change Password Success";
		$data['content']	= "front/front_page/change_password/notif_success";
		$this->load->view('front/layout_display', $data);	
	}

	function infoJadwalPasien(){
		// Get user yang ada jadwal berobat per hari ini
		$getUserRequeue 	= $this->global->getUserRequeue();
		foreach ($getUserRequeue as $key => $value) {
			// Get token fcm user for send notif
			$getTokenUser	= $this->global->getUserApi($value->created_by);

			if ($getTokenUser) {
				// Send notif
				$this->load->library("fcm");
			    $server_key = 'AIzaSyCRkSGmi0cvBEJSt6Ha2fny-R9SQjDzako';
			    $target = array($getTokenUser->token_notification);
			    $pesan  = array('title'     	=> 'Informasi Pasien',
					            'body'      	=> "Hai! hari ini kamu ada jadwal praktik dengan dokter ".$value->dokter_name." loh, jangan lupa datang ya, Terima Kasih :)",
					            'icon'     		=> '',
					            'sound'      	=> '',
					            'click_action'  => ''  
			            	);

			    $send = $this->fcm->sendMessage($pesan, $target, $server_key);
			    // End
			}
		}
	}



}