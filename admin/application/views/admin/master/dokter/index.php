<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Dokter</h5>
					<h6 class="sub-heading">List Dokter</h6>
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
				<div class="card-header main-head">List Dokter</div>
				<div class="card-body">
					<div class="form-group">
						<a href="<?= base_url('cms/dokter/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a>
						<br>
						<br>
						
						<select class="form-control selectpicker col-md-2 oCh" id="is_active" data-live-search="true">
							<option value="">All</option>
							<option value="1">Aktif</option>
							<option value="0">Tidak Aktif</option>
						</select>
					</div>
					<?php echo return_custom_notif(); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Nama</th>
									<th>No STR</th>
									<th>Spesialis</th>
									<th>Gender</th>
									<th>Active</th>
									<th>Aksi</th>
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
                url: "<?php echo base_url('cms/dokter/get_list_dokter'); ?>", 
                type: "POST",
				data: function (d) {
					d.is_active = $("#is_active").val();
                },
                error: function () {
                	
                }
            },
		});

		function reload_table(){
			dataTable.ajax.reload(null,false); 
		}

		$('.oCh').change(function(event) {
			reload_table();
		});
	});
</script>