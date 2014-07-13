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
class CartController extends Controller
{
	

    public function construct()
    {
    
        $this->select=array(
            'status' =>array(1=>'待處理','通知付款','會員已付款','補貨中','商品寄出','退貨')

            );
    }
	

    protected function index()
    {
        $this->chk(2);
        $this->cart->stat();
        $id = $this->postQuery('id', 0);
		$obj = $this->cart->displayHotprod();
		$this->view->setVar('type', 'dump');
		$this->view->setVar('obj', $obj);
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function stat()
    {
        $this->chk(2);
		$obj =$this->cart->stat();
        $t = $this->getQuery('t', 'qty');
		$this->view->setVar('type', 'stat');
		$this->view->setVar('obj', $obj);
        $this->view->setVar('t', $t);
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }    
    
    protected function updHot()
    {
        $this->chk(2);
        $this->view->setVar('type', 'updHot');
        $this->view->setVar('obj', $this->cart->displayProduct(0));
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');    
    }
    
    protected function exe_updHot()
    {
        $this->chk(2);
        $hot1 = $this->postQuery('hot1',0);
        $hot2 = $this->postQuery('hot2',0);
        $hot3 = $this->postQuery('hot3',0);
        $this->cart->updHotprod($hot1, $hot2, $hot3);
        $this->redirectTo('./index.php');
    }
    
    protected function insCate()
    {
        $this->chk(2);
        $this->view->setVar('type', 'insCate');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function insProduct()
    {
        $this->chk(2);
        $this->view->setVar('cate', $this->cart->displayCate());
        $this->view->setVar('type', 'insProduct');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function updCate()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->view->setVar('type', 'updCate');
        $this->view->setVar('obj', $this->cart->showCate($id));
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function exe_updCate()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $title = $this->postQuery('title');
        $content = $this->postQuery('content');   
        $this->cart->updCate($id, $title, $content);
        $this->redirectTo('./index.php?mod=cart&act=cateManage');
    } 
    
    protected function updProduct()
    {
		$this->chk(2);
        $id = $this->getQuery('id');
        $this->view->setVar('cate', $this->cart->displayCate());
		$this->view->setVar('obj', $this->cart->showProduct($id));
        $this->view->setVar('type', 'updProduct');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }
	
    protected function exe_updProduct()
    {
		$this->chk(2);
        $id = $this->getQuery('id');
        $obj = $this->cart->showProduct($id);
		$nid = $this->postQuery('nid');
		$cid = $this->postQuery('cid');
		$title = $this->postQuery('title');
		$content = $this->postQuery('content');
		$qty = $this->postQuery('qty');
		$price = $this->postQuery('price');
		$cost = $this->postQuery('cost');
        $size = $this->postQuery('size');
        $start_dte = $this->postQuery('start_dte');
		$end_dte = $this->postQuery('end_dte');
		$weight = $this->postQuery('weight');
		$unit = $this->postQuery('unit');
		$img1_fix = $this->postQuery('img1_fix');
		$img2_fix = $this->postQuery('img2_fix');
		$img3_fix = $this->postQuery('img3_fix');
        if (!empty($_FILES['img1']['name'])) {
            $img1 = $this->cart->uploadImg($_FILES["img1"], $nid, $img1_fix, 'models/cart/img1');
        }else{
            $img1 = $obj->img1;
        }
		if (!empty($_FILES['img2']['name'])) {
            $img2 = $this->cart->uploadImg($_FILES["img2"], $nid, $img2_fix, 'models/cart/img2');
        }else{
            $img2 = $obj->img2;
        }
        if (!empty($_FILES['img3']['name'])) {
            $img3 = $this->cart->uploadImg($_FILES["img3"], $nid, $img3_fix, 'models/cart/img3');
        }else{
            $img3 = $obj->img3;
        }
        var_dump($_FILES['img1']['name']);
		$this->cart->updProduct($id, $nid, $cid, $title, $content, $qty, $price, $cost, $start_dte, $end_dte);
		$this->cart->updProduct_det($id, $nid, $size, $weight, $unit, $img1, $img2, $img3);
		$this->redirectTo('./index.php?mod=cart&act=productManage');
		
    }	
    
    protected function saleManage()
    {
        $this->chk(2);
        $status = $this->postQuery('status', 0);
        $this->view->setVar('obj', $this->cart->userSale(0, $status));
        $this->view->setVar('status', $this->select['status']);
        $this->view->setVar('selected', $status);
        $this->view->setVar('type', 'saleManage');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');    
    }    
    
    protected function updSale()
    {
        
        $this->chk(2);

        $id = $this->getQuery('id');
        $obj = $this->cart->showSale($id);
        $user = $this->user->show($obj->uid);        
        $this->view->setVar('obj', $obj);
        $this->view->setVar('user', $user);
        $this->view->setVar('status', $this->select['status']);
        $this->view->setVar('type', 'updSale');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');    
    }

    protected function exe_updSale()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $obj = $this->cart->showSale($id);
        $status = $this->postQuery('status', 0);
        $this->cart->updSale($id, 0, $obj->remit_dte, $obj->remit_name, $obj->remit_acc, $obj->addr, $status);
        $this->redirectTo('./index.php?mod=cart&act=saleManage');
    }    
    
    protected function exe_insCate()
    {
        $this->chk(2);
        $title = $this->postQuery('title', 0);
        $content = $this->postQuery('content', 0);
        $this->cart->insCate($title, $content);
        $this->redirectTo('./index.php?mod=cart&act=cateManage');
    }

    protected function exe_insProduct()
    {
        $this->chk(2);
        $id = $this->postQuery('id', 0);
        $cid = $this->postQuery('cid', 0);
        $title = $this->postQuery('title', 0);
        $content = $this->postQuery('content', 0);
        $qty = $this->postQuery('qty', 0);
        $price = $this->postQuery('price', 0);
        $cost = $this->postQuery('cost', 0);

        $size = $this->postQuery('size', 0);
        $weight = $this->postQuery('weight', 0);
        $unit = $this->postQuery('unit', 0);

		$img1_fix = $this->postQuery('img1_fix');
		$img2_fix = $this->postQuery('img2_fix');
		$img3_fix = $this->postQuery('img3_fix');
		$img1 = $this->cart->uploadImg($_FILES["img1"], $id, $img1_fix, 'models/cart/img1');
		$img2 = $this->cart->uploadImg($_FILES["img2"], $id, $img2_fix, 'models/cart/img2');
		$img3 = $this->cart->uploadImg($_FILES["img3"], $id, $img3_fix, 'models/cart/img3');
        $this->cart->insProduct($id, $cid, $title, $content, $qty, $price, $cost);
        $this->cart->insProduct_det($id, $size, $weight, $unit, $img1, $img2, $img3);
        $this->redirectTo('./index.php?mod=cart&act=productManage');
    }

    protected function exe_insCart()
    {
        $this->chk(1);
        $pid = $this->getQuery('id');
        $qty = $this->postQuery('qty', 0);
        $this->cart->insCart($_SESSION['user']->id, $pid, $qty);
        $this->redirectTo('./index.php?mod=cart&act=order');
    }    

    protected function product()
    {
        $id = $this->getQuery('id');
        $this->view->setVar('obj', $this->cart->showProduct($id));
        $this->view->setVar('type', 'product');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }

    protected function productManage()
    {
        $this->chk(2);
        $this->view->setVar('cate', $this->cart->displayCate());
        $cid = $this->postQuery('cid',0);
        $this->view->setVar('cid', $cid);

        // 物件分頁處理
        $page = $this->getQuery('page', 1);
        $per = $this->getQuery('per', 5);
		$this->view->setVar('obj', $this->cart->paganation($this->cart->displayProduct($cid), $per, $page));        
        
        $this->view->setVar('type', 'productManage');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }    

    protected function cateManage()
    {
        $this->chk(2);
        $this->view->setVar('obj', $this->cart->displayCate());
        $this->view->setVar('type', 'cateManage');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }
    
    protected function productList()
    {
        $this->view->setVar('cate', $this->cart->displayCate());
        $cid = $this->getQuery('cid',0);
        $this->view->setVar('cid', $cid);
        $this->view->setVar('obj', $this->cart->displayProduct(0));
        $this->view->setVar('type', 'productList');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    }    
    
    protected function order()
    {
        $this->chk(1);
        $this->view->setVar('sale', $this->cart->userSale($_SESSION['user']->id));
        $this->view->setVar('obj', isset($_SESSION['cartCart']) ? $_SESSION['cartCart'] : array());
        $this->view->setVar('type', 'order');
		$this->view->setVar('content', 'cart.tpl.php');
		$this->view->render('index.tpl.php');
    } 
    
    protected function insSale()
    {
        $this->chk(1);
        $pid = $this->postQuery('pid');
        $qty = $this->postQuery('qty');
        $this->cart->insSale($_SESSION['user']->id, $pid, $qty);
        $this->redirectTo('./index.php?mod=cart&act=order');
    }
    
    protected function notice_paid()
    {
        $this->chk(1);
        $id = $this->getQuery('id');
        $obj = $this->cart->showSale($id, $_SESSION['user']->id);
        if ($obj->status ==2) {
            $this->view->setVar('obj', $obj);
            $this->view->setVar('type', 'notice_paid');
            $this->view->setVar('content', 'cart.tpl.php');
            $this->view->render('index.tpl.php');
        }
        else{
            $this->redirectTo('./index.php?mod=cart&act=order');
        }
    }  

    protected function exe_notice_paid()
    {
        $this->chk(1);
        $id = $this->getQuery('id');
        $remit_name = $this->postQuery('remit_name');
        $remit_acc = $this->postQuery('remit_acc');
        $remit_dte =  str_replace('t', ' ', $this->postQuery('remit_dte'));
        $name = $this->postQuery('name');
        $addr = $this->postQuery('addr');
        //$tel = $this->postQuery('tel');
        //$message = "訂單編號: $id<br>\n匯款帳號末五碼: $remit_acc<br>\n匯款人姓名: $name<br>\n收件地址: $addr<br>\n連絡電話: $tel<br>\n附加訊息: $msg";
        $obj = $this->cart->showSale($id, $_SESSION['user']->id);

        if ($obj->status ==2) {
        $this->cart->updSale($id, $_SESSION['user']->id, $remit_dte, $remit_name, $remit_acc, $addr, '3');
        //$this->user->send($_SESSION['user'],'admin','訂單編號:'.$obj->id,$message);
        }
        $this->redirectTo('./index.php?mod=cart&act=order');
    }     
// 刪除功能
    protected function exe_delProduct()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->cart->delProduct($id);
        $this->redirectTo('./index.php?mod=cart&act=productManage');
    }
    
    protected function exe_delCart()
    {
        $this->chk(1);
        $id = $this->getQuery('id');
        $this->cart->delCart($id);
        $this->redirectTo('./index.php?mod=cart&act=order');
    }
    
    protected function exe_delSale()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->cart->delSale($id);
        $this->redirectTo('./index.php?mod=cart&act=saleManage');
    }
   
    protected function exe_delCate()
    {
        $this->chk(2);
        $id = $this->getQuery('id');
        $this->cart->delCate($id);
        $this->redirectTo('./index.php?mod=cart&act=cateManage');
    }
    
    public function __destruct()
    {
		$this->view = NULL;
    }

}