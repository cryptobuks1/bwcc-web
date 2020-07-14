<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_antrian extends CI_Model{
    
    public $table           = 'master_req_queue';
    public $table_antrian   = 'antrian';
    public $id              = 'id';
    public $order           = 'DESC';
    public $order_by        = 'created_date';

    function __construct(){
        parent::__construct();
    }

    function getData(){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->order_by($this->order_by, $this->order);
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getOneData($condition, $val){
        $this->db->select("*");
        $this->db->from($this->table);
        $this->db->where($condition, $val);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/
    function get_list_antrian($param = array(),$method="default",$addtional=""){
        $start  = $param['start'];
        $length = $param['length'];
        
        $columns    = array(
            0 => 'a.created_date',
        );

        // $sql = "SELECT a.*, c.name as doctor_name, d.name as loket FROM master_req_queue AS a
        //         LEFT JOIN master_practice_schedule AS b on a.id_schedule_practice = b.id
        //         LEFT JOIN master_doctor AS c on b.id_doctor = c.id
        //         LEFT JOIN admin AS d on a.id_loket = d.id"; yang lama

        $sql = "SELECT a.*, b.name as name_pasien, b.bpjs_id, b.tanggal, d.name as doctor_name, e.name as loket FROM antrian AS a
        LEFT JOIN master_req_queue AS b on a.req_queue_id = b.id
        LEFT JOIN master_practice_schedule AS c on b.id_schedule_practice = c.id
        LEFT JOIN master_doctor AS d on c.id_doctor = d.id
        LEFT JOIN admin AS e on a.id_loket = e.id";
        // $sql = "SELECT a.* FROM master_req_queue AS a";

        $where = "";
        $orderby = " ";
        
        // $where.=" WHERE a.status > 5";

        // if ($param['status'] != "") {
        //     $where.= " WHERE a.status = ".$param['status']."";
        // }else {
        //     $where.= " WHERE a.status > 5";
        // } // Yang lama

        if ($param['status'] != "") {
            $where.= " WHERE a.status = ".$param['status']."";
        }
        // else {
        //     $where.= " WHERE a.status != null";
        // }

        $where.=" AND b.tanggal = '".date("d-m-Y")."'";

        if(!empty($param['search']['value'])){ 
            if($where != ""){
                $where.= " AND ";
            }else{
                $where.= " WHERE ";
            }
            
            $where.= " (b.kode_antrian like '%".$param['search']['value']."%' ";
            $where.= " or b.nama like '%".$param['search']['value']."%' ";
            $where.= " or b.bpjs_id like '%".$param['search']['value']."%' ";
            $where.= " or d.name like '%".$param['search']['value']."%' ";
            $where.= " or b.tanggal like '%".$param['search']['value']."%' ";
            $where.= " or e.name like '%".$param['search']['value']."%' ";
            $where.= " ) ";
        }

        if(!empty($param['order'][0]['column'])){
            $orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";
        }else{
            $orderby.=" ORDER BY b.created_date DESC";
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

    /*===================================== Antrian =====================================*/
    function getOneDataAntrian($condition, $val){
        $this->db->select("*");
        $this->db->from($this->table_antrian);
        $this->db->where($condition, $val);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }
}