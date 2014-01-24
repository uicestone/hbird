<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<title><?php bloginfo('sitename'); ?></title>
	<?php wp_head(); ?>
</head>

<body>
	<div id="home">
		<div class="home-bg"></div>
		<div class="title">
			<div class="intro-line"></div>
			<h1>Hello</h1>
			<h1 class="small">Welcome to HBird</h1>
			<div class="intro-line"></div>
			<p>
				<?php bloginfo('description'); ?>
			</p>
		</div>
	</div>

	<div class="nav-container">
		<div class="navbar">
			<div class="navbar-inner">
				<?php wp_nav_menu(array('menu'=>'主导航','menu_class'=>'nav','container'=>false,'link_after'=>'<li class="divider-vertical"></li>')); ?>
			</div>
		</div>
	</div>

