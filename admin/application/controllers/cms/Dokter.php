<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class Dokter extends CI_Controller {

	public function __construct(){

		parent::__construct();

		$this->load->model("M_dokter");

		$this->load->model("M_spesialis");

		$this->sessionData = $this->session->sessionData;

		$sessionData = $this->sessionData;

		if (empty($sessionData)) {

			redirect('cms/signin');

		}

	}



	function index(){

		$data['web_title'] = "Dokter";

		$data['content']   = "admin/master/dokter/index";

		$this->load->view('admin/layout',$data);

	}



	function add(){

		$getSpesialis	= $this->M_spesialis->getData();



		$data['spesialis'] = $getSpesialis;

		$data['back_link'] = base_url('cms/dokter');

		$data['web_title'] = "Add Dokter";

		$data['content']   = "admin/master/dokter/add";

		$this->load->view('admin/layout',$data);

	}



	function doAdd(){

		$post = $this->input->post();



		if (empty($post['photo'])) {

			if ($post['jk'] == 'L') {

				$photo_value = 'dokter_pria.jpg';

			}

			else

			{

				$photo_value = 'dokter_wanita.jpg';

			}

		}

		else

		{

			// Custom nama file

			$nama_file = 'DK-'.date('ydmhis').rand(10,99);

			// Configuration for file upload

			$config['upload_path']          = './images/dokter/';

			$config['allowed_types']        = 'jpg|png|jpeg';

			$config['max_size']             = 8000;

			$config['max_width']            = 2048;

			$config['max_height']           = 2048;

			$config['file_name']			= $nama_file;



			$this->load->library('upload', $config);

	 

			// if (!$this->upload->do_upload('photo')){

			// 	$error = array('error' => $this->upload->display_errors());

			// 	custom_notif("failed","Notif","Ukuran gambar tidak sesuai, saran ukuran 512x512 pixels");

			// 	redirect("cms/dokter/add");

			// }else{

				$data = array('upload_data' => $this->upload->data());

			// }



			$photo_value = $this->upload->data('orig_name');

		}



		$id_doctor = guid();

		

		$insertArray = array(

			"id"			=> $id_doctor,

			"id_specialist"	=> $post['spesialis_id'],

			"name" 			=> $post['dokter_nama'],

			"no_str" 		=> $post['dokter_no_str'],

			"gender"	 	=> $post['jk'],

			"image"			=> "images/dokter/".$photo_value,

			"experience"	=> $post['dokter_experience'],

			"is_active"		=> "1",

			"is_deleted"	=> "0",

			"created_date"  => date('Y-m-d H:i:s'),

			"created_by"    => $this->sessionData['user_id']

		);



		$insert	= $this->db->insert("master_doctor", $insertArray);

		if ($insert) {



			// Insert to Jadwal Dokter

			// for ($i=0; $i < 7; $i++) { 

			// 	$jadwal_dokter = [

			// 		"id"					=> guid(),

			// 		"id_poly"				=> "",

			// 		"id_doctor"				=> $id_doctor,

			// 		"start_time_service"	=> "",

			// 		"finish_time_service"	=> "",

			// 		"quota"					=> 0,

			// 		"start_onsite"			=> "",

			// 		"end_onsite"			=> "",

			// 		"quota_online"			=> 0,

			// 		"days"					=> $i+1,

			// 		"weeks"					=> "",

			// 		"type"					=> 1,

			// 		"created_date"  		=> date('Y-m-d H:i:s'),

			// 		"created_by"    		=> $this->sessionData['user_id']

			// 	];	



			// 	$this->db->insert("master_practice_schedule", $jadwal_dokter);

			// }

			// End



			custom_notif("success", "Notif", "");

			redirect("cms/dokter/");

		}else{

			custom_notif("success", "failed", "");

			redirect("cms/dokter/add/");

		}

	}



	function edit($id){

		$getDokter = $this->M_dokter->getOneData("id", $id);



		if (!$getDokter) {

			custom_notif("failed", "Notif", "Data tidak ada");

			redirect("cmd/dokter");

		}



		$getSpesialis	= $this->M_spesialis->getData();



		$data['spesialis'] = $getSpesialis;

		$data['detailData']		= $getDokter;

		$data['back_link']    	= base_url('cms/dokter');

		$data['web_title']    	= "Edit Dokter";

		$data['content']      	= "admin/master/dokter/edit";

		$this->load->view('admin/layout',$data);

	}



	function doUpdate($id){

		$post     	= $this->input->post();



		// $get_schedule 	= $this->M_dokter->getScheduleDoctor("id_doctor", $id);

		// if (!$get_schedule) {

		// 	// Insert to Jadwal Dokter

		// 	for ($i=0; $i < 7; $i++) { 

		// 		$jadwal_dokter = [

		// 			"id"					=> guid(),

		// 			"id_poly"				=> "",

		// 			"id_doctor"				=> $id,

		// 			"start_time_service"	=> "",

		// 			"finish_time_service"	=> "",

		// 			"quota"					=> 0,

		// 			"start_onsite"			=> "",

		// 			"end_onsite"			=> "",

		// 			"quota_online"			=> 0,

		// 			"days"					=> $i+1,

		// 			"weeks"					=> "",

		// 			"type"					=> 1,

		// 			"created_date"  		=> date('Y-m-d H:i:s'),

		// 			"created_by"    		=> $this->sessionData['user_id']

		// 		];	



		// 		$this->db->insert("master_practice_schedule", $jadwal_dokter);

		// 	}

		// 	// End

		// }

		// else

		// {



		// }

		

		$updateArray = array(

				"id_specialist"	=> $post['spesialis_id'],

				"name"     		=> $post['dokter_nama'],

				"no_str"     	=> $post['dokter_no_str'],

				"gender"   		=> $post['jk'],

				"experience"	=> $post['dokter_experience'],

				"updated_date"  => date('Y-m-d H:i:s'),

				"updated_by"    => $this->sessionData['user_id']

			);



		if(!empty($_FILES['photo']['name'])){

			$nama_file = 'DK-'.date('ydmhis').rand(10,99);



			// Configuration for file upload

			$config['upload_path']          = './images/dokter/';

			$config['allowed_types']        = 'jpg|png|jpeg';

			$config['max_size']             = 8000;

			$config['max_width']            = 2048;

			$config['max_height']           = 2048;

			$config['file_name']			= $nama_file;



			$this->load->library('upload', $config);

	 

			if ( ! $this->upload->do_upload('photo')){

				$error = array('error' => $this->upload->display_errors());

				custom_notif("failed", "Notif", $error['error']);

				redirect("cms/dokter/edit/".$id);

			}else{

				$data = array('upload_data' => $this->upload->data());

			}

			

			$updateArray["image"]	= "images/dokter/".$this->upload->data('orig_name');

			

		}



		$update = $this->db->update("master_doctor", $updateArray, array("id" => $id));

		if ($update) {

			custom_notif("success", "Notif", "");

			redirect("cms/dokter");

		}else{

			custom_notif("failed", "Notif", "");

			redirect("cms/dokter/edit/".$id);

		}

	}



	function doDelete($id){

		

		$updateArray = array(

			"is_deleted"   => "1",

			"updated_date"  => date('Y-m-d H:i:s'),

			"updated_by"    => $this->sessionData['user_id']

		);



		$delete = $this->db->update("master_doctor", $updateArray, array("id" => $id));

		if ($delete) {

			custom_notif("success", "Notif", "");

			redirect("cms/dokter");

		}else{

			custom_notif("failed", "Notif", "");

			redirect("cms/dokter");

		}

	}



	function status($id){

		$getDokter 	= $this->M_dokter->getOneData("id", $id);



		if (!$getDokter) {

			custom_notif("failed", "Notif", "Data tidak ada");

			redirect("cms/dokter");

		}

		

		if ($getDokter->is_active == 1) {

			$status = 0;

		}else{

			$status = 1;

		}

		

		$updateArray = array(

			"is_active"   	=> $status,

			"updated_date"  => date('Y-m-d H:i:s'),

			"updated_by"    => $this->sessionData['user_id']

		);



		$updated_status = $this->db->update("master_doctor", $updateArray, array("id" => $id));

		if ($updated_status) {

			custom_notif("success", "Notif", "");

			redirect("cms/dokter");

		}else{

			custom_notif("failed", "Notif", "");

			redirect("cms/dokter");

		}

	}



	/*==================================================== Jadwal Dokter ====================================================*/

	function jadwaldokter($id){

		$get_schedule 	= $this->M_dokter->getScheduleDoctor("id_doctor", $id);



		$data['jadwal']		= $get_schedule;

		$data['id_dokter']	= $id;

		$data['nama_dokter'] = $this->M_dokter->getOneData("id", $id)->name;

		$data['back_link'] 	= base_url('cms/dokter');

		$data['doctor_absent_list'] = $this->M_dokter->getDoctorAbsent("id_doktor", $id);

		$data['web_title'] 	= "Add Jadwal Dokter";

		$data['content']   	= "admin/master/dokter/jadwal_dokter";

		$this->load->view('admin/layout', $data);

	}



	function updateJadwal(){

		$post = $this->input->post();

		$this->db->where('id_doktor' , $post['id_dokter']);
		$check_row = $this->db->get('doctor_absent')->row();
		// $list_hari = ["senin", "selasa", "rabu", "kamis", "jumat", "sabtu", "minggu"];
		$list_hari = array(
			0 => 'senin',
			1 => 'selasa',
			2 => 'rabu',
			3 => 'kamis',
			4 => 'jumat',
			5 => 'sabtu',
			6 => 'minggu'
		);

		if (empty($check_row)) {
			$encode_day = json_encode($post['day']);
			$encode_start_absent = json_encode($post['start_absent']);
			$encode_end_absent = json_encode($post['end_absent']);

			$decode_day = json_decode($encode_day, true);
			$decode_start_absent = json_decode($encode_start_absent, true);
			$decode_end_absent = json_decode($encode_end_absent, true);

			$countdata = '';
		
			foreach ($decode_day as $key => $value) {
					$countdata = $key;
				}	

				// echo $countdata;
			$addrow = $countdata + 1;

			for ($i = 0; $i < $addrow; $i++) { 
				// echo ''.$decode_day[$i].' : '.$decode_start_absent[$i].' - '.$decode_end_absent[$i].' <br>';
				$datainsert_todb = array(
	                'id_doktor'     => $post['id_dokter'],
	                'day' 			=> $decode_day[$i],
	                'start_absent' 	=> $decode_start_absent[$i],
	                'end_absent' 	=> $decode_end_absent[$i],
	                'result_api'	=> array_search($decode_day[$i], $list_hari),
	                'created_date'  => date('Y-m-d H:i:s')
	            );
	       		$datainsert = $this->db->insert('doctor_absent', $datainsert_todb);
			}

			if ($datainsert) {

	                custom_notif("success", "Notif", "Jadwal berhasil ditambahkan");

	                redirect("cms/dokter/");

	            }else{

	                custom_notif("success", "failed", "");

	                redirect("cms/dokter/");

	            }
		}
		else
		{
			$this->db->where('id_doktor' , $check_row->id_doktor);
			$this->db->delete('doctor_absent');

			$encode_day = json_encode($post['day']);
			$encode_start_absent = json_encode($post['start_absent']);
			$encode_end_absent = json_encode($post['end_absent']);

			$decode_day = json_decode($encode_day, true);
			$decode_start_absent = json_decode($encode_start_absent, true);
			$decode_end_absent = json_decode($encode_end_absent, true);

			$countdata = '';
		
			foreach ($decode_day as $key => $value) {
					$countdata = $key;
				}	

				// echo $countdata;
			$addrow = $countdata + 1;

			for ($i = 0; $i < $addrow; $i++) { 
				// echo ''.$decode_day[$i].' : '.$decode_start_absent[$i].' - '.$decode_end_absent[$i].' <br>';
				$datainsert_todb = array(
	                'id_doktor'     => $post['id_dokter'],
	                'day' 			=> $decode_day[$i],
	                'start_absent' 	=> $decode_start_absent[$i],
	                'end_absent' 	=> $decode_end_absent[$i],
	                'result_api'	=> array_search($decode_day[$i], $list_hari),
	                'created_date'  => date('Y-m-d H:i:s')
	            );
	       		$datainsert = $this->db->insert('doctor_absent', $datainsert_todb);
			}

			if ($datainsert) {

	                custom_notif("success", "Notif", "Jadwal berhasil ditambahkan");

	                redirect("cms/dokter/");

	            }else{

	                custom_notif("success", "failed", "");

	                redirect("cms/dokter/");

	            }
		}

		

	}

	/*==================================================== DATA FOR DATATABLE ====================================================*/

	public function get_list_dokter(){

		$requestParam 			= $_REQUEST;



		$getData 				= $this->M_dokter->get_list_dokter ( $requestParam, 'nofilter' );

		$totalAllData 			= $this->M_dokter->get_list_dokter ( $requestParam, 'nofilter', 'all' )->num_rows ();

		$totalDataFiltered 		= $this->M_dokter->get_list_dokter ( $requestParam, 'nofilter', 'all' )->num_rows ();

		

		if (empty ( $requestParam ['search'] ['value'] ) > 1) {

			$getData 			= $this->M_dokter->get_list_dokter ( $requestParam );

			$totalDataFiltered 	= $getData->num_rows ();

		}

		

		$listData = array ();

		$no = ($requestParam['start']+1);

		

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

						    <a class="dropdown-item" href="'.base_url('cms/dokter/edit/'.$value->id).'"><i class="fa fa-edit"></i> Edit</a>

						    <a class="dropdown-item" onClick="is_delete(\''.base_url('cms/dokter/doDelete/'.$value->id).'\')"><i class="fa fa-trash"></i> Hapus</a>

						    <div class="dropdown-divider"></div>

						    <a class="dropdown-item" href="'.base_url('cms/dokter/status/'.$value->id).'"><i class="fa fa-check"></i> Active/Non-active</a>

						    <div class="dropdown-divider"></div>

						    <a class="dropdown-item" href="'.base_url('cms/dokter/jadwaldokter/'.$value->id).'"><i class="fa fa-check"></i> Tambah/Edit Jadwal</a>
						  </div>

						</div>

					';



			$status = "";

			if ($value->is_active != 0) {

				$status .= '<span class="badge badge-pill badge-success">Yes</span>';

			}else{

				$status .= '<span class="badge badge-pill badge-danger">No</span>';

			}

			/*========================================= END BUTTON STUFF =========================================*/



			$rowData[] = $no++;

			$rowData[] = $value->name;

			$rowData[] = $value->no_str;

			$rowData[] = $value->specialist_name;

			$rowData[] = ($value->gender == "L") ? "Laki - laki" : "Perempuan";

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