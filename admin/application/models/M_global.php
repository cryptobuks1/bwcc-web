<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_global extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getProvince(){
        $this->db->select("*");
        $this->db->from("app_province");
        $this->db->order_by("province_name","ASC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getProvinceById($id){
        $this->db->select("*");
        $this->db->from("app_province");
        $this->db->where("province_id", $id);
        $this->db->order_by("province_name","ASC");
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getCityById($id){
        $this->db->select("*");
        $this->db->from("app_city");
        $this->db->where("city_id", $id);
        $this->db->order_by("city_name","ASC");
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getCityByProvince($id){
        $this->db->select("*");
        $this->db->from("app_city");
        $this->db->where("province_id",$id);
        $this->db->order_by('city_name','ASC');
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function checkEmailMember($email){
        $email = str_replace(" ", "", $email);
        $this->db->select("COUNT(*) AS count");
        $this->db->from("member");
        $this->db->where("member_email",$email);
        $this->db->where("is_deleted",0);
        $query  = $this->db->get();
        $result = $query->row()->count;
        return $result;
    }

    function getDetailMember($id){
        $this->db->select("*");
        $this->db->from("member");
        $this->db->where("member_id",$id);
        $this->db->where("is_active",1);
        $this->db->where("is_deleted",0);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getShortDetailMember($id){
        $this->db->select("member_id, member_name");
        $this->db->from("member");
        $this->db->where("member_id",$id);
        $this->db->where("is_active",1);
        $this->db->where("is_deleted",0);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getMemberByEmail($email){
        $this->db->select("*");
        $this->db->from("member");
        $this->db->where("member_email",$email);
        $this->db->where("is_deleted",0);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getListUpcomingEvent(){
        $this->db->select("*");
        $this->db->from("event");
        $this->db->where("is_deleted",0);
        $this->db->where("is_active",1);
        /*$this->db->where("event_start_date >=",date("Y-m-d H:i:s"));*/
        $this->db->order_by("event_start_date","ASC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function send_email_fake($fromEmail, $fromName, $to, $cc, $subject, $template, $attach = array()){
        return true;
    }

    function send_email($fromEmail, $fromName, $to, $cc, $subject, $template, $attach = array()){
        $config = Array (
            'protocol' => 'smtp',
            'smtp_host' => 'mx1.hostinger.co.id',
            'smtp_port' => 587,
            'smtp_user' => 'no-reply@kitawakaf.com',
            'smtp_pass' => 'kitawakaf606060',
            'mailtype'  => 'html', 
            'charset'   => 'iso-8859-1'
        );
        $this->load->library ( 'email', $config );
        $this->email->set_newline ( "\r\n" );
        /*$this->email->initialize ($config);*/
        $this->email->from ( $fromEmail, $fromName );
        $this->email->to ( $to );
        $this->email->cc ( $cc );
        $this->email->subject ( $subject );
        $this->email->message ( $template );
        $this->email->reply_to("no-reply@kitawakaf.com");
        if (count ( $attach ) > 0) {
            for($i = 0; $i < count ( $attach ); $i ++) {
                $this->email->attach ( $attach [$i] );
            }
        }

        if ($this->email->send ()) {
            $this->email->clear ( TRUE );
            return true;
        } else {
            echo $this->email->print_debugger();die;
            return false;
            // return true; 
        }
    }

    // ============ Additional Mas One for Antrian ============ //
    function getscheduleByCondition($condition, $val){
        $this->db->select("a.*, b.poly_code, b.name as poly_name");
        $this->db->from("master_practice_schedule a");
        $this->db->join("master_poly b", "a.id_poly = b.id");
        $this->db->where("a.".$condition, $val);
        $this->db->group_by("a.id_poly");
        // $this->db->order_by("event_start_date", "ASC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getSchedule($id_poly, $id_doctor){
        $this->db->select("a.*, b.poly_code");
        $this->db->from("master_practice_schedule a");
        $this->db->join("master_poly b", "a.id_poly = b.id");
        $this->db->where("a.days", date("N"));
        $this->db->where("a.id_poly", $id_poly);
        $this->db->where("a.id_doctor", $id_doctor);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;

    }

    function getDokterPoli($condition, $val){
        $this->db->select("a.*, name as doctor_name");
        $this->db->from("master_practice_schedule a");
        $this->db->join("master_doctor b", "a.id_doctor = b.id");
        $this->db->where("a.".$condition, $val);
        $this->db->where("a.days", date("N"));
        $this->db->where("is_active", 1);
        $this->db->order_by("a.start_time_service", "ASC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    // function getDokterPoli($condition, $val){
    //     $this->db->select("a.*, name as doctor_name");
    //     $this->db->from("master_poly_doctor a");
    //     $this->db->join("master_doctor b", "a.id_doctor = b.id");
    //     $this->db->where("a.".$condition, $val);
    //     $this->db->order_by("a.start_practice", "ASC");
    //     $query  = $this->db->get();
    //     $result = $query->result();
    //     return $result;
    // }

    function getHistoryReq($condition, $val){
        $this->db->select("a.*, c.name as poly_name, d.name as payment_name");
        $this->db->from("master_req_queue a");
        $this->db->join("master_practice_schedule b", "a.id_schedule_practice = b.id");
        $this->db->join("master_poly c", "b.id_poly = c.id");
        $this->db->join("master_payment d", "a.id_payment = d.id", "left");
        $this->db->where("a.".$condition, $val);
        $this->db->order_by("a.queue_number", "DESC");
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    // == New Version == //
    function getHistoryReqNew($condition, $val){
        $this->db->select("a.*, c.name as poly_name, c.poly_code, d.name as payment_name");
        $this->db->from("master_req_queue a");
        $this->db->join("master_practice_schedule b", "a.id_schedule_practice = b.id");
        $this->db->join("master_poly c", "b.id_poly = c.id");
        $this->db->join("master_payment d", "a.id_payment = d.id", "left");
        $this->db->where("a.tanggal", date("d-m-Y"));
        $this->db->where("a.status > 5");
        $this->db->where("a.".$condition, $val);
        $this->db->order_by("a.queue_code", "DESC");
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }
    // == End == //


    function getTotalAntrian($id_schedule){
        $this->db->select("count(a.id) as total");
        $this->db->from("master_req_queue a");
        $this->db->where("a.status", "6");
        $this->db->where("a.id_schedule_practice", $id_schedule);
        $this->db->where("a.tanggal", date("d-m-Y"));
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function getPoliDokter($condition, $val){
        $this->db->select("a.*, b.name as doctor_name, b.no_str, b.gender, c.name as specialist_name");
        $this->db->from("master_practice_schedule a");
        $this->db->join("master_doctor b", "a.id_doctor = b.id");
        $this->db->join("master_specialist c","b.id_specialist = c.id");
        $this->db->where("a.".$condition, $val);
        $this->db->group_by("a.id_doctor");
        $this->db->order_by("b.name", "ASC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getOnePoliDokter($condition, $val){
        $this->db->select("a.*, b.name as doctor_name, b.no_str, b.gender, c.name as specialist_name");
        $this->db->from("master_practice_schedule a");
        $this->db->join("master_doctor b", "a.id_doctor = b.id");
        $this->db->join("master_specialist c","b.id_specialist = c.id");
        $this->db->where("a.".$condition, $val);
        $this->db->group_by("a.id_doctor");
        $this->db->order_by("b.name", "ASC");
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function checkin($condition, $val, $status){
        $this->db->select("a.*, c.name as poly_name, d.name as payment_name");
        $this->db->from("master_req_queue a");
        $this->db->join("master_practice_schedule b", "a.id_schedule_practice = b.id");
        $this->db->join("master_poly c", "b.id_poly = c.id");
        $this->db->join("master_payment d", "a.id_payment = d.id", "left");
        $this->db->where("a.tanggal", date("d-m-Y"));
        $this->db->where("a.status", $status);
        $this->db->where("a.".$condition, $val);
        // $this->db->where('a.queue_code !=" " ');
        $this->db->order_by("a.queue_code", "DESC");
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    // Get User from table antrian api
    function getUserApi($id)
    {
        $db_antrian_api = $this->load->database('antrian_api', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.

        $db_antrian_api->select("*");
        $db_antrian_api->from("user");
        $db_antrian_api->where("token", $id);
        $query  = $db_antrian_api->get();
        $result = $query->row();
        return $result;
    }
    
    function getUserApiById($id)
    {
        $db_antrian_api = $this->load->database('antrian_api', TRUE); // the TRUE paramater tells CI that you'd like to return the database object.

        $db_antrian_api->select("*");
        $db_antrian_api->from("user");
        $db_antrian_api->where("id", $id);
        $query  = $db_antrian_api->get();
        $result = $query->row();
        return $result;
    }

    function getUserRequeue(){
        $this->db->select("a.*, b.name as dokter_name");
        $this->db->from("master_req_queue a");
        $this->db->join("master_doctor b", "a.id_doctor = b.id");
        $this->db->where("a.tanggal", date("d-m-Y"));
        $this->db->where("a.status = 4");
        $this->db->where("a.created_by != '' ");
        // $this->db->order_by("a.queue_code", "DESC");
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

}