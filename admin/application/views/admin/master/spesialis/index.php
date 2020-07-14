<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Spesialis</h5>
					<h6 class="sub-heading">List Spesialis</h6>
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
				<div class="card-header main-head">List Spesialis</div>
				<div class="card-body">
					<div class="form-group">
						<a href="<?= base_url('cms/spesialis/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
					</div>
					<?php echo return_custom_notif(); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Kode</th>
									<th>Nama Spesialis</th>
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
									<td><?= $value->specialist_code ?></td>
									<td><?= $value->name ?></td>
									<td>
										<a href="<?= base_url('cms/spesialis/edit/'.$value->id) ?>" class="btn btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i></a>
										<button class="btn btn-danger btn-sm" onClick="is_delete('<?= base_url('cms/spesialis/doDelete/'.$value->id) ?>')" title="Delete"><i class="fa fa-trash"></i></button>
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