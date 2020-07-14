<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Add instructor to class</h5>
					<h6 class="sub-heading">class</h6>
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
			<form method="post" action="<?= base_url('cms/contclass/doadd_instructor_to_class/'.$get_from.''); ?>">
				<div class="card">
					<div class="card-header main-head">Add class</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>
						

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Instructor Name</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" data-live-search="true" name="instructor_id" required="" id="instructor_info">
									<option selected disabled value=""> - </option>
									<?php
									foreach ($val_instructor as $list_ins) {
									 	# code...
									?>
									<option value="<?= $list_ins->id; ?>"> <?= $list_ins->name; ?> </option>
									<?php
								}
								?>
								</select>
							</div>
						</div>

						<div id="dokter">
							

						</div>

						<div id="another_number">

						</div>

						<!-- <div class="form-group row gutters">
							<div class="col-md-2"></div>
							<div class="col-md-2">
								<button type="button" class="btn btn-success" id="tambah"><i class="fa fa-plus"></i> Add More Instructor</button>

							</div>
						</div> -->

					</div>
					<div class="card-footer">
						<a href="<?= base_url('cms/contclass'); ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
// $("#tambah").click(function(event) {
// 		var _cnt = $("#bankcount").val();
// 		var _cnt = parseInt(_cnt)+1;
// 		$("#bankcount").val(_cnt);

// 		$.ajax({
// 			url: '<?= base_url("cms/contclass/html_get_instructor/"); ?>',
// 			type: 'GET',
// 			dataType: 'HTML',
// 			async: true,
// 			processData: false,
// 			contentType: false
// 		})
// 		.done(function(e) {

// 			$("#dokter").append(e);
// 			$('.selectpicker').selectpicker('refresh');
// 		})
// 		.fail(function() {
// 			$("#dokter").html("No Content Data");
// 		})
// 		.always(function() {
// 			console.log("complete");
// 		});

// 	});


	$("#instructor_info").change(function(event) {
		var info_ins = $("#instructor_info").val();

		// console.log(info_ins);
		$.ajax({
			url: "<?php echo base_url('cms/contclass/html_get_schedule_instructor');?>/"+info_ins+"/",
			type: 'GET',
			dataType: 'HTML',
			async: true,
			processData: false,
			contentType: false
		})
		.done(function(e) {

			$("#dokter").empty(e);
			$("#dokter").append(e);
			$('.selectpicker').selectpicker('refresh');
		})
		.fail(function() {
			$("#dokter").html("No Content Data");
		})
		.always(function() {
			// console.log("complete");
		});

	});

	function deldiv(_par){
		$("#"+_par).remove();
	}
</script>