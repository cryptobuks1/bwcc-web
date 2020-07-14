<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_frontpage extends CI_Model{
	function __construct(){
		parent::__construct();
	}

	function getDateEventHead(){
		$sql = 'SELECT 
		DATE(event_start_date) AS date_event
		FROM `event` 
		WHERE 
		DATE(event_start_date) >= "'.date("Y-m-d").'"
		AND is_deleted = 0
		AND is_active = 1
		GROUP BY DATE(event_start_date)
		ORDER BY event_start_date ASC
		LIMIT 5;';
		$query	= $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function getListDataEventByDate($date){
		$sql = 'SELECT ev.event_id,ev.event_name, ev.event_start_date, ev.event_end_date, pc.place_name FROM `event` AS ev
		INNER JOIN place AS pc ON pc.place_id = ev.event_place_id
		WHERE DATE(ev.event_start_date) = "'.$date.'"
		AND ev.is_deleted = 0
		AND ev.is_active = 1
		ORDER BY ev.event_start_date ASC LIMIT 3';
		$query	= $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function getListEvent($page = "", $date = ""){
		if ($page == "") {
			$page = 0;
		}
		$where = "";
		if ($date <> "") {
			$where.=" AND ev.event_start_date = '".$date."'";
		}
		$sql = 'SELECT ev.event_id,ev.event_name, ev.event_start_date, ev.event_end_date, pc.place_name FROM `event` AS ev
		INNER JOIN place AS pc ON pc.place_id = ev.event_place_id
		WHERE ev.is_deleted = 0
		AND ev.is_active = 1
		AND DATE(ev.event_start_date) >= "'.date("Y-m-d").'"
		'.$where.'
		ORDER BY ev.event_start_date ASC LIMIT '.$page.',5';
		/*$sql = 'SELECT ev.event_id,ev.event_name, ev.event_start_date, ev.event_end_date, pc.place_name FROM `event` AS ev
		INNER JOIN place AS pc ON pc.place_id = ev.event_place_id
		WHERE ev.is_deleted = 0
		AND ev.is_active = 1
		
		ORDER BY ev.event_start_date ASC LIMIT '.$page.',5';*/
		$query	= $this->db->query($sql);
		$result = $query->result();
		return $result;
	}

	function getDetailEvent($id){
		$sql = 'SELECT ev.*,pc.place_name, pc.longlat FROM `event` AS ev
		INNER JOIN place AS pc ON pc.place_id = ev.event_place_id
		WHERE ev.event_id = "'.$id.'"
		AND ev.is_deleted = 0
		AND ev.is_active = 1';
		$query	= $this->db->query($sql);
		$result = $query->row();
		return $result;
	}	

	function getProfile($id){
    	$this->db->select("*");
    	$this->db->from("member");
    	$this->db->where("member_id", $id);
    	$this->db->where("is_active", 1);
    	$this->db->where("is_deleted", 0);
		$query  = $this->db->get();
		$result = $query->row();
    	return $result;
    }

    function getEventByMember($member_id){
    	$this->db->select("ev.event_name, ev.event_id");
    	$this->db->from("order AS ord");
    	$this->db->join("event AS ev","ev.event_id = ord.event_id");
    	$this->db->where("ord.member_id",$member_id);
    	$this->db->group_by("ord.event_id");
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function isUserRegisteredEvent($event_id,$member_id){
    	$this->db->select("COUNT(*) AS cnt");
    	$this->db->from("order");
    	$this->db->where("event_id",$event_id);
    	$this->db->where("member_id",$member_id);
    	$query	= $this->db->get();
    	$result = $query->row()->cnt;
    	return $result;
    }

    function getAllDateEvent(){
    	$sql = 'SELECT DATE(event_start_date) 
    	FROM `event` 
    	WHERE DATE(event_start_date) >= '.date("Y-m-d").' 
    	GROUP BY DATE(event_start_date) 
    	ORDER BY DATE(event_start_date) DESC';
    	
    }
}