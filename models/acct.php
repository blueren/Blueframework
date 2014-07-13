<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Acct extends Model
{


    public $acct;

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
	public function display($type, $year = null, $cate = null)
	{
        
        $year = ($year!=null) ? (($year > 1911) ? $year : ($year + 1911)) : date('Y');
        switch($type)
        {
            case 'Q1':
                $query = $this->_link->prepare('SELECT * FROM `acct` WHERE QUARTER(dte)=1 AND YEAR(dte)=:year');
            break;
            case 'Q2':
                $query = $this->_link->prepare('SELECT * FROM `acct` WHERE QUARTER(dte)=2 AND YEAR(dte)=:year');
            break;
            case 'Q3':
                $query = $this->_link->prepare('SELECT * FROM `acct` WHERE QUARTER(dte)=3 AND YEAR(dte)=:year');
            break;
            case 'Q4':
                $query = $this->_link->prepare('SELECT * FROM `acct` WHERE QUARTER(dte)=4 AND YEAR(dte)=:year');
            break;
            case 'HY1':
                $query = $this->_link->prepare('SELECT * FROM acct WHERE QUARTER(dte)=1 OR QUARTER(dte)=2 AND YEAR(dte)=:year');
            break;  
            case 'HY2':
                $query = $this->_link->prepare('SELECT * FROM acct WHERE QUARTER(dte)=3 OR QUARTER(dte)=4 AND YEAR(dte)=:year');
            break;    
            default:
                $query = $this->_link->prepare('SELECT * FROM acct WHERE YEAR(dte)=:year');
            break;
        }
		$query->execute(array(':year' => $year));
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $total = 0;
        
        if ($cate == null)
        {
            
            $obj = $result;
            
            foreach ($result as $i => $v) 
            {
                
                $total = $total + $v->amt;
                $obj[$i]->total = $total;
                $obj[$i]->dte = $this->dateTo_c($v->dte, '-');
            }
            
        }
        else
        {
            $obj = array();
            foreach ($result as $i => $v) 
            {
                if ($v->cate == $cate) 
                {
                    $total = $total + $v->amt;
                    $v->total = $total;
                    $v->dte = $this->dateTo_c($v->dte, '-');
                    array_push($obj, $v);
                }
            }
        }
      
		return $obj;		
	}
    
    public function dateTo_c($in_date, $in_txt="")
    {

        $ch_date = explode("-", $in_date);
        $ch_date[0] = $ch_date[0]-1911;
        $date = '00.00.00';
        if ($in_txt=="")
        {
            $date = '000000';
            if ($ch_date[0] > 0 ) $date = $ch_date[0]."".$ch_date[1]."".$ch_date[2];  
        }
        else
        {
            if ($ch_date[0] > 0 ) $date = $ch_date[0]."$in_txt".$ch_date[1]."$in_txt".$ch_date[2];
        }
        return $date;
    }   
    
	public function ins($dte, $cate, $content, $amt, $uid)
	{
		$query = $this->_link->prepare('INSERT INTO  acct (`dte` ,`cate` ,`content` ,`amt` ,`uid`) VALUES (:dte ,  :cate,  :content,  :amt,  :uid)');
		$query->execute(array(':dte' => htmlspecialchars($dte), ':cate' => htmlspecialchars($cate), ':content' => $content, ':amt' => htmlspecialchars($amt), ':uid' => htmlspecialchars($uid)));
		return;		
	}

	public function del($id)
	{
		$query = $this->_link->prepare('DELETE FROM acct WHERE id=:id');
		$query->execute(array(':id' => $id));
		return;		
	}    
	
    public function __destruct()
    {
        $this->acct = null;
		$this->_link = null;
    }

}