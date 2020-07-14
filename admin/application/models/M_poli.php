<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_poli extends CI_Model{
    
    public $table               = 'master_poly';
    public $table_poli_dokter   = 'master_poly_doctor';
    public $id                  = 'id';
    public $order               = 'DESC';
    public $order_by            = 'created_date';

    function __construct(){
        parent::__construct();
    }

    function getData(){
    	$this->db->select("*");
    	$this->db->from($this->table);
        $this->db->where("is_deleted", 0);
        $this->db->order_by($this->order_by, $this->order);
    	$query	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function getOneData($condition, $val){
    	$this->db->select("*");
    	$this->db->from($this->table);
    	$this->db->where($condition, $val);
    	$this->db->where("is_deleted", 0);
    	$query	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    /*===================================== Poli Dokter Nggak dipake =====================================*/

    function getPoliDokter($id_poly){
        $this->db->select("a.*, b.name, b.no_str, b.gender, c.name as specialist_name");
        $this->db->from($this->table_poli_dokter." a");
        $this->db->join("master_doctor b","a.id_doctor = b.id");
        $this->db->join("master_specialist c","b.id_specialist = c.id");
        $this->db->where("a.id_poly", $id_poly);
        $this->db->where("a.is_active", 1);
        $query  = $this->db->get();
        $result = $query->result();
        return $result;
    }

    function getOnePoliDokter($id_poly, $condition, $val){
        $this->db->select("a.*");
        $this->db->from($this->table_poli_dokter." a");
        // $this->db->join("master_doctor b","a.id_doctor = b.id");
        // $this->db->join("master_specialist c","b.id_specialist = c.id");
        $this->db->where("a.id_poly", $id_poly);
        $this->db->where("a.".$condition, $val);
        $this->db->where("a.is_active", 1);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    function cek_poli_by_id($condition, $val){
        $this->db->select("a.*");
        $this->db->from($this->table_poli_dokter." a");
        // $this->db->join("master_doctor b","a.id_doctor = b.id");
        // $this->db->join("master_specialist c","b.id_specialist = c.id");
        $this->db->where("a.".$condition, $val);
        $this->db->where("a.is_active", 1);
        $query  = $this->db->get();
        $result = $query->row();
        return $result;
    }

    /*===================================== End =====================================*/

    /*===================================== FUNCTION FOR DATATABLE QUERY =====================================*/
    function get_list_poli($param = array(),$method="default",$addtional="")
    {

        $sql = "SELECT master_poly.id AS id , master_poly.poly_code AS kode_poli , master_poly.name AS nama_poli , master_poly.id_payment AS id_payment , master_poly.id_payment AS id_pembayaran , master_specialist.specialist_code AS kode_spesialis , master_specialist.name AS nama_spesialis FROM master_poly INNER JOIN master_specialist ON master_poly.id_specialist = master_specialist.id WHERE master_poly.is_deleted = 0";

        $query = $this->db->query($sql);
        return $query;
    }

    /*===================================== Poli Dokter From SChedule =====================================*/
    /*===================================== End =====================================*/
}