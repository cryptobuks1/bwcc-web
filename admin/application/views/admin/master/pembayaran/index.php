<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Pembayaran</h5>
					<h6 class="sub-heading">List Pembayaran</h6>
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
				<div class="card-header main-head">List Pembayaran</div>
				<div class="card-body">
					<div class="form-group">
						<a href="<?= base_url('cms/pembayaran/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
					</div>
					<?php echo return_custom_notif(); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Nama Metode</th>
									<th>Status</th>
									<!-- <th>Detail</th> -->
									<th>Aksi</th>
								</tr>
							</thead>
							<tbody>
							<?php 
								$no = 0;
								foreach ($listData as $value) {
								$no++;
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $value->name ?></td>
									<td>
										<?php 
											$status = "";
											if ($value->is_active != 0) {
												$status .= '<span class="badge badge-pill badge-success">Yes</span>';
											}else{
												$status .= '<span class="badge badge-pill badge-danger">No</span>';
											}
											echo $status;
										?>
									</td>
									<!-- <td><?php ($value->detail) ? print_r($value->detail) : print_r("-") ?></td> -->
									<td>
										<a href="<?= base_url('cms/pembayaran/edit/'.$value->id) ?>" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>
										<button class="btn btn-danger btn-sm" onClick="is_delete('<?= base_url('cms/pembayaran/doDelete/'.$value->id) ?>')" title="Delete"><i class="fa fa-trash"></i></button>

										<?php if ($value->is_active == 1): ?>
											<a href="<?php echo base_url('cms/pembayaran/status/'.$value->id) ?>"><button class="btn btn-danger btn-sm"   style="margin-left:2px" onclick="return confirm('Are you sure you want to Deactivate this Data ? ')"><i class="fa fa-toggle-on"></i>&nbsp;&nbsp;<span>Deactive</span></button></a>
										<?php else: ?>
											<a href="<?= base_url('cms/pembayaran/status/'.$value->id) ?>" class="btn btn-success btn-sm" title="Edit / Detail"><i class="fa fa-toggle-off"></i> Active</a>
										<?php endif ?>
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