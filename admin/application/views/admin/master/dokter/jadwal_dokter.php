<!-- BEGIN .main-heading -->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Jadwal Dokter</h5>
					<h6 class="sub-heading">Jadwal Dokter</h6>
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
			<form method="post" action="<?= base_url('cms/dokter/updatejadwal'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head"><?= $nama_dokter; ?></div>
					<div class="card-body">
						<?php echo return_custom_notif();?>
						<input type="hidden" class="form-control" name="id_dokter" placeholder="Kode Poli" value="<?= $id_dokter ?>" required="">
						<?php 
						if (empty($doctor_absent_list)) {
						?>

						<div id="list_absent">

							<div class="date-item col-md-4">
								<div class="card">
									<div class="card-header clearfix">
										<h5>Pilih Jadwal
										<button class="btn-date-delete btn btn-success btn-sm" type="button" title="Delete" style="float:right" id="moreabsentlist">
											<i class="fa fa-plus"></i>
										</button>
									</div>
									<div class="card-body">
										<p class="card-title">Plilh Hari</p>
										<div class="card-text">
											<div class="mb-3">
												<div class="row">
													<div class="col-md-12 clearfix" style="display: flex">
														<select class="form-control" name="day[]" required>
															<option selected disabled value=""> - </option>
															<option value="senin"> senin </option>
															<option value="selasa"> selasa </option>
															<option value="rabu"> rabu </option>
															<option value="kamis"> kamis </option>
															<option value="jumat"> jumat </option>
															<option value="sabtu"> sabtu </option>
															<option value="minggu"> minggu </option>
														</select>
														</div>
													</div>
												</div>
												<div class="schedule-item-time-area row"></div>
												<p class="card-title">Jam Hadir - Selesai</p>
												<div class="mb-3">
												<div class="row">
													<div class="col-md-12 clearfix" style="display: flex">
														<input type="time" class="start-time form-control form-control-sm" style="margin-right: 3px" name="start_absent[]">
														<input type="time" class="finish-time form-control form-control-sm" style="margin-right: 3px" name="end_absent[]">
														</div>
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>

						</div>

						<div id="more_absent">
							
						</div>

						<?php
						}
						else
						{
						?>
						<button class="btn-date-delete btn btn-success btn-sm" type="button" title="Delete" style="float:right" id="moreabsentlist">
											<i class="fa fa-plus"></i> Tambah Jadwal Lain
										</button>

						<div id="more_absent">
							
						</div>
						<?php
						$listday = array('senin' , 'selasa' , 'rabu' , 'kamis' , 'jumat' , 'sabtu' , 'minggu');
						foreach ($doctor_absent_list as $val_doctor_absent_list) {
							# code...
						?>
						<div id="list_absent_available_<?php echo $val_doctor_absent_list->id; ?>">

						

							<div class="absent_available_list_<?php echo $val_doctor_absent_list->id; ?> col-md-4">
								<div class="card">
									<div class="card-header clearfix">
										<h5>Pilih Jadwal
										
											<a class="removerowabsent_available" title="Delete" style="float:right" id="deletethisabsent" data-id="<?php echo $val_doctor_absent_list->id; ?>"><i class="fa fa-trash"></i></a>
										
									</div>
									<div class="card-body">
										<p class="card-title">Plilh Hari</p>
										<div class="card-text">
											<div class="mb-3">
												<div class="row">
													<div class="col-md-12 clearfix" style="display: flex">
														<select class="form-control" name="day[]" required>
															<option selected disabled value=""> - </option>
															<?php foreach ($listday as $val_listday) {
																# code...
															?>
															<option value="<?= $val_listday; ?>" <?php if($val_listday == $val_doctor_absent_list->day){ echo "selected"; } ?> > <?= $val_listday; ?> </option>
															<?php
															}
															?>
														</select>
														</div>
													</div>
												</div>
												<div class="schedule-item-time-area row"></div>
												<p class="card-title">Jam Hadir - Selesai</p>
												<div class="mb-3">
												<div class="row">
													<div class="col-md-12 clearfix" style="display: flex">
														<input type="time" class="start-time form-control form-control-sm" style="margin-right: 3px" name="start_absent[]" value="<?= $val_doctor_absent_list->start_absent; ?>">
														<input type="time" class="finish-time form-control form-control-sm" style="margin-right: 3px" name="end_absent[]" value="<?= $val_doctor_absent_list->end_absent; ?>">
														</div>
													</div>
												</div>
											</div>
										</div>
								</div>
							</div>

						
						</div>
						<?php
							}
						}
						?>
						
						

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

<script>

function Generator(){;

	Generator.prototype.rand = Math.floor(Math.random() * 26) + Date.now();

	Generator.prototype.getId = function() {
	return this.rand++;

	}
}
	$(document).ready(function(){
	  $("#moreabsentlist").click(function(){
	  	idGen = new Generator();
		var $randomId = idGen.getId();
	    $("#more_absent").append('<div class="new_more_absent"><div class="newabsentrow_'+ $randomId +' date-item col-md-4"><div class="card"><div class="card-header clearfix"><h5>Pilih Jadwal </h5><a class="removerowabsent btn-date-delete btn btn-danger btn-sm" title="Delete" style="float:right" id="deletethisabsent" data-id="'+ $randomId +'"><i class="fa fa-trash"></i></a></div><div class="card-body"><p class="card-title">Plilh Hari</p><div class="card-text"><div class="mb-3"><div class="row"><div class="col-md-12 clearfix" style="display: flex"><select class="form-control" name="day[]" required><option selected disabled value=""> - </option><option value="senin"> senin </option><option value="selasa"> selasa </option><option value="rabu"> rabu </option><option value="kamis"> kamis </option><option value="jumat"> jumat </option><option value="sabtu"> sabtu </option><option value="minggu"> minggu </option></select></div></div></div><div class="schedule-item-time-area row"></div><p class="card-title">Jam Hadir - Selesai</p><div class="mb-3"><div class="row"><div class="col-md-12 clearfix" style="display: flex"><input type="time" class="start-time form-control form-control-sm" style="margin-right: 3px" name="start_absent[]"><input type="time" class="finish-time form-control form-control-sm" style="margin-right: 3px" name="end_absent[]"></div></div></div></div></div></div></div></div>'
	    	);
	  });
	});

// Remove parent of 'remove' link when link is clicked.
$('#more_absent').on('click', '.removerowabsent', function(e) {
    e.preventDefault();
    var randomcheck = $(this).attr("data-id");

    $('.newabsentrow_'+randomcheck+'').parent().remove();
});


<?php
						$listday = array('senin' , 'selasa' , 'rabu' , 'kamis' , 'jumat' , 'sabtu' , 'minggu');
						foreach ($doctor_absent_list as $val_doctor_absent_list) {
							# code...
						?>

						$('#list_absent_available_<?php echo $val_doctor_absent_list->id; ?>').on('click', '.removerowabsent_available', function(e) {
						    e.preventDefault();
						    var availabsent = $(this).attr("data-id");
						    console.log(availabsent);
						    $('.absent_available_list_'+availabsent+'').parent().remove();
						});

						<?
					}
					?>


</script>