<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<form method="post" action="<?= base_url('dashboard/setting/doUpdatePic'); ?>" enctype="multipart/form-data">
						<input type="hidden" class="input-control" name="nadzir_id" value="<?= $detailData['nadzir_id'] ?>" required="" readonly>
						<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
						<div class="form-group row">
							<div class="col-md-3">
								<label>Gambar Pengguna</label>
							</div>
							<div class="col-md-9">
								<label>
									Foto yang diupload disarankan berukuran <b>70px x 70px</b><span class="color-light-red">*</span> <br>
									Dengan Format <b>JPG, JPEG atau PNG</b><span class="color-light-red">*</span>
								</label>
								<input type="file" multiple name="gambar" onchange="preview(this);" id="demo-hor-12" class="form-control">
                                <span id="previewImg">
                                	<?php if (!empty($nadzir->profile_pic)) { ?>
                                		<div style="border:1px solid #303641;padding:5px;margin:5px;text-align: center;" class='col-md-12'>
                                			<img height="200" width="200" src="<?= base_url($nadzir->profile_pic) ?>">
                                		</div>
                                	<?php } ?>
                                </span>
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

<script>
window.preview = function (input) {
	if (input.files && input.files[0]) {
	   $("#previewImg").html('');
	   $(input.files).each(function () {
	       var reader = new FileReader();
	       reader.readAsDataURL(this);
	       reader.onload = function (e) {
	           $("#previewImg").append(
	           	"<div style='border:1px solid #303641;padding:5px;margin:5px;text-align: center;' class='col-md-12'><img height='200' width='200' src='" + e.target.result + "'></div>"
	           	);
	       }
	   });
	}
}
</script>
