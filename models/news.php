<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class News extends Model
{


    public $page;

    public function __construct()
    {
		$this->setDB();
    }
	public function sidebar()
	{
        $obj = new stdClass;
        $obj->admin = array(
        '發佈新聞' => 'index.php?mod=news&act=ins'
        );
        $obj->user = array(
        );
        return $obj;
	} 
	public function upd($id, $cate, $title, $content, $uid, $ip, $upd_dte)
	{
        $id = htmlspecialchars($id);
        $cate = htmlspecialchars($cate);
        $title = htmlspecialchars($title);
        $uid = htmlspecialchars($uid);
        $ip = htmlspecialchars($ip);
        $upd_dte = htmlspecialchars($upd_dte);
		$query = $this->_link->prepare('UPDATE news SET 
        cate = :cate,
        title = :title,
        content = :content,
        uid = :uid,
        ip = :ip,
        upd_dte = :upd_dte
        WHERE id = :id
        ');
		$query->execute(array(':id' => $id, ':cate' => $cate, ':title' =>$title, ':content' => $content, ':uid' => $uid, ':ip' => $ip, ':upd_dte' => $upd_dte));
        var_dump($query->errorinfo());
	}    
    
    public function show($id)
    {
        $query = $this->_link->prepare('SELECT * FROM news WHERE id=:id');
        $query->execute(array(':id' => $id));    
        $result = $query->fetch(PDO::FETCH_OBJ);
        $result->author = $this->parseId($result->uid);
        return $result;
    }
    
    public function display()
    {
        $query = $this->_link->prepare('SELECT * FROM news ORDER BY upd_dte DESC');
        $query->execute(); 
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        foreach ($result as $i => $v)
        {
            $result[$i]->author = $this->parseId($v->uid);
        }
        return $result;
    }

    public function ins($cate, $title, $content, $uid, $ip, $upd_dte)
    {
        $cate = htmlspecialchars($cate);
        $title = htmlspecialchars($title);
        $content = htmlspecialchars($content);
        $uid = htmlspecialchars($uid);
        $ip = htmlspecialchars($ip);
        $upd_dte = htmlspecialchars($upd_dte);
        
        $query = $this->_link->prepare('INSERT INTO news (cate, title, content, uid, ip, upd_dte) VALUE (:cate, :title, :content, :uid, :ip, :upd_dte)');
        $query->execute(array(':cate' => $cate, ':title' => $title, ':content' => $content, ':uid' => $uid, ':ip' => $ip, ':upd_dte' => $upd_dte));
        var_dump($query->errorinfo());
    }

    public function del($id)
    {
        $query = $this->_link->prepare('DELETE FROM news WHERE id = :id');
        $query->execute(array(':id' => $id));
    }
    
	public function parseName($var)
	{
		$query = $this->_link->prepare('SELECT * FROM  `user` WHERE  `username` =  :username');
		$query->execute(array(':username' => $var));
		$result = $query->fetch(PDO::FETCH_OBJ);
		if (isset($result->id)) return $result->id;
	}	

	public function parseId($var)
	{
		$query = $this->_link->prepare('SELECT * FROM  `user` WHERE  `id` =  :id');
		$query->execute(array(':id' => $var));
		$result = $query->fetch(PDO::FETCH_OBJ);
        if (isset($result->username)) return $result->username;
	}
    
    public function __destruct()
    {
        $this->page = null;
		$this->_link = null;
    }

}