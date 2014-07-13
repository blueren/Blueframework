<!DOCTYPE html>
<!--[if IE 6]>
<html id='ie6' dir='ltr' lang='zh-tw'>
<![endif]-->
<!--[if IE 7]>
<html id='ie7' dir='ltr' lang='zh-tw'>
<![endif]-->
<!--[if IE 8]>
<html id='ie8' dir='ltr' lang='zh-tw'>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html dir='ltr' lang='zh-tw'>
    <!--<![endif]-->
    <head profile='http://purl.org/uF/hAtom/0.1/'>
        <meta HTTP-EQUIV='content-type' CONTENT='text/html; charset=UTF-8'>

        <meta name='viewport' content='width=device-width' />
        <title><?php echo SITE_TITLE; ?></title>
        <meta Name='keywords' Content='毛巾, 毛巾家族, 毛巾工廠, 台灣製造'>
        <meta Name='description' content= '毛巾家族, 毛巾工廠, 台灣製造毛巾, 童巾, 兒童圍兜, 台灣製造毛巾(浴巾)工廠, 台灣生產毛巾, 毛巾浴巾製造批發, 理容用巾, 工廠清潔用巾, 毛巾禮盒(可依客戶需求任意組合), 促銷贈品(提供客戶免費設計、印字), 禮儀毛巾(婚喪喜慶用巾), 單、雙人毛巾被, 機關團體節慶用巾(提供客戶免費設計、印字), 旅館, 溫泉用巾(提供客戶免費設計、印字), 嬰兒棉織用品(提供客戶設計開發)歡迎各界參觀訂購'>
        <meta Name='Rating' Content='General'>
        <meta Name='Robots' Content='All'>
        <meta NAME='Distribution' CONTENT='Global'>
        <meta NAME='Revisit-After' CONTENT='1 Days'>
        <meta NAME='Author' CONTENT='blueren http://div.tw'>
        <meta NAME='Copyright' CONTENT='本網頁著作權屬DIV STUDIO所有'>
        <meta HTTP-EQUIV='imagetoolbar' CONTENT='no'>
        <link rel='author' href='https://plus.google.com/104760630224064938817?rel=author' />
        <link rel='publisher' href='https://plus.google.com/108783971619578436323' />
        <link rel='stylesheet' type='text/css' media='all' href='<?php echo TEMPLATE_PATH; ?>style.css' />

        
        <!-- End Combine and Compress These CSS Files -->
                
        <link rel='stylesheet' type='text/css' media='screen and (max-width: 960px)' href='<?php echo TEMPLATE_PATH; ?>css/lessthen800.css' />
        <link rel='stylesheet' type='text/css' media='screen and (max-width: 600px)' href='<?php echo TEMPLATE_PATH; ?>css/lessthen600.css' />
        <link rel='stylesheet' type='text/css' media='screen and (max-width: 480px)' href='<?php echo TEMPLATE_PATH; ?>css/lessthen480.css' />
                    
        <!-- CUSTOM STYLE -->                                                                        
        <link rel='stylesheet' type='text/css' media='all' href='<?php echo TEMPLATE_PATH; ?>css/custom-style.css' />
      
        <!-- [favicon] begin -->
        <link rel='shortcut icon' type='image/x-icon' href='favicon.ico' />
        <link rel='icon' type='image/x-icon' href='favicon.ico' />
        <!-- [favicon] end -->  
        
        <!-- MAIN FONT STYLE -->  
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz%3A400&amp;subset=latin%2Ccyrillic%2Cgreek' type='text/css' media='all' />      
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Droid+Sans' type='text/css' media='all' />      
	    <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Oswald' type='text/css' media='all' />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Yanone+Kaffeesatz%3A200%2C400' type='text/css' media='all' />
        <link rel='stylesheet' href='http://fonts.googleapis.com/css?family=Open+Sans+Condensed%3A300%7CPlayfair+Display%3A400italic' type='text/css' media='all' />
        <!-- END MAIN FONT STYLE -->  


    <?php foreach($this->conf['css'] as $obj): ?>
    <link rel='stylesheet' type='text/css' href='<?php echo $obj; ?>' title='style' />
    <?php endforeach; ?>
    
    <?php foreach($this->conf['js'] as $obj): ?>
    <script src='<?php echo $obj; ?>'></script>
    <?php endforeach; ?>   
      
        
        <!-- RESPONSIVE -->  
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/globals.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/typography.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/grid.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/ui.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/forms.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/orbit.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/reveal.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/mobile.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>stylesheets/app.css">
        <link rel="stylesheet" href="<?php echo TEMPLATE_PATH; ?>responsive-tables.css">
        <script src="<?php echo TEMPLATE_PATH; ?>responsive-tables.js"></script>  
        <!-- RESPONSIVE -->      
        
        <link rel='stylesheet' id='prettyPhoto-css' href='<?php echo TEMPLATE_PATH; ?>css/prettyPhoto.css' type='text/css' media='all' />
        <link rel='stylesheet' id='jquery-tipsy-css' href='<?php echo TEMPLATE_PATH; ?>css/tipsy.css' type='text/css' media='all' />        
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.easing.1.3.js'></script>
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.prettyPhoto.js'></script>
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.tipsy.js'></script>
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.tweetable.js'></script>        
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.nivo.slider.pack.js'></script>  
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.flexslider.min.js'></script>
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.cycle.min.js'></script>  

        <!-- SLIDER ELASTIC -->                                                               
        <link rel='stylesheet' id='slider-elastic-css' href='<?php echo TEMPLATE_PATH; ?>css/slider-elastic.css' type='text/css' media='all' />
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.eislideshow.js'></script>

        <!-- CUSTOM JAVASCRIPT -->                           
        <script type='text/javascript' src='<?php echo TEMPLATE_PATH; ?>js/jquery.custom.js'></script>
		<style type='text/css'> 
			table {
				margin-left:auto;
				margin-right:auto;
			}
		</style>
         
        <script type='application/ld+json'>
        {
          '@context' : 'http://schema.org',
          '@type' : 'LocalBusiness',
          'name' : '<?php echo CORP_NAME; ?>',
          'image' : 'http://www.kones.com.tw/templates/kones/images/logo.png',
          'telephone' : '<?php echo CORP_TEL; ?>',
          'address' : {
            '@type' : 'PostalAddress',
            'streetAddress' : '<?php echo CORP_ADDR; ?>',
            'postalCode' : '632'
          },
          'openingHoursSpecification' : {
            '@type' : 'OpeningHoursSpecification',
            'opens' : '<?php echo CORP_OPENTIME; ?>',
            'closes' : '<?php echo CORP_CLOSETIME; ?>'
          },
          'url' : '<?php echo SITE_URL; ?>'
        }
        </script> 

        <!-- Google Analytics -->
        <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-50073380-1', 'kones.com.tw');
        ga('require', 'displayfeatures');
        ga('send', 'pageview');
        
        </script>
        <!-- End Google Analytics -->        
      
            
    </head>
    
    <body class='home image-sphere-style responsive'>

        <!-- START SHADOW WRAPPER -->
        <div itemscope itemtype='http://schema.org/LocalBusiness' class='shadowBg group'>
            
            <!-- START WRAPPER -->
            <div class='wrapper group'>
                
                <!-- START TOPBAR -->
                <div id='topbar'>
                    <div class='inner'>
                        <ul class='topbar_links'>
                            <li>
                                <a href='index.php?mod=user&act=login'>會員管理</a>  
                            </li>
                            <li> | <a href='index.php?mod=page&act=show&id=10'>聯絡我們</a></li>
                        </ul>
                        <div class='clear'></div>
                    </div>
                    <!-- end.inner -->
                </div>
                <!-- END TOPBAR -->   
                 
                <!-- START HEADER -->
                <div id='header' class='group'>
                
                    <!-- START LOGO -->
                    <div id='logo' class='group'>
                        <a href='./index.php' title='Kones'> 
                        <img itemprop='image' src='<?php echo TEMPLATE_PATH; ?>images/logo.png' alt='喜帥毛巾棉織廠有限公司' />
                        </a>              
                    </div>
                    <!-- END LOGO -->   
                    
                    <!-- START NAV -->
                    <div id='nav' class='group'>
                        <ul class='level-1 white'>
                            <li class='home'>
								<a href='./index.php'>首頁</a>
							</li>
                            <?php $this->render('user2.tpl.php'); ?>
                            <?php foreach($this->menu as $i => $v): ?>
                            <li class='folder'>
                            <?php if(!empty($v->url)): ?>
                            <a href='<?php echo $v->url; ?>'  class='buttons' >
                            <?php else: ?>
                            <a href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>'>
                            <?php endif; ?>
                            <?php echo $v->name; ?></a>                            
                            
                                <?php if(!empty($v->sub)): ?>
                                <ul class='sub-menu'>
                                <?php foreach($v->sub as $j => $k): ?>
                                <li>
                                    <?php if(!empty($k->url)): ?>
                                    <a href='<?php echo $k->url; ?>'  class='buttons' >
                                    <?php else: ?>
                                    <a href='index.php?mod=page&act=show&id=<?php echo $k->id; ?>'>
                                    <?php endif; ?>
                                    <?php echo $k->name; ?></a>                                   
                                    <?php if(!empty($k->sub)): ?>
                                        <ul class='sub-menu'>
                                        <?php foreach($k->sub as $n => $m): ?>
                                             <li><a href='index.php?mod=page&act=show&id=<?php echo $m->id; ?>'><?php echo $m->name; ?></a></li>
                                        <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                                <?php endforeach; ?>
                                </ul>
                                <?php endif; ?>
                            </li>    
                            <?php endforeach; ?>							
                        </ul>
                    </div>
                    <!-- END NAV -->   
                </div>
                <!-- END HEADER -->        
        
                <!-- BEGIN #slider -->                  
                <div id='slider' class='ei-slider elastic'>
                    <ul class='ei-slider-large'>
                        
                        <li class='first slide-1 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a>
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>                            
                        </li>
                        
                        <li class='slide-2 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images3.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a>
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>                            
                        </li>
                        
                        <li class='slide-3 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a>
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>                            
                        </li>
                        
                        <li class='slide-4 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images3.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a>
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>                            
                        </li>
                        
                        <li class='slide-5 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a>
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>                            
                        </li>
                        
                        <li class='slide-6 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images3.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a> 
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>                            
                        </li>
                        
                        <li class='last slide-7 slide align- image-content-type'>
                            <a href='index.php?mod=cart&act=productList'><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='喜帥毛巾工廠上方跑馬燈' /></a> 
                            <div class='ei-title'>
                                <h2>毛巾家族</h2>
                                <h3>Towel's Family</h3>
                            </div>
                        </li>

                    </ul>
                    <!-- ei-slider-large -->
                    <ul class='ei-slider-thumbs'>
                        <li class='ei-slider-element'>Current</li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='毛巾家族' /></li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images3.jpg' alt='毛巾家族' /></li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='毛巾家族' /></li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images3.jpg' alt='毛巾家族' /></li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='毛巾家族' /></li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images3.jpg' alt='毛巾家族' /></li>
                        <li><a href='#'>毛巾家族</a><img src='<?php echo TEMPLATE_PATH; ?>images2.jpg' alt='毛巾家族' /></li>
                    </ul>
                    <!-- ei-slider-thumbs -->    
                    <div class='shadow'></div>
                </div>                             
                
                <!-- JS SCRIPT --> 
                <script type='text/javascript'>  
                    // edit here
                    var 	slider_elastic_speed = 1000,
                            slider_elastic_timeout = 5000,
                            slider_elastic_autoplay = true,
                            slider_elastic_animation = 'sides'; 
                    // end editing    
                            
            		$('#slider.elastic').eislideshow({
        				easing		: 'easeOutExpo',
        				titleeasing	: 'easeOutExpo',
        				titlespeed	: 1200,
        				autoplay	: slider_elastic_autoplay,
        				slideshow_interval : slider_elastic_timeout,
        				speed       : slider_elastic_speed,
        				animation   : slider_elastic_animation
                    });
                </script>
                <!-- END #slider -->    
                
                <!-- HOME SECTIONS -->   
                <div class='home-sections'>
                
                    <!-- SECTION #1 -->
                    <div class='section gradient s-0 group'>
                        <div class='section-content entry-content'>
                            
							<?php $this->render($this->content);?>
						</div>
                        <div class='shadow'></div>
                    </div>               
                    <!-- END SECTION #1 -->
                    
                </div>   
                <!-- END HOME SECTIONS -->   
               
                <div id='content' class='gradient layout-sidebar-no group for-not-mobile'> 
                    <!-- START CONTENT -->
                    <div id='primary' class='hentry group wrapper-content' role='main'>
                        <div class='two-fourth'>
                            <h4 class='entry-title'>喜帥的代誌 | <span>Article</span></h4>
                     
                            <!-- START LAST NEWS -->
                            
                            <div class='last-news group'>
                                <div class='box-post group thumbnail'>
                                    <div class='box-post-thumb sphere'>
                                        <img width='86' height='86' src='<?php echo TEMPLATE_PATH; ?>images/various/glasses-86x86.jpg' alt='news1' title='news1' />
                                    </div>
                                    <div class='box-post-body group'>
                                        <div class='news_title'>
                                            <a class='title' href='index.php?mod=news&act=show&id=<?php echo $this->news[0]->id; ?>' title='新聞標題'><?php echo $this->news[0]->title; ?></a>
                                        </div>
                                        <div class='news_exccartt entry-content'>
                                            <a class='title' href='index.php?mod=news&act=show&id=<?php echo $this->news[0]->id; ?>' title='新聞標題'><p>更多[...]</p></a>
                                        </div>
                                        <p class='meta'>
                                            <span class='date'><abbr class='published updated' title='<?php echo $this->news[0]->upd_dte; ?>'><?php echo $this->news[0]->upd_dte; ?></abbr></span>                
                                            <span class='vcard author'><span class='fn'>by <?php echo $this->news[0]->author; ?></span></span>            
                                        </p>
                                    </div>
                                </div>
                                <div class='box-post group thumbnail'>
                                    <div class='box-post-thumb sphere'>
                                        <img width='86' height='86' src='<?php echo TEMPLATE_PATH; ?>images/various/sushi1-86x86.jpg'' alt='news2' title='news2' />
                                    </div>
                                    <div class='box-post-body group'>
                                        <div class='news_title'>
                                            <a class='title' href='index.php?mod=news&act=show&id=<?php echo $this->news[1]->id; ?>' title='新聞標題'><?php echo $this->news[1]->title; ?></a>
                                        </div>
                                        <div class='news_exccartt entry-content'>
                                            <a class='title' href='index.php?mod=news&act=show&id=<?php echo $this->news[0]->id; ?>' title='新聞標題'><p>更多[...]</p></a>
                                        </div>
                                        <p class='meta'>
                                            <span class='date'><abbr class='published updated' title='<?php echo $this->news[1]->upd_dte; ?>'><?php echo $this->news[1]->upd_dte; ?></abbr></span>                
                                            <span class='vcard author'><span class='fn'>by <?php echo $this->news[1]->author; ?></span></span>          
                                        </p>
                                    </div>
                                </div>
                            </div>   
                            <!-- END LAST NEWS -->
                            
                        </div>              
                        
                        <div class='two-fourth last'>
                            <h4>熱銷商品 | <span>Product</span></h4>
                            
                            <?php foreach($this->hot as $v): ?>
                                <a href='index.php?mod=cart&act=product&id=<?php echo $v->id; ?>'><img src='<?php echo $v->img1; ?>' alt='<?php echo $v->title; ?>' title='<?php echo $v->title; ?>'/></a>
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <!-- END CONTENT -->
		
                </div> 
     

                <!-- START TWITTER -->

                <!-- END TWITTER -->   
                           
                <!-- START COPYRIGHT -->
                <div id='copyright' class='group two-columns entry-title'>
                    <div class='inner group'>
                    <p>公司資訊 <a href='mailto:kones@kones.com.tw'><strong>
                    <span itemprop='openingHoursSpecification' itemscope itemtype='http://schema.org/OpeningHoursSpecification'>
                    <meta itemprop='opens' content='08:00:00'>
                    <meta itemprop='closes' content='21:00:00'></span>
                    <span itemprop='address' itemscope itemtype='http://schema.org/PostalAddress'>
                    <span itemprop='postalCode'>632</span>
                    <span itemprop='streetAddress'><?php echo CORP_ADDR; ?></span> </span>| 營業時間：<?php echo CORP_OPENTIME; ?> ~ <?php echo CORP_CLOSETIME; ?> | 聯絡電話：
                    <span itemprop='telephone'><?php echo CORP_TEL; ?></span></strong></a><br/>
                    Powered by <a href='./'><strong itemprop='name'><?php echo CORP_NAME; ?></strong></a> | System Designed by 
                    <strong>
                        <span class='author'>
                        <a href='http://plus.google.com/104760630224064938817?rel=author' rel='author'>Blue Ren (任家輝)</a>
                        </span>  
                    </strong></p>    
                  
                    </div>
                
                </div>
                <!-- END COPYRIGHT -->  
                   
            </div>
            <!-- END WRAPPER --> 
        <meta itemprop='url' content='http://www.kones.com.tw'>    	    
        </div>
        <!-- END SHADOW -->       
        
    </body>
</html>