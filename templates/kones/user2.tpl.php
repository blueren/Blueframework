<?php if ($this->priv==1): ?>
<li class='folder'><a href='#'>會員選單</a>
<ul class='sub-menu'>
<?php foreach($this->conf['menu'] as $obj): ?>
<?php if ($obj!=null) {$this->render($obj);}?>
<?php endforeach; ?>
    <li><a href='index.php?mod=user&act=logout'>登出</a></li>
</ul>
</li>
<?php elseif ($this->priv==2): ?>
<li class='folder'><a href='#'>管理者選單</a>
<ul class='sub-menu'>
<?php foreach($this->conf['menu'] as $obj): ?>
<?php if ($obj!=null) {$this->render($obj);}?>
<?php endforeach; ?>
    <li><a href='index.php?mod=user&act=logout'>登出</a></li>
</ul>
</li>
<?php endif; ?>