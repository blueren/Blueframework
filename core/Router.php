<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright c 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究

class Router
{

    public function __construct()
    {
        $this->parseUrl();
		$this->chkName();
    }

    public function getAction()
    {
        return $this->action;
		
    }	
    protected function parseUrl()
    {
		$this->action = $this->getQuery('act', 'index');
    }
	
    protected function chkName()
    {
        if (!preg_match('/[a-z][\-a-z0-9]+/', $this->action)) {
            $this->action = 'index';
        }
    }	
	
    public static function getQuery($name, $default)
    {
        return isset($_GET[$name]) ? strtolower(trim(strip_tags($_GET[$name]))) : $default;
    }
	

}