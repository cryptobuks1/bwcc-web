<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Module & Submodule</h5>
					<h6 class="sub-heading">List Module & Submodule</h6>
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
				<div class="card-header main-head">List Module & Submodule</div>
				<div class="card-body">
					<div class="form-group">
						<a href="<?= base_url('cms/module/addsub/'.$this->uri->segment(4)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
					</div>
					<?php echo flashdata_notif("is_success","Yes"); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Sub Module Name</th>
									<th>Module Name</th>
									<th>URL</th>
									<th>Order Number</th>
									<th>Action</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$no=0;
								foreach ($dataSubModule as $valSub) {
								$no++;
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $valSub->submodule_name ?></td>
									<td><?= $valSub->module_name ?></td>
									<td><?= $valSub->submodule_url ?></td>
									<td>#<?= $valSub->submodule_order ?></td>
									<td>
                                        <a href="<?= base_url('cms/module/editsub/'.encrypt_decrypt("encrypt", $valSub->submodule_id)) ?>" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>
										<button class="btn btn-danger btn-sm" onClick="is_delete('<?= base_url('cms/module/doDeletesub/'.encrypt_decrypt("encrypt", $valSub->submodule_id)) ?>')" title="Delete"><i class="fa fa-trash"></i></button>
									</td>
								</tr>
							<?php 
								}
							?>
							</tbody>
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
		});
	});
</script>