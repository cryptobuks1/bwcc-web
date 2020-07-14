	<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Edit Module</h5>
					<h6 class="sub-heading">Module</h6>
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
			<form method="post" action="<?= base_url('cms/module/doUpdate'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Edit Module</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>

						<input type="hidden" name="param" value="<?= encrypt_decrypt('encrypt', $detailModule->module_id); ?>">
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Module Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="module_name" placeholder="Module Name" value="<?= $detailModule->module_name ?>"  required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Order Number</label>
							<div class="col-md-10">
								<input type="number" class="form-control" name="order_number" placeholder="Order Number" value="<?= $detailModule->module_order ?>"  required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Is Parent</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" data-live-search="true" name="is_parent" id="is_parent" required="">
									<option value="1" <?php ($detailModule->isParent == 0) ? print_r("") : print_r("selected") ?>>Yes</option>
									<option value="0" <?php ($detailModule->isParent == 0) ? print_r("selected") : print_r("") ?>>No</option>
								</select>
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL Parameter</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="module_url" placeholder="If Parent please fill with #" value="<?= $detailModule->module_url ?>" required="">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Icon</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="module_icon" placeholder="Example : fa fa-users"  required="" value="<?= $detailModule->module_icon ?>">
							</div>
						</div>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label"></label>
							<div class="col-md-6">
								<label class="col-form-label"><a href="https://fontawesome.com/icons?d=gallery" target="_blank" class="text-secondary"> See All Icon</a></label>
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
