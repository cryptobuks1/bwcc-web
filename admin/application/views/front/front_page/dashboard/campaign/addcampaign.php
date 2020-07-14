<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
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
							<form method="post" action="<?= base_url('dashboard/campaigns/doAddCampaign'); ?>" enctype="multipart/form-data">
								<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
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
													<option value="<?= $lTipe->id ?>"><?= $lTipe->name ?></option>
													<?php 
												}
												?>
											</select>
										</div>

										<div class="form-group">
											<label for="xs-donate-charity">Judul Penggalangan Dana <span class="color-light-red" >*</span></label>
											<input type="text" name="nama_program" class="input-control" required="">
										</div>

										<div class="form-group">
											<label for="xs-donate-charity">Target Donasi <span class="color-light-red" >*</span></label>
											<div class="input-group mb-12">
												<div class="input-group-prepend">
													<div class="input-group-text">Rp</div>
												</div>
												<input type="text" class="form-control input-focus uang" name="target_donasi" id="nominal" placeholder="0" required="">
											</div>
										</div>

										<div class="form-group tab" id="estimasi">
											<span class="color-orange">Perhatian! </span><label for="xs-donate-charity">Ekspetasi biaya admin tertinggi adalah <span class="color-light-red" id="estimasi_harga" >50.000.000</span></label>
										</div>

										<div class="form-group">
											<label for="xs-donate-charity">Batas Waktu Penggalangan<span class="color-light-red" >*</span></label>
											<input type="text" name="tgl_akhir" class="input-control selector" value="<?= date('Y-m-d') ?>" required="">
										</div>
										<hr>
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Tentukan link untuk program <span class="color-light-red" >*</span></label></h6>
											<label for="xs-donate-charity">Link harus dimulai dengan huruf, tanpa spasi.</label>
											<div class="input-group mb-12">
												<div class="input-group-prepend">
													<div class="input-group-text">kitawakaf.com/</div>
												</div>
												<input type="text" name="url" class="form-control input-focus" id="inlineFormInputGroup" placeholder="Contoh : rumahtahfidz" required="">
											</div>
										</div>
									</div>
									<!-- End Informasi -->

									<!-- Deskripsi Campaign -->
									<div class="tab-pane" id="deskripsi" role="tabpanel">
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Upload gambar untuk Program Anda <span class="color-light-red" >*</span></label></h6>
											<label for="xs-donate-charity">Ukuran gambar yang disarankan 1800 x 1100 px <span class="color-light-red" >*</span></label><br>
											<label for="xs-donate-charity">Format harus JPG/PNG.</label>
											<input type="file" multiple name="gambar" onchange="preview(this);" id="demo-hor-12" class="form-control required" required="">
											<span id="previewImg" ></span>
										</div><br>
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Ceritakan tentang diri Anda, alasan penggalangan dana, dan rencana penggunaan dana  <span class="color-light-red" >*</span></label></h6>
											<!-- <textarea name="deskripsi" class="summernote" required=""></textarea> -->
											<textarea name="deskripsi" class="summernote"></textarea>
										</div><br>
										<div class="form-group">
											<h6><label for="xs-donate-charity color-navy-blue">Tulis ajakan singkat untuk mengajak orang berwakaf  <span class="color-light-red" >*</span></label></h6>
											<textarea name="deskripsi_singkat" class="input-control" rows="5" required="" placeholder="Contoh : Mohon bantuannya untuk pembangunan Rumah Tahfidz untuk anak yatim."></textarea>
										</div>
										<div class="form-group">
											<input type="checkbox" name="approve" value="1" id="agree"> Dengan mengklik ini, Anda setuju dengan perjanjian yang ada.<br>
										</div>

										<button type="submit" class="btn btn-primary" id="save" style="float: right;" disabled="">Simpan</button>
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
$(document).ready(function(){
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

	$("#nominal").on("blur", function(){
		var val 	= $("#nominal").val();
		var nominal = val.split('.').join('');

		$.get("<?= base_url('dashboard/campaigns/getInfoAdministrasi/') ?>"+nominal, function(data){
			$("#estimasi").show();
			$("#estimasi_harga").text(data);
		});
	});

	$("#agree").on("change", function(){
		if (this.checked) {
			$('#save').prop("disabled", false);
		}else{
			$('#save').prop("disabled", true);
		}
	});
});
</script>