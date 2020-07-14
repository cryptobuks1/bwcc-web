<section class="xs-content-section-padding position-dash">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<?php echo return_custom_notif();?>
				<div class="row">
					<div class="col-md-9">
						<h5><?= $program->name ?></h5>
						<h6><?= $title_head ?></h6>	
					</div>
					<!-- <div class="col-md-3">
						<a href="<?= base_url('dashboard/overview') ?>" class="btn btn-primary">Kembali Ke</a>
					</div> -->
				</div>
				<hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show" id="water" role="tabpanel">
						<div class="row">
							<!-- <div class="col-md-4"></div> -->
							<div class="col-md-12">
								<div class="dash_card">
									<img src="<?= base_url() ?>assets/images/icon_dashboard/icon_wakaf_small_square.png" alt="" width="80" style="border-radius: 50%;">
									<span class="text_count"><?= $total_wakif ?></span>
									<div>Wakif</div>
								</div>
							</div>
							<div class="col-md-12">
								<div class="xs-tab-content">
									<h4 class="text-center">Rincian Wakaf</h4>
									<hr><br>
									<div class="row">
										<div class="col-md-7">
											Total Wakaf Terkumpul
										</div>
										<div class="col-md-2">Rp</div>
										<div class="col-md-3 text-right"><?= number_format($program->fund_collected, 0, ",", ".") ?></div>
									</div>
									<div class="row">
										<div class="col-md-7">
											Biaya Kitawakaf
										</div>
										<div class="col-md-2">Rp</div>
										<div class="col-md-3 text-right">(-) <?= number_format($fee, 0, ",", ".") ?></div>
									</div>
									<hr>
									<div class="row color-aqua">
										<div class="col-md-7">
											<h5>Total Wakaf Bersih</h5>
										</div>
										<div class="col-md-2 color-aqua"><h5>Rp</h5></div>
										<div class="col-md-3 text-right color-aqua"><h5><?= number_format($total_bersih, 0, ",", ".") ?></h5></div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

