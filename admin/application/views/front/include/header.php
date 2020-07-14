<?php
	// debugCode($this->session->sessionNadzir);
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
								<li><a href="<?= base_url('campaign/list/wakaf-uang') ?>">Wakaf Uang</a></li>
								<li><a href="<?= base_url('campaign/list/wakaf-melalui-uang') ?>">Wakaf Melalui Uang</a></li>
								<!-- <li><a href="<?= base_url('campaign/list/wakaf-link-sukuk') ?>">Wakaf Link Sukuk</a></li> -->
							</ul>
						</li>
						<li><a href="#">Berita</a>
							<ul class="nav-dropdown">
								<?php foreach ($this->global->get_all_tipe_berita() as $tipe_berita) { ?>
									<li><a href="<?= base_url('berita/list/'.$tipe_berita->split_name) ?>"><?= $tipe_berita->name ?></a></li>
								<?php } ?>
							</ul>
						</li>
					<?php if (!empty($session)) { ?>
						<li><a href="#">Akun</a>
							<ul class="nav-dropdown">
								<li><a href="<?= base_url("dashboard/overview") ?>">Dashboard</a></li>
								<li><a href="<?= base_url("signin/signout") ?>">Logout</a></li>
							</ul>
						</li>
					<?php }else{ ?>
						<li><a href="#">Join</a>
							<ul class="nav-dropdown">
								<li><a href="<?= base_url("signin/signup") ?>">Register</a></li>
								<li><a href="<?= base_url("signin/nadzir") ?>">Sign in</a></li>
								<!-- <li><a href="<?= base_url("cms") ?>">Sign in (Admin)</a></li> -->
							</ul>
						</li>
					<?php } ?>
					</ul><!-- .nav-menu END -->
				</div>
				<div class="xs-navs-button d-flex-center-end col-lg-3">
					<a href="<?= base_url('campaign/list/all') ?>" class="btn btn-primary">
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
				<!-- <div class="xs-welcome-wraper color-white">
					<h2>Kitawakaf</h2>
					<p>Kami akan segera hadir!</p>
					<div class="xs-btn-wraper">
						<a href="#" class="btn btn-outline-primary">
							join us now
						</a>
						<a href="#" class="btn btn-primary">
							<span class="badge"><i class="fa fa-heart"></i></span> Donate Now
						</a>
					</div>
				</div> -->
			</div>
			<div class="xs-black-overlay"></div>
		</div><!-- .xs-welcome-content END -->

		<div class="xs-welcome-content" style="background-image: url(assets/images/slider/slider_2.jpg);">
			<div class="container">
				<div class="xs-welcome-wraper color-white">
					<h2>Kita Wakaf</h2>
					<!-- <p>Wakaf Untuk Negeri.</p> -->
					<div class="xs-btn-wraper">
						<a href="<?= base_url('signin/signup') ?>" class="btn btn-outline-primary">
							Daftar Sebagai Nadzir
						</a>
						<a href="<?= base_url('campaign/list/all') ?>" class="btn btn-primary">
							<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
						</a>
					</div><!-- .xs-btn-wraper END -->
				</div><!-- .xs-welcome-wraper END -->
			</div><!-- .container end -->
			<div class="xs-black-overlay"></div>
		</div><!-- .xs-welcome-content END -->
		<!-- <div class="xs-welcome-content" style="background-image: url(assets/images/slider/slider_3.jpg);">
			<div class="container">
				<div class="xs-welcome-wraper color-white">
					<h2>Kita Wakaf</h2>
					<p>Kami akan segera hadir!</p>
					<div class="xs-btn-wraper">
						<a href="<?= base_url('signin/signup') ?>" class="btn btn-outline-primary">
							Daftar Sebagai Nadzir
						</a>
						<a href="<?= base_url('campaign/list/all') ?>" class="btn btn-primary">
							<span class="badge"><i class="fa fa-heart"></i></span> Wakaf Sekarang
						</a>
					</div>
				</div>
			</div>
			<div class="xs-black-overlay"></div>
		</div> -->
	</div>
</section>
	<!-- End welcome section -->