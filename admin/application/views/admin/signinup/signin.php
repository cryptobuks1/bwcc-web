<!doctype html>
<html lang="en">

<head>
		<!-- Required meta tags -->
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<meta name="author" content="" />
		<link rel="shortcut icon" href="<?= base_url('images/favicon.ico') ?>" />
		<title>Signin</title>
		
		<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
		
		<!-- Common CSS -->
		<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>css/bootstrap.min.css" />
		<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>fonts/icomoon/icomoon.css" />

		<!-- Mian and Login css -->
		<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>css/main.css" />

	</head>  

	<body class="login-bg">
			
		<div class="container">
			
			<div class="login-screen row align-items-center">
				
				<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
					
					<?php if(flashdata_check("failedtologin")=="Yes"){ ?>
						<div class="alert alert-danger">
							<button type="button" class="close" data-dismiss="alert" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
							<i class="icon-warning2"></i><strong>Perhatian!</strong> Tolong cek Email dan Password
						</div>
					<?php } ?>
					<form action="<?= base_url("cms/signin/doLogin/"); ?>" method="post">
						<div class="login-container">
							
							<div class="row no-gutters">
								
								<div class="col-xl-4 col-lg-5 col-md-6 col-sm-12">
									<div class="login-box">
										<!-- <a href="#" class="login-logo">
											<img src="<?= base_url('assets_backend/back_end/') ?>img/unify.png" alt="Unify Admin Dashboard" />
										</a> -->
										<img src="<?php echo base_url();?>assets/images/logo/logo_bwcc.png" class="rounded mx-auto d-block" alt="User Thumb" width="30%" style="align:center">
										<br>
										<div class="input-group">
											<span class="input-group-addon" id="email"><i class="icon-account_circle"></i></span>
											<input type="text" class="form-control" placeholder="Email" aria-label="email" aria-describedby="email" name="email">
										</div>
										<br>
										<div class="input-group">
											<span class="input-group-addon" id="password"><i class="icon-verified_user"></i></span>
											<input type="password" class="form-control" placeholder="Password" aria-label="Password" aria-describedby="password" name="password">
										</div>
										<div class="actions clearfix">
											<a href="#">Lost password?</a>
											<button type="submit" class="btn btn-primary">Login</button>
										</div>
										<hr>
										<!-- <div class="mt-4">
											<a href="#" class="additional-link">Don't have an Account? <span>Create Now</span></a>
										</div> -->
									</div>
								</div>
								<div class="col-xl-8 col-lg-7 col-md-6 col-sm-12">
									<div class="login-slider"></div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
		<script src="<?= base_url("assets_backend/back_end/"); ?>js/jquery.js"></script>
		<script src="<?= base_url("assets_backend/back_end/"); ?>js/tether.min.js"></script>
		<script src="<?= base_url("assets_backend/back_end/"); ?>js/bootstrap.min.js"></script>
		<script src="<?= base_url("assets_backend/back_end/"); ?>vendor/notify/notify.js"></script>
		<script src="<?= base_url("assets_backend/back_end/"); ?>vendor/notify/notify-custom.js"></script>
		<footer class="main-footer no-bdr fixed-btm">
			<div class="container">
				
			</div>
		</footer>
	</body>
</html>