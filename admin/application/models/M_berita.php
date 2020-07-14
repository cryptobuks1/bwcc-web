<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_berita extends CI_Model{
    
    public $table           = 'news';
    public $id              = 'id';
    public $order           = 'DESC';
    public $order_by        = 'created_date';

    function __construct(){
        parent::__construct();
    }

    function getData(){
    	$this->db->select("*");
    	$this->db->from($this->table);
        $this->db->where("is_active", 1);
        $this->db->order_by($this->order_by, $this->order);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getOneData($condition, $val){
    	$this->db->select("*");
    	$this->db->from($this->table);
    	$this->db->where($condition, $val);
    	$this->db->where("is_active", 1);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/
    function get_list_news($param = array(),$method="default",$addtional=""){
        $start  = $param['start'];
        $length = $param['length'];
        
        $columns    = array(
            0 => 'a.created_date',
            1 => 'a.title',
            2 => 'b.name',
            3 => 'a.created_date',
        );

        $sql = "SELECT a.*, b.name as category_name FROM news AS a
                LEFT JOIN master_category_news AS b on a.id_category = b.id";
        // $sql = "SELECT a.* FROM master_doctor AS a";

        $where = "";
        $orderby = " ";
        
        $where.=" WHERE a.is_active = 1";

        // if ($param['is_approve'] != "") {
        //     $where.= " AND is_approve = ".$param['is_approve']."";
        // }else{
        //     $where.= " AND created_date <> ''";
        // }

        if(!empty($param['search']['value'])){ 
            if($where != ""){
                $where.= " AND ";
            }else{
                $where.= " WHERE ";
            }
            
            $where.= " (a.title like '%".$param['search']['value']."%' ";
            $where.= " or b.name like '%".$param['search']['value']."%' ";
            // $where.= " or a.gender like '%".$param['search']['value']."%' ";
            // $where.= " or b.specialist_name like '%".$param['search']['value']."%' ";
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
}