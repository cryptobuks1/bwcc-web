<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Chats extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_chats");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$get_list_chat = $this->M_chats->getData();

		$data['list_chats']	= $get_list_chat;
		$data['web_title'] 	= "Chats";
		$data['content']   	= "admin/chats/list_chats";
		$this->load->view('admin/layout',$data);
	}

	function chatting($chat_id){
		$get_user_chat 		= $this->M_chats->getOneData("id", $chat_id);
		$list_chats_user	= $this->M_chats->getChatsByCondition("chat_id", $chat_id);

		$data['chats_user'] 		= $list_chats_user;
		$data['user_chat']			= $get_user_chat;
		$data['back_link'] 			= base_url('cms/chats');
		$data['web_title'] 			= "Chats User";
		$data['content']   			= "admin/chats/chats_user";
		$this->load->view('admin/layout',$data);
	}

	function sendMessage(){
		$post = $this->input->post();

		$timestamp 			= time('now');
		$decrypt_chat_id 	= encrypt_decrypt("decrypt", $post['chat_code']);
		$get_user_chat 		= $this->M_chats->getOneData("id", $decrypt_chat_id);


		// Update data di tabel chats
		$data = [
			"timestamp" 	=> $timestamp,
			"text"			=> $post['message'],
			"type_user"		=> 1,
		];


		$this->db->update("chat", $data, array("id" => $decrypt_chat_id));


		$data_chat_row = [
			"chat_id"	 	=> $decrypt_chat_id,
			"type_user"		=> 1,
			"text"			=> $post['message'],
			"timestamp" 	=> $timestamp,
		];

		$insert = $this->db->insert("chat_row", $data_chat_row);

		if ($insert) {
			echo "Berhasil";
		}else{
			echo "Gagal";
		}
	}
}