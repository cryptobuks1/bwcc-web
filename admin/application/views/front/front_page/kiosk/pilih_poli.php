<div class="container">
	<!-- Row start -->
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card" style="margin-top : 5%;">
				<div class="card-header">
					<a href="<?= base_url('display/kiosk/') ?>" class="btn btn-secondary col-sm-2"><i class="icon-home6"></i> Halaman Awal</a>
				</div>
				<div class="card-body">
					<div class="row gutters">
						<?php foreach ($available_poli as $key => $value): ?>
							<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-2">
								<a href="<?= base_url('display/pilihdokter/'.$value->id_poly) ?>" class="btn btn-primary btn-lg btn-block text-left"><i class="icon-folder-plus"></i> <?= $value->poly_name ?></a>
							</div>
						<?php endforeach ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row ends -->
</div>
