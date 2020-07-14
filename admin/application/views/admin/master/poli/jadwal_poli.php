<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Jawal Poli</h5>
					<h6 class="sub-heading">Jadwal Poli</h6>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
				<div class="right-actions">
					
				</div>
			</div>
		</div>
	</div>
</header>
<!-- END: .main-heading -->

<!-- BEGIN .main-content -->
<div class="main-content">
	<div class="row gutters">
		<div class="col-md-12">
			<form method="post" action="<?= base_url('cms/poli/addSchedule'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add Poli</div>
					<div class="card-body">
						<?php echo return_custom_notif();?>
						
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Tipe</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" name="jadwal_tipe" id="tipe" data-live-search="true">
									<option value="1">Mingguan</option>
									<option value="2">Bulanan</option>
								</select>
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label"></label>
							<div class="col-md-10">
								<input type="hidden" class="form-control" name="poli_kode" placeholder="Kode Poli" value="<?= $id_poly ?>" required="">
							</div>
						</div>

						<div id="jadwal">
							<!-- <div class="form-group row gutters">
								<div class="col-sm-2">&nbsp;</div>
								<div class="col-sm-1 text-center">Senin</div>
								<div class="col-sm-1 text-center">Selasa</div>
								<div class="col-sm-1 text-center">Rabu</div>
								<div class="col-sm-1 text-center">Kamis</div>
								<div class="col-sm-1 text-center">Jumat</div>
								<div class="col-sm-1 text-center">Sabtu</div>
								<div class="col-sm-1 text-center">Minggu</div>
							</div>
							<div class="form-group row gutters">
								<label class="col-sm-2 col-form-label">Jam Pelayanan</label>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="start_poli_nama[]" placeholder="" value=""></div>
							</div>
							<div class="form-group row gutters">
								<label class="col-md-2 col-form-label">Akhir Pelayanan</label>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="end_pelayanan[]" placeholder="" value=""></div>
							</div>
							<div class="form-group row gutters">
								<label class="col-md-2 col-form-label">Kuota</label>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota[]" placeholder="" value=""></div>
							</div>
							<div class="form-group row gutters">
								<label class="col-sm-2 col-form-label">Jam Onsite</label>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
								<div class="col-1"><input type="time" class="form-control" name="jam_onsite[]" placeholder="" value=""></div>
							</div>
							<div class="form-group row gutters">
								<label class="col-md-2 col-form-label">Akhir Onsite</label>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="time" class="form-control" name="akhir_onsite[]" placeholder="" value=""></div>
							</div>
							<div class="form-group row gutters">
								<label class="col-md-2 col-form-label">Online</label>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
								<div class="col-md-1"><input type="number" class="form-control" name="kuota_online[]" placeholder="" value=""></div>
							</div> -->
						</div>
					</div>
					<div class="card-footer">
						<a href="<?= $back_link; ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
	$("#tipe").change(function(event) {
		var _type = $("#tipe").val();
		if (_type == 1) {
			$("#jadwal").empty();
			loadchin();
		}else{
			
		}
	});

	function loadchin(){
		// $("#jadwal").html("Loading Content");
		$.ajax({
			url: '<?= base_url("cms/poli/getMingguan/"); ?>',
			type: 'GET',
			dataType: 'HTML',
			async: true,
			processData: false,
			contentType: false
		})
		.done(function(e) {
			$("#jadwal").html(e);
		})
		.fail(function() {
			$("#jadwal").html("No Content Data");
		})
		.always(function() {
			console.log("complete");
		});
	}
</script>

