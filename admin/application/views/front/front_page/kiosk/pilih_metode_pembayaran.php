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
						foreach (json_decode($poli->id_payment) as $key => $value) {
						$getMetode 	= $this->M_pembayaran->getOneData("id", $value);
					?>
						<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6 mb-2">
							<a href="<?= base_url('display/gettiket/'.$poli->id."/".$id_doctor."/".$getMetode->id) ?>" class="btn btn-success btn-lg btn-block"><i class="icon-account_balance_wallet"></i> <?= $getMetode->name ?></a>
						</div>
					<?php
						}
					?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Row ends -->
</div>
