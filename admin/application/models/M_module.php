<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_module extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getModule(){
    	$this->db->select("*");
    	$this->db->from("app_module");
    	$this->db->where("isDeleted", 0);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getModuleDetail($where, $id){
    	$this->db->select("*");
    	$this->db->from("app_module");
    	$this->db->where($where, $id);
    	$this->db->where("isDeleted", 0);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

  //   function getPackageDetail($id){
  //   	$this->db->select("*");
  //   	$this->db->from("event_package");
  //   	$this->db->where("event_package_id",$id);
  //   	$this->db->where("is_deleted",0);
		// $query  = $this->db->get();
		// $result = $query->row();
  //   	return $result;
  //   }

    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/

    function get_list_module($param = array(),$method="default",$addtional=""){
		$start	= $param['start'];
		$length = $param['length'];
		
		$columns	= array(
			1 => 'am.module_name',
			2 => 'am.is_parent',
			3 => 'am.module_url',
			4 => 'am.module_order',
		);

		// $sql = "SELECT mb.*, ap.province_name FROM member AS mb
		// 		LEFT JOIN app_province AS ap on mb.province_id = ap.province_id
		// 		LEFT JOIN app_city AS ac on mb.city_id = ac.city_id";

		$sql = "SELECT * FROM app_module AS am";

		$where = "";
		$orderby = " ";
		
		$where.=" WHERE am.isDeleted <> '1'";
		if(!empty($param['search']['value'])){ 
			if($where != ""){
				$where.= " AND ";
			}else{
				$where.= " WHERE ";
			}
			
			$where.= " (am.module_name like '%".$param['search']['value']."%' ";
			$where.= " or am.module_url like '%".$param['search']['value']."%' ";
			$where.= " ) ";
		}

		if(!empty($param['order'][0]['column'])){
			$orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";        
		}else{
			$orderby.=" ORDER BY am.module_order DESC";
		}

        if($addtional == ""){
			if($param['length'] == '-1'){
				$orderby.="";
			}else{
				$orderby.="  LIMIT ".$start." ,".$length." ";
			}
        } 

        $sql.=$where.$orderby;  
        $query = $this->db->query($sql);
        return $query;
	}
	// ================================= SubModule ============================//
	 function getListSubModule($condition, $val){
    	$this->db->select("as.*, am.module_name");
    	$this->db->from("app_submodule as");
    	$this->db->join("app_module am","as.module_id = am.module_id");
    	$this->db->where($condition, $val);
    	$this->db->where("as.isDeleted", 0);
    	$this->db->order_by("as.submodule_order", "asc");
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getSubModuleDetail($condition, $val){
    	$this->db->select("as.*, am.module_name");
    	$this->db->from("app_submodule as");
    	$this->db->join("app_module am","as.module_id = am.module_id");
    	$this->db->where($condition, $val);
    	$this->db->where("as.isDeleted", 0);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }


    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/

    function get_list_submodule($param = array(),$method="default",$addtional=""){
		$start	= $param['start'];
		$length = $param['length'];
		
		$columns	= array(
			1 => 'am.submodule_name',
			// 2 => 'am.submodule',
			// 3 => 'am.member_email',
			// 4 => 'am.member_address',
		);

		$sql = "SELECT as.*, am.module_name FROM app_submodule AS as
				INNER JOIN app_module AS am on as.module_id = am.module_id";

		// $sql = "SELECT * FROM app_module AS am";

		$where = "";
		$orderby = " ";
		
		$where.=" WHERE am.isDeleted <> '1'";
		if(!empty($param['search']['value'])){ 
			if($where != ""){
				$where.= " AND ";
			}else{
				$where.= " WHERE ";
			}
			
			$where.= " (as.submodule__name like '%".$param['search']['value']."%' ";
			$where.= " or am.module_name like '%".$param['search']['value']."%' ";
			$where.= " ) ";
		}

		if(!empty($param['order'][0]['column'])){
			$orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";        
		}else{
			$orderby.=" ORDER BY as.created_date DESC";
		}

        if($addtional == ""){
			if($param['length'] == '-1'){
				$orderby.="";
			}else{
				$orderby.="  LIMIT ".$start." ,".$length." ";
			}
        } 

        $sql.=$where.$orderby;  
        $query = $this->db->query($sql);
        return $query;
	}
	// ============================================================ End =================================================================//
}