<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Poli extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_poli");
		$this->load->model("M_spesialis");
		$this->load->model("M_pembayaran");
		$this->load->model("M_dokter");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Poli";
		$data['content']   = "admin/master/poli/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getSpesialis	= $this->M_spesialis->getData();
		$getPembayaran	= $this->M_pembayaran->getData();

		$data['pembayaran']	= $getPembayaran;
		$data['spesialis'] 	= $getSpesialis;
		$data['back_link'] 	= base_url('cms/poli');
		$data['web_title'] 	= "Add Poli";
		$data['content']   	= "admin/master/poli/add";
		$this->load->view('admin/layout', $data);
	}

	function doAdd(){
		$post = $this->input->post();

		$metode_pembayaran = json_encode($post['spesialis_pembayaran']);
		
		$insertArray = array(
			"id"			=> guid(),
			"poly_code"		=> $post['poli_kode'],
			"name" 			=> $post['poli_nama'],
			"id_specialist" => $post['spesialis_id'],
			"id_payment"	=> $metode_pembayaran,
			"is_deleted"	=> "0",
			"created_date"  => date('Y-m-d H:i:s'),
			"created_by"    => $this->sessionData['user_id']
		);

		$insert	= $this->db->insert("master_poly", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/poli/");
		}else{
			custom_notif("success", "failed", "");
			redirect("cms/poli/add/");
		}
	}

	function edit($id){
		$getPoli 		= $this->M_poli->getOneData("id", $id);

		if (!$getPoli) {
			custom_notif("failed", "Notif", "Data tidak ada");
			redirect("cms/poli");
		}

		$getSpesialis	= $this->M_spesialis->getData();
		$getPembayaran	= $this->M_pembayaran->getData();

		$data['pembayaran']		= $getPembayaran;
		$data['spesialis'] 		= $getSpesialis;
		$data['detailData']		= $getPoli;
		$data['back_link']    	= base_url('cms/poli');
		$data['web_title']    	= "Edit Poli";
		$data['content']      	= "admin/master/poli/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     	= $this->input->post();

		$metode_pembayaran = json_encode($post['spesialis_pembayaran']);
		
		$updateArray = array(
			"poly_code"		=> $post['poli_kode'],
			"name" 			=> $post['poli_nama'],
			"id_specialist" => $post['spesialis_id'],
			"id_payment"	=> $metode_pembayaran,
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_poly", $updateArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/poli");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/poli/edit/".$id);
		}
	}

	function doDelete($id){
		
		$updateArray = array(
			"is_deleted"   	=> "1",
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$delete = $this->db->update("master_poly", $updateArray, array("id" => $id));
		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/poli");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/poli");
		}
	}

	function jadwalpoli($id){
		$data['id_poly']	= $id;
		$data['back_link'] 	= base_url('cms/poli');
		$data['web_title'] 	= "Add Jadwal Poli";
		$data['content']   	= "admin/master/poli/jadwal_poli";
		$this->load->view('admin/layout', $data);
	}

	function addSchedule(){
		$post = $this->input->post();
		$delete_by_poli 	= $this->db->delete("master_practice_schedule", ["id_poly" => $post['poli_kode']]);

		if (!$delete_by_poli) {
			custom_notif("failed", "Notif", "");
			redirect("cms/poli/jadwalpoli/".$post['poli_kode']);
		}

		if ($post['jadwal_tipe'] == 1) {
			
			for ($i=0; $i < count($post['start_poli_nama']); $i++) { 
				$insertArray = array(
					"id"					=> guid(),
					"id_poly"				=> $post['poli_kode'],
					"start_time_service"	=> $post['start_poli_nama'][$i],
					"finish_time_service" 	=> $post['end_pelayanan'][$i],
					"quota"					=> $post['kuota'][$i],
					"start_onsite"			=> $post['jam_onsite'][$i],
					"end_onsite"			=> $post['akhir_onsite'][$i],
					"quota_online"			=> $post['kuota_online'][$i],
					"days"					=> $i+1,
					"weeks"					=> "",
					"type"					=> $post['jadwal_tipe'],
					"created_date"  		=> date('Y-m-d H:i:s'),
					"created_by"    		=> $this->sessionData['user_id']
				);

				$insert	= $this->db->insert("master_practice_schedule", $insertArray);
			}
		}elseif ($post['jadwal_tipe'] == 2) {
			# code...
		}else{
			custom_notif("failed", "Notif", "Tipe tidak ada");
			redirect("cms/poli/");
		}

		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/poli/");
		}else{
			custom_notif("success", "failed", "");
			redirect("cms/poli/add/");
		}
	}

	function getMingguan(){
		$view = '<div class="form-group row gutters">
					<div class="col-sm-2">&nbsp;</div>
					<div class="col-sm-1 text-center">Senin</div>
					<div class="col-sm-1 text-center">Selasa</div>
					<div class="col-sm-1 text-center">Rabu</div>
					<div class="col-sm-1 text-center">Kamis</div>
					<div class="col-sm-1 text-center">Jumat</div>
					<div class="col-sm-1 text-center">Sabtu</div>
					<div class="col-sm-1 text-center">Minggu</div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Jam Pelayanan</label>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
				</div>
				<div class="form-group row gutters">
					<label class="col-md-2 col-form-label">Akhir Pelayanan</label>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
				</div>
				<div class="form-group row gutters">
					<label class="col-md-2 col-form-label">Kuota</label>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
				</div>
				<div class="form-group row gutters">
					<label class="col-sm-2 col-form-label">Jam Onsite</label>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
					<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
				</div>
				<div class="form-group row gutters">
					<label class="col-md-2 col-form-label">Akhir Onsite</label>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
				</div>
				<div class="form-group row gutters">
					<label class="col-md-2 col-form-label">Online</label>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
					<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
				</div>';

		echo $view;
	}

	/*==================================================== Dokter ====================================================*/
	function dokterpoli($id){
		$getPoli 	= $this->M_poli->getOneData("id", $id);

		if (!$getPoli) {
			custom_notif("failed", "Notif", "Data tidak ada");
			redirect("cms/poli");
		}

		// == Get Poli Dokter == //
		$getPoliDokter 	= $this->global->getPoliDokter("id_poly", $getPoli->id);
		// == End == //

		$data['getPoliDokter']	= $getPoliDokter;
		$data['getPoli']		= $getPoli;
		$data['back_link'] 		= base_url('cms/poli');
		$data['web_title'] 		= "List Dokter Poli";
		$data['content']   		= "admin/master/poli/dokter_poli/list_dokter_poli";
		$this->load->view('admin/layout', $data);
	}

	function addpolidokter($id){
		$getPoli 	= $this->M_poli->getOneData("id", $id);

		if (!$getPoli) {
			custom_notif("failed", "Notif", "Data tidak ada");
			redirect("cms/poli");
		}

		//== Dokter ==//
		$getDokter 	= $this->M_dokter->getData();
		//== End ==//

		$data['listDokter']	= $getDokter;
		$data['getPoli']	= $getPoli;
		$data['back_link'] 	= base_url('cms/poli/dokterpoli/'.$getPoli->id);
		$data['web_title'] 	= "Add Dokter Poli";
		$data['content']   	= "admin/master/poli/dokter_poli/add_dokter_poli";
		$this->load->view('admin/layout', $data);
	}

	function doAddDokterPoli(){
		$post = $this->input->post();

		// debugCode($post);

		if (!$this->M_poli->getOneData("id", $post['poli_kode'])) {
			custom_notif("failed", "Notif", "Kode Poli tidak terdaftar");
			redirect("cms/poli");
		}

		for ($i=0; $i < count($post['list_dokter']) ; $i++) { 

				$update_poly_to_schedule = array(
					"id_poly"			=> $post['poli_kode'],
					"created_date"  	=> date('Y-m-d H:i:s'),
					"created_by"    	=> $this->sessionData['user_id']
				);

				$update = $this->db->update("master_practice_schedule", $update_poly_to_schedule, array("id_doctor" => $post['list_dokter'][$i]));
		}

		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/poli/dokterpoli/".$post['poli_kode']);
		}else{
			custom_notif("success", "failed", "");
			redirect("cms/poli/addpolidokter/".$post['poli_kode']);
		}
	}

	function deleteDokterPoli($id){
		$get_doctor_schedule = $this->global->getOnePoliDokter("id_doctor", $id);

		$del_poly = array(
			"id_poly"			=> "",
			"created_date"  	=> date('Y-m-d H:i:s'),
			"created_by"    	=> $this->sessionData['user_id']
		);

		$delete = $this->db->update("master_practice_schedule", $del_poly, array("id_doctor" => $id));

		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/poli/dokterpoli/".$get_doctor_schedule->id_poly);
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/poli");
		}
	}

	function jadwaldokter(){
		$row_code 	= guid();
		$getDokter 	= $this->M_dokter->getData();

		// $list_dokter = [];
		foreach ($getDokter as $value) {
			$list_dokter[] = '<option value="'.$value->id.'">'.$value->name .' (No.STR : '.$value->no_str.')'.'</option>';
		}

		$view = '<div class="form-group row gutters" id="'.$row_code.'">
					<label class="col-md-2 col-form-label"></label>
					<div class="col-md-8">
						<select class="form-control selectpicker" name="list_dokter[]" data-live-search="true" required="">
							<option value="">- Pilih Dokter -</option>
							'.implode(" ", $list_dokter).'
						</select>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-danger" title="delete" onClick="deldiv(\''.$row_code.'\')"><i class="fa fa-trash-alt"></i> Hapus</button>
					</div>
				</div>';
		echo($view);
	}
	/*==================================================== End ====================================================*/

	/*==================================================== DATA FOR DATATABLE ====================================================*/
	public function get_list_poli(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_poli->get_list_poli ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_poli->get_list_poli ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_poli->get_list_poli ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_poli->get_list_poli ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = 1;
		
		foreach( $getData->result () AS $value){
			$rowData = array();

			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$button = "";
			// $button .= 	'
			// 				<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/dokter/doDelete/'.$value->id).'\')" title="Delete"><i class="fa fa-trash"></i></button>
			// 				<a href="'.base_url('cms/dokter/edit/'.$value->id).'" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>
			// 			';

			$button .= '
						<div class="btn-group">
						  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
						    Action
						  </button>
						  <div class="dropdown-menu">
						    <a class="dropdown-item" href="'.base_url('cms/poli/edit/'.$value->id).'"><i class="fa fa-edit"></i> Edit</a>
						    <a class="dropdown-item" onClick="is_delete(\''.base_url('cms/poli/doDelete/'.$value->id).'\')"><i class="fa fa-trash"></i> Hapus</a>
						    <div class="dropdown-divider"></div>
						    <a class="dropdown-item" href="'.base_url('cms/poli/dokterpoli/'.$value->id).'"><i class="fas fa-notes-medical"></i> List Dokter</a>
						  </div>
						</div>
					
					';


			// Metode Pembayaran
			// $getPembayaran	= json_decode($value->id_payment);
			// $listPembayaran = [];
			// for ($i=0; $i < count($getPembayaran) ; $i++) { 
			// 	$getDataPeyment		= $this->M_pembayaran->getOneData("id", $getPembayaran[$i]);
			// 	$listPembayaran[]	= "*) ".$getDataPeyment->nama_poli."<br/>";
			// }
			/*========================================= END BUTTON STUFF =========================================*/

			$rowData[] = $no++;
			$rowData[] = $value->kode_poli;
			$rowData[] = $value->nama_poli;
			$rowData[] = $value->nama_spesialis;
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