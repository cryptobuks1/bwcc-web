<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Display extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_loket");
		$this->load->model("M_poli");
		$this->load->model("M_pembayaran");
	}

	function index(){
		// $data['front_slider'] 	= array();
		// $data['title']			= "Kita Wakaf - ".$getProgram->name;
		// $data['content']    	= "front/front_page/invoice";
		$this->load->view('front/front_page/front_page');
	}

	function antrian(){
		$getLoket 			= $this->M_loket->getLoketData();

		$data['dataLoket']	= $getLoket;
		$data['title']		= "Display Antrian";
		$data['content']	= "front/front_page/display_antrian";
		$this->load->view('front/layout_display', $data);
	}

	// ====== KiosK ====== //

	function kiosk(){
		$data['title']		= "Galery Antrian";
		$data['content']	= "front/front_page/kiosk/pilih_metode";
		$this->load->view('front/layout_display', $data);
	}

	function pilihPoli(){
		$get_available_poli 	= $this->global->getscheduleByCondition("days", date("N"));
		
		$data['available_poli']	= $get_available_poli;
		$data['title']			= "Galery Antrian";
		$data['content']		= "front/front_page/kiosk/pilih_poli";
		$this->load->view('front/layout_display', $data);
	}

	function pilihdokter($id_poly){
		$get_poli_dokter 	= $this->global->getDokterPoli("id_poly", $id_poly);
		
		$data['list_dokter']	= $get_poli_dokter;
		$data['title']			= "Galery Antrian";
		$data['content']		= "front/front_page/kiosk/pilih_dokter";
		$this->load->view('front/layout_display', $data);
	}

	function metodePembayaran($id_poly, $id_doctor){
		$get = $this->input->get();
		// $id_req_queue = $get['req_queue'];

		$getPoli 	= $this->M_poli->getOneData("id", $id_poly);
		
		// $data['get_req_antrian']	= $id_req_queue;
		$data['id_doctor']			= $id_doctor;
		$data['poli']				= $getPoli;
		$data['title']				= "Galery Antrian";
		$data['content']			= "front/front_page/kiosk/pilih_metode_pembayaran";
		$this->load->view('front/layout_display', $data);
	}

	function getTiket($id_poly, $id_doctor, $payment_method){
		// Untuk Get id schedule
		$get_id_schedule 		= $this->global->getSchedule($id_poly, $id_doctor);
		// Get History Schedule
		$get_history_schedule 	= $this->global->getHistoryReqNew("id_schedule_practice", $get_id_schedule->id);
		// $get_history_schedule 	= $this->global->getHistoryReq("id_schedule_practice", "90E30AB3-D4AF-1D14-CB4E-58BA3DA20C1Z");
		$id = guid();

		if (!$get_history_schedule) {
			$no_antrian 	= $get_id_schedule->poly_code."."."1";
		}else{
			$num 		= preg_replace("/[^0-9]/", '', $get_history_schedule->queue_code) + 1;
			$no_antrian	= $get_id_schedule->poly_code.".".$num;

		}

		$unix_timestamp = time('now');

		$data = [
			"id"					=> $id,
			"id_schedule_practice"	=> $get_id_schedule->id,
			"name"					=> "",
			"id_doctor"				=> $get_id_schedule->id_doctor,
			"tanggal"				=> date("d-m-Y"),
			"queue_code"			=> $no_antrian,
			"id_payment"			=> $payment_method,
			"status"				=> 6,
			"unix_timestamp"		=> $unix_timestamp,
			"created_date"			=> date("Y-m-d H:i:s")
		];

		// Save to table Antrian
		$data_antrian = [
			"id"				=> guid(),
			"id_loket"			=> "",
			"kode_antrian"		=> $no_antrian,
			"req_queue_id"		=> $id,
			"status"			=> 0,
			"created_date"		=> date("Y-m-d H:i:s"),
			"calling_datetime"	=> $unix_timestamp
		];

		$this->db->insert("antrian", $data_antrian);
		// End

		$insert = $this->db->insert("master_req_queue", $data);
		// $insert = true;
		// $insert = true;
		if ($insert) {
			redirect("display/printantrian/".$id);
			// redirect("display/printantrian/13f59510ccdae57be99962a2358690bf");
		}else{
			debugCode("ohh");
		}

	}

	function printAntrian($id){
		$get_history_queue = $this->global->getHistoryReq("id", $id);
		$get_total_antrian = $this->global->getTotalAntrian($get_history_queue->id_schedule_practice);
		// debugCode($get_history_queue);

		$data['total_antrian'] 	= $get_total_antrian;
		$data['history'] 		= $get_history_queue;
		$this->load->view("front/front_page/kiosk/print_antrian", $data);
	}


	// === Check in Online
	function checkin(){
		$data['title']			= "Galery Antrian";
		$data['content']		= "front/front_page/kiosk/check_in_online";
		$this->load->view('front/layout_display', $data);
	}

	function doCheckin(){
		$post	= $this->input->post();

		$get_antrian 	= $this->global->checkin("id", $post['code_queue'], "4"); // 4 artinya pasien bakalan hadir

		if (!$get_antrian) {
			$get_antrian 	= $this->global->checkin("id_booking", $post['code_queue'], "4"); // 4 artinya pasien bakalan hadir
		}

		if (empty($get_antrian)) { // Jika Antrian tidak ada di dua ID
			custom_notif("failed", "notif", "ID Booking tidak ditemukan");
			redirect("display/checkin");
		}

		// Buat ambil kode poli
		$get_history_schedule 	= $this->global->getOnePoliDokter("id", $get_antrian->id_schedule_practice);
		// End

		$id_poly 		= $get_history_schedule->id_poly;
		$id_doctor 		= $get_antrian->id_doctor;
		$id_req_queue	= $post['code_queue'];

		if (!empty($id_poly) && !empty($id_doctor) && !empty($id_req_queue)) {
			redirect("display/checkinpembayaran/".$id_poly."/".$id_doctor."?req_queue=".$id_req_queue);
		}
	}

	function checkinPembayaran($id_poly, $id_doctor){
		$get 		= $this->input->get();
		$getPoli 	= $this->M_poli->getOneData("id", $id_poly);

		$data['get_req_antrian']	= $get['req_queue'];
		$data['id_doctor']			= $id_doctor;
		$data['poli']				= $getPoli;
		$data['title']				= "Galery Antrian";
		$data['content']			= "front/front_page/kiosk/metode_pembayaran_online";
		$this->load->view('front/layout_display', $data);
	}

	function getTiketOnline($id_poly, $id_doctor, $payment_method, $id_req_queue){
		// Untuk Get id schedule
		$get_id_schedule 		= $this->global->getSchedule($id_poly, $id_doctor);
		// $get_id_schedule 	= $this->global->getHistoryReqNew("id_schedule_practice", $id_req_queue);
		// if (!$get_id_schedule) {
		// 	$get_id_schedule 	= $this->global->getHistoryReqNew("id_booking", $id_req_queue);
		// }
		// Get id_schedule
		// Get History Schedule
		$get_history_schedule 	= $this->global->getHistoryReqNew("id_schedule_practice", $get_id_schedule->id);
		// $get_history_schedule 	= $this->global->getHistoryReqNew("id_schedule_practice", $get_id_schedule->id_schedule_practice);
		// Get Request Queue
		$get_antrian 	= $this->global->checkin("id", $id_req_queue, "4"); // 4 artinya pasien bakalan hadir

		if (!$get_antrian) {
			$get_antrian 	= $this->global->checkin("id_booking", $id_req_queue, "4"); // 4 artinya pasien bakalan hadir
		}

		if (empty($get_antrian)) { // Jika Antrian tidak ada di dua ID
			custom_notif("failed", "notif", "ID Booking tidak ditemukan");
			redirect("display/checkin");
		}

		if (!$get_history_schedule) {
			$no_antrian 	= $get_id_schedule->poly_code."."."1";
		}else{
			$num 		= preg_replace("/[^0-9]/", '', $get_history_schedule->queue_code) + 1;
			$no_antrian	= $get_id_schedule->poly_code.".".$num;
		}

		$unix_timestamp = time('now');

		$data = [
			"queue_code"			=> $no_antrian,
			"id_payment"			=> $payment_method,
			"status"				=> 6,
			"unix_timestamp"		=> $unix_timestamp,
			"updated_date"			=> date("Y-m-d H:i:s")
		];

		// Save to table Antrian
		$data_antrian = [
			"id"				=> guid(),
			"id_loket"			=> "",
			"kode_antrian"		=> $no_antrian,
			"req_queue_id"		=> $get_antrian->id,
			"status"			=> 0,
			"created_date"		=> date("Y-m-d H:i:s"),
			"calling_datetime"	=> $unix_timestamp
		];

		$this->db->insert("antrian", $data_antrian);
		// End

		// Update Data Antrian
		$update = $this->db->update("master_req_queue", $data, array("id" => $get_antrian->id));
		// $update = true;
		if ($update) {
			redirect("display/checkinsuccess");
		}else{
			debugCode("ohh");
		}

	}

	function checkinSuccess(){
		$data['title']		= "Check In Success";
		$data['content']	= "front/front_page/kiosk/check_in_sukses_online";
		$this->load->view('front/layout_display', $data);	
	}

	// ====== End ====== //	

	

}