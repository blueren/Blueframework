<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>

<?php case 'index': ?>

<table>
	<tr>
	<th>公司統編</th>
	<th>類別</th>
	<th>公司名稱</th>
	<th>業主</th>
	<th>簡介</th>
	<th>開始</th>
	<th>結束</th>
	<th>地址</th>
	<th>刪除/修改</th>
	</tr>
	<?php foreach($this->obj as $i => $v): ?>
	<tr>
	<td><?php echo $v->id; ?></td>
	<td><?php echo $v->category; ?></td>
	<td><?php echo $v->name; ?></td>
	<td><?php echo $v->owner; ?></td>
	<td><?php echo $v->intro; ?></td>
	<td><?php echo $v->opentime; ?></td>
	<td><?php echo $v->closetime; ?></td>
	<td><?php echo $v->addr; ?></td>	
	<td><a href='index.php?mod=member&act=del&id=<?php echo $v->id; ?>'>刪除</a>/<a href='index.php?mod=member&act=upd&id=<?php echo $v->id; ?>'>修改</a></td>
	</tr>
	<?php endforeach; ?>
</table>
<?php break; ?>

<?php case 'show': ?>

<table class='responsive'>
	<tr>
		<td>公司名稱</td>
		<td><?php echo $this->obj->corpname; ?></td>
	</tr>
	<tr>
		<td>公司編號</td>
		<td><?php echo $this->obj->id; ?></td>
	</tr>
	<tr>
		<td>營業時間</td>
		<td><?php echo $this->obj->opentime; ?> ~ <?php echo $this->obj->closetime; ?></td>
	</tr>
	<tr>
		<td>地址</td>
		<td><?php echo $this->obj->addr; ?></td>
	</tr>

</table>
<?php break; ?>

<?php case 'ins': ?>
<form method='POST' action='index.php?mod=member&act=exe_ins'>
	<label for='id'>公司統編</label><input type='text' name='id' /></br>
	<label for='category'>類別</label><input type='text' name='category' /></br>
	<label for='corpname'>公司名稱</label><input type='text' name='corpname' /></br>
	<label for='owner'>業主</label><input type='text' name='owner' /></br>
	<label for='intro'>簡介</label><input type='text' name='intro' /></br>
	<label for='opentime'>營業時間(開始)</label><input type='text' name='opentime' /></br>
	<label for='closetime'>營業時間(結束)</label><input type='text' name='closetime' /></br>
	<label for='addr'>地址</label><input type='text' name='addr' /></br>
	<label for='tel'>電話</label><input type='text' name='tel' /></br>
	<label for='sitename'>網站名稱</label><input type='text' name='sitename' /></br>
	<label for='template_path'>樣板名稱</label><input type='text' name='template_path' /></br>	
	<input type='submit' value='新增' />
</form>
<?php break; ?>

<?php case 'upd': ?>
<form method='POST' action='index.php?mod=member&act=exe_upd&id=<?php echo $this->obj->id; ?>'>
	<label for='id'>公司統編</label><input type='text' name='id' value='<?php echo $this->obj->id; ?>' /></br>
	<label for='category'>類別</label><input type='text' name='category' value='<?php echo $this->obj->category; ?>' /></br>
	<label for='corpname'>公司名稱</label><input type='text' name='corpname' value='<?php echo $this->obj->corpname; ?>' /></br>
	<label for='owner'>業主</label><input type='text' name='owner' value='<?php echo $this->obj->owner; ?>' /></br>
	<label for='intro'>簡介</label><input type='text' name='intro' value='<?php echo $this->obj->intro; ?>' /></br>
	<label for='opentime'>營業時間(開始)</label><input type='text' name='opentime' value='<?php echo $this->obj->opentime; ?>' /></br>
	<label for='closetime'>營業時間(結束)</label><input type='text' name='closetime' value='<?php echo $this->obj->closetime; ?>' /></br>
	<label for='addr'>地址</label><input type='text' name='addr' value='<?php echo $this->obj->addr; ?>' /></br>
	<label for='tel'>電話</label><input type='text' name='tel' value='<?php echo $this->obj->tel; ?>' /></br>
	<label for='sitename'>網站名稱</label><input type='text' name='sitename' value='<?php echo $this->obj->sitename; ?>' /></br>
	<label for='template_path'>樣板名稱</label><input type='text' name='template_path' value='<?php echo $this->obj->template_path; ?>' /></br>		
	<input type='submit' value='新增' />
</form>
<?php break; ?>

<!--修改密碼 -->

<?php endswitch;?>
