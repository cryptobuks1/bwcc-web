<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Spesialis extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_spesialis");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$dataLoket = $this->M_spesialis->getData();

		$data['listData'] 	= $dataLoket;
		$data['web_title'] 	= "Spesialis";
		$data['content']   	= "admin/master/spesialis/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$data['back_link'] = base_url('cms/spesialis');
		$data['web_title'] = "Add Loket";
		$data['content']   = "admin/master/spesialis/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		$insertArray = array(
			"id"  				=> guid(),
			"specialist_code" 	=> $post['spesialis_kode'],
			"name" 				=> $post['spesialis_nama'],
			"is_deleted"		=> 0,
			"created_date"  	=> date('Y-m-d H:i:s'),
			"created_by"    	=> $this->sessionData['user_id']
		);

		$insert	= $this->db->insert("master_specialist", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/spesialis/");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/spesialis/add/");
		}
	}

	function edit($id){
		$detailSpesialis		= $this->M_spesialis->getOneData("id", $id);

		if (!$detailSpesialis) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/spesialis");
		}
		
		$data['detailData'] 	= $detailSpesialis;
		$data['back_link']   	= base_url('cms/spesialis');
		$data['web_title']   	= "Edit Spesialis";
		$data['content']     	= "admin/master/spesialis/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     			= $this->input->post();
		$detailSpesialis 	= $this->M_spesialis->getOneData("id", $id);

		if (!$detailSpesialis) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/spesialis");
		}

		$dataArray = array(
			"specialist_code" 	=> $post['spesialis_kode'],
			"name" 				=> $post['spesialis_nama'],
			"updated_date"  	=> date('Y-m-d H:i:s'),
			"updated_by"    	=> $this->sessionData['user_id']
		);

		$update = $this->db->update("master_specialist", $dataArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/spesialis");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/spesialis/edit/".$id);
		}
	}

	function doDelete($id){
		$updateArray = array(
			"is_deleted"   	=> "1",
			"updated_date" 	=> date("Y-m-d H:i:s"),
			"updated_by"   	=> $this->sessionData['user_id'],
		);

		$delete = $this->db->update("master_specialist", $updateArray, array("id" => $id));
		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/spesialis");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/spesialis");
		}
	}
}