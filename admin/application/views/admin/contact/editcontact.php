<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Edit Contact</h5>
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
			<form method="post" action="<?= base_url('cms/contact/doUpdate'); ?>">
				<input type="hidden" class="form-control" name="param" required="" value="<?= $id ?>">
				<div class="card">
					<div class="card-header main-head">Edit Contact</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Alamat Klinik</label>
							<div class="col-md-10">
								<textarea class="form-control" rows="8" name="alamat_klinik"><?= $detailContact->alamat_klinik ?></textarea>
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Email</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="email" required="" value="<?= $detailContact->email ?>">
							</div>
						</div>

						<?php
						$no = 1;
						$dec_phone_number = json_decode($detailContact->phone_number, true);
						?>

						<?php
						foreach ($dec_phone_number as $val_number_phone) {
							?>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Nomor Telepon <?= $no; ?></label>
							<div class="col-md-10">
								<input type="number" class="form-control"  name="phone_number[]" value="<?= $val_number_phone ?>">
							</div>
						</div>

						<?php
						$no++;
						}
						?>

						<div id="dokter">

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
								<input type="number" class="form-control"  name="whatsapp_number" value="<?= $detailContact->whatsapp_number ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL Facebook</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="facebook" value="<?= $detailContact->facebook ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name Facebook</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="facebook_name" value="<?= $detailContact->facebook_name ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL instagram</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="instagram" value="<?= $detailContact->instagram ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name instagram</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="instagram_name" value="<?= $detailContact->instagram_name ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL youtube</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="youtube" value="<?= $detailContact->youtube ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name youtube</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="youtube_name" value="<?= $detailContact->youtube_name ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL twitter</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="twitter" value="<?= $detailContact->twitter ?>">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name twitter</label>
							<div class="col-md-10">
								<input type="text" class="form-control"  name="twitter_name" value="<?= $detailContact->twitter_name ?>">
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