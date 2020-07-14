<div class="container">
	<!-- Row start -->
	<?php //print_r($dataLoket);?>
	<div class="row gutters" style="margin-top: 5%;">
	<?php 
		// for ($i=0; $i < sizeof($dataLoket); $i++) { 
			
			// echo sizeof($dataLoket);
			$i=0;
			foreach ($dataLoket as $item) {
				$i++;
				// print_r($i);

	?>
		<div class="col-xl-3 col-lg-3 col-md-3 col-sm-6" >
			<div class="card">
				<div class="card-header text-center card_<?=$item['id'];?>" style="background: #7db5fc;color: #fff;">
					<h1 id="nama_loket_<?= $item['id'];?>"><?= $item['name'] ?></h1>
				</div>
				<div class="card-body">
					<div class="chartist custom-two">
						<div class="pie-chart"></div>
					</div>
					<div class="row gutters">
						<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col">
							<div class="info-stats">
								<h1 class="text-success" id="kode_antrian_<?= $item['id'];?>"><b>-</b></h1>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="result"></div>
	<?php 
		}
	?>
	</div>
	<!-- Row end -->
</div>

<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/howler/2.1.2/howler.min.js"></script>
<script type="text/javascript">
	function loadlink(){
		$.get( "https://api.rsudtamansari.com/public_html/loket/antrian/"+Date.now()+"?key=7TmgitdDpPsh8YC8MXkkuzqZ1YOGDwJA", function( data ) {
			
			if(data['data']['data']['active_loket'] == null){
				console.log('kosong');
				console.log('jumlah loket: ', data['data']['data']);
				$.each(data['data']['data']['list_loket'], function (name,value) {
				
					//jika angka 0 ubah text
					if(value['antrian_sekarang'] == 0){
						$('#nama_loket_'+value['id_loket']+'').html(value['nama_loket']);
						$('#kode_antrian_'+value['id_loket']+'').html("-");
						$(".card_"+value['id_loket']+"").removeClass("active_loket");
					}else{
						$('#nama_loket_'+value['id_loket']+'').html(value['nama_loket']);
						$('#kode_antrian_'+value['id_loket']+'').html(value['antrian_sekarang']);
						$(".card_"+value['id_loket']+"").removeClass("active_loket");
					}
					
				});
			}else{
				console.log('isi');
				console.log('jumlah loket: ', data['data']['data']['list_loket'].length);
				$.each(data['data']['data']['list_loket'], function (name,value) {
					console.log('nama_loket_'+value['id_loket']+','+value['nama_loket']);
					$('#nama_loket_'+value['id_loket']+'').html(value['nama_loket']);
					$('#kode_antrian_'+value['id_loket']+'').html(value['antrian_sekarang']);
					// $(".card_0").addClass("active_loket");

					if(data['data']['data']['active_loket'].length != 0){
						console.log('antrian loket: ', data['data']['data']['active_loket']['id_antrian']);
						$(".card_"+data['data']['data']['active_loket']['id_loket']+"").addClass("active_loket");
						calling(data['data']['data']['active_loket']['audio_url'],data['data']['data']['active_loket']['id_antrian'],data['data']['data']['active_loket']['id_loket']);
					}
					
				});
			}
		});
	}

	//=========LIST VARIABLE===================//
	var audio_list = [];
	var isPaused = false;


	//=========ALGORITM=====================//	
	//1. Document reload pertama
	$( document ).ready(function() {
		// var context = new AudioContext();
		// context.resume().then(() => {
		// 	console.log('Playback resumed successfully');
		// 	// setTimeout(function(){isPaused = false; }, 2000);
		// 	loadlink();	
		// });
		console.log( "ready!" );
		loadlink();	
		
	});


	function calling(url="",params2="", id_loket=""){ 
		// Interval Pause
		isPaused = true;

		// initialisation:
		var onPlay = [false],  // this one is useless now
		pCount = 0;
		playlistUrls = [
			'https://api.rsudtamansari.com/uploads/static/tingtong.mp3',
			url
			], // audio list
		howlerBank = [],
		loop = false;

		// playing i+1 audio (= chaining audio files)
		var onEnd = function(e) {
		if (loop === true ) { pCount = (pCount + 1 !== howlerBank.length)? pCount + 1 : 0; }
		else { pCount = pCount + 1; }
			console.log('pCount: ',pCount);
			console.log('playlistlength: ', playlistUrls.length);
			if(pCount < playlistUrls.length){
				howlerBank[pCount].play();
			}else{
				console.log('playlist sudah habis');
				$(".card_"+id_loket+"").removeClass("active_loket");
				// updateCalling(params2);
				setTimeout(function(){isPaused = false; }, 5000);
				
			}

		};

		// build up howlerBank:     
		playlistUrls.forEach(function(current, i) {   
			howlerBank.push(new Howl({ src: [playlistUrls[i]],format: ['mp3'], html5: true, onend: onEnd, buffer: true }))
		});

		// initiate the whole :
		howlerBank[0].play();
		
	}
	
	//2. Jalankan interval terus sampai ada pause (interval pause or play)
	var t = window.setInterval(function() {
		if(!isPaused) {
			loadlink()
		}
	}, 2000);

	//3. Update calling kalau sudah dipanggil
	function updateCalling(params=""){
		// $.post("https://api.rsudtamansari.com/public_html/loket/finish?key=7TmgitdDpPsh8YC8MXkkuzqZ1YOGDwJA", {id_antrian: params}, function(result){
		// 	// $("span").html(result);
		// 	console.log('update calling: ',result);
		// });
	}

</script>

<style>
.active_loket{
	background: #2b333e !important;
	color: #fff;
}
</style>