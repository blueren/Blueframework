<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
include_once("core/Controller.php");
class IndexController extends Controller
{
	

    public function construct()
    {

    }
	

    protected function index()
    {
        $id = $this->postQuery('id', 0);
		$obj = $this->cart->randProduct(8);
		
		$this->view->setVar('type', 'index');
		$this->view->setVar('obj', $obj);
		$this->view->setVar('content', 'content.tpl.php');
		$this->view->render('index.tpl.php');    

    }

    public function __destruct()
    {
		$this->view = NULL;
    }

}