<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Dokter</h5>
					<h6 class="sub-heading">Dokter</h6>
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
			<form method="post" action="<?= base_url('cms/dokter/doAdd'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add Dokter</div>
					<div class="card-body">
						<?php echo return_custom_notif();?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Nama</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="dokter_nama" placeholder="Nama Dokter" value="" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Nomor STR</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="dokter_no_str" placeholder="Nomor STR" value="" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Spesialis</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" name="spesialis_id" id="spesialis_id" data-live-search="true" required>
									<option selected disabled>Spesialis dalam bidang</option>
								<?php foreach ($spesialis as $v_spesialis) { ?>
									<option value="<?= $v_spesialis->id ?>"><?= $v_spesialis->name ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Pengalaman (Tahun)</label>
							<div class="col-md-10">
								<input type="number" class="form-control" name="dokter_experience" placeholder="" value="" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Jenis Kelamin</label>
							<div class="col-md-10">
								<label class="custom-control custom-radio">
									<input id="radio1" name="jk" type="radio" class="custom-control-input" value="L" checked>
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">Laki - Laki</span>
								</label>
								<label class="custom-control custom-radio">
									<input id="radio2" name="jk" type="radio" class="custom-control-input" value="P">
									<span class="custom-control-indicator"></span>
									<span class="custom-control-description">Perempuan</span>
								</label>
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Photo</label>
							<div class="col-md-10">
								<input type="file" class="form-control" name="photo" accept="image/*">
								<!-- <span class="text-danger">*Maksimal ukuran 512 x 512</span> -->
							</div>
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

