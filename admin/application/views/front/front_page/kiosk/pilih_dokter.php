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
					<?php 
						foreach ($list_dokter as $key => $value) {
							if ($value->quota_online != 0) {
					?>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-2">
							<a href="<?= base_url('display/metodePembayaran/'.$value->id_poly.'/'.$value->id_doctor) ?>" class="btn btn-warning btn-lg btn-block"><i class="icon-user"></i> <?= $value->doctor_name ?> <br>(<?= date("H:i", strtotime($value->start_time_service)) ?> - <?= date("H:i", strtotime($value->finish_time_service)) ?>)</a>
						</div>
					<?php 
							}
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row ends -->
</div>
