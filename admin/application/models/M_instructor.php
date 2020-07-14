<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_instructor extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getDetailinstructor($id){
    	$this->db->select("*");
    	$this->db->from("master_instructor");
    	$this->db->where("id", $id);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function get_list_instructor($param = array(),$method="default",$addtional=""){

        // $sql = "SELECT * FROM admin";
        $sql = "SELECT * FROM master_instructor";

        $query = $this->db->query($sql);
        return $query;
    }

    function getDetail_schedule_instructor($id , $param = array(),$method="default",$addtional="")
    {
        $this->db->select("*");
        $this->db->from("schedule_instructor");
        $this->db->where("id_instructor", $id);
        $query  = $this->db->get();
        return $query;
    }

    function information_instructor($id)
    {
        $this->db->select("*");
        $this->db->from("master_instructor");
        $this->db->where("id", $id);
        $query  = $this->db->get();
        $res = $query->row();
        return $res;
    }

}