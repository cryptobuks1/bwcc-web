<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupModule extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_groupmodule");
		$this->load->model("M_module");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$dataGroup = $this->M_groupmodule->getGroupModule();

		$data['listData'] 	= $dataGroup;
		$data['web_title'] 	= "Group Module";
		$data['content']   	= "admin/group_module/index";
		$this->load->view('admin/layout',$data);
	}

	function add(){
		$data['back_link'] = base_url('cms/groupmodule');
		$data['web_title'] = "Add Group Module";
		$data['content']   = "admin/group_module/add";
		$this->load->view('admin/layout',$data);
	}

	function doAdd(){
		$post = $this->input->post();

		// Insert to app_access_group
		$insertAccessGroup = array(
			"access_group_name"      	=> $post['group_name'],
			"access_group_status" 		=> "1",
			"created_date"     			=> date('Y-m-d H:i:s'),
			"created_by"       			=> $this->sessionData['user_id']

		);

		$group 		= $this->db->insert("app_access_group", $insertAccessGroup);
		$group_id 	= $this->db->insert_id();

		for ($modul=0; $modul < count($post['module_name']); $modul++) { 

			// Insert to app_access_group_module
			$groupModule = [
				"access_group_id"	=> $group_id,
				"access_module_id"	=> $post['module_name'][$modul]
			];

			$this->db->insert("app_access_group_moduldetail", $groupModule);
		}

		for ($sub=0; $sub < count($post['submodule_name']); $sub++) {
			// Insert to app_access_group_Submodule
			$groupSubodule = [
				"access_group_id"		=> $group_id,
				"access_submodule_id"	=> $post['submodule_name'][$sub]
			];

			$insert = $this->db->insert("app_access_group_submodule", $groupSubodule);


		}


		// if ($insert) {
			// ================== Update Sesion ==================//
			// Array Module
			$listModule = $this->M_groupmodule->getModuleDetail("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionModule', $listModule);

			// Array Sub Module
			$listSubmodule = $this->M_groupmodule->getSubmodule("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionSubmodule', $listSubmodule);
			//===================================================//
			
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/groupmodule/");
		// }else{
		// 	$this->session->set_flashdata('is_success', 'No');
		// 	redirect("cms/groupmodule/add/");
		// }
	}

	function edit($id){
		$detailGroup 				= $this->M_groupmodule->getGroupModuleDetail("access_group_id", $id);

		$data['detailGroup'] 		= $detailGroup;
		$data['back_link']    		= base_url('cms/groupmodule');
		$data['web_title']    		= "Edit Module & Submodule";
		$data['content']      		= "admin/group_module/edit";
		$this->load->view('admin/layout',$data);
	}

	function doUpdate($id){
		$post     = $this->input->post();
		// debugCode($post);
		$updateArray = array(
			"access_group_name"      	=> $post['group_name'],
			"updated_date"     			=> date('Y-m-d H:i:s'),
			"updated_by"       			=> $this->sessionData['user_id']
		);

		$this->db->update("app_access_group", $updateArray, array("access_group_id" => $id));


		// Insert or Update to app_access_group_module
		$this->db->delete("app_access_group_moduldetail", array("access_group_id" => $id));
		for ($modul=0; $modul < count($post['module_name']); $modul++) { 
			
			$groupModule = [
				"access_group_id"	=> $id,
				"access_module_id"	=> $post['module_name'][$modul]
			];

			
			$update = $this->db->insert("app_access_group_moduldetail", $groupModule);
		}

		$this->db->delete("app_access_group_submodule", array("access_group_id" => $id));
		for ($sub=0; $sub < count($post['submodule_name']); $sub++) {
			// Insert to app_access_group_Submodule
			$groupSubodule = [
				"access_group_id"		=> $id,
				"access_submodule_id"	=> $post['submodule_name'][$sub]
			];

			$update = $this->db->insert("app_access_group_submodule", $groupSubodule);


		}


		// if ($update) {
			// ================== Update Sesion ==================//
			// Array Module
			$listModule = $this->M_groupmodule->getModuleDetail("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionModule', $listModule);

			// Array Sub Module
			$listSubmodule = $this->M_groupmodule->getSubmodule("access_group_id", $this->sessionData['access_group_id']);
			$this->session->set_userdata('sessionSubmodule', $listSubmodule);
			
			$dataModule = $this->getmoduleByAccesGroup($this->sessionData['access_group_id']);
			foreach ($dataModule as $key => $value) {
				$dataSub = $this->getsubmoduleByAccessGroup($this->sessionData['access_group_id'], $value->module_id);
				$menu[] = array(
					"module_name" => $value->module_name,
					"module_url"  => $value->module_url,
					"module_icon" => $value->module_icon,
					"isParent"    => $value->isParent,
					"sub"         => (array)$dataSub
				);
			}
			$this->session->set_userdata('menusession',$menu);
			//===================================================//
			

			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/groupmodule");
		// }else{
		// 	$this->session->set_flashdata('is_success', 'No');
		// 	redirect("cms/groupmodule/edit/".$id);
		// }
	}

	function deactive($id){
		$updateArray = array(
			"access_group_status"   => "0",
			"updated_date" 			=> date("Y-m-d H:i:s"),
			"updated_by"   			=> $this->sessionData['user_id'],
		);

		$update = $this->db->update("app_access_group", $updateArray, array("access_group_id" => $id));

		if ($update) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/groupmodule");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/groupmodule");
		}
	}

	function active($id){
		$updateArray = array(
			"access_group_status"   => "1",
			"updated_date" 			=> date("Y-m-d H:i:s"),
			"updated_by"   			=> $this->sessionData['user_id'],
		);

		$update = $this->db->update("app_access_group", $updateArray, array("access_group_id" => $id));

		if ($update) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("cms/groupmodule");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("cms/groupmodule");
		}
	}

	function getmoduleByAccesGroup($acc_id){
    	$this->db->select("am.module_id, am.module_name, am.module_url, am.isParent, am.module_icon");
    	$this->db->from("app_access_group_moduldetail AS agm");
    	$this->db->join("app_module AS am","am.module_id = agm.access_module_id");
    	$this->db->where("access_group_id",$acc_id);
    	$this->db->where("am.module_status",1);
    	$this->db->where("am.isDeleted",0);
    	$this->db->order_by("module_order","ASC");
		$query  = $this->db->get();
		$result = $query->result();
    	return $result;
    }

    function getsubmoduleByAccessGroup($acc_id, $module_id){
    	$this->db->select("asm.submodule_id, asm.submodule_name, asm.submodule_url");
    	$this->db->from("app_access_group_submodule AS ags");
    	$this->db->join("app_submodule AS asm","asm.submodule_id = ags.access_submodule_id");
    	$this->db->join("app_module AS am","am.module_id = asm.module_id");
    	$this->db->where("ags.access_group_id",$acc_id);
    	$this->db->where("asm.module_id",$module_id);
    	$this->db->where("asm.submodule_status",1);
    	$this->db->where("asm.isDeleted",0);
    	$this->db->order_by("asm.submodule_order","ASC");
		$query  = $this->db->get();
		$result = $query->result_array();
    	return $result;
    }

}