<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_bookingclass extends CI_Model{
    
    public $table  = 'class_booking';

    function __construct(){
        parent::__construct();
    }

    // function get_list_Bookingclass($param = array(),$method="default",$addtional="")
    // {
    //     $sql = "SELECT * FROM class_booking ORDER BY created_date DESC";

    //     $query = $this->db->query($sql);
    //     return $query;

    // }

    function get_list_Bookingclass($param = array(),$method="default",$addtional="")
    {


        $start  = $param['start'];
        $length = $param['length'];
        
        $columns    = array(
            1 => 'a.nama',
            2 => 'c.name',
            3 => 'd.name',
            4 => 'e.start_date',
            5 => 'class_booking.status',
            6 => 'class_booking.created_date'
        );

        $sql = "SELECT class_booking.id AS id, 
                a.nama AS patient_name, 
                c.name AS class_name, 
                d.name AS instructor_name, 
                e.start_date as ins_start_date, 
                e.start_time as ins_start_time, 
                e.finish_time as ins_finish_time, 
                class_booking.status as stat_classbook, 
                class_booking.created_date as date_make_book,
                class_booking.patient_id as patient_id,
                class_booking.payment_attached AS payment_attached
                FROM class_booking 
                INNER JOIN patient as a
                ON a.id = class_booking.patient_id 
                INNER JOIN schedule_class as b
                ON b.id = class_booking.id_schedule 
                INNER JOIN master_class as c
                ON c.id = b.id_class 
                INNER JOIN master_instructor as d
                ON d.id = b.id_instructor
                INNER JOIN schedule_instructor as e
                ON e.id = b.id_schedule_instructor";
        // $sql = "SELECT * FROM master_doctor AS a";

        $where = "";
        $orderby = " ";
        
        // $where.=" WHERE is_deleted = 0";

        // if ($param['is_approve'] != "") {
        //     $where.= " AND is_approve = ".$param['is_approve']."";
        // }else{
        //     $where.= " AND created_at <> ''";
        // }

        if(!empty($param['search']['value'])){ 
            if($where != ""){
                $where.= " AND ";
            }else{
                $where.= " WHERE ";
            }
            
            $where.= " a.nama like '%".$param['search']['value']."%' ";
            $where.= " or c.name like '%".$param['search']['value']."%' ";
            $where.= " or d.name like '%".$param['search']['value']."%' ";
            $where.= " or e.start_date like '%".$param['search']['value']."%' ";
            $where.= "  ";
        }

        if(!empty($param['order'][0]['column'])){
            $orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";
        }else{
            $orderby.=" ORDER BY class_booking.created_date DESC";
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

    
}