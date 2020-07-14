<?php 

$uri = $this->uri->segment(2);

if ($uri == "" || $uri == "dashboard") {
	$dashActive = "active selected";
}

?>
<!-- BEGIN .app-side -->
<aside class="app-side <?php ($this->uri->segment(3) == 'nggak jadi deng') ? print_r("is-mini") : print_r("") ?>" id="app-side">
	<!-- BEGIN .side-content -->
	<div class="side-content ">
		<!-- BEGIN .user-profile -->
		<div class="user-profile">
			<img src="<?= base_url('assets/images/logo/') ?>logo_bwcc.png" class="profile-thumb" alt="User Thumb">
			<h6 class="profile-name">Bintaro Women And Children Clinic</h6>
			<ul class="profile-actions">
				
			</ul>
		</div>
		<!-- END .user-profile -->
		<!-- BEGIN .side-nav -->
		<nav class="side-nav">
			<!-- BEGIN: side-nav-content -->
			<ul class="unifyMenu" id="unifyMenu">

				<!-- <li class="menu-header">
					-- Dashboard
				</li> -->
				<!-- <li class="<?= isset($dashActive)?$dashActive:''; ?>">
					<a href="<?= base_url('cms/dashboard'); ?>">
						<span class="has-icon">
							<i class="icon-laptop_windows"></i>
						</span>
						<span class="nav-title">Dashboard</span>
					</a>
				</li> -->

				<?php 
					$menu = $this->session->menusession; 
					// debugCode($menu);
					foreach ($menu as $mnkey => $mnvalue) {
						?>
						<?php if($mnvalue['isParent'] == 0){ ?>
							<li class="<?php if($uri == $mnvalue['module_url']){ echo 'active selected'; }?>">
								<a href="<?= base_url('cms/'.$mnvalue['module_url']); ?>">
									<span class="has-icon">
										<i class="<?= $mnvalue['module_icon']; ?> btn-sm"></i>
									</span>
									<span class="nav-title"><?php echo $mnvalue['module_name']; ?></span>
								</a>
							</li>
						<?php }else{ ?>
							<?php 
							$active = "";
							foreach ($mnvalue['sub'] as $sbskey => $sbsvalue) {
								if ($sbsvalue['submodule_url'] == $uri) {
									$active = "active selected";
								}
							}
							?>
							<li class="<?= $active; ?>">
								<a href="#" class="has-arrow" aria-expanded="false">
									<span class="has-icon">
										<i class="<?= $mnvalue['module_icon']; ?> btn-sm"></i>
									</span>
									<span class="nav-title"><?php echo $mnvalue['module_name']; ?></span>
								</a>
								<ul aria-expanded="false">
									<?php foreach ($mnvalue['sub'] as $sbkey => $sbvalue) { ?>
									<li>
										<a href="<?php echo base_url('cms/'.$sbvalue['submodule_url']); ?>" <?php if($sbvalue['submodule_url'] == $uri){ echo "class='current-page'"; } ?>><?php echo $sbvalue['submodule_name']; ?></a>
									</li>
									<?php } ?>
								</ul>
							</li>
						<?php } ?>
				<?php } ?>
			</ul>
			<!-- END: side-nav-content -->
		</nav>
		<!-- END: .side-nav -->
	</div>
	<!-- END: .side-content -->
</aside>
<!-- END: .app-side -->