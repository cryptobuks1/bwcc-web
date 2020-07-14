<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Patient extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_patient");
		$this->load->model("M_groupmodule");
		$this->load->library('user_agent');
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Patient";
		$data['content']   = "admin/patient/listpatient";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add User";
		$data['content']   		= "admin/user/adduser";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();
		
		// Buat password
		$hash 		= random(128);
		$password 	= password_hash($post['user_password'].'.'.$hash, PASSWORD_DEFAULT);

		$checkEmail = $this->M_user->checkEmailExist($post['user_email']);
		if (empty($checkEmail)) {

			$insertArray = array(
				"id"				=> guid(),
				"name"          	=> $post['user_name'],
				"email"         	=> $post['user_email'],
				"password"      	=> $password,
				"hash"       		=> $hash,
				"device_user"		=> $this->agent->agent_string(),
				"ip_address"		=> $this->input->ip_address(),
				"is_active"			=> 1,
				"access_group_id"	=> $post['akses'],
				"is_deleted"		=> 0,
				"created_date"     	=> date('Y-m-d H:i:s'),
				"created_by"       	=> $this->sessionData['user_id']
			);

			$insert = $this->db->insert("admin", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/user");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/user/add");
			}
		}else{
			$this->session->set_flashdata('is_success', 'Email sudah ada');
			redirect("cms/user/add");
		}
		
	}

	function edit($param){
		// $user_id = encrypt_decrypt("decrypt",$param);
		// $detailUser = $this->M_user->getDetailUser($user_id);

		// $data['id']	= "";
		// if (!empty($detailUser)) {
		// 	$data['id']	= $param;
		// }

		// $getGroupModule 		= $this->M_groupmodule->getGroupModule();

		// $data['groupModule']	= $getGroupModule;
		// $data['detailUser'] 	= $detailUser;
		// $data['web_title']  	= "Edit User";
		// $data['content']    	= "admin/user/edituser";
		// $this->load->view('admin/layout',$data);
		redirect("cms/patient");

	}

	function doUpdate(){
		$post    = $this->input->post();
		$user_id = encrypt_decrypt("decrypt", $post['param']);
		// Buat password
		$hash 		= random(128);
		$password 	= password_hash($post['user_password'].'.'.$hash, PASSWORD_DEFAULT);
		
		$checkEmail = $this->M_user->checkEmailByUser($user_id, $post['user_email']);
		if (empty($checkEmail)) {
			$updateArray = array(
				'name'           	=> $post['user_name'],
				"email"          	=> $post['user_email'],
				"access_group_id" 	=> $post['akses'],
				"updated_date"     	=> date('Y-m-d H:i:s'),
				"updated_by"       	=> $this->sessionData['user_id']

			);

			if ($post['user_password'] <> "") {
				$updateArray['hash']		= $hash;
				$updateArray['password'] 	= $password;
			}

			$update = $this->db->update("admin", $updateArray, array("id" => $user_id));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/user");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/user/edit.".$post['param']);
			}
		}else{
			$this->session->set_flashdata('is_success', 'Email already exist');
			redirect("cms/user/edit.".$post['param']);
		}
	}

	function doDelete($param){
		$user_id = encrypt_decrypt("decrypt", $param);

		if ($user_id == $this->sessionData['user_id']) {
			$this->session->set_flashdata('is_success', 'User ini sedang digunakan');
			redirect("cms/patient");
		}else{
			$updateArray = array(
				"is_deleted" => 1
			);

			$update = $this->db->update("patient", $updateArray, array("id" => $user_id));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/patient");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/patient");
			}
		}
	
	}

	public function get_list_patient(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_patient->all_patient ( $requestParam, 'nofilter' );

		$totalAllData 			= $this->M_patient->all_patient ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_patient->all_patient ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_patient->all_patient ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){

			// get user 
			$get_user = $this->db->where('id' , $value->created_by);
			$return_user = $this->db->get('user');
			$ret = $return_user->row();


			$rowData = array();
			$button = "";

			// $button .= '
			// <button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/patient/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			// $button .= '
			// <a href="'.base_url('cms/patient/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';

			$button .= '';
			

			$rowData[] = $no++;
			//$rowData[] = $value->rm_id;
			$rowData[] = $value->nama;
			$rowData[] = $value->jenis_kelamin;
			$rowData[] = $value->lahir_tempat;
			$rowData[] = date('d-m-Y', $value->lahir_tanggal);
			$rowData[] = $value->alamat;
			$rowData[] = $value->no_hp;
			$rowData[] = $value->email;
			$rowData[] = $ret->name;
			// $rowData[] = $button;
			
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
}