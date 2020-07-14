<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Signin extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model('M_signin');
		$this->load->model('M_nadzir');
		$this->load->library('user_agent');
		$this->sessionNadzir = $this->session->sessionNadzir;
	}

	// Signin
	function nadzir(){
		if (!empty($this->sessionNadzir)) {
			redirect("dashboard/overview");
		}

		$data['title']		= "Kita Wakaf - Login";
		$data['content']	= "front/front_page/signin";
		$this->load->view('front/layout', $data);
	}

	function doLogin(){
		$post = $this->input->post();

		$checkemail = $this->M_signin->checkLoginNadzir($post['email'],$post['password']);
		
		if ($checkemail == 1) {
			redirect("dashboard/overview");
		}else{
			redirect("signin/nadzir");
		}
	}

	// End Signin

	// Signup
	function signup(){
		if (!empty($this->sessionNadzir)) {
			redirect("dashboard/overview");
		}

		$data['title']		= "Kita Wakaf - Register";
		$data['content']	= "front/front_page/signup";
		$this->load->view('front/layout', $data);
	}

	function doSignup(){
		$post = $this->input->post();

		if (empty($post)) {
			redirect("");
		}else{

			// Id Nadzir
			$id = guid();

			// Get Nadzir
			$getNadzir = $this->M_nadzir->getOneData("email", $post['email']);

			if (!empty($getNadzir)) {
				custom_notif("failed","Notif", "Email sudah pernah digunakan.");
				redirect("signin/signup");
			}else{

				$signupArray = array(
					'id'      				=> $id,
					'institution_name'  	=> $post['name'],
					'no_registrasi_bwi'  	=> $post['noreg_bwi'],
					'institution_address'  	=> $post['alamat_kantor'],
					'institution_pic'  		=> $post['nama_pic'],
					'email'     			=> $post['email'],
					'no_telp'     			=> $post['no_telp'],
					'rating'     			=> 5,
					'device_user'			=> $this->agent->agent_string(),
					'ip_address'			=> $this->input->ip_address(),
					'is_deleted'    		=> 0,
					'created_date'  		=> date('Y-m-d H:i:s')
				);

				$insert = $this->db->insert("nadzir", $signupArray);

				if ($insert) {

					$data['name'] 	= $post['name'];
					$data['url']	= "signin/buatpassword/".$id;

					$template 		= $this->load->view("front/front_page/email_notif", $data, true);
					$process 		= $this->global->send_email("no-reply@kitawakaf.com", "Kita Wakaf", $post['email'], "", "Aktivasi Akun", $template);
					// ============================ Additional Email =========================== //
					$result['dataNadzir'] = $signupArray;
					$template1 		= $this->load->view("front/front_page/notif_new_nadzir", $result, true);
					$this->global->send_email("no-reply@kitawakaf.com", "Kita Wakaf", "admin@kitawakaf.com", "dev.kitawakaf@gmail.com", "Pendaftaran Nadzir Baru", $template1);
					// ============================ End =========================== //

					if ($process) {

						$arrayData 			= [
							"judul"		=> "Tinggal satu langkah lagi!",
							"msg"		=> "Cek email Anda untuk aktivasi akun <span class='color-green'>Kitawakaf.</span>",
							"btn"		=> "ok"
						];
						
						$data['title']		= "Kita Wakaf - Register";
						$data['dataNotif']	= $arrayData;
						$data['content']	= "front/front_page/notif/notif";
						$this->load->view('front/layout', $data);
					}else{
						$this->session->set_flashdata('is_success', 'Yes');
						redirect("signin/signup");
					}
				}else{
					$this->session->set_flashdata('is_success', 'No');
					redirect("signin/signup");
				}

			}
		}
	}

	function notif(){
		$data['content']	= "front/front_page/notif/cek_mail";
		$this->load->view('front/layout', $data);
	}

	// Buat Password
	function buatpassword($id){
		$dataNadzir = $this->M_nadzir->getOneData("id", $id);

		if (!empty($dataNadzir->password)) {
			redirect();
		}else{
			$data['detailData']		= $dataNadzir;
			$data['title']			= "Kita Wakaf - Buat Password";
			$data['content']		= "front/front_page/buat_password";
			$this->load->view('front/layout', $data);
		}
	}

	function aktivasipassword(){
		$post     = $this->input->post();

		// Get Nadzir
		$getNadzir = $this->M_nadzir->getOneData("id", $post['id']);

		// Buat password
		$password = password_hash($post['password'], PASSWORD_DEFAULT);

		$updateArray = array(
			"password"      => $password,
			"hash"     		=> $password,
			"device_user"	=> $this->agent->agent_string(),
			"ip_address"	=> $this->input->ip_address()

		);

		$update = $this->db->update("nadzir", $updateArray, array("id" => $post['id']));
		if ($update) {
			// $this->session->set_flashdata('is_success', 'Yes');
			// redirect("");
			$arrayData 	= [
							"judul"		=> "Aktivasi Akun berhasil",
							"msg"		=> "Tunggu beberapa saat dan <a href='".base_url('signin/nadzir')."' class='color-deep-sky'>login</a> menggunakan alamat email <b>".$getNadzir->email."</b> dan password yang telah Anda buat<br> Terima Kasih.",
							"btn"		=> ""
						];
								
			$data['title']			= "Kita Wakaf - Buat Password";
			$data['dataNotif']	= $arrayData;
			$data['content']	= "front/front_page/notif/notif";
			$this->load->view('front/layout', $data);
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("signin/buatpassword/".$post['id']);
		}		
	}
	// End Buat Password
	
	// End Signup

	function signout(){
		session_destroy();
		redirect();
	}

	function test(){
		$data['title']		= "Kita Wakaf - Register";
		$data['content']	= "front/front_page/dashboard/overview/index";
		$this->load->view('front/layout', $data);
	}

	// function confirmlost($param){
	// 	$decode        = encrypt_decrypt("decrypt",$param);
	// 	$explode       = explode("||", $decode);
	// 	$checkPassword = $this->M_signin->checklostpassword($explode[0],$explode[1]);
	// 	if (!empty($checkPassword)) {
	// 		$updatePassword = $this->db->update("member",array("member_password" => md5($checkPassword->newpassword)), array("member_id" => $explode[0]));
	// 		$updateRequest = $this->db->update("reset_password_request",array("status" => 1), array("status" => 0, "member_id" => $explode[0]));
	// 		custom_notif("success","success","Reset Password success, please login with your new password : <b>".$checkPassword->newpassword."</b>");
	// 		redirect('signin/resetpassword');
	// 	}else{
	// 		custom_notif("failed","failed","Token Failed".$post['email']);
	// 		redirect('signin/resetpassword');
	// 	}
	// }
}