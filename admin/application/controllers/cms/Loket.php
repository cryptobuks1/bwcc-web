<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loket extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_loket");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$dataLoket = $this->M_loket->getData();

		$data['listData'] 	= $dataLoket;
		$data['web_title'] 	= "Loket";
		$data['content']   	= "admin/master/loket/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$data['back_link'] = base_url('cms/loket');
		$data['web_title'] = "Add Loket";
		$data['content']   = "admin/master/loket/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		$insertArray = array(
			"id"  			=> guid(),
			"name" 			=> $post['nama_loket'],
			"is_active"		=> 1,
			"created_date"  => date('Y-m-d H:i:s'),
			"created_by"    => $this->sessionData['user_id']
		);

		$insert	= $this->db->insert("master_counter", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/loket/add");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/loket/add/");
		}
	}

	function edit($id){
		$detailLoket 			= $this->M_loket->getOneData("id", $id);

		if (!$detailLoket) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/loket");
		}
		
		$data['detailData'] 	= $detailLoket;
		$data['back_link']   	= base_url('cms/loket');
		$data['web_title']   	= "Edit Loket";
		$data['content']     	= "admin/master/loket/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     		= $this->input->post();
		$detailLoket 	= $this->M_loket->getOneData("id", $id);

		if (!$detailLoket) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/loket");
		}

		$dataArray = array(
			"name" 			=> $post['nama_loket'],
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_counter", $dataArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/loket");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/loket/edit/".$id);
		}
	}

	function doDelete($id){
		$updateArray = array(
			"is_active"   	=> "0",
			"updated_date" 	=> date("Y-m-d H:i:s"),
			"updated_by"   	=> $this->sessionData['user_id'],
		);

		$delete = $this->db->update("master_counter", $updateArray, array("id" => $id));
		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/loket");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/loket");
		}
	}
}