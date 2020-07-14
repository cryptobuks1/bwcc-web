<!-- Summernote -->
<script src="<?= base_url('assets/summernote/') ?>summernote-lite.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>

<script src="<?= base_url('assets/js/') ?>plugins.js"></script>
<script src="<?= base_url('assets/js/') ?>bootstrap.min.js"></script>
<script src="<?= base_url('assets/js/') ?>isotope.pkgd.min.js"></script>
<script src="<?= base_url('assets/js/') ?>jquery.magnific-popup.min.js"></script>
<script src="<?= base_url('assets/js/') ?>owl.carousel.min.js"></script>
<script src="<?= base_url('assets/js/') ?>jquery.waypoints.min.js"></script>
<script src="<?= base_url('assets/js/') ?>jquery.countdown.min.js"></script>
<script src="<?= base_url('assets/js/') ?>spectragram.min.js"></script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?v=3&key=AIzaSyCy7becgYuLwns3uumNm6WdBYkBpLfy44k"></script> -->

<!-- Data Tables -->
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/dataTables.min.js"></script>
<script src="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/dataTables.bootstrap.min.js"></script>

<!-- Flat Picker -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<!-- CkEditor -->
<!-- <script src="<?= base_url('assets/') ?>ckeditor/ckeditor.js"></script> -->

<!-- Summernote -->
<script src="<?= base_url('assets/') ?>summernote/summernote.js"></script>

<script src="<?= base_url('assets/js') ?>/main.js"></script>

<!-- Rating -->
<script src="<?= base_url('assets/rate/') ?>src/jquery.star-rating-svg.js"></script>

<script type="text/javascript">
	$(document).ready(function(){
	    // Format mata uang.
	    $( '.uang' ).mask('0.000.000.000.000', {reverse: true});
	    // Format nomor HP.
	    $( '.no_hp' ).mask('0000−0000−0000');
	})

	$('.summernote').summernote({
        placeholder: '',
        tabsize: 1,
        height: 300
      });

	$(".selectorNoConfig").flatpickr({
		dateFormat: "Y-m-d"
	});

	$(".selector").flatpickr({
		minDate: "today",
		dateFormat: "Y-m-d",
		disable: [
		    function(date) {
		        // disable date before today
		        return !(date.getDate() < date);
		    }
		]
	});

	$(".selectorRange").flatpickr({
		mode: "range",
	    // minDate: "today",	
	    dateFormat: "Y-m-d"
	});

	// Rating
	$(".my-rating-4").starRating({
		totalStars: 5,
		starShape: 'rounded',
		starSize: 15,
		emptyColor: 'lightgray',
		hoverColor: 'salmon',
		activeColor: '#FFD700',
		useGradient: false
	});
</script>