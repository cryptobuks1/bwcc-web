<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_content_image extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getDetailContent_image($id){
    	$this->db->select("*");
    	$this->db->from("content_image");
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

    function get_list_content_image($param = array(),$method="default",$addtional=""){

        // $sql = "SELECT * FROM admin";
        $sql = "SELECT * FROM content_image";

        $query = $this->db->query($sql);
        return $query;
    }
}