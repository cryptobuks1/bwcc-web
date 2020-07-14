<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Schedule extends CI_Controller {
	public function __construct(){
		parent::__construct();
        $this->load->model("M_schedule");
        $this->load->model("M_poli");
        $this->load->model("M_dokter");
		// $this->load->model("M_spesialis");
		$this->sessionData = $this->session->sessionData;
		$sessionData = $this->sessionData;
		if (empty($sessionData)) {
			redirect('cms/signin');
		}
	}

	function index(){
        $current_date = (!empty($_GET['date'])) ? $_GET['date'] : date('Y-m-d', strtotime(date("l")));
        $tomorrow_date =  date('Y-m-d', strtotime('+1 day', strtotime($current_date)));
        $prevday_date =  date('Y-m-d', strtotime('-2 day', strtotime($current_date)));
        $yesterday_date =  date('Y-m-d', strtotime('-1 day', strtotime($current_date)));
        $nextday_date =  date('Y-m-d', strtotime('+2 day', strtotime($current_date)));
		$data['web_title'] = "Schedule";
        $data['content']   = "admin/schedule/listschedule";
        $data['content1'] = $current_date;

        $data['yesterday_schedule'] = $this->M_schedule->get_all_schedule_by_day($yesterday_date);
        $data['today_schedule'] = $this->M_schedule->get_all_schedule_by_day($current_date);
        $data['tomorrow_schedule'] = $this->M_schedule->get_all_schedule_by_day($tomorrow_date);
        $data['current_date'] = $current_date;
        $data['tomorrow_date'] = $tomorrow_date;

        $data['yesterday_date'] = $yesterday_date;
        $data['nextday_date'] = $nextday_date;
        $data['prevday_date'] = $prevday_date;

        $data['total'] = array(
            $this->M_schedule->get_count_per_day($prevday_date),
            $this->M_schedule->get_count_per_day($yesterday_date),
            $this->M_schedule->get_count_per_day($current_date),
            $this->M_schedule->get_count_per_day($tomorrow_date),
            $this->M_schedule->get_count_per_day($nextday_date)
        );

        $data['total_available'] = array(
            $this->M_schedule->get_count_available_per_day($prevday_date),
            $this->M_schedule->get_count_available_per_day($yesterday_date),
            $this->M_schedule->get_count_available_per_day($current_date),
            $this->M_schedule->get_count_available_per_day($tomorrow_date),
            $this->M_schedule->get_count_available_per_day($nextday_date)
        );        

        // echo json_encode($data['today_schedule']);
        // die();

		$this->load->view('admin/layout',$data);
    }

    function add(){
		// $data['kategori_berita'] 	= $getKategori;
        $data['list_poly']  = $this->M_poli->getData();
        $data['list_doctor']  = $this->M_dokter->getData();
		$data['back_link'] 			= base_url('cms/schedule');
		$data['web_title'] 			= "Add Schedule";

		$data['content']   			= "admin/schedule/add";

		$this->load->view('admin/layout',$data);

    }

    function doAdd(){
        $post = $this->input->post();	

        $scheduleItems = json_decode($post['schedule_items']);

        $insertArrayBatch = array();
        foreach ($scheduleItems as $sc) {
            //$dateSc = date("Y-m-d H:i:s", strtotime($sc->date.''));

            $dtFormated = DateTime::createFromFormat('m-d-Y', $sc->date);
            $dateSc = $dtFormated->format('Y-m-d').' 00:00:00';

            foreach ($sc->items as $item) {
                $id_schedule = guid();
                $insertArray = array(
                    "id"        => $id_schedule,
                    "id_poly"   => $post['id_poly'],
                    "id_doctor" => $post['id_doctor'],
                    "start_time_service" => $item->start_time,
                    "finish_time_service" => $item->finish_time,
                    "quota" => 1,
                    "day"   => 1,
                    "date"  => $dateSc,
                    "is_active" => 1,
                    "created_date"  => date('Y-m-d H:i:s'),
                    "created_by"    => $this->sessionData['user_id']
                );

                array_push($insertArrayBatch, $insertArray);
            }
        } 

        $insert	= $this->db->insert_batch("master_practice_schedule", $insertArrayBatch);

        foreach ($scheduleItems as $sc) {
            $dtFormated = DateTime::createFromFormat('m-d-Y', $sc->date);
            $dateSc = $dtFormated->format('Y-m-d').' 00:00:00';

            $this->db->where('id_poly', $post['id_poly']);
            $this->db->where('id_doctor', $post['id_doctor']);
            $this->db->where('date', $dateSc);
            $this->db->order_by('start_time_service', 'ASC');
            $this->db->from('master_practice_schedule');
            $schedules = $this->db->get()->result();

            $i = 1;
            foreach ($schedules as $sc) {
                $this->db->where('id', $sc->id);
                $this->db->update("master_practice_schedule", ['queue_number' => $i++]);
            }
        }

        if ($insert) {
            custom_notif("success", "Notif", "");
            redirect("cms/schedule/");
        }else{
            custom_notif("failed", "Notif", "");
            redirect("cms/schedule/");
        }
	
    }

    function edit(){
        $get       = $this->input->get();     

		$this->db->where('id_poly', $get['poly_id']);
        $this->db->where('id_doctor', $get['doctor_id']);
        $this->db->where('date', $get['date_time']);
        $this->db->where('is_active', 1);
        $this->db->order_by('start_time_service', 'ASC');
        $this->db->from('master_practice_schedule');
        $schedules = $this->db->get()->result();

		if (!$schedules) {
			custom_notif("failed", "Notif", "Data tidak ada");
			redirect("cms/schedule");
        }

        $data['detailData'] = array(
            'id_poly' => $get['poly_id'],
            'id_doctor' => $get['doctor_id'],
            'date' => $get['date_time'],
            'items' => $schedules
        );

        $data['list_poly']  = $this->M_poli->getData();
        $data['list_doctor']  = $this->M_dokter->getData();
		$data['web_title']  = "Edit Schedule";
		$data['content']    = "admin/schedule/edit";
        $this->load->view('admin/layout',$data);
	}

    function change(){
        $get       = $this->input->get();     

        $this->db->where('id_poly', $get['poly_id']);
        $this->db->where('id_doctor', $get['doctor_id']);
        $this->db->where('date', $get['date_time']);
        $this->db->where('is_active', 1);
        $this->db->order_by('start_time_service', 'ASC');
        $this->db->from('master_practice_schedule');
        $schedules = $this->db->get()->result();

        if (!$schedules) {
            custom_notif("failed", "Notif", "Data tidak ada");
            redirect("cms/schedule");
        }

        $data['detailData'] = array(
            'id_poly' => $get['poly_id'],
            'id_doctor' => $get['doctor_id'],
            'date' => $get['date_time'],
            'items' => $schedules
        );

        $data['list_poly']  = $this->M_poli->getData();
        $data['list_doctor']  = $this->M_dokter->getData();
        $data['web_title']  = "Edit Schedule";
        $data['content']    = "admin/schedule/change";
        $this->load->view('admin/layout',$data);
    }
    
    function search(){
        $post     	= $this->input->post();		
        $current_date = date("Y-m-d", strtotime($_POST['date_selected']));
        var_dump($current_date);
        // var_dump( strtotime($_POST['date_selected']) );
        redirect("cms/schedule?date=".$current_date);
    }

	function doUpdate(){
        $post       = $this->input->post(); 
        $get       = $this->input->get();

        $this->db->where('id_poly', $get['poly_id']);
        $this->db->where('id_doctor', $get['doctor_id']);
        $this->db->where('date', $get['date_time']);
        $this->db->from('master_practice_schedule');
        $existScheduleItems = $this->db->get()->result();

        // Insert new schedule
        $scheduleItems = json_decode($post['schedule_items']);

        $insertArrayBatch = array();
        foreach ($scheduleItems as $sc) {
            $dtFormated = DateTime::createFromFormat('m-d-Y', $sc->date);
            $dateSc = $dtFormated->format('Y-m-d').' 00:00:00';

            foreach ($sc->items as $item) {
                $is_exist = false;
                foreach ($existScheduleItems as $eitem) {
                    $start_time_service = date('H:i', strtotime($eitem->start_time_service));
                    $finish_time_service = date('H:i', strtotime($eitem->finish_time_service));
                    if($start_time_service == $item->start_time && $finish_time_service == $item->finish_time) {
                        $is_exist = true;
                        break;
                    }
                }


                if(!$is_exist) {
                    $id_schedule = guid();
                    $insertArray = array(
                        "id"        => $id_schedule,
                        "id_poly"   => $get['poly_id'],
                        "id_doctor" => $get['doctor_id'],
                        "start_time_service" => $item->start_time,
                        "finish_time_service" => $item->finish_time,
                        "quota" => 1,
                        "day"   => 1,
                        "date"  => $dateSc,
                        "is_active" => 1,
                        "created_date"  => date('Y-m-d H:i:s'),
                        "created_by"    => $this->sessionData['user_id']
                    );
                    array_push($insertArrayBatch, $insertArray);
                }

            }
        } 

        $insert = true;
        if(!empty($insertArrayBatch))
            $insert = $this->db->insert_batch("master_practice_schedule", $insertArrayBatch);

        // Delete existing schedule
        foreach ($existScheduleItems as $eitem) { 
            $start_time_service = date('H:i', strtotime($eitem->start_time_service));
            $finish_time_service = date('H:i', strtotime($eitem->finish_time_service));

            foreach ($scheduleItems as $sc) {
                $is_exist = false;
                foreach ($sc->items as $item) {
                    if($start_time_service == $item->start_time && $finish_time_service == $item->finish_time) {
                        $is_exist = true;
                        break;
                    }
                }

                if(!$is_exist) {
                    $this->db->where('id', $eitem->id);
                    $this->db->delete('master_practice_schedule');

                    //echo $start_time_service.' - '.$finish_time_service;
                }
            }
        }

        // echo '<pre>';
        // print_r($insertArrayBatch);
        // die();

        // Reorder Schedule Queue Number
        foreach ($scheduleItems as $sc) {
            $dtFormated = DateTime::createFromFormat('m-d-Y', $sc->date);
            $dateSc = $dtFormated->format('Y-m-d').' 00:00:00';

            $this->db->where('id_poly', $get['poly_id']);
            $this->db->where('id_doctor', $get['doctor_id']);
            $this->db->where('date', $dateSc);
            $this->db->order_by('start_time_service', 'ASC');
            $this->db->from('master_practice_schedule');
            $schedules = $this->db->get()->result();

            $i = 1;
            foreach ($schedules as $sc) {
                $this->db->where('id', $sc->id);
                $this->db->update("master_practice_schedule", ['queue_number' => $i++]);
            }
        }


        if ($insert) {

            // $this->db->where('id_schedule_practice', $id);
            // $get_mrq = $this->db->get('master_req_queue')->row();

            // $this->sendPushNotif(
            //     $get_mrq->id, 
            //     'BWCC - Booking Information',
            //     "Your schedule was changed. Please check your booking history for confirmation");
            
            custom_notif("success", "Notif", "Success Change Schedule".(string)$post['date_selected']);
            redirect("cms/schedule");
        }else{
            custom_notif("failed", "Notif", "Failed Change Schedule");
            redirect("cms/schedule/edit/".$id);
        }

    }

    function doChange(){
        $post       = $this->input->post(); 
        $get       = $this->input->get();

        // Update schedule
        $scheduleItems = json_decode($post['schedule_items']);
        foreach ($scheduleItems as $sc) {
            $updateData = array(
                'start_time_service' => $sc->start_time,
                'finish_time_service' => $sc->finish_time,
                'id_doctor' => $post['id_doctor_id'],
                'updated_date' => date('Y-m-d H:i:s')
            );

            $this->db->where('id', $sc->id);
            $update = $this->db->update('master_practice_schedule', $updateData);
            if($update) {
                $this->db->where('id_schedule_practice', $sc->id);
                $get_mrq = $this->db->get('master_req_queue')->row();

                if($get_mrq)
                    $this->sendPushNotif(
                        $get_mrq->id, 
                        'BWCC - Booking Information',
                        "Your schedule was changed. Please check your booking history for confirmation");
            }
        } 

        // Reorder Schedule Queue Number
        $where = ' id IN (';
        $i = 0;
        foreach ($scheduleItems as $sc) {
            $where .= "'".$sc->id."',";
            $i++;
        }
        if($i > 0)
            $where = substr($where, 0, strlen($where) - 1);
        $where .= ') ';

        $this->db->where($where);
        $this->db->order_by('start_time_service', 'ASC');
        $this->db->from('master_practice_schedule');
        $schedules = $this->db->get()->result();

        $i = 1;
        foreach ($schedules as $sc) {
            $this->db->where('id', $sc->id);
            $this->db->update("master_practice_schedule", ['queue_number' => $i++]);
        }

        custom_notif("success", "Notif", "Success Change Schedule ".(string)$post['date_selected']);
        redirect("cms/schedule");
    }
    
    function doDelete($id){        
        $current_date = date("Y-m-d", strtotime($this->M_schedule->get_date($id)));

		$updateArray = array(
			"is_active"   	=> "0",
			"updated_date"  => date('Y-m-d H:i:s')
		);

		$delete = $this->db->update("master_practice_schedule", $updateArray, array("id" => $id));

		if ($delete) {

			custom_notif("success", "Notif", "Delete Schedule");

			redirect("cms/schedule?date=".$current_date);

		}else{

			custom_notif("failed", "Notif", "Delete Schedule");

			redirect("cms/schedule?date=".$current_date);

		}

    }

    function doHide($id) {
        $post       = $this->input->post();     
        
        $updateArray = array(
            "is_hide" => $post['is_hide'],
            "is_book" => $post['is_hide']
        );

        $update = $this->db->update("master_practice_schedule", $updateArray, array("id" => $id));

        $message = '';          
        $result = array('is_success' => $update, 'message' => $message);

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    function doBatchHide() {
        $post       = $this->input->post();     

        $this->db->where('id_poly', $post['poly_id']);
        $this->db->where('id_doctor', $post['doctor_id']);
        $this->db->where('date', $post['date_time']);
        $this->db->from('master_practice_schedule');
        $rows = $this->db->get()->result();
        
        foreach ($rows as $row) {
            $updateArray = array( "is_hide" => $post['is_hide'] );
            $update = $this->db->update("master_practice_schedule", $updateArray, array("id" => $row->id));
        }

        $message = '';          
        $result = array('is_success' => TRUE, 'message' => $message);

        header('Content-Type: application/json');
        echo json_encode($result);
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
        $pesan  = array('title'         => $title,
                        'body'          => $message,
                        'icon'          => '',
                        'sound'         => 'default',
                        'click_action'  => ''  
                    );

        $send = $this->fcm->sendMessage($pesan, $target, $server_key);
        // End
    }

}
