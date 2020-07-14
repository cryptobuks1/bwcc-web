<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_schedule extends CI_Model{
    
    public $table           = 'master_practice_schedule';
    public $id              = 'id';
    public $order           = 'DESC';
    public $order_by        = 'created_date';

    function __construct(){
        parent::__construct();
    }

    function getData(){
    	$this->db->select("*");
    	$this->db->from($this->table);
        // $this->db->where("is_deleted", 0);
        $this->db->order_by($this->order_by, $this->order);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getOneData($condition, $val){
    	$this->db->select("*");
    	$this->db->from($this->table);
    	$this->db->where($condition, $val);
    	// $this->db->where("is_deleted", 0);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }


    function get_all_schedule_by_day($date){        
        $sql = "SELECT 
        a.id as id,
        a.start_time_service as start_time,
        a.finish_time_service as finish_time,
        a.queue_number,
        b.id as poly_id,
        b.name as poly_name,
        c.id as doctor_id,
        c.name as doctor_name,
        a.date as date_time,
        a.patient_id as patient_id,
        a.is_hide
         FROM master_practice_schedule as a JOIN master_poly as b JOIN master_doctor as c 
        WHERE a.id_poly = b.id AND a.id_doctor = c.id AND a.date LIKE '%".$date."%'
        AND a.is_active=1 GROUP BY c.name, a.start_time_service ORDER BY c.name, a.start_time_service ASC";
        $query = $this->db->query($sql);
        $rows = $query->result();

        $doctors = [];
        $curr_doctor = '';

        foreach ($rows as $row) {
            if($row->doctor_name != $curr_doctor) {
                $curr_doctor = $row->doctor_name; 
                array_push($doctors, $curr_doctor);
            }
        }

        $result = [];
        foreach ($doctors as $doctor) {
            $schedules = [];
            $doctor_id = '';
            $doctor_name = '';
            $poly_id = '';
            $poly_name = '';
            $date_time = '';
            foreach ($rows as $row) { 
                if($row->doctor_name == $doctor) {
                    array_push($schedules, array(
                        'id' => $row->id,
                        'start_time' => $row->start_time,
                        'finish_time' => $row->finish_time,
                        'queue_number' => $row->queue_number,
                        'date_time' => $row->date_time,
                        'patient_id' => $row->patient_id,
                        'is_hide' => $row->is_hide,
                    ));
                    $doctor_id = $row->doctor_id;
                    $doctor_name = $row->doctor_name;
                    $poly_id = $row->poly_id;
                    $poly_name = $row->poly_name;
                    $date_time = $row->date_time;
                }
            }

            array_push($result, array(
                'doctor_id' => $doctor_id,
                'doctor_name' => $doctor_name,
                'poly_id' => $poly_id,
                'poly_name' => $poly_name,
                'date_time' => $date_time,
                'schedules' => $schedules
            ));
        }

        // echo '<pre>';
        // print_r($result);
        // echo '</pre>';
        // die();

        return $result;
    }    

    function get_count_per_day($date){
        $sql = "SELECT count(*) as total FROM master_practice_schedule WHERE date LIKE '%".$date."%' AND is_active=1";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }

    function get_count_available_per_day($date){
        $sql = "SELECT count(*) as total FROM master_practice_schedule WHERE date LIKE '%".$date."%' AND is_active=1 AND patient_id IS NOT NULL";
        $query = $this->db->query($sql);
        return $query->row()->total;
    }    

    function get_date($id){
        $sql = "SELECT date FROM master_practice_schedule WHERE id='".$id."' LIMIT 1";
        $query = $this->db->query($sql);
        return $query->row()->date;
    }

    // function get_payment_receipt($id){
    //     $default_img = "http://localhost/bwcc/mobile_api/";
    //     $this->db->select("*");
    // 	$this->db->from("master_req_queue");
    // 	$this->db->where("id", $id);
    //     $this->db->limit(1);
    // 	$query	= $this->db->get();
    // 	$result = $query->row()->payment_receipt;
    // 	return $default_img.$result;
    // }
}


