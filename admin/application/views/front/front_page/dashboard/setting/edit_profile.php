<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<form method="post" action="<?= base_url('dashboard/setting/doUpdateProfile'); ?>" enctype="multipart/form-data">
						<input type="hidden" class="input-control" name="nadzir_id" value="<?= $nadzir->id ?>" required="" readonly>
						<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Nama Lengkap</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="institution_name" value="<?= $nadzir->institution_name ?>" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Email</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="email" value="<?= $nadzir->email ?>" required="" disabled>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Nomor Telepon</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="no_hp" value="<?= $nadzir->no_telp ?>" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Alamat</label>
							</div>
							<div class="col-md-9">
								<textarea class="input-control" name="alamat" rows="5"><?= $nadzir->institution_address ?></textarea>
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Biografi singkat</label>
							</div>
							<div class="col-md-9">
								<textarea name="biodata" class="summernote"><?= $nadzir->biodata ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>

					</form>
				</div>
			</div>
		</div>
	</div>
</section>
