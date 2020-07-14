<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Antrian</h5>
					<h6 class="sub-heading">List Antrian</h6>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
				<div class="right-actions" id="btn_status">
					<label class="col-form-label">Status Loket : &nbsp;</label>
					<?php 
						if ($detail_user->status == 1) {
							echo '<button class="btn btn-success btn-sm" onclick="change_status(\''.$detail_user->id.'\')" title="Tidak Aktif"><i class="fa fa-toggle-on"></i> Aktif</button>';
						}else{
							echo '<button class="btn btn-danger btn-sm" onclick="change_status(\''.$detail_user->id.'\')" title="Aktif"><i class="fa fa-toggle-off"></i> Tidak Active</button>';
						}
					?>
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
				<div class="card-header main-head">List Antrian</div>
				<div class="card-body">
					<div class="form-group">
						<!-- <a href="<?= base_url('cms/dokter/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a> -->
						Filter :
						<select class="form-control selectpicker col-md-2 oCh" id="status" data-live-search="true">
							<option value="">Semua</option>
							<option value="0">Menunggu Panggilan</option>
							<option value="3">Telah dipanggil</option>
							<option value="2">Selesai</option>
							<option value="4">Terlewati</option>
						</select>
					</div>
					<?php echo return_custom_notif(); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Nomor Antrian</th>
									<th>Nama</th>
									<th>No BPJS</th>
									<th>Dokter</th>
									<th>Tanggal</th>
									<th>Loket</th>
									<th>Status</th>
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
<!-- <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script> -->
<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"processing": true,
            "serverSide": true,
			"pagingType": "full_numbers",
            "ajax": {	
                url: "<?php echo base_url('cms/antrian/get_list_antrian'); ?>", 
                type: "POST",
				data: function (d) {
					d.status = $("#status").val();
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

		// Reload datatable per 10 sec
		setInterval(function(){ 
			console.log('reload');
			reload_table();
		}, 10000);

		panggil_antrian = function (data){
			console.log('antrian_id: '+data+'');
			console.log('loket_id : <?php echo $this->sessionData['user_id'];?>');

			var loket_login_id = '<?= $this->sessionData['user_id'];?>';
			console.log(loket_login_id);
			$.post("https://api.rsudtamansari.com/public_html/loket/call?key=7TmgitdDpPsh8YC8MXkkuzqZ1YOGDwJA", {id: data , loket_id : loket_login_id}, function(result){
				// $("span").html(result);
				console.log(result);
				reload_table();
			});
			// $.ajax({
			// 	type: "POST",
			// 	url: "https://api.rsudtamansari.com/public_html/loket/call?key=7TmgitdDpPsh8YC8MXkkuzqZ1YOGDwJA",
			// 	// The key needs to match your method's input parameter (case-sensitive).
			// 	data: JSON.stringify({ id : data , loket_id : loket_login_id}),
			// 	contentType: "application/json; charset=utf-8",
			// 	dataType: "json",
			// 	success: function(data){
			// 		alert(data);
			// 	},
			// 	failure: function(errMsg) {
			// 		alert(errMsg);
			// 	}
			// });
		}


		hadir = function(val){
			$.get("<?php echo base_url('cms/antrian/hadir/'); ?>"+val, function( data ) {
				reload_table();
			});
		}

		lewati = function(val){
			$.get("<?php echo base_url('cms/antrian/lewati/'); ?>"+val , function( data ) {
				reload_table();
			});
		}

		// Status User
		change_status = function(val){
			$.get("<?php echo base_url('cms/antrian/statusLoket/'); ?>"+val , function( data ) {
				// reload_table();
				// console.log(data);
				$("#btn_status").load(" #btn_status");
			});
		}
		// End
	});
	
	

</script>