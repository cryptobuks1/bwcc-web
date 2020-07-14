<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Wakaf extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_transaksi");
		$this->sessionNadzir = $this->session->sessionNadzir;
		if (empty($this->sessionNadzir)) {
			redirect();
		}
	}

	function index(){
		$dataNadzir 		= $this->sessionNadzir;
		
		$data['detailData']	= $dataNadzir;
		$data['title']		= "Kita Wakaf - Wakaf Saya";
		$data['title_head']	= "Wakaf Saya";
		$data['content']	= "front/front_page/dashboard/wakaf/index";
		$this->load->view('front/layout', $data);
	}

	/*==================================================== DATA FOR DATATABLE ====================================================*/
	public function get_list_wakaf(){
		$requestParam 			= $_REQUEST;
		
		$getData 				= $this->M_transaksi->get_list_wakaf ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_transaksi->get_list_wakaf ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_transaksi->get_list_wakaf ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_transaksi->get_list_wakaf ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();

			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$status = "";
			if ($value->status == 0) {
				$status .= '<span class="badge badge-pill badge-info">Menunggu Pembayaran</span>';
			}elseif ($value->status == 1) {
				$status .= '<span class="badge badge-pill badge-success">Paid</span>';
			}else{
				$status .= '<span class="badge badge-pill badge-danger">Cancelled</span>';
			}
			/*========================================= END BUTTON STUFF =========================================*/

			$rowData[] = $no++.".";
			$rowData[] = $value->name;
			$rowData[] = "Rp ".number_format($value->total, 0, ",", ".");
			$rowData[] = date('d M Y H:i',strtotime($value->created_date));
			$rowData[] = $status;
			
			$listData[] = $rowData;
			
			$json_data = array (
				"draw"            => intval ( $requestParam ['draw'] ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
				"recordsTotal"    => intval ( $totalAllData ), // total number of records
				"recordsFiltered" => intval ( $totalDataFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $listData 
			); // total data array
		}
		if(empty($json_data)){
			$json_data = array (
				"draw"            => 0, // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
				"recordsTotal"    => 0, // total number of records
				"recordsFiltered" => 0, // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => ""
			); // total data array
		}
		header ( 'Content-Type: application/json;charset=utf-8' );
		echo json_encode ($json_data);
		
		die();
	}
	/*==================================================== END DATA FOR DATATABLE ====================================================*/
}