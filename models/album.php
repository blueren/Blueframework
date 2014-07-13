<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Album extends Model
{


    public $album;

    public function __construct()
    {
		$this->setDB();
    }
	public function sidebar()
	{
        $obj = new stdClass;
        $obj->admin = array(
        );
        $obj->user = array(
        );
        return $obj;
	} 
    public function displayAlbum($uid)
    {	
        if ($uid==0) {
            $query = $this->_link->prepare('SELECT * FROM album');
            $query->execute();        
        }
        else
        {
            $query = $this->_link->prepare('SELECT * FROM album WHERE uid=:uid');
            $query->execute(array(':uid' => $uid));
        }
        $result = $query->fetchAll(PDO::FETCH_OBJ);  	
        foreach($result as $i => $v)
        {
            $result[$i]->author = $this->parseId($v->uid);
        }
		return $result;
    }

    public function showAlbum($id)
    {	
        $query = $this->_link->prepare('SELECT * FROM album WHERE id = :id');
		$query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);
        
        $query = $this->_link->prepare('SELECT * FROM album_img WHERE aid = :aid');
		$query->execute(array(':aid' => $id));
        $result->img = $query->fetchAll(PDO::FETCH_OBJ);  	
		return $result;
    }

    public function displayImg($aid=null)
    {	
        $query = $this->_link->prepare('');
		$query->execute();
        $result = $query->fetchAll(PDO::FETCH_OBJ);  	
		return;
    }

    public function showImg($id)
    {	
        $query = $this->_link->prepare('SELECT * FROM album_img WHERE id = :id');
		$query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);  	
		return $result;
    }

    public function insAlbum($title, $content, $img, $uid)
    {	
        $query = $this->_link->prepare('INSERT INTO  album (title, content, img, uid, dte) VALUES (:title,  :content,  :img,  :uid, CURRENT_TIMESTAMP)');
		$query->execute(array(':title' => htmlspecialchars($title), ':content' => $content, ':img' => htmlspecialchars($img), ':uid' => htmlspecialchars($uid)));	
		return;
    } 

    public function delImg($id, $uid)
    {	

        $query = $this->_link->prepare('SELECT img FROM album_img WHERE id =:id');
		$query->execute(array(':id' => $id));  
        $result = substr($query->fetch(PDO::FETCH_OBJ)->img, 25, 5);
        var_dump($result);
        var_dump($uid);
        if ($result == $uid){
            unlink($this->showImg($id)->img);
            unlink($this->showImg($id)->thumb);        
            $query = $this->_link->prepare('DELETE FROM album_img WHERE id = :id');
            $query->execute(array(':id' => $id));
        }
		return;
    }
    
    public function get_basename($filename){
        return preg_replace('/^.+[\\\\\\/]/', '', $filename);
    }
    
    public function insImg($aid, $img, $content, $uid)
    {

		for ($i = 0; $i < count($img['name']); ++$i) {

			$temp = $img['tmp_name'][$i];
			$type = $img['type'][$i];
			$name = $img['name'][$i];
			$size = number_format(($img['size'][$i]/1024), 1, '.', '');
			//var_dump($size);
			$fn_array=explode('.',$name);
			$mainName = $fn_array[0];//檔名
			$subName = $fn_array[1];//副檔名
			if (substr($type, 0, 5)=='image' and $size<1024 and $name==$this->get_basename($name)){
				//中文檔名處理
				if (mb_strlen($mainName,'Big5') != strlen($mainName))
				{
					$mainName = 'undefine'.$i;//重新命名=檔名+日期
				}
                $name = sprintf('%s.%s',$uid.$mainName.date('ymdHis'),$subName);
				$photo_path = $this->resize($name, $temp, 450, 'models/data/Album/images/'.$uid);
				$imgdir = $photo_path.'/'.$name;
				$photo_thumb = $this->resize($name, $temp, 'widthOnly', 'models/data/Album/thumbs/'.$uid);
				$tmpdir = $photo_thumb.'/'.$name;
					
                $query = $this->_link->prepare('INSERT INTO  album_img (aid, img, thumb, content, dte) VALUES (:aid,  :imgdir,  :tmpdir,  :content, CURRENT_TIMESTAMP)');
                $query->execute(array(':aid' => htmlspecialchars($aid), ':imgdir' => htmlspecialchars($imgdir), ':tmpdir' => htmlspecialchars($tmpdir), ':content' => $content));	
                
                
			}
		}  
        return;
    }    
    

    
	//縮圖
	public function resize($name, $temp, $imgSize, $tmpdir)
	{
		$get_img = getimagesize($temp); 
		if ($get_img[2] == 1 or $get_img[2] == 2 or $get_img[2]== 3) {
			// 取得上傳圖片
			$get_img = getimagesize($temp); 
			switch ($get_img[2]){
				case '1':
					$src = imagecreatefromgif($temp);
				break;
				case '2':
					$src = imagecreatefromjpeg($temp);
				break;
				case '3':
					$src = imagecreatefrompng($temp);
				break;
			}
			// 取得來源圖片長寬
			$src_w = imagesx($src);
			$src_h = imagesy($src);

			// 假設要長寬不超過$imgSize
			if ($imgSize=='widthOnly'){
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
                var_dump($tmpdir);
				mkdir($tmpdir,0777);
			}
			switch ($get_img[2]){
				case '1':
					// 儲存縮圖到指定 thumb 目錄
					imagegif($thumb, $tmpdir.'/'.$name);
				break;
				case '2':
					// 儲存縮圖到指定 thumb 目錄
					imagejpeg($thumb, $tmpdir.'/'.$name);
				break;
				case '3':
					// 儲存縮圖到指定 thumb 目錄
					imagepng($thumb, $tmpdir.'/'.$name);
				break;
			}
			return $tmpdir;
		}else{
			return 'ERR';
		}
	}   
	public function parseId($var)
	{
		$query = $this->_link->prepare('SELECT name FROM  `user` WHERE  `id` =  :id');
		$query->execute(array(':id' => $var));
		$result = $query->fetch(PDO::FETCH_OBJ);
        if (isset($result->name)) return $result->name;
	}    
    public function __destruct()
    {
        $this->album = null;
		$this->_link = null;
    }

}