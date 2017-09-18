<!DOCTYPE html>
<html lang="ja">
<head>
	<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
	<link rel="canonical" href="<?php
	echo 'http://';
	echo $_SERVER["SERVER_NAME"];
	echo $_SERVER["REQUEST_URI"];
	$url = $_SERVER["QUERY_STRING"];
		if ($url == null) {echo '';}; ?>" />
	<?php if ( is_home()): ?>
	<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<?php elseif (is_day()) : ?>
		<title><?php echo get_the_time('Y年n月j日'); ?><?php bloginfo('name'); ?></title>
	<?php else : ?>
		<title><?php wp_title( '|', true, 'right' ); ?><?php bloginfo('name'); ?></title>
	<?php endif ; ?>
	<?php if(is_tag()): ?>
	<meta name="robots" content="noindex,follow" />
	<?php endif; ?>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/stylesheet/html-reset.css" type="text/css" />
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); echo '?' . filemtime( get_stylesheet_directory() . '/style.css'); ?>" type="text/css" />
	<?php wp_deregister_script('jquery'); ?>
<script type="text/javascript" src="<?php bloginfo(template_url);?>/js/jQuery.js"></script>

	<?php wp_head(); ?>
</head>
<body>
<header>
	 <?php if ( is_home()): ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト</h1>
		<?php elseif (is_category() || is_page()) : ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト - <?php wp_title( '', true, 'right' ); ?> -</h1>
		<?php elseif (is_single()) : ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト - <?php $cat = get_the_category(); ?>
			<?php $cat = $cat[0]; ?>
			<?php echo get_cat_name($cat->term_id); ?> -</h1>
		<?php elseif (is_day()) : ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト - <?php echo get_the_time('Y/n/j'); ?> -</h1>
		<?php elseif (is_month()) : ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト - <?php echo get_the_time('Y/n'); ?> -</h1>
		<?php elseif (is_year()) : ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト - <?php echo get_the_time('Y'); ?> -</h1>
		<?php else : ?>
			<h1>晴れの国岡山 ジーンズの聖地児島産 / SHIFTO シフト / fait dans le pays ensoleillè</h1>
		<?php endif ; ?>
	<div class="haederbox">
		<nav class="font-abc">
			<?php wp_nav_menu(
				array(
				'theme_location' => 'head_navi',
				'container' => false ,
				'items_wrap' => '<ul class="headmenu">%3$s</ul>'
				)
				); ?>
		</nav>
		<?php if ( is_home()): ?>
			<h2 class="font-abc">SHIFTÖ / fait dans le pays ensoleillè</h2>
		<?php elseif (is_category() || is_page()) : ?>
			<h2 class="font-abc">- <?php wp_title( '', true, 'right' ); ?> -</h2>
		<?php elseif (is_single()) : ?>
			<h2 class="font-abc">- <?php $cat = get_the_category(); ?>
			<?php $cat = $cat[0]; ?>
			<?php echo get_cat_name($cat->term_id); ?> -</h2>
		<?php elseif (is_day()) : ?>
			<h2 class="font-abc">- <?php echo get_the_time('Y/n/j'); ?> -</h2>
		<?php elseif (is_month()) : ?>
			<h2 class="font-abc">- <?php echo get_the_time('Y/n'); ?> -</h2>
		<?php elseif (is_year()) : ?>
			<h2 class="font-abc">- <?php echo get_the_time('Y'); ?> -</h2>
		<?php else : ?>
			<h2 class="font-abc">SHIFTÖ / fait dans le pays ensoleillè</h2>
		<?php endif ; ?>
		<?php breadcrumb(); //パン屑リスト ?>
	</div>
</header>