<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_contact");
		$this->load->model("M_groupmodule");
		$this->load->library('user_agent');
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Contact";
		$data['content']   = "admin/contact/listcontact";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add Contact";
		$data['content']   		= "admin/contact/addcontact";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		$enc_phone_number = json_encode($post['phone_number']);
		
		$insertArray = array(
				"alamat_klinik"     => $post['alamat_klinik'],
				"email"          	=> $post['email'],
				"phone_number"      => $enc_phone_number,
				"whatsapp_number"          => $post['whatsapp_number'],
				"facebook"          => $post['facebook'],
				"instagram"         => $post['instagram'],
				"youtube"          	=> $post['youtube'],
				"twitter"          	=> $post['twitter'],
				"facebook_name"          	=> $post['facebook_name'],
				"instagram_name"          	=> $post['instagram_name'],
				"youtube_name"          	=> $post['youtube_name'],
				"twitter_name"          	=> $post['twitter_name']
			);

			$insert = $this->db->insert("contact", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/contact");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/contact/add");
			}

		
	}

	function edit($param){
		$id_contact = encrypt_decrypt("decrypt",$param);
		$detailContact = $this->M_contact->getDetailContact($id_contact);

		$data['id']	= "";
		if (!empty($detailContact)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['detailContact'] 	= $detailContact;
		$data['web_title']  	= "Edit Contact";
		$data['content']    	= "admin/contact/editcontact";
		$this->load->view('admin/layout',$data);
	}

	function show_phone_number_input()
	{
		$row_code 	= guid();

		$view = '<div class="form-group row gutters" id="'.$row_code.'">
					<label class="col-md-2 col-form-label"></label>
					<div class="col-md-8">
						<input type="number" class="form-control"  name="phone_number[]" required="">
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-danger" title="delete" onClick="deldiv(\''.$row_code.'\')"><i class="fa fa-trash-alt"></i> Hapus</button>
					</div>
				</div>';
		echo($view);
	}

	function doUpdate(){
		$post    = $this->input->post();
		$id_contact = encrypt_decrypt("decrypt", $post['param']);
		$enc_phone_number = json_encode($post['phone_number']);
		
			$updateArray = array(
				"alamat_klinik"     => $post['alamat_klinik'],
				"email"          	=> $post['email'],
				"phone_number"      => $enc_phone_number,
				"whatsapp_number"          => $post['whatsapp_number'],
				"facebook"          => $post['facebook'],
				"instagram"         => $post['instagram'],
				"youtube"          	=> $post['youtube'],
				"twitter"          	=> $post['twitter'],
				"facebook_name"          	=> $post['facebook_name'],
				"instagram_name"          	=> $post['instagram_name'],
				"youtube_name"          	=> $post['youtube_name'],
				"twitter_name"          	=> $post['twitter_name']

			);

			$update = $this->db->update("contact", $updateArray, array("id" => $id_contact));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/contact");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/contact/edit.".$post['param']);
			}
		
	}

	function doDelete($param){
		$id_contact = encrypt_decrypt("decrypt", $param);

		$this->db->where('id' , $id_contact);
		$this->db->delete('contact');
		$this->session->set_flashdata('is_success', 'Yes');
		redirect("cms/contact");
		}

	public function get_list_contact(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_contact->get_list_contact ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_contact->get_list_contact ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_contact->get_list_contact ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_contact->get_list_contact ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();
			$button = "";

			$button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/contact/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/contact/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';
			

			$rowData[] = $no++;
			$rowData[] = $value->alamat_klinik;
			$rowData[] = $value->email;
			$rowData[] = $value->phone_number;
			$rowData[] = $value->whatsapp_number;
			$rowData[] = $value->facebook_name;
			$rowData[] = $value->instagram_name;
			$rowData[] = $value->youtube_name;
			$rowData[] = $value->twitter_name;
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