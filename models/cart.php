<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Cart extends Model
{


    public $cart;

    public function __construct()
    {
		$this->setDB();
    }
	public function sidebar()
	{
        $obj = new stdClass;
        $obj->admin = array(
            '產品管理' => 'index.php?mod=cart&act=productManage',
            '更改熱銷產品' => 'index.php?mod=cart&act=updHot',
            '訂單分析' => 'index.php?mod=cart&act=stat'
        );
        $obj->user = array(
            '購物車' => 'index.php?mod=cart&act=order'
        );
        return $obj;
	}        
    public function stat()
    {
        $obj = new stdClass;
        $total = new stdClass;
        $total->price = 0;
        $total->qty = 0;
        $total->income = 0;
        $query = $this->_link->prepare('SELECT t3.title, t2.cid, SUM( t1.qty ) AS qty, SUM( t1.price * t1.qty ) AS price, SUM( (
        t1.price - t1.cost
        ) * t1.qty ) AS income
        FROM cart_sale_det AS t1
        LEFT JOIN cart_product AS t2 ON t1.pid = t2.id
        LEFT JOIN cart_cate AS t3 ON t2.cid = t3.id
        GROUP BY cid');
        $query->execute();        
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $query = $this->_link->prepare('SELECT t2.cid, t3.title AS ctitle, t2.id AS pid, t2.title AS ptitle, t1.qty, t1.price, (
        t1.price - t1.cost
        ) AS income
        FROM cart_sale_det AS t1
        LEFT JOIN cart_product AS t2 ON t1.pid = t2.id
        LEFT JOIN cart_cate AS t3 ON t2.cid = t3.id');
        $query->execute();        
        $result2 = $query->fetchAll(PDO::FETCH_OBJ);

        foreach($result2 as $i => $v)
        {
            $result2[$i]->income = $v->income * $v->qty;
            $result2[$i]->price = $v->price * $v->qty;
            $total->price += ($v->price);
            $total->qty += $v->qty;
            $total->income += ($v->income);
        }             
        foreach($result as $i => $v)
        {
            $result[$i]->percent = new stdClass;

            $result[$i]->percent->price = round((($v->price) / $total->price) * 100,1);
            $result[$i]->percent->qty = round(($v->qty / $total->qty) * 100,1);
            $result[$i]->percent->income = round((($v->income) / $total->income) * 100,1);

        } 
    
        $obj->result = $result;
        $obj->sale = $result2;
        $obj->total = $total;     
        return $obj;
    }
    
    public function updHotprod($id1, $id2, $id3)
    {
        $query = $this->_link->prepare('UPDATE cart_product_det SET hot=0 WHERE hot=1 OR hot=2 OR hot=3');
        $query->execute();
        $query = $this->_link->prepare('UPDATE cart_product_det SET hot=1 WHERE id=:id1');
        $query->execute(array(':id1' => $id1));
        $query = $this->_link->prepare('UPDATE cart_product_det SET hot=2 WHERE id=:id2');
        $query->execute(array(':id2' => $id2));   
        $query = $this->_link->prepare('UPDATE cart_product_det SET hot=3 WHERE id=:id3');
        $query->execute(array(':id3' => $id3));        
    }

    public function displayHotprod()
    {
        $query = $this->_link->prepare('SELECT a.*, b.* FROM `cart_product_det` as a NATURAL JOIN `cart_product` as b WHERE hot=1 OR hot=2 OR hot=3 ORDER BY hot ASC');
        $query->execute();
        $obj = $query->fetchAll(PDO::FETCH_OBJ);
        return $obj;
    }
    
    public function randProduct($num)
    {
        $query = $this->_link->prepare('SELECT a.*, b.* FROM `cart_product` as a, `cart_product_det` as b where a.id = b.id ORDER BY RAND() LIMIT :num');
        $query->execute(array(':num' => $num));
        $obj = $query->fetchAll(PDO::FETCH_OBJ);
        return $obj;
    }
    
    public function delCate($id)
    {
        $query = $this->_link->prepare('DELETE FROM cart_cate WHERE id=:id');
        $query->execute(array(':id' => $id));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function delSale($id)
    {
        $query = $this->_link->prepare('DELETE FROM cart_sale WHERE id=:id;');
        $query->execute(array(':id' => $id));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function delProduct($id)
    {
        $query = $this->_link->prepare('DELETE FROM cart_product WHERE id=:id');
        $query->execute(array(':id' => $id));
        return $query->fetch(PDO::FETCH_OBJ);
    }

    public function delCart($id)
    {
        unset($_SESSION['cartCart'][$id]);
    }
    
    public function showCate($id)
    {
        $query = $this->_link->prepare('SELECT * FROM cart_cate WHERE id=:id');
        $query->execute(array(':id' => $id));
		$result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
   
    public function showSale($id, $uid=null)
    {
        $obj = new stdClass;
        if (isset($uid)) {
            $query = $this->_link->prepare('SELECT * FROM cart_sale WHERE id=:id AND uid=:uid');
            $query->execute(array(':id' => $id, ':uid' => $uid));
        }
        else{
            $query = $this->_link->prepare('SELECT * FROM cart_sale WHERE id=:id');
            $query->execute(array(':id' => $id));
        }
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        $query = $this->_link->prepare('SELECT * FROM cart_sale_det WHERE sid=:sid');
        $query->execute(array(':sid' => $result->id));
        $result2 = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($result2 as $i =>$v) {
            $result2[$i]->title = $this->parseProduct($v->pid)->title;
        }
        $obj = $result;
        $obj->detail = $result2;
        return $obj;
    } 

    public function updCate($id, $title, $content)
    {
        $id = htmlspecialchars($id);
        $title = htmlspecialchars($title);
        
        $query = $this->_link->prepare('UPDATE cart_cate SET title = :title, content =:content WHERE id=:id');
        $query->execute(array(':id' => $id, ':title' => $title, ':content' => $content));
		$result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    } 
    
    public function updSale($id, $uid, $remit_dte, $remit_name, $remit_acc, $addr, $status)
    {
        $this->select=array(
            'status' =>array(1=>'待處理','通知付款','會員已付款','補貨中','商品寄出','退貨')

            );    
        $id = htmlspecialchars($id);
        $uid = htmlspecialchars($uid);
        $remit_dte = isset($remit_dte) ? htmlspecialchars($remit_dte) : null;
        $remit_name = isset($remit_name) ? htmlspecialchars($remit_name) : null;
        $remit_acc = isset($remit_acc) ? htmlspecialchars($remit_acc) : null;
        $addr = htmlspecialchars($addr);
        $status = htmlspecialchars($status);
        $to = $_SESSION['user']->email; //收件者 
        $subject = $id.'訂單更動'; //信件標題 
        $msg = '已將狀態更動為['.$this->select['status'][$status].']請上http://www.kones.com.tw確認';//信件內容 
        $headers = "From: no-reply@kones.com.tw"; //寄件者
        
        if ($uid==0) {
            $query = $this->_link->prepare('UPDATE cart_sale SET remit_dte=:remit_dte, remit_name=:remit_name, remit_acc=:remit_acc, addr=:addr, status=:status WHERE id=:id');
            $query->execute(array(':id' => $id, ':remit_dte' => $remit_dte, ':remit_name' => $remit_name, ':remit_acc' => $remit_acc, ':addr' => $addr, ':status' => $status));
            mail($to, $subject, $msg, $headers);
        }else{
            $query = $this->_link->prepare('UPDATE cart_sale SET remit_dte=:remit_dte, remit_name=:remit_name, remit_acc=:remit_acc, addr=:addr, status=:status WHERE id=:id AND uid=:uid');
            $query->execute(array(':id' => $id, ':uid' => $uid, ':remit_dte' => $remit_dte, ':remit_name' => $remit_name, ':remit_acc' => $remit_acc, ':addr' => $addr, ':status' => $status));
            mail($to, $subject, $msg, $headers);
        }
        var_dump($query->errorinfo());
    }

    public function userSale($uid, $status = null)
    {
        if ($uid==0){
            if (is_numeric($status) && $status!=0){
                $query = $this->_link->prepare('SELECT * FROM cart_sale WHERE status=:status ORDER BY start_dte DESC');
                $query->execute(array(':status' => $status));
            }
            else{
                $query = $this->_link->prepare('SELECT * FROM cart_sale  ORDER BY start_dte DESC');
                $query->execute();
            }    
        }
        else{
            $query = $this->_link->prepare('SELECT * FROM cart_sale WHERE uid=:uid  ORDER BY start_dte DESC');
            $query->execute(array(':uid' => $uid));
            
        }
        $result = $query->fetchAll(PDO::FETCH_OBJ);
         
        $obj2 = array();
        foreach($result as $i => $v) {
            $query = $this->_link->prepare('SELECT * FROM user WHERE id=:id');
            $query->execute(array(':id' => $v->uid));
            $obj = $query->fetch(PDO::FETCH_OBJ);
            $result[$i]->tel = $obj->tel;
            $result[$i]->name = $obj->name;
            $content = '';
            
            
            $query = $this->_link->prepare('SELECT * FROM cart_sale_det WHERE sid=:sid');
            $query->execute(array(':sid' => $v->id));
            $result2 = $query->fetchAll(PDO::FETCH_OBJ);

            
            $total = 0;
         
            foreach($result2 as $j =>$k) {
                $price = $k->price;
                $qty = $k->qty;
                $pid = $k->pid;            
                $result[$i]->title = $this->parseProduct($pid)->title;
                $total = $total + ($price * $qty);
                $content .= ', '.$result[$i]->title.'('.$price.')*'.$qty;
            }
            
            $result[$i]->total = $total;
            $result[$i]->content = substr($content,1);
            $obj2[$i] = (object) array_merge((array)$result[$i], (array)$result2);
       
        }
   
         
        return $obj2;
    }
    
    public function insSale($uid, $pid, $qty)
    {
        
        if ($pid!=null && $qty !=null)
        {
            $price = array();
            $cost = array();
            $to = $_SESSION['user']->email; //收件者 
            $subject = '[喜帥棉織] 商品購買通知'; //信件標題 
            $msg = '您已完成購買，購買項目如下 :';//信件內容 
            $msg = $msg.'
            ';            
            $headers = "From: no-reply@kones.com.tw"; //寄件者

            $query = $this->_link->prepare('INSERT INTO cart_sale (`uid`, `start_dte`, `freight`, `status`)
            VALUES (:uid, CURRENT_TIMESTAMP, :freight, 1)');
            $query->execute(array(':uid' => htmlspecialchars($uid), ':freight' => FREIGHT));
            $query = $this->_link->prepare('SELECT LAST_INSERT_ID() as sid');
            $query->execute();
            $sid = $query->fetch(PDO::FETCH_OBJ)->sid;
            $total = 0;
            foreach ($pid as $i => $v){
                $query = $this->_link->prepare('SELECT * FROM cart_product WHERE id=:id');
                $query->execute(array(':id' => $v));
                $obj = $query->fetch(PDO::FETCH_OBJ);
                $price[$i] = $obj->price;
                $cost[$i] = $obj->cost;
                $title[$i] = $obj->title;
                $total = $total + ($qty[$i] * $obj->price);
                $this->updProduct($v, $v, $obj->cid, $obj->title, $obj->content, $obj->qty-$qty[$i], $obj->price, $obj->cost, $obj->start_dte, $obj->end_dte);
                $query = $this->_link->prepare('INSERT INTO cart_sale_det (`sid`, `pid`, `qty`, `price`, `cost`)
                VALUES (:sid, :pid, :qty, :price, :cost)');
                $query->execute(array(':sid' => htmlspecialchars($sid), ':pid' => htmlspecialchars($v), ':qty' => htmlspecialchars($qty[$i]), ':price' => $obj->price, ':cost' => $obj->cost));       
                $msg = $msg.'
                ';                
                $msg = $msg.$title[$i].'*'.$qty[$i].',價格'.$obj->price * $qty[$i].';';
                $msg = $msg.'
                ';
            }
            if ($total>=2000)
            {
                $query = $this->_link->prepare('UPDATE cart_sale SET freight = 0 WHERE id = :id');
                $query->execute(array(':id' => $sid));
            }
            $msg = $msg.'
            ';            
            $msg = $msg.'請等候工作人員確認存貨後再通知您付款，請勿直接回覆本信，感謝您。';//信件內容 
            unset($_SESSION['cartCart']);
            mail($to, $subject, $msg, $headers); 
            
        }
    }
    
    
    public function showProduct($id)
    {
        $query = $this->_link->prepare('SELECT * FROM cart_product WHERE id=:id');
        $query->execute(array(':id' => $id));
		$result = $query->fetch(PDO::FETCH_OBJ);
        $query = $this->_link->prepare('SELECT * FROM cart_product_det WHERE id=:id');
        $query->execute(array(':id' => $id));
		$result2 = $query->fetch(PDO::FETCH_OBJ);
		$obj = (object) array_merge((array) $result, (array) $result2);
        return $obj;
    }

    public function displayProduct($cid)
    {
        $obj = array();
        if (is_numeric($cid)) {
            if ($cid==0) {
                $query = $this->_link->prepare('SELECT * FROM cart_product');
                $query->execute(); 
                $result = $query->fetchAll(PDO::FETCH_OBJ);                
                $query = $this->_link->prepare('SELECT * FROM cart_product_det');
                $query->execute();
                $result2 = $query->fetchAll(PDO::FETCH_OBJ);
                
            }
            else {
                $query = $this->_link->prepare('SELECT * FROM cart_product WHERE cid=:cid');
                $query->execute(array(':cid' => $cid));  
                $result = $query->fetchAll(PDO::FETCH_OBJ);
                $query = $this->_link->prepare('SELECT * FROM cart_product_det WHERE id=:id');
                $query->execute(array(':id' => $cid));  
                $result2 = $query->fetchAll(PDO::FETCH_OBJ);
            }
            foreach ($result as $i => $v) {
                $obj[$i] = (object) array_merge((array) $result[$i], (array) $result2[$i]);
            }
            
        }
        return $obj;
    }    
    
    public function displayCate()
    {
        $query = $this->_link->prepare('SELECT * FROM cart_cate');
        $query->execute();
        return $query->fetchAll(PDO::FETCH_OBJ);
    }
    public function insCate($title, $content)
    {
        $title = htmlspecialchars($title);
        $query = $this->_link->prepare('INSERT INTO `cart_cate` (`title`, `content`)
        VALUES (:title, :content)');
        $query->execute(array(':title' => $title, ':content' => $content));
    }
    
    public function insProduct($id, $cid, $title, $content, $qty, $price, $cost)
    {
        $id = htmlspecialchars($id);
        $cid = htmlspecialchars($cid);
        $title = htmlspecialchars($title);
        $qty = htmlspecialchars($qty);
        $price = htmlspecialchars($price);
        $cost = htmlspecialchars($cost);
        $query = $this->_link->prepare('INSERT INTO cart_product (`id`, `cid`, `title`, `content`, `qty`, `price`, `cost`, `start_dte`)
        VALUES (:id, :cid, :title, :content, :qty, :price, :cost, CURRENT_TIMESTAMP)');
        $query->execute(array(':id' => $id, ':cid' => $cid, ':title' => $title, ':content' => $content, ':qty' => $qty, ':price' => $price, ':cost' => $cost));
        var_dump($query->errorinfo());
    }

    public function updProduct($id, $nid, $cid, $title, $content, $qty, $price, $cost, $start_dte, $end_dte)
    {
        $id = htmlspecialchars($id);
        $nid = htmlspecialchars($nid);
        $cid = htmlspecialchars($cid);
        $title = htmlspecialchars($title);
        $qty = htmlspecialchars($qty);
        $price = htmlspecialchars($price);
        $cost = htmlspecialchars($cost);
        $query = $this->_link->prepare('UPDATE cart_product SET id=:nid, cid=:cid, title=:title, content=:content, qty=:qty, price=:price, cost=:cost, start_dte=:start_dte, end_dte=:end_dte WHERE id=:id');
        $query->execute(array(':id' => $id, ':nid' => $nid, ':cid' => $cid, ':title' => $title, ':content' => $content, ':qty' => $qty, ':price' => $price, ':cost' => $cost, ':start_dte' => $start_dte, ':end_dte' => $end_dte));
        var_dump($query->errorinfo());
    }	

    public function updProduct_det($id, $nid, $size, $weight, $unit, $img1, $img2, $img3)
    {
        $id = htmlspecialchars($id);
        $nid = htmlspecialchars($nid);
        $size = htmlspecialchars($size);
        $weight = htmlspecialchars($weight);
        $unit = htmlspecialchars($unit);
        $img1 = htmlspecialchars($img1);
        $img2 = htmlspecialchars($img2);
        $img3 = htmlspecialchars($img3);
        $query = $this->_link->prepare('UPDATE cart_product_det SET id =:nid, size =:size, weight =:weight, unit =:unit, img1 =:img1, img2 =:img2, img3 =:img3 WHERE id =:id');
        $query->execute(array(':id' => $id, ':nid' => $nid, ':size' => $size, ':weight' => $weight, ':unit' => $unit, ':img1' => $img1, ':img2' => $img2, ':img3' => $img3));
        var_dump($query->errorinfo());
    }	
	
	public function uploadImg($img, $rename, $fix, $path)
	{
			$temp = $img['tmp_name'];
			$type = $img['type'];
			$name = $img['name'];
			$size = number_format(($img['size']/1024), 1, '.', '');
			$fn_array=explode(".",$name);
			$mainName = $fn_array[0];//檔名
			$subName = $fn_array[1];//副檔名		
			if (substr($type, 0, 5)=="image" and $size<1024 and $name==basename($name)){
				//中文檔名處理
				date_default_timezone_set('Asia/Taipei');
				$mainName = $rename;//重新命名
				$name = sprintf("%s.%s",$mainName,$subName);//組合檔名
				$photo_path = $this->resize($name, $temp, $fix, $path);
				return $imgdir = $photo_path."/".$name;
			}
			return null;
	}			
    public function insProduct_det($id, $size, $weight, $unit, $img1, $img2, $img3)
    {
        $id = htmlspecialchars($id);
        $size = htmlspecialchars($size);
        $weight = htmlspecialchars($weight);
        $unit = htmlspecialchars($unit);
        $img1 = htmlspecialchars($img1);
        $img2 = htmlspecialchars($img2);
        $img3 = htmlspecialchars($img3);  
        
        $query = $this->_link->prepare('INSERT INTO cart_product_det (`id`, `size`, `weight`, `unit`, `img1`, `img2`, `img3`)
        VALUES (:id, :size, :weight, :unit, :img1, :img2, :img3)');
        $query->execute(array(':id' => $id, ':size' => $size, ':weight' => $weight, ':unit' => $unit, ':img1' => $img1, ':img2' => $img2, ':img3' => $img3));
        var_dump($query->errorinfo());
    }
    
    public function insCart($uid, $pid, $qty)
    {
        $uid = htmlspecialchars($uid);
        $pid = htmlspecialchars($pid);
        $qty = htmlspecialchars($qty);
        $arr = array();
        $cartCart = new stdClass();
        $cartCart->pid = $pid;
        $cartCart->qty = $qty;
        
        $query = $this->_link->prepare('SELECT title, price, cost, qty FROM cart_product WHERE `id`=:pid');
        $query->execute(array(':pid' => $pid));
        $result = $query->fetch(PDO::FETCH_OBJ);
        $cartCart->cost = $result->cost;
        $cartCart->price = $result->price; 
        $cartCart->title = $result->title; 
        $cartCart->qty_st = $result->qty - $qty;
        $cartCart->qty = $qty;
        if ($qty>0 && $cartCart->qty>0){
            if (isset($_SESSION['cartCart'])){
                
                foreach ($_SESSION['cartCart'] as $i => $v)
                {
                    if (isset($v->pid) && $v->pid == $pid) {
                        $_SESSION['cartCart'][$i]->qty += $qty;
                        var_dump('<pre>');
                        var_dump($_SESSION['cartCart']);
                        var_dump('</pre>');
                        return;
                    }
                }
                array_push($_SESSION['cartCart'], $cartCart);
                //$_SESSION['cartCart'] = $arr;
            }
            else{
                array_push($arr, $cartCart);
                $_SESSION['cartCart'] = $arr;
            }
        }
        else
        {
            die('存貨不足或輸入數量不為正整數');
        }
        var_dump('<pre>');
        var_dump($_SESSION['cartCart']);
        var_dump('</pre>');

    }
    
    public function parseId($id)
    {
        $query = $this->_link->prepare('SELECT * FROM cart WHERE `id`=:id');
        $query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }

    public function parseProduct($id)
    {
        $err = new stdClass;
        $msg = '未知:'.$id;
        $err->title = $msg;
        $query = $this->_link->prepare('SELECT * FROM cart_product WHERE `id`=:id');
        $query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        return $result ? $result : $err;
    }
    
	public function resize($name, $temp, $imgSize, $tmpdir)
	{
		$get_img = getimagesize($temp); 
		if ($get_img[2] == 1 or $get_img[2] == 2 or $get_img[2]== 3) {
			// 取得上傳圖片
			$get_img = getimagesize($temp); 
			switch ($get_img[2]){
				case "1":
					$src = imagecreatefromgif($temp);
				break;
				case "2":
					$src = imagecreatefromjpeg($temp);
				break;
				case "3":
					$src = imagecreatefrompng($temp);
				break;
			}
			// 取得來源圖片長寬
			$src_w = imagesx($src);
			$src_h = imagesy($src);

			// 假設要長寬不超過$imgSize
			if ($imgSize=="widthOnly"){
				$thumb_w = 200;
				$thumb_h = intval($src_h / $src_w * 200);
			}else{
				if($src_w > $src_h){
				  $thumb_w = $imgSize;
				  $thumb_h = intval($src_h / $src_w * $imgSize);
				}else{
				  $thumb_h = $imgSize;
				  $thumb_w = intval($src_w / $src_h * $imgSize);
				}
			}			
			// 建立縮圖
			$thumb = imagecreatetruecolor($thumb_w, $thumb_h);
			// 開始縮圖
			imagecopyresampled($thumb, $src, 0, 0, 0, 0, $thumb_w, $thumb_h, $src_w, $src_h);

			if(!file_exists($tmpdir)) {
				mkdir($tmpdir,0777);
			}
			switch ($get_img[2]){
				case "1":
					// 儲存縮圖到指定 thumb 目錄
					imagegif($thumb, $tmpdir."/".$name);
				break;
				case "2":
					// 儲存縮圖到指定 thumb 目錄
					imagejpeg($thumb, $tmpdir."/".$name);
				break;
				case "3":
					// 儲存縮圖到指定 thumb 目錄
					imagepng($thumb, $tmpdir."/".$name);
				break;
			}
			return $tmpdir;
		}else{
			return 'err';
		}
	}    
    
	public function cut($var)
    {
        $var = explode(',', $var);
        return $var;
    }

	public function combine($var)
    {
        $str = null;
        $str = trim(implode(',',$var));
        return $str;
    }    
    public function __destruct()
    {
        $this->cart = null;
		$this->_link = null;
    }

}