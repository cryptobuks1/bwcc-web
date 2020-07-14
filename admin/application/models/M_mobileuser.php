<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_mobileuser extends CI_Model{
    function __construct(){
        $this->load->model("M_groupmodule");

        parent::__construct();
    }

    function getDetailUser($id){
    	$this->db->select("*");
    	$this->db->from("user");
    	$this->db->where("id", $id);
    	// $this->db->where("is_deleted", 0);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    // function checkEmailExist($email){
    // 	$this->db->select("email");
    // 	$this->db->from("admin");
    // 	$this->db->where("email", $email);
    // 	$this->db->where("is_deleted", 0);
    // 	$query	= $this->db->get();
    // 	$result = $query->row();
    // 	return $result;
    // }

    // function checkEmailByUser($user_id, $email){
    // 	$this->db->select("email");
    // 	$this->db->from("admin");
    // 	$this->db->where("email", $email);
    // 	$this->db->where("is_deleted", 0);
    // 	$this->db->where("id <>",$user_id);
    // 	$query	= $this->db->get();
    // 	$result = $query->row();
    // 	return $result;
    // }

    function get_list_user($param = array(),$method="default",$addtional=""){
		$start	= $param['start'];
		$length = $param['length'];
		
		$columns	= array(
			1 => 'ad.name',
			2 => 'ad.email',
		);
		
		// $sql = "SELECT * FROM admin";
        $sql = "SELECT * FROM user as ad";

		$where = "";
		$orderby = " ";
	
		if(!empty($param['search']['value'])){ 
			if($where != ""){
				$where.= " AND ";
			}else{
				$where.= " WHERE ";
			}
			
			$where.= " (ad.name like '%".$param['search']['value']."%' ";
			$where.= " or ad.email like '%".$param['search']['value']."%' ";
			$where.= " ) ";
		}

		if(!empty($param['order'][0]['column'])){
			$orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";        
		}else{
			$orderby.=" ORDER BY ad.created_date DESC";
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
    
    function get_total_patient($user_id){
        $this->db->select("count(*) as total");
        $this->db->from("patient");
        $this->db->where("created_by", $user_id);
    	$query = $this->db->get();
        $q_res = $query->result_array();        
        return $q_res[0]['total'];

    }
}