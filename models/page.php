<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class Page extends Model
{


    public $page;

    public function __construct()
    {
		$this->setDB();
        $this->_link->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
    }
	public function sidebar()
	{
        $obj = new stdClass;
        $obj->admin = array(
            '頁面管理' => 'index.php?mod=page'
        );
        $obj->user = array(
        );
        return $obj;
	}        
    
	public function upd($id, $name, $content, $url, $uid, $display)
	{
        $id = htmlspecialchars($id);
        $name = htmlspecialchars($name);
        $url = htmlspecialchars($url);
        $uid = htmlspecialchars($uid);
        $display = htmlspecialchars($display);
		$query = $this->_link->prepare('UPDATE `page` SET 
        name = :name,
        content = :content,
        url = :url,
        uid = :uid,
        display = :display,
        upd_dte = CURRENT_TIMESTAMP
        WHERE id =:id');
		$query->execute(array(':id' => $id, ':name' => $name, ':content' => $content, ':url' => $url, ':uid' => $uid, ':display' => $display));
        var_dump($query->errorinfo());
	}    
    
    public function show($id)
    {
        $query = $this->_link->prepare('SELECT * FROM page WHERE id=:id');
        $query->execute(array(':id' => $id));    
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    
    public function display()
    {
        $args = func_get_args();
        if (isset($args[0])) {
            $query = $this->_link->prepare('SELECT * FROM page WHERE `author`=:author');
            $query->execute(array(':author' => $args[0]));
        }
        else{
            $query = $this->_link->prepare('SELECT * FROM page');
            $query->execute(); 
        }
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getTree($id)
    {
        $query = $this->_link->prepare('SELECT `id` FROM page WHERE `parent`=:parent');
        $query->execute(array(':parent' => $id));
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        $arr = array();
        if (!empty($result)){    
            foreach ($result as $i => $v) {
                array_push($arr, $this->parseId($v->id), $this->getchild($v->id));                
            }    
        }
        return array_filter($arr);

    }

    
    public function getMenu($id, $depth)
    {
        $query = $this->_link->prepare('
            SELECT node.*, (COUNT(parent.name) - (sub_tree.depth + 1)) AS depth
            FROM page AS node,
                    page AS parent,
                    page AS sub_parent,
                    (
                            SELECT node.name, (COUNT(parent.name) - 1) AS depth
                            FROM page AS node,
                                    page AS parent
                            WHERE node.lft BETWEEN parent.lft AND parent.rgt
                                    AND node.id = :id
                            GROUP BY node.name
                            ORDER BY node.lft
                    )AS sub_tree
            WHERE node.lft BETWEEN parent.lft AND parent.rgt
                    AND node.lft BETWEEN sub_parent.lft AND sub_parent.rgt
                    AND sub_parent.name = sub_tree.name
            GROUP BY node.name
            HAVING depth = :depth
            ORDER BY node.lft;      
        ');
        $query->execute(array(':id' => $id, ':depth' => $depth));
        $result = $query->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }

    public function getList()
    {
        $obj = $this->getMenu(1, 1);
        foreach ($obj as $i => $v)
        {
            $obj[$i]->sub = $this->getMenu($v->id, 1);
            foreach ($obj[$i]->sub as $j => $k)
            {            
                $obj[$i]->sub[$j]->sub = $this->getMenu($k->id, 1);
            }
        }
        usort($obj, array('page','sort_by_display'));
        return $obj;
    }
    public static function sort_by_display($a, $b)
    {
        if($a->display == $b->display) return 0;
        return ($a->display > $b->display) ? 1 : -1;
    }    
    public function ins($cate, $name, $content, $url=null, $uid, $display)
    {
        $cate = htmlspecialchars($cate);
        $name = htmlspecialchars($name);
        $url = htmlspecialchars($url);
        $uid = htmlspecialchars($uid);
        $display = htmlspecialchars($display);
        
        $query = $this->_link->prepare('
        
        LOCK TABLE page WRITE;

        SELECT @myLeft := lft FROM page

        WHERE id = :cate;

        UPDATE page SET rgt = rgt + 2 WHERE rgt > @myLeft;
        UPDATE page SET lft = lft + 2 WHERE lft > @myLeft;

        INSERT INTO page(name, content, url, uid, display, upd_dte, lft, rgt) VALUES(:name, :content, :url, :uid, :display, CURRENT_TIMESTAMP, @myLeft + 1, @myLeft + 2);

        UNLOCK TABLES;
        
        ');
        $query->execute(array(':cate' => $cate, ':name' => $name, ':content' => $content, ':url' => $url, ':uid' => $uid, ':display' => $display));
        
        var_dump($query->errorinfo());
    }   

    
    public function ins2($cate, $name, $content, $url, $uid, $display)
    {
        $cate = htmlspecialchars($cate);
        $name = htmlspecialchars($name);
        $url = htmlspecialchars($url);
        $uid = htmlspecialchars($uid);
        $display = htmlspecialchars($display);        
        $query = $this->_link->prepare(' 
        LOCK TABLE page WRITE;

        SELECT @myRight := rgt FROM page
        WHERE id = :cate;

        UPDATE page SET rgt = rgt + 2 WHERE rgt > @myRight;
        UPDATE page SET lft = lft + 2 WHERE lft > @myRight;

        INSERT INTO page(name, content, url, uid, display, upd_dte, lft, rgt) VALUES(:name, :content, :url, :uid, :display, CURRENT_TIMESTAMP, @myRight + 1, @myRight + 2);

        UNLOCK TABLES;     
        ');
        $query->execute(array(':cate' => $cate, ':name' => $name, ':content' => $content, ':url' => $url, ':uid' => $uid, ':display' => $display));
        var_dump($query->errorinfo());
    }      
    
    public function del($id)
    {
        $query = $this->_link->prepare('
        LOCK TABLE page WRITE;

        SELECT @myLeft := lft, @myRight := rgt, @myWidth := rgt - lft + 1
        FROM page
        WHERE id = :id;

        DELETE FROM page WHERE lft BETWEEN @myLeft AND @myRight;

        UPDATE page SET rgt = rgt - @myWidth WHERE rgt > @myRight;
        UPDATE page SET lft = lft - @myWidth WHERE lft > @myRight;

        UNLOCK TABLES;
        ');
        $query->execute(array(':id' => $id));
    }
    
    public function reduceOrder($arr, &$rt) {
        if (is_array($arr)) {
            foreach ($arr as $v) {
                if (is_array($v)) {
                    $this->reduceOrder($v, $rt);
                } else {
                    $rt[] = $v;
                }
            }
        }
        return $rt;
    }
         
    public function parseName($name)
    {
        $query = $this->_link->prepare('SELECT `id` FROM page WHERE `title`=:title');
        $query->execute(array(':title' => $name));
        $result = $query->fetchAll(PDO::FETCH_OBJ);
    }
    
    public function parseId($id)
    {
        $query = $this->_link->prepare('SELECT * FROM page WHERE `id`=:id');
        $query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);
        return $result;
    }
    
    public function __destruct()
    {
        $this->page = null;
		$this->_link = null;
    }

}