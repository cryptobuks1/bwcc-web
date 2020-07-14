<!-- BEGIN .app-heading -->
<header class="app-header">
	<div class="container-fluid">
		<div class="row gutters">
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
				<a class="mini-nav-btn" href="#" id="app-side-mini-toggler">
					<i class="icon-menu5"></i>
				</a>
				<a href="#app-side" data-toggle="onoffcanvas" class="onoffcanvas-toggler" aria-expanded="true">
					<i class="icon-chevron-thin-left"></i>
				</a>
			</div>
			<div class="col-xl-2 col-lg-2 col-md-2 col-sm-6 col-4">
				<a href="index.html" class="logo">
					<!-- <img src="<?= base_url('assets_backend/back_end/') ?>img/unify.png" alt="Unify Admin Dashboard" /> -->
				</a>
			</div>
			<div class="col-xl-5 col-lg-5 col-md-5 col-sm-3 col-4">
				<ul class="header-actions">					
					<li class="dropdown">
						<a href="#" id="userSettings" class="user-settings" data-toggle="dropdown" aria-haspopup="true">
							<img class="avatar" src="<?= base_url('assets/images/logo/logo_bwcc.png') ?>" alt="User Thumb" />
							<span class="user-name"><?php echo $this->session->sessionData['name']; ?></span>
							<i class="icon-chevron-small-down"></i>
						</a>
						<div class="dropdown-menu lg dropdown-menu-right" aria-labelledby="userSettings">
							<div class="logout-btn">
								<a href="<?= base_url("cms/signin/signout"); ?>" class="btn btn-primary">Logout</a>
							</div>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>
</header>
<!-- END: .app-heading -->