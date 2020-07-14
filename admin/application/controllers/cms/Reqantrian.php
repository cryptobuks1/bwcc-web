<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReqAntrian extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_reqantrian");
		// $this->load->model("M_spesialis");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
		$data['web_title'] = "Books";
		$data['content']   = "admin/request_antrian/list_req_antrian";
		$this->load->view('admin/layout',$data);
	}


	function view_result_search()
	{	
		$post = $this->input->post();
		$return_date_selected = date('Y-m-d' , strtotime($post['date_selected']));

		$data['date_search'] = $return_date_selected;
		$data['web_title']   = "Result Search";
		$data['content']     = "admin/request_antrian/search_result";
		$this->load->view('admin/layout',$data);
	}

	function search_booking($param_date)
	{	

		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_reqantrian->search_result_by_date ($param_date, $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_reqantrian->search_result_by_date ($param_date, $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_reqantrian->search_result_by_date ($param_date, $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_reqantrian->search_result_by_date ($param_date, $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		} 
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();

			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$button = "";
			

			$status = $this->M_reqantrian->get_last_status($value->booking_id);
			$string_status = "";
			if ($status->kode == 0) {
				$string_status .= '<span class="badge badge-pill badge-warning">Waiting for Admin Approval</span>';
				$button .= '
						<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/approve_booking/'.$value->booking_id).'"><i class="fa fa-check"></i> Approve Booking</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							</div>
						</div>
					';
			}else if ($status->kode == 4) {				

				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-warning">WAITING FOR PAYMENT APPROVAL</span>';
				$button .= '
						<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a data-toggle="modal" href="#exampleModalLong_'.$value->booking_id.'" class="dropdown-item" "><i class="fa fa-check"></i> Show Payment Receipt</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/approve_payment/'.$value->booking_id).'"><i class="fa fa-check"></i> Approve Payment</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_payment/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Payment</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							</div>
						</div>

						<div class="modal fade" id="exampleModalLong_'.$value->booking_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Payment Receipt</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<img src="'.$img_src.'" width="100%">

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					';
			}

			elseif($status->kode == 6)
			{
				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-success">BOOKING IS SUCCESS</span>';

				$function = "printImg('$img_src')";

				$image_print = '<a type="button" class="btn btn-primary" onClick="' . $function . '">Print</a>';

				$button .='

				<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a data-toggle="modal" href="#exampleModalLong_'.$value->booking_id.'" class="dropdown-item" "><i class="fa fa-check"></i> Show Payment Receipt</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/cancel_schedule/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Cancel Schedule</a>
							</div>
						</div>

						<div class="modal fade" id="exampleModalLong_'.$value->booking_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Payment Receipt</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<img src="'.$img_src.'" width="100%">

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
			elseif($status->kode == 12)
			{
				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-danger">SCHEDULE CANCELED</span>';
			}
			elseif($status->kode == 17)
			{
				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-danger">BOOKING CANCELED</span>';
			}
			else{
				$button_reject_standard = '
						<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							</div>
						</div>
					';

				$button_reject_payment = '
					<div class="btn-group">
						<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Action
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_payment/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
						</div>
					</div>
				';
				$button_reject_payment_and_booking = '
					<div class="btn-group">
						<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Action
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_payment/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
						</div>
					</div>
				';


					switch ($status->kode) {
						case 1:
							$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';
							$button .=$button_reject_standard;
							break;
						case 2:
							$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';
							$button .=$button_reject_standard;
							break;
						case 3:
							$string_status .= '<span class="badge badge-pill badge-warning">'.$status->status.'</span>';							
							$button .=$button_reject_payment_and_booking;						
							break;
						case 5:
							$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';							
							// $button .=$button_reject_payment_and_booking;
							break;
						case 6:
						$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';							
							break;
						case 7:
						$string_status .= '<span class="badge badge-pill badge-danger">'.$status->status.'</span>';

							break;	
						case 8:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;	
						case 9:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;	
						case 10:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;																																			
						case 11:
							$string_status .= '<span class="badge badge-pill badge-danger">'.$status->status.'</span>';
							break;	
						case 12:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;	
						default:
							$status .= 'Hayati Lelah';
					}
			}

			// switch ($value->status) {
			//     case 0:
			//         $status .= '<span class="badge badge-pill badge-warning">Menunggu Konfirmasi</span>';
			//         break;
			//     case 2:
			//         $status .= '<span class="badge badge-pill badge-success">Approve</span>';
			//         break;
			//     case 3:
			//         $status .= '<span class="badge badge-pill badge-danger">Cancel</span>';
			// 				break;
			// 		case 4:
			// 			$status .= '<span class="badge badge-pill badge-success">Konfirmasi Kehadiran Pasien</span>';
			// 			break;
			// 		case 6:
			// 			$status .= '<span class="badge badge-pill badge-info">Mendapatkan nomor antrian</span>';
			// 			break;
			//     default:
			//         $status .= 'Hayati Lelah';
			// }
			/*========================================= END BUTTON STUFF =========================================*/

			$rowData[] = '<a class="dropdown-item" href="'.base_url('cms/reqantrian/details/'.$value->booking_id).'">'.$no++.'<a>';
			$rowData[] = $value->patient_name;
			$rowData[] = $value->doctor_name;
			
			$rowData[] =  date('D, d-m-Y H:i:s', $value->req_time);
			$rowData[] =  date('Y-m-d', strtotime($value->s_date))." (".$value->s_time_start."-".$value->s_time_finish.")";
			$rowData[] = $value->poly_name;
			$rowData[] = $value->payment_method;
			$rowData[] = $string_status;
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


	function approve($id){
		// Get User from table master_req_queue
		$get_req_queue	= $this->M_reqantrian->getOneData("id", $id);
		// Get token fcm user for send notif
		$getTokenUser	= $this->global->getUserApi($get_req_queue->created_by);

		$kode_unik_booking 	= date("Ymd").rand(1, 999);
		
		$updateArray = array(
			"id_booking"	=> $kode_unik_booking,
			"status"   		=> "4",
			"booking_code"	=> $kode_unik_booking,
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_req_queue", $updateArray, array("id" => $id));
		// $update = true;

		if ($update) {

		// Send notif
		$this->load->library("fcm");
	    $server_key = 'AAAA12XJNjM:APA91bEdbVFUJJzNt8Z1IpGhgTf5s36QWg6lnngsdAq5zgHLnYSYGhZkX3_rttky4Svl29GEcoPuhl1D6iVREJq4Q23FoPa6DX6gOzO2F8AcapyMP7d6RoCUA4UMb9e8FOuExS41B6yE';
	    $target = array($getTokenUser->token_notification);
	    $pesan  = array('title'     	=> 'Informasi Pasien',
			            'body'      	=> "Request tiket online sudah kami setujui silahkan cek kode booking di apps Anda, Terima Kasih.",
			            'icon'     		=> '',
			            'sound'      	=> '',
			            'click_action'  => ''  
	            	);

	    $send = $this->fcm->sendMessage($pesan, $target, $server_key);
	    // End

			custom_notif("success", "Notif", "Approve Berhasil");
			redirect("cms/reqantrian");
		}else{
			custom_notif("failed", "Notif", "Gagal");
			redirect("cms/reqantrian");
		}
	}

	function reject($id){
		$updateArray = array(
			"status"   		=> "3",
			"updated_date"  => date('Y-m-d H:i:s'),
			"updated_by"    => $this->sessionData['user_id']
		);

		$update = $this->db->update("master_req_queue", $updateArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "Reject Berhasil");
			redirect("cms/reqantrian");
		}else{
			custom_notif("failed", "Notif", "Gagal");
			redirect("cms/reqantrian");
		}
	}

	function approve_booking($id){
		$batas_waktu = 3600*24;

		$insertArray = array(
			"req_id"		=> $id,
			"status" => "ADMIN APPROVE BOOKING",
			"kode"	=> "1"
		);

		$insert	= $this->db->insert("master_req_queue_status", $insertArray);
		
		if ($insert) {
			// insert again 
			$insertArray = array(
				"req_id"		=> $id,
				"status" => "WAITING FOR PAYMENT",
				"kode"	=> "2",
				"batas_waktu" => date("Y-m-d H:i:s", strtotime(date('Y-m-d H:i:s'))+$batas_waktu),
			);
			$insert	= $this->db->insert("master_req_queue_status", $insertArray);

			$data_status_queue = array(
                    'payment_status' => 2
                );

			$this->db->where('id', $id);
    		$this->db->update('master_req_queue', $data_status_queue);

			if ($insert) {
			    $this->sendPushNotif(
			        $id, 
			        'BWCC - Booking Information',
			        "Your request has been approved, please upload your payment receipt. Thank you.");
			    
				custom_notif("success", "Notif", "APPROVE BOOKING SUCCESS, WAITING FOR USER PAYMENT");
				redirect("cms/reqantrian/");	
			}else{
				custom_notif("success", "failed", "ERROR BOOKING APPROVAL");
				redirect("cms/reqantrian/");	
			}

		}else{
			custom_notif("success", "failed", "ERROR BOOKING APPROVAL");
			redirect("cms/reqantrian/");
		}
	}

	function reject_booking($id){

		$insertArray = array(
			"req_id"		=> $id,
			"status" => "ADMIN REJECT BOOKING",
			"kode"	=> "11"
		);

		$insert	= $this->db->insert("master_req_queue_status", $insertArray);

		// get master req queue

		$this->db->where('id', $id);
		// get schedule practice 
		$get_mrq_sp = $this->db->get('master_req_queue')->row();
		// set patient_id null from master req queue

		$updateArray = array(
			"patient_id"	=> NULL
		);
		$this->db->update("master_practice_schedule", $updateArray, array("id" => $get_mrq_sp->id_schedule_practice));


		$this->db->where('kode', 0);
		$this->db->where('req_id', $id);
		$this->db->delete('master_req_queue_status');

		$this->db->where('id', $id);
		$this->db->update('master_req_queue', array('view_seq' => 1));

		if ($insert) {
		    $this->sendPushNotif(
			        $id, 
			        'BWCC - Booking Information',
			        "Sorry! Your request has been rejected.");
			        
			custom_notif("success", "Notif", "REJECT BOOKING SUCCESS,");
			redirect("cms/reqantrian/");
		}else{
			custom_notif("success", "failed", "ERROR BOOKING REJECTION");
			redirect("cms/reqantrian/");
		}
	}

	function approve_payment($id){

		$insertArray = array(
			"req_id"		=> $id,
			"status" => "ADMIN APPROVE BOOKING PAYMENT",
			"kode"	=> "5"
		);

		$insert	= $this->db->insert("master_req_queue_status", $insertArray);

		$insertArray = array(
			"req_id"		=> $id,
			"status" => "BOOKING IS SUCCESS",
			"kode"	=> "6"
		);

		$this->db->where('kode', 0);
		$this->db->where('req_id', $id);
		$this->db->delete('master_req_queue_status');

		$insert	= $this->db->insert("master_req_queue_status", $insertArray);

		$this->db->where('id', $id);
		$this->db->update('master_req_queue', array('view_seq' => 1));

		if ($insert) {
		    $this->sendPushNotif(
		        $id, 
		        'BWCC - Booking Information',
		        "Booking Success. Your payment has been approved. Thank you.");
			        
			custom_notif("success", "Notif", "APPROVE PAYMENT BOOKING SUCCESS, BOOKING DONE");
			redirect("cms/reqantrian/");	
		}else{
			custom_notif("success", "failed", "ERROR BOOKING PAYMENT APPROVAL");
			redirect("cms/reqantrian/");	
		}
	}

	function reject_payment($id){

		$insertArray = array(
			"req_id"		=> $id,
			"status" => "ADMIN REJECT BOOKING PAYMENT",
			"kode"	=> "7"
		);

		$insert	= $this->db->insert("master_req_queue_status", $insertArray);

		$this->db->where('kode', 0);
		$this->db->where('req_id', $id);
		$this->db->delete('master_req_queue_status');

		$this->db->where('id', $id);
		$this->db->update('master_req_queue', array('view_seq' => 1));

		if ($insert) {
		    $this->sendPushNotif(
		        $id, 
		        'BWCC - Booking Information',
		        "Sorry, your payment has been rejected.");
		        
			custom_notif("success", "Notif", "REJECT PAYMENT BOOKING SUCCESS, BOOKING CANCEL");
			redirect("cms/reqantrian/");	
		}else{
			custom_notif("success", "failed", "ERROR BOOKING PAYMENT REJECTION");
			redirect("cms/reqantrian/");	
		}
	}

	// change status to 12 = schedule cancel

	function cancel_schedule($id){

		$insertArray = array(
			"req_id"		=> $id,
			"status" => "SCHEDULE WAS CANCELED",
			"kode"	=> "12"
		);

		$insert	= $this->db->insert("master_req_queue_status", $insertArray);

		$this->db->where('kode', 11);
		$this->db->where('req_id', $id);
		$this->db->delete('master_req_queue_status');

		// set patient_id null

		if ($insert) {
		    $this->sendPushNotif(
			        $id, 
			        'BWCC - Booking Information',
			        "Sorry! Your schedule was cancel.");
			        
			custom_notif("success", "Notif", "SCHEDULE CANCEL SUCCESS,");
			redirect("cms/reqantrian/");
		}else{
			custom_notif("success", "failed", "ERROR BOOKING REJECTION");
			redirect("cms/reqantrian/");
		}
	}

	/*==================================================== DATA FOR DATATABLE ====================================================*/
	public function get_list_req_antrian(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_reqantrian->get_list_req_antrian ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_reqantrian->get_list_req_antrian ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_reqantrian->get_list_req_antrian ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_reqantrian->get_list_req_antrian ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		} 
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			$rowData = array();

			/*========================================= BEGIN BUTTON STUFF =========================================*/
			$button = "";
			// $button .= '
			// 			<div class="btn-group">
			// 			  <button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			// 			    Action
			// 			  </button>
			// 			  <div class="dropdown-menu">
			// 			    <a class="dropdown-item" href="'.base_url('cms/reqantrian/approve/'.$value->id).'"><i class="fa fa-check"></i> Approve</a>
			// 			    <a class="dropdown-item" href="'.base_url('cms/reqantrian/reject/'.$value->id).'"><i class="fa fa-calendar"></i> Reject</a>
			// 			  </div>
			// 			</div>
			// 		';

			$status = $this->M_reqantrian->get_last_status($value->booking_id);
			$string_status = "";
			if ($status->kode == 0) {
				$string_status .= '<span class="badge badge-pill badge-warning">Waiting for Admin Approval</span>';
				$button .= '
						<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/approve_booking/'.$value->booking_id).'"><i class="fa fa-check"></i> Approve Booking</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							</div>
						</div>
					';
			}else if ($status->kode == 4) {				

				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-warning">WAITING FOR PAYMENT APPROVAL</span>';
				$button .= '
						<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a data-toggle="modal" href="#exampleModalLong_'.$value->booking_id.'" class="dropdown-item" "><i class="fa fa-check"></i> Show Payment Receipt</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/approve_payment/'.$value->booking_id).'"><i class="fa fa-check"></i> Approve Payment</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_payment/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Payment</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							</div>
						</div>

						<div class="modal fade" id="exampleModalLong_'.$value->booking_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Payment Receipt</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<img src="'.$img_src.'" width="100%">

									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
									</div>
								</div>
							</div>
						</div>
					';
			}
			elseif($status->kode == 6)
			{
				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-success">BOOKING IS SUCCESS</span>';

				$function = "printImg('$img_src')";

				$image_print = '<a type="button" class="btn btn-primary" onClick="' . $function . '">Print</a>';

				$button .='

				<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a data-toggle="modal" href="#exampleModalLong_'.$value->booking_id.'" class="dropdown-item" "><i class="fa fa-check"></i> Show Payment Receipt</a>
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/cancel_schedule/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Cancel Schedule</a>
							</div>
						</div>

						<div class="modal fade" id="exampleModalLong_'.$value->booking_id.'" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title" id="exampleModalLongTitle">Payment Receipt</h5>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<img src="'.$img_src.'" width="100%">

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
			elseif($status->kode == 12)
			{
				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-success">SCHEDULE CANCELED</span>';
			}
			elseif($status->kode == 17)
			{
				$img_src = $this->M_reqantrian->get_payment_receipt($value->booking_id);
				$string_status .= '<span class="badge badge-pill badge-danger">BOOKING CANCELED</span>';
			}
			else{
				$button_reject_standard = '
						<div class="btn-group">
							<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
								Action
							</button>
							<div class="dropdown-menu">
								<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							</div>
						</div>
					';

				$button_reject_payment = '
					<div class="btn-group">
						<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Action
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_payment/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
						</div>
					</div>
				';
				$button_reject_payment_and_booking = '
					<div class="btn-group">
						<button type="button" class="btn btn-dark dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							Action
						</button>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_payment/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
							<a class="dropdown-item" href="'.base_url('cms/reqantrian/reject_booking/'.$value->booking_id).'"><i class="fa fa-calendar"></i> Reject Booking</a>
						</div>
					</div>
				';


					switch ($status->kode) {
						case 1:
							$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';
							$button .=$button_reject_standard;
							break;
						case 2:
							$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';
							$button .=$button_reject_standard;
							break;
						case 3:
							$string_status .= '<span class="badge badge-pill badge-warning">'.$status->status.'</span>';							
							$button .=$button_reject_payment_and_booking;						
							break;
						case 5:
							$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';							
							// $button .=$button_reject_payment_and_booking;
							break;
						case 6:
						$string_status .= '<span class="badge badge-pill badge-primary">'.$status->status.'</span>';							
							break;
						case 7:
						$string_status .= '<span class="badge badge-pill badge-danger">'.$status->status.'</span>';

							break;	
						case 8:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;	
						case 9:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;	
						case 10:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;																																			
						case 11:
							$string_status .= '<span class="badge badge-pill badge-danger">'.$status->status.'</span>';
							break;	
						case 12:
							$string_status .= '<span class="badge badge-pill badge-warning"> </span>';
							break;	
						default:
							$string_status .= '<span class="badge badge-pill badge-warning"> - </span>';
					}
			}

			// switch ($value->status) {
			//     case 0:
			//         $status .= '<span class="badge badge-pill badge-warning">Menunggu Konfirmasi</span>';
			//         break;
			//     case 2:
			//         $status .= '<span class="badge badge-pill badge-success">Approve</span>';
			//         break;
			//     case 3:
			//         $status .= '<span class="badge badge-pill badge-danger">Cancel</span>';
			// 				break;
			// 		case 4:
			// 			$status .= '<span class="badge badge-pill badge-success">Konfirmasi Kehadiran Pasien</span>';
			// 			break;
			// 		case 6:
			// 			$status .= '<span class="badge badge-pill badge-info">Mendapatkan nomor antrian</span>';
			// 			break;
			//     default:
			//         $status .= 'Hayati Lelah';
			// }
			/*========================================= END BUTTON STUFF =========================================*/

			$rowData[] = '<a class="dropdown-item" href="'.base_url('cms/reqantrian/details/'.$value->booking_id).'">'.$no++.'<a>';
			$rowData[] = $value->patient_name;
			$rowData[] = $value->doctor_name;
			
			$rowData[] =  date('D, d-m-Y H:i:s', $value->req_time);
			$rowData[] =  date('Y-m-d', strtotime($value->s_date))." (".$value->s_time_start."-".$value->s_time_finish.")";
			$rowData[] = $value->queue_number;
			$rowData[] = $value->poly_name;
			$rowData[] = $value->payment_method;
			$rowData[] = $string_status;
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
	/*==================================================== END DATA FOR DATATABLE ====================================================*/

	function details($id){
		$data['web_title'] = "Books";
		$data['content']   = "admin/request_antrian/details";
		$data['list_status'] = $this->M_reqantrian->get_all_status($id);
		$this->load->view('admin/layout',$data);
	}
	
	function sendPushNotif($req_id, $title, $message) {
	    // Get fcm token by user id
	    $this->db->from('master_req_queue');
	    $this->db->where('id', $req_id);
	    $req = $this->db->get()->row();
	    
	    $user = $this->global->getUserApiById($req->user_id);
	    
	    // Send notif
		$this->load->library("fcm");
	    $server_key = 'AAAA12XJNjM:APA91bEdbVFUJJzNt8Z1IpGhgTf5s36QWg6lnngsdAq5zgHLnYSYGhZkX3_rttky4Svl29GEcoPuhl1D6iVREJq4Q23FoPa6DX6gOzO2F8AcapyMP7d6RoCUA4UMb9e8FOuExS41B6yE';
	    $target = array($user->token_notification);
	    $pesan  = array('title'     	=> $title,
			            'body'      	=> $message,
			            'icon'     		=> '',
			            'sound'      	=> 'default',
			            'click_action'  => ''  
	            	);

	    $send = $this->fcm->sendMessage($pesan, $target, $server_key);
	    // End
	}


	// function test(){
	// 	// FCM Token
	// 	$this->load->library("fcm");
	//     $server_key = 'AIzaSyCRkSGmi0cvBEJSt6Ha2fny-R9SQjDzako';
	//     $target = array("cNV6sTgkrKY:APA91bGYXRiyg6yynpCd72nSyDsMkDVvzKHcIc2zllT-IdroDcF143M44H7V5KYgXpSkIQ2TC8iKwPBASEv14zhtrHnvfi4A9wSenjiQqhWuZOv6OV1NgWKR89e1k1XIxz0gBOLNtArv");
	//     $pesan  = array('title'     	=> 'Informasi Pasien',
	// 		            'body'      	=> "Senco ini test",
	// 		            'icon'     		=> '',
	// 		            'sound'      	=> '',
	// 		            'click_action'  => ''  
	//             	);
	//     $req = $this->fcm->sendMessage($pesan, $target, $server_key);
	//     print_r($req);
	// }
}