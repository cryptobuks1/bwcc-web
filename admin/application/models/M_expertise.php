<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_expertise extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getDetailexpertise($id){
    	$this->db->select("*");
    	$this->db->from("master_expertise");
    	$this->db->where("id", $id);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function get_list_expertise($param = array(),$method="default",$addtional=""){

        // $sql = "SELECT * FROM admin";
        $sql = "SELECT * FROM master_expertise";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_info_expertise($param)
    {
        $this->db->where('id', $param);
                // get schedule practice 
        $get_dataexpertise = $this->db->get('master_expertise')->row();

        return $get_dataexpertise;
    }

}