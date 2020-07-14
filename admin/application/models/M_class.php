<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_class extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function getDetailclass($id){
        $this->db->select("*");
        $this->db->from("master_class");
        $this->db->where("id", $id);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }


    function get_list_class($param = array(),$method="default",$addtional=""){

        $sql = "SELECT * FROM master_class";

        $query = $this->db->query($sql);
        return $query;
    }

    function get_schedule_class($id , $param = array(),$method="default",$addtional="")
    {

        $command = "SELECT schedule_class.id AS id , schedule_class.id_class AS id_kelas , master_instructor.name AS ins_name , master_instructor.gender , master_expertise.expertise_name , schedule_instructor.start_date , schedule_instructor.start_time , schedule_instructor.finish_time
FROM schedule_class
JOIN master_instructor
JOIN master_expertise
JOIN schedule_instructor
WHERE schedule_class.id_class = '$id'
AND schedule_class.id_instructor = master_instructor.id
AND master_expertise.id = master_instructor.id_expertise
AND schedule_class.id_schedule_instructor = schedule_instructor.id";


        $ex_q = $this->db->query($command);

        return $ex_q;
    }

}