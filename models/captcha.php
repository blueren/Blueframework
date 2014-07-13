<?php
/* ======================================== */
// BlueMVC 相簿模組1.00
// 系統框架開發 : 任家輝
// paste.ren@gmail.com
// Copyright © 2014 Jia-Huei Ren & DivStudio. All rights reserved
// 初次進入請先修改config.php檔案
// 請勿刪除此段版權宣告，否則依法追究
/* ======================================== */

// 相簿類別
class Captcha
{
	private $captcha;
    public function __construct()
    {
		
    }
	public function chknum() {
		$code = trim($_POST['code']); 
		if($code==$_SESSION["capcode"]){ 
		   echo '1'; 
		} 
	}
	public function generate_cap() {
		switch (rand(0, 2)) {
			case 0:
				$this->getCode(rand(1, 2)); 
				break;
			case 1:
				$this->getCH(rand(3, 7)); 
				break;
			case 2:
				$this->getCH1(4); 
				break;
		}
	}
	public function getCode($num) { 
		$code = ""; 
		for ($i = 0; $i < $num; $i++) { 
			$code .= rand(0, 9); 
		} 
		for ($i = 0; $i < $num; $i++) { 
			$code2 .= rand(0, 9); 
		} 
		$method = rand(0, 2);
		switch ($method) {
			case 0:
				$_SESSION["capcode"] = $code+$code2; 
				$cap = $code."+".$code2;
				break;
			case 1:
				$_SESSION["capcode"] = $code-$code2; 
				$cap = $code."-".$code2;
				break;
			case 2:
				$_SESSION["capcode"] = $code*$code2; 
				$cap = $code."x".$code2;
				break;
		}
		
		//4位驗證碼也可以用rand(1000,9999)直接生成 
		//將生成的驗證碼寫入session，備驗證時用 
		//$_SESSION["capcode"] = $code+$code2; 
		//創建圖片，定義顏色值 
		header("Content-type: image/PNG"); 
		$im = imagecreate($num * 20+20, 30); 
		$black = imagecolorallocate($im, 0, 0, 0); 
		$green = imagecolorallocate($im, 0, 255, 0); 
		$tcolor = imagecolorallocate($im, rand(0, 255), rand(0, 255), rand(0, 255)); 
		$gray = imagecolorallocate($im, 200, 200, 200); 
		$bgcolor = imagecolorallocate($im, 255, 255, 255); 
		//填充背景 
		imagefill($im, 0, 0, $gray); 
	 
		//畫邊框 
		imagerectangle($im, 0, 0, $num * 20+20-1, 30-1, $black); 
	 
		//隨機繪制兩條虛線，起幹擾作用 
		$style = array ($black,$black,$black,$black,$black, 
			$gray,$gray,$gray,$gray,$gray 
		); 
		imagesetstyle($im, $style); 
		$y1 = rand(0, 30); 
		$y2 = rand(0, 30); 
		$y3 = rand(0, 30); 
		$y4 = rand(0, 30); 
		imageline($im, 0, $y1, $num * 20+20-1, $y3, IMG_COLOR_STYLED); 
		imageline($im, 0, $y2, $num * 20+20-1, $y4, IMG_COLOR_STYLED); 
	 
		//在畫布上隨機生成大量黑點，起幹擾作用; 
		for ($i = 0; $i < 80; $i++) { 
			imagesetpixel($im, rand(0, $num * 20+20), rand(0, 30), $black); 
		} 
		//將數字隨機顯示在畫布上,字符的水平間距和位置都按一定波動範圍隨機生成 
		$strx = rand(3, 8); 
		for ($i = 0; $i < ($num*2)+1; $i++) { 
			$strpos = rand(1, 6); 
			imagestring($im, 5, $strx, $strpos, substr($cap, $i, 1), $green); 
			$strx += rand(8, 12); 
		} 
		imagepng($im);//輸出圖片 
		imagedestroy($im);//釋放圖片所占內存 
	} 
	public function getCH($num) { 
		mt_srand((double)microtime()*1000000);
		$code = '';
		$possible = '0123456789'; //放入阿拉伯數字
		$possibleLen=strlen($possible);
		$chinese=array('零','壹','貳','參','肆','伍','陸','柒','捌','玖');//相對應的 中文數字
		$show='';
		for($i=0; $i< $num; $i++){//產生驗證碼
			$code .=$possible[rand(0,$possibleLen-1)];
		}
		$_SESSION['capcode'] = $code; //存入資料，之後要使用 就用這個SESSION
		for($i=0; $i< $num; $i++)//轉換成中文字
		{
			$show.=$chinese[$code[$i]];
		}
		$width=$num * 20+20;
		$height=30;
		$image = imagecreate($width, $height) or die('GD image creating error.');//產生一塊圖
		$background_color = imagecolorallocate($image, 239, 239, 239); //設定底色
		$text_color = imagecolorallocate($image, 0, 169, 225);//設定文字顏色
		$noise_color = imagecolorallocate($image, 200, 200, 200);//設定雜訊顏色
		imagefill($image,0,0,$background_color);
		imagettftext($image,15,0,10,20,$text_color,'./models/msjhbd.ttc',$show);
		for ($i=0; $i<($width*$height)/250; $i++) {//產生雜訊
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		header("Content-Disposition:filename=image_code.png");
		header("Content-type:image/png");
		imagepng($image);
		imagedestroy($image);
		exit;
	}
	public function getCH1($num) { 
		mt_srand((double)microtime()*1000000);
		$code = '';
		$chinese=array('平易近人','寬宏大度','冰清玉潔','持之以恒','鍥而不舍',
		'大義凜然','臨危不俱','光明磊落','不屈不撓','鞠躬盡瘁',
		'料事如神','足智多謀','融會貫通','學貫中西','博古通今', 
		'才華橫溢','出類拔萃','博大精深','集思廣益','舉一反三', 
		'憨態可掬','文質彬彬','風度翩翩','相貌堂堂','落落大方', 
		'鬥誌昂揚','意氣風發','威風凜凜','容光煥發','神采奕奕', 
		'悠然自得','眉飛色舞','喜笑顏開','神采奕奕','欣喜若狂', 
		'呆若木雞','喜出望外','垂頭喪氣','無動於衷','勃然大怒', 
		'能說會道','巧舌如簧','能言善辯','滔滔不絕','伶牙俐齒', 
		'出口成章','語驚四座','娓娓而談','妙語連珠','口若懸河', 
		'三顧茅廬','鐵杵成針','望梅止渴','完璧歸趙','四麵楚歌', 
		'負荊請罪','精忠報國','手不釋卷','懸梁刺股','鑿壁偷光', 
		'走馬觀花','歡呼雀躍','扶老攜幼','手舞足蹈','促膝談心', 
		'前俯後仰','奔走相告','跋山涉水','前赴後繼','張牙舞爪', 
		'恩重如山','深情厚誼','手足情深','形影不離','血濃於水', 
		'誌同道合','風雨同舟','赤誠相待','肝膽相照','生死相依',
		'循序漸進','日積月累','溫故知新','勤能補拙','笨鳥先飛', 
		'學無止境','學海無涯','滴水穿石','發奮圖強','開卷有益', 
		'自相矛盾','濫竽充數','畫龍點睛','刻舟求劍','守株待兔', 
		'葉公好龍','亡羊補牢','畫蛇添足','掩耳盜鈴','買櫝還珠', 
		'無懈可擊','銳不可當','雷厲風行','震耳欲聾','驚心動魄', 
		'鋪天蓋地','勢如破竹','氣貫長虹','萬馬奔騰','如履平地', 
		'春寒料峭','春意盎然','春暖花開','滿園春色','春華秋實', 
		'春風化雨','驕陽似火','暑氣蒸人','烈日炎炎','秋風送爽', 
		'秋高氣爽','秋色宜人','冰天雪地','寒氣襲人','寒冬臘月', 
		'濟濟一堂','熱火朝天','門庭若市','萬人空巷','座無虛席', 
		'高朋滿座','如火如荼','蒸蒸日上','欣欣向榮','川流不息', 
		'美不勝收','蔚為壯觀','富麗堂皇','金碧輝煌','玉宇瓊樓', 
		'美妙絕倫','巧奪天工','錦上添花','粉妝玉砌','別有洞天', 
		'錦繡河山','高聳入雲','水天一色','波光粼粼','湖光山色', 
		'重巒疊嶂','山明水秀','高山流水','白練騰空','煙波浩渺',
		'繁花似錦','綠草如茵','鬱鬱蔥蔥','古樹參天','萬木爭榮', 
		'百花齊放','花團錦簇','萬紫千紅','桃紅柳綠','綠樹成蔭', 
		'大雨如注','滂沱大雨','銀裝素裹','皓月千裏','晨光熹微', 
		'雲霧迷蒙','風清月朗','春風化雨','暴風驟雨','風馳電掣', 
		'興國安邦','翻山越嶺','百依百順','背井離鄉','長籲短歎', 
		'道聽途說','丟盔棄甲','調兵遣將','甜言蜜語','眼疾手快', 
		'東倒西歪','南轅北轍','前赴後繼','前俯後繼','左推右擋', 
		'承前啟後','舍近求遠','揚長避短','棄舊圖新','優勝劣汰', 
		'廢寢忘食','死而後已');//相對應的成語
		$show='';
		$show=$chinese[rand(0,count($chinese))];
		$_SESSION['capcode'] = $show; //存入資料，之後要使用 就用這個SESSION
		$width=$num * 20+20;
		$height=30;
		$image = imagecreate($width, $height) or die('GD image creating error.');//產生一塊圖
		$background_color = imagecolorallocate($image, 239, 239, 239); //設定底色
		$text_color = imagecolorallocate($image, 0, 169, 225);//設定文字顏色
		$noise_color = imagecolorallocate($image, 200, 200, 200);//設定雜訊顏色
		imagefill($image,0,0,$background_color);
		imagettftext($image,15,0,10,20,$text_color,'./models/msjhbd.ttc',$show);
		for ($i=0; $i<($width*$height)/250; $i++) {//產生雜訊
			imageline($image, mt_rand(0,$width), mt_rand(0,$height), mt_rand(0,$width), mt_rand(0,$height), $noise_color);
		}
		header("Content-Disposition:filename=image_code.png");
		header("Content-type:image/png");
		imagepng($image);
		imagedestroy($image);
		exit;
	}
}	
?>