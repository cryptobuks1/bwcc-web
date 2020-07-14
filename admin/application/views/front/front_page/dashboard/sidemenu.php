<?php 

$uri = $this->uri->segment(2);

if ($uri == "" || $uri == "overview") {
	$overviewActive = "active";
}

if ($uri == "" || $uri == "campaigns") {
	$campaignActive = "active";
}

if ($uri == "" || $uri == "wakaf") {
	$wakafActive = "active";
}

if ($uri == "" || $uri == "setting") {
	$settingActive = "active";
}


// Detail Campaign
$uri1 = $this->uri->segment(3);

if ($uri1 == "" || $uri1 == "overview") {
	$det_overviewActive = "active";
}

if ($uri1 == "" || $uri1 == "update") {
	$udpate_Active = "active";
	$det_updateActive = "active";
}

if ($uri1 == "" || $uri1 == "listupdate") {
	$udpate_Active = "active";
	$det_listupdateActive = "active";
}

if ($uri1 == "" || $uri1 == "wakif") {
	$det_wakifActive = "active";
}

if ($uri1 == "" || $uri1 == "pencairan") {
	$det_pencairanActive = "active";
	$det_pencairan = "active";
}

if ($uri1 == "" || $uri1 == "riwayat_pencairan") {
	$det_pencairanActive = "active";
	$det_riwayat = "active";
}

if ($uri1 == "" || $uri1 == "editcampaign") {
	$det_editCampaignActive = "active";
}

// ========================== Active Sub Menu ============================== //

// =============== Setting 
if ($uri1 == "listbank") {
	$setting_listBankActive = "active";
}

if ($uri1 == "edit_profile") {
	$setting_editProfileActive = "active";
}

if ($uri1 == "ubah_password") {
	$setting_ubahPasswordActive = "active";
}

if ($uri1 == "edit_profile_picture") {
	$setting_editProfilePictureActive = "active";
}
// =============== End

// ========================== End ============================== //



if (!empty($dash_campaign)) {
	
?>

<div class="col-lg-3">
	<ul class="nav flex-column xs-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<li class="nav-item">
			<a class="nav-link" href="<?= base_url('dashboard/overview') ?>">Dashboard Nadzir</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($det_overviewActive) ? $det_overviewActive : '' ?>" href="<?= base_url('dashboard/campaigns/overview/'.$this->uri->segment(4)) ?>">Overview</a>
		</li>
		<!-- <li class="nav-item">
			<a class="nav-link <?= isset($det_updateActive) ? $det_updateActive : '' ?>" href="<?= base_url('dashboard/campaigns/update/'.$this->uri->segment(4)) ?>">Update Kegiatan</a>
		</li> -->
		<li class="nav-item">
			<a class="nav-link <?= isset($udpate_Active) ? $udpate_Active : '' ?>" data-toggle="pill" href="#">Update Kegiatan <span class="badge position-icon-menu"><i class="fa fa-sort-down"></i></span></a>
			<ul class="ul_submenu" <?= isset($udpate_Active) ? print_r('style="display: block;"') : print_r('style="display: none;"') ?>>
			  <li><a class="nav-link <?= isset($det_updateActive) ? $det_updateActive : '' ?>" href="<?= base_url('dashboard/campaigns/update/'.$this->uri->segment(4)) ?>">- Tulis Update</a></li>
			  <li><a class="nav-link <?= isset($$det_listupdateActive) ? $$det_listupdateActive : '' ?>" href="<?= base_url('dashboard/campaigns/listupdate/'.$this->uri->segment(4)) ?>">- List Update</a></li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($det_wakifActive) ? $det_wakifActive : '' ?>" href="<?= base_url('dashboard/campaigns/wakif/'.$this->uri->segment(4)) ?>">Wakif</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($det_pencairanActive) ? $det_pencairanActive : '' ?>" data-toggle="pill" href="#">Cairkan Dana  <span class="badge position-icon-menu"><i class="fa fa-sort-down"></i></span></a>
			<ul class="ul_submenu" <?= isset($det_pencairanActive) ? print_r('style="display: block;"') : print_r('style="display: none;"') ?>>
			  <li>
			  	<a class="nav-link <?= isset($det_pencairan) ? $det_pencairan : '' ?>" href="<?= base_url('dashboard/campaigns/pencairan/'.$this->uri->segment(4)) ?>">- Cairkan Dana</a>
			  </li>
			  <li>
			  	<a class="nav-link <?= isset($det_riwayat) ? $det_riwayat : '' ?>" href="<?= base_url('dashboard/campaigns/riwayat_pencairan/'.$this->uri->segment(4)) ?>">- Riwayat Pencairan</a>
			  </li>
			</ul>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($det_editCampaignActive) ? $det_editCampaignActive : '' ?>" data-toggle="pill" href="#">Setting Program <span class="badge position-icon-menu"><i class="fa fa-sort-down"></i></span></a>
			<ul class="ul_submenu" <?= isset($det_editCampaignActive) ? print_r('style="display: block;"') : print_r('style="display: none;"') ?>>
			  <li><a class="nav-link <?= isset($det_editCampaignActive) ? $det_editCampaignActive : '' ?>" href="<?= base_url('dashboard/campaigns/editcampaign/'.$this->uri->segment(4)) ?>">- Edit Program</a></li>
			  <li><a href="<?= base_url('dashboard/campaigns/doDeletedCampaign/'.$this->uri->segment(4)) ?>" onclick="return confirm('Apakah Anda serius untuk menghapus program ini?')">- Hapus Program</a></li>
			</ul>
		</li>
	</ul>
</div>

<?php } else { ?>

<div class="col-lg-3">
	<ul class="nav flex-column xs-nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
		<center>
			<img src="<?= base_url($this->global->getPic($this->sessionNadzir['nadzir_id'])) ?>" alt="" width="100" class="pic-profile"><br>
			<h6 class="name-profile"><?= $detailData['nadzir_name'] ?></h6>
			<hr>
		</center>
		<li class="nav-item">
			<a class="nav-link <?= isset($overviewActive) ? $overviewActive : '' ?>" href="<?= base_url('dashboard/overview') ?>">Overview</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($campaignActive) ? $campaignActive : '' ?>" href="<?= base_url('dashboard/campaigns') ?>">Program Saya</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($wakafActive) ? $wakafActive : '' ?>" href="<?= base_url('dashboard/wakaf') ?>">Wakaf Saya</a>
		</li>
		<li class="nav-item">
			<a class="nav-link <?= isset($settingActive) ? $settingActive : '' ?>" data-toggle="pill" href="#">Akun Saya <span class="badge position-icon-menu"><i class="fa fa-sort-down"></i></span></a>
			<ul class="ul_submenu" <?= isset($settingActive) ? print_r(print_r('style="display: block;"')) : print_r('style="display: none;"') ?> >
			  <li><a class="nav-link <?= isset($setting_listBankActive) ? $setting_listBankActive : '' ?>" href="<?= base_url('dashboard/setting/listbank') ?>">- Setting Bank</a></li>
			  <li><a class="nav-link <?= isset($setting_editProfileActive) ? $setting_editProfileActive : '' ?>" href="<?= base_url('dashboard/setting/edit_profile') ?>">- Edit Profile</a></li>
			  <li><a class="nav-link <?= isset($setting_ubahPasswordActive) ? $setting_ubahPasswordActive : '' ?>" href="<?= base_url('dashboard/setting/ubah_password') ?>">- Ganti Password</a></li>
			  <li><a class="nav-link <?= isset($setting_editProfilePictureActive) ? $setting_editProfilePictureActive : '' ?>" href="<?= base_url('dashboard/setting/edit_profile_picture') ?>">- Ganti Foto Profile</a></li>
			</ul>
		</li>
	</ul>
</div>
<?php } ?>

<script type="text/javascript">
	$('li a').click(function(e) {
	  // e.preventDefault();
	  $(this).closest("li").find("[class^='ul_submenu']").slideToggle();
	});
</script>