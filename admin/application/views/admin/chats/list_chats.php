<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Chats</h5>
					<h6 class="sub-heading">List Chats</h6>
				</div>
			</div>
			<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4">
				<div class="right-actions">
					
				</div>
			</div>
		</div>
	</div>
</header>
<!-- END: .main-heading -->

<!-- BEGIN .main-content -->
<div class="main-content"> 
	<div class="row gutters">
		<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">List Chats Users</div>
				<div class="customScroll">
					<div class="card-body pt-0 pb-0">
						<ul class="project-activity" id="list_chats">
						<?php
							foreach ($list_chats as $value) {
						?>
							<li class="activity-list">
								<a href="<?= base_url('cms/chats/chatting/'.$value->id) ?>">
									<div class="detail-info">
										<span class="lbl"><?= substr($value->name_user, 0,1) ?></span>
										<p class="desc-info"><b><?= ucwords($value->name_user) ?></b> </p>
										<p><?= substr($value->text,0,100) ?></p>
										<a href="<?= base_url('cms/chats/chatting/'.$value->id) ?>" class="activity-status"><i class="icon-done_all"></i>Read <?= date( "d-m-Y h:i:s", $value->timestamp) ?></a>
									</div>
								</a>
							</li>
						<?php } ?>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	// Reload list chats per 1 min
	setInterval(function(){ 
		console.log('reload');
		$("#list_chats").load(" #list_chats");
	}, 100000);
</script>