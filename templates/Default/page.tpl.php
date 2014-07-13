<?php switch ($this->type): case 'dump': ?>   
<ul class='list-group'>
<?php foreach($this->obj as $i => $v): ?>
<li class='list-group-item'>
    <a href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>'><?php echo $v->name; ?></a>
    <?php if ($this->priv==2): ?>
         [<a href='index.php?mod=page&act=upd&id=<?php echo $v->id; ?>'>修改</a> | <a href='index.php?mod=page&act=del&id=<?php echo $v->id; ?>'>刪除</a>]
    <?php endif; ?>
    <ul class='list-group'>
    <?php foreach($v->sub as $j => $k): ?>
    <li class='list-group-item'><a href='index.php?mod=page&act=show&id=<?php echo $k->id; ?>'> -><?php echo $k->name; ?></a>
    <?php if ($this->priv==2): ?>
         [<a href='index.php?mod=page&act=upd&id=<?php echo $k->id; ?>'>修改</a> | <a href='index.php?mod=page&act=del&id=<?php echo $k->id; ?>'>刪除</a>]
    <?php endif; ?>    
    </li>
    <?php endforeach; ?>
    </ul>
</li>    
<?php endforeach; ?>
</ul>
<?php break; ?>

<?php case 'index': ?> 
<!--  
<div class='breadcrumb'>
	<a href='http://www.hairfax.fr/' title='retour &agrave; l&#039;accueil'>根節點</a>
    <span class='navigation-pipe' >&gt;</span>
    <span class='navigation_end'>子節點</span>
</div>
-->
<p>
<a href='index.php?mod=page&act=ins'>新增頁面</a>
</p>
<ul class='list-group'>
<?php foreach($this->obj->content as $i => $v): ?>
<li class='list-group-item'>
    <a href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>'><?php echo $v->name; ?></a>
    <?php if ($this->priv==2): ?>
         [<a href='index.php?mod=page&act=upd&id=<?php echo $v->id; ?>'>修改</a> | <a href='index.php?mod=page&act=del&id=<?php echo $v->id; ?>'>刪除</a>]
    <?php endif; ?>
    <ul class='list-group'>
    <?php foreach($v->sub as $j => $k): ?>
    <li class='list-group-item'><a href='index.php?mod=page&act=show&id=<?php echo $k->id; ?>'> -><?php echo $k->name; ?></a>
    <?php if ($this->priv==2): ?>
         [<a href='index.php?mod=page&act=upd&id=<?php echo $k->id; ?>'>修改</a> | <a href='index.php?mod=page&act=del&id=<?php echo $k->id; ?>'>刪除</a>]
    <?php endif; ?>    
    </li>
    <?php endforeach; ?>
    </ul>
</li>    
<?php endforeach; ?>
</ul>
<ul class="pagination">
<li><a href="index.php?mod=page&page=<?php echo $this->obj->current_page-1; ?>">&laquo;</a></li>
<?php for($i=1;$i<=$this->obj->total_page;$i++): ?>
    <?php if($i == $this->obj->current_page): ?>
    <li class="active"><a href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
    <?php else: ?>
    <li><a href='index.php?mod=page&page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
    <?php endif; ?>
<?php endfor; ?>
<li><a href="index.php?mod=page&page=<?php echo $this->obj->current_page+1; ?>">&raquo;</a></li>
</ul>
<?php break; ?>


<?php case 'show': ?> 
<!--  
<div class='breadcrumb'>
	<a href='http://www.hairfax.fr/' title='retour &agrave; l&#039;accueil'>根節點</a>
    <span class='navigation-pipe' >&gt;</span>
    <span class='navigation_end'>子節點</span>
</div>
-->
<?php if (!empty($this->child)): ?>
<p>
<?php foreach($this->child as $i => $v): ?>
<a href='index.php?mod=page&act=show&id=<?php echo $v->id; ?>'><?php echo $v->name; ?></a> |
<?php endforeach; ?>
</p>
<?php endif; ?>
<h1><?php echo $this->obj->name; ?></h1>
<p><?php echo $this->obj->content; ?></p>
<?php if ($this->priv==2): ?>
<p><a href='index.php?mod=page&act=upd&id=<?php echo $this->obj->id; ?>'>修改</a> | <a href='index.php?mod=page&act=del&id=<?php echo $this->obj->id; ?>'>刪除</a></p>
<?php endif; ?>
<?php break; ?>


<!--登入 -->
<?php case 'ins': ?>   
    <?php if ($this->priv!=0): ?> 
    <form METHOD='POST' ACTION='?mod=page&act=exe_ins'>
        <p><label for='add_type'>新增方式</label><input type='radio' checked name='add_type' value='0' />新增在項下 <input type='radio' name='add_type' value='1' />新增在同層</p>
        <p><label for='name'>標題: 
        <select name='category'>
            <option value='1'></option>
            <?php foreach($this->menu as $i => $v) : ?>
            <option value='<?php echo $v->id; ?>'><?php echo $v->name; ?>(<?php echo $v->display; ?>)</option>
            <?php if(!empty($v->sub)): ?>               
            <?php foreach($v->sub as $j => $k): ?>
            <option value='<?php echo $k->id; ?>'><?php echo '->'.$k->name; ?></option>
            <?php endforeach; ?>               
            <?php endif; ?>            
            <?php endforeach; ?>
        </select>        
        </label><input type='text' name='name' /></p>
        <p><label for='url'>網址: </label><input type='text' name='url' /></p>
        <p><label for='content'>內容: </label><textarea class='ckeditor' name='content'></textarea></p>
        <p><label for='display'>排序: </label><input type='number' name='display' value='0'/></p>
        <p><input type='submit' value='送出' /></p>
    </form>
    <?php endif; ?>
<?php break; ?>

<?php case 'upd': ?>   
    <?php if ($this->priv!=0): ?> 
    <form METHOD='POST' ACTION='?mod=page&act=exe_upd&id=<?php echo $this->obj->id; ?>'>
        <p>請輸入登入資訊：</p>
        <p><label for='name'>標題:   
        </label><input type='text' name='name' value='<?php echo $this->obj->name; ?>'/></p>
        <p><label for='url'>網址: </label><input type='text' name='url' value='<?php echo $this->obj->url; ?>' /></p>
        <p><label for='content'>內容: </label><textarea class='ckeditor' name='content'><?php echo $this->obj->content; ?></textarea></p>
        <p><label for='display'>排序: </label><input type='number' name='display' value='<?php echo $this->obj->display; ?>' /></p>
        <p><input type='submit' value='送出' /></p>
    </form>
    <?php endif; ?>

<?php break; ?>


<?php case 'del': ?>   
    <p>確定刪除頁面?</p>
    <p><a href='index.php?mod=page&act=exe_del&id=<?php echo $this->obj; ?>'>是</a> | <a href='./'>否</a></p>
<?php break; ?>

<?php endswitch;

?>
