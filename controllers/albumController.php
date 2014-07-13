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
class AlbumController extends Controller
{
	

    public function construct()
    {

    }
	

    protected function index()
    {
        $uid = $this->getQuery('uid', 0);
		$this->view->setVar('obj', $this->album->displayAlbum($uid));
        $this->view->setVar('type', 'displayAlbum');
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function showAlbum()
    {
        $id = $this->getQuery('aid');
        $this->view->setVar('album', $this->album->showAlbum($id));
        $this->view->setVar('type', 'showAlbum');
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }   

    protected function showImg()
    {
        $id = $this->getQuery('id');
        $this->view->setVar('obj', $this->album->showImg($id));
        $this->view->setVar('type', 'showImg');
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function addAlbum()
    {
        $this->chk(2);
        $this->view->setVar('type', 'addAlbum');
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }    

    protected function addImg()
    {
        $this->chk(2);
        $id = $_SESSION['user']->id;
        $this->view->setVar('obj', $this->album->displayAlbum($id));
        $this->view->setVar('type', 'addImg');
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function exe_addAlbum()
    {
        $this->chk(2);
        $content = $_POST['content'];
        $title = $_POST['title'];
        $this->album->insAlbum($title, $content, 0, $_SESSION['user']->id);    
        $this->redirectTo('./index.php?mod=album&act=addImg');
    }

    protected function exe_addImg()
    {
        $this->chk(2);
        $img = $_FILES['file'];
        $content = $_POST['content'];
        $aid = $_POST['aid'];
        
        $this->album->insImg($aid, $img, $content, $_SESSION['user']->id);    
        $this->redirectTo('./index.php?mod=album&act=showAlbum&aid='.$aid);
    }    

    protected function delAlbum()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function delImg()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function exe_delAlbum()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function exe_delImg()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $aid = $this->album->showImg($id)->aid;
        $this->album->delImg($id, $_SESSION['user']->id);
        $this->redirectTo('./index.php?mod=album&act=showAlbum&aid='.$aid);
    }    

    protected function updAlbum()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function updImg()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function exe_updAlbum()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function exe_updImg()
    {
        $this->chk(2);
		$this->view->setVar('content', 'album.tpl.php');
		$this->view->render('index.tpl.php');
    }    
    public function __destruct()
    {
		$this->view = NULL;
    }

}