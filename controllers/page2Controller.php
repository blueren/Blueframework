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
class pageController extends Controller
{
	

    public function construct()
    {

    }
	

    protected function index()
    {
 
        
        $id = $this->getQuery('id', 0);
        $depth = $this->getQuery('depth', 0);
		$this->view->setVar('type', 'index');
        
        $per = $this->getQuery('per', 5);
        $page = $this->getQuery('page', 1);
		$this->view->setVar('obj', $this->page->paganation($this->page->getList(), $per, $page));
        
		$this->view->setVar('content', 'page.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function show()
    {
        $id = $this->getQuery('id');
        $this->view->setVar('child', $this->page->getMenu($id, 1));
		
		$this->view->setVar('type', 'show');
		$this->view->setVar('obj', $this->page->show($id));

		if(isset($_SERVER['HTTP_X_PJAX']) && $_SERVER['HTTP_X_PJAX'] == 'true'){
			$this->view->render('page.tpl.php');
		}else{
			$this->view->setVar('content', 'page.tpl.php');
			$this->view->render('index.tpl.php');
		}  		
    }   

    protected function del()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->page->del($id);
        $this->redirectTo('./index.php?mod=page');    
    } 
    
    protected function ins()
    {
        $this->chk(2);
		
		$this->view->setVar('type', 'ins');
		$this->view->setVar('content', 'page.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function upd()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->view->setVar('obj', $this->page->show($id));
		$this->view->setVar('type', 'upd');
		$this->view->setVar('content', 'page.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function exe_ins()
    {
        $this->chk(2);

            $category = $this->postQuery('category',0);
            $name = $this->postQuery('name',0);
            $url = $this->postQuery('url',0);
            $content = $this->postQuery('content',0);
            $display = $this->postQuery('display',0);
            $add_type = $this->postQuery('add_type',0);
            switch ($add_type)
            {
                case 0:
                $this->page->ins($category, $name, $content, $url, $_SESSION['user']->id, $display);
                var_dump('0');
                break;
                case 1:
                $this->page->ins2($category, $name, $content, $url, $_SESSION['user']->id, $display);
                var_dump('1');
                break;
            }    
        $this->redirectTo('./index.php?mod=page');
    }

    protected function exe_upd()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name',0);
        $url = $this->postQuery('url',0);
        $content = $this->postQuery('content',0);
        $display = $this->postQuery('display',0);
        if ($this->user->priv()==2) {
            $this->page->upd($id , $name, $content, $url, $_SESSION['user']->id, $display);
        }
        $this->redirectTo('./index.php?mod=page');
    }
    

    protected function display()
    {
		$arr = array('001', '002', '003', '004', '005');
		
		$this->view->setVar('type', 'dump');
		$this->view->setVar('obj', $arr);
		$this->view->setVar('content', 'page.tpl.php');
		$this->view->render('index.tpl.php');
    }    
    
    public function __destruct()
    {
		$this->view = NULL;
    }

}