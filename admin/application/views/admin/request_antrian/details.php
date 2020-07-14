<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Books Details</h5>
					<h6 class="sub-heading">Details</h6>
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
                <div class="card-body">
                    <!-- Timeline start -->
                    <div class="timeline">
                        <?php
                            $counter = 1;
                            foreach($list_status as $item){
                                if($counter == 1){
                                    $counter = 0;
                        ?>
                        <div class="timeline-row">
                            <div class="timeline-time">
                             <?php echo $item['time'];?>
                            </div>
                            <div class="timeline-dot green-one-bg"></div>
                            <div class="timeline-content green-one">
                                <p>
                                    <?php echo $item['status'];?>
                                </p>
                            </div>
                        </div>                        
                        <?php
                                }else{
                                    $counter = 1;
                        ?>
                        <div class="timeline-row">
                            <div class="timeline-time">
                                <?php echo $item['time'];?>
                            </div>
                            <div class="timeline-dot fb-bg"></div>
                            <div class="timeline-content">
                                <p><?php echo $item['status'];?></p>
                                <br>
                            </div>
                        </div>
                        <?php
                                }
                            }
                        ?>

                    </div>
                    <!-- Timeline end -->
                </div>
            </div>
        </div>
    </div>
</div>