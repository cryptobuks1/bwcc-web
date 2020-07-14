<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privacy extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_privacy");
		$this->load->model("M_groupmodule");
		$this->load->library('user_agent');
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Privacy";
		$data['content']   = "admin/privacy/listprivacy";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add Privacy";
		$data['content']   		= "admin/privacy/addprivacy";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();
		
		$insertArray = array(
				"value"     => $post['value']
			);

			$insert = $this->db->insert("privacy_policy", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/privacy");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/privacy/add");
			}

		
	}

	function edit($param){
		$id_privacy = encrypt_decrypt("decrypt",$param);
		$detailprivacy = $this->M_privacy->getDetailprivacy($id_privacy);

		$data['id']	= "";
		if (!empty($detailprivacy)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['detailprivacy'] 	= $detailprivacy;
		$data['web_title']  	= "Edit Privacy";
		$data['content']    	= "admin/privacy/editprivacy";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate(){
		$post    = $this->input->post();
		$id_privacy = encrypt_decrypt("decrypt", $post['param']);
		
			$updateArray = array(
				"value"     => $post['value']

			);

			$update = $this->db->update("privacy_policy", $updateArray, array("id" => $id_privacy));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/privacy");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/privacy/edit.".$post['param']);
			}
		
	}

	function doDelete($param){
		$id_privacy = encrypt_decrypt("decrypt", $param);

		$this->db->where('id' , $id_privacy);
		$this->db->delete('privacy_policy');
		$this->session->set_flashdata('is_success', 'Yes');
		redirect("cms/privacy");
		}

	public function get_list_privacy(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_privacy->get_list_privacy ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_privacy->get_list_privacy ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_privacy->get_list_privacy ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_privacy->get_list_privacy ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();
			$button = "";

			$button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/privacy/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/privacy/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';
			

			$rowData[] = $no++;
			$rowData[] = $value->value;
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
}