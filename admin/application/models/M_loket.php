<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_loket extends CI_Model{

    public $table           = 'master_counter';
    public $id              = 'id';
    public $order           = 'DESC';
    public $order_by        = 'created_date';


    function __construct(){
        parent::__construct();
    }

    function getData(){
    	$this->db->select("*");
    	$this->db->from($this->table);
    	$this->db->where("is_active", 1);
        $this->db->order_by($this->order_by, $this->order);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getDataOrder(){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where("is_active", 1);
        $this->db->order_by($this->order_by, "ASC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getOneData($condition, $val){
    	$this->db->select("*");
    	$this->db->from($this->table);
    	$this->db->where($condition, $val);
    	$this->db->where("is_active", 1);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function getLoketData(){
        $this->db->select("*");
        $this->db->from("admin");
        $this->db->where("access_group_id", 3);
        $this->db->where("status", 1);
        $this->db->order_by('name', 'ASC');
        $query  = $this->db->get();
        $result = $query->result_array();
        return $result;
    }
}