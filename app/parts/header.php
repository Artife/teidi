<meta name="robots" content="noindex, nofollow">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<title><?php echo $pagina.$titulo; ?></title>
<link rel="icon" type="image/png" href="<?php echo $url_app; ?>img/favicon-redondo-idiet.png" />
<link href="<?php echo $url_app; ?>css/bootstrap.min.css" rel="stylesheet">
<link href="<?php echo $url_app; ?>font-awesome/css/font-awesome.css" rel="stylesheet">

<!-- Toastr style -->
<link href="<?php echo $url_app; ?>css/plugins/toastr/toastr.min.css" rel="stylesheet">

<!-- Gritter -->
<link href="<?php echo $url_app; ?>js/plugins/gritter/jquery.gritter.css" rel="stylesheet">



<link href="<?php echo $url_app; ?>css/animate.css" rel="stylesheet">
<link href="<?php echo $url_app; ?>css/style.css" rel="stylesheet">
<link href="<?php echo $url_app; ?>parts/theme.css" rel="stylesheet">

<link href="<?php echo $url_app; ?>css/plugins/iCheck/custom.css" rel="stylesheet">
<?php if(!empty($idiet_status_textos) || $idiet_status_textos != "0") { ?>
<style>
	<?php if(!empty($size_body) || $size_body != "0") { ?>
	body {
		font-size: <?php echo $size_body; ?>px;
	}
	.ibox-tools .dropdown-menu > li > a {
		font-size: <?php echo $size_body; ?>px;
	}
	.dropdown-menu > li > a {
		font-size: <?php echo $size_body; ?>px;
	}
	<?php } ?>
	<?php if(!empty($size_h1) || $size_h1 != "0") { ?>
	h1 {
		font-size: <?php echo $size_h1; ?>px;
	}
	h2 {
		font-size: <?php echo $size_h2; ?>px;
	}
	h3 {
		font-size: <?php echo $size_h3; ?>px;
	}
	<?php } ?>
	<?php if(!empty($color_body) || $color_body != "0") { ?>
	body, p {
		color: <?php echo $color_body; ?>;
	}
	<?php } ?>
	<?php if(!empty($color_hs) || $color_hs != "0") { ?>
	h1,h2,h3,h4,h5,h6 {
		color: <?php echo $color_hs; ?>;
	}
	<?php } ?>
</style>	
<?php } ?>


