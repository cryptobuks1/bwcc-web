<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_cronjobs extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function get_book_list(){
    	$sql = "SELECT a.id as booking_id, b.id as schedule_id, b.date as s_date, 
                    b.start_time_service as s_time_start, b.finish_time_service as s_time_finish, a.unix_timestamp as req_time, 
                    c.name as poly_name, d.name as doctor_name, e.nama as patient_name 
                FROM `master_req_queue` as a JOIN master_practice_schedule as b 
                JOIN master_poly as c JOIN master_doctor as d 
                JOIN patient as e 
                WHERE a.id_schedule_practice = b.id AND b.id_poly = c.id AND b.id_doctor = d.id 
                    AND b.patient_id = e.id AND b.patient_id IS NOT NULL AND a.payment_status = 2";


            $qry = $this->db->query($sql);
            $res = $qry->result_array();

            // $res_message = [];

            // foreach ($res as $val_res) {
            //     array_push($res_message, array(
            //         "status" => "Success",
            //         "booking_id" => $val_res['booking_id'],
            //         "schedule_id" => $val_res['schedule_id'],
            //         "booking_date" => $val_res['req_time']

            //     ));
            // }

            // return $response->withJson(["status" => "Success", "data" =>  $result], 200);

            // return $res_message;

            return $res;
    }

    function get_bookingclass_list()
    {   
        $this->db->where('status', 2);
        $this->db->order_by("updated_date", "asc");
        $getdb_classbook = $this->db->get('class_booking');

        return $getdb_classbook;

    }


}