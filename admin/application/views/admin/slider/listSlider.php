<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Slider</h5>
					<h6 class="sub-heading">List Slider</h6>
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
		<div class="col-md-12">
			<div class="card">
				<div class="card-header main-head">List Slider</div>
				<div class="card-body">
					<div class="form-group">
						<a href="<?= base_url('cms/slider/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
					</div>
					<?php echo flashdata_notif("is_success","Yes"); ?>
					<table id="datatable" class="table">
						<thead>
							<tr>
								<th style="width: 10px;">No</th>
								<th>Image</th>
								<th>Sequence</th>
								<th>URL</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							<?php $no=1; foreach ($sliderData as $key => $value) { $enc_id = encrypt_decrypt('encrypt',$value->slider_id); ?>
								<tr>
									<td><?= $no++; ?></td>
									<td>
										<img src="<?= base_url($value->img); ?>" style="max-width: 350px;">
									</td>
									<td><?= $value->seq; ?></td>
									<td><?= $value->url; ?></td>
									<td>
										<button class="btn btn-danger btn-sm" onClick="is_delete('<?= base_url('cms/slider/doDelete/'.$enc_id); ?>')" title="Delete"><i class="fa fa-trash"></i></button>
									<a href="<?= base_url('cms/slider/edit/'.$enc_id) ?>" class="btn btn-primary btn-sm" title="Edit"><i class="fa fa-edit"></i></a>
									</td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>