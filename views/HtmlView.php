<?php

// 輸出 HTML 格式內容
class HtmlView extends View
{

    // 取得樣版並解析
    public function fetch()
    {
        $args = func_get_args();
        $template_filename = $args[0];
        
        $html = null;
        ob_start();
        if (file_exists(TEMPLATE_PATH .'/'. $template_filename)){
            include TEMPLATE_PATH .'/'. $template_filename;
        }elseif(file_exists($template_filename)){
            include $template_filename;
        }elseif(file_exists('./templates/Default/'.$template_filename)){
            include './templates/Default/'.$template_filename;
        }elseif(file_exists('./templates/'.$template_filename)){
            include './templates/'.$template_filename;
        }
        $html = ob_get_contents();
        ob_end_clean();

        return $html;
        
    }
    
    public function MinHtml($str) 
    { 
        $search = array(">\t", ">\r\n", ">\r", ">\n", ">        ");
        $str = trim($str); 
        $str = str_replace($search ,'>',$str); 
        return $str; 
    }
    
    // 輸出
    public function render()
    {
        // 因為 View 類別的 render 函式沒有參數
        // 所以 render 要自行取得
    
            $args = func_get_args();
            $template_filename = $args[0];
            header('Content-Type: text/html; charset=utf-8');
            echo $this->fetch($template_filename);
      
    }

}
