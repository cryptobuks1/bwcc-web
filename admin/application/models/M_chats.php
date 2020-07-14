<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_chats extends CI_Model{
    
    public $table           = 'chat';
    public $table_chat_row  = 'chat_row';
    public $id              = 'id';
    public $order           = 'DESC';
    public $order_by        = 'timestamp';

    function __construct(){
        parent::__construct();
    }

    function getData(){
    	$this->db->select("a.*, b.name as name_user");
    	$this->db->from($this->table." a");
        $this->db->join("user b", "a.user_id = b.id");
        $this->db->order_by($this->order_by, $this->order);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getOneData($condition, $val){
    	$this->db->select("a.*, b.name as name_user");
    	$this->db->from($this->table." a");
        $this->db->join("user b", "a.user_id = b.id");
    	$this->db->where("a.".$condition, $val);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function getChatsByCondition($condition, $val){
        $this->db->select("a.*, c.name as name_user");
        $this->db->from($this->table_chat_row." a");
        $this->db->join("chat b", "a.chat_id = b.id");
        $this->db->join("user c", "b.user_id = c.id");
        $this->db->order_by($this->order_by, $this->order);
        $this->db->where("a.".$condition, $val);
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }
}