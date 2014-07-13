<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo SITE_TITLE; ?></title>
<meta name="keywords" content="work center, theme, piecemaker 3D image slider, 960, free templates, CSS, HTML" />
<meta name="description" content="Work Center Theme is a free CSS template by templatemo.com for everyone. Feel free to use it for any purpose." />
<?php foreach($this->conf['css'] as $obj): ?>
<link rel='stylesheet' type='text/css' href='<?php echo $obj; ?>' title='style' />
<?php endforeach; ?>
<?php foreach($this->conf['js'] as $obj): ?>
<script src='<?php echo $obj; ?>'></script>
<?php endforeach; ?>    
<link href="<?php echo TEMPLATE_PATH; ?>css/templatemo_style.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo TEMPLATE_PATH; ?>js/swfobject/swfobject.js"></script>
        
<script type="text/javascript">
  var flashvars = {};
  flashvars.cssSource = "<?php echo TEMPLATE_PATH; ?>css/piecemaker.css";
  flashvars.xmlSource = "<?php echo TEMPLATE_PATH; ?>piecemaker.xml";
	
  var params = {};
  params.play = "true";
  params.menu = "false";
  params.scale = "showall";
  params.wmode = "transparent";
  params.allowfullscreen = "true";
  params.allowscriptaccess = "always";
  params.allownetworking = "all";
  
  swfobject.embedSWF('<?php echo TEMPLATE_PATH; ?>piecemaker.swf', 'piecemaker', '960', '440', '10', null, flashvars,    
  params, null);

</script>

<script language="javascript" type="text/javascript">
function clearText(field)
{
    if (field.defaultValue == field.value) field.value = '';
    else if (field.value == '') field.value = field.defaultValue;
}
</script>

<link rel="stylesheet" type="text/css" href="<?php echo TEMPLATE_PATH; ?>css/ddsmoothmenu.css" />

<script type="text/javascript" src="<?php echo TEMPLATE_PATH; ?>js/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo TEMPLATE_PATH; ?>js/ddsmoothmenu.js">

/***********************************************
* Smooth Navigational Menu- (c) Dynamic Drive DHTML code library (www.dynamicdrive.com)
* This notice MUST stay intact for legal use
* Visit Dynamic Drive at http://www.dynamicdrive.com/ for full source code
***********************************************/

</script>

<script type="text/javascript">

ddsmoothmenu.init({
	mainmenuid: "templatemo_menu", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

</script> 
</head>

<body>

<div id="templatemo_header_wrapper">
    <div id="templatemo_header">
        <div id="site_title"><a href="./"><?php echo SITE_TITLE; ?></a></div>
        <div id="templatemo_menu" class="ddsmoothmenu">
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
            <br style="clear: left" />
        </div> <!-- end of templatemo_menu -->
    </div> <!-- END of header -->
</div>

<div id="templatemo_middle_wrapper">
	<div id="templatemo_middle">
        <div id="piecemaker">
          <p>This template is provided by <a href="http://www.templatemo.com">www.templatemo.com</a> and feel free to use it for your websites.</p>
        </div>
	</div>
</div> <!-- END of slider -->

<div id="templatemo_main_top"></div>
<div id="templatemo_main">
	<?php $this->render($this->content);?>
    
    <div class="cleaner"></div>
</div> <!-- END of main -->

<div id="templatemo_footer_wrapper">
	<div id="templatemo_footer">
	
		<div class="col col_14">
        	<h5>相關連結</h5>
            <ul class="footer_list">
                <li><a href="#">網站#1</a></li>
                <li><a href="#">網站#2</a></li>
            	<li><a href="#">網站#3</a></li>
                <li><a href="#">網站#4</a></li>
                <li><a href="#">網站#5</a></li>
			</ul>   
        </div>
        <div class="col col_14">
        	<h5>選單</h5>
            <ul class="footer_list">
            	<?php $this->render($this->sidebar); ?>
			</ul>
        </div>
        <div class="col col_14">
        	<h5>關注我們</h5>	
            <ul class="footer_list">
                <li><a href="#" class="social facebook">Facebook</a></li>
                <li><a href="#" class="social twitter">Twitter</a></li>
                <li><a href="#" class="social feed">Feed</a></li>
			</ul>
            
        </div>
        
        <div class="col col_14 no_margin_right">

            <div class="cleaner h30"></div>
            Copyright © 2014 <a href="#"><?php echo CORP_NAME; ?></a> Designed by <a href="#" target="_parent">任家輝</a>
        </div>
        
    <div class="cleaner"></div>
    </div>
</div> <!-- END of footer -->

</body>
</html>