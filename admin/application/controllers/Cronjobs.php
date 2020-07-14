<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronjobs extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->load->model("M_cronjobs");
	}

	public function index()
	{
		echo 'naon ?';
	}

	public function run_autocancel_book()
	{	

		$get_cron_book = $this->M_cronjobs->get_book_list();
		$json_result = json_encode($get_cron_book);

		// echo '<pre>';
		// print_r($get_cron_book);
		// die();

		foreach ($get_cron_book as $val_data) {
			echo "<br>";

			echo "jam booking : ".date('Y-m-d H:i:s' , $val_data['req_time']);

			echo "<br>";

			// jam booking + 2 jam

			$booking_limit = date('Y-m-d H:i:s' , $val_data['req_time'] + 900);
			// $booking_limit = date('Y-m-d H:i:s' , $val_data['updated_date']+300);

			echo "jam booking + 2jam : ".$booking_limit;

			echo "<br>";

			// get time now

			$date_now = date('Y-m-d H:i:s');

			echo "jam sekarang : ".$date_now;

			echo "<br><br><br><br>";

			if ($date_now > $booking_limit) {
				// set null payment status yang 2 jadi null 
				// reject dengan status 11 if booking not paid ampe 2 jam kedepan	

				// update jdi null lagi
				$data_pay_status = array(
					"payment_status" => NULL
					);

				$this->db->where('id', $val_data['booking_id']);
    			$this->db->update('master_req_queue', $data_pay_status);

    			$this->db->where('id', $val_data['booking_id']);
				// get schedule practice 
				$get_mrq_sp = $this->db->get('master_req_queue')->row();
    			// set null patient_id
    			$arr_update_mps = array(
					"patient_id"	=> NULL
				);
				$this->db->update("master_practice_schedule", $arr_update_mps, array("id" => $get_mrq_sp->id_schedule_practice));

				

				// insert
				$data_cancel_status = array(
					"req_id" => $val_data['booking_id'],
					"status" => 'PAYMENT NOT RECEIVED. BOOKING REJECT AUTOMATICALLY',
					"kode" => 11,
					"time" => date('Y-m-d H:i:s')
				);

				$insert	= $this->db->insert("master_req_queue_status", $data_cancel_status);

				$queue_autcancel_booking = array(
					"booking_id" => $val_data['booking_id'],
					"status" => 'autocancel',
					"created_date" => date('Y-m-d H:i:s')
				);

				$this->db->insert("queue_autocancel_booking", $queue_autcancel_booking);


				$this->db->where('id', $val_data['booking_id']);
				$get_mrq_sp = $this->db->get('master_req_queue')->row();
				$getuser = $this->global->getUserApi($get_mrq_sp->created_by);

				$this->sendPushNotif(
						        $getuser->token_notification, 
						        'BWCC - Booking Information',
						        "Your Payment has not been Received. Booking Was Cancel Automatically");

				echo "cancel book dengan booking id : ".$val_data['booking_id'];
				echo "<br>";
			}
			else
			{
				echo "book tetap jalan dengan booking id : ".$val_data['booking_id'];
				echo "<br>";
			}

			echo "<br>";
			echo "booking id : ".$val_data['booking_id'];

		}

		

    	// return $this->response->withJson(['status' => 'Success' , 'data' => $result]);

	}

	public function run_autocancel_booking_class()
	{
		$databooking = $this->M_cronjobs->get_bookingclass_list();

		foreach ($databooking->result_array() as $val_data) {
			echo "<br>";

			echo "jam booking : ".$val_data['updated_date'];

			echo "<br>";

			// jam booking + 2 jam

			// $booking_limit = date($val_data['updated_date'] , +7200);

			$booking_limit = strtotime($val_data['updated_date']);
			$datecurve = $booking_limit + 900;
			$total_time = date('Y-m-d H:i:s', $datecurve);


			// $booking_limit = date('Y-m-d H:i:s' , $val_data['updated_date']+300);

			echo "jam booking + 2 jam : ".$total_time;

			echo "<br>";

			// get time now

			$date_now = date('Y-m-d H:i:s');

			echo "jam sekarang : ".$date_now;

			echo "<br><br><br><br>";

			if ($date_now > $total_time) {
				// execute autocandel
				$newid = md5(sha1(date('Y-m-d H:i:s')));

				// 8 = automatic cancel if user not paid
				$dataupdate_class_book = array(
					"status" => 8,
					"updated_date" => date('Y-m-d H:i:s')
				);

				$this->db->update('class_booking' , $dataupdate_class_book , array("id" => $val_data['id']));

				$dataupdate_class_book_notif = array(
					"id" => $newid,
					"id_class_booking" => $val_data['id'],
					"notification_value" => "YOUR BOOKING AUTOMATICALLY CANCEL BY SYSTEM",
					"created_date" => date('Y-m-d H:i:s')
				);

				$this->db->insert('class_booking_notification' , $dataupdate_class_book_notif);

				// notif to android
				// back quota to instructor

				$this->db->where('id' , $val_data['id']);
				$check_bookingclass = $this->db->get('class_booking');

				if ($check_bookingclass->num_rows() == 0) {

				}
				else
				{
					// comeback quota to instructor
					$idschedule_classbook = $check_bookingclass->row(); 
					// $idschedule_classbook->id_schedule
					$this->db->where('id', $idschedule_classbook->id_schedule);
					$get_schedule_classinfo = $this->db->get('schedule_class')->row();
					// $get_schedule_classinfo->id_schedule_instructor

					$this->db->where('id', $get_schedule_classinfo->id_schedule_instructor);
					$get_dataquota_ins = $this->db->get('schedule_instructor')->row();

					// increase quota / balikan quouta

					$inc_quota = $get_dataquota_ins->quota_remain + 1;

					$update_qouta = $this->db->update("schedule_instructor", array('quota_remain' => $inc_quota) , array("id" => $get_schedule_classinfo->id_schedule_instructor));

					if ($update_qouta) {

					$dataclass = $check_bookingclass->row();

					$getuser = $this->global->getUserApiById($dataclass->created_by);

					$this->sendPushNotif(
							        $getuser->token_notification, 
							        'BWCC - Booking Information',
							        "Payment For Your Booking Class Not Received. Booking Class Was Cancel Automatically");
						
					}
					else{
					}
				}

				echo "cancel book dengan booking id : ".$val_data['id'];
				echo "<br>";
			}
			else
			{
				echo "book tetap jalan dengan booking id : ".$val_data['id'];
				echo "<br>";
			}
		}
	}

	function run_reminder_visit() {
		$date_now = date('Y-m-d');
		$time_now = date('H:i', strtotime('+1 hour'));

		$this->db->select('a.*, b.id as req_id, c.name as doctor_name');
		$this->db->where("a.date LIKE '%".$date_now."%'");
		$this->db->where("a.start_time_service LIKE '%".$time_now."%'");
		$this->db->where("a.patient_id IS NOT NULL");
		$this->db->from('master_practice_schedule a');
		$this->db->join('master_req_queue b', 'a.id = b.id_schedule_practice');
		$this->db->join('master_doctor c', 'a.id_doctor = c.id');
        $schedules = $this->db->get()->result();

        echo "Found : ".count($schedules)." schedules at ".$date_now." ".$time_now.".";
        echo "<br>";

        foreach ($schedules as $schedule) {
        	$this->db->where('req_id', $schedule->req_id);
        	$this->db->order_by('kode', 'DESC');
        	$this->db->limit(1);
			$status = $this->db->get('master_req_queue_status')->row();

			if($status && $status->kode == 6) {
				$this->db->where('id', $schedule->patient_id);
				$patient = $this->db->get('patient')->row();

	        	$getuser = $this->global->getUserApiById($patient->created_by);
	        	if($getuser->token_notification != NULL) {
	        		$date_only = date('Y-m-d', strtotime($schedule->date));
	        		$date_time = date('d-m-Y H:i', strtotime($date_only.' '.$schedule->start_time_service));
	        		$this->sendPushNotif(
			        	$getuser->token_notification, 
				        'BWCC - Booking Information',
				        "Dear ".$patient->nama." you are currently scheduled to ".$schedule->doctor_name." at ".$date_time."");

		        	echo "Dear ".$patient->nama." you are currently scheduled to ".$schedule->doctor_name." at ".$date_time."".$getuser->token_notification;
		        	
					echo "<br>";
	        	}
	        	
			}
        }
	}


	function sendPushNotif($req_id, $title, $message) {
	    
	    // Send notif
		$this->load->library("fcm");
	    $server_key = 'AAAA12XJNjM:APA91bEdbVFUJJzNt8Z1IpGhgTf5s36QWg6lnngsdAq5zgHLnYSYGhZkX3_rttky4Svl29GEcoPuhl1D6iVREJq4Q23FoPa6DX6gOzO2F8AcapyMP7d6RoCUA4UMb9e8FOuExS41B6yE';
	    $target = array($req_id);
	    $pesan  = array('title'     	=> $title,
			            'body'      	=> $message,
			            'icon'     		=> '',
			            'sound'      	=> 'default',
			            'click_action'  => ''  
	            	);

	    $send = $this->fcm->sendMessage($pesan, $target, $server_key);
	    // End
	}

	
}
