<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Edit instructor</h5>
					<h6 class="sub-heading">instructor</h6>
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
			<form method="post" action="<?= base_url('cms/instructor/doUpdate'); ?>">
				<input type="hidden" class="form-control" name="param" required="" value="<?= $id ?>">
				<div class="card">
					<div class="card-header main-head">Edit instructor</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Expertise</label>
							<div class="col-md-10">
								<select class="form-control" name="id_expertise" required>
									<option selected disabled value=""> - </option>
									<?php
									foreach ($list_expertise as $val_list_expertise) {
										# code...
									?>
									<option value="<?= $val_list_expertise->id ?>" <?php if($detailinstructor->id_expertise == $val_list_expertise->id) echo 'selected'; ?>> <?= $val_list_expertise->expertise_name ?> </option>
									<?php
									}
									?>
								</select>
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="name_instructor" required="" value="<?= $detailinstructor->name ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Gender</label>
							<div class="col-md-10">
								<select class="form-control" name="gender" required>
									<option selected="" disabled="" value=""> - </option>
									<option value="L" <?php if ($detailinstructor->gender == 'L') echo 'selected'; ?>>Pria</option>
									<option value="P" <?php if ($detailinstructor->gender == 'P') echo 'selected'; ?>>Wanita</option>
								</select>
							</div>
						</div>

					</div>
					<div class="card-footer">
						<a href="<?= base_url('cms/instructor'); ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<script type="text/javascript">
$("#tambah").click(function(event) {
		var _cnt = $("#bankcount").val();
		var _cnt = parseInt(_cnt)+1;
		$("#bankcount").val(_cnt);

		$.ajax({
			url: '<?= base_url("cms/instructor/show_phone_number_input/"); ?>',
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
</script>