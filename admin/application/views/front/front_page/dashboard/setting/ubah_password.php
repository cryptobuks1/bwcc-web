<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<form method="post" action="<?= base_url('dashboard/setting/doUpdatePass'); ?>" enctype="multipart/form-data">
						<input type="hidden" class="input-control" name="nadzir_id" value="<?= $detailData['nadzir_id'] ?>" required="" readonly>
						<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Password Lama</label>
							</div>
							<div class="col-md-9">
								<input type="password" class="input-control" name="old_pass" value="" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Password Baru</label>
							</div>
							<div class="col-md-9">
								<input type="password" class="input-control" name="new_pass" value="" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Konfirmasi Password Baru</label>
							</div>
							<div class="col-md-9">
								<input type="password" class="input-control" name="konf_new_pass" value="" required="">
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
