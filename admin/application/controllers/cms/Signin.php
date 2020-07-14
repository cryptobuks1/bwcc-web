<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_signin");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
	}

	public function index(){
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		
		if (!empty($sessionData)) {
			redirect('cms/dashboard');
		}
		$data['login'] = array("OK");
		$this->load->view('admin/signinup/signin',$data);
	}

	function doLogin(){
		$post     = $this->input->post();
		$proccess = $this->M_signin->checkLogin($post['email'],$post['password']);
		if ($proccess == 1) {
			redirect("cms/dashboard");
		}else{
			redirect("cms/signin");
		}
	}

	function signout(){
		if ($this->sessionData['access_group_id'] == 3) {
			$update_status = [
				"status"	=> "0",
				"updated_date"  => date('Y-m-d H:i:s'),
				"updated_by"    => $this->sessionData['user_id']
			];

			$update = $this->db->update("admin", $update_status, array("id" => $this->sessionData['user_id']));
			if ($update) {
				session_destroy();
				redirect("cms");
			}else{
				debugCode("gagal login");
			}

		}else{
			session_destroy();
			redirect("cms");
		}
	}
}