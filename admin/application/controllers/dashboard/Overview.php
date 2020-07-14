<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Overview extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_program");
		$this->load->model("M_transaksi");
		$this->sessionNadzir = $this->session->sessionNadzir;
		if (empty($this->sessionNadzir)) {
			redirect();
		}
	}

	function index(){
		$dataNadzir 		= $this->sessionNadzir;
		// Get Campaign
		$campaign 			= $this->M_program->getDataById("id_nadzir", $dataNadzir['nadzir_id']);
		// Total Dana terkumpul (Seluruh Program)
		$getTotalDana 		= $this->M_program->getDataById("id_nadzir", $this->sessionNadzir['nadzir_id']);
		$total 	= 0;
		foreach ($getTotalDana as $value) {
			$total += $value->fund_collected;
		}

		$dataDash	= [
						"campaign"		=> count($campaign),
						"total_dana"	=> $total
					];

		$data['overview']	= $dataDash;
		$data['detailData']	= $dataNadzir;
		$data['title']		= "Kita Wakaf - Personal Information";
		$data['title_head']	= "Overview";
		$data['content']	= "front/front_page/dashboard/overview/index";
		$this->load->view('front/layout', $data);
	}
}