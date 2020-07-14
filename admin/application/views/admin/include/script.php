

<!-- jQuery first, then Tether, then other JS. -->
<script src="<?= base_url('assets_backend/back_end/') ?>js/bootstrap.min.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/unifyMenu/unifyMenu.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/onoffcanvas/onoffcanvas.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>js/moment.js"></script>

<!-- Slimscroll JS -->
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/slimscroll/slimscroll.min.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/slimscroll/custom-scrollbar.js"></script>

<!-- Chartist JS -->
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/chartist.min.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/chartist-tooltip.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/custom/custom-line-chart.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/custom/custom-line-chart1.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/custom/custom-area-chart.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/custom/donut-chart2.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/chartist/js/custom/custom-line-chart4.js"></script>

<!-- Data Tables -->
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/dataTables.min.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/dataTables.bootstrap.min.js"></script>

<!-- Custom Data tables -->
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/custom/custom-datatables.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/custom/fixedHeader.js"></script>
<!-- Selectpicker -->
<script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

<!-- Date Time Picker -->
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<!-- Common JS -->
<script src="<?= base_url('assets_backend/back_end/') ?>js/common.js"></script>

<!-- Time Picker -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-timepicker/0.5.2/js/bootstrap-timepicker.min.js"></script>
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js"></script>
<script src="http://cdn.jsdelivr.net/timepicker.js/latest/timepicker.min.js"></script>

<!-- Notify -->
<script src="<?= base_url('assets_backend/back_end/vendor/notify/bootstrap-notify.js'); ?>"></script>
<script src="<?= base_url('assets_backend/back_end/vendor/notify/bootstrap-notify.min.js'); ?>"></script>

<!-- HIGHCHART -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script src="https://code.highcharts.com/modules/data.js"></script>
<script src="https://code.highcharts.com/modules/exporting.js"></script>
<script src="https://code.highcharts.com/modules/export-data.js"></script>

<!-- NUMBER FORMAT -->
<script src="<?= base_url('assets_backend/back_end/vendor/number/jquery.number.js'); ?>"></script>
<script src="<?= base_url('assets_backend/back_end/vendor/number/jquery.number.min.js'); ?>"></script>

<!-- <script src="<?= base_url('assets_backend/back_end/ckeditor/ckeditor.js'); ?>"></script>
<script src="<?= base_url('assets_backend/back_end/ckeditor/sample.js'); ?>"></script> -->

<!-- Summernote -->
<script src="<?= base_url('assets/summernote/') ?>summernote-lite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<!-- D MODAL -->
<div class="modal fade" id="delmodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<form id="delmodalForm">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Are you sure ?</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					Are you sure you want to <b>DELETE</b> this data?
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
					<button type="submit" class="btn btn-primary">Delete</button>
				</div>
			</div>
		</form>
	</div>
</div>

<script type="text/javascript">
	$(document).ready(function(){
	    // Format mata uang.
	    $( '.uang' ).mask('0.000.000.000', {reverse: true});
	    // Format nomor HP.
	    $( '.no_hp' ).mask('0000−0000−0000');
	});

	$('.summernote').summernote({
        placeholder: '',
        tabsize: 1,
        height: 300
      });
	
	function is_delete(url){
		$("#delmodal").modal("show");
		$("#delmodalForm").attr('action', url);
	}
	
	/*DATERANGE PICKER*/
	$(function() {
		$('.datetimepicker').daterangepicker({
		    "singleDatePicker": true,
		    "showDropdowns": true,
		    "timePicker": true,
		    "autoApply": true,
		    "locale": {
		        "format": "MM/DD/YYYY hh:mm A",
		        "separator": " - ",
		        
		        "firstDay": 1
		    }
		}, function(start, end, label) {
		  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
		});
	});

	$(function() {
		$('.datepicker').daterangepicker({
		    "singleDatePicker": true,
		    "showDropdowns": true,
		    "timePicker": false,
		    "autoApply": true,
		    "locale": {
		        "format": "MM/DD/YYYY",
		        "separator": " - ",
		        
		        "firstDay": 1
		    }
		}, function(start, end, label) {
		  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
		});
	});

	$(function () {
        $('#datetimepicker3').datetimepicker({
            format: 'HH:mm'
        });
    });

	// Time Picker
	var time = [];
	for (var i = 1; i < 29; i++) { 
	  time.push("time"+i);
	}

    var timepicker = new TimePicker(time, {
	  lang: 'en',
	  theme: 'dark'
	});
	timepicker.on('change', function(evt) {
	  
	  var value = (evt.hour || '00') + ':' + (evt.minute || '00');
	  evt.element.value = value;

	});

	$('.daterange').daterangepicker({
	}, function(start, end, label) {
	  console.log('New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')');
	});

	$('.what').datetimepicker({
	    dateFormat: '',
	    timeFormat: 'hh:mm tt',
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
		 $('#timpepicker1').timepicker({
		 	minuteStep: 5,
            showInputs: false,
            disableFocus: true
		 });

		 $('.timepicker1').datetimepicker({
	        pickDate: false,
	        pickSeconds: false,
	        maskInput: true,
	        language: 'en',
      		pick12HourFormat: true
	      });
	});
</script>
