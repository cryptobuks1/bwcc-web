<section class="xs-section-padding bg-gray">
	<div class="container">
		<div class="row">
			<div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="xs-donation-form-wraper" >
					<div class="xs-heading xs-mb-30">
						<h3 class="text-center"><?= $dataNotif['judul'] ?></h3>
						<p class="small text-center"><?= $dataNotif['msg'] ?></p>
					<?php 
						if (!empty($dataNotif['btn'])) {
					?>
						<center>
							<a href="<?= base_url() ?>" class="btn btn-warning">Kembali ke halaman depan</a>
						</center>
					<?php
						}
					?>
					</div>
				</div>
			</div>
			<div class="col-lg-3"></div>
		</div>
	</div>
</section>