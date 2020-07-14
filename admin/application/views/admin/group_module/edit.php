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
			<form method="post" action="<?= base_url('cms/groupmodule/doUpdate/'.$detailGroup->access_group_id); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add Member</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Group Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control" name="group_name" placeholder="Group Name" value="<?= $detailGroup->access_group_name ?>"  required="">
							</div>
						</div>
						<div class="main-head"><h4>Select Access</h4></div>
						<?php
	                        $dataModule = $this->M_module->getModule();

	                        foreach ($dataModule as $keyMod => $valModule) {
	                        	$detailModule =  $this->M_groupmodule->getModuleDetailByGroup("access_group_id", $detailGroup->access_group_id, $valModule->module_id);
	                        	// $module_id = 
	                        	// debugCode($detailModule->access_module_id);
						?>
							<div class="form-group row gutters">
								<div class="col-md-5">
									<div class="form-check form-control">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox" name="module_name[]" value="<?= $valModule->module_id ?>" <?php !empty($detailModule) ? print_r("checked") : print_r("") ?>> <?= $valModule->module_name ?>
										</label>
									</div>
								</div>
							</div>

						<?php
							$sub = $this->M_module->getListSubModule("as.module_id", $valModule->module_id);
							foreach ($sub as $keySub => $valSub) {
								$detailSubmodule =  $this->M_groupmodule->getSubmoduleByGroup("access_group_id", $detailGroup->access_group_id, $valSub->submodule_id);
						?>

							<div class="form-group row gutters">
								<label class="col-md-1 col-form-label"></label>
								<div class="col-md-5">
									<div class="form-check form-control">
										<label class="form-check-label">
											<input class="form-check-input" type="checkbox" name="submodule_name[]" value="<?= $valSub->submodule_id ?>" <?php !empty($detailSubmodule) ? print_r("checked") : print_r("") ?>> <?= $valSub->submodule_name ?>
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