<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Bookingclass extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_bookingclass");
		$this->load->model("M_groupmodule");
		$this->load->library('user_agent');
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Bookingclass";
		$data['content']   = "admin/bookingclass/listBookingclass";
		$this->load->view('admin/layout',$data);
	}

	function approve_booking_class($id)
	{
		$this->db->where('id' , $id);
		$check_bookingclass = $this->db->get('class_booking');

		if ($check_bookingclass->num_rows() == 0) {
			redirect('/cms/bookingclass');
		}
		else
		{
			$data_change = array(
				"status" => 2,
				"updated_date" => date('Y-m-d H:i:s')
			);

			$update = $this->db->update("class_booking", $data_change, array("id" => $id));

			// insert_notif
			$insertnotifdata = array(
				"id" => guid(),
				"id_class_booking" => $id,
				"notification_value" => "Booking Accepted! waiting for payment",
				"created_date" => date('Y-m-d H:i:s')
			);

			$updatedata_notif = $this->db->insert('class_booking_notification', $insertnotifdata);

			if ($update && $updatedata_notif) {
				// sendnotif
			$dataclass = $check_bookingclass->row();

			$getuser = $this->global->getUserApiById($dataclass->created_by);

			$this->sendPushNotif(
					        $getuser->token_notification, 
					        'BWCC - Booking Information',
					        "Your Booking Class Received. Please make a payment for resume your booking class");

				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/bookingclass");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/bookingclass/");
			}
		}
	}

	function reject_booking_class($id)
	{
		$this->db->where('id' , $id);
		$check_bookingclass = $this->db->get('class_booking');

		if ($check_bookingclass->num_rows() == 0) {
			redirect('/cms/bookingclass');
		}
		else
		{
			$data_change = array(
				"status" => 0,
				"updated_date" => date('Y-m-d H:i:s')
			);

			$update = $this->db->update("class_booking", $data_change, array("id" => $id));

			// insert_notif
			$insertnotifdata = array(
				"id" => guid(),
				"id_class_booking" => $id,
				"notification_value" => "Booking Rejected! contact admin for information",
				"created_date" => date('Y-m-d H:i:s')
			);

			$updatedata_notif = $this->db->insert('class_booking_notification', $insertnotifdata);

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

			if ($update && $updatedata_notif && $update_qouta) {

			$dataclass = $check_bookingclass->row();

			$getuser = $this->global->getUserApiById($dataclass->created_by);

			$this->sendPushNotif(
					        $getuser->token_notification, 
					        'BWCC - Booking Information',
					        "Your Booking Was Canceled. Please contact administrator for more information");

				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/bookingclass");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/bookingclass/");
			}
		}
	}

	public function get_list_Bookingclass(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_bookingclass->get_list_Bookingclass ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_bookingclass->get_list_Bookingclass ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_bookingclass->get_list_Bookingclass ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_bookingclass->get_list_Bookingclass ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){

			$rowData = array();
			$button = "";

			if ($value->stat_classbook == 0) {
				$sta_clasbook = '<span class="badge badge-pill badge-danger">Booking Class Reject By Admin</span>';

				$button .= '
				';
			}
			elseif ($value->stat_classbook == 1) {
				$sta_clasbook = '<span class="badge badge-pill badge-primary">Waiting for Admin Confirmation</span>';

				$button .= '
					<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="'.base_url('cms/bookingclass/approve_booking_class/'.$value->id).'"><i class="fa fa-check"></i> Approve Class Booking</a>
								<a class="dropdown-item" href="'.base_url('cms/bookingclass/reject_booking_class/'.$value->id).'"><i class="fa fa-calendar"></i> Reject Class Booking</a>
							</div>
						</div>
				';
			}
			elseif ($value->stat_classbook == 2) {
				$sta_clasbook = '<span class="badge badge-pill badge-warning">Waiting payment from user</span>';

				$button .= '
					
				';
			}
			elseif ($value->stat_classbook == 3) {
				$sta_clasbook = '<span class="badge badge-pill badge-primary">Payment Received. Please check evidence</span>';

				$button .= '
					<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#view_payment_'.$value->id.'"><i class="fa fa-check"></i> View Payment Evidence</a>

								<a class="dropdown-item" href="'.base_url('cms/bookingclass/payment_approval/accept/'.$value->id).'"><i class="fa fa-check"></i> Accepted Payment</a>

								<a class="dropdown-item" href="'.base_url('cms/bookingclass/payment_approval/reject/'.$value->id).'"><i class="fa fa-calendar"></i> Reject Payment</a>

								<a class="dropdown-item" href="'.base_url('cms/bookingclass/reject_booking_class/'.$value->id).'"><i class="fa fa-calendar"></i> Reject Class Booking</a>
							</div>
						</div>

						<div class="modal fade" id="view_payment_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Payment From User</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<img class="img-fluid" alt="Responsive image" src="http://bwcc.inovasialfatih.com/api/'.$value->payment_attached.'">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
				';
			}

			elseif ($value->stat_classbook == 5) {
				$sta_clasbook = '<span class="badge badge-pill badge-success">Booking Success Accepted</span>';

				$img_src = 'http://bwcc.inovasialfatih.com/api/'.$value->payment_attached.'';
				$function = "printImg('$img_src')";

				$image_print = '<button type="button" class="btn btn-primary" onClick="' . $function . '">Print</button>';

				$button .= '
					<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#view_payment_'.$value->id.'"><i class="fa fa-check"></i> View Payment Evidence</a>

								<a class="dropdown-item" href="'.base_url('cms/bookingclass/change_schedule_classbook/'.$value->id).'"><i class="fa fa-calendar"></i> Change Schedule Class Booking</a>

								<a class="dropdown-item" href="'.base_url('cms/bookingclass/reject_booking_class/'.$value->id).'"><i class="fa fa-calendar"></i> Reject Class Booking</a>
							</div>
						</div>

						<div class="modal fade" id="view_payment_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Payment From User</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<img class="img-fluid" alt="Responsive image" src="http://bwcc.inovasialfatih.com/api/'.$value->payment_attached.'">
									</div>
									<div class="modal-footer">
									'.$image_print.'
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
				';
			}

			elseif ($value->stat_classbook == 4) {
				$sta_clasbook = '<span class="badge badge-pill badge-warning">Payment Rejected ! Waiting user reupload payment</span>';

				$button .= '
					<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="#" data-toggle="modal" data-target="#view_payment_'.$value->id.'"><i class="fa fa-check"></i> View Payment Previous</a>

								

								<a class="dropdown-item" href="'.base_url('cms/bookingclass/reject_booking_class/'.$value->id).'"><i class="fa fa-calendar"></i> Reject Class Booking</a>
							</div>
						</div>

						<div class="modal fade" id="view_payment_'.$value->id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" style="display: none;" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLabel">Payment From User</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">×</span>
										</button>
									</div>
									<div class="modal-body">
										<img class="img-fluid" alt="Responsive image" src="http://bwcc.inovasialfatih.com/api/'.$value->payment_attached.'">
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
				';
			}
			elseif ($value->stat_classbook == 6) {
				$sta_clasbook = '<span class="badge badge-pill badge-warning">Booking Class Rejected By User</span>';

				$button .= '
					
				';
			}
			elseif ($value->stat_classbook == 7) {
				$sta_clasbook = '<span class="badge badge-pill badge-warning">Waiting User Choose Another Class</span>';

				$button .= '
					
				';
			}
			elseif ($value->stat_classbook == 8) {
				$sta_clasbook = '<span class="badge badge-pill badge-danger">Payment Not Received! Booking Cancel Automatically</span>';

				$button .= '
					
				';
			}
			

			$rowData[] = $no++;
			$rowData[] = $value->patient_name;
			$rowData[] = $value->class_name;
			$rowData[] = $value->instructor_name;
			$rowData[] = ''.$value->ins_start_date.' | '.$value->ins_start_time.' - '.$value->ins_finish_time.'';
			$rowData[] = $sta_clasbook;
			$rowData[] = $value->date_make_book;
			$rowData[] = $button;
			
			$listData[] = $rowData;
			
			$json_data = array (
				"draw"            => intval ( $requestParam ['draw'] ), // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
				"recordsTotal"    => intval ( $totalAllData ), // total number of records
				"recordsFiltered" => intval ( $totalDataFiltered ), // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => $listData 
			); // total data array
		}
		if(empty($json_data)){
			$json_data = array (
				"draw"            => 0, // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
				"recordsTotal"    => 0, // total number of records
				"recordsFiltered" => 0, // total number of records after searching, if there is no searching then totalFiltered = totalData
				"data"            => ""
			); // total data array
		}
		header ( 'Content-Type: application/json;charset=utf-8' );
		echo json_encode ($json_data);
		
		die();
	}

	function payment_approval($param1 , $param2)
	{

		if ($param1 == 'accept') {
			$update_payment = array(
				"status" => 5,
				"updated_date" => date('Y-m-d H:i:s')
			);

			$update_dataclassbooking = $this->db->update('class_booking' , $update_payment , array('id' => $param2));

			// notification 
			$datanotif = array(
				"id" => md5(sha1(date('Y-m-d H:i:s'))),
				"id_class_booking" => $param2,
				"notification_value" => "Booking Class Accepted ! Success.",
				"created_date" => date('Y-m-d H:i:s')
			);

			$update_notif_dataclass = $this->db->insert('class_booking_notification', $datanotif);

			if ($update_dataclassbooking && $update_notif_dataclass) {

			$this->db->where('id', $param2);
			$check_bookingclass = $this->db->get('class_booking');

			$dataclass = $check_bookingclass->row();

			$getuser = $this->global->getUserApiById($dataclass->created_by);

			$this->sendPushNotif(
					        $getuser->token_notification, 
					        'BWCC - Booking Information',
					        "Your payment was received. Booking class success");


				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/bookingclass");
			}
			else
			{
				return 'data invalid ! try again';
			}

		}
		elseif ($param1 == 'reject') {
			$update_payment = array(
				"status" => 4,
				"updated_date" => date('Y-m-d H:i:s')
			);

			$update_dataclassbooking = $this->db->update('class_booking' , $update_payment , array('id' => $param2));

			// notification 
			$datanotif = array(
				"id" => md5(sha1(date('Y-m-d H:i:s'))),
				"id_class_booking" => $param2,
				"notification_value" => "Payment Booking Class Rejected ! Reupload payment.",
				"created_date" => date('Y-m-d H:i:s')
			);

			$update_notif_dataclass = $this->db->insert('class_booking_notification', $datanotif);

			if ($update_dataclassbooking && $update_notif_dataclass) {

			$this->db->where('id', $param2);
			$check_bookingclass = $this->db->get('class_booking');

			$dataclass = $check_bookingclass->row();

			$getuser = $this->global->getUserApiById($dataclass->created_by);

			$this->sendPushNotif(
					        $getuser->token_notification, 
					        'BWCC - Booking Information',
					        "Your payment was rejected. Please check your payment evidence and try again");

				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/bookingclass");
			}
			else
			{
				return 'data invalid ! try again';
			}
		}
		else
		{
			return 'invalid request ! try again';
		}

	}

	function change_schedule_classbook($id)
	{
		$this->db->where('id' , $id);
		$check_bookingclass = $this->db->get('class_booking');

		if ($check_bookingclass->num_rows() == 0) {
			redirect('/cms/bookingclass');
		}
		else
		{
			$data_change = array(
				"status" => 7,
				"updated_date" => date('Y-m-d H:i:s')
			);

			$update = $this->db->update("class_booking", $data_change, array("id" => $id));

			// insert_notif
			$insertnotifdata = array(
				"id" => guid(),
				"id_class_booking" => $id,
				"notification_value" => "Your Schedule Class Was Changed. Please Select Another Class",
				"created_date" => date('Y-m-d H:i:s')
			);

			$updatedata_notif = $this->db->insert('class_booking_notification', $insertnotifdata);

			if ($update && $updatedata_notif) {
				// sendnotif
			$dataclass = $check_bookingclass->row();

			$getuser = $this->global->getUserApiById($dataclass->created_by);

			$this->sendPushNotif(
					        $getuser->token_notification, 
					        'BWCC - Booking Information',
					        "Your Schedule Class Was Changed. Please Select Another Class");

				$this->session->set_flashdata('is_success', 'Yes');
				redirect("cms/bookingclass");
			}else{
				$this->session->set_flashdata('is_success', 'No');
				redirect("cms/bookingclass/");
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