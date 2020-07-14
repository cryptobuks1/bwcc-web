<!doctype html>

<html lang="en">

<head>

	<!-- Required meta tags -->

	<meta charset="utf-8">

	<meta http-equiv="X-UA-Compatible" content="IE=edge">

	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<meta name="description" content="Unify Admin Panel" />

	<meta name="keywords" content="Lock Screen, Admin, Dashboard, Bootstrap4, Sass, CSS3, HTML5, Responsive Dashboard, Responsive Admin Template, Admin Template, Best Admin Template, Bootstrap Template, Themeforest" />

	<meta name="author" content="Bootstrap Gallery" />

	<link rel="shortcut icon" href="img/favicon.ico" />

	<title><?= $title ?></title>

	

	<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">

	

	<!-- Common CSS -->

	<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>css/bootstrap.min.css" />

	<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>fonts/icomoon/icomoon.css" />



	<!-- Custom -->

	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>custom.css" />



	<!-- Mian and Login css -->

	<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>css/main.css" />



</head>



<body class="display-bg">

	<!-- BEGIN .main-heading -->

	<header class="main-heading" style="background-color: #7cb5fc;color: #fff;">

		<div class="container-fluid mb-1">

			<div class="row">

				<div class="col-xl-9 col-lg-9 col-md-9 col-sm-9">

					<div class="page-icon">

						<!-- <i class="icon-layers"></i> -->

						<img src="<?= base_url('assets/images/logo/') ?>logo_bwcc.png" width="80" height="80">

					</div>

					<div class="page-title">

						<div class="row">

							<div class="col-md-12">

								<h4>RSUD TAMANSARI</h4>

								<h6 class="sub-heading color-white">Jl. Madu No. 10 Kel. Mangga Besar Kec. Tamansari, Jakarta Barat</h6>

								<h6 class="sub-heading color-white">Telp. 021-26075052</h6>

							</div>

						</div>

					</div>

				</div>

				<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3">

					<div class="right-actions">

						<h4 id="ontime"><?= date("H:i:s") ?></h4>

						<h6 class="sub-heading"><?= date("l").", ".date("d D Y") ?></h6>

					</div>

				</div>

			</div>

		</div>

	</header>

	<!-- END: .main-heading -->



	<?php $this->load->view($content) ?>

	

</body>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>

<script type="text/javascript">

$(document).ready(function() {

	setInterval(function() {

	var today = new Date();

	var time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds();

	  	$('#ontime').text(time);

	}, 1000);  //Delay here = 5 seconds 

});

</script>

</html>