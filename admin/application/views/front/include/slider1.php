<div class="promo">
	<?php 
	$sliderData = $this->global->get_active_slider();
	foreach ($sliderData as $key => $value) { ?>
		<div class="slide">
			<div class="container">
				<img src="<?= base_url($value->img); ?>" alt="image description">
				<?php if ($value->url <> "") { ?>
					<a href="<?= $value->url; ?>" class="btn btn-primary more">READ MORE</a>
				<?php } ?>
			</div>
		</div>
	<?php } ?>

	<div class="switcher">
		<?php foreach ($sliderData as $key => $value){ ?>
			<a href="#">
				<div class="circle-wrapper">
					<div class="circle left"></div>
					<div class="circle right"></div>
				</div>
			</a>
		<?php } ?>
	</div>
	<a href="#" class="btn-prev"><i class="fa fa-angle-left"></i></a>
	<a href="#" class="btn-next"><i class="fa fa-angle-right"></i></a>
</div>