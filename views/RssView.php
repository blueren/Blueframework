<?php

// 輸出 RSS 格式內容
class RssView extends View
{
	
	// 轉換成 RSS 內容
    public function fetch()
    {
        $xml = '';
        $xml .= '<' . '?xml version="1.0" encoding="utf-8"?' . '>' . "\n";
        $xml .= '<rss version="2.0">';
        $xml .= '<channel>';
        $xml .= '<title>TEST</title>';
        $xml .= '<description>TEST</description>';
        foreach ($this->items as $item)
        {
            $xml .= '<item>';
            $xml .= '<title>' . $item['title'] . '</title>';
            $xml .= '<description>' . $item['body'] . '</description>';
            $xml .= '</item>';
        }
        $xml .= '</channel>';
        $xml .= '</rss>';
        return $xml;
    }

    // 輸出
    public function render()
    {
        header('Content-Type: text/xml; charset=utf-8');
        echo $this->fetch();
    }

}
