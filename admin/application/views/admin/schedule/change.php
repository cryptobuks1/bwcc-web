<?php 
    $selected_date = date('m-d-Y', strtotime($detailData['date'])); 
?>

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
					<h6 class="sub-heading">Change Schedule</h6>
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
    <div class="col-md-12">

        <form id="add-schedule-form" method="post" action="<?= base_url('cms/schedule/doChange?poly_id='.$detailData['id_poly'].'&doctor_id='.$detailData['id_doctor'].'&date_time='.$detailData['date']); ?>" enctype="multipart/form-data">

            <div class="card">

                <div class="card-header main-head">Change Schedule</div>

                <div class="card-body">

                    <?php echo return_custom_notif();?>

                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Poly</label>

                        <div class="col-md-10">
                            <select class="form-control selectpicker" name="id_poly" id="id_poly" data-live-search="true" required="" disabled="disabled">
                                <option selected disabled value="">Select Poly</option>
                            <?php foreach ($list_poly as $poly) { ?>
                                <option value="<?= $poly->id ?>" <?= check_selected($poly->id, $detailData['id_poly']) ?>><?= $poly->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Doctor</label>

                        <div class="col-md-10">
                            <select class="form-control selectpicker" name="id_doctor_id" id="id_doctor" data-live-search="true" required="">
                                <option selected disabled value="">Select Doctor</option>
                            <?php foreach ($list_doctor as $item) { ?>
                                <option value="<?= $item->id ?>" <?= check_selected($item->id, $detailData['id_doctor']) ?>><?= $item->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <input type="hidden" id="date-schedule" class="form-control"  />

                    <div id="schedule-item-date-area" class="row">
                        <div class="date-item col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="card">
                                <div class="card-header clearfix"> 
                                    <h5 style="float:left; margin-top: 8px"> <?= date('l, d-m-Y', strtotime($detailData['date'])); ?> </h5> 
                                </div>
                                <div class="card-body">
                                    <p class="card-title">Time Slot</p>
                                    <div class="card-text">
                                        
                                        <!-- <div class="schedule-item-time-area row"> -->
                                            <?php
                                            foreach ($detailData['items'] as $item) {
                                                $start = date('H:i', strtotime($item->start_time_service));
                                                $finish = date('H:i', strtotime($item->finish_time_service));

                                                $input_class = '';
                                                if(!empty($item->patient_id)) {
                                                    $input_class = 'is-invalid';
                                                }
                                            ?>

                                            <div class="schedule-item-time-input-area mb-2">
                                                <div class="row">
                                                    <div class="col-md-12 clearfix" style="display: flex">
                                                        <input type="hidden" class="schedule-id" value="<?= $item->id; ?>" />
                                                        <input type="time" class="start-time form-control form-control-sm <?= $input_class; ?>" style="margin-right: 3px" value="<?= $start; ?>" />
                                                        <input type="time" class="finish-time form-control form-control-sm <?= $input_class; ?>" style="margin-right: 3px" value="<?= $finish; ?>" />
                                                        <!-- <button type="button" class="btn-time btn btn-dark btn-sm" data-date="<?php echo $selected_date; ?>"><i class="icon-timer"></i> Add Time</button> -->
                                                    </div>
                                                </div>
                                            </div>

                                            <?php } ?>
                                        <!-- </div> -->
                                   </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer">                
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    $(document).ready(function () {
        $('#date-schedule').val("<?php echo $selected_date; ?>");

        $("#add-schedule-form").submit( function(eventObj) {
            var schedules_model = [];
            var is_error = false;

            var items = $('.schedule-item-time-input-area');
            $.each(items, function(i, el){
                var start_time = $(el).find('.start-time').val();
                var finish_time = $(el).find('.finish-time').val();
                var schedule_id = $(el).find('.schedule-id').val();

                if(validateScheduleTime(schedules_model, start_time, finish_time)) {
                    is_error = true;
                    return false;
                }

                schedules_model.push({
                    'start_time' : start_time,
                    'finish_time' : finish_time,
                    'id' : schedule_id
                });
            });

            if(is_error)
                return false;

            $("<input />").attr("type", "hidden")
                .attr("name", "schedule_items")
                .attr("value", JSON.stringify(schedules_model))
                .appendTo("#add-schedule-form");
            return true;
        });

        function validateScheduleTime(schedules_model, start_time, finish_time) {
            console.log(start_time+' - '+finish_time);
            var is_error = false;
            var error_message = '';

            if(start_time == '' || finish_time == '') {
                is_error = true;
                error_message = 'Start time or finish time cannot be empty.';
            }

            var startToMoment = moment(start_time, "HH:mm");
            var finishToMoment = moment(finish_time, "HH:mm");
            var difMinutes = finishToMoment.diff(startToMoment, 'minutes');

            if(difMinutes <= 0) {
                is_error = true;
                error_message = 'Schedule Time finish must greater than Time start.';
            }

            $.each(schedules_model, function(i, obj) {
                if(obj.start_time == start_time && obj.finish_time == finish_time) {
                    is_error = true;
                    error_message = 'Time already entered.';
                    return false;
                }
            });

            if(is_error) {
                toastr.error(error_message, 'Sorry!');
            }

            return is_error;
        }

    });
</script>