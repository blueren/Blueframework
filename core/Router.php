<?php
/* ======================================== */
// BlueMVC 2.00
// �t�ήج[�}�o : ���a��
// paste.ren@gmail.com
// Copyright c 2014 Jia-Huei Ren & DivStudio. All rights reserved
// �즸�i�J�Х��ק�config.php�ɮ�
// �ФŧR�����q���v�ŧi�A�_�h�̪k�l�s

class Router
{

    public function __construct()
    {
        $this->parseUrl();
		$this->chkName();
    }

    public function getAction()
    {
        return $this->action;
		
    }	
    protected function parseUrl()
    {
		$this->action = $this->getQuery('act', 'index');
    }
	
    protected function chkName()
    {
        if (!preg_match('/[a-z][\-a-z0-9]+/', $this->action)) {
            $this->action = 'index';
        }
    }	
	
    public static function getQuery($name, $default)
    {
        return isset($_GET[$name]) ? strtolower(trim(strip_tags($_GET[$name]))) : $default;
    }
	

}