<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pembayaran extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_pembayaran");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$dataPembayaran = $this->M_pembayaran->getData();

		$data['listData'] 	= $dataPembayaran;
		$data['web_title'] 	= "Pembayaran";
		$data['content']   	= "admin/master/pembayaran/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$data['back_link'] = base_url('cms/pembayaran');
		$data['web_title'] = "Add Pembayaran";
		$data['content']   = "admin/master/pembayaran/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		$insertArray = array(
			"id"  			=> guid(),
			"name" 			=> $post['pembayaran_nama'],
			"detail" 		=> $post['pembayaran_detail'],
			"is_active"		=> 1,
			"is_deleted"	=> 0,
			"created_date"  => date('Y-m-d H:i:s'),
			"created_by"    => $this->sessionData['user_id']
		);

		$insert	= $this->db->insert("master_payment", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/pembayaran");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/pembayaran/add/");
		}
	}

	function edit($id){
		$detailPembayaran		= $this->M_pembayaran->getOneData("id", $id);

		if (!$detailPembayaran) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/pembayaran");
		}
		
		$data['detailData'] 	= $detailPembayaran;
		$data['back_link']   	= base_url('cms/pembayaran');
		$data['web_title']   	= "Edit Pembayaran";
		$data['content']     	= "admin/master/pembayaran/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     		= $this->input->post();
		$detailPembayaran 	= $this->M_pembayaran->getOneData("id", $id);

		if (!$detailPembayaran) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/pembayaran");
		}

		$dataArray = array(
			"name" 			=> $post['pembayaran_nama'],
			"detail" 		=> $post['pembayaran_detail'],
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_payment", $dataArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/pembayaran");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/pembayaran/edit/".$id);
		}
	}

	function doDelete($id){
		$updateArray = array(
			"is_deleted"   	=> "1",
			"updated_date" 	=> date("Y-m-d H:i:s"),
			"updated_by"   	=> $this->sessionData['user_id'],
		);

		$delete = $this->db->update("master_payment", $updateArray, array("id" => $id));
		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/pembayaran");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/pembayaran");
		}
	}

	function status($id){
		$getPembayaran 	= $this->M_pembayaran->getOneData("id", $id);

		if (!$getPembayaran) {
			custom_notif("failed", "Notif", "Data tidak ada");
			redirect("cms/pembayaran");
		}
		
		if ($getPembayaran->is_active == 1) {
			$status = 0;
		}else{
			$status = 1;
		}
		
		$updateArray = array(
			"is_active"   	=> $status,
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$updated_status = $this->db->update("master_payment", $updateArray, array("id" => $id));
		if ($updated_status) {
			custom_notif("success", "Notif", "");
			redirect("cms/pembayaran");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/pembayaran");
		}
	}
}