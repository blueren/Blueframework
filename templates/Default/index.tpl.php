<html>
<head>
    <title><?php echo SITE_TITLE; ?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1.0'>
    <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
    <meta Name='Rating' Content='General'>
    <meta Name='Robots' Content='All'>
    <meta NAME='Distribution' CONTENT='Global'>
    <meta NAME='Revisit-After' CONTENT='1 Days'>
    <meta NAME='Author' CONTENT='blueren http://div.tw'>
    <meta NAME='Copyright' CONTENT='本網頁著作權屬DIV STUDIO所有'>
    <meta HTTP-EQUIV='imagetoolbar' CONTENT='no'>
    <link rel='author' href='https://plus.google.com/104760630224064938817?rel=author' />
    <link rel='publisher' href='https://plus.google.com/108783971619578436323' />    
    <!-- HTML5 shim 和 Respond.js 讓IE8支援HTML5元素和媒體查詢 -->
    <!--[if lt IE 9]>
      <script src='<?php echo TEMPLATE_PATH; ?>js/html5shiv.js'></script>
      <script src='<?php echo TEMPLATE_PATH; ?>js/jquery-1.11.1.min.js'></script>
      <script src='<?php echo TEMPLATE_PATH; ?>js/respond.min.js'></script>
    <![endif]-->      
    <?php foreach($this->conf['css'] as $obj): ?>
    <link rel='stylesheet' type='text/css' href='<?php echo $obj; ?>' title='style' />
    <?php endforeach; ?>
    <?php foreach($this->conf['js'] as $obj): ?>
    <script src='<?php echo $obj; ?>'></script>
    <?php endforeach; ?>
   
    <!-- Bootstrap -->
    <!-- Bootstrap core CSS -->
    <link href='<?php echo TEMPLATE_PATH; ?>css/bootstrap.min.css' rel='stylesheet'>
    <!-- Bootstrap theme -->
    <link href='<?php echo TEMPLATE_PATH; ?>css/bootstrap-theme.css' rel='stylesheet'>
    <link href='<?php echo TEMPLATE_PATH; ?>css/style.css' rel='stylesheet' media='screen'>
    <link href='<?php echo TEMPLATE_PATH; ?>css/animate.css' rel='stylesheet' media='screen'>
    <!-- jQuery (使用Bootstrap的JavaScript外掛) -->
    <!-- 在下面加入所有已編譯外掛，或是當需要時加入獨立檔案 -->
    <script src='<?php echo TEMPLATE_PATH; ?>js/bootstrap.min.js'></script>
    <link href='<?php echo TEMPLATE_PATH; ?>css/screen.css' rel='stylesheet' type='text/css' /> 
	<script type="text/javascript" src='<?php echo TEMPLATE_PATH; ?>js/pjax-standalone.js'></script> 
	<script type='text/javascript'>
		// Ensure console is defined
		if(typeof console === 'undefined') console = {"log":function(m){}};

		// PJAX links!
		// pjax.connect({
			// 'container': 'content',
			// 'success': function(event){
				// var url = (typeof event.data !== 'undefined') ? event.data.url : '';
				// console.log("Successfully loaded "+ url);
			// },
			// 'error': function(event){
				// var url = (typeof event.data !== 'undefined') ? event.data.url : '';
				// console.log("Could not load "+ url);
			// },
			// 'ready': function(){
				// console.log("PJAX loaded!");
			// }
		// });
		pjax.connect('content', 'pjaxer');
		// pjax.connect('content');
		// pjax.connect();

	</script>

</head>
<body>	   
    <header class='navbar navbar-default navbar-fixed-top animated slideInLeft' role='navigation'> 
        <div class='container'>
            <div class='navbar-header'>
                <button type='button' class='navbar-toggle' data-toggle='collapse' data-target='.navbar-collapse'>
                    <span class='sr-only'>Toggle navigation</span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                    <span class='icon-bar'></span>
                </button>
                <a class='navbar-brand' href='./'><?php echo SITE_TITLE; ?></a>
                <div class="pull-right">
                    <div class="btn-group">
                        <button type="button" class="navbar-toggle" data-toggle='collapse' data-target='.aside'>
                            <span class='sr-only'>Toggle navigation</span>
                            <i class="glyphicon glyphicon-user"></i>User<span class="caret"></span>
                        </button>
                    </div>                     
                </div>                     
            </div>
            <div class='navbar-collapse collapse'>
		
                <ul class='nav navbar-nav'>
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
            </div><!--/.nav-collapse -->
    
        </div>
    </header>    
    <div class='container theme-showcase animated fadeInDown' role='main'>  
        <aside class='wrap aside aside-collapse collapse'>
            <div class='list-group'>
            <?php $this->render($this->sidebar); ?>
            </div>
        </aside>
        <article class='wrap article'>                     
            <section id='content'>		
            <?php $this->render($this->content);?>
            </section>    
        </article>
    <div style='clear:both'></div>
    </div>
    <div class='container theme-showcase animated slideInRight' role='main'>  
        <footer>
            <small>
                <p>公司資訊 <a href='mailto:kones@kones.com.tw'><strong>
                <span itemprop='openingHoursSpecification' itemscope itemtype='http://schema.org/OpeningHoursSpecification'>
                <meta itemprop='opens' content='<?php echo CORP_OPENTIME; ?>'>
                <meta itemprop='closes' content='<?php echo CORP_CLOSETIME; ?>'></span>
                <span itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'>
                <span itemprop='streetAddress'><?php echo CORP_ADDR; ?></span> </span>| 營業時間：<?php echo CORP_OPENTIME; ?> ~ <?php echo CORP_CLOSETIME; ?> | 聯絡電話：
                <span itemprop='telephone'><?php echo CORP_TEL; ?></span> | 傳真電話：05-6221782</strong></a><br/>
                Powered by <a href='./'><strong itemprop='name'><?php echo CORP_NAME; ?></strong></a> | System Designed by 
                <strong>
                    <span class='author'>
                    <a href='http://plus.google.com/104760630224064938817?rel=author' rel='author'>Blue Ren (任家輝)</a>
                    </span>  
                </strong></p>    
            </small>    
        </footer>
    </div>        
</body>
</html>