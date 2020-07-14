<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class M_dashboard extends CI_Model{
    function __construct(){
        parent::__construct();
    }


    function getTotalData($dateArray = array()){
    	$sqlTotalEvent = "SELECT 
    		COUNT(*) AS total_event FROM event 
    		WHERE DATE(event_start_date) >= '".$dateArray['dateStart']."' 
    		AND DATE(event_start_date) <= '".$dateArray['dateEnd']."'";
    	$queryTotalEvent = $this->db->query($sqlTotalEvent);
    	$data['total_event'] = $queryTotalEvent->row()->total_event;

    	$sqlTotalPayment = "SELECT SUM(order_price) AS total_payment FROM `order`
    		WHERE DATE(payment_time) >= '".$dateArray['dateStart']."'
    		AND DATE(payment_time) <= '".$dateArray['dateEnd']."'
    		AND payment_status = 2";
    	$queryTotalPayment = $this->db->query($sqlTotalPayment);
    	$data['total_payment'] = $queryTotalPayment->row()->total_payment;

    	$sqlTotalOrder = "SELECT COUNT(*) AS total_order FROM `order`
    		WHERE DATE(payment_time) >= '".$dateArray['dateStart']."'
    		AND DATE(payment_time) <= '".$dateArray['dateEnd']."'
    		AND payment_status = 2";
    	$queryTotalOrder = $this->db->query($sqlTotalOrder);
    	$data['total_order'] = $queryTotalOrder->row()->total_order;
    	return $data;
    }

    function get10LastRegister(){
    	$this->db->select("member_name, created_date");
    	$this->db->from("member");
    	$this->db->where("is_active",1);
    	$this->db->where("is_deleted",0);
    	$this->db->order_by("created_date","DESC");
    	$this->db->limit(10);
    	$query = $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function get10LastOrder(){
    	$this->db->select("ord.order_id, ord.order_time, ord.payment_status, member_name, ord.order_participant_name");
    	$this->db->from("order AS ord");
    	$this->db->join("member AS mb","mb.member_id = ord.member_id");
    	$this->db->order_by("order_time","DESC");
    	$this->db->limit(10);
    	$query 	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function get10LastAttendance(){
    	$this->db->select("attendance_name, attendance_id, updated_date");
    	$this->db->from('attendance');
    	$this->db->where("is_active",1);
    	$this->db->order_by("updated_date","DESC");
    	$this->db->limit(10);
    	$query 	= $this->db->get();
    	$result = $query->result();
    	return $result;
    }

    function get10CheckInOut(){
    	$this->db->select("ats.attendance_schedule, ats.type_att, ats.created_date, att.attendance_name");
    	$this->db->from("attendance_schedule AS ats");
    	$this->db->join("attendance AS att", "att.attendance_id = ats.attendance_id");
    	$this->db->order_by("ats.created_date","DESC");
    	$this->db->limit(10);
    	$query 	= $this->db->get();
    	$result = $query->result();
    	return $result;
	}
	
	function getCardInfo(){
		// booked
    	$this->db->select("count(*) AS total");
    	$this->db->from("master_req_queue_status");
    	$this->db->where("kode",0);
    	$query = $this->db->get();
		$res_1 = $query->result();
		
		// booked date
		$this->db->select("*");
    	$this->db->from("master_req_queue_status");
		$this->db->where("kode",0);
		$this->db->order_by("time", "DESC");
    	$query = $this->db->get();
		$res_1_1 = $query->result();

		// booked success
    	$this->db->select("count(*) AS total");
    	$this->db->from("master_req_queue_status");
    	$this->db->where("kode",6);
    	$query = $this->db->get();
		$res_2 = $query->result();
		
		// booked success date
		$this->db->select("*");
    	$this->db->from("master_req_queue_status");
		$this->db->where("kode",6);
		$this->db->order_by("time", "DESC");
    	$query = $this->db->get();
		$res_2_1 = $query->result();

		// reject booking payment
    	$this->db->select("count(*) AS total");
    	$this->db->from("master_req_queue_status");
    	$this->db->where("kode",7);
    	$query = $this->db->get();
		$res_3 = $query->result();
		
		// reject booking payment date
		$this->db->select("*");
    	$this->db->from("master_req_queue_status");
		$this->db->where("kode",7);
		$this->db->order_by("time", "DESC");
    	$query = $this->db->get();
		$res_3_1 = $query->result();

		// reject booking only
    	$this->db->select("count(*) AS total");
    	$this->db->from("master_req_queue_status");
    	$this->db->where("kode",11);
    	$query = $this->db->get();
		$res_4 = $query->result();
		
		// reject booking only payment date
		$this->db->select("*");
    	$this->db->from("master_req_queue_status");
		$this->db->where("kode",11);
		$this->db->order_by("time", "DESC");
    	$query = $this->db->get();
		$res_4_1 = $query->result();

		$res = array(
			"booked" => $res_1[0]->total,
			"booked_date" => (!empty($res_1_1[0]->time) ? $res_1_1[0]->time : "no data"),
			"booked_success" => $res_2[0]->total,
			"booked_success_date" => (!empty($res_2_1[0]->time) ? $res_2_1[0]->time : "no data"),
			"reject_booking" => $res_3[0]->total,
			"reject_booking_date" => (!empty($res_3_1[0]->time) ? $res_3_1[0]->time : "no data"),
			"reject_booking_only" => $res_4[0]->total,
			"reject_booking_only_date" => (!empty($res_4_1[0]->time) ? $res_4_1[0]->time : "no data"),
		);

		return $res;
	}
	
	function getLastActivity(){

		$res = array();

		// booked
    	$this->db->select("*");
    	$this->db->from("master_req_queue_status");		
		$this->db->order_by("time, kode", "DESC");
		$this->db->limit(10);
    	$query = $this->db->get();
		$q_res = $query->result_array();

		foreach($q_res as $item){
			array_push(
				$res,
				array(
					"time" => $this->get_timeago(strtotime($item['time'])),
					"status" => $item['status'],
					"booking_id" => $item['req_id']
				)
			);
		}
					
		return $res;
	}

	function getLastBooked(){

		$res = array();

		// booked
		//$this->db->limit(10);
		$query = $this->db->query("SELECT a.id as booking_id, b.id as schedule_id, b.date as s_date, b.start_time_service as s_time_start, a.unix_timestamp as req_time, c.name as poly_name, d.name as doctor_name, e.nama as patient_name FROM `master_req_queue` as a JOIN master_practice_schedule as b JOIN master_poly as c JOIN master_doctor as d JOIN patient as e WHERE a.id_schedule_practice = b.id AND b.id_poly = c.id AND b.id_doctor = d.id AND b.patient_id = e.id AND b.patient_id IS NOT NULL LIMIT 10 ");
		$q_res = $query->result_array();

		foreach($q_res as $item){
			array_push(
				$res,
				array(
					"booking_id" => $item['booking_id'],
					"schedule_id" => $item['schedule_id'],
					"request_time" => $item['req_time'],
					"poly_name" => $item['poly_name'],
					"doctor_name" => $item['doctor_name'],
					"patient_name" => $item['patient_name'],
					"time_schedule" => $item['s_date']." (".$item['s_time_start'].")"
				)
			);
		}
					
		return $res;
	}	


	function get_timeago( $ptime )
	{
		$estimate_time = time() - $ptime;

		if( $estimate_time < 1 )
		{
			return 'less than 1 second ago';
		}

		$condition = array(
					12 * 30 * 24 * 60 * 60  =>  'year',
					30 * 24 * 60 * 60       =>  'month',
					24 * 60 * 60            =>  'day',
					60 * 60                 =>  'hour',
					60                      =>  'minute',
					1                       =>  'second'
		);

		foreach( $condition as $secs => $str )
		{
			$d = $estimate_time / $secs;

			if( $d >= 1 )
			{
				$r = round( $d );
				return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
			}
		}
	}

	function get_pending_book_class()
	{
		$this->db->where('status' , 1);
		$data = $this->db->get('class_booking');
		return $data->num_rows();
	}

	function get_success_book_class()
	{
		$this->db->where('status' , 5);
		$data = $this->db->get('class_booking');
		return $data->num_rows();
	}

	function get_cancel_book_class()
	{
		$this->db->where('status' , 0);
		$data = $this->db->get('class_booking');
		return $data->num_rows();
	}

	function get_cancel_payment_book_class()
	{
		$this->db->where('status' , 4);
		$data = $this->db->get('class_booking');
		return $data->num_rows();
	}


}