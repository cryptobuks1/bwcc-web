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
						<div class="table-responsive">
							<table width="100%" id="datatable" class="table table-striped">
								<thead>
									<tr>
										<th style="width: 10px;">No.</th>
										<th>No Rekening</th>
										<th>Atas Nama</th>
										<th>Nomninal</th>
										<th>Tanggal Pencairan</th>
										<th>Status</th>
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
										<td><?= $value->no_rek ?></td>
										<td><?= $value->on_behalf ?></td>
										<td><?= number_format($value->nominal, 0, ",", ".") ?></td>
										<td><?= $value->created_date ?></td>
										<td>
											<?php 
												if ($value->status == 0) {
													echo '<span class="badge badge-pill badge-info">Menunggu Konfirmasi</span>';
												}elseif ($value->status == 1) {
													echo '<span class="badge badge-pill badge-success">Sukses</span>';
												}else{
													echo '<span class="badge badge-pill badge-danger">Cancelled</span>';
												}
											?>
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
		});

	});
</script>