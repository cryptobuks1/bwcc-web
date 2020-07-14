<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Content_image extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_content_image");
		$this->load->model("M_groupmodule");
		$this->load->library('user_agent');
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "content_image";
		$data['content']   = "admin/content_image/listcontent_image";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add content image";
		$data['content']   		= "admin/content_image/addcontent_image";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();
		// Custom nama file
			$nama_file = 'image-content-'.date('ydmhis').rand(10,99);
			// Configuration for file upload
			$config['upload_path']          = './images/content_image/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 8000;
			$config['max_width']            = 2048;
			$config['max_height']           = 2048;
			$config['file_name']			= $nama_file;

			$this->load->library('upload', $config);
	 
			if (!$this->upload->do_upload('fileToUpload')){
				$error = array('error' => $this->upload->display_errors());
				custom_notif("failed","Notif","Ukuran gambar tidak sesuai, saran ukuran 512x512 pixels");
				redirect("cms/content_image/add");
			}else{
				$data = array('upload_data' => $this->upload->data());
			}

			$photo_value = $this->upload->data('orig_name');

			$insertArray = array(
				"type"     		=> $post['type'],
				"image_url"     => $photo_value,
				"is_active"     => $post['is_active'],
				"created_date"  => date('Y-m-d H:i:s')
			);

			$insert = $this->db->insert("content_image", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/content_image");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/content_image/add");
			}

		
	}

	function edit($param){
		$id_content_image = encrypt_decrypt("decrypt",$param);
		$detailcontent_image = $this->M_content_image->getDetailContent_image($id_content_image);

		$data['id']	= "";
		if (!empty($detailcontent_image)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['detailcontent_image'] 	= $detailcontent_image;
		$data['web_title']  	= "Edit content_image";
		$data['content']    	= "admin/content_image/editcontent_image";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate(){
		$post    = $this->input->post();
		$id_content_image = encrypt_decrypt("decrypt", $post['param']);
		$detailcontent_image = $this->M_content_image->getDetailContent_image($id_content_image);

			if (empty($_FILES['fileToUpload']['name'])) {
				$updated_content_image = $detailcontent_image->image_url;
			}
			else
			{
				$nama_file = 'image-content-'.date('ydmhis').rand(10,99);
				// Configuration for file upload
				$config['upload_path']          = './images/content_image/';
				$config['allowed_types']        = 'jpg|png|jpeg';
				$config['max_size']             = 8000;
				$config['max_width']            = 2048;
				$config['max_height']           = 2048;
				$config['file_name']			= $nama_file;

				$this->load->library('upload', $config);
		 
				if (!$this->upload->do_upload('fileToUpload')){
					$error = array('error' => $this->upload->display_errors());
					custom_notif("failed","Notif","Ukuran gambar tidak sesuai, saran ukuran 512x512 pixels");
					redirect("cms/content_image/add");
				}else{
					$data = array('upload_data' => $this->upload->data());
				}

				$updated_content_image = $this->upload->data('orig_name');
			}
		
			$updateArray = array(
				"type"     	   => $post['type'],
				"image_url"    => $updated_content_image,
				"is_active"    => $post['is_active']

			);

			$update = $this->db->update("content_image", $updateArray, array("id" => $id_content_image));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/content_image");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/content_image/edit.".$post['param']);
			}
		
	}

	function doDelete($param){
		$id_content_image = encrypt_decrypt("decrypt", $param);

		$this->db->where('id' , $id_content_image);
		$this->db->delete('content_image');
		$this->session->set_flashdata('is_success', 'Yes');
		redirect("cms/content_image");
		}

	public function get_list_content_image(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_content_image->get_list_content_image ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_content_image->get_list_content_image ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_content_image->get_list_content_image ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_content_image->get_list_content_image ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();
			$button = "";

			$button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/content_image/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/content_image/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';

			$image_rendering = '<img src="'.base_url('images/content_image/'.$value->image_url.'').'" style="width: 50%; height: 25%;">';
			if ($value->type == 1) {
				$type_image = 'home slide';
			}
			elseif ($value->type == 2) {
				$type_image = 'home banner';
			}
			elseif ($value->type == 3) {
				$type_image = 'home ads';
			}

			$rowData[] = $no++;
			$rowData[] = $image_rendering;
			$rowData[] = $type_image;
			$rowData[] = $value->created_date;
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