<?php

$CI =& get_instance();

$strPageTitle = '';
$strMetaKeywords = implode( ',', $CI -> config -> item('SITE_KEYWORDS') );
$strMetaDescription = '';
$aryMetaOg = array();


// テキスト設定
$strPageTitle = ( isset( $p_aryDataHeader['title'] ) && $p_aryDataHeader['title'] !== '' ? $p_aryDataHeader['title'] : $CI -> config -> item('SITE_TITLE') );
if ( isset( $p_aryDataHeader['keywords'] ) && $p_aryDataHeader['keywords'] !== '' ) {
	$strMetaKeywords .= explode(',', $p_aryDataHeader['keywords']) . ',';
}
if ( isset( $p_aryDataHeader['description'] ) && $p_aryDataHeader['description'] !== '' ) {
	$strMetaDescription .= explode(',', $p_aryDataHeader['description']) . '｜';
}
$strMetaDescription .= $CI->config->item('SITE_DESCRIPTION');

?>
<?= doctype(); ?>
<html>
<head>
	<meta charset="<?= $CI -> config -> item('charset'); ?>">
	<?= meta('viewport', 'width=device-width,initial-scale=1.0'); ?>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?= $strPageTitle; ?></title>
	<?= meta('keywords', $strMetaKeywords); ?>
	<?= meta('description', $strMetaDescription); ?>
	<?= meta('format-detection', 'telephone=no'); ?>

	<link rel="stylesheet" href="<?= SITE_DIR . COMMON_DIR_CSS; ?>fillter.css">
<?= css($loadCss); ?>
	<link rel="stylesheet" href="<?= SITE_DIR . COMMON_DIR_CSS; ?>smartphone.css" media="screen and (max-width: 480px)">

	<!--[if lt IE 9]>
	<script src="//cdn.jsdelivr.net/html5shiv/3.7.2/html5shiv.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>

<body>
	<div id="wrapper">
