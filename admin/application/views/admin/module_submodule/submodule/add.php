	<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Sub Module</h5>
					<h6 class="sub-heading">Sub Module</h6>
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
			<form method="post" action="<?= base_url('cms/module/doAddSub'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Sub Module</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Module Name</label>
							<div class="col-md-10">
								<input type="hidden" name="module_id" value="<?= encrypt_decrypt('encrypt', $dataModule->module_id); ?>">
								<input type="text" class="form-control" name="module_name" placeholder="Module Name" value="<?= $dataModule->module_name ?>" readonly  required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Sub Module Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="submodule_name" placeholder="Sub Module Name"  required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Order Number Sub</label>
							<div class="col-md-10">
								<input type="number" class="form-control" name="order_number_sub" placeholder="Order Number"  required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">URL Sub</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="module_url" placeholder=""  required="" value="">
							</div>
						</div>
						<!-- <div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Icon</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="module_name" placeholder="Module Name"  required="" value="fa fa-">
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