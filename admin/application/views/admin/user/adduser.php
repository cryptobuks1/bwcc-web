<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Add User</h5>
					<h6 class="sub-heading">User</h6>
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
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<form method="post" action="<?= base_url('cms/user/doAdd'); ?>">
				<div class="card">
					<div class="card-header main-head">Add User</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>
						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Name</label>
							<div class="col-md-10">
								<input type="text" class="form-control" placeholder="Name" name="user_name" required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Email</label>
							<div class="col-md-10">
								<input type="email" class="form-control" placeholder="Email" name="user_email" required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Password</label>
							<div class="col-md-10">
								<input type="password" class="form-control" placeholder="Password" name="user_password" required="">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Is Super Admin</label>
							<div class="col-md-10">
								<select class="form-control selectpicker" data-live-search="true" name="akses" required="">
									<option value="">Pilih Akses</option>
								<?php 
									foreach ($groupModule as $value) {
								?>
									<option value="<?= $value->access_group_id ?>"><?= $value->access_group_name ?></option>
								<?php 
									}
								?>
								</select>
							</div>
						</div>

					</div>
					<div class="card-footer">
						<a href="<?= base_url('cms/user'); ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>