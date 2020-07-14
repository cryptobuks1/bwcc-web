<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="icon-laptop_windows"></i>
				</div>
				<div class="page-title">
					<h5>Dashboard</h5>
					<h6 class="sub-heading">Welcome to BWCC Administrator Page</h6>
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

<div class="main-content">
	<!-- <hr style="border-color: #007ae1 !important;"> -->
	
	<div class="row gutters">
		
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['booked_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-book"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking pending</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $info_card['booked'];?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['booked_success_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-check"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking success</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $info_card['booked_success'];?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['reject_booking_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-times"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking payment reject</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $info_card['reject_booking'];?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['reject_booking_only_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-times"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking reject</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $info_card['reject_booking_only'];?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>

	<div class="row gutters">
		
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['booked_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-book"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking Class pending</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $get_pending_book_class;?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['booked_success_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-check"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking class success</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $get_success_book_class;?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['reject_booking_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-times"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking class payment reject</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $get_cancel_payment_book_class;?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6">
			<div class="card">
				<div class="card-body">
					<div class="stats-widget">
						<a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="Last Act" data-original-title="Last Act"><?php echo $info_card['reject_booking_only_date'];?></a>	
						<div class="stats-widget-header">
							<i class="fas fa-times"></i>
						</div>
						<div class="stats-widget-body">
							<!-- Row start -->
							<ul class="row no-gutters">
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h6 class="title">Booking class reject</h6>
								</li>
								<li class="col-xl-6 col-lg-6 col-md-6 col-sm-6 col">
									<h4 class="total"><?php echo $get_cancel_book_class;?></h4>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
	</div>


	<!-- activity & booked section -->
	<div class="row gutters">
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">Last Booked</div>			
				<div class="card-body pt-0 pb-0">
					<ul class="project-activity">
						<?php
							foreach($list_last_booked as $booked){
						?>
						<li class="activity-list">
							<div class="detail-info">						
								<span class="lbl"><?php echo $booked['patient_name'][0];?></span>
								<p class="desc-info"><span class="text-primary"><?php echo $booked['patient_name'];?></span> booked for <?php echo $booked['doctor_name'];?> in <?php echo $booked['poly_name'];?>.</p>
								<a href="<?php echo base_url('cms/reqantrian/details/'.$booked['booking_id']);?>" class="activity-status"><i class="fas fa-dot-circle"></i>Schedule <?php echo $booked['time_schedule'];?></a>
							</div>
						</li>
						<?php
							}
						?>
						
					</ul>
				</div>				
			</div>
		</div>
		<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
			<div class="card">
				<div class="card-header">Last Activity</div>
				<div class="card-body">
					<ul class="order-list">
						<?php
							foreach($list_last_activity as $activity){
						?>
						<li>
							<p class="order-num">BOOKING #<?php echo $activity['booking_id'];?> <span class="order-date"><?php echo $activity['time'];?></span></p>
							<p class="order-desc"><?php echo $activity['status'];?></p>
						</li>
						<?php
							}
						?>					
					</ul>
				</div>		
			</div>
		</div>
	</div>	
</div>