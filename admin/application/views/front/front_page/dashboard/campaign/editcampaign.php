<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show" id="water" role="tabpanel">
						
						<div class="xs-horizontal-tabs">
							
							<ul class="nav nav-tabs" role="tablist">
								<li class="nav-item w_nav_item">
									<a class="nav-link active" data-toggle="tab" href="#info" role="tab">1. Info Program</a>
								</li>
								<li class="nav-item w_nav_item">
									<a class="nav-link" data-toggle="tab" href="#deskripsi" role="tab">2. Deskripsi Program</a>
								</li>

							</ul>
							<form method="post" action="<?= base_url('dashboard/campaigns/doUpdateCampaign/'.$this->uri->segment(4)); ?>" enctype="multipart/form-data">
								<div class="tab-content">
									
									<!-- Informasi Campaign -->
									<div class="tab-pane fade show active" id="info" role="tabpanel">
										<div class="form-group">
											<label for="xs-donate-charity">Kategori Wakaf <span class="color-light-red" >*</span></label>
											<select name="kategori_wakaf" class="input-control" required="">
												<option value="">Pilih Kategori Wakaf</option>
											<?php 
												foreach ($tipeProgram as $lTipe) {
											?>
													<option value="<?= $lTipe->id ?>" <?= check_selected($program->id_program_type, $lTipe->id) ?>><?= $lTipe->name ?></option>
											<?php 
												}
											?>
											</select>
										</div>

										<div class="form-group">
											<label for="xs-donate-charity">Judul Penggalangan Dana <span class="color-light-red" >*</span></label>
											<input type="text" name="nama_program" class="input-control" value="<?= $program->name ?>" required="">
										</div>

										<div class="form-group">
											<label for="xs-donate-charity">Target Donasi <span class="color-light-red" >*</span></label>
											<div class="input-group mb-12">
												<div class="input-group-prepend">
													<div class="input-group-text">Rp</div>
												</div>
												<input type="text" class="form-control input-focus uang" name="target_donasi" id="inlineFormInputGroup" placeholder="0" value="<?= number_format($program->fund_target) ?>" required="">
											</div>
										</div>

										<div class="form-group">
											<label for="xs-donate-charity">Batas Waktu Penggalangan<span class="color-light-red" >*</span></label>
											<input type="text" name="tgl_akhir" class="input-control selector" value="<?= date('Y-m-d', strtotime($program->end_date)) ?>" required="">
										</div>
										<hr>
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Tentukan link untuk Program <span class="color-light-red" >*</span></label></h6>
											<label for="xs-donate-charity">Link harus dimulai dengan huruf, tanpa spasi.</label>
											<div class="input-group mb-12">
												<div class="input-group-prepend">
													<div class="input-group-text">kitawakaf.com/</div>
												</div>
												<input type="text" name="url" class="form-control input-focus" id="inlineFormInputGroup" placeholder="Contoh : rumahtahfidz" value="<?= $program->url ?>" required="">
											</div>
										</div>
									</div>
									<!-- End Informasi -->

									<!-- Deskripsi Campaign -->
									<div class="tab-pane" id="deskripsi" role="tabpanel">
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Upload gambar untuk program Anda <span class="color-light-red" >*</span></label></h6>
											<label for="xs-donate-charity">Format harus JPG/PNG.</label>
											<input type="file" multiple name="gambar" onchange="preview(this);" id="demo-hor-12" class="form-control">
                                   			<!-- <span id="previewImg" ></span> -->
                                   			<span id="previewImg">
			                                	<?php if (!empty($media->images)) { ?>
			                                		<div style="border:1px solid #303641;padding:5px;margin:5px;text-align: center;" class='col-md-12'>
			                                			<img height="200" width="200" src="<?= base_url($media->images) ?>">
			                                		</div>
			                                	<?php } ?>
			                                </span>
										</div><br>
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Ceritakan tentang diri Anda, alasan penggalangan dana, dan rencana penggunaan dana  <span class="color-light-red" >*</span></label></h6>
											<textarea name="deskripsi" class="summernote"  required=""><?= $program->description ?></textarea>
										</div><br>
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Tulis ajakan singkat untuk mengajak orang berwakaf  <span class="color-light-red" >*</span></label></h6>
											<textarea name="deskripsi_singkat" class="input-control" rows="5" required="" placeholder="Contoh : Mohon bantuannya untuk pembangunan Rumah Tahfidz untuk anak yatim."><?= $program->short_description ?></textarea>
										</div>

										<button type="submit" class="btn btn-primary" style="float: right;">Simpan</button>
									</div>
									<!-- End Deskripsi -->

								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
window.preview = function (input) {
	if (input.files && input.files[0]) {
	   $("#previewImg").html('');
	   $(input.files).each(function () {
	       var reader = new FileReader();
	       reader.readAsDataURL(this);
	       reader.onload = function (e) {
	           $("#previewImg").append(
	           	"<div style='border:1px solid #303641;padding:5px;margin:5px;text-align: center;' class='col-md-12'><img height='300' width='300' src='" + e.target.result + "'></div>"
	           	);
	       }
	   });
	}
}
</script>