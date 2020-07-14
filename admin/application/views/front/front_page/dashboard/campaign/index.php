<section class="xs-content-section-padding position-dash waypoint-tigger">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show " id="water" role="tabpanel">
						<div class="row" id="ajax_table">

							<a href="<?= base_url('dashboard/campaigns/addcampaign') ?>" class="xs-add-campaign">
								<div class="col-md-5">
									<div class="xs-popular-item xs-box-shadow">
										<div class="xs-item-header"></div>
										<div class="xs-item-content _additional">
											<center>
												<i class="fa fa-plus fa-5x"></i>	
												<a href="<?= base_url('dashboard/campaigns/addcampaign') ?>" class="xs-post-title xs-mb-30">BUAT PROGRAM BARU</a>
											</center>
										</div>
									</div>
								</div>
							</a>
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="container" style="text-align: center">
						<button class="btn btn-success" id="load_more" data-val = "0">Lihat Lagi<img style="display: none" id="loader" src="http://www.trycatchclasses.com/code/demo/load-more-records-ci/asset/loader.GIF"> </button>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

<script>
$(document).ready(function(){
	getcountry(0);

	$("#load_more").click(function(e){
		e.preventDefault();
		var page = $(this).data('val');
		getcountry(page);

	});
    //getcountry();
});

var getcountry = function(page){
	$("#loader").show();
	$.ajax({
		url:"<?php echo base_url() ?>dashboard/campaigns/getCampaignByNadzir/>",
		type:'GET',
		data: {page:page}
	}).done(function(response){
		$("#ajax_table").append(response);
		$("#loader").hide();
		$('#load_more').data('val', ($('#load_more').data('val')+1));
		scroll();
	});
};

var scroll  = function(){
	$('html, body').animate({
		scrollTop: $('#load_more').offset().top(300)
	}, 1000);
};

</script>

