<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class M_dokter extends CI_Model{

    

    public $table           = 'master_doctor';

    public $table_schedule  = 'master_practice_schedule';

    public $id              = 'id';

    public $order           = 'DESC';

    public $order_by        = 'created_date';



    function __construct(){

        parent::__construct();

    }



    function getData(){

        $this->db->select("*");

        $this->db->from($this->table);

        $this->db->where("is_deleted", 0);

        $this->db->order_by($this->order_by, $this->order);

        $query  = $this->db->get();

        $result = $query->result();

        return $result;

    }



    function getOneData($condition, $val){

        $this->db->select("*");

        $this->db->from($this->table);

        $this->db->where($condition, $val);

        $this->db->where("is_deleted", 0);

        $query  = $this->db->get();

        $result = $query->row();

        return $result;

    }



    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/

    function get_list_dokter($param = array(),$method="default",$addtional=""){

        $start  = $param['start'];

        $length = $param['length'];

        

        $columns    = array(

            0 => 'a.created_date',

            1 => 'a.name',

            2 => 'a.no_str',

            3 => 'b.id_specialist',

            4 => 'a.gender',

            5 => 'a.is_active',

            6 => 'a.created_date'

        );



        $sql = "SELECT a.*, b.name as specialist_name FROM master_doctor AS a

                LEFT JOIN master_specialist AS b on a.id_specialist = b.id";

        // $sql = "SELECT a.* FROM master_doctor AS a";



        $where = "";

        $orderby = " ";

        

        $where.=" WHERE a.is_deleted = 0";



        if ($param['is_active'] != "") {

            $where.= " AND a.is_active = ".$param['is_active']."";

        }else{

            // $where.= " AND a.is_active <> ''";

        }



        if(!empty($param['search']['value'])){ 

            if($where != ""){

                $where.= " AND ";

            }else{

                $where.= " WHERE ";

            }

            

            $where.= " (a.name like '%".$param['search']['value']."%' ";

            $where.= " or a.no_str like '%".$param['search']['value']."%' ";

            $where.= " or a.gender like '%".$param['search']['value']."%' ";

            $where.= " or b.name like '%".$param['search']['value']."%' ";

            $where.= " ) ";

        }



        if(!empty($param['order'][0]['column'])){

            $orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";

        }else{

            $orderby.=" ORDER BY a.created_date DESC";

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





    /*===================================== Get Jadwal Dokter =====================================*/

    function getScheduleDoctor($condition, $val){

        $this->db->select("*");

        $this->db->from($this->table_schedule);

        $this->db->where($condition, $val);

        $this->db->order_by("day", "ASC");

        $query  = $this->db->get();

        $result = $query->result();

        return $result;

    }

    function getDoctorAbsent($condition, $val){

        $this->db->select("*");

        $this->db->from("doctor_absent");

        $this->db->where($condition, $val);

        $this->db->order_by("result_api", "asc");

        $query  = $this->db->get();

        $result = $query->result();

        return $result;

    }

}