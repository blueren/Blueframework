<li><a href='index.php?mod=cart&act=order'>購物車</a></li>
<?php if($this->priv==2): ?>
<li><a href='index.php?mod=cart&act=insCate'>新增分類</a></li>
<li><a href='index.php?mod=cart&act=insProduct'>新增產品</a></li>
<li><a href='index.php?mod=cart&act=productList'>產品清單</a></li>
<li><a href='index.php?mod=cart&act=saleManage'>訂單管理</a></li>
<li><a href='index.php?mod=cart&act=productManage'>產品管理</a></li>
<li><a href='index.php?mod=cart&act=cateManage'>分類管理</a></li>
<li><a href='index.php?mod=cart&act=updHot'>更改熱銷商品</a></li>
<li><a href='index.php?mod=cart&act=stat'>訂單分析</a></li>
<?php endif; ?>