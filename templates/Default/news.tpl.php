<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>

<?php case 'newsList': ?>
<table class='responsive'>
    <tr>
        <td>標題</td>
        <td>作者</td>
        <td>時間</td>
    </tr>
    <?php foreach($this->obj as $v): ?>
    <tr>
        
        <td><a href='index.php?mod=news&act=show&id=<?php echo $v->id; ?>'><?php echo $v->title; ?></a></td>
        <td><?php echo $v->author; ?></td>
        <td><?php echo $v->upd_dte; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php break; ?>

<?php case 'show': ?>
<p>[<?php echo $this->cate[$this->obj->cate]; ?>] <?php echo $this->obj->title; ?></p>
<p><?php echo $this->obj->author; ?> 在 <?php echo $this->obj->upd_dte; ?></p>
<p><?php echo $this->obj->content; ?></p>
<?php if($this->priv==2): ?>
<p><a href='index.php?mod=news&act=upd&id=<?php echo $this->obj->id; ?>'>修改</a> | <a href='index.php?mod=news&act=exe_del&id=<?php echo $this->obj->id; ?>'>刪除</a></p>
<?php endif; ?>
<?php break; ?>


<?php case 'ins': ?> 
<form method='POST' action='?mod=news&act=exe_ins'>
<p>
<select name='cate'>
    <?php foreach($this->cate as $i => $v): ?>
    <option value='<?php echo $i; ?>'><?php echo $v; ?></option>
    <?php endforeach; ?>
</select>
<label for='title'>標題</label> <input type='text' name='title' /></p>
<p><label for='content'>內容</label> <textarea name='content' class='ckeditor' /></textarea></p>
<p><label for='upd_dte'>時間</label> <input type='date' name='upd_dte' /></p>
<p><input type='submit' value='發表' />
</form>
<?php break; ?>


<?php case 'upd': ?> 
<form method='POST' action='?mod=news&act=exe_upd&id=<?php echo $this->obj->id; ?>'>
<p>
<select name='cate'>
<?php foreach($this->cate as $i => $v): ?>
<?php if($this->obj->cate==$i): ?>
    <option selected value='<?php echo $i; ?>'><?php echo $v; ?></option>
<?php else: ?>
    <option value='<?php echo $i; ?>'><?php echo $v; ?></option>
<?php endif; ?>
<?php endforeach; ?>
</select>
<label for='title'>標題</label> <input type='text' name='title' value='<?php echo $this->obj->title; ?>' /></p>
<p><label for='content'>內容</label> <textarea name='content' class='ckeditor' /><?php echo $this->obj->content; ?></textarea></p>
<p><label for='upd_dte'>時間</label> <input type='date' name='upd_dte' value='<?php echo $this->obj->upd_dte; ?>' /></p>
<p><input type='submit' value='發表' />
</form>
<?php break; ?>



<!--修改密碼 -->

<?php endswitch;?>
