<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contclass extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_class");
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
		$data['web_title'] = "class";
		$data['content']   = "admin/class/listclass";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "Add class";
		$data['content']   		= "admin/class/addclass";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();
		
		
		$insertArray = array(
				"id" => guid(),
				"class_code"     	=> $post['class_code'],
				"name"     			=> $post['name'],
				"create_date"     	=> date('Y-m-d H:i:s'),
				"created_by"     	=> $this->sessionData['user_id']

			);

			$insert = $this->db->insert("master_class", $insertArray);
			if ($insert) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/contclass");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/contclass/add");
			}

		
	}

	function edit($param){
		$id_class = encrypt_decrypt("decrypt",$param);
		$detailclass = $this->M_class->getDetailclass($id_class);

		$data['id']	= "";
		if (!empty($detailclass)) {
			$data['id']	= $param;
		}

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['groupModule']	= $getGroupModule;
		$data['detailclass'] 	= $detailclass;
		$data['web_title']  	= "Edit class";
		$data['content']    	= "admin/class/editclass";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate(){
		$post    = $this->input->post();
		$id_class = encrypt_decrypt("decrypt", $post['param']);
		$enc_phone_number = json_encode($post['phone_number']);
		
			$updateArray = array(
				"class_code"     	=> $post['class_code'],
				"name"     			=> $post['name'],
				"updated_date"     	=> date('Y-m-d H:i:s'),
				"updated_by" 		=> $this->sessionData['user_id']
			);

			$update = $this->db->update("master_class", $updateArray, array("id" => $id_class));
			if ($update) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/contclass");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/contclass/edit.".$post['param']);
			}
		
	}

	function doDelete($param){
		$id_class = encrypt_decrypt("decrypt", $param);

		$this->db->where('id' , $id_class);
		$this->db->delete('master_class');
		$this->session->set_flashdata('is_success', 'Yes');
		redirect("cms/contclass");
		}

	function show_phone_number_input(){
		$row_code 	= guid();

		$view = '
				<div id="'.$row_code.'">
				<div class="form-group row gutters">
					<label class="col-md-2 col-form-label"></label>
						<div class="col-md-10">
							<input type="number" class="form-control"  name="phone_number[]" required="">
						</div>
				</div>

				<div class="form-group row gutters">
					<div class="col-md-10">
					<label class="col-md-2 col-form-label"></label>
						<button type="button" class="btn btn-danger" title="delete" onClick="deldiv(\''.$row_code.'\')"><i class="fa fa-trash-alt"></i> Hapus Nomor</button>
					</div>
				</div>
					</div>
					';
		echo($view);
	}

	public function get_list_class(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_class->get_list_class ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_class->get_list_class ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_class->get_list_class ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_class->get_list_class ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();
			$button = "";

			$button .= '
			<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/contclass/doDelete/'.encrypt_decrypt('encrypt',$value->id)).'\')" title="Delete"><i class="fa fa-trash"></i></button>';
			$button .= '
			<a href="'.base_url('cms/contclass/edit/'.encrypt_decrypt('encrypt',$value->id)).'" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>';
			$button .= '
			<a class="btn btn-success btn-sm" href="'.base_url('cms/contclass/list_instructor_class/'.$value->id).'"> Instructor List </a>
			';
			$button .= '
			<a class="btn btn-warning btn-sm" href="'.base_url('cms/contclass/add_class_instructor/'.$value->id).'"> Add Instructor </a>
			';
			

			$rowData[] = $no++;
			$rowData[] = $value->class_code;
			$rowData[] = $value->name;
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

	function add_class_instructor($param)
	{	
		$this->db->where('id' , $param);
		$get_class_res = $this->db->get('master_class');

		if ($get_class_res->num_rows() == 0) {
			echo 'empty data ! try again';
		}
		else
		{	
			$list_instructor = $this->db->get('master_instructor');

			$getGroupModule 		= $this->M_groupmodule->getGroupModule();
			
			$data['val_instructor'] = $list_instructor->result();
			$data['get_from'] 		= $param;
			$data['groupModule']	= $getGroupModule;
			$data['web_title'] 		= "Add instructor to class";
			$data['content']   		= "admin/class/class_schedule/add_class_instructor";
			$this->load->view('admin/layout',$data);	
		}
		
	}

	function html_get_instructor()
	{
		$row_code 	= guid();

		$list_instructor = $this->db->get('master_instructor');
		$datainstructor = $list_instructor->result();

		foreach ($datainstructor as $val_datainstructor) {
			$info_instructor[] = '<option value="'.$val_datainstructor->id.'">'.$val_datainstructor->name .''.'</option>';
		}

		$view = '<div class="form-group row gutters" id="'.$row_code.'">
					<label class="col-md-2 col-form-label"></label>
					<div class="col-md-8">
						<select class="form-control selectpicker" name="instructor_id[]" data-live-search="true" required="">
							<option value="">- Pilih Dokter -</option>
							'.implode(" ", $info_instructor).'
						</select>
					</div>
					<div class="col-md-2">
						<button type="button" class="btn btn-danger" title="delete" onClick="deldiv(\''.$row_code.'\')"><i class="fa fa-trash-alt"></i> Hapus</button>
					</div>
				</div>';
		echo($view);
	}

	function html_get_schedule_instructor($id)
	{
		$row_code 	= guid();

		$this->db->where('id_instructor', $id);
		$this->db->where('quota_remain >' , 0);
		$get_schedule_ins = $this->db->get('schedule_instructor');
		$datainstructor = $get_schedule_ins->result();

		if ($get_schedule_ins->num_rows() == 0) {
			echo "tidak ada jadwal dari instructor";
		}
		else
		{
			foreach ($datainstructor as $val_datainstructor) {
			$this->db->where('id_schedule_instructor' , $val_datainstructor->id);
			$comp_datains = $this->db->get('schedule_class');
			if ($comp_datains->num_rows() > 0) {
				$check_available_schedule = '( schedule already used )';
				$stats_option = 'disabled';
			}
			else
			{
				$check_available_schedule = '';
				$stats_option = '';
			}

			$info_instructor[] = '<option '.$stats_option.' value="'.$val_datainstructor->id.'">'.$val_datainstructor->start_date.' | '.$val_datainstructor->start_time.' - '.$val_datainstructor->finish_time.' | Quota remain : '.$val_datainstructor->quota_remain.' '.$check_available_schedule.' '.'</option>';
		}

		$view = '<div class="form-group row gutters" id="'.$row_code.'">
					<label class="col-md-2 col-form-label"></label>
					<div class="col-md-8">
						<select class="form-control selectpicker" name="id_schedule_instructor" data-live-search="true" required="">
							<option value="">- Choose Schedule -</option>
							'.implode(" ", $info_instructor).'
						</select>
					</div>
					
				</div>';
		echo($view);
		}

		
	}

	function doadd_instructor_to_class($id)
	{
		$post = $this->input->post();
		// $enc_post_id_instructor = json_encode($post['instructor_id']);

		// $dec_datains = json_decode($enc_post_id_instructor, true);

			$insert_data = array(
				"id" => guid(),
				"id_class" => $id,
				"id_instructor" => $post['instructor_id'],
				"id_schedule_instructor" => $post['id_schedule_instructor']
			);

		$ins_data = $this->db->insert('schedule_class', $insert_data);

			if ($ins_data) {
				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/contclass");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/contclass/add");
			}


	}

	function list_instructor_class($id)
	{

		$getGroupModule 		= $this->M_groupmodule->getGroupModule();

		$data['valclass']       = $id;
		$data['groupModule']	= $getGroupModule;
		$data['web_title'] 		= "List instructors";
		$data['content']   		= "admin/class/class_schedule/list_instructor_class";
		$this->load->view('admin/layout',$data);
	}

	function delete_ins_class($id, $id2)
	{
		$this->db->where('id', $id);
		$get_sch_c = $this->db->get('schedule_class');

		if ($get_sch_c->num_rows() == 0) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/contclass/list_instructor_class/".$id2);
		}
		else
		{
			$this->db->where('id', $id);
			$this->db->delete('schedule_class');

			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/contclass/list_instructor_class/".$id2);
		}

	}

	function instuctor_list_from_class($id)
	{

		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_class->get_schedule_class ($id, $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_class->get_schedule_class ($id, $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_class->get_schedule_class ($id, $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_class->get_schedule_class ($id, $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){

			$rowData = array();
			$button = "";

			$button .= '
				<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#delete_data_'.$value->id.'_'.$id.'"> Delete Instructor</button>

				<div class="modal fade" id="delete_data_'.$value->id.'_'.$id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
									
										Are your sure want to delete instructor from class ?

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
										<a type="button" class="btn btn-danger" href="'.base_url('cms/contclass/delete_ins_class/'.$value->id.'/'.$id.' ').'">Delete</a>
									</form>
									</div>
								</div>
							</div>
						</div>

			';
			

			$rowData[] = $no++;
			$rowData[] = $value->ins_name;
			$rowData[] = $value->gender;
			$rowData[] = $value->expertise_name;
			$rowData[] = ''.$value->start_date.' | '.$value->start_time.' - '.$value->finish_time.' ';
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