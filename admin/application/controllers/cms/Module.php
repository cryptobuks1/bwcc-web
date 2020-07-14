<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_module");
		$this->load->model("M_groupmodule");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Module & Submodule";
		$data['content']   = "admin/module_submodule/module/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$data['back_link'] = base_url('cms/module');
		$data['web_title'] = "Add Module";
		$data['content']   = "admin/module_submodule/module/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();
		
		$insertArray = array(
			"module_name"      	=> $post['module_name'],
			"module_order"   	=> $post['order_number'],
			"module_icon"		=> $post['module_icon'],
			"module_url" 		=> $post['module_url'],
			"isParent"   		=> $post['is_parent'],
			"module_status"     => "1",
			"isDeleted"       	=> "0",
			"created_date"     	=> date('Y-m-d H:i:s'),
			"created_by"       	=> $this->sessionData['user_id'],

		);

		$insert = $this->db->insert("app_module", $insertArray);
		if ($insert) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/module/");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/module/add/");
		}
	}

	function edit($id){
		$detailModule = $this->M_module->getModuleDetail("module_id", encrypt_decrypt('decrypt',$id));
		// debugCode($detailModule);
		$data['detailModule'] = $detailModule;
		$data['back_link']    = base_url('cms/module');
		$data['web_title']    = "Edit Module & Submodule";
		$data['content']      = "admin/module_submodule/module/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate(){
		$post     = $this->input->post();
		$module_id = encrypt_decrypt("decrypt", $post['param']);

		$updateArray = array(
			"module_name"      	=> $post['module_name'],
			"module_order"   	=> $post['order_number'],
			"module_icon"		=> $post['module_icon'],
			"module_url" 		=> $post['module_url'],
			"isParent"   		=> $post['is_parent'],
			"updated_date"     	=> date('Y-m-d H:i:s'),
			"updated_by"       	=> $this->sessionData['user_id'],
		);

		$update = $this->db->update("app_module", $updateArray, array("module_id" => $module_id));
		if ($update) {
			// ================== Update Sesion ==================//
			// Array Module
			$listModule = $this->M_groupmodule->getModuleDetail("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionModule', $listModule);

			// Array Sub Module
			$listSubmodule = $this->M_groupmodule->getSubmodule("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionSubmodule', $listSubmodule);
			//===================================================//

			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/module");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/module/edit/".$post['param']);
		}
	}

	function doDelete($param){
		$module_id    = encrypt_decrypt("decrypt", $param);

		$updateArray = array(
			"isDeleted"   => "1",
			"updated_date" => date("Y-m-d H:i:s"),
			"updated_by"   => $this->sessionData['user_id'],
		);

		$delete = $this->db->update("app_module", $updateArray, array("module_id" => $module_id));

		if ($delete) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/module");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/module");
		}
	}

	/*==================================================== DATA FOR DATATABLE ====================================================*/
	public function get_list_module(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_module->get_list_module ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_module->get_list_module ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_module->get_list_module ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_module->get_list_module ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		// $listSub = [];
		foreach( $getData->result () AS $value){
			$rowData = array();
			$encrypt_id = encrypt_decrypt('encrypt',$value->module_id);
			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$button = "";
			$button .= '
				<a href="'.base_url('cms/module/edit/'.$encrypt_id).'" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>
				<button class="btn btn-danger btn-sm" onClick="is_delete(\''.base_url('cms/module/doDelete/'.$encrypt_id).'\')" title="Delete"><i class="fa fa-trash"></i></button>
				';
			/*========================================= END BUTTON STUFF =========================================*/
			// Status Parent
			if ($value->isParent == 0) {
				$isParent = "No";

				$url = $value->module_url;
			}else{
				$isParent = "Yes";

				// Submodule By module_id
				$dataSubModule = $this->M_module->getListSubModule("as.module_id", $value->module_id);
				$listSub = [];
				foreach ($dataSubModule as $valSub) {
					$listSub[] = "*) ".$valSub->submodule_name."<br/>";
				}
				$url = 	[
							implode(" ", $listSub), "<br/><b><a href=".base_url('cms/module/listsub/'.$encrypt_id).">Sub(Add/Edit/Delete)</a></b>"
						];
			}
			// End

			$rowData[] = $no++;
			$rowData[] = $value->module_name;
			$rowData[] = $isParent;
			$rowData[] = implode("", (array)$url);

			$rowData[] = "#".$value->module_order;
			$rowData[] = $this->sessionData['name'];
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

	// ============================================================ SubModule ============================================================//
	function listsub($id){
		$dataSub = $this->M_module->getListSubModule("as.module_id", encrypt_decrypt("decrypt", $id));
		// debugCode($dataSub);
		$data['dataSubModule'] = $dataSub;
		$data['web_title'] = "Module & Submodule";
		$data['content']   = "admin/module_submodule/submodule/index";
		$this->load->view('admin/layout',$data);
	}

	function addsub($id){
		$data['dataModule'] = $this->M_module->getModuleDetail("module_id", encrypt_decrypt("decrypt", $id));
		// debugCode($data['dataModule']);
		$data['back_link'] = base_url('cms/module');
		$data['web_title'] = "Add Sub Module";
		$data['content']   = "admin/module_submodule/submodule/add";
		$this->load->view('admin/layout',$data);
	}

	function doAddSub(){
		$post = $this->input->post();
		
		$insertArray = array(
			"submodule_name"      	=> $post['submodule_name'],
			"submodule_order"   	=> $post['order_number_sub'],
			"submodule_url" 		=> $post['module_url'],
			"module_id" 			=> encrypt_decrypt("decrypt", $post['module_id']),
			"submodule_status"     	=> "1",
			"isDeleted"       		=> "0",
			"created_date"     		=> date('Y-m-d H:i:s'),
			"created_by"       		=> $this->sessionData['user_id'],

		);

		$insert = $this->db->insert("app_submodule", $insertArray);
		if ($insert) {
			// ================== Update Sesion ==================//
			// Array Module
			$listModule = $this->M_groupmodule->getModuleDetail("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionModule', $listModule);

			// Array Sub Module
			$listSubmodule = $this->M_groupmodule->getSubmodule("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionSubmodule', $listSubmodule);
			//===================================================//

			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/module/listsub/".$post["module_id"]);
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/module/addsub/".$post["module_id"]);
		}
	}

	function editsub($id){
		$detailSub = $this->M_module->getSubModuleDetail("submodule_id", encrypt_decrypt('decrypt', $id));
		// debugCode($detailSub);
		$data['detailSub'] = $detailSub;
		$data['dataModule'] = $this->M_module->getModuleDetail("module_id", $detailSub->module_id);
		// debugCode($data['dataModule']);
		$data['back_link']    = base_url('cms/module/listsub'.$id);
		$data['web_title']    = "Edit Module & Submodule";
		$data['content']      = "admin/module_submodule/submodule/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdatesub(){
		$post     = $this->input->post();
		// debugCode($post);
		$module_id = encrypt_decrypt("decrypt", $post['param']);

		$updateArray = array(
			"submodule_name"      	=> $post['submodule_name'],
			"submodule_order"   	=> $post['order_number_sub'],
			"submodule_url" 		=> $post['module_url'],
			"module_id" 			=> encrypt_decrypt("decrypt", $post['module_id']),
			"updated_date"     		=> date('Y-m-d H:i:s'),
			"updated_by"       		=> $this->sessionData['user_id'],
		);

		$update = $this->db->update("app_submodule", $updateArray, array("submodule_id" => $module_id));
		if ($update) {
			// ================== Update Sesion ==================//
			// Array Module
			$listModule = $this->M_groupmodule->getModuleDetail("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionModule', $listModule);

			// Array Sub Module
			$listSubmodule = $this->M_groupmodule->getSubmodule("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionSubmodule', $listSubmodule);
			//===================================================//

			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/module/listsub/".$post['module_id']);
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/module/edit/".$post['param']);
		}
	}

	function doDeletesub($param){
		$submodule_id    = encrypt_decrypt("decrypt", $param);

		$updateArray = array(
			"isDeleted"   => "1",
			"updated_date" => date("Y-m-d H:i:s"),
			"updated_by"   => $this->sessionData['user_id'],
		);

		$delete = $this->db->update("app_submodule", $updateArray, array("submodule_id" => $submodule_id));

		if ($delete) {
			$this->session->set_flashdata('is_success', 'Yes');
			// redirect("cms/module/");
			redirect($_SERVER['HTTP_REFERER']);
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/module/");
		}
	}

	public function test(){
		$module = $this->M_module->getModule();
		foreach ($module as $valMod) {
			print_r($valMod->module_name."<br>");
			$sub = $this->M_module->getListSubModule("as.module_id", $valMod->module_id);
			foreach ($sub as $valSub) {
				print_r("---".$valSub->submodule_name."<br>");
				// if (empty($sub)) {
				// 	print_r("");
				// }else{
				// 	print_r($sub->submodule_name."<br>");
				// }
			}
		}
		// debugCode($module);
	}
}