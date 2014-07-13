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
class MemberController extends Controller
{
	

    public function construct()
    {
    }
	
    protected function index()
    {
		$this->view->setVar('type', 'index');
		$this->view->setVar('obj', $this->member->display());
		$this->view->setVar('content', 'member.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function show()
    {
		$id = $this->getQuery('id');
		$this->view->setVar('type', 'show');
		$this->view->setVar('obj', $this->member->show($id));
		$this->view->setVar('content', 'member.tpl.php');
		$this->view->render('index.tpl.php');
    }	
	
    protected function ins()
    {
		$this->view->setVar('type', 'ins');
		$this->view->setVar('content', 'member.tpl.php');
		$this->view->render('index.tpl.php');
    }
	
    protected function exe_ins()
    {
		$id = $this->postQuery('id');
		$category = $this->postQuery('category');
		$corpname = $this->postQuery('corpname');
		$owner = $this->postQuery('owner');
		$intro = $this->postQuery('intro');
		$opentime = $this->postQuery('opentime');
		$closetime = $this->postQuery('closetime');
		$addr = $this->postQuery('addr');
		$tel = $this->postQuery('tel');
		$sitename = $this->postQuery('sitename');
		$template = $this->postQuery('template');		
		$this->member->ins($id, $category, $corpname, $owner, $intro, $opentime, $closetime, $addr, $tel, $sitename, $template);
		$this->redirectTo('./index.php?mod=member');
    }

    protected function upd()
    {
		$id = $this->getQuery('id');
		$this->view->setVar('type', 'upd');
		$this->view->setVar('obj', $this->member->show($id));
		$this->view->setVar('content', 'member.tpl.php');
		$this->view->render('index.tpl.php');
    }
	
    protected function exe_upd()
    {
		$id = $this->getQuery('id');
		$new_id = $this->postQuery('id');
		$category = $this->postQuery('category');
		$corpname = $this->postQuery('corpname');
		$owner = $this->postQuery('owner');
		$intro = $this->postQuery('intro');
		$opentime = $this->postQuery('opentime');
		$closetime = $this->postQuery('closetime');
		$addr = $this->postQuery('addr');
		$tel = $this->postQuery('tel');
		$sitename = $this->postQuery('sitename');
		$template = $this->postQuery('template');	
		$this->member->upd($id, $new_id, $category, $corpname, $owner, $intro, $opentime, $closetime, $addr, $tel, $sitename, $template);
		$this->redirectTo('./index.php?mod=member');
    }	
	
    protected function del()
    {
		$id = $this->getQuery('id');
		$this->member->del($id);
		$this->redirectTo('./index.php?mod=member');
    }
	
    public function __destruct()
    {
		$this->view = NULL;
    }

}