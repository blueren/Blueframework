<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
include_once('core/Controller.php');
class AcctController extends Controller
{
	

    public function construct()
    {

    }
	

    protected function index()
    {
		
        $this->view->setVar('type', 'dump');
        //$this->view->setVar('obj', $this->acct->ins('2014-02-19', 'loha', 'test', -112, '00001'));
        //$this->view->setVar('obj', $this->acct->display('Q1', 103, 0));
        $this->view->setVar('obj', $this->acct->del(3));
		$this->view->setVar('content', 'acct.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function display()
    {
        $type = $this->getQuery('type');
        $year = $this->getQuery('year');
        $cate = $this->getQuery('cate');
        $this->view->setVar('type', 'display');
        $this->view->setVar('obj', $this->acct->display($type, $year, $cate));
		$this->view->setVar('content', 'acct.tpl.php');
		$this->view->render('index.tpl.php');
    }   
    
    protected function ins()
    {
        $this->chk(2);
        $this->view->setVar('type', 'ins');
		$this->view->setVar('content', 'acct.tpl.php');
		$this->view->render('index.tpl.php');
    } 

    protected function exe_ins()
    {
        $this->chk(2);
        $dte = $this->postQuery('dte');
        $cate = $this->postQuery('cate');
        $content = $this->postQuery('content');
        $amt = $this->postQuery('amt');
        $this->acct->ins($dte, $cate, $content, $amt, $_SESSION['user']->id);
        $this->redirectTo('./index.php?mod=acct&act=display');

    }    
    public function __destruct()
    {
		$this->view = NULL;
    }

}