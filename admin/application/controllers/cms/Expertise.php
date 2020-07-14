<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Expertise extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_expertise");
		$this->load->model("M_groupmodule");
		$this->load->library('user_agent');
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "expertise";
		$data['content']   = "admin/expertise/listexpertise";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add expertise";
		$data['content']   		= "admin/expertise/addexpertise";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();
		
		
		$insertArray = array(
				"id" => guid(),
				"expertise_code"    => $post['expertise_code'],
				"expertise_name"    => $post['expertise_name'],
				"create_date"     	=> date('Y-m-d H:i:s'),
				"created_by"     	=> $this->sessionData['user_id']

			);

			$insert = $this->db->insert("master_expertise", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/expertise");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/expertise/add");
			}

		
	}

	function edit($param){
		$id_expertise = encrypt_decrypt("decrypt",$param);
		$detailexpertise = $this->M_expertise->getDetailexpertise($id_expertise);

		$data['id']	= "";
		if (!empty($detailexpertise)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['detailexpertise'] 	= $detailexpertise;
		$data['web_title']  	= "Edit expertise";
		$data['content']    	= "admin/expertise/editexpertise";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate(){
		$post    = $this->input->post();
		$id_expertise = encrypt_decrypt("decrypt", $post['param']);
		
			$updateArray = array(
				"expertise_code"    => $post['expertise_code'],
				"expertise_name"    => $post['expertise_name'],
				"updated_date"     	=> date('Y-m-d H:i:s'),
				"updated_by" 		=> $this->sessionData['user_id']
			);

			$update = $this->db->update("master_expertise", $updateArray, array("id" => $id_expertise));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/expertise");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/expertise/edit.".$post['param']);
			}
		
	}

	function doDelete($param){
		$id_expertise = encrypt_decrypt("decrypt", $param);

		$this->db->where('id' , $id_expertise);
		$this->db->delete('master_expertise');
		$this->session->set_flashdata('is_success', 'Yes');
		redirect("cms/expertise");
		}


	public function get_list_expertise(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_expertise->get_list_expertise ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_expertise->get_list_expertise ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_expertise->get_list_expertise ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_expertise->get_list_expertise ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();
			$button = "";

			$button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/expertise/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/expertise/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';
			

			$rowData[] = $no++;
			$rowData[] = $value->expertise_code;
			$rowData[] = $value->expertise_name;
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