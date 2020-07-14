<?php 
	// Session
	$session = $this->session->sessionNadzir;
?>
<div id="preloader">
	<div class="spinner">
		<div class="double-bounce1"></div>
		<div class="double-bounce2"></div>
	</div>
</div><!-- #preloader -->

<!-- header section -->
<header class="xs-header header-transparent">
	<div class="container">
		<nav class="xs-menus">
			<div class="nav-header">
				<div class="nav-toggle"></div>
				<a href="<?= base_url() ?>" class="nav-logo">
					<img src="<?= base_url() ?>assets/images/logo/logo_kw_blue_no_backgound.png" alt="">
				</a>
			</div><!-- .nav-header END -->
			<div class="nav-menus-wrapper row">
				<div class="xs-logo-wraper col-lg-2 xs-padding-0">
					<a class="nav-brand" href="<?= base_url() ?>">
						<img src="<?= base_url() ?>assets/images/logo/logo_kw_blue_no_backgound.png" alt="">
					</a>
				</div><!-- .xs-logo-wraper END -->
				<div class="col-lg-7">
					<ul class="nav-menu">
						<li><a href="#">Wakaf</a>
							<ul class="nav-dropdown">
								<li><a href="#">Ekonomi Produktif</a></li>
								<li><a href="#">Uang</a></li>
								<li><a href="#">Program Sosial</a></li>
							</ul>
						</li>
					<?php 
						if (!empty($session)) {
					?>
						<li><a href="<?= base_url("dashboard/overview") ?>">Akun</a></li>
					<?php 
						}else{
					?>
						<li><a href="#">Join</a>
							<ul class="nav-dropdown">
								<li><a href="<?= base_url("signin/signup") ?>">Register</a></li>
								<li><a href="<?= base_url("signin") ?>">Sign in</a></li>
								<li><a href="<?= base_url("cms") ?>">Sign in (Admin)</a></li>
							</ul>
						</li>
					<?php 
						}
					?>
					</ul><!-- .nav-menu END -->
				</div>
				<div class="xs-navs-button d-flex-center-end col-lg-3">
					<a href="#" class="btn btn-primary">
						<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
					</a>
				</div><!-- .xs-navs-button END -->
			</div><!-- .nav-menus-wrapper .row END -->
		</nav><!-- .xs-menus .fundpress-menu END -->
	</div><!-- .container end -->
</header><!-- End header section -->

<!-- welcome section -->
<section class="xs-welcome-slider">
	<div class="xs-banner-slider owl-carousel">
		<div class="xs-welcome-content" style="background-image: url(assets/images/slider/slider_1.jpg);">
			<div class="container">
				<div class="xs-welcome-wraper color-white">
					<!-- <h2>Kitawakaf</h2>
					<p>Kami akan segera hadir!</p>
					<div class="xs-btn-wraper">
						<a href="#" class="btn btn-outline-primary">
							Daftar Sebagai Nadzir
						</a>
						<a href="#" class="btn btn-primary">
							<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
						</a>
					</div> -->
				</div><!-- .xs-welcome-wraper END -->
			</div><!-- .container end -->
			<div class="xs-black-overlay1"></div>
		</div><!-- .xs-welcome-content END -->
		<div class="xs-welcome-content" style="background-image: url(assets/images/slider/slider_2.jpg);">
			<div class="container">
				<div class="xs-welcome-wraper color-white">
					<h2>Kitawakaf</h2>
					<p>Kami akan segera hadir!</p>
					<div class="xs-btn-wraper">
						<a href="#" class="btn btn-outline-primary">
							Daftar Sebagai Nadzir
						</a>
						<a href="#" class="btn btn-primary">
							<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
						</a>
					</div><!-- .xs-btn-wraper END -->
				</div><!-- .xs-welcome-wraper END -->
			</div><!-- .container end -->
			<div class="xs-black-overlay1"></div>
		</div><!-- .xs-welcome-content END -->
		<div class="xs-welcome-content" style="background-image: url(assets/images/slider/slider_3.jpg);">
			<div class="container">
				<div class="xs-welcome-wraper color-white">
					<h2>Kitawakaf</h2>
					<p>Kami akan segera hadir!</p>
					<div class="xs-btn-wraper">
						<a href="#" class="btn btn-outline-primary">
							Daftar Sebagai Nadzir
						</a>
						<a href="#" class="btn btn-primary">
							<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
						</a>
					</div><!-- .xs-btn-wraper END -->
				</div><!-- .xs-welcome-wraper END -->
			</div><!-- .container end -->
			<div class="xs-black-overlay1"></div>
		</div><!-- .xs-welcome-content END -->
	</div>
</section>
	<!-- End welcome section -->