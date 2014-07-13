<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>

<?php case 'stat': ?>

<a href='index.php?mod=cart&act=stat&t=qty'>銷量分析</a> | <a href='index.php?mod=cart&act=stat&t=price'>售價分析</a> | <a href='index.php?mod=cart&act=stat&t=income'>利潤分析</a>
		<script type="text/javascript">
$(function () {

    Highcharts.data({
        csv: document.getElementById('tsv').innerHTML,
        itemDelimiter: '\t',
        parsed: function (columns) {

            var brands = {},
                brandsData = [],
                versions = {},
                drilldownSeries = [];
            
            // Parse percentage strings
            columns[1] = $.map(columns[1], function (value) {
                if (value.indexOf('%') === value.length - 1) {
                    value = parseFloat(value);
                }
                return value;
            });

            $.each(columns[0], function (i, name) {
                var brand,
                    version;

                if (i > 0) {

                    // Remove special edition notes
                    name = name.split(' _')[0];

                    // Split into brand and version
                    version = name.match(/([0-9\-]+.[\u4e00-\u9fa5_a-zA-Z0-9]+)/);
                    if (version) {
                        version = version[0];
                    }
                    brand = name.replace(version, '');

                    // Create the main data
                    if (!brands[brand]) {
                        brands[brand] = columns[1][i];
                    } else {
                        brands[brand] += columns[1][i];
                    }

                    // Create the version data
                    if (version !== null) {
                        if (!versions[brand]) {
                            versions[brand] = [];
                        }
                        versions[brand].push(['v' + version, columns[1][i]]);
                    }
                }
                
            });

            $.each(brands, function (name, y) {
                brandsData.push({ 
                    name: name, 
                    y: y,
                    drilldown: versions[name] ? name : null
                });
            });
            $.each(versions, function (key, value) {
                drilldownSeries.push({
                    name: key,
                    id: key,
                    data: value
                });
            });

            // Create the chart
            $('#container').highcharts({
                chart: {
                    type: 'pie'
                },
                title: {
                    text: '訂單分析'
                },
                subtitle: {
                    text: '銷量/售價/利潤分析'
                },
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.1f}%'
                        }
                    }
                },

                tooltip: {
                    headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
                    pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                }, 

                series: [{
                    name: 'Brands',
                    colorByPoint: true,
                    data: brandsData
                }],
                drilldown: {
                    series: drilldownSeries
                }
            })

        }
    });
});
    

		</script>
        

<div id='container' style='min-width: 310px; height: 400px; margin: 0 auto'></div>

<!-- Data from www.netmarketshare.com. Select Browsers => Desktop share by version. Download as tsv. -->
<pre id='tsv' style='display:none;'>
version	stat

<?php foreach($this->obj->sale as $i => $v): ?>
<?php echo $v->ctitle;?> <?php echo $v->pid.'.'.$v->ptitle;?>	<?php echo round(($v->{$this->t}/$this->obj->total->{$this->t})*100,2); ?>%
<?php endforeach; ?>
</pre>

<?php foreach($this->obj->result as $i => $v): ?>
<p><?php echo $v->title; ?>	<?php echo $v->percent->{$this->t}; ?>%
<hr>
銷量/總銷量 : <?php echo $v->qty; ?> / <?php echo $this->obj->total->qty; ?></br>
類別售價/總售價 : <?php echo $v->price; ?> / <?php echo $this->obj->total->price; ?></br>
類別利潤/總利潤 : <?php echo $v->income; ?> / <?php echo $this->obj->total->income; ?></p>
<?php endforeach; ?>

<?php break; ?>

<?php case 'index': ?>
<script>
$(function(){
$('#Grid').mixitup();
});

</script>
            <div id='portfolio-bigimage'>
                <div class='work group'>
                    <div class='video-side'>
                        <div class='video'>
                            <div class='video-container'>
                                     <iframe src='<?php echo CORP_VIDEO; ?>' frameborder='0' width='560' height='315'></iframe>
                            </div>            
                        </div>

                    </div>
        
                    <div class='video-intro'>
                        <h3>介紹</h3>
                        <p><?php echo CORP_INTRO; ?></p>
                        
                        <a href='index.php?mod=page&act=show&id=2' class='read-more'>更多</a>
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
				<h3>介紹</h3>
				<ul>
					<li class='filter' data-filter='all'><a href='index.php?mod=page&act=show&id=4'>毛巾製作流程</a></li>
                    <li class='filter' data-filter='all'><a href='#'>毛巾的種類</a></li>
                    <li class='filter' data-filter='all'><a href='#'>如何辨識好毛巾</a></li>
				</ul>                
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

<?php case 'updHot': ?>
    <form method='POST' action='?mod=cart&act=exe_updHot'>
        <label for='hot1'>熱銷商品1</label>
        <select name='hot1'>
            <?php foreach($this->obj as $v): ?>
                <option value='<?php echo $v->id; ?>'><?php echo $v->id; ?>-<?php echo $v->title; ?></option>
            <?php endforeach; ?>
        </select>
        <label for='hot2'>熱銷商品2</label>
        <select name='hot2'>
            <?php foreach($this->obj as $v): ?>
                <option value='<?php echo $v->id; ?>'><?php echo $v->id; ?>-<?php echo $v->title; ?></option>
            <?php endforeach; ?>
        </select>        
        <label for='hot3'>熱銷商品3</label>
        <select name='hot3'>
            <?php foreach($this->obj as $v): ?>
                <option value='<?php echo $v->id; ?>'><?php echo $v->id; ?>-<?php echo $v->title; ?></option>
            <?php endforeach; ?>
        </select>        
        <input type='submit' value='確認送出' />
    </form>
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
<p><input type='submit' value='修改分類' /></p>
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
<p><img class='img1' src='<?php echo $this->obj->img1; ?>' alt='<?php echo $this->obj->title; ?>' /></p>
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
<a href='index.php?mod=cart&act=insProduct'>新增產品</a> | <a href='index.php?mod=cart&act=cateManage'>分類管理</a> | <a href='index.php?mod=cart&act=saleManage'>訂單管理</a>
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
    <?php foreach($this->obj->content as $v): ?>
    <tr>
        <td><?php echo $v->id; ?></td>
        <td><a href='index.php?mod=cart&act=product&id=<?php echo $v->id; ?>'><?php echo $v->title; ?></a></td>
        <td><?php echo $v->qty; ?></td>
        <td><a href='index.php?mod=cart&act=updProduct&id=<?php echo $v->id; ?>'>修改</a></td>
        <td><a href='index.php?mod=cart&act=exe_delProduct&id=<?php echo $v->id; ?>'>刪除</a></td>
    </tr>
    <?php endforeach; ?>
</table>
<ul class="pagination">
<li><a href="index.php?mod=cart&act=productManage&page=<?php echo $this->obj->current_page-1; ?>">&laquo;</a></li>
<?php for($i=1;$i<=$this->obj->total_page;$i++): ?>
    <?php if($i == $this->obj->current_page): ?>
    <li class="active"><a href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
    <?php else: ?>
    <li><a href='index.php?mod=cart&act=productManage&page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
    <?php endif; ?>
<?php endfor; ?>
<li><a href="index.php?mod=cart&act=productManage&page=<?php echo $this->obj->current_page+1; ?>">&raquo;</a></li>
</ul> 
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
<div id='center_column'>
<div id="view_way" class="list_view">
	<!-- Products list -->
	<ul id="product_list" class="clearfix">
		<?php foreach($this->obj as $v): ?>
		<li class="item clearfix">
			<div class="left_block"></div>
			<div class="center_block">
            <a href="#" class="product_img_link" title="<?php echo $v->title; ?>">
			<img src="<?php echo $v->img1; ?>" alt="" class="img_0"></a>
				<h3><a href="?mod=erp&act=product&id=<?php echo $v->id; ?>" title="<?php echo $v->title; ?>"><?php echo $v->title; ?></a></h3>
				<p class="product_desc"><a href="?mod=erp&act=product&id=<?php echo $v->id; ?>">
				<?php echo strip_tags($v->content); ?>
				</a></p>
			</div>
			<div class="right_block">
				<div class="content_price">
					<span class="price" style="display: inline;"><?php echo $v->price; ?></span>
                                        
				</div>
                  <!-- attributes -->
			<div id="attributes"></div>
				<a class="button" rel="ajax_id_product_8" href="?mod=erp&act=product&id=<?php echo $v->id; ?>" title="enter">進入</a>
			</div>
		</li>
		<?php endforeach; ?>
	</ul>
	<!-- /Products list -->
</div>

</div>
<div id='left_column' class='column' role='complementary'>
<h3>Hairfax產品分類</h3>
<ul>

	
	<li class="filter" data-filter="all"><a href='?mod=erp&act=productList2&cate=0'>全部</a></li>
	<?php foreach($this->cate as $i => $cate):?>
	<?php if($cate->id==$this->cid): ?>
	<li class="filter" data-filter="category_<?php echo $cate->id; ?>"><a class='selected' href='?mod=erp&act=productList2&cate=<?php echo $cate->id; ?>'><?php echo $cate->title; ?></a></li>	
	<?php else: ?>
	<li class="filter" data-filter="category_<?php echo $cate->id; ?>"><a href='?mod=erp&act=productList2&cate=<?php echo $cate->id; ?>'><?php echo $cate->title; ?></a></li>	
	<?php endif; ?>
	<?php endforeach; ?>
</ul>
</div>			

			

<?php break; ?>

<?php case 'product': ?>  
<img class='img2' src='<?php echo $this->obj->img2; ?>' alt='<?php echo $this->obj->title; ?>' title='<?php echo $this->obj->title; ?>' />

<p>產品編號: <?php echo $this->obj->id; ?></p>
<p>產品名稱: <?php echo $this->obj->title; ?></p>
<p>產品單價: <?php echo $this->obj->price; ?></p>
<p>規格: <?php echo $this->obj->size; ?></p>
<p>重量: <?php echo $this->obj->weight; ?></p>
<p>單位: <?php echo $this->obj->unit; ?></p>
<p>描述: </br>
<?php echo $this->obj->content; ?>
</p>
<form method='POST' action='?mod=cart&act=exe_insCart&id=<?php echo $this->obj->id;?>'>
<p><label for='qty'>數量</label><input type='text' name='qty' /></p>
<p><input type='submit' value='購買' /><a href='index.php?mod=cart&act=productList'><input type='button' value='回產品列表' /></a>
<?php if ($this->priv==2): ?>   
<a href='index.php?mod=cart&act=updProduct&id=<?php echo $this->obj->id; ?>'><input type='button' value='修改' /></a>
<a href='index.php?mod=cart&act=exe_delProduct&id=<?php echo $this->obj->id; ?>'><input type='button' value='刪除' /></a>
<?php endif; ?>
</p>
</form>

<img class='img3' src='<?php echo $this->obj->img3; ?>' alt='<?php echo $this->obj->title; ?>' title='<?php echo $this->obj->title; ?>' />


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
        <td><?php echo $v->content; ?>+運費<?php echo $v->freight; ?>元</td>
        <td><?php echo $v->total+$v->freight; ?></td>
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
    <?php $total=0; foreach($this->obj->detail as $i => $v): ?>
    <tr>
        <td><?php echo $v->pid; ?></td>
        <td><?php echo $v->title; ?></td>
        <td><?php echo $v->price; ?></td>
        <td><?php echo $v->qty; ?></td>
        <td><?php $total = $total + $v->price*$v->qty; echo $v->price*$v->qty; ?></td>
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
<p><label for='name'>匯款時間</label><input type='datetime-local' name='remit_dte' />(格式: yyyy-MM-dd HH:mm:ss)</p>
<p><label for='name'>聯絡人姓名</label><input type='text' name='remit_name' value='<?php echo $_SESSION['user']->name;?>' /></p>
<p><label for='addr'>收件地址</label><input type='text' name='addr' value='<?php echo $_SESSION['user']->address;?>' /></p>

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
    <?php $total=0; foreach($this->obj->detail as $i => $v): ?>
    <tr>
        <td><?php echo $v->pid; ?></td>
        <td><?php echo $v->title; ?></td>
        <td><?php echo $v->price; ?></td>
        <td><?php echo $v->qty; ?></td>
        <td><?php $total = $total + $v->price*$v->qty; echo $v->price*$v->qty; ?></td>
    </tr>    
    <?php endforeach; ?>
    <tr>
        <td>Freight</td>
        <td>運費</td>
        <td><?php echo $this->obj->freight; ?></td>
        <td>1</td>
        <td><?php echo $this->obj->freight; ?></td>
    </tr>        
    <tr>
        <td></td>
        <td></td>
        <td></td>
        <td>Total: </td>
        <td><?php echo $total+$this->obj->freight; ?></td>
    </tr> 
</table>
<p>匯款帳號末五碼: <?php echo $this->obj->remit_acc; ?></p>
<p>匯款日期: <?php echo $this->obj->remit_dte; ?></p>
<p>匯款人: <?php echo $this->obj->remit_name; ?></p>
<p>收件地址: <?php echo $this->obj->addr; ?></p>
<p>會員姓名: <?php echo $this->user->name; ?></p>
<p>會員手機: <?php echo $this->user->tel; ?></p>
<p>會員信箱: <?php echo $this->user->email; ?></p>
<p>會員性別: <?php echo $this->user->gender; ?></p>

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
