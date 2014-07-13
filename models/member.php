<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Member extends Model
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

        );
        $obj->user = array(
        );
        return $obj;
	}    
    public function show($id)
    {
        $query = $this->_link->prepare('SELECT * FROM member WHERE id=:id');
        $query->execute(array(':id' => $id));    
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    
    public function display()
    {
        $query = $this->_link->prepare('SELECT * FROM member');
        $query->execute(); 
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
	
	public function ins($id, $category, $corpname, $owner, $intro, $opentime, $closetime, $addr, $tel, $sitename, $template)
	{
		var_dump('<pre>');
		var_dump(func_get_args());
		var_dump('</pre>');
		$query = $this->_link->prepare('INSERT INTO `member` (`id`, `category`, `corpname`, `owner`, `intro`, `opentime`, `closetime`, `addr`, `tel`, `sitename`, `template`) VALUES (:id, :category, :name, :owner, :intro, :opentime, :closetime, :addr, :tel, :sitename, :template)');
		$query->execute(array(':id' => $id, ':category' => $category, ':name' => $corpname, ':owner' => $owner, ':intro' => $intro, ':opentime' => $opentime, ':closetime' => $closetime, ':addr' => $addr, ':tel' => $tel, ':sitename' => $sitename, ':template' => $template));
	}
	
	public function upd($id, $new_id, $category, $corpname, $owner, $intro, $opentime, $closetime, $addr, $tel, $sitename, $template)
	{
		var_dump('<pre>');
		var_dump(func_get_args());
		var_dump('</pre>');
		$query = $this->_link->prepare('UPDATE `member` SET 
		`id` = :new_id, 
		`category` = :category, 
		`corpname` = :corpname, 
		`owner` = :owner, 
		`intro` = :intro, 
		`opentime` = :opentime, 
		`closetime` = :closetime, 
		`addr` = :addr,
		`tel` = :tel,
		`sitename` = :sitename,
		`template` = :template
		WHERE `id` = :id');
		$query->execute(array(':id' => $id, ':new_id' => $new_id, ':category' => $category, ':corpname' => $corpname, ':owner' => $owner, ':intro' => $intro, ':opentime' => $opentime, ':closetime' => $closetime, ':addr' => $addr, ':tel' => $tel, ':sitename' => $sitename, ':template' => $template));
	}
	
	public function del($id)
	{
		$query = $this->_link->prepare('DELETE FROM `member` WHERE `id` = :id');
		$query->execute(array(':id' => $id));
	}
    
    public function __destruct()
    {
        $this->page = null;
		$this->_link = null;
    }

}