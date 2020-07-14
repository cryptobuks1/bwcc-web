<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>edit instructor schedule</h5>
					<h6 class="sub-heading">instructor schedule</h6>
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
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<form method="post" action="<?= base_url('cms/instructor/sub_edit_schedule_instructor/'.$dataedit->id.''); ?>">
				<div class="card">
					<div class="card-header main-head">edit instructor schedule</div>
					<div class="card-body">
						<div class="confirm-div">
							<?php echo $this->session->flashdata('warning_quota'); ?>
						</div>
						<br>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Date</label>
							<div class="col-md-10">
								<input placeholder="Selected date" type="text" name="start_date" id="date-1" class="form-control datepicker" data-provide="datepicker" required="" value="<?= date('m-d-Y', strtotime($dataedit->start_date)); ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Start Time</label>
							<div class="col-md-10">
								<input id="start_time_service" type="time" class="form-control" name="start_time" required="" value="<?= $dataedit->start_time ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Finish Time</label>
							<div class="col-md-10">
								<input id="start_time_service" type="time" class="form-control" name="finish_time" required="" value="<?= $dataedit->finish_time ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Pilihan Quota ( remain : <?= $dataedit->quota_remain ?> )</label>
							<div class="col-md-10">
								<select name="quota_choose" class="form-control" required>
									<option selected disabled value=""> - </option>
									<option value="1"> Tambahkan Quota </option>
									<option value="2"> Kurangi Quota </option>
								</select>
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Quota ( current : <?= $dataedit->quota ?> )</label>
							<div class="col-md-10">
								<input type="number" class="form-control" name="quota" required="" value="<?= $dataedit->quota ?>">
							</div>
						</div>

						

					</div>
					<div class="card-footer">
						<a href="<?= base_url('cms/instructor/view_schedule_instructor/'.$dataedit->id_instructor.''); ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- <script type="text/javascript">
$("#tambah").click(function(event) {
		var _cnt = $("#bankcount").val();
		var _cnt = parseInt(_cnt)+1;
		$("#bankcount").val(_cnt);

		$.ajax({
			url: '<?= base_url("cms/instructor schedule/show_phone_number_input/"); ?>',
			type: 'GET',
			dataType: 'HTML',
			async: true,
			processData: false,
			contentType: false
		})
		.done(function(e) {

			$("#dokter").append(e);
			$('.selectpicker').selectpicker('refresh');
		})
		.fail(function() {
			$("#dokter").html("No Content Data");
		})
		.always(function() {
			console.log("complete");
		});

	});

	function deldiv(_par){
		$("#"+_par).remove();
	}
</script> -->

<script>
// assumes you're using jQuery
$(document).ready(function() {
$('.confirm-div').hide();
<?php if($this->session->flashdata('warning_quota')){ ?>
$('.confirm-div').html('<div class="alert alert-warning"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button><i class="icon-close"></i><strong>Warning!</strong> <?php echo $this->session->flashdata('warning_quota'); ?></div>').show();
<?php } ?>
});
</script>