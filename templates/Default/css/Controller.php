<?php
/* ======================================== */
// BlueMVC 2.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

abstract class Controller
{

    protected $model = '';

    protected abstract function index();
	protected abstract function construct();
    protected $router = NULL;
	
    public function __construct()
    {
		
		$this->setConf();
		$this->construct();
		
	}	

    public function setRouter(Router $router)
    {
        if (method_exists($this, ($action = $router->getAction())))
        {
            $this->action = $action;
			
        }  		
    }

    public final function run()
    {
		
        $this->{$this->action}();
		
    }
    
    protected static function redirectTo($url)
    {
        header('Location: ' . $url);
    }

//mod
	

	public function setConf()
	{

        $this->view = new HtmlView;
        $conf = array(
            'menu'=>array('index_menu.tpl.php'),
            'css'=>array($this->check_tmpl('style','.css'), $this->check_tmpl('css/content','.css')),
            'js'=>array($this->check_tmpl('js/jquery','.js'), $this->check_tmpl('js/charts/highcharts','.js'), $this->check_tmpl('js/charts/modules/data','.js'), $this->check_tmpl('js/charts/modules/drilldown','.js'), $this->check_tmpl('js/charts/modules/exporting','.js'), $this->check_tmpl('js/ckeditor/ckeditor','.js'), $this->check_tmpl('js/jquery.mixitup.min','.js'), $this->check_tmpl('js/content','.js'))
        );        
        

		foreach (explode(",", MODULES) as $i) {
			$this->newClass($i);	
            if ($this->check_tmpl($i,'_menu.tpl.php')!=null) {
                array_push($conf['menu'], $i.'_menu.tpl.php');
            }
			if ($this->check_tmpl('css/'.$i,'.css')!=null) {
				array_push($conf['css'], $this->check_tmpl('css/'.$i,'.css'));
			}
			if ($this->check_tmpl('js/'.$i,'.js')!=null) {
				array_push($conf['js'], $this->check_tmpl('js/'.$i,'.js'));
			} 
		}
        $this->view->setVar('conf', $conf);
        //Set Modules Default
        $this->view->setVar('priv', $this->user->priv());
        $this->view->setVar('username', isset($_SESSION['user']->username)?$_SESSION['user']->username:'');
        $this->view->setVar('menu', $this->page->getList());
        $this->view->setVar('news', $this->news->display());
		$this->view->setVar('sys', $this->member->show($_GET['m']));
        $this->view->setVar('hot', $this->cart->displayHotprod());
        //$this->view->setVar('page', $this->page->getTree());
	}    
    public function check_tmpl($tmpl, $ext)
    {
		if (file_exists(TEMPLATE_PATH.$tmpl.$ext)){
			return TEMPLATE_PATH.'/'.$tmpl.$ext;
		}elseif(file_exists('./templates/Default/'.$tmpl.$ext)){
			return './templates/Default/'.$tmpl.$ext;
		}
    }
	public function newClass($class_name)
	{
        eval("\$this->$class_name = new $class_name;"); 
	}	
    public function chk($priv)
    {
        switch ($priv)
        {
            case 1:
                if ($this->user->priv()<1)
                {
                    $this->redirectTo('index.php?mod=user&act=login');
                    die();
                }
            break;    
            case 2:
                if ($this->user->priv()!=2)
                {
                    $this->redirectTo('index.php?mod=user&act=login');
                    die();
                }
            break;    
        }
    }
    public static function getQuery($name, $default=null)
    {
        if (isset($_GET[$name]) && is_array($_GET[$name])){
            foreach($_GET[$name] as $i => $v){
                $content[$i] =  isset($_GET[$name][$i]) ? strtolower(trim(strip_tags($_GET[$name][$i]))) : $default;
            }
        }else{
            $content = isset($_GET[$name]) ? strtolower(trim(strip_tags($_GET[$name]))) : $default;
        }
        return $content;
    }

	public static function postQuery($name, $default=null)
    {
        if (isset($_POST[$name]) && is_array($_POST[$name])){
            foreach($_POST[$name] as $i => $v){
                $content[$i] =  isset($_POST[$name][$i]) ? $_POST[$name][$i] : $default;
            }
        }else{
            $content = isset($_POST[$name]) ? $_POST[$name] : $default;
        }
        return $content;
    }
	
}