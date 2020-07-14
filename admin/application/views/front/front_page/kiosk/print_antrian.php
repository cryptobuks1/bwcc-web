<html>
<head><meta http-equiv=Content-Type content="text/html; charset=UTF-8">
<style type="text/css">
	span.cls_002{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
	div.cls_002{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
	span.cls_003{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
	div.cls_003{font-family:Arial,serif;font-size:10.1px;color:rgb(0,0,0);font-weight:normal;font-style:normal;text-decoration: none}
	span.cls_004{font-family:Arial,serif;font-size:21.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
	div.cls_004{font-family:Arial,serif;font-size:21.1px;color:rgb(0,0,0);font-weight:bold;font-style:normal;text-decoration: none}
	span.cls_005{font-family:Arial,serif;font-size:8.1px;color:rgb(0,0,0);font-weight:normal;font-style:italic;text-decoration: none}
	div.cls_005{font-family:Arial,serif;font-size:8.1px;color:rgb(0,0,0);font-weight:normal;font-style:italic;text-decoration: none}
</style>
<!-- <script type="text/javascript" src="9a26e2b0-9341-11e9-9d71-0cc47a792c0a_id_9a26e2b0-9341-11e9-9d71-0cc47a792c0a_files/wz_jsgraphics.js"></script> -->
</head>
<body>
<div style="position:absolute;left:50%;margin-left:-113px;top:0px;width:226px;height:510px;border-style:outset;overflow:hidden">
	<div style="position:absolute;left:0px;top:0px">
		<img src="<?= base_url('assets/images/bg-kiosk.jpg') ?>" width=226 height=510>
	</div>
	<div style="position:absolute;left:72.80px;top:11.05px" class="cls_002">
		<span class="cls_002">RSUD TAMANSARI</span>
	</div>
	<!-- <div style="position:absolute;left:62.51px;top:21.85px" class="cls_003"> -->
	<div style="position:absolute;left:23px;top:21.85px" class="cls_003">
		<span class="cls_003">JL. Madu No. 10, Mangga Besar, Jakarta</span>
	</div>
	<div style="position:absolute;left:75.00px;top:44.95px" class="cls_003">
		<span class="cls_003">Tgl. <?= date("d", strtotime($history->tanggal))." ".bulan($history->tanggal)." ".date("Y", strtotime($history->tanggal)) ?></span>
	</div>
	<!-- <div style="position:absolute;left:58.89px;top:55.75px" class="cls_003">
		<span class="cls_003">SPESIALIS KEBIDANAN</span>
	</div> -->
	<div style="position:absolute;left:57.50px;top:57.55px" class="cls_003">
		<span class="cls_003"><?= strtoupper($history->poly_name) ?></span>
	</div>
	<div style="position:absolute;left:81.13px;top:69.35px" class="cls_003">
		<span class="cls_003">NO. ANTRIAN</span>
	</div>
	<div style="position:absolute;left:83.02px;top:109.74px" class="cls_004">
		<span class="cls_004"><?= $history->queue_code ?></span>
	</div>
	<div style="position:absolute;left:98.36px;top:167.23px" class="cls_003">
		<span class="cls_003"><?= $history->payment_name ?></span>
	</div>
	<!-- <div style="position:absolute;left:67.80px;top:188.83px" class="cls_002">
		<span class="cls_002">KELOMPOK TUNAI</span>
	</div> -->
	<div style="position:absolute;left:53.05px;top:180.63px" class="cls_003">
		<span class="cls_003">Total Antrian Menunggu : </span>
		<span class="cls_002"><?= $total_antrian->total ?></span>
	</div>
	<div style="position:absolute;left:15.15px;top:210.18px" class="cls_005">
		<span class="cls_005">Nomor ini merupakan antrian pendaftaran, bukan nomor</span>
	</div>
	<div style="position:absolute;left:76.01px;top:222.25px" class="cls_005">
		<span class="cls_005">antrian pemeriksaan</span>
	</div>
	<div style="position:absolute;left:2.25px;top:243.01px" class="cls_003">
		<span class="cls_003">12-06-2019</span>
	</div>
	<div style="position:absolute;left:185.58px;top:243.01px" class="cls_003">
		<span class="cls_003">15:31:57</span>
	</div>
</div>

</body>
</html>
<script type="text/javascript">
	window.print()
	setInterval(function(){ 
		window.location.assign("<?= base_url('display/kiosk') ?>");
	}, 1000);
</script>
