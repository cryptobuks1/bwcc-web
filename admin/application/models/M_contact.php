<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_contact extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getDetailContact($id){
    	$this->db->select("*");
    	$this->db->from("contact");
    	$this->db->where("id", $id);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function checkEmailExist($email){
    	$this->db->select("email");
    	$this->db->from("admin");
    	$this->db->where("email", $email);
    	$this->db->where("is_deleted", 0);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function checkEmailByUser($user_id, $email){
    	$this->db->select("email");
    	$this->db->from("admin");
    	$this->db->where("email", $email);
    	$this->db->where("is_deleted", 0);
    	$this->db->where("id <>",$user_id);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function get_list_contact($param = array(),$method="default",$addtional=""){

        // $sql = "SELECT * FROM admin";
        $sql = "SELECT * FROM contact";

        $query = $this->db->query($sql);
        return $query;
    }
}