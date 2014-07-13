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
class NewsController extends Controller
{
	

    public function construct()
    {
        $this->select=array(
            'cate' =>array(1=>'一般', '公告','活動','新聞','閒聊','產品')

            );
    }
	

    protected function index()
    {
		
		$this->view->setVar('type', 'newsList');
		$this->view->setVar('obj', $this->news->display());
		$this->view->setVar('content', 'news.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function show()
    {
        $id = $this->getQuery('id');
		$this->view->setVar('type', 'show');
        $this->view->setVar('cate', $this->select['cate']);
		$this->view->setVar('obj', $this->news->show($id));
		$this->view->setVar('content', 'news.tpl.php');
		$this->view->render('index.tpl.php');
    }   

    protected function exe_del()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->news->del($id);
        $this->redirectTo('./index.php?mod=news');    
    } 
    
    protected function ins()
    {
        $this->chk(2);
		$this->view->setVar('type', 'ins');
        $this->view->setVar('cate', $this->select['cate']);
		$this->view->setVar('content', 'news.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function upd()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
		$this->view->setVar('type', 'upd');
        $this->view->setVar('cate', $this->select['cate']);
        $this->view->setVar('obj', $this->news->show($id));
		$this->view->setVar('content', 'news.tpl.php');
		$this->view->render('index.tpl.php');
    }    
    
    protected function exe_ins()
    {
        $this->chk(2);
        $cate = $this->postQuery('cate',0);
        $title = $this->postQuery('title',0);
        $content = $this->postQuery('content',0);
        $upd_dte = $this->postQuery('upd_dte',0);
        if ($this->user->priv()==2) {
            $this->news->ins($cate, $title, $content, $_SESSION['user']->id, '127.0.0.1', $upd_dte);
        }
        $this->redirectTo('./index.php');
    }

    protected function exe_upd()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $cate = $this->postQuery('cate',0);
        $title = $this->postQuery('title',0);
        $content = $this->postQuery('content',0);
        $upd_dte = $this->postQuery('upd_dte',0);
        if ($this->user->priv()==2) {
            $this->news->upd($id, $cate, $title, $content, $_SESSION['user']->id, '127.0.0.1', $upd_dte);
        }
        $this->redirectTo('./index.php');
    }
    
    protected function display()
    {
        $this->chk(2);
		$arr = array('001', '002', '003', '004', '005');
		
		$this->view->setVar('type', 'dump');
		$this->view->setVar('obj', $arr);
		$this->view->setVar('content', 'news.tpl.php');
		$this->view->render('index.tpl.php');
    }    
    

    public function __destruct()
    {
		$this->view = NULL;
    }

}