<?php
defined('BASEPATH') OR exit('No direct script access allowed');

Class Instructor extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_instructor");
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
		$data['web_title'] = "instructor";
		$data['content']   = "admin/instructor/listinstructor";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();
		// get expertise
		$get_expertise = $this->db->get('master_expertise');
		$data['list_expertise'] = $get_expertise->result();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add instructor";
		$data['content']   		= "admin/instructor/addinstructor";
		$this->load->view('admin/layout',$data);
	}

	function add_schedule_instructor($id)
	{	
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$this->db->where('id', $id);
		$get_instructor = $this->db->get('master_instructor');

		if ($get_instructor->num_rows() == 0) {
			echo "data empty";
		}
		else
		{	
			$data['sendto'] 		= $id;
			$data['groupModule']	= $getGroupModule;
			$data['web_title'] 		= "Add instructor schedule";
			$data['content']   		= "admin/instructor/schedule_instructor/add_schedule_instructor";
			$this->load->view('admin/layout',$data);
		}

	}

	function create_instructor_schedule($id)
	{
		$post = $this->input->post();
		$get_date_start = date('Y-m-d' , strtotime($post['start_date']));
		
		$insertArray = array(

				"id_instructor"     => $id,
				"start_time"   		=> $post['start_time'],
				"finish_time" 		=> $post['finish_time'],
				"start_date"    	=> $get_date_start,
				"quota"     		=> $post['quota'],
				"quota_remain"      => $post['quota']

			);

			$insert = $this->db->insert("schedule_instructor", $insertArray);
			if ($insert) {
				$arr_ins_perm_quota = array(
					"id_instructor" => $id,
					"permanent_quota" => $post['quota'],
					"created_date" => date('Y-m-d H:i:s')
				);

				$this->db->insert('quota_instructor', $arr_ins_perm_quota);

				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/instructor");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/instructor/add");
			}
	}

	function view_schedule_instructor($id)
	{	
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$this->db->where('id_instructor', $id);
		$get_instructor = $this->db->get('schedule_instructor');

		if ($get_instructor->num_rows() == 0) {
			$data['sendto'] 		= $id;
			$data['groupModule']	= $getGroupModule;
			$data['web_title'] 		= "List Schedule Instructor";
			$data['content']   		= "admin/instructor/schedule_instructor/view_schedule_instructor";
			$this->load->view('admin/layout',$data);
		}
		else
		{	
			$data['sendto'] 		= $id;
			$data['groupModule']	= $getGroupModule;
			$data['web_title'] 		= "List Schedule Instructor";
			$data['content']   		= "admin/instructor/schedule_instructor/view_schedule_instructor";
			$this->load->view('admin/layout',$data);
		}

	}


	function get_schedule_instructor($id)
	{
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_instructor->getDetail_schedule_instructor ($id, $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_instructor->getDetail_schedule_instructor ($id, $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_instructor->getDetail_schedule_instructor ($id, $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_instructor->getDetail_schedule_instructor ($id, $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){

			$rowData = array();
			$button = "";

			$button .= '<a type="button" class="btn btn-primary" href="'.base_url('cms/instructor/edit_schedule_instructor/'.$value->id).'"><i class="fa fa-edit"></i></a>
						<a type="button" class="btn btn-warning" data-toggle="modal" data-target="#delete_schedule_i_'.$value->id.'"><i class="fa fa-trash"></i></a>


						<div class="modal fade" id="delete_schedule_i_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" style="display: none;">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										Are you sure want to delete schedule instructor ? 
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
										<a type="button" class="btn btn-primary" href="'.base_url('cms/instructor/delete_schedule_instructor/'.$value->id.'/'.$value->id_instructor.'').'">Delete Schedule</a>
									</div>
								</div>
							</div>
						</div>
			';
			

			$rowData[] = $no++;
			$rowData[] = $value->start_date;
			$rowData[] = $value->start_time;
			$rowData[] = $value->finish_time;
			$rowData[] = $value->quota;
			$rowData[] = $value->quota_remain;
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


	function doAdd(){

		$post = $this->input->post();
		
		
		$insertArray = array(
				"id" => guid(),
				"id_expertise"    		=> $post['id_expertise'],
				"name"   			 	=> $post['name_instructor'],
				"gender" 				=> $post['gender'],
				"create_date"     		=> date('Y-m-d H:i:s'),
				"created_by"     		=> $this->sessionData['user_id']

			);

			$insert = $this->db->insert("master_instructor", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/instructor");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/instructor/add");
			}
		
	}

	function edit($param){
		$id_instructor = encrypt_decrypt("decrypt",$param);
		$detailinstructor = $this->M_instructor->getDetailinstructor($id_instructor);

		$data['id']	= "";
		if (!empty($detailinstructor)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();
		$get_expertise = $this->db->get('master_expertise');
		$data['list_expertise'] = $get_expertise->result();

		$data['groupModule']	= $getGroupModule;
		$data['detailinstructor'] 	= $detailinstructor;
		$data['web_title']  	= "Edit instructor";
		$data['content']    	= "admin/instructor/editinstructor";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate(){
		$post    = $this->input->post();
		$id_instructor = encrypt_decrypt("decrypt", $post['param']);
		
			$updateArray = array(
				"id_expertise"    		=> $post['id_expertise'],
				"name"   			 	=> $post['name_instructor'],
				"gender" 				=> $post['gender'],
				"updated_date"     	=> date('Y-m-d H:i:s'),
				"updated_by" 		=> $this->sessionData['user_id']
			);

			$update = $this->db->update("master_instructor", $updateArray, array("id" => $id_instructor));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/instructor");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/instructor/edit.".$post['param']);
			}
		
	}

	function doDelete($param){
		$id_instructor = encrypt_decrypt("decrypt", $param);

		$this->db->where('id' , $id_instructor);
		$this->db->delete('master_instructor');
		$this->session->set_flashdata('is_success', 'Yes');
		redirect("cms/instructor");
		}


		function edit_schedule_instructor($id)
		{
			// echo "mantap";
			$this->db->where('id' , $id);
			$dataedit = $this->db->get('schedule_instructor');

			if ($dataedit->num_rows() == 0) {
				redirect("cms/instructor");
			}
			else
			{
				$getGroupModule 		= $this->M_groupmodule->getGroupModule();

				$getGroupModule 		= $this->M_groupmodule->getGroupModule();
				// get expertise
				$get_expertise = $this->db->get('master_expertise');
				$data['dataedit'] = $dataedit->row();

				$data['groupModule']	= $getGroupModule;
				$data['web_title'] 		= "Edit instructor";
				$data['content']   		= "admin/instructor/schedule_instructor/edit_schedule_instructor";
				$this->load->view('admin/layout',$data);
			}


		}

		function sub_edit_schedule_instructor($id)
		{
			$this->db->where('id' , $id);
			$dataedit = $this->db->get('schedule_instructor');

			if ($dataedit->num_rows() == 0) {
				redirect("cms/instructor");
			}
			else
			{	

				$post = $this->input->post();
				$get_date_start = date('Y-m-d' , strtotime($post['start_date']));
				// get quota previous
				$this->db->where("id", $id);
				$dataget = $this->db->get('schedule_instructor')->row();

				if ($post['quota_choose'] == 1) {
					$quota_normal = $post['quota'] + $dataget->quota;
					$remain_quota = $post['quota'] + $dataget->quota_remain;
				}
				elseif ($post['quota_choose'] == 2) {
					$quota_normal = $dataget->quota - $post['quota'];
					$remain_quota = $dataget->quota_remain - $post['quota'];
				}

				if ($quota_normal < 0 || $remain_quota < 0) {
					$this->session->set_flashdata('warning_quota', 'Quota / Quota Remain must more than 0');
					redirect("cms/instructor/edit_schedule_instructor/".$dataget->id);
				}
				else
				{
					$editdata_new = array(
					"start_time"   		=> $post['start_time'],
					"finish_time" 		=> $post['finish_time'],
					"start_date"    	=> $get_date_start,
					"quota"     		=> $quota_normal,
					"quota_remain"      => $remain_quota
					);

					$run_edit = $this->db->update('schedule_instructor', $editdata_new , array("id" => $id));

					if ($run_edit) {
						$this->session->set_flashdata('is_success', 'Yes');
						redirect("cms/instructor/view_schedule_instructor/".$dataget->id_instructor);
					}
					else
					{
						redirect("cms/instructor");
					}
				}
				
			}
		}

		function delete_schedule_instructor($id, $id2)
		{
			$this->db->where('id' , $id);
			$dataedit = $this->db->get('schedule_instructor');

			if ($dataedit->num_rows() == 0) {
				redirect("cms/instructor");
			}
			else
			{	

				$this->db->where('id' , $id);
				$run_delete = $this->db->delete('schedule_instructor');

				if ($run_delete) {
					$this->session->set_flashdata('is_success', 'Yes');
					redirect("cms/instructor/view_schedule_instructor/".$id2);
					redirect("cms/instructor");
				}
				else
				{
					redirect("cms/instructor");
				}
			}
		}


	public function get_list_instructor(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_instructor->get_list_instructor ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_instructor->get_list_instructor ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_instructor->get_list_instructor ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_instructor->get_list_instructor ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$get_expertise_info = $this->M_expertise->get_info_expertise($value->id_expertise);

			$rowData = array();
			$button = "";

			$button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/instructor/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/instructor/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';

			$button .= '
			<a class="btn btn-success btn-sm" href="'.base_url('cms/instructor/view_schedule_instructor/'.$value->id).'">View Schedule</a>
			';

			$button .= '
			<a class="btn btn-warning btn-sm" href="'.base_url('cms/instructor/add_schedule_instructor/'.$value->id).'">Add Schedule Instructor</a>
			';
			

			$rowData[] = $no++;
			$rowData[] = $value->name;
			$rowData[] = $value->gender;
			$rowData[] = $get_expertise_info->expertise_name;
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