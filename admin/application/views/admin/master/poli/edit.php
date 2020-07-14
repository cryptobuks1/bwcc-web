<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Edit Poli</h5>
					<h6 class="sub-heading">Poli</h6>
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
			<form method="post" action="<?= base_url('cms/poli/doUpdate/'.$detailData->id); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Edit Poli</div>
					<div class="card-body">
						<?php echo return_custom_notif();?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Kode Poli</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="poli_kode" placeholder="Kode Poli" value="<?= $detailData->poly_code ?>" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Nama</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="poli_nama" placeholder="Nama Poli" value="<?= $detailData->name ?>" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Spesialis</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" name="spesialis_id" id="spesialis_id" data-live-search="true" required="">
									<option selected disabled value="">Spesialis dalam bidang</option>
								<?php foreach ($spesialis as $v_spesialis) { ?>
									<option value="<?= $v_spesialis->id ?>" <?= check_selected($v_spesialis->id, $detailData->id_specialist) ?>><?= $v_spesialis->name ?></option>
								<?php } ?>
								</select>
							</div>
						</div>
<!-- 						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Pembayaran yang di dukung</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" name="spesialis_pembayaran[]" id="spesialis_pembayaran" data-live-search="true" multiple>
									<option value="">Spesialis dalam bidang</option>
								<?php 
									foreach ($pembayaran as $key => $v_pembayaran) { 
									$getPembayaran = json_decode($detailData->id_payment);

									if (check_selected($v_pembayaran->id, $getPembayaran[$key])) {
										$selected = "selected";
									}else{
										$selected = "";
									}
								?>

									<option value="<?= $v_pembayaran->id ?>" <?= $selected ?>><?= $v_pembayaran->name ?></option>
								<?php } ?>
								</select>
							</div>
						</div> -->
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

