<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_dashboard");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		if ($this->sessionData['access_group_id'] == 3) {
			redirect('cms/antrian');
		}

		$data['web_title']     		= "Dashboard";
		$data['content']       		= "admin/dashboard/dashboard";
		$data['info_card'] 	  	 	= $this->M_dashboard->getCardInfo();
		$data['list_last_activity'] = $this->M_dashboard->getLastActivity();
		$data['list_last_booked'] = $this->M_dashboard->getLastBooked();

		$data['get_pending_book_class'] = $this->M_dashboard->get_pending_book_class();

		$data['get_success_book_class'] = $this->M_dashboard->get_success_book_class();
		$data['get_cancel_payment_book_class'] = $this->M_dashboard->get_cancel_payment_book_class();
		$data['get_cancel_book_class'] = $this->M_dashboard->get_cancel_book_class();

		$this->load->view('admin/layout',$data);
	}

	function getDataTotal(){
		$get = $this->input->get();
		$explodeDate = explode(" - ", $get['daterange']);
		$dataDate['dateStart'] = date("Y-m-d",strtotime($explodeDate[0]));
		$dataDate['dateEnd']   = date("Y-m-d",strtotime($explodeDate[1]));

		$searchProcess = $this->M_dashboard->getTotalData($dataDate);
		echo json_encode($searchProcess);
	}
}