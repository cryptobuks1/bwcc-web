<head>
	<meta charset="utf-8">
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<!-- Place this data between the <head> tags of your website -->
	<title><?php echo $title ?></title>
	<!-- <meta name="description" content=""> -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	<meta name="author" content="Kita Wakaf" />
	<meta name="description" content="Wakaf Untuk Negeri" />
	<meta keyword="" content="commodities,consolidator,indonesian commodities,investment,agritech,indonesian coconut,online Commodities,integrated commodities processing,logistic and distribution,crowdfunding,agriculture and commodities fintech,agriculture,logistic,distribution,Petani naik kelas,International trade,coffee consolidator,nutmeg consolidator,cashew consolidator,betelnut consolidator,agriculture blockchain" />

	<meta property="og:title" content="<?php if(isset($page['title'])) { echo $page['title']; } else { echo 'Kita Wakaf'; } ?>">
	<meta property="og:url" content="<?php if(isset($page['url'])) { echo $page['url']; } else { echo base_url(); } ?>">
	<meta property="og:type" content="website">
	<!-- <meta property="og:type" content="article" /> -->
	<meta property="og:description" content="Wakaf Untuk Negeri">
	<meta property="og:image" content="<?php if(isset($page['images'])) echo $page['images']; ?>">
	<meta property="og:image:type" content="image/png">
	<!-- <meta property="fb:app_id" content="710135609353567"> -->

	<!-- <meta name="twitter:image:src" content="<?php if(isset($page['images'])) { echo $page['images']; } else { echo base_url().'assets/images/logo/logo_kw_cicrle_blue.png'; } ?>"> -->
	<meta name="twitter:card" content="summary_large_image">
	<meta name="twitter:description" content="<?php if(isset($page['title'])) { echo $page['title']; } else { echo 'Kita Wakaf'; } ?>">

	<!-- Meta -->
	
	<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto+Slab:400,700" rel="stylesheet">

	<!-- <link rel="icon" type="image/png" href="favicon.ico"> -->
	<link rel="shortcut icon" href="<?= base_url('images/favicon.ico'); ?>" type="image/x-icon"/>
	<!-- Place favicon.ico in the root directory -->
	<link rel="apple-touch-icon" href="apple-touch-icon.png">

	<link rel="stylesheet" href="<?= base_url() ?>assets/css/font-awesome.min.css">

	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>bootstrap.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>xsIcon.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>isotope.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>magnific-popup.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>owl.carousel.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>owl.theme.default.min.css">
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>animate.css">

	<!-- Data Tables -->
	<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/dataTables.bs4.css" />
	<link rel="stylesheet" href="<?= base_url('assets_backend/back_end/') ?>vendor/datatables/dataTables.bs4-custom.css" />

	<!-- Flat Picker -->
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
	

	<!--For Plugins external css-->
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>plugins.css" />

	<!--Theme custom css -->
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>style.css">

	<!--Theme Responsive css-->
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>responsive.css" />

	<!-- Custom -->
	<link rel="stylesheet" href="<?= base_url('assets/css/') ?>custom.css" />

	<!-- Summernote -->
	<link rel="stylesheet" href="<?= base_url('assets/') ?>summernote/summernote-lite.css" />
	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
	
	<!-- use only color version -->
	<!-- <link rel='stylesheet' type='text/css' href='assets/css/colors/color-1.css' > -->
	<script src="<?= base_url('assets/js/') ?>jquery-3.2.1.min.js"></script>

	<!-- Mask Money -->
	<script src="https://cdn.rawgit.com/igorescobar/jQuery-Mask-Plugin/1ef022ab/dist/jquery.mask.min.js"></script>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-129188954-1"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'UA-129188954-1');
	</script>

	<!-- <script type='text/javascript' src='//platform-api.sharethis.com/js/sharethis.js#property=5bf62fadea80c50011bc553c&product=inline-share-buttons' async='async'></script> -->

</head>