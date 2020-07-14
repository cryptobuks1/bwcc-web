<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<form method="post" action="<?= base_url('dashboard/setting/doUpdate/'.$bank->id); ?>" enctype="multipart/form-data">
						<?php echo return_custom_notif(); ?>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Nama Bank</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="nama_bank" value="<?= $bank->nama_bank ?>" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>No Rekening</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="no_rek" value="<?= $bank->no_rek ?>" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3">
								<label>Atas Nama</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="atas_nama" value="<?= $bank->atas_nama ?>" required="">
							</div>
						</div>

						<div class="form-group row">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<a href="<?= base_url('dashboard/setting/listbank') ?>" class="btn btn-primary bg-danger">Kembali</a>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>
