<a class='list-group-item' href='index.php?mod=cart&act=order'>購物車</a>
<a class='list-group-item' href='index.php?mod=cart&act=productList'>產品清單</a>
<?php if($this->priv==2): ?>
<a class='list-group-item' href='index.php?mod=cart&act=productManage'>產品管理</a>
<a class='list-group-item' href='index.php?mod=cart&act=updHot'>更改熱銷商品</a>
<a class='list-group-item' href='index.php?mod=cart&act=stat'>訂單分析</a>
<?php endif; ?>