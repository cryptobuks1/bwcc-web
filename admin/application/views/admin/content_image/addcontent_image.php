<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Add content image</h5>
					<h6 class="sub-heading">content image</h6>
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
			<form method="post" action="<?= base_url('cms/content_image/doAdd'); ?>" enctype="multipart/form-data">
				<div class="card">
					<div class="card-header main-head">Add content image</div>
					<div class="card-body">
						<?php echo flashdata_notif("is_success","Yes"); ?>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Image Type</label>
							<div class="col-md-10">
								<select class="form-control" name="type" required="">
									<option selected disabled value=""> - </option>
									<option value="1"> Home Slider </option>
									<option value="2"> Home Banner </option>
									<option value="3"> Ads Home </option>
								</select>
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Image Upload fileToUpload</label>
							<div class="col-md-10">
								<input type="file" class="form-control" name="fileToUpload" accept="image/*">
							</div>
						</div>

						<div class="form-group row gutters">
							<label class="col-md-2 col-form-label">Active</label>
							<div class="col-md-10">
								<select class="form-control" name="is_active" required="">
									<option selected disabled value=""> - </option>
									<option value="0"> No </option>
									<option value="1"> Yes </option>
								</select>
							</div>
						</div>

					</div>
					<div class="card-footer">
						<a href="<?= base_url('cms/content_image'); ?>" class="btn btn-light"><i class="fa fa-arrow-circle-left"></i> Back</a>
						<button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>