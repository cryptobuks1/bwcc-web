<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_privacy extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getDetailPrivacy($id){
    	$this->db->select("*");
    	$this->db->from("privacy_policy");
    	$this->db->where("id", $id);
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

    function get_list_privacy($param = array(),$method="default",$addtional=""){

        // $sql = "SELECT * FROM admin";
        $sql = "SELECT * FROM privacy_policy";

        $query = $this->db->query($sql);
        return $query;
    }
}