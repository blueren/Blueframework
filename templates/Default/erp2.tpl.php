<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>

<?php case 'index': ?>
<script>
$(function(){
$('#Grid').mixitup();
});

</script>
            <div class='row'>
                <div class='col-md-7 video'>
                    <div class='video-container'>
                             <iframe src='http://www.youtube.com/embed/LyyzDSl-NRc?rel=0' frameborder='0' width='560' height='315'></iframe>
                    </div>            
                </div>
                <div class='col-md-5'>
                    <ul class='nav nav-tabs' style='margin-bottom: 15px;'>
                      <li class='active'><a href='#intro' data-toggle='tab'>介紹</a></li>
                      <li class=''><a href='#cate' data-toggle='tab'>毛巾的種類</a></li>
                      <li class=''><a href='#how' data-toggle='tab'>如何辨識好毛巾</a></li>
                    </ul>
                    <div id='myTabContent' class='tab-content'>
                      <div class='tab-pane fade active in' id='intro'>
                        <p>毛巾家族的製造者，與使用者，是一體的。供應鏈的順暢，要建立在互信的基礎上。我們珍惜著份緣，希望能洗去您身上的汙垢，更希望能洗去心中的蒙塵。</p>             
                      </div>
                      <div class='tab-pane fade' id='cate'>
                        <p>毛巾產品種類繁多，依用途分為：浴巾、擦臉巾，乾髮巾，廚用毛巾、海灘巾、兒童毛巾、空調房用巾等；依款式分為：螺旋、割绒、素色、印花，還可以加上緞檔、緞邊、繡花、貼花、排須、鑲嵌等多種工藝手段，好的毛巾用料考究，縫邊精細，精緻耐看耐用。</p>
                      </div>
                      <div class='tab-pane fade' id='how'>
                        <p>高品質毛巾開始使用後會越洗越厚，因為棉紗密度高，吸水後會膨脹，反而會比較厚，不像一般毛巾，一洗就掉毛、退色，而且會越洗越薄。 改成下水後會蓬鬆柔軟</p>
                      </div>
                    </div>
                </div>                
            </div>
            <hr>
			<div class='controls'>	
				<h3>分類</h3>
				<ul>
                    <li class='filter' data-filter='category_2'><a href='index.php?mod=cart&act=productList&cid=2'>毛巾</a></li>
                    <li class='filter' data-filter='category_3'><a href='index.php?mod=cart&act=productList&cid=3'>方巾</a></li>
                    <li class='filter' data-filter='category_4'><a href='index.php?mod=cart&act=productList&cid=4'>浴巾</a></li>
                    <li class='filter' data-filter='category_5'><a href='index.php?mod=cart&act=productList&cid=5'>童巾</a></li>
                    <li class='filter' data-filter='category_6'><a href='index.php?mod=cart&act=productList&cid=6'>嬰兒棉織用品</a></li>
                    <li class='filter' data-filter='category_7'><a href='index.php?mod=cart&act=productList&cid=7'>精緻竹炭系列</a></li>
                    <li class='filter' data-filter='all'><a href='index.php?mod=cart&act=productList'>更多</a></li>
				</ul>
                <hr>
              
			</div>
			<ul id='Grid'>
                <?php foreach($this->obj as $v): ?>
				<li class='mix category_<?php echo $v->cid; ?>' data-cat='<?php echo $v->cid; ?>' data-price='<?php echo $v->price; ?>' data-start='<?php echo $v->start_dte; ?>'>
                <a href='index.php?mod=cart&act=product&id=<?php echo $v->id; ?>'><img src='<?php echo $v->img1; ?>' alt='<?php echo $v->title; ?>' title='<?php echo $v->title; ?>' /></a>
                <?php echo $v->title; ?>
                </li>
                <?php endforeach; ?>   
			</ul>
            


<?php break; ?>

<?php case 'insCate': ?>   
<form method='POST' action='?mod=cart&act=exe_insCate'>
<p><label for='title'>類別名稱</label><input type='text' name='title' /></p>
<p><label for='content'>描述</label><textarea class='ckeditor' name='content'></textarea></p>
<p><input type='submit' value='新增分類' /></p>
</form>
<?php break; ?>

<?php case 'insProduct': ?>   
<form method='POST' action='?mod=cart&act=exe_insProduct' enctype='multipart/form-data'>
<table class='responsive'>
    <tr>
        <td>產品名稱</td>
        <td>
            <label for='title'>品名</label>
            <select name='cid'>
                <option value='0'>預設</option>
                <?php foreach($this->cate as $cate) : ?>
                <option value='<?php echo $cate->id; ?>'><?php echo $cate->title; ?></option>
                <?php endforeach; ?>
            </select>
            <input type='text' name='title' />        
        </td>
        <td><label for='price'>價格</label></td>
        <td><input type='number' name='price' /></td>
    </tr>
    <tr>
        <td><label for='id'>編號</label></td>
        <td><input type='text' name='id' /></td>
        <td><label for='cost'>成本</label></td>
        <td><input type='number' name='cost' /></td>
    </tr>
    <tr>
        <td><label for='size'>規格</label></td>
        <td><input type='text' name='size' /></td>
        <td><label for='qty'>數量</label></td>
        <td><input type='number' name='qty' /></td>
    </tr>
    <tr>
        <td><label for='weight'>重量</label></td>
        <td><input type='text' name='weight' /></td>
        <td><label for='start_dte'>上架時間</label></td>
        <td><input type='date' name='start_dte' /></td>
    </tr>
    <tr>
        <td><label for='unit'>單位</label></td>
        <td><input type='text' name='unit' /></td>
        <td><label for='end_dte'>下架時間</label></td>
        <td><input type='date' name='end_dte' /></td>
    </tr>  
</table>
<p><label for='img1'>上傳圖片1</label><input type='file' name='img1' /><label for='img1_fix'>最大寬度</label><input type='number' value='130' name='img1_fix' /></p> 
<p><label for='img2'>上傳圖片2</label><input type='file' name='img2' /><label for='img2_fix'>最大寬度</label><input type='number' value='400' name='img2_fix' /></p>
<p><label for='img3'>上傳圖片3</label><input type='file' name='img3' /><label for='img3_fix'>最大寬度</label><input type='number' value='345' name='img3_fix' /></p>

<p><label for='content'>描述</label><textarea class='ckeditor' name='content'></textarea></p>
<p><input type='submit' value='新增產品' /></p>
</form>
<?php break; ?>

<?php case 'updCate': ?>   
<form method='POST' action='?mod=cart&act=exe_updCate&id=<?php echo $this->obj->id; ?>'>
<p><label for='title'>類別名稱</label><input type='text' name='title' value='<?php echo $this->obj->title; ?>'/></p>
<p><label for='content'>描述</label><textarea class='ckeditor' name='content'><?php echo $this->obj->content; ?></textarea></p>
<p><input type='submit' value='新增分類' /></p>
</form>
<?php break; ?>

<?php case 'updProduct': ?>

<form method='POST' action='?mod=cart&act=exe_updProduct&id=<?php echo $this->obj->id; ?>' enctype='multipart/form-data'>
<table class='responsive'>
    <tr>
        <td>產品名稱</td>
        <td>
            <label for='title'>品名</label>
            <select name='cid'>
                <option value='0'>預設</option>
                <?php foreach($this->cate as $cate) : ?>
				<?php if ($this->obj->cid==$cate->id): ?>
                <option selected value='<?php echo $cate->id; ?>'><?php echo $cate->title; ?></option>
				<?php else: ?>
				<option value='<?php echo $cate->id; ?>'><?php echo $cate->title; ?></option>
				<?php endif; ?>
                <?php endforeach; ?>
            </select>
            <input type='text' name='title' value='<?php echo $this->obj->title; ?>' />        
        </td>
        <td><label for='price'>價格</label></td>
        <td><input type='number' name='price' value='<?php echo $this->obj->price; ?>' /></td>
    </tr>
    <tr>
        <td><label for='nid'>編號</label></td>
        <td><input type='text' name='nid' value='<?php echo $this->obj->id; ?>' /></td>
        <td><label for='cost'>成本</label></td>
        <td><input type='number' name='cost' value='<?php echo $this->obj->cost; ?>' /></td>
    </tr>
    <tr>
        <td><label for='size'>規格</label></td>
        <td><input type='text' name='size' value='<?php echo $this->obj->size; ?>' /></td>
        <td><label for='qty'>數量</label></td>
        <td><input type='number' name='qty' value='<?php echo $this->obj->qty; ?>' /></td>
    </tr>
    <tr>
        <td><label for='weight'>重量</label></td>
        <td><input type='text' name='weight' value='<?php echo $this->obj->weight; ?>' /></td>
        <td><label for='start_dte'>上架時間</label></td>
        <td><input type='date' name='start_dte' value='<?php echo $this->obj->start_dte; ?>' /></td>
    </tr>
    <tr>
        <td><label for='unit'>單位</label></td>
        <td><input type='text' name='unit' value='<?php echo $this->obj->unit; ?>' /></td>
        <td><label for='end_dte'>下架時間</label></td>
        <td><input type='date' name='end_dte' value='<?php echo $this->obj->end_dte; ?>' /></td>
    </tr>  
</table>
<p><label for='img1'>上傳圖片1</label><input type='file' name='img1' /><label for='img1_fix'>最大寬度</label><input type='number' value='130' name='img1_fix' /></p> 
<p><label for='img2'>上傳圖片2</label><input type='file' name='img2' /><label for='img2_fix'>最大寬度</label><input type='number' value='400' name='img2_fix' /></p>
<p><label for='img3'>上傳圖片3</label><input type='file' name='img3' /><label for='img3_fix'>最大寬度</label><input type='number' name='img3_fix' /></p>

<p><label for='content'>描述</label><textarea class='ckeditor' name='content'><?php echo $this->obj->content; ?></textarea></p>
<p><input type='submit' value='更新' /></p>
</form>
<?php break; ?>

<?php case 'productManage': ?>  
<form method='POST' name='form' action='?mod=cart&act=productManage'>
<p>
<select name='cid' onchange='document.form.submit();'>
    <option value='0'>預設</option>
    <?php foreach($this->cate as $cate):if($cate->id==$this->cid):?>
    <option selected value='<?php echo $cate->id; ?>'><?php echo $cate->title; ?></option>
    <?php else: ?>
    <option value='<?php echo $cate->id; ?>'><?php echo $cate->title; ?></option>
    <?php endif; endforeach; ?>
</select>
<a href='index.php?mod=cart&act=insProduct'>新增產品</a>
</p>
</form>
<table class='responsive'>
    <tr>
        <td>編號</td>
        <td>品名</td>
        <td>狀態</td>
        <td>修改</td>
        <td>刪除</td>
    </tr>
    <?php foreach($this->obj as $v): ?>
    <tr>
        <td><?php echo $v->id; ?></td>
        <td><?php echo $v->title; ?></td>
        <td><?php echo $v->qty; ?></td>
        <td><a href='index.php?mod=cart&act=updProduct&id=<?php echo $v->id; ?>'>修改</a></td>
        <td><a href='index.php?mod=cart&act=exe_delProduct&id=<?php echo $v->id; ?>'>刪除</a></td>
    </tr>
    <?php endforeach; ?>
</table>

<?php break; ?>

<?php break; ?>

<?php case 'productList': ?>  
<script>
$(function(){
$('#Grid').mixitup(
   {'showOnLoad': 'category_<?php echo $this->cid;?>'}
);
});

</script>
			<!-- FILTER CONTROLS -->
			
			<div class='controls'>	
				<h3>分類</h3>
				<ul>
					<li class='filter' data-filter='all'>Show All</li>
                    <?php foreach($this->cate as $i => $cate):?>
					<li class='filter' data-filter='category_<?php echo $cate->id; ?>'><?php echo $cate->title; ?></li>
                    <?php endforeach; ?>
				</ul>
 				<h3>排序</h3>
				<ul>
					<li class='sort' data-sort='data-price' data-order='desc'>低價</li>
					<li class='sort' data-sort='data-start' data-order='asc'>最新出產</li>
				</ul>               
			</div>
			

			<ul id='Grid'>
                <?php foreach($this->obj as $v): ?>
				<li class='mix category_0 category_<?php echo $v->cid; ?>' data-cat='<?php echo $v->cid; ?>' data-price='<?php echo $v->price; ?>' data-start='<?php echo $v->start_dte; ?>'>
                <a href='index.php?mod=cart&act=product&id=<?php echo $v->id; ?>'><img src='<?php echo $v->img1; ?>' alt='<?php echo $v->title; ?>' title='<?php echo $v->title; ?>' /></a>
                <?php echo $v->title; ?>
                </li>
                <?php endforeach; ?>  
                <li class='gap'></li>
                <li class='gap'></li>
                <li class='gap'></li>
                <li class='gap'></li>
  
			</ul>			

			
			<!-- GRID -->
			

			

<?php break; ?>

<?php case 'product': ?>  
<img class='img2' src='<?php echo $this->obj->img2; ?>' alt='<?php echo $this->obj->title; ?>' title='<?php echo $this->obj->title; ?>' />

<p>產品編號: <?php echo $this->obj->id; ?></p>
<p>產品名稱: <?php echo $this->obj->title; ?></p>
<p>產品單價: <?php echo $this->obj->price; ?></p>
<p>描述: </br>
<?php echo $this->obj->content; ?>
</p>
<img class='img3' src='<?php echo $this->obj->img3; ?>' alt='<?php echo $this->obj->title; ?>' title='<?php echo $this->obj->title; ?>' />
<form method='POST' action='?mod=cart&act=exe_insCart&id=<?php echo $this->obj->id;?>'>
<p><label for='qty'>數量</label><input type='text' name='qty' /></p>
<p><input type='submit' value='購買' /><a href='index.php?mod=cart&act=productList'><input type='button' value='回產品列表' /></a></p>
</form>

<?php break; ?>


<?php case 'order': ?>
<table class='responsive'>
    <tr>
        <td>購買時間</td>
        <td>訂單編號</td>
        <td>訂單內容</td>
        <td>總價</td>
        <td>狀態</td>
    </tr>
    <?php foreach($this->sale as $i => $v): ?>
    <tr>
        <td><?php echo $v->start_dte; ?></td>
        <td><?php echo $v->id; ?></td>
        <td><?php echo $v->content; ?></td>
        <td><?php echo $v->total; ?></td>
        <td><?php switch($v->status):case 1: ?>
            待處理
            <?php break; ?>        
            <?php case 2: ?>
            <a href='index.php?mod=cart&act=notice_paid&id=<?php echo $v->id; ?>'>通知已付款</a>
            <?php break; ?>
            <?php case 3: ?>
            處理中
            <?php break; ?>
            <?php case 4: ?>
            補貨中
            <?php break; ?>
            <?php case 5: ?>
            貨物送出
            <?php break; ?>
            <?php case 6: ?>
            送達完成
            <?php break; ?>
            <?php case 7: ?>
            退貨
            <?php break; ?>            
            <?php endswitch; ?>
        </td>
    </tr>
    <?php endforeach; ?>
</table>  
<form method='POST' action='?mod=cart&act=insSale'>
<table class='responsive'>
    <tr>
        <td>商品編號</td>
        <td>數量</td>
        <td>金額</td>
        <td>小計</td>
        <td>刪除</td>
    </tr>
    <?php foreach($this->obj as $i => $v) : ?>
    <tr>
        <td><input type='hidden' name='pid[]' value='<?php echo $v->pid;?>' /><?php echo $v->title;?></td>
        <td><input type='text' name='qty[]' value='<?php echo $v->qty;?>' /></td>
        <td><?php echo $v->price;?></td>
        <td><?php echo $v->qty * $v->price;?></td>
        <td><a href='index.php?mod=cart&act=exe_delCart&id=<?php echo $i;?>'><input type='button' value='刪除' /></a></td>
    </tr>
    <?php endforeach; ?>
</table>
<p><input type='submit' value='立即結算' /></p>
</form>
<?php break; ?>

<?php case 'notice_paid': ?>  
<form method='POST' action='?mod=cart&act=exe_notice_paid&id=<?php echo $this->obj->id;?>'>
<table class='responsive'>
    <tr>
        <td>商品編號</td>
        <td>商品名稱</td>
        <td>商品單價</td>
        <td>商品數量</td>
        <td>小計</td>
    </tr>
    <?php $total=0; foreach($this->obj->pid as $i => $v): ?>
    <tr>
        <td><?php echo $this->obj->pid[$i]; ?></td>
        <td><?php echo $this->obj->title[$i]; ?></td>
        <td><?php echo $this->obj->price[$i]; ?></td>
        <td><?php echo $this->obj->qty[$i]; ?></td>
        <td><?php $total = $total + $this->obj->price[$i]*$this->obj->qty[$i]; echo $this->obj->price[$i]*$this->obj->qty[$i]; ?></td>
    </tr>    
    <?php endforeach; ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Total: </td>
        <td><?php echo $total; ?></td>
    </tr> 
</table>
<p><label for='remit_acc'>匯款帳號末五碼</label><input type='text' name='remit_acc' /></p>
<p><label for='name'>匯款時間</label><input type='datetime-local' name='remit_dte' /></p>
<p><label for='name'>聯絡人姓名</label><input type='text' name='name' value='<?php echo $_SESSION['user']->name;?>' /></p>
<p><label for='addr'>收件地址</label><input type='text' name='addr' value='<?php echo $_SESSION['user']->address;?>' /></p>
<p><label for='tel'>連絡電話</label><input type='text' name='tel' value='<?php echo $_SESSION['user']->tel;?>' /></p>
<p><label for='msg'>留言</label><textarea class='ckeditor' class='ckeditor' name='msg'></textarea></p>
<p><input type='submit' value='通知已付款' /></p>
</form>
<?php break; ?>

<?php case 'updSale': ?>
<form method='POST' action='?mod=cart&act=exe_updSale&id=<?php echo $this->obj->id; ?>'>
<p>訂單編號: <?php echo $this->obj->id; ?></p>  
<p>訂單日期: <?php echo $this->obj->start_dte; ?></p>  
<p>訂單狀態:             
<select name='status'>
    <?php foreach($this->status as $i => $v): ?>
    <?php if ($i==$this->obj->status): ?>
    <option selected value='<?php echo $i; ?>'><?php echo $v; ?></option>
    <?php else: ?>
    <option value='<?php echo $i; ?>'><?php echo $v; ?></option>
    <?php endif; ?>
    <?php endforeach; ?>
</select>
<input type='submit' value='儲存' />            
</p>
</form>  
<table class='responsive'>
    <tr>
        <td>商品編號</td>
        <td>商品名稱</td>
        <td>商品單價</td>
        <td>商品數量</td>
        <td>小計</td>
    </tr>
    <?php $total=0; foreach($this->obj->pid as $i => $v): ?>
    <tr>
        <td><?php echo $this->obj->pid[$i]; ?></td>
        <td><?php echo $this->obj->title[$i]; ?></td>
        <td><?php echo $this->obj->price[$i]; ?></td>
        <td><?php echo $this->obj->qty[$i]; ?></td>
        <td><?php $total = $total + $this->obj->price[$i]*$this->obj->qty[$i]; echo $this->obj->price[$i]*$this->obj->qty[$i]; ?></td>
    </tr>    
    <?php endforeach; ?>
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Total: </td>
        <td><?php echo $total; ?></td>
    </tr> 
</table>
<p>匯款帳號末五碼: <?php echo $this->obj->remit_acc; ?></p>
<p>匯款日期: <?php echo $this->obj->remit_dte; ?></p>
<p>匯款人: </p>
<?php break; ?>

<?php case 'saleManage': ?>
<form method='POST' name='form' action='?mod=cart&act=saleManage'>
<p><select name='status' onchange='document.form.submit()'>
    <option value='0'>預設</option>
    <?php foreach($this->status as $i => $v): ?>
    <?php if ($i == $this->selected): ?>
    <option selected value='<?php echo $i; ?>'><?php echo $v; ?></option>
    <?php else: ?>
    <option value='<?php echo $i; ?>'><?php echo $v; ?></option>
    <?php endif; ?>
    <?php endforeach; ?>
</select></p>
</form>
<table class='responsive'>
    <tr>
        <td>狀態</td>
        <td>訂購日期</td>
        <td>訂購內容</td>
        <td>訂購者</td>
        <td>電話</td>
        <td>修改</td>
        <td>刪除</td>
    </tr>
    <?php foreach($this->obj as $i => $v): ?>
    <tr>
        <td><?php echo $this->status[$v->status]; ?></td>
        <td><?php echo $v->start_dte; ?></td>
        <td><?php echo $v->content; ?></td>
        <td><?php echo $v->name; ?></td>
        <td><?php echo $v->tel; ?></td>
        <td><a href='index.php?mod=cart&act=updSale&id=<?php echo $v->id; ?>'>修改</a></td>
        <td><a href='index.php?mod=cart&act=exe_delSale&id=<?php echo $v->id; ?>'>刪除</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php break; ?>

<?php case 'cateManage': ?>
<p><a href='index.php?mod=cart&act=insCate'>新增分類</a></p>
<table class='responsive'>
    <tr>
        <td>類別編號</td>
        <td>類別名稱</td>
        <td>修改</td>
        <td>刪除</td>
    </tr>
    <?php foreach($this->obj as $i => $v): ?>
    <tr>
        <td><?php echo $v->id; ?></td>
        <td><?php echo $v->title; ?></td>
        <td><a href='index.php?mod=cart&act=updCate&id=<?php echo $v->id; ?>'>修改</a></td>
        <td><a href='index.php?mod=cart&act=exe_delCate&id=<?php echo $v->id; ?>'>刪除</a></td>
    </tr>    
    <?php endforeach; ?>
</table>
<?php break; ?>

<?php endswitch;?>
