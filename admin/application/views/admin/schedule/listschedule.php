<style type="text/css">
    .btn-xsm {
        padding: .25rem .25rem;
        font-size: .875rem;
        line-height: 0.5;
    }

    .btn-grey {
        background-color: #696969;
        border-color: #696969;
        color: #ffffff;
    }

    .state-disabled p {
        color: #c1c1c1 !important;
    }

    .state-disabled .badge-bdr {
        color: #c1c1c1 !important;
        border: 1px solid #c1c1c1 !important;
    }
</style>

<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Schedule</h5>
					<h6 class="sub-heading">                    
                    <?php 
                        echo date('D, d-m-Y', strtotime($current_date));                
                    ?>                    
                    </h6>
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
<?php echo return_custom_notif(); ?>

    <div class="row gutters">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <a href="<?php echo base_url();?>cms/schedule/add" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add Schedule</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= base_url('cms/schedule/search'); ?>" enctype="multipart/form-data">
                    <div class="form-group row gutters">
                        <div class="col-md-4 col-md-4 col-sm-4 col-sm-4">
                            <input placeholder="Selected date" type="text" name="date_selected" id="date-1" class="form-control datepicker" data-provide="datepicker">
                        </div>
                        <div class="col-md-4 col-md-4 col-sm-4 col-sm-4">
                        <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                        </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<!-- 
    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <a href ="<?php echo base_url('cms/schedule?date='.$prevday_date);?>"><button class="btn btn-primary"><?php echo $prevday_date; ?><span class="badge badge-light"><?php echo $total[0];?></span></button></a>
                    <a href ="<?php echo base_url('cms/schedule?date='.$yesterday_date);?>"><button class="btn btn-primary"><?php echo $yesterday_date; ?><span class="badge badge-light"><?php echo $total[1];?></span></button></a>
                    <a href ="<?php echo base_url('cms/schedule?date='.$current_date);?>"><button class="btn btn-primary"><?php echo $current_date; ?><span class="badge badge-light"><?php echo $total[2];?></span></button></a>
                    <a href ="<?php echo base_url('cms/schedule?date='.$tomorrow_date);?>"><button class="btn btn-primary"><?php echo $tomorrow_date; ?><span class="badge badge-light"><?php echo $total[3];?></span></button></a>
                    <a href ="<?php echo base_url('cms/schedule?date='.$nextday_date);?>"><button class="btn btn-primary"><?php echo $nextday_date; ?><span class="badge badge-light"><?php echo $total[4];?></span></button></a>
                    
                </div>
            </div>
        </div>
    </div> -->

    <div class="row gutters">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body" style="align:center">
                    <nav aria-label="...">
                        <ul class="pagination pagination-lg justify-content-center">
                        <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$prevday_date);?>" tabindex="-1">Previous</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$prevday_date);?>">
                            <?php echo date('d-m-Y', strtotime($prevday_date));?>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$yesterday_date);?>">
                            <?php echo date('d-m-Y', strtotime($yesterday_date));?>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$current_date);?>">
                            <?php echo date('d-m-Y', strtotime($current_date));?>
                            </a>
                        </li>
                        <li class="page-item active">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$tomorrow_date);?>">
                            <?php echo date('d-m-Y', strtotime($tomorrow_date));?>
                            </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$nextday_date);?>">
                            <?php echo date('d-m-Y', strtotime($nextday_date));?>
                            </a>
                        </li>                        
                        <li class="page-item">
                            <a class="page-link" href="<?php echo base_url('cms/schedule?date='.$nextday_date);?>">Next</a>
                        </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="row gutters">
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="stats-widget">
                        <?php 
                            if($total[1] == 0){
                        ?>
                            <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule">No Schedule</a>
                        <?php
                            }else if($total[1] == $total_available[1]){
                        ?>
                            <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule">Full</a>
                        <?php
                            }else{
                        ?>
                            <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule"><?php echo $total_available[1]." of ".$total[1]?></a>
                        <?php                            
                            }
                        ?>            
                    </div>
                <?php echo date('D, d-m-Y', strtotime($yesterday_date));?>
                </div>

                <div class="card-body">
                    <div id="accordionIcons1" class="accordion-icons" role="tablist">
                        <?php
                            $i = 0;

                            foreach($yesterday_schedule as $t_item){
                                $i++;
                        ?>
                        <div class="card mb-2">
                            <div class="card-header" role="tab" id="headingFive">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseYesterday<?php echo $i ?>" aria-expanded="false" aria-controls="collapseYesterday">
                                        <?php echo $t_item['doctor_name'];?> <br>
                                        
                                    </a>
                                    <p style="color: #aab3c3; margin: 0 0 0 30px; line-height: 160%; font-size: 0.8rem"><?php echo $t_item['poly_name'];?></p>
                                </h5>
                                
                            </div>
                            <div id="collapseYesterday<?php echo $i ?>" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordionIcons1">
                                <div class="card-body">

                                    <div class="product-list clearfix">

                                        <?php 
                                            $is_hide_btn = FALSE;
                                            $state_btn_hide_icon = 'icon-eye';
                                            $state_btn_hide_text = 'Hide';
                                            foreach ($t_item['schedules'] as $schedule) { 
                                                if(!empty($schedule['patient_id'])) {
                                                    $is_hide_btn = TRUE;
                                                    break;
                                                }
                                            } 

                                            $state_btn_hide = FALSE;
                                            foreach ($t_item['schedules'] as $schedule) {
                                                if($schedule['is_hide'] == 0) {
                                                    $state_btn_hide = TRUE;
                                                }
                                            }

                                            if($state_btn_hide) {
                                                $state_btn_hide_icon = 'icon-eye';
                                                $state_btn_hide_text = 'Hide';
                                            } else {
                                                $state_btn_hide_icon = 'icon-eye-blocked';
                                                $state_btn_hide_text = 'Show';
                                            }
                                        ?>
                                                               
                                        <div class="product-info mb-2">
                                            <div class="row gutter">
                                                <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
                                                    <h5 style="float: left; margin-top: 5px">List Schedule</h5>

                                                    <div style="float: right">
                                                        <?php if(!$is_hide_btn) { ?>
                                                            <button class="btn-batch-hide btn btn-grey btn-xsm" title="<?php echo $state_btn_hide_text; ?>" data-url="<?php echo base_url('cms/schedule/doBatchHide'); ?>" data-hide="<?php if(!$state_btn_hide) echo 1; else echo 0; ?>" data-poly_id="<?php echo $t_item['poly_id']; ?>" data-doctor_id="<?php echo $t_item['doctor_id']; ?>" data-date_time="<?php echo $t_item['date_time']; ?>"><i class="<?php echo $state_btn_hide_icon; ?>"></i></button>
                                                        <?php } ?>

                                                        <!-- <button class="btn btn-danger btn-xsm" onClick="is_delete('<?php echo base_url('cms/schedule/doDelete/'.$t_item['doctor_name']);?>')" title="Delete"><i class="fa fa-trash"></i></button> -->

                                                        <button data-url="<?php echo base_url('cms/schedule/edit?poly_id='.$t_item['poly_id'].'&doctor_id='.$t_item['doctor_id'].'&date_time='.$t_item['date_time']); ?>" class="btn-edit btn btn-primary btn-xsm" title="Add or Delete Schedule Time" ><i class="fa fa-edit"></i></button>

                                                        <button data-url="<?php echo base_url('cms/schedule/change?poly_id='.$t_item['poly_id'].'&doctor_id='.$t_item['doctor_id'].'&date_time='.$t_item['date_time']); ?>" class="btn-edit-time btn btn-success btn-xsm" title="Change Schedule" ><i class="fa fa-clock"></i></button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php foreach ($t_item['schedules'] as $schedule) {
                                            $icon_eye = 'icon-eye';
                                            $text_eye = 'Hide'; 
                                            $class_eye = '';

                                            if($schedule['is_hide'] == 1) {
                                                $icon_eye = 'icon-eye-blocked';
                                                $text_eye = 'Show'; 
                                                $class_eye = 'state-disabled';
                                            }
                                        ?>
                                            <div class="schedule-time-item <?php echo $class_eye; ?> clearfix">
                                                <p style="float: left; font-size: 1.0rem; margin-top: 3px">
                                                    <?php echo $schedule['queue_number'].'. '; ?>
                                                    <?php echo date("H:i", strtotime($schedule['start_time']));?> — <?php echo date("H:i", strtotime($schedule['finish_time']));?>
                                                </p>
                                                <div style="float: right;">
                                                    <?php
                                                        if(empty($schedule['patient_id'])){
                                                            echo '<span class="badge badge-bdr badge-success" style="width: 80px">Available</span>&nbsp;';
                                                            echo '<button data-url="'.base_url('cms/schedule/doHide/'.$schedule['id']).'" data-hide="'.$schedule['is_hide'].'"  class="btn-hide-schedule btn btn-grey btn-xsm" title="'.$text_eye.'"><i class="'.$icon_eye.'"></i></button>';
                                                        }else{
                                                            echo '<span class="badge badge-bdr badge-danger" style="width: 80px; margin-right: 27px">Booked</span>';
                                                        }
                                                    ?> 
                                                </div>
                                           </div>
                                           <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>

            </div>
        </div>    
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                <div class="stats-widget">
                        <?php 
                            if($total[2] == 0){
                        ?>
                            <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule">No Schedule</a>
                        <?php
                            }else if($total[2] == $total_available[2]){
                        ?>
                            <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule">Full</a>
                        <?php
                            }else{
                        ?>
                            <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule"><?php echo $total_available[2]." of ".$total[2]?></a>
                        <?php                            
                            }
                        ?>            
                    </div>
                    <?php echo date('D, d-m-Y', strtotime($current_date));?></div>
                <div class="card-body">
                    <div id="accordionIcons2" class="accordion-icons" role="tablist">
                        <?php
                            $i = 0;

                            foreach($today_schedule as $t_item){
                                $i++;
                        ?>
                        <div class="card mb-2">
                            <div class="card-header" role="tab" id="headingFive">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseToday<?php echo $i ?>" aria-expanded="false" aria-controls="collapseToday">
                                        <?php echo $t_item['doctor_name'];?> <br>
                                        
                                    </a>
                                    <p style="color: #aab3c3; margin: 0 0 0 30px; line-height: 160%; font-size: 0.8rem"><?php echo $t_item['poly_name'];?></p>
                                </h5>
                                
                            </div>
                            <div id="collapseToday<?php echo $i ?>" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordionIcons2">
                                <div class="card-body">

                                    <div class="product-list clearfix">

                                        <?php 
                                            $is_hide_btn = FALSE;
                                            $state_btn_hide_icon = 'icon-eye';
                                            $state_btn_hide_text = 'Hide';
                                            foreach ($t_item['schedules'] as $schedule) { 
                                                if(!empty($schedule['patient_id'])) {
                                                    $is_hide_btn = TRUE;
                                                    break;
                                                }
                                            } 

                                            $state_btn_hide = FALSE;
                                            foreach ($t_item['schedules'] as $schedule) {
                                                if($schedule['is_hide'] == 0) {
                                                    $state_btn_hide = TRUE;
                                                }
                                            }

                                            if($state_btn_hide) {
                                                $state_btn_hide_icon = 'icon-eye';
                                                $state_btn_hide_text = 'Hide';
                                            } else {
                                                $state_btn_hide_icon = 'icon-eye-blocked';
                                                $state_btn_hide_text = 'Show';
                                            }
                                        ?>
                                                               
                                        <div class="product-info mb-2">
                                            <div class="row gutter">
                                                <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
                                                    <h5 style="float: left; margin-top: 5px">List Schedule</h5>

                                                    <div style="float: right">
                                                        <?php if(!$is_hide_btn) { ?>
                                                            <button class="btn-batch-hide btn btn-grey btn-xsm" title="<?php echo $state_btn_hide_text; ?>" data-url="<?php echo base_url('cms/schedule/doBatchHide'); ?>" data-hide="<?php if(!$state_btn_hide) echo 1; else echo 0; ?>" data-poly_id="<?php echo $t_item['poly_id']; ?>" data-doctor_id="<?php echo $t_item['doctor_id']; ?>" data-date_time="<?php echo $t_item['date_time']; ?>"><i class="<?php echo $state_btn_hide_icon; ?>"></i></button>
                                                        <?php } ?>

                                                        <!-- <button class="btn btn-danger btn-xsm" onClick="is_delete('<?php echo base_url('cms/schedule/doDelete/'.$t_item['doctor_name']);?>')" title="Delete"><i class="fa fa-trash"></i></button> -->

                                                        <button data-url="<?php echo base_url('cms/schedule/edit?poly_id='.$t_item['poly_id'].'&doctor_id='.$t_item['doctor_id'].'&date_time='.$t_item['date_time']); ?>" class="btn-edit btn btn-primary btn-xsm" title="Add or Delete Schedule Time" ><i class="fa fa-edit"></i></button>

                                                        <button data-url="<?php echo base_url('cms/schedule/change?poly_id='.$t_item['poly_id'].'&doctor_id='.$t_item['doctor_id'].'&date_time='.$t_item['date_time']); ?>" class="btn-edit-time btn btn-success btn-xsm" title="Change Schedule" ><i class="fa fa-clock"></i></button>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php foreach ($t_item['schedules'] as $schedule) {
                                            $icon_eye = 'icon-eye';
                                            $text_eye = 'Hide'; 
                                            $class_eye = '';

                                            if($schedule['is_hide'] == 1) {
                                                $icon_eye = 'icon-eye-blocked';
                                                $text_eye = 'Show'; 
                                                $class_eye = 'state-disabled';
                                            }
                                        ?>
                                           <div class="schedule-time-item <?php echo $class_eye; ?> clearfix">
                                                <p style="float: left; font-size: 1.0rem; margin-top: 3px">
                                                    <?php echo $schedule['queue_number'].'. '; ?>
                                                    <?php echo date("H:i", strtotime($schedule['start_time']));?> — <?php echo date("H:i", strtotime($schedule['finish_time']));?>
                                                </p>
                                                <div style="float: right;">
                                                    <?php
                                                        if(empty($schedule['patient_id'])){
                                                            echo '<span class="badge badge-bdr badge-success" style="width: 80px">Available</span>&nbsp;';
                                                            echo '<button data-url="'.base_url('cms/schedule/doHide/'.$schedule['id']).'" data-hide="'.$schedule['is_hide'].'"  class="btn-hide-schedule btn btn-grey btn-xsm" title="'.$text_eye.'"><i class="'.$icon_eye.'"></i></button>';
                                                        }else{
                                                            echo '<span class="badge badge-bdr badge-danger" style="width: 80px; margin-right: 27px">Booked</span>';
                                                        }
                                                    ?> 
                                                </div>
                                           </div>
                                           <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-header">
                    <div class="stats-widget">
                            <?php 
                                if($total[3] == 0){
                            ?>
                                <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule">No Schedule</a>
                            <?php
                                }else if($total[3] == $total_available[3]){
                            ?>
                                <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule">Full</a>
                            <?php
                                }else{
                            ?>
                                <a href="#" class="stats-label" data-toggle="tooltip" data-placement="top" title="" data-original-title="Available Schedule"><?php echo $total_available[3]." of ".$total[3]?></a>
                            <?php                            
                                }
                            ?>            
                        </div>
                        <?php echo date('D, d-m-Y', strtotime($tomorrow_date));?></div>
                        

                <div class="card-body">
                    <div id="accordionIcons3" class="accordion-icons" role="tablist">
                        <?php
                            $i = 0;

                            foreach($tomorrow_schedule as $t_item){
                                $i++;
                        ?>
                        <div class="card mb-2">
                            <div class="card-header" role="tab" id="headingFive">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapseTommorow<?php echo $i ?>" aria-expanded="false" aria-controls="collapseTommorow">
                                        <?php echo $t_item['doctor_name'];?> <br>
                                        
                                    </a>
                                    <p style="color: #aab3c3; margin: 0 0 0 30px; line-height: 160%; font-size: 0.8rem"><?php echo $t_item['poly_name'];?></p>
                                </h5>
                                
                            </div>
                            <div id="collapseTommorow<?php echo $i ?>" class="collapse" role="tabpanel" aria-labelledby="headingFive" data-parent="#accordionIcons3">
                                <div class="card-body">

                                    <div class="product-list clearfix">

                                        <?php 
                                            $is_hide_btn = FALSE;
                                            $state_btn_hide_icon = 'icon-eye';
                                            $state_btn_hide_text = 'Hide';
                                            foreach ($t_item['schedules'] as $schedule) { 
                                                if(!empty($schedule['patient_id'])) {
                                                    $is_hide_btn = TRUE;
                                                    break;
                                                }
                                            } 

                                            $state_btn_hide = FALSE;
                                            foreach ($t_item['schedules'] as $schedule) {
                                                if($schedule['is_hide'] == 0) {
                                                    $state_btn_hide = TRUE;
                                                }
                                            }

                                            if($state_btn_hide) {
                                                $state_btn_hide_icon = 'icon-eye';
                                                $state_btn_hide_text = 'Hide';
                                            } else {
                                                $state_btn_hide_icon = 'icon-eye-blocked';
                                                $state_btn_hide_text = 'Show';
                                            }
                                        ?>
                                                               
                                        <div class="product-info mb-2">
                                            <div class="row gutter">
                                                <div class="col-lg-12 col-md-12 col-sm-12 clearfix">
                                                    <h5 style="float: left; margin-top: 5px">List Schedule</h5>

                                                    <div style="float: right">
                                                        <?php if(!$is_hide_btn) { ?>
                                                            <button class="btn-batch-hide btn btn-grey btn-xsm" title="<?php echo $state_btn_hide_text; ?>" data-url="<?php echo base_url('cms/schedule/doBatchHide'); ?>" data-hide="<?php if(!$state_btn_hide) echo 1; else echo 0; ?>" data-poly_id="<?php echo $t_item['poly_id']; ?>" data-doctor_id="<?php echo $t_item['doctor_id']; ?>" data-date_time="<?php echo $t_item['date_time']; ?>"><i class="<?php echo $state_btn_hide_icon; ?>"></i></button>
                                                        <?php } ?>

                                                       <button data-url="<?php echo base_url('cms/schedule/edit?poly_id='.$t_item['poly_id'].'&doctor_id='.$t_item['doctor_id'].'&date_time='.$t_item['date_time']); ?>" class="btn-edit btn btn-primary btn-xsm" title="Add or Delete Schedule Time" ><i class="fa fa-edit"></i></button>

                                                       <button data-url="<?php echo base_url('cms/schedule/change?poly_id='.$t_item['poly_id'].'&doctor_id='.$t_item['doctor_id'].'&date_time='.$t_item['date_time']); ?>" class="btn-edit-time btn btn-success btn-xsm" title="Change Schedule" ><i class="fa fa-clock"></i></button>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <?php foreach ($t_item['schedules'] as $schedule) {
                                            $icon_eye = 'icon-eye';
                                            $text_eye = 'Hide'; 
                                            $class_eye = '';

                                            if($schedule['is_hide'] == 1) {
                                                $icon_eye = 'icon-eye-blocked';
                                                $text_eye = 'Show'; 
                                                $class_eye = 'state-disabled';
                                            }
                                        ?>
                                           <div class="schedule-time-item <?php echo $class_eye; ?> clearfix">
                                                <p style="float: left; font-size: 1.0rem; margin-top: 3px">
                                                    <?php echo $schedule['queue_number'].'. '; ?>
                                                    <?php echo date("H:i", strtotime($schedule['start_time']));?> — <?php echo date("H:i", strtotime($schedule['finish_time']));?>
                                                </p>
                                                <div style="float: right;">
                                                    <?php
                                                        if(empty($schedule['patient_id'])){
                                                            echo '<span class="badge badge-bdr badge-success" style="width: 80px">Available</span>&nbsp;';
                                                            echo '<button data-url="'.base_url('cms/schedule/doHide/'.$schedule['id']).'" data-hide="'.$schedule['is_hide'].'"  class="btn-hide-schedule btn btn-grey btn-xsm" title="'.$text_eye.'"><i class="'.$icon_eye.'"></i></button>';
                                                        }else{
                                                            echo '<span class="badge badge-bdr badge-danger" style="width: 80px; margin-right: 27px">Booked</span>';
                                                        }
                                                    ?> 
                                                </div>
                                           </div>
                                           <?php } ?>
                                    </div>

                                </div>
                            </div>
                        </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>

            </div>
        </div>        
    </div>
</div>

<script type="text/javascript">    
    $(document).ready(function(){
        $('.btn-edit').on('click', function(){
            var url = $(this).data('url');
            window.location.href = url;
        });

        $('.btn-edit-time').on('click', function(){
            var url = $(this).data('url');
            window.location.href = url;
        });

        $('.btn-hide-schedule').on('click', function(){
            var $this = $(this);
            var url = $(this).data('url');
            var hide = $(this).data('hide');
            var req_hide = hide == 1 ? 0 : 1;

            $.post(url, { is_hide : req_hide }, function(res){
                if(res.is_success) {
                    var elemParent = $this.closest('.schedule-time-item');

                    if(req_hide == 1) {
                        elemParent.addClass('state-disabled');
                        elemParent.find('.btn-hide-schedule').attr('title', 'Show');
                        elemParent.find('.btn-hide-schedule').html('<i class="icon-eye-blocked"></i>');
                    } else {
                        elemParent.removeClass('state-disabled');
                        elemParent.find('.btn-hide-schedule').attr('title', 'Hide');
                        elemParent.find('.btn-hide-schedule').html('<i class="icon-eye"></i>');
                    }

                    $this.data('hide', req_hide);
                } else
                    toastr.error('Hide/Show schedule failed.', 'Sorry!');
            });
        });

        $('.btn-batch-hide').on('click', function(){
            var $this = $(this);
            var url = $(this).data('url');
            var poly_id = $(this).data('poly_id');
            var doctor_id = $(this).data('doctor_id');
            var date_time = $(this).data('date_time');
            var hide = $(this).data('hide');

            var req_hide = hide == 1 ? 0 : 1;

            var data = {
                is_hide : req_hide,
                poly_id: poly_id,
                doctor_id: doctor_id,
                date_time: date_time
            };

            // var elemParents = $this.closest('.product-list').find('.schedule-time-item');
            // elemParents.each(function(i, elemParent) {
            //     console.log($(elemParent));
            // });
            // return false;

            $.post(url, data, function(res){
                if(res.is_success) {
                    var elemParents = $this.closest('.product-list').find('.schedule-time-item');
                    if(req_hide == 1) {
                        elemParents.each(function(i, item) {
                            var elemParent = $(item);
                            elemParent.addClass('state-disabled');
                            elemParent.find('.btn-hide-schedule').attr('title', 'Show');
                            elemParent.find('.btn-hide-schedule').html('<i class="icon-eye-blocked"></i>');
                            elemParent.find('.btn-hide-schedule').data('hide', req_hide);
                        });
                        $this.attr('title', 'Show');
                        $this.html('<i class="icon-eye-blocked"></i>');
                    } else {
                        elemParents.each(function(i, item) {
                            var elemParent = $(item);
                            elemParent.removeClass('state-disabled');
                            elemParent.find('.btn-hide-schedule').attr('title', 'Hide');
                            elemParent.find('.btn-hide-schedule').html('<i class="icon-eye"></i>');
                            elemParent.find('.btn-hide-schedule').data('hide', req_hide);
                        });
                        $this.attr('title', 'Hide');
                        $this.html('<i class="icon-eye"></i>');
                    }

                    $this.data('hide', req_hide);
                } else
                    toastr.error('Batch Hide/Show schedule failed.', 'Sorry!');
            });
        });
    });
</script>