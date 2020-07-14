<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Berita extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_berita");
		$this->load->model("M_kategoriberita");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Berita";
		$data['content']   = "admin/berita/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getKategori		= $this->M_kategoriberita->getData();

		$data['kategori_berita'] 	= $getKategori;
		$data['back_link'] 			= base_url('cms/berita');
		$data['web_title'] 			= "Add Berita";
		$data['content']   			= "admin/berita/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		if ($post['type_media'] == 1) {
			$media = $post['photo'];
		}else{
			// Custom nama file
			$nama_file = 'NW-'.date('ydmhis').rand(10,99);
			// Configuration for file upload
			$config['upload_path']          = './images/berita/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 8000;
			$config['max_width']            = 780;
			$config['max_height']           = 440;
			$config['file_name']			= $nama_file;

			$this->load->library('upload', $config);
	 
			if (!$this->upload->do_upload('photo')){
				$error = array('error' => $this->upload->display_errors());
				custom_notif("failed","Notif",$error['error']);
				redirect("cms/berita/add");
			}else{
				$data = array('upload_data' => $this->upload->data());
			}

			$media = "images/berita/".$this->upload->data('orig_name');
		}
		
		$insertArray = array(
			"id"			=> guid(),
			"title"			=> $post['berita_judul'],
			"id_category" 	=> $post['id_berita'],
			"content" 		=> $post['berita_content'],
			"type"			=> $post['type_media'],
			"image"			=> $media,
			"is_active"		=> "1",
			"created_date"  => date('Y-m-d H:i:s'),
			"created_by"    => $this->sessionData['user_id']
		);

		$insert	= $this->db->insert("news", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "");
			redirect("cms/berita/");
		}else{
			custom_notif("success", "failed", "");
			redirect("cms/berita/add/");
		}
	}

	function edit($id){
		$getBerita = $this->M_berita->getOneData("id", $id);

		if (!$getBerita) {
			custom_notif("failed", "Notif", "Data tidak ada");
			redirect("cmd/berita");
		}

		$getKategori	= $this->M_kategoriberita->getData();

		$data['kategori_berita'] 	= $getKategori;
		$data['detailData']			= $getBerita;
		$data['back_link']    		= base_url('cms/berita');
		$data['web_title']    		= "Edit Berita";
		$data['content']      		= "admin/berita/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     	= $this->input->post();
		
		$updateArray = array(
				"title"     	=> $post['berita_judul'],
				"id_category"	=> $post['id_berita'],
				"content"     	=> $post['berita_content'],
				"type"			=> $post['type_media'],
				"updated_date"  => date('Y-m-d H:i:s'),
				"updated_by"    => $this->sessionData['user_id']
			);

		if ($post['type_media'] == 1) {
			$updateArray["image"]	= $post['photo'];
		}else{
			if(!empty($_FILES['photo']['name'])){
				$nama_file = 'NW-'.date('ydmhis').rand(10,99);

				// Configuration for file upload
				$config['upload_path']          = './images/berita/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 8000;
				$config['max_width']            = 780;
				$config['max_height']           = 440;
				$config['file_name']			= $nama_file;

				$this->load->library('upload', $config);
		 
				if ( ! $this->upload->do_upload('photo')){
					$error = array('error' => $this->upload->display_errors());
					custom_notif("failed", "Notif", $error['error']);
					redirect("cms/berita/edit/".$id);
				}else{
					$data = array('upload_data' => $this->upload->data());
				}
				
				$updateArray["image"]	= "images/berita/".$this->upload->data('orig_name');
				
			}
		}

		$update = $this->db->update("news", $updateArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "");
			redirect("cms/berita");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/berita/edit/".$id);
		}
	}

	function doDelete($id){
		
		$updateArray = array(
			"is_active"   	=> "0",
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$delete = $this->db->update("news", $updateArray, array("id" => $id));
		if ($delete) {
			custom_notif("success", "Notif", "");
			redirect("cms/berita");
		}else{
			custom_notif("failed", "Notif", "");
			redirect("cms/berita");
		}
	}

	/*==================================================== DATA FOR DATATABLE ====================================================*/
	public function get_list_berita(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_berita->get_list_news ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_berita->get_list_news ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_berita->get_list_news ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_berita->get_list_news ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();

			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$button = "";
			$button .= 	'
							<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/berita/doDelete/'.$value->id).'\')" title="Delete"><i class="fa fa-trash"></i></button>
							<a href="'.base_url('cms/berita/edit/'.$value->id).'" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>
						';

			// $button .= '
			// 			<div class="btn-group">
			// 			  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			// 			    Action
			// 			  </button>
			// 			  <div class="dropdown-menu">
			// 			    <a class="dropdown-item" href="'.base_url('cms/dokter/edit/'.$value->id).'"><i class="fa fa-edit"></i> Edit</a>
			// 			    <a class="dropdown-item" onClick="is_delete(\''.base_url('cms/dokter/doDelete/'.$value->id).'\')"><i class="fa fa-trash"></i> Hapus</a>
			// 			    <div class="dropdown-divider"></div>
			// 			    <a class="dropdown-item" href="'.base_url('cms/dokter/status/'.$value->id).'"><i class="fa fa-check"></i> Active/Non-active</a>
			// 			  </div>
			// 			</div>
			// 		';

			// $status = "";
			// if ($value->is_active != 0) {
			// 	$status .= '<span class="badge badge-pill badge-success">Yes</span>';
			// }else{
			// 	$status .= '<span class="badge badge-pill badge-danger">No</span>';
			// }
			/*========================================= END BUTTON STUFF =========================================*/

			$rowData[] = $no++;
			$rowData[] = $value->title;
			$rowData[] = $value->category_name;
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