<div style='display:block' data-pjax='content'>
<?php if ($this->priv==1 || $this->priv==2 ): ?>   
<li><a class='list-group-item' href='index.php?mod=user&act=logout'>登出</a></li>

<?php foreach($this->sidebar_arr as $i => $obj): ?>
    <?php foreach($obj->admin as $j => $v): ?>
    <li><a class='list-group-item' href='<?php echo $v; ?>'><?php echo $j; ?></a> </li>
    <?php endforeach; ?>
    <?php foreach($obj->user as $j => $v): ?>
    <li><a class='list-group-item' href='<?php echo $v; ?>'><?php echo $j; ?></a> </li>
    <?php endforeach; ?>    
<?php endforeach; ?>


<?php else: ?>
<form class='form-signin' role='form' method='POST' action='?mod=user&act=login'>
<h2 class='form-signin-heading'>Please sign in</h2>
<input type="hidden" name="token" value="<?php echo $this->token; ?>" />
<input type='text' name='user' class='form-control' placeholder='Username' required='' autofocus=''>
<input type='password' name='pw' class='form-control' placeholder='Password' required=''>
<button class='btn btn-lg btn-primary btn-block' type='submit'>登入</button>
<p>
    <div class="checkbox">
        <label><input type="checkbox" name='remember'> 記住我</label>
    </div>
    <a href='index.php?mod=user&act=reg'>註冊</a> | <a href='#'>忘記密碼</a>
</p>
</form> 

<?php endif; ?>
</div>