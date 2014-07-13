<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
if(!isset($_SESSION)){ session_start();}

require_once 'config.php';

define('APP_COPYRIGHT', 'Copyright BlueRen(任家輝)'); //增加版權
$include_path = array ();
$include_path[] = get_include_path();
$include_path[] = SITE_REAL_PATH . '/core';
$include_path[] = SITE_REAL_PATH . '/controllers';
$include_path[] = SITE_REAL_PATH . '/models';
$include_path[] = SITE_REAL_PATH . '/views';
set_include_path(join(PATH_SEPARATOR, $include_path));
function __autoload($class_name)
{
	require_once $class_name . '.php';
}

$m = isset($_GET['mod'])&&in_array($_GET['mod'],explode(",", MODULES))?$_GET['mod'].'Controller':'IndexController';
$controller = new $m;
$controller->setRouter(new Router);
$controller->run();

echo "<!-- 網站設計 © 2014 DivStudio(任家輝,paste.ren@gmail.com) -->";