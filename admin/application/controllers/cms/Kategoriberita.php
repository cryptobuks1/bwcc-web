<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class KategoriBerita extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_kategoriberita");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$dataKategori = $this->M_kategoriberita->getData();

		$data['listData'] 	= $dataKategori;
		$data['web_title'] 	= "Kategori Berita";
		$data['content']   	= "admin/master/kategori_berita/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$data['back_link'] = base_url('cms/kategoriberita');
		$data['web_title'] = "Add Kategori Berita";
		$data['content']   = "admin/master/kategori_berita/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		$insertArray = array(
			"id"  			=> guid(),
			"name" 			=> $post['kategori_nama'],
			"is_active"		=> 1,
			"created_date"  => date('Y-m-d H:i:s'),
			"created_by"    => $this->sessionData['user_id']
		);

		$insert	= $this->db->insert("master_category_news", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/kategoriberita");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/kategoriberita/add/");
		}
	}

	function edit($id){
		$detailKategori			= $this->M_kategoriberita->getOneData("id", $id);

		if (!$detailKategori) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/kategoriberita");
		}
		
		$data['detailData'] 	= $detailKategori;
		$data['back_link']   	= base_url('cms/kategoriberita');
		$data['web_title']   	= "Edit Kategori Berita";
		$data['content']     	= "admin/master/kategori_berita/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     		= $this->input->post();
		$detailKategori 	= $this->M_kategoriberita->getOneData("id", $id);

		if (!$detailKategori) {
			custom_notif("failed", "Notif", "Data tidak Ada");
			redirect("cms/kategoriberita");
		}

		$dataArray = array(
			"name" 			=> $post['kategori_nama'],
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_category_news", $dataArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/kategoriberita");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/kategoriberita/edit/".$id);
		}
	}

	function doDelete($id){
		$updateArray = array(
			"is_active"   	=> "0",
			"updated_date" 	=> date("Y-m-d H:i:s"),
			"updated_by"   	=> $this->sessionData['user_id'],
		);

		$delete = $this->db->update("master_category_news", $updateArray, array("id" => $id));
		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/kategoriberita");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/kategoriberita");
		}
	}
}