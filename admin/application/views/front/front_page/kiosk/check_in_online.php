<div class="container">
	<!-- Row start -->
	<form method="post" action="<?= base_url('display/doCheckin'); ?>" enctype="multipart/form-data">
		<div class="row gutters">
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3"></div>
			<div class="col-xl-6 col-lg-6 col-md-6 col-sm-6">
				<div class="card" style="margin-top : 5%;">
					<div class="card-body">
					<?php echo return_custom_notif(); ?>
						<div class="row gutters">
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
								<input type="text" name="code_queue" class="form-control form-control-lg" id="code_queue" placeholder="Masukan Kode Booking Anda" style="font-size: x-large;">
							</div>
						</div>
						<div class="row gutters" id="nnum">
							<?php 
								for ($i=0; $i < 9; $i++) { 
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-2">
								<button type="button" class="btn btn-info btn-lg btn-block font-num this_num"><?= $i+1 ?></button>
							</div>
							<?php 
								}
							?>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-2">
								<button type="button" class="btn btn-info btn-lg btn-block font-num" id="backBtn"><i class="icon-arrow-left-outline"></i></button>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-2">
								<button type="button" class="btn btn-info btn-lg btn-block font-num this_num">0</button>
							</div>
							<div class="col-xl-4 col-lg-4 col-md-4 col-sm-4 mb-2">
								<button type="submit" class="btn btn-info btn-lg btn-block font-num"><i class="icon-tick-outline"></i></button>
							</div>
							<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2">
								<a href="<?= base_url('display/kiosk') ?>" class="btn btn-danger btn-lg btn-block">Kembali</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-xl-3 col-lg-3 col-md-3 col-sm-3"></div>
		</div>
	</form>
	<!-- Row ends -->
</div>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script type="text/javascript">
	$('#nnum .this_num').click(function() {
	    var value = $(this).text();
	    var input = $('#code_queue');
	    input.val(input.val() + value);
	    return false;
	});

	$('#backBtn').click(function(){
       var curNomor = $('#code_queue').val();
       var length = curNomor.length;
       if(length > 0){
           $('#code_queue').val(curNomor.substr(0,length-1));
       }
   });
</script>