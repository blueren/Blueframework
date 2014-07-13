<li><a href='index.php?mod=user&act=upd'>修改個人基本資料</a></li>

<?php if($this->priv==2): ?>
<li><a href='index.php?mod=user&act=userManage'>會員管理</a></li>
<?php endif; ?>