<section class="xs-content-section-padding position-dash waypoint-tigger">
	<div class="container">
		<div class="row col-md-12 mx-auto">
			<?php $this->load->view("front/front_page/dashboard/sidemenu"); ?>
			<div class="col-lg-9">
				<h5><?= $title_head ?></h5><hr>
				<div class="tab-content" id="v-pills-tabContent">
					<div class="tab-pane slideUp active show " id="water" role="tabpanel">
						<div class="col-md-5 row">
							<h6>Filter : </h6>
							<select class="input-control oCh" name="status" id="status">
								<option value="ALL">ALL</option>
								<option value="0">Menunggu Pembayaran</option>
								<option value="1">Paid</option>
								<option value="2">Cancelled</option>
							</select>
						</div>
						<br>
						<div class="table-responsive">
							<table width="100%" id="datatable" class="table table-striped">
								<thead>
									<tr>
										<th style="width: 10px;">No.</th>
										<th>Nama Program</th>
										<th>Nominal Wakaf</th>
										<th>Tanggal wakaf</th>
										<th>Status</th>
									</tr>
								</thead>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<script type="text/javascript">
	$(document).ready(function() {
		var dataTable = $("#datatable").DataTable({
			"aLengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
			"processing": true,
            "serverSide": true,
			"pagingType": "full_numbers",
            "ajax": {	
                url: "<?php echo base_url('dashboard/wakaf/get_list_wakaf'); ?>", 
                type: "POST",
				data: function (d) {
					d.status = $("#status").val();
                },
                error: function () {
                	
                }
            },
		});

		function reload_table(){
			dataTable.ajax.reload(null,false); 
		}

		$('.oCh').change(function(event) {
			reload_table();
		});
	});
</script>