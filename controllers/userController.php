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
class UserController extends Controller
{
	

    public function construct()
    {
        $this->select=array(
            'uType' =>array(0=>'待審核','一般會員', 99=>'管理者')

            );
    }
	
    protected function index()
    {
        // $this->user->set_token('admin');
        // var_dump($this->user->remember_me('admin'));
        $this->view->setVar('type', 'login');
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
    }

	protected function exe_sendmsg()
	{
		$this->chk(1);    
		$receive = $this->postQuery('receive',0);
		$title = $this->postQuery('title',0);
		$message = $this->postQuery('msg',0);
		
        $this->view->setVar('type', 'exe_sendmsg');
		$this->view->setVar('obj', $this->user->send($_SESSION['user'],$receive,$title,$message));
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
        $this->redirectTo('./index.php?mod=user&act=msgbox');
	}
	
	protected function sendmsg()
    {
		$this->chk(1);
		
        $this->view->setVar('type', 'sendmsg');
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
    }

	protected function msgbox()
    {
		$this->chk(1);
        
        $this->view->setVar('type', 'msgbox');
		$this->view->setVar('obj', $this->user->receive($_SESSION['user']));
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
    }
	
	protected function msg()
    {
		$this->chk(1);
        $id=$this->getQuery('id',0);
		$obj=$this->user->msg_det($_SESSION['user'], $id);
		
        $this->view->setVar('type', 'msg');
		$this->view->setVar('obj', $obj);
		$this->user->isread($_SESSION['user'], $id);
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
    }	
    
    protected function del()
    {
		$this->chk(1);
        $receive=$_SESSION['user'];
		$id=$this->getQuery('id',0);
        $this->user->msg_del($receive, $id);
        $this->redirectTo('./index.php');
    }
	
	protected function login()
	{
        $remember = $this->postQuery('remember');
        $token=$this->postQuery('token');
		$username=$this->postQuery('user',0);
		$password=$this->user->encrypt($this->postQuery('pw',0));
        $obj = $this->user->login($username,$password,$token,$remember);
		$this->view->setVar('obj', $obj);
        $this->redirectTo('./index.php?mod=user');
	}
	
	protected function logout()
	{
        $this->user->logout();
		$this->redirectTo('./index.php');
	}

 	protected function upd()
	{
        $this->chk(1);
        $this->view->setVar('obj', $this->user->show($_SESSION['user']->id));
		
        $this->view->setVar('type', 'upd');        
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');   
	}

 	protected function exe_upd()
	{
        $this->chk(1);
        $name = $this->postQuery('name');
        $addr = $this->postQuery('addr');
        $tel = $this->postQuery('tel');
        $email = $this->postQuery('email');   
        $this->user->upd($_SESSION['user']->id, $name, $addr, $tel, $email, '127.0.0.1', $_SESSION['user']->type);
        $this->redirectTo('./index.php');
	}    
    
 	protected function updManage()
	{
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->view->setVar('obj', $this->user->show($id));
        $this->view->setVar('uType', $this->select['uType']);
		
        $this->view->setVar('type', 'updManage');        
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
	}    
    

 	protected function exe_updManage()
	{
        $this->chk(2);
        $id = $this->getQuery('id');
        $name = $this->postQuery('name');
        $addr = $this->postQuery('addr');
        $tel = $this->postQuery('tel');
        $email = $this->postQuery('email');   
        $type = $this->postQuery('type');
        $this->user->upd($id, $name, $addr, $tel, $email, '127.0.0.1', $type);
        $this->redirectTo('./index.php?mod=user&act=userManage');
	}    
    

 	protected function updPassword()
	{
		$this->chk(1);
        $pw=$this->user->encrypt($this->postQuery('pw',0));
        $npw=$this->user->encrypt($this->postQuery('npw',0));
        $npw2=$this->user->encrypt($this->postQuery('npw2',1));
		
        $this->view->setVar('type', 'updPassword');
        
        if ($npw==$npw2) {
            $this->view->setVar('chkpwd', $this->user->updPassword($pw, $npw, $_SESSION['user']->id));
            $this->redirectTo('./index.php?mod=user&act=logout');
        }
        else{
            $this->view->setVar('chkpwd', '密碼不一致');
        }
        
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');
		if($this->user->priv()==0)
			$this->redirectTo('./index.php');
	}
    
    protected function userManage()
    {
        $this->chk(2);
        // 物件分頁處理
        $per = $this->getQuery('per', 5);
        $page = $this->getQuery('page', 1);
		$this->view->setVar('obj', $this->user->paganation($this->user->display(), $per, $page));        

        $this->view->setVar('type', 'userManage');
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');    
    }

    protected function reg()
    {
        $this->view->setVar('obj', $this->user->display());
        $this->view->setVar('type', 'reg');
		$this->view->setVar('content', 'user.tpl.php');
		$this->view->render('index.tpl.php');    
    }    


    protected function exe_delUser()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->user->delUser($id);
        $this->redirectTo('./index.php?mod=user&act=userManage');
    } 
    
    protected function exe_reg()
    {
        $user = $this->postQuery('user');
        $pwd=$this->user->encrypt($this->postQuery('pwd',0));
        $name = $this->postQuery('name');
        $gender = $this->postQuery('gender');
        var_dump($gender);
        $birthday = $this->postQuery('birthday');
        $addr = $this->postQuery('addr');
        $tel = $this->postQuery('tel');
        $email = $this->postQuery('email');
        $ip = '127.0.0.1';
        $this->user->ins($user, $pwd, $name, $gender, $birthday, $addr, $tel, $email, $ip, 0);
        $this->redirectTo('./index.php');
    }    
    
    public function __destruct()
    {
		$this->view = NULL;
    }

}