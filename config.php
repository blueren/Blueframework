<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
define('SITE_PATH', str_replace('\\', '/', dirname(__FILE__)));
define('SITE_REAL_PATH', str_replace('\\', '/', dirname(__FILE__)));
define('SITE_URL', ''); //設定網址
define('SITE_TITLE', ''); //設定網站名稱
define('SITE_SLOGAN', ''); //設定標語
define('CORP_OPENTIME', '08:00:00'); //設定營業時間(開始)
define('CORP_CLOSETIME', '21:00:00'); //設定營業時間(結束)
define('CORP_ADDR', ''); //設定地址
define('CORP_TEL', ''); //設定連絡電話
define('CORP_NAME', ''); //設定公司名稱

define('CORP_INTRO', ''); //設定網站簡介
define('CORP_VIDEO', ''); //設定youtube嵌入影片
//CART MODEL
define('FREIGHT', 80); //設定運費
define('DISCOUNT95', 5000); //設定額滿95折
define('DISCOUNT92', 8000); //設定額滿92折
define('DISCOUNT09', 10000); //設定額滿9折

define('TEMPLATE_PATH', 'templates/default/'); //設定樣板名稱
define('MODULES', 'user,hello,page,cart,news,member'); //需要安裝的模組，以','隔開

define('DB_PATH', '127.0.0.1'); //設定資料庫位置
define('DB_USER', ''); //設定資料庫帳號
define('DB_PASSWORD', ''); //設定資料庫密碼
define('DB_NAME', ''); //設定資料庫名稱
define('SALT', 'xca2j'); //設定SALT

date_default_timezone_set('Asia/Taipei'); //設定時區

