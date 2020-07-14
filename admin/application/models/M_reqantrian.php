<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_reqantrian extends CI_Model{
    
    public $table           = 'master_req_queue';
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

    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/
    function get_list_req_antrian($param = array(),$method="default",$addtional=""){


        $start  = $param['start'];
        $length = $param['length'];
        
        $columns    = array(
            1 => 'e.nama',
            2 => 'd.name',
            3 => 'a.unix_timestamp',
            4 => 'b.date',
            5 => 'c.name',
            6 => 'e.jenis_pembayaran'
        );
        
        // $sql = "SELECT * FROM admin";
        // $sql = "SELECT a.id as booking_id, 
        //         b.queue_number,
        //         b.id as schedule_id, 
        //         b.date as s_date,
        //         b.start_time_service as s_time_start, 
        //         b.finish_time_service as s_time_finish, 
        //         a.unix_timestamp as req_time, 
        //         c.name as poly_name, 
        //         d.name as doctor_name, 
        //         e.nama as patient_name, 
        //         e.jenis_pembayaran as payment_method
        //         FROM `master_req_queue` as a 
        //         INNER JOIN master_practice_schedule as b
        //         ON a.id_schedule_practice = b.id
        //         INNER JOIN master_poly as c 
        //         ON b.id_poly = c.id
        //         INNER JOIN master_doctor as d 
        //         ON b.id_doctor = d.id 
        //         INNER JOIN patient as e 
        //         ON b.patient_id = e.id
        //         WHERE b.patient_id IS NOT NULL";

        $sql = "SELECT a.id as booking_id, 
                b.queue_number,
                b.id as schedule_id, 
                b.date as s_date,
                b.start_time_service as s_time_start, 
                b.finish_time_service as s_time_finish, 
                a.unix_timestamp as req_time, 
                c.name as poly_name, 
                d.name as doctor_name, 
                e.nama as patient_name, 
                e.jenis_pembayaran as payment_method
                FROM `master_req_queue` as a 
                INNER JOIN master_practice_schedule as b
                ON a.id_schedule_practice = b.id
                INNER JOIN master_poly as c 
                ON b.id_poly = c.id
                INNER JOIN master_doctor as d 
                ON b.id_doctor = d.id 
                LEFT JOIN patient as e 
                ON a.patient_id = e.id WHERE b.patient_id IS NOT NULL";

        $where = "";
        $orderby = " ";
        
        // $where.=" WHERE ad.is_deleted <> '1'";
        if(!empty($param['search']['value'])){ 
            if($where != ""){
                $where.= " AND ";
            }else{
                $where.= " AND ";
            }
            
            $where.= " e.nama like '%".$param['search']['value']."%' ";
            $where.= " or c.name like '%".$param['search']['value']."%' ";
            $where.= " or d.name like '%".$param['search']['value']."%' ";
            $where.= " or e.jenis_pembayaran like '%".$param['search']['value']."%' ";
            $where.= "  ";
        }

        if(!empty($param['order'][0]['column'])){
            $orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";        
        }else{
            $orderby.=" ORDER BY a.view_seq DESC, a.unix_timestamp DESC";
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

    function get_last_status($req_id){
        $this->db->select("*");
    	$this->db->from("master_req_queue_status");
    	$this->db->where("req_id", $req_id);
        $this->db->order_by("time, kode", "DESC");
        $this->db->limit(1);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function get_all_status($req_id){
        $this->db->select("*");
    	$this->db->from("master_req_queue_status");
    	$this->db->where("req_id", $req_id);
        $this->db->order_by("time, kode", "DESC");
    	$query	= $this->db->get();
    	$result = $query->result_array();
    	return $result;
    }    

    function get_payment_receipt($id){
        $default_img = "https://bwcc.inovasialfatih.com/api/";
        $this->db->select("*");
    	$this->db->from("master_req_queue");
    	$this->db->where("id", $id);
        $this->db->limit(1);
    	$query	= $this->db->get();
    	$result = $query->row()->payment_receipt;
    	return $default_img.$result;
    }


    function search_result_by_date($get_date , $param = array(),$method="default",$addtional="")
    {

        $start  = $param['start'];
        $length = $param['length'];         


        $columns    = array(
            0 => 'a.created_date',
            1 => 'a.no_rm',
            2 => 'a.name',
            3 => 'c.name',
            4 => 'a.tanggal',
            5 => 'a.bpjs_id',
            6 => 'a.created_date',
            7 => 'a.status',
        );     

        $sql = 'SELECT a.id as booking_id, b.id as schedule_id, b.date as s_date, 
                    b.start_time_service as s_time_start, b.finish_time_service as s_time_finish, a.unix_timestamp as req_time, a.created_date AS create_booking,
                    c.name as poly_name, d.name as doctor_name, e.nama as patient_name, e.jenis_pembayaran as payment_method
                FROM `master_req_queue` as a JOIN master_practice_schedule as b 
                JOIN master_poly as c JOIN master_doctor as d 
                JOIN patient as e 
                WHERE a.id_schedule_practice = b.id AND b.id_poly = c.id AND b.id_doctor = d.id 
                    AND b.patient_id = e.id AND b.patient_id IS NOT NULL AND a.created_date LIKE "%'.$get_date.'%"';



        $where = "";
        $orderby = " ";
        

        if(!empty($param['order'][0]['column'])){
            $orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";
        }else{
            $orderby.=" ORDER BY a.unix_timestamp DESC";
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


    // function getNoHp($token){
    //     $db_antrian_api = $this->load->database('antrian_api', TRUE);

    //     $db_antrian_api->select("*");
    //     $db_antrian_api->from("user");
    //     $db_antrian_api->where("token", $token);
    //     $query  = $db_antrian_api->get();
    //     $result = $query->row()->email; 
        
    //     $db_antrian = $this->load->database('default', TRUE);
    //     $db_antrian->select("*");
    //     $db_antrian->from("user");
    //     $db_antrian->where("email", $result);
    //     $query  = $db_antrian->get();
    //     $result = $query->row()->telp;

    // 	return $result;
    // }

    /*===================================== Get Jadwal Dokter =====================================*/
}