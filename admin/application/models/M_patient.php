<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_patient extends CI_Model{
    function __construct(){
        parent::__construct();
    }

    function all_patient($param = array(),$method="default",$addtional=""){

    	$start  = $param['start'];
        $length = $param['length'];
        
        $columns    = array(
            0 => 'created_at',
            1 => 'nama',
            2 => 'lahir_tempat',
            3 => 'created_at',
            4 => 'alamat',
            5 => 'lahir_tanggal',
            6 => 'alamat',
            7 => 'no_hp'
        );

        $sql = "SELECT * FROM patient";
        // $sql = "SELECT * FROM master_doctor AS a";

        $where = "";
        $orderby = " ";
        
        $where.=" WHERE is_deleted = 0";

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
            
            $where.= " (nama like '%".$param['search']['value']."%' ";
            $where.= " or lahir_tempat like '%".$param['search']['value']."%' ";
            $where.= " or alamat like '%".$param['search']['value']."%' ";
            // $where.= " or gender like '%".$param['search']['value']."%' ";
            // $where.= " or b.specialist_name like '%".$param['search']['value']."%' ";
            $where.= " ) ";
        }

        if(!empty($param['order'][0]['column'])){
            $orderby.=" ORDER BY ".$columns[$param['order'][0]['column']]." ".$param['order'][0]['dir']." ";
        }else{
            $orderby.=" ORDER BY nama ASC";
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


	function get_count_patient_books($patient_id){
	
		$this->db->select("distinct(*)");
		$this->db->from("master_req_queue_status");		
		$this->db->limit(10);
		$query = $this->db->get();
		$q_res = $query->result_array();
	}
}