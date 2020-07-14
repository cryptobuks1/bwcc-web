<?php 
    $selected_date = date('m-d-Y', strtotime($detailData['date'])); 
    $is_hide_btn = FALSE;
    foreach ($detailData['items'] as $item) {
        if(!empty($item->patient_id)) {
            $is_hide_btn = TRUE;
            break;
        }
    }
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
					<h6 class="sub-heading">Add or Delete Schedule Time</h6>
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

        <form id="add-schedule-form" method="post" action="<?= base_url('cms/schedule/doUpdate?poly_id='.$detailData['id_poly'].'&doctor_id='.$detailData['id_doctor'].'&date_time='.$detailData['date']); ?>" enctype="multipart/form-data">

            <div class="card">

                <div class="card-header main-head">Add or Delete Schedule Time</div>

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
                            <select class="form-control selectpicker" name="id_doctor_id" id="id_doctor" data-live-search="true" required="" disabled="disabled">
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
                                    <?php 
                                    if(!$is_hide_btn) { ?>
                                        <!-- <button class="btn-date-delete btn btn-danger btn-sm" title="Delete" data-date="<?php echo $selected_date; ?>"  style="float:right"><i class="fa fa-trash"></i></button> -->
                                    <?php } ?>
                                </div>
                                <div class="card-body">
                                    <p class="card-title">Time Slot</p>
                                    <div class="card-text">
                                        <div class="mb-3">
                                            <div class="row">
                                                <div class="col-md-12 clearfix" style="display: flex">
                                                    <input type="time" class="start-time form-control form-control-sm" style="margin-right: 3px" />
                                                    <input type="time" class="finish-time form-control form-control-sm" style="margin-right: 3px" />
                                                    <button type="button" class="btn-time btn btn-dark btn-sm" data-date="<?php echo $selected_date; ?>"><i class="icon-timer"></i> Add Time</button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="schedule-item-time-area row">
                                            <?php
                                            foreach ($detailData['items'] as $item) {
                                                $start = date('H:i', strtotime($item->start_time_service));
                                                $finish = date('H:i', strtotime($item->finish_time_service));

                                                $badge_color = 'badge-primary';
                                                $badge_times = '&nbsp;&nbsp;<i class="icon-cross"></i>';
                                                $badge_name = 'badge-time';

                                                if(!empty($item->patient_id)) {
                                                    $badge_color = 'badge-danger';
                                                    $badge_times = '&nbsp;&nbsp;<i class="icon-user3"></i>';
                                                    $badge_name = '';
                                                }

                                                echo '<div class="time-item col-xl-6 col-lg-6 col-md-6 col-sm-6 mt-1">
                                                        <span class="'.$badge_name.' badge badge-bdr '.$badge_color.'" data-date="'.$selected_date.'" data-start="'.$start.'" data-finish="'.$finish.'">'.$start.' - '.$finish.' '.$badge_times.'</span>
                                                    </div>';
                                            } ?>
                                        </div>
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
        var schedules_model = [];

        var schedule_time_items = [];
        <?php foreach ($detailData['items'] as $item) {
                $start = date('H:i', strtotime($item->start_time_service));
                $finish = date('H:i', strtotime($item->finish_time_service)); ?>
            schedule_time_items.push({ 'start_time' : '<?php echo $start; ?>', 'finish_time' : '<?php echo $finish; ?>' });
        <?php } ?>
        schedules_model.push({ 'date' : "<?php echo $selected_date; ?>", 'items' : schedule_time_items });

        $('#date-schedule').val("<?php echo $selected_date; ?>");

        $("#add-schedule-form").submit( function(eventObj) {
            $("<input />").attr("type", "hidden")
                .attr("name", "schedule_items")
                .attr("value", JSON.stringify(schedules_model))
                .appendTo("#add-schedule-form");
            return true;
        });

        $('#schedule-item-date-area').on('click', '.btn-time', function(){
            var $this = $(this);
            var time_parent = $this.parent(); 

            var start = time_parent.find('.start-time');
            var finish = time_parent.find('.finish-time');

            var start_time = start.val();
            var finish_time = finish.val();

            if(validateScheduleTime($this.data('date'), start_time, finish_time))
                return;

            var html = addScheduleTimeItem($this.data('date'), start_time, finish_time);
            var time_area = $this.closest('.card-text').find('.schedule-item-time-area');
            time_area.append(html);

            $.each(schedules_model, function(i, obj) {
                if(obj.date == $this.data('date'))
                    obj.items.push({ 'start_time' : start_time, 'finish_time' : finish_time });
            });

            console.log(schedules_model);

            start.val(finish_time);
            finish.val(finish_time);
        });

        $('#schedule-item-date-area').on('click', '.badge-time', function(){
            var $this = $(this);
            var date = $this.data('date');
            var start_time = $this.data('start');
            var finish_time = $this.data('finish');

            $.each(schedules_model, function(i, obj) {
                if(obj.date == date) {
                    $.each(obj.items, function(j, obj2) {
                        if(obj2.start_time == start_time && obj2.finish_time == finish_time) {
                            //delete schedules_model[i].items[j];
                            schedules_model[i].items = $.grep(schedules_model[i].items, function(a) {
                                return !(a.start_time == start_time && a.finish_time == finish_time);
                            });
                            $this.closest('.time-item').remove();
                            return false;
                        }
                    });
                    return false;
                }
            });

            console.log(schedules_model);
        });

        $('#schedule-item-date-area').on('click', '.btn-date-delete', function(){
            var $this = $(this);
            var date = $this.data('date');

            schedules_model = $.grep(schedules_model, function(a) {
                return !(a.date == date);
            });

            $this.closest('.date-item').remove();

            console.log(schedules_model);
        });

        function addScheduleTimeItem(date, start, finish) {
            return '<div class="time-item col-xl-6 col-lg-6 col-md-6 col-sm-6 mt-1">' +
                        '<span class="badge-time badge badge-bdr badge-primary" data-date="' + date + '" data-start="' + start + '" data-finish="' + finish + '">' + start + ' - ' + finish + ' <i class="icon-cross"></i></span>' +
                    '</div>';
        }

        function validateScheduleTime(date, start_time, finish_time) {
            var is_error = false;
            var error_message = '';

            if(start_time == '' || finish_time == '') {
                is_error = true;
                error_message = 'Start time or finish time cannot be empty.';
            }

            var startToMoment = moment(start_time, "HH:mm");
            var finishToMoment = moment(finish_time, "HH:mm");
            var difMinutes = finishToMoment.diff(startToMoment, 'minutes');
            console.log(startToMoment + ' - ' + finishToMoment + ' = ' + difMinutes);
            if(difMinutes <= 0) {
                is_error = true;
                error_message = 'Schedule Time finish must greater than Time start.';
            }

            $.each(schedules_model, function(i, obj) {
                if(obj.date == date) {
                    $.each(obj.items, function(j, obj2) {
                        if(obj2.start_time == start_time && obj2.finish_time == finish_time) {
                            is_error = true;
                            error_message = 'Time already entered.';
                        }
                    });
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