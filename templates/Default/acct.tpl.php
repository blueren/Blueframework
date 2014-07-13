<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>
<?php case 'display': ?>
<form>
<p>
<input type='hidden' name='mod' value='acct' /> 
<input type='hidden' name='act' value='display' /> 
<input type='number' name='year' />年
<select name='type'>
    <option value='Q1'>第1季</option>
    <option value='Q2'>第2季</option>
    <option value='Q3'>第3季</option>
    <option value='Q4'>第4季</option>
    <option value='HY1'>上半年</option>
    <option value='HY2'>下半年</option>
    <option value='Y'>全年</option>
</select>
</p>
<p>
會計科目<input type='text' name='cate' />
<input type='submit' value='查詢' />
<a href='index.php?mod=acct&act=ins'><input type='button' value='新增' /></a>
</p>
</form>

<table class='responsive' id='acctDisplay'>
    <tr>
        <td>日期</td>
        <td>科目</td>
        <td>摘要</td>
        <td>金額</td>
        <td>小計</td>
    </tr>
    <?php foreach($this->obj as $i => $v): ?>
    <tr>
        <td><?php echo $v->dte; ?></td>
        <td><?php echo $v->cate; ?></td>
        <td><?php echo $v->content; ?></td>
        <td><?php echo $v->amt; ?></td>
        <td><?php echo $v->total; ?></td>
    </tr>
    <?php endforeach; ?>
</table>
<?php break; ?>
<?php case 'ins': ?>
<form method='POST' action='?mod=acct&act=exe_ins'>
    <p><label for='dte'>日期: </label><input type='date' name='dte' /></p>
    <p><label for='cate'>會計科目: </label><input type='text' name='cate' /></p>
    <p><label for='content'>摘要: </label><input type='text' name='content' /></p>
    <p><label for='amt'>金額: </label><input type='number' name='amt' /></p>
    <p><input type='submit' value='送出' />
</form>
<?php break; ?>
<?php endswitch; ?>