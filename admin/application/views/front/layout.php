<!doctype html>
<html class="no-js" lang="en">
<?php $this->load->view("front/include/metadata.php"); ?>
<body>
	
	<?php 
		if (!empty($front_slider)) {
			$this->load->view("front/include/header");
		}else{
			$this->load->view("front/include/header3");
		}
	?>

	<?php $this->load->view($content); ?>

	<?php $this->load->view("front/include/footer"); ?>

	<?php $this->load->view("front/include/script"); ?>
</body>
</html>
<!-- footer section end -->