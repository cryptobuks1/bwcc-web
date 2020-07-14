<!doctype html>
<html lang="en">
	<?php $this->load->view("admin/include/header.php");?>
	<body>
		<div class="app-wrap">
			<?php $this->load->view("admin/include/topnavbar");?>
			<!-- BEGIN .app-container -->
			<div class="app-container">
				<?php $this->load->view("admin/include/sidenavbar");?>
				<div class="app-main">
					<?php $this->load->view($content);?>
				</div>
			</div>
			<!-- END .app-container -->
		</div>
	</body>
	<?php $this->load->view("admin/include/script.php");?>
	<?php $this->load->view("admin/include/footer.php");?>
</html>