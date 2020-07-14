<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Mobileuser extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model("M_mobileuser");

		$this->sessionData = $this->session->sessionData;

		$sessionData = $this->sessionData;

		if (empty($sessionData)) {

			redirect('cms/signin');

		}

	}



	function index(){

		$data['web_title'] = "Mobile User";

		$data['content']   = "admin/mobileuser/index";

		$this->load->view('admin/layout',$data);

	}


    function edit($param){
		$user_id = encrypt_decrypt("decrypt",$param);
		$detailUser = $this->M_mobileuser->getDetailUser($user_id);

		$data['id']	= "";
		if (!empty($detailUser)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['detailUser'] 	= $detailUser;
		$data['web_title']  	= "Edit User";
		$data['content']    	= "admin/mobileuser/edit";
		$this->load->view('admin/layout',$data);
	}
	

	/*==================================================== DATA FOR DATATABLE ====================================================*/

	public function get_list_mobileuser(){

		$requestParam 			= $_REQUEST;
		$getData 				= $this->M_mobileuser->get_list_user ( $requestParam, 'nofilter' );

		$totalAllData 			= $this->M_mobileuser->get_list_user ( $requestParam, 'nofilter', 'all' )->num_rows ();

		$totalDataFiltered 		= $this->M_mobileuser->get_list_user ( $requestParam, 'nofilter', 'all' )->num_rows ();

		

		if (empty ( $requestParam ['search'] ['value'] ) > 1) {

			$getData 			= $this->M_mobileuser->get_list_user ( $requestParam );

			$totalDataFiltered 	= $getData->num_rows ();

		}

		

		$listData = array ();

		$no = ($requestParam['start']+1);

		

		foreach( $getData->result () AS $value){

			$rowData = array();



			/*========================================= BEGIN BUTTON STUFF =========================================*/

            $button = "";
            
            $button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/mobileuser/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/mobileuser/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';
			

			// $button .= 	'

			// 				<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/dokter/doDelete/'.$value->id).'\')" title="Delete"><i class="fa fa-trash"></i></button>

			// 				<a href="'.base_url('cms/dokter/edit/'.$value->id).'" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>

			// 			';			



			// Metode Pembayaran

			// $getPembayaran	= json_decode($value->id_payment);

			// $listPembayaran = [];

			// for ($i=0; $i < count($getPembayaran) ; $i++) { 

			// 	$getDataPeyment		= $this->M_pembayaran->getOneData("id", $getPembayaran[$i]);

			// 	$listPembayaran[]	= "*) ".$getDataPeyment->name."<br/>";

			// }

			/*========================================= END BUTTON STUFF =========================================*/



			$rowData[] = $no++;
			$rowData[] = $value->id;
			$rowData[] = $value->name;
            $rowData[] = $value->email;        
            $rowData[] = $this->M_mobileuser->get_total_patient ( $value->id );
            $rowData[] = $button;		        
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