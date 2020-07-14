<!-- BEGIN .main-heading -->
<header class="main-heading">
	<div class="container-fluid">
		<div class="row">
			<div class="col-xl-8 col-lg-8 col-md-8 col-sm-8">
				<div class="page-icon">
					<i class="fa fa-angle-down"></i>
				</div>
				<div class="page-title">
					<h5>Books</h5>
					<h6 class="sub-heading">List Booking</h6>
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
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="<?= base_url('cms/reqantrian/view_result_search'); ?>" enctype="multipart/form-data">
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

	<div class="row gutters">
		<div class="col-md-12">
			<div class="card">
				<div class="card-header main-head">List Booking	</div>
				<div class="card-body">
					<div class="form-group">
						<!-- <a href="<?= base_url('cms/dokter/add'); ?>" class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Add</a> -->
						<!-- Filter :
						<select class="form-control selectpicker col-md-2 oCh" id="is_approve" data-live-search="true">
							<option value="">All</option>
							<option value="0">Pending</option>
							<option value="1">Done</option>
						</select> -->
					</div>
					<?php echo return_custom_notif(); ?>
					<div class="table-responsive">
						<table width="100%" id="datatable" class="table table-striped">
							<thead>
								<tr>
									<th style="width: 10px;">No</th>
									<th>Pasien</th>
									<th>Doktor</th>									
									<th>Request Time</th>
									<th>Schedule</th>
									<th>Queue</th>
									<th>Poly</th>
									<th>Payment Method</th>
									<th>Status</th>																	
									<th>Action</th>
								</tr>
							</thead>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<!-- <img src="http://i.stack.imgur.com/hCYTd.jpg" />
<button onclick="printImg('http://i.stack.imgur.com/hCYTd.jpg')">Print</button> -->

<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"processing": true,
			"dom": 'Blfrtip',
            "serverSide": true,
			"pagingType": "full_numbers",
            "ajax": {	
                url: "<?php echo base_url('cms/reqantrian/get_list_req_antrian'); ?>", 
                type: "POST",
				data: function (d) {
					// d.is_approve = $("#is_approve").val();
                },
                error: function () {
                	
                }
            },
		});

		// function reload_table(){
		// 	dataTable.ajax.reload(null,false); 
		// }

		// $('.oCh').change(function(event) {
		// 	reload_table();
		// });
	});

	function printImg(url) {
	  var win = window.open('');
	  win.document.write('<img src="' + url + '" onload="window.print();window.close()" />');
	  win.focus();
	}
</script>

<script>
	
// $(document).ready(function() {
//    $('.inputClass').each(function() {
//       $(this).click(function(){
//       	var win = window.open('');
//         var id = $("#print_image_payment").val(); 
        
//         win.document.write('<img src="' + id + '" onload="window.print();window.close()" />');
// 	  	win.focus();

//       });
//    });
// });

</script>