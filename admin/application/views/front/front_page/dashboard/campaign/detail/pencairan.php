<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $program->name ?></h5>
				<h6><?= $title_head ?></h6><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show" id="water" role="tabpanel">
						<div class="row">
							<div class="col-md-6">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/dana_trkmpl-min.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count"><?= number_format($program->fund_collected, 0, ",", ".") ?></span>
									<div>Total Dana Terkumpul</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/biaya_kw-min.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count"><?= number_format($biaya, 0, ",", ".") ?></span>
									<div>Biaya Kitawakaf</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/dana_blm_cair-min.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count"><?= number_format($program->fund_update, 0, ",", ".") ?></span>
									<div>Dana yang belum dicairkan</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/dana_sdh_cair-min.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count"><?= number_format($dicairkan, 0, ",", ".") ?></span>
									<div>Dana yang sudah dicairkan</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="xs-tab-content">
									<h4 class="text-center">Form Pencairan Dana</h4>
									<hr><br>
									<form method="post" action="<?= base_url('dashboard/campaigns/cairdana'); ?>" enctype="multipart/form-data">
										<input type="hidden" name="campaign_id" value="<?= $this->uri->segment(4) ?>" required readonly>
										<?php echo flashdata_notif("is_success","Yes"); echo return_custom_notif();?>
										<div class="form-group row">
											<div class="col-md-4">
												<label>Jumlah Pencairan Dana</label>
											</div>
											<div class="col-md-8">
												<span class="color-orange">Perhatian! </span>Jumlah maksimal dana yang bisa dicairkan <label for="xs-donate-charity"><span class="color-light-red" id="estimasi_harga" >Rp <?= number_format($max_biaya, 0, ",", ".") ?></span></label>
												<input type="text" class="input-control uang" name="nominal" value="" required="">
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-4">
												<label>Nama Bank Tujuan</label>
											</div>
											<div class="col-md-8 row">
												<div class="col-md-9">
													<input type="text" class="input-control" name="bank" id="nama_bank" value="" required="" readonly="" disabled>
													<input type="hidden" class="input-control" name="id_bank" id="id_bank" value="" required="" readonly="">
												</div>
												<div class="col-md-3">
													<button type="button" id="cardisantri" class="btn-success btn-sm" style="margin-top: 5px;">Pilih Bank</button>
												</div>
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-4">
												<label>Nomor Rekening</label>
											</div>
											<div class="col-md-8">
												<input type="number" class="input-control" name="no_rek" id="no_rek" value="" required=""  readonly="" disabled>
											</div>
										</div>

										<div class="form-group row">
											<div class="col-md-4">
												<label>Nama Pemilik Rekening</label>
											</div>
											<div class="col-md-8">
												<input type="text" class="input-control" name="atas_nama" id="atas_nama" value="" required=""  readonly="" disabled>
											</div>
										</div>
										
										<!-- <div class="form-group text-center">
											<span class="color-orange">Perhatian! </span><label for="xs-donate-charity">Biaya admin yang harus tertanam adalah <span class="color-light-red" id="estimasi_harga" >Rp <?= number_format($biaya->biaya_operasional) ?></span></label>
										</div> -->

										<div class="form-group row">
											<div class="col-md-4"></div>
											<div class="col-md-8">
												<button type="submit" class="btn btn-primary">Cairkan</button>
											</div>
										</div>

									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- D MODAL -->
<div class="modal fade" id="csantri" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<form id="delmodalForm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Pilih Bank</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<div class="table-responsive">
						<table class="table table-responsive" width="100%" id="datatable">
							<thead>
								<tr>
									<th>No</th>
									<th style="width: 100px;">Nama Bank</th>
									<th style="width: 100px;">No Rekening</th>
									<th style="width: 300px;">Atas Nama</th>
									<th style="width: 100px;">Action</th>
								</tr>
							</thead>
							<tbody>
							<?php
								$no=0; 
								foreach ($bank as $value) {
								$no++;
							?>
								<tr>
									<td><?= $no; ?></td>
									<td><?= $value->nama_bank ?></td>
									<td><?= $value->no_rek ?></td>
									<td><?= $value->atas_nama ?></td>
									<td>
										<button type="button" class="btn-primary bg-success btn-sm" onClick="selectsantri(<?php echo "'$value->id'".','."'$value->nama_bank'".','."'$value->no_rek'".','."'$value->atas_nama'" ?>)">Pilih</button>
								</tr>
							<?php 
								}
							?>
							</tbody>
						</table>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-primary bg-danger" data-dismiss="modal">Kembali</button>
					<a href="<?= base_url('dashboard/setting/addbank') ?>" class="btn btn-primary">Tambah Bank</a>
				</div>
			</div>
		</form>
	</div>
</div>
<script>
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		});
	});

	$("#cardisantri").click(function(event) {
		$("#csantri").modal("show");
	});

	function selectsantri(par1, par2, par3, par4){
		$("#id_bank").val(par1);
		$("#nama_bank").val(par2);
		$("#no_rek").val(par3);
		$("#atas_nama").val(par4);
		$("#csantri").modal("toggle");
	}
</script>
