	<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<a href="<?= $back_link ?>" title="Back"><i class="fa fa-angle-left"></i></a>
				</div>
				<div class="page-title">
					<h5>Add Group Module</h5>
					<h6 class="sub-heading">Group Module</h6>
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
			<form method="post" action="<?= base_url('cms/groupmodule/doAdd'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add Group Module</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Group Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="group_name" placeholder="Group Name"  required="">
							</div>
						</div>
						<div class="main-head"><h4>Select Access</h4></div>
						<?php 
							// $CI =& get_instance();
	                        $dataModule = $this->M_module->getModule();
	                        foreach ($dataModule as $valModule) {
						?>
							<div class="form-group row gutters">
								<div class="col-md-5">
									<div class="form-check form-control">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox" name="module_name[]" value="<?= $valModule->module_id ?>"> <?= $valModule->module_name ?>
										</label>
									</div>
								</div>
							</div>

						<?php
							$sub = $this->M_module->getListSubModule("as.module_id", $valModule->module_id);
							foreach ($sub as $valSub) {
						?>

							<div class="form-group row gutters">
								<label class="col-md-1 col-form-label"></label>
								<div class="col-md-5">
									<div class="form-check form-control">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox" name="submodule_name[]" value="<?= $valSub->submodule_id ?>"> <?= $valSub->submodule_name ?>
										</label>
									</div>
								</div>
							</div>
						<?php 
								}
							}
						?>
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