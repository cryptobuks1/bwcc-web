<section class="xs-content-section-padding position-dash waypoint-tigger">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show " id="water" role="tabpanel">
						<div class="col-md-5 row">
							<!-- <h6>Filter : </h6>
							<select class="input-control oCh" name="status" id="status">
								<option value="ALL">ALL</option>
								<option value="0">Menunggu Pembayaran</option>
								<option value="1">Paid</option>
								<option value="2">Cancelled</option>
							</select> -->
							<a href="<?= base_url('dashboard/setting/addbank'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tambah Bank</a>
						</div>
						<br>
						<div class="table-responsive">
							<table width="100%" id="datatable" class="table table-striped">
								<thead>
									<tr>
										<th style="width: 10px;">No.</th>
										<th>Nama Bank</th>
										<th>No Rekening</th>
										<th>Atas Nama</th>
										<th>Aksi</th>
									</tr>
								</thead>
								<tbody>
								<?php 
									$no = 0;
									foreach ($bank as $value) {
									$no++;
								?>
									<tr>
										<td><?= $no ?></td>
										<td><?= $value->nama_bank ?></td>
										<td><?= $value->no_rek ?></td>
										<td><?= $value->atas_nama ?></td>
										<td>
											<a href="<?= base_url('dashboard/setting/editbank/'.$value->id) ?>" class="btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i> Edit</a>
											<!-- <button class="btn btn-primary bg-danger btn-sm" onclick="return confirm('Apakan Anda yakin menghapus data ini?')" title="Hapus"><i class="fa fa-trash"></i> Hapus</button> -->
											<a href="<?= base_url('dashboard/setting/doDelete/'.$value->id) ?>" class="btn-primary bg-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</a>
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
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			// "processing": true,
   //          "serverSide": true,
			// "pagingType": "full_numbers",
   //          "ajax": {	
   //              url: "<?php echo base_url('dashboard/wakaf/get_list_wakaf'); ?>", 
   //              type: "POST",
			// 	data: function (d) {
			// 		d.status = $("#status").val();
   //              },
   //              error: function () {
                	
   //              }
   //          },
		});

		// function reload_table(){
		// 	dataTable.ajax.reload(null,false); 
		// }

		// $('.oCh').change(function(event) {
		// 	reload_table();
		// });
	});
</script>