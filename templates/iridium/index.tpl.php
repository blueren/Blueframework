<!DOCTYPE HTML>
<!--
	Iridium by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title>Iridium by TEMPLATED</title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />

		<link href='http://fonts.googleapis.com/css?family=Arimo:400,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="js/html5shiv.js"></script><![endif]-->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo TEMPLATE_PATH; ?>js/skel.min.js"></script>
		<script src="<?php echo TEMPLATE_PATH; ?>js/skel-panels.min.js"></script>
		<script src="<?php echo TEMPLATE_PATH; ?>js/init.js"></script>
		<?php foreach($this->conf['css'] as $obj): ?>
		<link rel='stylesheet' type='text/css' href='<?php echo $obj; ?>' title='style' />
		<?php endforeach; ?>
		<?php foreach($this->conf['js'] as $obj): ?>
		<script src='<?php echo $obj; ?>'></script>
		<?php endforeach; ?>		
			<link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/skel-noscript.css" />
			<link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/style.css" />
			<link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/style-desktop.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="css/ie/v9.css" /><![endif]-->
	</head>
	<body class="homepage">

		<!-- Header -->
		<div id="header">
			<div class="container"> 
				
				<!-- Logo -->
				<div id="logo">
					<h1><a href="#"><?php echo SITE_TITLE; ?></a></h1>
					<span><?php echo TEL; ?></span>
				</div>
				
				<!-- Nav -->
				<nav id="nav">
                        <ul class='level-1 white'>
                            <li class='active'>
								<a href='./index.php'>首頁</a>
							</li>
                            <?php foreach($this->menu as $i => $v): ?>
                            <li>
                            <?php if(!empty($v->url)): ?>
                            <a href='<?php echo $v->url; ?>'  class='buttons' >
                            <?php else: ?>
                            <a href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>'>
                            <?php endif; ?>
                            <?php echo $v->name; ?></a>                            
                            </li>    
                            <?php endforeach; ?>							
                        </ul>
				</nav>
			</div>
		</div>

		<!-- Main -->
		<div id="main">
			<div class="container">
				<div class="row"> 
					
					<!-- Content -->
					<div id="content" class="8u skel-cell-important">
						<section>
							<header>
								<h2><?php echo TITLE; ?></h2>
								<span class="byline">Integer sit amet pede vel arcu aliquet pretium</span>
							</header>
							<?php $this->render($this->content);?>
						</section>
					</div>
					
					<!-- Sidebar -->
					<div id="sidebar" class="4u">
						<section>
							<header>
								<h2>Pellentesque vulputate</h2>
							</header>
						<?php $this->render('user2.tpl.php'); ?>
						</section>
					</div>
				</div>
			</div>
		</div>

		<!-- Footer -->
		<div id="featured">
			<div class="container">
				<div class="row">
					<div class="4u">
						<h2>Aenean elementum facilisis</h2>
						<a href="#" class="image full"><img src="<?php echo TEMPLATE_PATH; ?>images/pic01.jpg" alt="" /></a>
						<p>Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Quisque dictum. Pellentesque viverra vulputate enim.</p>
						<p><a href="#" class="button">More Details</a></p>
					</div>
					<div class="4u">
						<h2>Fusce ultrices fringilla</h2>
						<a href="#" class="image full"><img src="<?php echo TEMPLATE_PATH; ?>images/pic02.jpg" alt="" /></a>
						<p>Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Quisque dictum. Pellentesque viverra vulputate enim.</p>
						<p><a href="#" class="button">More Details</a></p>
					</div>
					<div class="4u">
						<h2>Etiam rhoncus volutpat erat</h2>
						<a href="#" class="image full"><img src="<?php echo TEMPLATE_PATH; ?>images/pic03.jpg" alt="" /></a>
						<p>Nullam non wisi a sem semper eleifend. Donec mattis libero eget urna. Donec leo, vivamus fermentum nibh in augue praesent a lacus at urna congue rutrum. Quisque dictum. Pellentesque viverra vulputate enim.</p>
						<p><a href="#" class="button">More Details</a></p>
					</div>
				</div>
			</div>
		</div>


		<!-- Footer -->
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="4u">
						<section>
							<h2>Latest Posts</h2>
							<ul class="default">
								<li><a href="#">Pellentesque lectus gravida blandit</a></li>
								<li><a href="#">Lorem ipsum consectetuer adipiscing</a></li>
								<li><a href="#">Phasellus nibh pellentesque congue</a></li>
								<li><a href="#">Cras vitae metus aliquam pharetra</a></li>
								<li><a href="#">Maecenas vitae orci feugiat eleifend</a></li>
							</ul>
						</section>
					</div>
					<div class="4u">
						<section>
							<h2>Ultrices fringilla</h2>
							<ul class="default">
								<li><a href="#">Pellentesque lectus gravida blandit</a></li>
								<li><a href="#">Lorem ipsum consectetuer adipiscing</a></li>
								<li><a href="#">Phasellus nibh pellentesque congue</a></li>
								<li><a href="#">Cras vitae metus aliquam pharetra</a></li>
								<li><a href="#">Maecenas vitae orci feugiat eleifend</a></li>
							</ul>
						</section>
					</div>
					<div class="4u">
						<section>
							<h2>Aenean elementum</h2>
							<ul class="default">
								<li><a href="#">Pellentesque lectus gravida blandit</a></li>
								<li><a href="#">Lorem ipsum consectetuer adipiscing</a></li>
								<li><a href="#">Phasellus nibh pellentesque congue</a></li>
								<li><a href="#">Cras vitae metus aliquam pharetra</a></li>
								<li><a href="#">Maecenas vitae orci feugiat eleifend</a></li>
							</ul>
						</section>
					</div>
				</div>
			</div>
		</div>

		<!-- Copyright -->
		<div id="copyright">
			<div class="container">
				Design: <a href="http://templated.co">TEMPLATED</a> Images: <a href="http://unsplash.com">Unsplash</a> (<a href="http://unsplash.com/cc0">CC0</a>)
			</div>
		</div>
		
	</body>
</html>