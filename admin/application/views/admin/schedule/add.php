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
					<h6 class="sub-heading">Add Schedule</h6>
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

        <form id="add-schedule-form" method="post" action="<?= base_url('cms/schedule/doAdd/'); ?>" enctype="multipart/form-data">

            <div class="card">

                <div class="card-header main-head">Add Schedule</div>

                <div class="card-body">

                    <?php echo return_custom_notif();?>

                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Poly</label>

                        <div class="col-md-10">
                            <select class="form-control selectpicker" name="id_poly" id="id_poly" data-live-search="true" required>
                                <option selected disabled value="">Select Poly</option>
                            <?php foreach ($list_poly as $poly) { ?>
                                <option value="<?= $poly->id ?>"><?= $poly->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Doctor</label>

                        <div class="col-md-10">
                            <select class="form-control selectpicker" name="id_doctor" id="id_doctor" data-live-search="true" required>
                                <option selected disabled value="">Select Doctor</option>
                            <?php foreach ($list_doctor as $item) { ?>
                                <option value="<?= $item->id ?>"><?= $item->name ?></option>
                            <?php } ?>
                            </select>
                        </div>
                    </div>

                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Date Schedule</label>
                        <div class="col-md-7">
                            <input type="input" id="date-schedule" class="form-control" />
                        </div>
                        <div class="col-md-3">
                            <button id="btn-date" type="button" class="btn btn-primary btn-sm" style="margin-top: 2px"><i class="icon-calendar2"></i> Add Date</button>
                        </div>
                    </div>

                    <div id="schedule-item-date-area" class="row">
                        
                    </div>

                    <!-- <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Date</label>
                        <div class="col-md-10">
                            <input placeholder="Selected date" type="text" name="date_selected" id="date-1" class="form-control datepicker" data-provide="datepicker" required="">
                        </div>
                    </div>
                    
                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">Start at</label>
                        <div class="col-md-10">
                            <input id="start_time_service" type="time"  class="form-control" name="time_start" required="">
                        </div>
                    </div>
                    <div class="form-group row gutters">
                        <label class="col-md-2 col-form-label">End at</label>
                        <div class="col-md-10">
                            <input id="finish_time_service" type="time"  class="form-control" name="time_finish" required="">
                        </div>
                    </div> -->
                </div>

                <div class="card-footer">                
                    <button type="submit" class="btn btn-primary"><i class="fa fa-save"></i> Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script type="text/javascript">    
    $(document).ready(function(){
        var schedules_model = [];

        $('#date-schedule').daterangepicker({
            "singleDatePicker": true,
            "showDropdowns": true,
            "timePicker": false,
            "autoApply": true,
            "locale": {
                "format": "DD-MM-YYYY",
                "separator": " - ",
                
                "firstDay": 1
            }
        });
        $('#date-schedule').val('');

        $("#add-schedule-form").submit( function(eventObj) {
            $("<input />").attr("type", "hidden")
                .attr("name", "schedule_items")
                .attr("value", JSON.stringify(schedules_model))
                .appendTo("#add-schedule-form");
            return true;
        });

        $('#btn-date').on('click', function(){
            var date_ori = $('#date-schedule').val();
            var date = moment(date_ori, "DD-MM-YYYY").format('MM-DD-YYYY')
            var date_display = moment(date, 'MM-DD-YYYY').format('dddd, DD-MM-YYYY');

            if(validateScheduleDate(date))
                return;

            var html = addScheduleDateItem(date, date_display);
            $('#schedule-item-date-area').append(html);

            var schedule_item = {'date' : date, 'items': []};
            schedules_model.push(schedule_item);

            $('#date-schedule').val('');
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

        function addScheduleDateItem(date, date_display) {
            return '<div class="date-item col-xl-4 col-lg-6 col-md-6 col-sm-12 col-xs-12">' +
                        '<div class="card">' +
                            '<div class="card-header clearfix">' + 
                            '<h5 style="float:left; margin-top: 8px">' + date_display + '</h5>' + 
                            '<button class="btn-date-delete btn btn-danger btn-sm" title="Delete" data-date="' + date + '"  style="float:right"><i class="fa fa-trash"></i></button>' +
                            '</div>' +
                            '<div class="card-body">' +
                                '<p class="card-title">Time Slot</p>' +
                                '<div class="card-text">' +
                                    '<div class="mb-3">' +
                                        '<div class="row">' +
                                            '<div class="col-md-12 clearfix" style="display: flex">' +
                                                '<input type="time" class="start-time form-control form-control-sm" style="margin-right: 3px" />' +
                                                '<input type="time" class="finish-time form-control form-control-sm" style="margin-right: 3px" />' +
                                                '<button type="button" class="btn-time btn btn-dark btn-sm" data-date="' + date + '"><i class="icon-timer"></i> Add Time</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                    '<div class="schedule-item-time-area row"></div>' +
                               '</div>' +
                            '</div>' +
                        '</div>' +
                    '</div>';
        }

        function addScheduleTimeItem(date, start, finish) {
            return '<div class="time-item col-xl-6 col-lg-6 col-md-6 col-sm-6 mt-1">' +
                        '<span class="badge-time badge badge-bdr badge-primary" data-date="' + date + '" data-start="' + start + '" data-finish="' + finish + '">' + start + ' - ' + finish + '&nbsp;&nbsp;<i class="icon-cross"></i></span>' +
                    '</div>';
        }

        function validateScheduleDate(date) {
            var is_error = false;
            var error_message = '';
            $.each(schedules_model, function(i, obj) {
                if(obj.date == date){
                    is_error = true;
                    error_message = 'Date already entered.';
                    return false;
                }
            });

            if(schedules_model.length > 15) {
                is_error = true;
                error_message = 'Cannot enter more than 15 dates.';
            }

            if(is_error) {
                toastr.error(error_message, 'Sorry!');
            }

            return is_error;
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