<?php 
	// Session
	$session = $this->session->sessionNadzir;
	// debugCode($session['nadzir_name']);
?>
<header class="xs-header xs-fullWidth">
	<div class="container">
		<nav class="xs-menus">
			<div class="nav-header">
				<div class="nav-toggle"></div>
				<a href="<?= base_url() ?>" class="xs-nav-logo">
					<img src="<?= base_url() ?>assets/images/logo/logo_kw_blue_no_backgound.png" alt="">
				</a>
			</div><!-- .nav-header END -->
			<div class="nav-menus-wrapper row">
				<div class="xs-logo-wraper col-lg-3">
					<a class="nav-brand" href="<?= base_url() ?>" style="padding: 6px 0;">
						<img src="<?= base_url() ?>assets/images/logo/logo_kw_blue_no_backgound.png" alt="">
					</a>
				</div><!-- .xs-logo-wraper END -->
				<div class="col-lg-9">
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
					<?php 
						if (!empty($session)) {
					?>
						<li><a href="#">Akun</a>
							<ul class="nav-dropdown">
								<li><a href="<?= base_url("dashboard/overview") ?>">Dashboard</a></li>
								<li><a href="<?= base_url("signin/signout") ?>">Logout</a></li>
							</ul>
						</li>
					<?php 
						}else{
					?>
						<li><a href="#">Join</a>
							<ul class="nav-dropdown">
								<li><a href="<?= base_url("signin/signup") ?>">Register</a></li>
								<li><a href="<?= base_url("signin/nadzir") ?>">Sign in</a></li>
								<!-- <li><a href="<?= base_url("cms") ?>">Sign in (Admin)</a></li> -->
							</ul>
						</li>
					<?php 
						}
					?>
					</ul><!-- .nav-menu END -->
				</div>
			</div><!-- .nav-menus-wrapper .row END -->
		</nav><!-- .xs-menus .fundpress-menu END -->
	</div><!-- .container end -->
</header><!-- End header section -->