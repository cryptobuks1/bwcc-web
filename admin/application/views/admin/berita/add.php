<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Berita</h5>
					<h6 class="sub-heading">Berita</h6>
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
			<form method="post" action="<?= base_url('cms/berita/doAdd'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add Berita</div>
					<div class="card-body">
						<?php echo return_custom_notif();?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Judul</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="berita_judul" placeholder="Judul Berita" value="" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Kategori Berita</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" name="id_berita" id="id_berita" data-live-search="true" required="">
									<option value="">Pilih Kategori</option>
								<?php foreach ($kategori_berita as $value) { ?>
									<option value="<?= $value->id ?>"><?= $value->name ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Tipe Media</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" name="type_media" id="ch_media" data-live-search="true" required="">
									<option value="">- Pilih Tipe Media -</option>
									<option value="1">Video</option>
									<option value="2">Gambar</option>
								</select>
							</div>
						</div>
						<div id="media">
							<!-- <div class="form-group row gutters">
								<label class="col-md-2 col-form-label">Photo</label>
								<div class="col-md-10">
									<input type="file" class="form-control" name="photo">
									<span class="text-danger">*Saran ukuran 780 x 440</span>
								</div>
							</div> -->
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Isi</label>
							<div class="col-md-10">
								<textarea class="form-control" name="berita_content" rows="10"></textarea>
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
<script type="text/javascript">
	$("#ch_media").on("change", function(){
		var media = $("#ch_media").val();

		if (media == 1) {
			var html = '<div class="form-group row gutters">\
								<label class="col-md-2 col-form-label">Link Video</label>\
								<div class="col-md-10">\
									<input type="text" class="form-control" name="photo">\
								</div>\
							</div>';
		}else if(media == 2){
			
			var html = '<div class="form-group row gutters">\
							<label class="col-md-2 col-form-label">Photo</label>\
							<div class="col-md-10">\
								<input type="file" class="form-control" name="photo">\
								<span class="text-danger">*Saran ukuran 780 x 440</span>\
							</div>\
						</div>';
		}else{
			var html = '';
		}

		$("#media").empty();
		$("#media").append(html);
	});
</script>