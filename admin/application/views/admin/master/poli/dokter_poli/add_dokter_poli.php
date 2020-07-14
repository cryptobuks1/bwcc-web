<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Dokter Poli</h5>
					<h6 class="sub-heading">Poli disini</h6>
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
			<form method="post" action="<?= base_url('cms/poli/doAddDokterPoli'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add Dokter Poli</div>
					<div class="card-body">
						<?php echo return_custom_notif();?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label"></label>
							<div class="col-md-10">
								<input type="hidden" class="form-control" name="poli_kode" placeholder="Kode Poli" value="<?= $getPoli->id ?>" required="">
							</div>
						</div>
						<div id="dokter">
							<input type="hidden" value="0" id="bankcount">
							<div class="form-group row gutters">
								<label class="col-md-2 col-form-label">List Dokter</label>
								<div class="col-md-10">
									<select class="form-control selectpicker" name="list_dokter[]" data-live-search="true" required="">
										<option value="">- Pilih Dokter -</option>
									<?php foreach ($listDokter as $v_dokter) { ?>
										<option value="<?= $v_dokter->id ?>"><?= $v_dokter->name." (No.STR : ".$v_dokter->no_str.")" ?></option>
									<?php } ?>
									</select>
								</div>
							</div>
						</div>
						<div class="form-group row gutters">
							<div class="col-md-2"></div>
							<div class="col-md-2">
								<button type="button" class="btn btn-success" id="tambah"><i class="fa fa-plus"></i> Tambah Dokter</button>

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
$("#tambah").click(function(event) {
		var _cnt = $("#bankcount").val();
		var _cnt = parseInt(_cnt)+1;
		$("#bankcount").val(_cnt);

		$.ajax({
			url: '<?= base_url("cms/poli/jadwaldokter/"); ?>',
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