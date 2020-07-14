<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>content image</h5>
					<h6 class="sub-heading">List content image</h6>
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
			<div class="card">
				<div class="card-header main-head">List content_image</div>
				<div class="card-body">
					
				<div class="form-group">
						<a href="<?= base_url('cms/content_image/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
				</div>
				
					<?php echo flashdata_notif("is_success","Yes"); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Image</th>
									<th>Image Type</th>
									<th>Created Date</th>
									<th></th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"processing": true,
            "serverSide": true,
			"pagingType": "full_numbers",
            "ajax": {	
                url: "<?php echo base_url('cms/content_image/get_list_content_image'); ?>", 
                type: "POST",
				data: function (d) {
					
                },
                error: function () {
                	
                }
            },
		});
	});
</script>