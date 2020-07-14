<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Campaigns extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("M_programtipe");
		$this->load->model("M_program");
		$this->load->model("M_media");
		$this->load->model("M_transaksi");
		$this->load->model("M_pencairan");
		$this->load->model("M_bank");
		$this->load->model("M_biaya");
		$this->sessionNadzir = $this->session->sessionNadzir;
		if (empty($this->sessionNadzir)) {
			redirect();
		}
	}

	function index(){
		$dataNadzir 			= $this->sessionNadzir;

		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Program";
		$data['title_head']		= "Program";
		$data['content']		= "front/front_page/dashboard/campaign/index";
		$this->load->view('front/layout', $data);
	}

	function getCampaignByNadzir(){
		$page =  $_GET['page'];
        
        $getProgram 		= $this->M_program->getCampaignByNadzir($page, $this->sessionNadzir['nadzir_id']);
        
		foreach ($getProgram as $key => $value) {
			// Get Media
			$getMedia		= $this->M_media->getOneData("id_program", $value->id);

			if (!empty($getMedia)) {
				$getProgram[$key]->link_media 	= $getMedia->images;
			}else{
				$getProgram[$key]->link_media 	= "images/img_default.png";
			}

			// Cari sisa hari
			$start_date 	= new DateTime(date("Y-m-d"));
			$end_date 		= new DateTime($value->end_date);
			if (date("Y-m-d") > $value->end_date) {
				$interval_date	= "SELESAI";
			}else{
				$interval 		= $start_date->diff($end_date);	
				$interval_date	= $interval->days;
			}

			$persentase = round($value->fund_collected / $value->fund_target * 100);
			if ($persentase > 100) {
				$res_persentase = 100;
			}else{
				$res_persentase = $persentase;
			}

			// Custom Array
			// $getProgram[$key]->persentase 	= round($value->fund_collected / $value->fund_target * 100);
			$getProgram[$key]->persentase 	= $res_persentase;
			$getProgram[$key]->sisa_hari 	= $interval_date;

			// Condition Status
			if ($value->status == 0) {
				$status = "Menunggu Konfirmasi";
				$color	= "bg-warning";
			}elseif ($value->status == 1) {
				$status = "Approved";
				$color	= "bg-success";
			}else{
				$status = "Reject";
				$color	= "bg-danger";
			}


			echo '<a href="'.base_url('dashboard/campaigns/overview/'.$value->id).'">
					<div class="col-md-5">
						<div class="xs-popular-item xs-box-shadow">
							<div class="xs-item-header">
							<span class="span-status '.$color.'">'.$status.'</span>
								<img src="'.base_url($value->link_media).'" class="size-img-campaign img-fluid" alt="">
								<div class="xs-skill-bar">
									<div class="xs-skill-track"  style="width: '.$value->persentase.'%;">
										<p style="right: -24px;"><span class="number-percentage-count number-percentage" data-value="'.$value->persentase.'" data-animation-duration="3500">'.$value->persentase.'</span>%</p>
									</div>
								</div>
							</div>
							<div class="xs-item-content">
								<!-- <ul class="xs-simple-tag xs-mb-20">
									<li><a href="">Nama I</a></li>
								</ul> -->

								<a href="'.base_url('dashboard/campaigns/overview/'.$value->id).'" class="xs-post-title xs-mb-30">'.$value->name.'</a>

								<ul class="xs-list-with-content">
									<li  class="days-pos">Rp '.number_format($value->fund_collected, 0, ",", ".").'<span>Dana Terkumpul</span></li>
									<li>'.$value->sisa_hari.'<span>Sisa Hari</span></li>
								</ul>
							</div>
						</div>
					</div>
				</a>';
		}

        exit;		
	}

	// ==================== Get Info Biaya Admin ===================//
	function getInfoAdministrasi($nominal){
		// $nominal 		= "100000";
		$getDataBiaya	= $this->M_biaya->getInfoBiaya($nominal);
		if (!empty($getDataBiaya)) {
			$biaya = $getDataBiaya->biaya_operasional;
		}else{
			$biaya = 0;
		}
		print_r(number_format($biaya));
	}
	// ==================== End ===================//

	function addcampaign(){
		$dataNadzir 			= $this->sessionNadzir;
		$getProgramTipe 		= $this->M_programtipe->getData();
		
		$data['tipeProgram']	= $getProgramTipe;
		$data['detailData']		= $dataNadzir;
		$data['title']			= "Kita Wakaf - Program";
		$data['title_head']		= "Program";
		$data['content']		= "front/front_page/dashboard/campaign/addcampaign";
		$this->load->view('front/layout', $data);
	}

	function doAddCampaign(){
		$post 		= $this->input->post();

		$getLink 	= $this->M_program->getOneData("url", $post['url']);

		if (!empty($getLink)) {
			custom_notif("failed", "Notif", "Link untuk Program ".$post['url']." sudah ada.");
			redirect("dashboard/campaigns/addcampaign");
		}else{
			// Buat ID program
			$id 		= guid();
			// Buat nama file
			$nama_file 	= 'PRG-'.date('ydmhis').rand(10,99);

			// Configuration for file upload
			$config['upload_path']          = 'assets/images/program/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 5000;
			$config['max_width']            = 2000;
			$config['max_height']           = 2000;
			$config['file_name']			= $nama_file;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
	 
			if ( ! $this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
				custom_notif("failed", "Notif", "Periksa kembali file yang akan Anda upload, saran file <b>1800px</b> x <b>1100x</b> dengan format file JPG, JPEG atau PNG");
				redirect("dashboard/campaigns/addcampaign");
			}else{
				$data = array('upload_data' => $this->upload->data());
			}

			$mediaArray = array(
				"id"      			=> guid(),
				"id_program"     	=> $id,
				"images"   			=> "assets/images/program/".$this->upload->data('orig_name'),
				"status"   			=> 1,
				"created_date"     	=> date('Y-m-d H:i:s'),
				"created_by"       	=> $this->sessionNadzir['nadzir_id']
			);

			$this->db->insert("media", $mediaArray);
			
			$insertArray = array(
				"id"      			=> $id,
				"id_nadzir"     	=> $this->sessionNadzir['nadzir_id'],
				"id_program_type"   => $post['kategori_wakaf'],
				"name"     			=> $post['nama_program'],
				"url"				=> $post['url'],
				"description" 		=> $post['deskripsi'],
				"fund_target"       => str_replace(".", "", $post['target_donasi']),
				"start_date"  		=> date('Y-m-d'),
				"end_date"      	=> date('Y-m-d', strtotime($post['tgl_akhir'])),
				// "address"        	=> $post['alamat'],
				// "id_province"       => $post['provinsi'],
				// "id_sub_district"   => $post['kota'],
				// "kelurahan"         => $post['kelurahan'],
				"short_description"	=> $post['deskripsi_singkat'],
				"status"        	=> 0,
				"created_date"     	=> date('Y-m-d H:i:s'),
				"created_by"       	=> $this->sessionNadzir['nadzir_id']
			);

			$insert = $this->db->insert("program", $insertArray);
			if ($insert) {
				custom_notif("success", "Notif", "Berhasil membuat program");
				redirect("dashboard/campaigns/addcampaign");
			}else{
				custom_notif("failed", "Notif", "gagal membuat program");
				redirect("dashboard/campaigns/addcampaign");
			}
		}
	}

	// ============================== Dashboard Campaign Overview ============================= //
	function overview($campaign_id){
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		$getTransaksi			= $this->M_transaksi->getDataById("id_program", $campaign_id);
		$getFee 				= $this->M_biaya->getInfoBiaya($getProgram->fund_collected);
		// debugCode($getFee);
		if (!empty($getFee)) {
			$getFee_total 			= $getFee->biaya_operasional;
			$fee 					= $getProgram->fund_collected - $getFee->biaya_operasional;
		}else{
			$getFee_total			= 0;
			$fee 					= 0;
		}
		
		$data['total_bersih']	= $fee;
		$data['fee'] 			= $getFee_total;
		$data['total_wakif']	= count($getTransaksi);
		$data['program']		= $getProgram;
		$data['title']			= "Kita Wakaf - Dashboard Program";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "Overview";
		$data['content']		= "front/front_page/dashboard/campaign/detail/overview";
		$this->load->view('front/layout', $data);
	}

	// ============================== Dashboard Campaign Update ============================= //
	function listupdate($campaign_id){
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		// List Update
		$getUpdate		= $this->global->get_update_by_campaign("id_program", $campaign_id);
		// debugCode($getUpdate);
		
		$data['updateCampaign']	= $getUpdate;
		$data['program']		= $getProgram;
		$data['title']				= "Kita Wakaf - Dashboard Program";
		$data['dash_campaign']		= array("ok");
		$data['title_head']			= "List Update Kegiatan Program";
		$data['content']			= "front/front_page/dashboard/campaign/detail/list_update";
		$this->load->view('front/layout', $data);
	}

	function update($campaign_id){
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		
		$data['program']		= $getProgram;
		$data['title']			= "Kita Wakaf - Dashboard Program";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "Update Kegiatan Program";
		$data['content']		= "front/front_page/dashboard/campaign/detail/update";
		$this->load->view('front/layout', $data);
	}

	function doAddUpdateCampaign(){
		$post = $this->input->post();
		
		$insertArray = array(
			"id"      			=> guid(),
			"id_program"      	=> $post['campaign_id'],
			"judul"     		=> $post['judul'],
			"deskripsi"   		=> $post['deskripsi'],
			"created_date"     	=> date('Y-m-d H:i:s'),
			"created_by"       	=> $this->sessionNadzir['nadzir_id']
		);

		$insert = $this->db->insert("campaign_update", $insertArray);
		if ($insert) {
			custom_notif("success", "Notif", "Update Berhasil");
			redirect("dashboard/campaigns/update/".$post['campaign_id']);
		}else{
			custom_notif("failed", "Notif", "Update Gagal");
			redirect("dashboard/campaigns/update/".$post['campaign_id']);
		}
	}

	function editkegiatan($id){
		$getUpdateProgram 		= $this->global->getUpdateProgram("id", $id);
		$getProgram 			= $this->M_program->getOneData("id", $getUpdateProgram->id_program);
		
		$data['program']		= $getProgram;
		$data['updateProgram'] 	= $getUpdateProgram;
		$data['title']			= "Kita Wakaf - Dashboard Program";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "Update Kegiatan Program";
		$data['content']		= "front/front_page/dashboard/campaign/detail/edit_kegiatan_program";
		$this->load->view('front/layout', $data);
	}

	function doUpdateKegiatan($id){
		$post = $this->input->post();
		
		$udpateArray = array(
			"judul"     		=> $post['judul'],
			"deskripsi"   		=> $post['deskripsi'],
			"updated_date"     	=> date('Y-m-d H:i:s'),
			"updated_by"       	=> $this->sessionNadzir['nadzir_id']
		);
		
		$update = $this->db->update("campaign_update", $udpateArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "Update Berhasil");
			redirect("dashboard/campaigns/listupdate/".$post['campaign_id']);
		}else{
			custom_notif("failed", "Notif", "Update Gagal");
			redirect("dashboard/campaigns/listupdate/".$post['campaign_id']);
		}
	}

	function hapus_kegiatan($id){
		$post = $this->input->post();
		// Get Update Kegiatan
		$getUpdateProgram 		= $this->global->getUpdateProgram("id", $id);
		
		$udpateArray = array(
			"is_deleted"     	=> 1,
			"updated_date"     	=> date('Y-m-d H:i:s'),
			"updated_by"       	=> $this->sessionNadzir['nadzir_id']
		);
		
		$update = $this->db->update("campaign_update", $udpateArray, array("id" => $id));
		if ($update) {
			custom_notif("success", "Notif", "Update Berhasil");
			redirect("dashboard/campaigns/listupdate/".$getUpdateProgram->id_program);
		}else{
			custom_notif("failed", "Notif", "Update Gagal");
			redirect("dashboard/campaigns/listupdate/".$getUpdateProgram->id_program);
		}
	}

	/*===================== Dashboard Campaign Wakif =====================*/
	function wakif($campaign_id){
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		
		$data['program']		= $getProgram;
		$data['title']			= "Kita Wakaf - Dashboard Campaign";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "List Wakif";
		$data['content']		= "front/front_page/dashboard/campaign/detail/wakif";
		$this->load->view('front/layout', $data);
	}

	/*===================== Export Wakif by Campaign =====================*/
	public function wakif_excel(){
		$get 			= $this->input->get();

		$getProgram 	= $this->M_program->getOneData("id", $this->uri->segment(4));
		
		if (!empty($get)) {
			$dataWakif 	= $this->M_transaksi->laporanRangewakif($getProgram->id, $get['start'], $get['end']);
			$tgl		= "Mulai Tanggal : ".$get['start']." | Sampai Tanggal : ".$get['end'];
		}else{
			// $dataWakif = $this->M_transaksi->getData();
			$dataWakif 	= $this->M_transaksi->laporanwakif($getProgram->id);
			$tgl		= array();
		}

		// debugCode($dataWakif);

	  	$data = array('title' => 'List Wakif '.$getProgram->name, 'dataWakif' => $dataWakif, 'tgl' => $tgl);
	   	$this->load->view('front/front_page/dashboard/campaign/detail/wakif_excel', $data);
	}

	/*===================== DATA FOR DATATABLE =====================*/
	public function get_list_wakif(){
		$requestParam 			= $_REQUEST;

		$getData 				= $this->M_transaksi->get_list_wakif ( $requestParam, 'nofilter' );
		$totalAllData 			= $this->M_transaksi->get_list_wakif ( $requestParam, 'nofilter', 'all' )->num_rows ();
		$totalDataFiltered 		= $this->M_transaksi->get_list_wakif ( $requestParam, 'nofilter', 'all' )->num_rows ();
		
		if (empty ( $requestParam ['search'] ['value'] ) > 1) {
			$getData 			= $this->M_transaksi->get_list_wakif ( $requestParam );
			$totalDataFiltered 	= $getData->num_rows ();
		}
		
		$listData = array ();
		$no = ($requestParam['start']+1);
		
		foreach( $getData->result () AS $value){
			
			$rowData = array();
			$rowData[] = $no++.".";
			$rowData[] = $value->on_behalf;
			$rowData[] = number_format($value->total, 0, ",", ".");
			$rowData[] = "-";
			$rowData[] = "-";
			$rowData[] = number_format($value->total, 0, ",", ".");
			$rowData[] = $value->notes;
			$rowData[] = date('d M Y H:i',strtotime($value->created_date));
			
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
	/*===================== END DATA FOR DATATABLE =====================*/

	// Dashboard Campaign Cair Dana
	function pencairan($campaign_id){
		// Get Program / Campaign
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		// Get Data Bank
		$getBank				= $this->M_bank->nadzirBank("id_nadzir", $this->sessionNadzir['nadzir_id']);
		// Get Biaya Admin Campaign
		$getBiaya 				= $this->M_biaya->getInfoBiaya($getProgram->fund_collected);
		if (!empty($getBiaya)) {
			$biaya 				= $getBiaya->biaya_operasional;
			// Membuat parameter Biaya
			$paramBiaya			= $getProgram->fund_update - $getBiaya->biaya_operasional;
		}else{
			$biaya 				= 0;
			// Membuat parameter Biaya
			$paramBiaya			= 0;
		}
		// Dana Dicairkan
		$getPencairan 			= $this->M_pencairan->getDataByCondition("id_program", $getProgram->id, "1");

		$dicairkan 				= 0;
		foreach ($getPencairan as $value) {
			$dicairkan += $value->nominal;
		}
		
		$data['dicairkan'] 		= $dicairkan;
		$data['max_biaya'] 		= $paramBiaya;
		$data['biaya'] 			= $biaya;
		$data['bank']			= $getBank;
		$data['program']		= $getProgram;
		$data['title']			= "Kita Wakaf - Dashboard Program";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "Pencairan Dana";
		$data['content']		= "front/front_page/dashboard/campaign/detail/pencairan";
		$this->load->view('front/layout', $data);
	}

	function cairdana(){
		$post = $this->input->post();

		// Replace Post Nominal
		$nominal 		= str_replace(".", "", $post['nominal']);
		// get data Campaign
		$getCampaign 	= $this->M_program->getOneData("id", $post['campaign_id']);
		// Get Biaya Operasional
		$getBiaya 		= $this->M_biaya->getInfoBiaya($getCampaign->fund_collected);
		// Membuat parameter Biaya
		$paramBiaya		= $getCampaign->fund_update - $getBiaya->biaya_operasional;
	
		if ($nominal > $paramBiaya || $nominal == 0) {
			custom_notif("failed", "Notif", "Mohon Maaf, Dana yang Anda ajukan tidak dapat diproses.");
			redirect("dashboard/campaigns/pencairan/".$post['campaign_id']);
		}else{
			$insertArray = array(
				"id"      			=> guid(),
				"id_program"      	=> $post['campaign_id'],
				"id_bank"     		=> $post['id_bank'],
				"nominal"   		=> $nominal,
				"status"   			=> 0,
				"created_date"     	=> date('Y-m-d H:i:s'),
				"created_by"       	=> $this->sessionNadzir['nadzir_id']
			);

			$insert = $this->db->insert("pencairan_dana", $insertArray);

			if ($insert) {
				custom_notif("success", "Notif", "Permintaan berhasil dikirim");
				redirect("dashboard/campaigns/pencairan/".$post['campaign_id']);
			}else{
				custom_notif("failed", "Notif", "Gagal melakukan permintaan");
				redirect("dashboard/campaigns/pencairan/".$post['campaign_id']);
			}
		}
	}

	function riwayat_pencairan($campaign_id){
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		// Get Data Pencairan
		$getPencairan			= $this->M_pencairan->getDataPencairanByCondition("id_program", $getProgram->id);

		foreach ($getPencairan  as $key => $value) {
			// Get Bank
			$getBank			= $this->M_bank->nadzirBankById($this->sessionNadzir['nadzir_id'], "id", $value->id_bank);
			
			$getPencairan[$key]->no_rek		= $getBank->no_rek;
			$getPencairan[$key]->on_behalf	= $getBank->atas_nama;
		}
		
		$data['listData']		= $getPencairan;
		$data['program']		= $getProgram;
		$data['title']			= "Kita Wakaf - Dashboard Program";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "Riwayat Pencairan";
		$data['content']		= "front/front_page/dashboard/campaign/detail/riwayat_pencairan";
		$this->load->view('front/layout', $data);
	}

	/*===================== Dashboard Campaign Setting Campaign (Request Campaign) =====================*/
	function editcampaign($campaign_id){
		$getProgram 			= $this->M_program->getOneData("id", $campaign_id);
		// Get Tipe Program
		$getProgramTipe 		= $this->M_programtipe->getData();
		// Get Media
		$getMedia 				= $this->M_media->getOneData("id_program", $getProgram->id);

		$data['media']			= $getMedia;
		$data['tipeProgram']	= $getProgramTipe;
		$data['program']		= $getProgram;
		$data['title']			= "Kita Wakaf - Setting Program";
		$data['dash_campaign']	= array("ok");
		$data['title_head']		= "Edit Program";
		$data['content']		= "front/front_page/dashboard/campaign/editcampaign";
		$this->load->view('front/layout', $data);
	}

	function doUpdateCampaign($id_program){
		$post = $this->input->post();
		
		// Buat ID program
		$id = $id_program;

		if(!empty($_FILES['gambar']['name'])){
			// Buat nama file
			$nama_file = 'PRG-'.date('ydmhis').rand(10,99);

			// Configuration for file upload
			$config['upload_path']          = 'assets/images/program/';
			$config['allowed_types']        = 'jpg|png';
			$config['max_size']             = 5000;
			$config['max_width']            = 2000;
			$config['max_height']           = 2000;
			$config['file_name']			= $nama_file;

			$this->load->library('upload', $config);
			$this->upload->initialize($config);
	 
			if ( ! $this->upload->do_upload('gambar')){
				$error = array('error' => $this->upload->display_errors());
			}else{
				$data = array('upload_data' => $this->upload->data());
			}

			$mediaArray = array(
				// "id"      			=> guid(),
				"id_program"     	=> $id,
				"images"   			=> "assets/images/program/".$this->upload->data('orig_name'),
				"status"   			=> 1,
				"created_date"     	=> date('Y-m-d H:i:s'),
				"created_by"       	=> $this->sessionNadzir['nadzir_id'],
			);

			// $this->db->insert("media", $mediaArray);
			$this->db->update("media", $mediaArray, ["id_program" => $id_program]);
			
			$insertArray = array(
				"id"      			=> $id,
				"id_nadzir"     	=> $this->sessionNadzir['nadzir_id'],
				"id_program_type"   => $post['kategori_wakaf'],
				"name"     			=> $post['nama_program'],
				"url"				=> $post['url'],
				"description" 		=> $post['deskripsi'],
				"fund_target"       => str_replace(".", "", $post['target_donasi']),
				"start_date"  		=> date('Y-m-d'),
				"end_date"      	=> date('Y-m-d', strtotime($post['tgl_akhir'])),
				"short_description"	=> $post['deskripsi_singkat'],
				// "status"        	=> 0,
				// "created_date"     	=> date('Y-m-d H:i:s'),
				// "created_by"       	=> $this->sessionNadzir['nadzir_id']
			);
		}else{
			$insertArray = array(
				"id"      			=> $id,
				"id_nadzir"     	=> $this->sessionNadzir['nadzir_id'],
				"id_program_type"   => $post['kategori_wakaf'],
				"name"     			=> $post['nama_program'],
				"url"				=> $post['url'],
				"description" 		=> $post['deskripsi'],
				"fund_target"       => str_replace(".", "", $post['target_donasi']),
				"start_date"  		=> date('Y-m-d'),
				"end_date"      	=> date('Y-m-d', strtotime($post['tgl_akhir'])),
				"short_description"	=> $post['deskripsi_singkat'],
				// "status"        	=> 0,
				// "created_date"     	=> date('Y-m-d H:i:s'),
				// "created_by"       	=> $this->sessionNadzir['nadzir_id']
			);
		}

		$reqUpdate 	= [
						"request_update"	=> json_encode($insertArray),
						"updated_date"		=> date("Y-m-d H:i:s"),
						"updated_by"		=> $this->sessionNadzir['nadzir_id']
					];

		$requestUpdate	= $this->db->update("program", $reqUpdate, ["id" => $id_program]);
		if ($requestUpdate) {
			custom_notif("success", "Notif", "Permintaan update berhasil, harap tunggu untuk persetujuan...");
			redirect("dashboard/campaigns/editcampaign/".$id_program);
		}else{
			custom_notif("failed", "Notif", "Permintaan gagal");
			redirect("dashboard/campaigns/editcampaign/".$id_program);
		}
	}

	/*===================== Dashboard Campaign Setting Campaign (Request Delete Campaign) =====================*/
	function doDeletedCampaign($id_program){

		$reqDeleted 	= [
						"is_deleted"		=> "2",
						"updated_date"		=> date("Y-m-d H:i:s"),
						"updated_by"		=> $this->sessionNadzir['nadzir_id']
					];

		$requestUpdate	= $this->db->update("program", $reqDeleted, ["id" => $id_program]);

		if ($requestUpdate) {
			custom_notif("success", "Notif", "Permintaan hapus campaign berhasil, harap tunggu untuk persetujuan...");
			redirect("dashboard/overview/");
		}else{
			custom_notif("failed", "Notif", "Permintaan gagal");
			redirect("dashboard/overview/");
		}
	}

}