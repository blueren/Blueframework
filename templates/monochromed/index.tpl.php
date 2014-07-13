<!DOCTYPE HTML>
<!--
	Monochromed by TEMPLATED
    templated.co @templatedco
    Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->
<html>
	<head>
		<title><?php echo SITE_TITLE; ?></title>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
        <?php foreach($this->conf['css'] as $obj): ?>
        <link rel='stylesheet' type='text/css' href='<?php echo $obj; ?>' title='style' />
        <?php endforeach; ?>
        <?php foreach($this->conf['js'] as $obj): ?>
        <script src='<?php echo $obj; ?>'></script>
        <?php endforeach; ?>        
		<link href='http://fonts.googleapis.com/css?family=Oxygen:400,300,700' rel='stylesheet' type='text/css'>
		<!--[if lte IE 8]><script src="<?php echo TEMPLATE_PATH; ?>js/html5shiv.js"></script><![endif]-->
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
		<script src="<?php echo TEMPLATE_PATH; ?>js/skel.min.js"></script>
		<script src="<?php echo TEMPLATE_PATH; ?>js/skel-panels.min.js"></script>
		<script src="<?php echo TEMPLATE_PATH; ?>js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/skel-noscript.css" />
			<link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/style.css" />
		</noscript>
        
		<!--[if lte IE 8]><link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/ie/v8.css" /><![endif]-->
		<!--[if lte IE 9]><link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>css/ie/v9.css" /><![endif]-->
	</head>
	<body>

	<!-- Header -->
		<div id="header">
			<div class="container">
					
				<!-- Logo -->
					<div id="logo">
						<h1><a href="#"><?php echo SITE_TITLE; ?></a></h1>
						<span><?php echo SITE_SLOGAN; ?></span>
					</div>
				
				<!-- Nav -->
					<nav id="nav">
                        <ul>
                            <li class='active'><a href='./'>首頁</a></li>
                            <?php foreach($this->menu as $i => $v): ?>
                            
                            <?php if(empty($v->sub)): ?><li>
                            <?php if(!empty($v->url)): ?><a href='<?php echo $v->url; ?>'  class='buttons' >
                            <?php else: ?><a href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>' data-pjax='content' class='pjaxer'>
                            <?php endif; ?><?php echo $v->name; ?>
                            
                            </a>
                            </li>
                            <?php else: ?><li class='dropdown'>
                            <?php if(!empty($v->url)): ?><a class='dropdown-toggle' data-toggle='dropdown' href='<?php echo $v->url; ?>'>
                            <?php else: ?><a class='dropdown-toggle' data-toggle='dropdown' href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>'>
                            <?php endif; ?><?php echo $v->name; ?> 
                            <b class='caret'></b>
                            </a>
                                <ul class='dropdown-menu'>
                                    <?php foreach($v->sub as $j => $k): ?><li>
                                    <?php if(!empty($k->url)): ?><a href='<?php echo $k->url; ?>'  class='buttons' >
                                    <?php else: ?><a href='index.php?mod=page&act=show&id=<?php echo $k->id; ?>'>
                                    <?php endif; ?><?php echo $k->name; ?></a>                
                                    <?php if(!empty($k->sub)): ?>
                                        <ul class='sub-menu'>
                                        <?php foreach($k->sub as $n => $m): ?><li><a href='index.php?mod=page&act=show&id=<?php echo $m->id; ?>'><?php echo $m->name; ?></a></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?></li>
                                    <?php endforeach; ?>    
                                </ul>                
                            </li>                
                            <?php endif; ?>
                            <?php endforeach; ?>                
                        </ul>
					</nav>

			</div>
		</div>
	<!-- Header -->
			
	<!-- Main -->
		<div id="main">
			<div class="container">
                <section>
                    <?php $this->render($this->content);?>
                </section>
                <!-- /Content -->
			</div>
		</div>
	<!-- Main -->

	<!-- Footer -->
		<div id="footer">
			<div class="container">
				<div class="row">
					<div class="3u">
						<section>

						</section>
					</div>
					<div class="3u">
						<section>

						</section>				
					</div>
					<div class="6u">
						<section>

						</section>
					</div>
				</div>
			</div>
		</div>
	<!-- Footer -->

	<!-- Copyright -->
		<div id="copyright">
			<div class="container">
            <small>
                <p>公司資訊 <a href='mailto:kones@kones.com.tw'>
                <span itemprop='openingHoursSpecification' itemscope itemtype='http://schema.org/OpeningHoursSpecification'>
                <meta itemprop='opens' content='<?php echo CORP_OPENTIME; ?>'>
                <meta itemprop='closes' content='<?php echo CORP_CLOSETIME; ?>'></span>
                <span itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'>
                <span itemprop='streetAddress'><?php echo CORP_ADDR; ?></span> </span>| 營業時間：<?php echo CORP_OPENTIME; ?> ~ <?php echo CORP_CLOSETIME; ?> | 聯絡電話：
                <span itemprop='telephone'><?php echo CORP_TEL; ?></span> | 傳真電話：05-6221782</a><br/>
                Powered by <a href='./'><?php echo CORP_NAME; ?></a> | System Designed by 
                <strong>
                    <span class='author'>
                    <a href='http://plus.google.com/104760630224064938817?rel=author' rel='author'>Blue Ren (任家輝)</a>
                    </span>  
                </strong></p>    
            </small> 
			</div>
		</div>

	</body>
</html>