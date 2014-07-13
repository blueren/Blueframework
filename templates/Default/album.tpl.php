<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>

<?php break; ?>
<?php case 'addImg'; ?>
		<form name='edit' id='edit' method='post' action='?mod=album&act=exe_addImg' enctype='multipart/form-data'>
		<h2>新增相片</h2>
		<p>
		<label for='aid'>選擇相簿</label>
		<select size='1' name='aid'>
            <?php foreach($this->obj as $i => $v): ?>
			<option value='<?php echo $v->id; ?>'><?php echo $v->title; ?></option>
            <?php endforeach; ?>
		</select>		
		<input name='file[]' type='file' id='file' multiple='multiple' >
		</p>
		<p>
		<label for='content'>相片內容</label>
		<textarea class='ckeditor' cols='80' id='editor1' name='content'></textarea>
		</p>
		<p><input type='submit' value='送出' name='upload'><input type='reset' value='重新設定' name='B2'></p>
		</form>
<?php break; ?>
<?php case 'addAlbum'; ?>
		<form method='post' action='?mod=album&act=exe_addAlbum'>
		<h2>新增相簿</h2>
		<p><label for='title'>相簿名稱: </label><input name='title' type='text' /></p>
		<p>
		<label for='content'>相簿簡介: </label>
		<textarea class='ckeditor' cols='80' id='editor1' name='content'></textarea>
		</p>
		<p><input type='submit' value='送出' name='upload'><input type='reset' value='重新設定' name='B2'></p>
		</form>
<?php break; ?>
<?php case 'displayAlbum'; ?>
    <ul>
    <?php foreach($this->obj as $i => $v): ?>
        <li><a href='index.php?mod=album&act=showAlbum&aid=<?php echo $v->id; ?>'><?php echo $v->dte; ?> - <?php echo $v->title; ?>(<?php echo $v->author; ?>)</a></li>
    <?php endforeach; ?>
    </ul>
<?php break; ?>
<?php case 'showAlbum'; ?>
    <h1 class='albumIntro'><?php echo $this->album->title; ?></h1>
    <p class='albumIntro'><?php echo $this->album->content; ?></p>
    <p class='albumIntro'><?php echo $this->album->dte; ?>(<?php echo $this->album->uid; ?>)</p>
    <?php foreach($this->album->img as $i => $v): ?>
    <div class='albumList'>
        <a href='index.php?mod=album&act=showImg&id=<?php echo $v->id; ?>'><img src='<?php echo $v->thumb; ?>' /></a>
    </div>
    <?php endforeach; ?>
<?php break; ?>
<?php case 'showImg'; ?>
    <p><a href='index.php?mod=album&act=showAlbum&aid=<?php echo $this->obj->aid; ?>'>回相簿列表</a></p>
    <img src='<?php echo $this->obj->img; ?>' />
    <p><?php echo $this->obj->content; ?></p>
    <p><?php echo $this->obj->dte; ?></p>
    <?php if ($this->priv==2): ?>  
    <p><a href='index.php?mod=album&act=exe_delImg&id=<?php echo $this->obj->id; ?>'>刪除相片</a></p>
    <?php endif; ?>
<?php break; ?>
<?php endswitch; ?>