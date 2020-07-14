<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_groupmodule extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getGroupModule(){
    	$this->db->select("*");
    	$this->db->from("app_access_group");
    	// $this->db->where("access_group_status", 1);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getGroupModuleDetail($condition, $val){
    	$this->db->select("*");
    	$this->db->from("app_access_group");
    	$this->db->where($condition, $val);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

   // =================================================== Access Group Module ================================================== //
    function getModuleDetail($condition, $val){
        $this->db->select("gm.*, am.*");
        $this->db->from("app_access_group_moduldetail gm");
        $this->db->join("app_module am","gm.access_module_id = am.module_id");
        $this->db->where($condition, $val);
        $this->db->order_by("am.module_order", "asc");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }    

	function getModuleDetailByGroup($condition, $val, $module_id){
    	$this->db->select("gm.*, am.*");
    	$this->db->from("app_access_group_moduldetail gm");
    	$this->db->join("app_module am","gm.access_module_id = am.module_id");
    	$this->db->where($condition, $val);
    	$this->db->where("gm.access_module_id", $module_id);
        $this->db->order_by("am.module_order", "asc");
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }    
   // =========================================================== End ========================================================= //

    // =================================================== Access Group SubModule ================================================== //
    function getSubmodule($condition, $val){
        $this->db->select("gs.*, as.*");
        $this->db->from("app_access_group_submodule gs");
        $this->db->join("app_submodule as","gs.access_submodule_id = as.submodule_id");
        $this->db->where($condition, $val);
        $this->db->order_by("as.submodule_order", "asc");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }    

	function getSubmoduleByGroup($condition, $val, $submodule_id){
    	$this->db->select("gs.*, as.*");
    	$this->db->from("app_access_group_submodule gs");
    	$this->db->join("app_submodule as","gs.access_submodule_id = as.submodule_id");
    	$this->db->where($condition, $val);
    	$this->db->where("access_submodule_id", $submodule_id);
        $this->db->order_by("as.submodule_order", "asc");
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }    
   // =========================================================== End ========================================================= //
}