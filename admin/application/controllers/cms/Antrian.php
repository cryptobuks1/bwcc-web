<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Antrian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_user");
		$this->load->model("M_antrian");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$detail_user 			= $this->M_user->getDetailUser($this->sessionData['user_id']);

		$data['detail_user']	= $detail_user;
		$data['web_title'] 		= "Antrian";
		$data['content']   		= "admin/antrian/list_antrian";
		$this->load->view('admin/layout',$data);
	}

	function statusLoket($id_user){
		$detail_user 			= $this->M_user->getDetailUser($this->sessionData['user_id']);

		if ($detail_user->status == 0) {
			$status = 1;
		}else{
			$status = 0;
		}

		// Update Status Loket
		$updateArray = array(
			"status"   		=> $status,
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("admin", $updateArray, array("id" => $detail_user->id));
		echo $update;
		// End
	}

	function hadir($id){
		// Update to table antrian
		$updateArray = array(
			"status"   		=> "2",
		);

		$this->db->update("antrian", $updateArray, array("req_queue_id" => $id));
		// End

		// Update to table master_req_antrian
		$updateArray = array(
			"status"   		=> "7",
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_req_queue", $updateArray, array("id" => $id));
		echo $update;
		// End
	}

	function lewati($id){
		// Update to table antrian
		$updateArray = array(
			"status"   		=> "4",
		);

		$this->db->update("antrian", $updateArray, array("req_queue_id" => $id));
		// End

		// Update to table master_req_antrian
		$updateArray = array(
			"status"   		=> "8",
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_req_queue", $updateArray, array("id" => $id));
		echo $update;
		// End
	}

	/*==================================================== DATA FOR DATATABLE ====================================================*/
	public function get_list_antrian(){
		$requestParam 			= $_REQUEST;
		// debugCode($requestParam);

		$getData 				= $this->M_antrian->get_list_antrian ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_antrian->get_list_antrian ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_antrian->get_list_antrian ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_antrian->get_list_antrian ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			// Get Data from table Antrian 
			// $get_antrian 	= $this->M_antrian->getOneDataAntrian("req_queue_id", $value->id);
			$get_antrian 	= $value->status;
			// debugCode($get_antrian);
			// End

			$rowData = array();

			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$button = "";

			// if ($get_antrian->status == 0) {
			// 	// $button .= 	'	
			// 	// 			<button class="btn btn-info btn-sm" title="Panggil"><i class="fas fa-volume-up"></i></button>
			// 	// 		';
			// 	$button .= 	'	
			// 				<a href="#" class="btn btn-info btn-sm" title="Panggil" onClick="panggil_antrian(\''.$value->id.'\')"><i class="fas fa-volume-up"></i></a>
			// 			';
			// }else{
			// 	$button .= 	'	
			// 				<button class="btn btn-success btn-sm" onClick="hadir(\''.$value->id.'\')" title="Hadir"><i class="fa fa-check-circle"></i></button>
			// 				<button class="btn btn-danger btn-sm" onClick="lewati(\''.$value->id.'\')" title="Lewati"><i class="far fa-times-circle"></i></button>
			// 			';
			// }

			if ($get_antrian == 0) {

				// $button .= 	'	

				// 			<button class="btn btn-info btn-sm" title="Panggil"><i class="fas fa-volume-up"></i></button>

				// 		';

				$get_status_terpanggil = $this->M_antrian->getOneDataAntrian("status", 3);
				if ($get_status_terpanggil) { //Kondisi jika masih ada nomor antrian yang masih dalam masa pemanggilan
					$button .= 	'
									<a href="#" class="btn btn-info btn-sm" title="Panggil"><i class="fas fa-volume-up"></i></a>
								';
				}else{
					$button .= 	'
									<a href="#" class="btn btn-info btn-sm" title="Panggil" onClick="panggil_antrian(\''.$value->id.'\')"><i class="fas fa-volume-up"></i></a>
								';
				}

			}else if($get_antrian == 2){

				// $button .= '<span class="badge badge-pill badge-primary">Selesai</span>';

			}else if($get_antrian == 4 ){

				$button .= 	'	

							<button class="btn btn-success btn-sm" onClick="hadir(\''.$value->req_queue_id.'\')" title="Hadir"><i class="fa fa-check-circle"></i></button>

						';

			}else if($get_antrian == 3){

				$button .= 	'	

							<button class="btn btn-success btn-sm" onClick="hadir(\''.$value->req_queue_id.'\')" title="Hadir"><i class="fa fa-check-circle"></i></button>

							<button class="btn btn-danger btn-sm" onClick="lewati(\''.$value->req_queue_id.'\')" title="Lewati"><i class="far fa-times-circle"></i></button>

						';

			}

			$status = "";

			switch ($get_antrian) {
			    case 0:
			        $status .= '<span class="badge badge-pill badge-warning">Menunggu Panggilan</span>';
			        break;
			    case 2:
			        $status .= '<span class="badge badge-pill badge-success">Terlayani</span>';
			        break;
			    case 4:
			        $status .= '<span class="badge badge-pill badge-danger">Terlewati</span>';
			        break;
			    default:
			        $status .= '<span class="badge badge-pill badge-info">Telah dipanggil</span>';
			}
			/*========================================= END BUTTON STUFF =========================================*/

			$rowData[] = $no++;
			$rowData[] = $value->kode_antrian;
			$rowData[] = $value->name_pasien;
			$rowData[] = $value->bpjs_id;
			$rowData[] = $value->doctor_name;
			$rowData[] = $value->tanggal;
			$rowData[] = ($value->loket) ? $value->loket : "-";
			$rowData[] = $status;
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