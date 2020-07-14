<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $program->name ?></h5>
				<h6><?= $title_head ?></h6>
				<hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show " id="water" role="tabpanel">
						<div class="row">
							<div class="col-md-3">
								<h6>Dari Tanggal : </h6>
								<input type="text" name="tgl_awal" id="tgl_awal" class="input-control selectorNoConfig" value="" required="">
							</div>
							<div class="col-md-3">
								<h6>Sampai Tanggal : </h6>
								<input type="text" name="tgl_akhir" id="tgl_akhir" class="input-control selectorNoConfig" value="" required="">
							</div>
							<!-- <div class="col-md-3">
								<br>
								<button class="btn btn-info">Cek Data</button>
							</div> -->
							<div class="col-md-6">
								<br>
								<button class="btn btn-primary bg-info" id="cek">Cek Data</button>
								<a class="btn btn-primary bg-success" href="<?= base_url('dashboard/campaigns/wakif_excel/'.$this->uri->segment(4)) ?>" id="printwakif">Eksport to Excel</a>
							</div>
						</div>
						<br>
						<div class="table-responsive">
							<table width="100%" id="datatable" class="table table-striped">
								<thead>
									<tr>
										<th style="width: 10px;">No.</th>
										<th>Nama Wakif</th>
										<th>Nominal Donasi</th>
										<th>Biaya Admin Platform</th>
										<th>Biaya Admin Bank</th>
										<th>Total Wakaf</th>
										<th>Keterangan</th>
										<th>Tanggal Wakaf</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"processing": true,
            "serverSide": true,
			"pagingType": "full_numbers",
            "ajax": {	
                url: "<?php echo base_url('dashboard/campaigns/get_list_wakif'); ?>",
                type: "POST",
				data: function (d) {
					var tgl1 = $("#tgl_awal").val();
					var tgl2 = $("#tgl_akhir").val();

					d.id_program = "<?= $this->uri->segment(4) ?>";
					d.tgl_awal = tgl1;
					d.tgl_akhir = tgl2;

					if (tgl1 != "" && tgl2 != "") {
						document.getElementById("printwakif").href="<?= base_url() ?>dashboard/campaigns/wakif_excel/"+"<?= $this->uri->segment(4) ?>?start="+tgl1+"&end="+tgl2;
					}
                },
                error: function () {
                	
                }
            },
		});

		function reload_table(){
			dataTable.ajax.reload(null,false); 
		}

		$('#cek').click(function(event) {
			reload_table();
		});
	});
</script>