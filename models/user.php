<?php
/* ======================================== */
// BlueMVC 用戶模組 1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */
class User extends Model
{


    public $user;

    public function __construct()
    {
		$this->setDB();
    }
	public function sidebar()
	{
        $obj = new stdClass;
        $obj->admin = array(
        '會員管理' => 'index.php?mod=user&act=userManage'
        );
        $obj->user = array(
        '更新基本資料' => 'index.php?mod=user&act=upd',
        '收件夾' => 'index.php?mod=user&act=msgbox'
        );
        return $obj;
	}   
	public function show($id)
	{
        $args = func_get_args();
		if (isset($args[1])) {
            $password = $args[1];
			$query = $this->_link->prepare('SELECT * FROM  `user` WHERE `id`= :id AND `password`= :pw');
			$query->execute(array(':id' => $id, ':pw' =>$password));
			$result = $query->fetch(PDO::FETCH_OBJ);		
		}
		else{
			$query = $this->_link->prepare('SELECT * FROM  `user` WHERE `id`= :id');
			$query->execute(array(':id' => $id));
			$result = $query->fetch(PDO::FETCH_OBJ);		
		}
		
		return $result;		
	}
	public function autolog()
    {
        $check=0;
        $cookie = isset($_COOKIE['auth']) ? $_COOKIE['auth'] : null;
        $now = time();
        if (isset($cookie))
        {
            list($identifier, $cookie_token) = explode(':', $cookie);
            $query = $this->_link->prepare('SELECT * FROM  `user` WHERE  identifier = :identifier AND token = :token');
            $query->execute(array(':identifier' => $identifier, ':token' => $cookie_token));
            $result = $query->fetch(PDO::FETCH_OBJ);

            if(isset($result->id) && ($now < $result->timeout)){
                $_SESSION['user'] = $result;
                unset($_SESSION['user']->password);
                $check=1;	
            }else
            {
                $this->logout();
            }
        }
        return $check;
    }
	public function login($username, $password, $token, $remember)
	{

        $check=0;
        var_dump($_SESSION['token']);
        var_dump('</br>');
        var_dump($token);
        if (isset($_SESSION['token'][0]) && $token == $_SESSION['token'][0])
        {
            
            if ($remember === 'on')
            {
                $this->set_remember($username, $password);
            }
            $query = $this->_link->prepare('SELECT * FROM  `user` WHERE  (`username` =  :username AND  `password` =  :password)');
            $query->execute(array(':username' => $username, ':password' =>$password));
            $result = $query->fetch(PDO::FETCH_OBJ);
            if(isset($result->id)){
                echo "<pre>";
                var_dump($_SESSION);
                echo "</pre>";
                $_SESSION['user'] = $result;
                unset($_SESSION['user']->password);
                $check=1;	
            }
        }
		return $check;
	}
	
	public function priv()
	{
		return (isset($_SESSION['user']->type))?(($_SESSION['user']->type==99)?2:1):0;
	}
	
	public function logout()
	{
		if(isset($_SESSION['user']->id)){
            $token = md5(uniqid(rand(), TRUE));
            $query = $this->_link->prepare('UPDATE user SET token = :token, timeout = :timeout WHERE identifier = :identifier');
            $query->execute(array(':identifier' => $_SESSION['user']->identifier, ':token' => $token, ':timeout' => null));  
            session_destroy();
            setcookie('auth', 'DELETED!', time());
			return;
		}
	}
	
	public function send($sender,$receive,$title,$message)
	{
        $sender =  htmlspecialchars($sender);
        $receive =  htmlspecialchars($receive);
        $title =  htmlspecialchars($title);
        $message =  htmlspecialchars($message);
        $arr = array();
        $isread = null;
        foreach ($this->cut($receive) as $i=> $obj){
            $id = $this->parseName(trim($obj));
            if (!empty($id)){
                array_push($arr, $id);
                $isread .= ',0';    
            }
        }
        $isread = substr($isread,1);
		$receive = $this->combine($arr);
		$query = $this->_link->prepare('INSERT INTO `message` (`messageid` ,`send` ,`receive` ,`title` ,`message` ,`posttime` ,`isread`)
		VALUES (NULL ,  :username,  :receive,  :title,  :message,  CURRENT_TIMESTAMP, :isread);');
		$query->execute(array(':username' => $sender->id, ':receive' =>$receive, ':title' =>$title, ':message' =>$message, ':isread' => $isread));
        var_dump($query->errorinfo());
		return;
	}
    public function set_remember($username, $password)
    {
        $identifier = md5(SALT . md5($username . SALT));
        $token = md5(uniqid(rand(), TRUE));
        $timeout = time() + 60 * 60 * 24 * 7;
		$query = $this->_link->prepare('UPDATE user SET identifier = :identifier, token = :token, timeout = :timeout WHERE username = :username AND password = :password');
		$query->execute(array(':username' => $username, ':password' => $password, ':identifier' => $identifier, ':token' => $token, ':timeout' => $timeout));
        setcookie('auth', "$identifier:$token", $timeout);    
    }
    // public function remember_me($username)
    // {
        // list($identifier, $token) = explode(':', $_COOKIE['auth']);

        // if (ctype_alnum($identifier) && ctype_alnum($token))
        // {
          // $clean['identifier'] = $this->identifier;
          // $clean['token'] = $this->token;
        // }
            
        // $clean = array();
        // $mysql = array();
        // var_dump($_COOKIE['auth']);
        // $now = time();
        // $salt = SALT;

        // list($this->identifier, $this->token) = explode(':', $_COOKIE['auth']);

        // if (ctype_alnum($this->identifier) && ctype_alnum($this->token))
        // {
          // $clean['identifier'] = $this->identifier;
          // $clean['token'] = $this->token;
        // }
        // else
        // {
          // /* ... */
        // }

        // $mysql['identifier'] = $clean['identifier'];


        // $query = $this->_link->prepare('SELECT username, token, timeout FROM user WHERE  identifier = :identifier');       
        // $query->execute(array(':identifier' => $mysql['identifier']));
        // $record = $query->fetch(PDO::FETCH_ASSOC);
        // var_dump('clean: '.$clean['identifier']);
        // var_dump('record: '.$record['token']);        
        // if ($clean['token'] != $record['token'])
        // {
          // /* Failed Login (wrong token) */
          // var_dump('/* Failed Login (wrong token) */');
        // }
        // elseif ($now > $record['timeout'])
        // {
          // /* Failed Login (timeout) */
            // var_dump('/* Failed Login (timeout) */');
        // }
        // elseif ($clean['identifier'] !=
                // md5($salt . md5($record['username'] . $salt)))
        // {
          // /* Failed Login (invalid identifier) */
          // var_dump('/* Failed Login (invalid identifier) */');
        // }
        // else
        // {
          // /* Successful Login */
          // var_dump('/* Successful Login */');
        // }
    
    // }
	public function receive($receive)
	{
		$query = $this->_link->prepare('SELECT * FROM `message` WHERE `receive` LIKE :receive');
		$query->execute(array(':receive' => '%'.$receive->id.'%'));
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		foreach ($result as $i => $obj){
            $isread[$i]=$this->cut($result[$i]->isread);
            foreach ($this->cut($obj->receive) as $j=>$v){
                if ($v==$receive->id){
                    $result[$i]->isread = $isread[$i][$j];
                }
            }
			$result[$i]->username = $this->parseID($obj->send);
		}
        
		return $result;	
	}	

	public function msg_det($receive, $id)
	{
		$query = $this->_link->prepare('SELECT * FROM `message` WHERE `receive` LIKE :receive AND `messageid`=:messageid');
		$query->execute(array(':receive' => '%'.$receive->id.'%', ':messageid' => $id));
		$result = $query->fetch(PDO::FETCH_OBJ);
		$result->username = $this->parseID($result->send);
        $arr = array();
        foreach ($this->cut($result->receive) as $i=> $obj){
            array_push($arr, $this->parseID(trim($obj)));
        }
		$result->receivename = $this->combine($arr);
		return $result;	
	}	

	public function msg_del($receive, $id)
	{
        $query = $this->_link->prepare('SELECT `receive`, `isread` FROM `message` WHERE `receive` LIKE :receive AND `messageid`=:messageid');
		$query->execute(array(':receive' => '%'.$receive->id.'%', ':messageid' => $id));
		$result = $query->fetch(PDO::FETCH_OBJ);
        $arr = $this->cut($result->receive);
        $isread = $this->cut($result->isread);
        if (strpos ($result->receive, ',')) {
            foreach ($arr as $i => $v) {
                if ($v==$receive->id) {
                    unset($arr[$i]);
                    unset($isread[$i]);
                }
            }
            $result->receive = $this->combine($arr);
            $result->isread = $this->combine($isread);
            $query = $this->_link->prepare('UPDATE `message` SET `receive` = :st, `isread` = :isread WHERE `receive` LIKE :receive AND `messageid` =:messageid');
            $query->execute(array(':st' => $result->receive, ':isread' => $result->isread,':receive' => '%'.$receive->id.'%', ':messageid' => $id));  
        }else{    
            $query = $this->_link->prepare('DELETE FROM `message` WHERE `receive`=:receive AND `messageid` = :messageid');
            $query->execute(array(':receive' => $receive->id, ':messageid' => $id));
        }
		return $result;	
	}
	
	public function isread($receive, $id)
	{
        $query = $this->_link->prepare('SELECT * FROM `message` WHERE `receive` LIKE :receive AND `messageid`=:messageid');
        $query->execute(array(':receive' => '%'.$receive->id.'%', ':messageid' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);
        $isread = $this->cut($result->isread);
        foreach ($this->cut($result->receive) as $i => $obj){           
            if ($obj==$receive->id && $isread[$i]==0){
                $isread[$i] = 1;
            }else{
                $isread[$i] = 0;
            }
        }
        $st = $this->combine($isread);
        $query = $this->_link->prepare('UPDATE `message` SET `isread` = :st WHERE `receive` LIKE :receive AND `messageid` =:messageid');
        $query->execute(array(':st' => $st, ':receive' => '%'.$receive->id.'%', ':messageid' => $id));          
		return;	
	}		
	public function display()
	{
		$query = $this->_link->prepare('SELECT * FROM `user`');
		$query->execute();
		$result = $query->fetchAll(PDO::FETCH_OBJ);
		return $result;		
	}
	public function ins($user, $pw, $name, $gender, $birthday, $addr, $tel, $email, $ip, $type)
	{
        $user = htmlspecialchars($user);
        $pw = htmlspecialchars($pw);
        $name = htmlspecialchars($name);
        $gender = htmlspecialchars($gender);
        $birthday = htmlspecialchars($birthday);
        $addr = htmlspecialchars($addr);
        $tel = htmlspecialchars($tel);
        $email = htmlspecialchars($email);
        $ip = htmlspecialchars($ip);
        $type = htmlspecialchars($type);

		$query = $this->_link->prepare('INSERT INTO `user` (`username`, `password`, `name`, `gender`, `birthday`, `address`, `tel`, `email`, `ip`, `reg_dte`, `type`) 
        VALUES (:user, :pw, :name, :gender, :birthday, :addr, :tel, :email, :ip, CURRENT_TIMESTAMP, :type)');
		$query->execute(array(':user' => $user, ':pw' => $pw, ':name' => $name, ':gender' => $gender, ':birthday' => $birthday, ':addr' => $addr, ':tel' => $tel, ':email' => $email, ':ip' => $ip, ':type' => $type));
		var_dump($query->errorinfo());
        return $result;		
	}
	public function upd($id, $name, $addr, $tel, $email, $ip, $type)
	{
        $id = htmlspecialchars($id);
        $name = htmlspecialchars($name);
        $addr = htmlspecialchars($addr);
        $tel = htmlspecialchars($tel);
        $email = htmlspecialchars($email);
        $ip = htmlspecialchars($ip);
        $type = htmlspecialchars($type);
        
		$query = $this->_link->prepare('UPDATE user SET name =:name, address =:addr, tel =:tel, email =:email, ip =:ip, type =:type WHERE `id` = :id');
		$query->execute(array(':id' => $id, ':name' => $name, ':addr' => $addr, ':tel' => $tel, ':email' => $email, ':ip' =>$id, ':type' => $type));
	}    
	public function updPassword($pw, $npw, $id)
	{
        $pw = htmlspecialchars($pw);
        $npw = htmlspecialchars($npw);
        $id = htmlspecialchars($id);
        
		$query = $this->_link->prepare('UPDATE `user` SET `password` = :npw WHERE `id` = :id AND `password` =:pw');
		$query->execute(array(':pw' => $pw, ':npw' => $npw, ':id' => $id));
        $query = $this->_link->prepare('SELECT `password` FROM `user` WHERE `id` = :id');
        $query->execute(array(':id' => $id));
        $result = $query->fetch(PDO::FETCH_OBJ);
        if ($result->password == $npw) {
            return '修改成功';
        }else{
            return '請輸入新密碼';  
        }			
	}
	public function delUser($id)
	{
		$query = $this->_link->prepare('DELETE FROM user WHERE id =:id');
		$query->execute(array(':id' => $id));
        var_dump($query->errorinfo());
	}

	public function encrypt($var)
	{
		$encode=$var.SALT.substr($var,3).SALT;
		return md5($encode);
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
    
	public function parseName($var)
	{
		$query = $this->_link->prepare('SELECT * FROM  `user` WHERE  `username` =  :username');
		$query->execute(array(':username' => $var));
		$result = $query->fetch(PDO::FETCH_OBJ);
		if (isset($result->id)) return $result->id;
	}	

	public function parseID($var)
	{
		$query = $this->_link->prepare('SELECT * FROM  `user` WHERE  `id` =  :id');
		$query->execute(array(':id' => $var));
		$result = $query->fetch(PDO::FETCH_OBJ);
        if (isset($result->username)) return $result->username;
	}		
	
    public function __destruct()
    {
        $this->user = null;
		$this->_link = null;
    }

}