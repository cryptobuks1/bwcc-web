<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $program->name ?></h5>
				<h6><?= $title_head ?></h6><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="col-md-5 row">
						<a href="<?= base_url('dashboard/campaigns/update/'.$this->uri->segment(4)); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Tulis Update</a>
					</div>
					<br>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<th>No.</th>
								<th>Judul Update</th>
								<th>Tanggal Update</th>
								<th>Aksi</th>
							</thead>
							<tbody>
							<?php 
								$no = 0;
								foreach ($updateCampaign as $update) {
								$no++;
							?>
								<tr>
									<td><?= $no ?></td>
									<td><?= $update->judul ?></td>
									<td><?= $update->created_date ?></td>
									<td>
										<a href="<?= base_url('dashboard/campaigns/editkegiatan/'.$update->id) ?>" class="btn-primary btn-sm" title="Edit / Detail"><i class="fa fa-edit"></i> Edit</a>
										<a href="<?= base_url('dashboard/campaigns/hapus_kegiatan/'.$update->id) ?>" class="btn-primary bg-danger btn-sm" onclick="return confirm('Apakah Anda yakin menghapus data ini?')">Hapus</a>
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
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
		});
	});
</script>

