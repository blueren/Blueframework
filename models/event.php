<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Event extends Model
{


    public $event;

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
	public function say($id)
	{
		$query = $this->_link->prepare("SELECT * FROM  `ams` WHERE `id`= :id");
		$query->execute(array(":id" => $id));
		$result = $query->fetch(PDO::FETCH_OBJ);
		var_dump($result);
		return $id;		
	}
	
    public function __destruct()
    {
        $this->event = null;
		$this->_link = null;
    }

}