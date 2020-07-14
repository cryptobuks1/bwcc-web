<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $program->name ?></h5>
				<h6><?= $title_head ?></h6><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<form method="post" action="<?= base_url('dashboard/campaigns/doUpdateKegiatan/'.$updateProgram->id); ?>" enctype="multipart/form-data">
						<input type="hidden" name="campaign_id" value="<?= $updateProgram->id_program ?>" required readonly>
						<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Judul</label>
							</div>
							<div class="col-md-9">
								<input type="text" class="input-control" name="judul" value="<?= $updateProgram->judul ?>" required="">
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Deskripsi Kegiatan</label>
							</div>
							<div class="col-md-9">
								<textarea name="deskripsi" class="input-control summernote" required=""><?= $updateProgram->deskripsi ?></textarea>
							</div>
						</div>
						<div class="form-group row">
							<div class="col-md-3"></div>
							<div class="col-md-9">
								<a href="<?= base_url('dashboard/campaigns/listupdate/'.$updateProgram->id_program) ?>" class="btn btn-primary bg-danger"> Kembali</a>
								<button type="submit" class="btn btn-primary">Simpan</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</section>

