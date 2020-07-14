<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_signin extends CI_Model
{
    function __construct(){
        parent::__construct();
        $this->load->model("M_groupmodule");
    }

    function checkLogin($email,$password){
   //  	if ($email == "superadmin@zmail.com" AND $password == "123123") {
   //  		$dataArr = array(
			// 	'user_id'        => 1,
			// 	'name'           => "superadmin",
			// 	'email'          => $email,
			// 	'is_super_admin' => 1
			// 	);
			// $this->session->set_userdata('sessionData',$dataArr);
   //  	}else{
    		
   //  	}

    		$this->db->select('*');
	        $this->db->from('admin');
			$this->db->where('email', $email);
	        // $this->db->where('password', md5($password));
			$this->db->where('is_active', 1);
	        $query = $this->db->get()->row();

	        if (password_verify($password.'.'.$query->hash, $query->password)) {
	        	
				$dataArr = array(
					'user_id'        => $query->id,
					'name'           => $query->name,
					'email'          => $query->email,
					// 'username'       	=> $querycheck->user_username,
					'access_group_id' 	=> $query->access_group_id,
					);
				
				$this->session->set_userdata('sessionData',$dataArr);

				// Last Login
				$arrayLog = array(
					"last_login"	=> date("Y-m-d H:i:s"),
				);
				$this->db->update("admin", $arrayLog, array("id" => $query->id));


				// Array Module
				$listModule = $this->M_groupmodule->getModuleDetail("access_group_id", $query->access_group_id);
				$this->session->set_userdata('sessionModule', $listModule);

				// Array Sub Module
				$listSubmodule = $this->M_groupmodule->getSubmodule("access_group_id", $query->access_group_id);
				$this->session->set_userdata('sessionSubmodule', $listSubmodule);

				$dataModule = $this->getmoduleByAccesGroup($query->access_group_id);
				$menu = [];
				foreach ($dataModule as $key => $value) {
					$dataSub = $this->getsubmoduleByAccessGroup($query->access_group_id, $value->module_id);
					$menu[] = array(
						"module_name" => $value->module_name,
						"module_url"  => $value->module_url,
						"module_icon" => $value->module_icon,
						"isParent"    => $value->isParent,
						"sub"         => (array)$dataSub
					);
				}
				
				$this->session->set_userdata('menusession', $menu);

				return true;
	        }else{
	        	$this->session->set_flashdata('failedtologin', 'Yes');    
	            return false;
	        }
		
    }

	function checkLoginReset($email){
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('email',$email);
        $que = $this->db->get();
		if($que->num_rows() > 0){
			$data = $que->result_array();
			return $data[0];
		}else{	
			return array();
		}
    }
	
	function newPassword($param){
        $insert = array('password' => md5($param['Password']));
		if($this->kppdb->update('admin',$insert,array('id_admin' => $param['id_admin']))){
			return true;
		}else{
			return false;
		}
    }

    function checkLoginNadzir($email,$password){
    	$this->db->select("*");
    	$this->db->from("nadzir");
    	$this->db->where("email", $email);
    	// $this->db->where("member_password", md5($password));
    	$this->db->where("is_deleted", 0);
    	$this->db->where("is_approve", 1);
    	$query = $this->db->get()->row();

    	// debugCode($query);

    	if (!empty($query)) {
    		if(password_verify($password, $query->password)){

				$dataArr = array(
					'nadzir_id'   => $query->id,
					'nadzir_name' => $query->institution_name,
					'nadzir_email' => $query->email,
					'nadzir_no_hp' => $query->no_telp,

					);

				$this->session->set_userdata('sessionNadzir', $dataArr);

				$arrayLog = array(
					"last_login"	=> date("Y-m-d H:i:s"),
				);

				$this->db->update("nadzir", $arrayLog, array("id" => $query->id));
				return true;
	        }else{
				// $this->session->set_flashdata('failedtologin', 'Yes');
				custom_notif("failed", "Notif", "Username atau Password Salah.");
	            return false;
	        }
    	}else{
    		custom_notif("failed", "Notif", "Akun sedang divalidasi untuk Approve.");
	        return false;
    	}
    }

    function checklostpassword($member_id,$expired_date){
    	$this->db->select("*");
    	$this->db->from("reset_password_request");
    	$this->db->where("member_id",$member_id);
    	$this->db->where("status",0);
    	$this->db->where("expired_date >=",date("Y-m-d H:i:s"));
    	$this->db->where("expired_date", $expired_date);
    	$query 	= $this->db->get();
    	$result = $query->row();
    	return $result;
    }

    function getmoduleByAccesGroup($acc_id){
    	$this->db->select("am.module_id, am.module_name, am.module_url, am.isParent, am.module_icon");
    	$this->db->from("app_access_group_moduldetail AS agm");
    	$this->db->join("app_module AS am","am.module_id = agm.access_module_id");
    	$this->db->where("access_group_id",$acc_id);
    	$this->db->where("am.module_status",1);
    	$this->db->where("am.isDeleted",0);
    	$this->db->order_by("module_order","ASC");
		$query  = $this->db->get();
		$result = $query->result();
    	return $result;
    }

    function getsubmoduleByAccessGroup($acc_id, $module_id){
    	$this->db->select("asm.submodule_id, asm.submodule_name, asm.submodule_url");
    	$this->db->from("app_access_group_submodule AS ags");
    	$this->db->join("app_submodule AS asm","asm.submodule_id = ags.access_submodule_id");
    	$this->db->join("app_module AS am","am.module_id = asm.module_id");
    	$this->db->where("ags.access_group_id",$acc_id);
    	$this->db->where("asm.module_id",$module_id);
    	$this->db->where("asm.submodule_status",1);
    	$this->db->where("asm.isDeleted",0);
    	$this->db->order_by("asm.submodule_order","ASC");
		$query  = $this->db->get();
		$result = $query->result_array();
    	return $result;
    }
}
?>