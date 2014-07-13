<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

abstract class Model
{
	public function setDB()
	{
		try 
		{
			$this->_link = new PDO('mysql'.':host='.DB_PATH.';charset=UTF8;dbname='.DB_NAME, DB_USER, DB_PASSWORD);
            $this->_link->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
            $this->_link->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
			// 資料庫使用 UTF8 編碼
			$this->_link->query('SET NAMES UTF8')->execute();
			
		} 
		catch (PDOException $e) 
		{
			echo 'Error!: ' . $e->getMessage() . '<br />';
		}
		return;
	}

	public function intfilter($id, $len = 10)
	{
        $id = cleanhex($id); 
        if (strlen($id) && strlen($pid) > $len){ 
            if (!ereg('^[0-9]+$',$id)){ 
                return $id;
            } 
        }else{ 
            return;
        }   
	}    

    
    function cleanhex($input){ 
        $clean = preg_replace("![][xx]([a-fa-f0-9]{1,3})!", "",$input); 
        return $clean;
    }     
    
    public function paganation($display_array, $show_per_page, $page) {

        $obj = new stdClass;
        if (!empty ($display_array)){
            $obj->total_page = ceil(count($display_array) / $show_per_page);
            if ($page < 1)
            {
                $page = 1;
            }
            elseif($page >= $obj->total_page)
            {
                $page = $obj->total_page;
            }
            $start = ($page- 1) * $show_per_page;
            $obj->content = array_slice($display_array, $start, $show_per_page);
            $obj->current_page = $page;
        }
        else
        {
            $obj->total_page = 1;
            $obj->content = $display_array;
            $obj->current_page = $page;        
        }
        return $obj;
    }

}