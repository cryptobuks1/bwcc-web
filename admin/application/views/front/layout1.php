<?php $this->load->view("front/include/metadata.php");?>
<body>
	<div class="du font_bg"></div>
	<div id="wrapper">
		<?php $this->load->view("front/include/header.php"); ?>
		<?php if(!empty($front_slider)){ $this->load->view("front/include/slider.php"); } ?>
		<?php $margin_main = ""; if(!empty($image_post)){ ?>
			<img src="<?= $image_post['url'] ?>" alt="image description" class="promo-image">
		<?php }else{ $margin_main = "margin-top:100px;"; } ?>
		<main id="main" style="<?= $margin_main; ?>">
			<div class="container">
				<?php $this->load->view($content);?>
			</div>
		</main>
		<?php $this->load->view("front/include/script.php");?>
		<?php $this->load->view("front/include/footer.php");?>
	</div>
</body>