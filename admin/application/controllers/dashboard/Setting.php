<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Setting extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_nadzir");
		$this->load->model("M_bank");
		$this->sessionNadzir = $this->session->sessionNadzir;
		if (empty($this->sessionNadzir)) {
			redirect();
		}
	}

	// ============================================ Bank ============================================//
	function listbank(){
		$dataNadzir 			= $this->sessionNadzir;
		$getBank				= $this->M_bank->nadzirBank("id_nadzir", $dataNadzir['nadzir_id']);

		$data['bank']			= $getBank;
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Setting Banks";
		$data['title_head']		= "List Bank";
		$data['content']		= "front/front_page/dashboard/setting/bank/index";
		$this->load->view('front/layout', $data);
	}

	function addbank(){
		$dataNadzir 			= $this->sessionNadzir;
		
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Setting Banks";
		$data['title_head']		= "Tambah Bank";
		$data['content']		= "front/front_page/dashboard/setting/bank/add";
		$this->load->view('front/layout', $data);
	}

	function doAddBank(){
		$post = $this->input->post();
		
		$insertArray = array(
			"id"  			=> guid(),
			"id_nadzir" 	=> $this->sessionNadzir['nadzir_id'],
			"nama_bank" 	=> $post['nama_bank'],
			"no_rek"		=> $post['no_rek'],
			"atas_nama"		=> $post['atas_nama'],
			"is_deleted"	=> 0,
			"created_date"  => date('Y-m-d H:i:s'),
			"created_by"    => $this->sessionNadzir['nadzir_id']
		);

		$insert	= $this->db->insert("bank_nadzir", $insertArray);
		if ($insert) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("dashboard/setting/listbank");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("dashboard/setting/addbank");
		}
	}

	function editbank($id){
		$dataNadzir 			= $this->sessionNadzir;
		$getBank				= $this->M_bank->nadzirBankById($this->sessionNadzir['nadzir_id'], "id", $id);
		
		$data['bank']			= $getBank;
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Setting Banks";
		$data['title_head']		= "Edit Bank";
		$data['content']		= "front/front_page/dashboard/setting/bank/edit";
		$this->load->view('front/layout', $data);
	}

	function doUpdate($id){
		$post     = $this->input->post();

		$dataArray = array(
			"nama_bank" 	=> $post['nama_bank'],
			"no_rek"		=> $post['no_rek'],
			"atas_nama"		=> $post['atas_nama'],
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionNadzir['nadzir_id']
		);

		$update = $this->db->update("bank_nadzir", $dataArray, array("id" => $id));
		if ($update) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("dashboard/setting/listbank");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("dashboard/setting/editbank/".$id);
		}
	}

	function doDelete($id){

		$updateArray = array(
			"is_deleted"   	=> "1",
			"updated_date" 	=> date("Y-m-d H:i:s"),
			"updated_by"   	=> $this->sessionData['user_id'],
		);

		$delete = $this->db->update("bank_nadzir", $updateArray, array("id" => $id));
		if ($delete) {
			$this->session->set_flashdata('is_success', 'Yes');
			redirect("dashboard/setting/listbank");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("dashboard/setting/listbank");
		}
	}

	// ============================================ Edit Profile ============================================//

	function edit_profile(){
		$dataNadzir 			= $this->sessionNadzir;
		$getNadzir				= $this->M_nadzir->getOneData("id", $dataNadzir['nadzir_id']);

		$data['nadzir']			= $getNadzir;
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Personal Information";
		$data['title_head']		= "Edit Profile";
		$data['content']		= "front/front_page/dashboard/setting/edit_profile";
		$this->load->view('front/layout', $data);
	}

	function doUpdateProfile(){
		$post     = $this->input->post();
		// debugCode($post);

		$updateArray = array(
			"institution_name"      => $post['institution_name'],
			"no_telp"     			=> $post['no_hp'],
			"institution_address"   => $post['alamat'],
			"biodata"   			=> $post['biodata'],
			"updated_date"     		=> date('Y-m-d H:i:s')
		);

		$update = $this->db->update("nadzir", $updateArray, array("id" => $post['nadzir_id']));
		if ($update) {
			// $this->session->set_flashdata('is_success', 'Yes');
			custom_notif("success","gayung", "Profile Anda berhasil diperbarui");
			redirect("dashboard/setting/edit_profile");
		}else{
			$this->session->set_flashdata('is_success', 'No');
			redirect("dashboard/setting/edit_profile");
		}
	}

	// ============================================ End ============================================//

	// ============================================ Ubah Password ============================================//

	function ubah_password(){
		$dataNadzir 			= $this->sessionNadzir;
		
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Ubah Password";
		$data['title_head']		= "Ubah Password";
		$data['content']		= "front/front_page/dashboard/setting/ubah_password";
		$this->load->view('front/layout', $data);
	}

	function doUpdatePass(){
		$post     	= $this->input->post();
		$getNadzir	= $this->M_nadzir->getOneData("id", $post['nadzir_id']);

		if(password_verify($post['old_pass'], $getNadzir->password)){
			if ($post['new_pass'] <> $post['konf_new_pass']) {
				custom_notif("failed", "Notif", "Password baru tidak cocok");
			}else{
				// Password
				$password = password_hash($post['new_pass'], PASSWORD_DEFAULT);

				// Update Password
				$updatePass = array(
					"password"      		=> $password,
					"hash"     				=> $password,
					"updated_date"     		=> date('Y-m-d H:i:s')
				);

				$update = $this->db->update("nadzir", $updatePass, array("id" => $post['nadzir_id']));
				// End Update

				custom_notif("success", "Notif", "Password berhasil dirubah");
			}

			redirect("dashboard/setting/ubah_password");
        }else{

			if ($post['new_pass'] <> $post['konf_new_pass']) {
				$notif = "Password baru tidak cocok";
				custom_notif("failed", "Notif", "Password Lama salah <br>".$notif);
			}else{
				custom_notif("failed", "Notif", "Password Lama salah");
			}

			redirect("dashboard/setting/ubah_password");
        }
	}

	// ============================================ End ============================================//

	// ============================================ Ubah Foto Profil ============================================//

	function edit_profile_picture(){
		$dataNadzir 			= $this->sessionNadzir;
		$getNadzir				= $this->M_nadzir->getOneData("id", $dataNadzir['nadzir_id']);
		// debugCode($getNadzir);

		$data['nadzir']			= $getNadzir;
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Ubah Foto Profile";
		$data['title_head']		= "Edit Foto Profile";
		$data['content']		= "front/front_page/dashboard/setting/edit_profile_picture";
		$this->load->view('front/layout', $data);
	}

	function doUpdatePic(){
		$post     	= $this->input->post();

		if(!empty($_FILES['gambar']['name'])){
			// Buat nama file
			$nama_file = 'NZ-'.date('ydmhis').rand(10, 99);

			// Configuration for file upload
			$config['upload_path']          = 'images/nadzir/';
			$config['allowed_types']        = 'jpg|png|jpeg';
			$config['max_size']             = 5000;
			$config['max_width']            = 1000;
			$config['max_height']           = 1000;
			$config['file_name']			= $nama_file;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
	 
			if ( ! $this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
				custom_notif("failed", "Notif", "Periksa kembali file yang akan Anda upload, saran file <b>70px</b> x <b>70px</b> dengan format file JPG, JPEG atau PNG");
				redirect("dashboard/setting/edit_profile_picture");
			}else{
				$data = array('upload_data' => $this->upload->data());
			}

			$updateArray = array(
				"profile_pic"   	=> "images/nadzir/".$this->upload->data('orig_name'),
				"updated_date"     	=> date('Y-m-d H:i:s'),
			);

			// Update Foto Profile
			$update = $this->db->update("nadzir", $updateArray, array("id" => $post['nadzir_id']));

			if ($update) {
				custom_notif("success", "Notif", "Gambar berhasil dirubah");
				redirect("dashboard/setting/edit_profile_picture");
			}else{
				custom_notif("success", "Notif", "Gagal mengubah gambar");
				redirect("dashboard/setting/edit_profile_picture");
			}

		}else{
			custom_notif("failed", "Notif", "Pilih gambar yang akan di upload");
			redirect("dashboard/setting/edit_profile_picture");
		}
	}

	// ============================================ End ============================================//
}