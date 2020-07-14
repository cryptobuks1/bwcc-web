<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Add Contact</h5>
					<h6 class="sub-heading">Contact</h6>
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
			<form method="post" action="<?= base_url('cms/contact/doAdd'); ?>">
				<div class="card">
					<div class="card-header main-head">Add Contact</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Alamat Klinik</label>
							<div class="col-md-10">
								<textarea class="form-control" rows="8" name="alamat_klinik"></textarea>
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Email</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="email" required="">
							</div>
						</div>

						<!-- <div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Nomor Telepon</label>
							<div class="col-md-10">
								<input type="number" class="form-control"  name="phone_number" required="">
							</div>
						</div> -->

						<div id="dokter">
							<input type="hidden" value="0" id="bankcount">
							<div class="form-group row gutters">
								<label class="col-md-2 col-form-label">Nomor Telepon</label>
									<div class="col-md-10">
										<input type="number" class="form-control"  name="phone_number[]" required="">
									</div>
							</div>

						</div>

						<div id="another_number">

						</div>

						<div class="form-group row gutters">
							<div class="col-md-2"></div>
							<div class="col-md-2">
								<button type="button" class="btn btn-success" id="tambah"><i class="fa fa-plus"></i> Tambah Nomor telepon</button>

							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Nomor Telepon Whatsapp</label>
							<div class="col-md-10">
								<input type="number" class="form-control"  name="whatsapp_number">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL Facebook</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="facebook">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name Facebook</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="facebook_name">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL instagram</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="instagram">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name instagram</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="instagram_name">
							</div>
						</div>


						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL youtube</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="youtube">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name youtube</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="youtube_name">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL twitter</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="twitter">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name twitter</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="twitter_name">
							</div>
						</div>

					</div>
					<div class="card-footer">
						<a href="<?= base_url('cms/contact'); ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
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
			url: '<?= base_url("cms/contact/show_phone_number_input/"); ?>',
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