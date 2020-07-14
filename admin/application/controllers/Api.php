<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Api extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->sessionMember = $this->session->sessionMember;
	}

	function index(){
		// Get user yang ada jadwal berobat per hari ini
		$getUserRequeue 	= $this->global->getUserRequeue();
		debugCode($getUserRequeue);
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