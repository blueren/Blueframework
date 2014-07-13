<?php switch ($this->type): case 'dump': ?>   
<pre>
<?php var_dump($this->obj);?>
</pre>
<?php break; ?>
<!--登入 -->
<?php case 'login': ?>   
    <?php if ($this->priv==1): ?> 
    <h3>歡迎使用者<?php echo $this->username; ?></h3>
    <?php elseif ($this->priv==2): ?>
    <h3>歡迎管理者<?php echo $this->username; ?></h3>
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
    <div class="alert alert-warning">
        <strong>錯誤!</strong> 請確定您的登入狀態.
    </div>
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

<?php break; ?>

<!--登出 -->
<?php case 'logout': ?>  
    <p>您已登出，將為您導引至首頁...</p>
<?php break; ?>

<!--主控台 -->
<?php case 'userManage': ?>
<table class='responsive'>
    <tr>
        <td>權限</td>
        <td>日期</td>
        <td>帳號</td>
        <td>姓名</td>
        <td>修改</td>
        <td>刪除</td>
    </tr>
    <?php foreach($this->obj->content as $i => $v): ?>
    <tr>
        <td><?php echo $v->type; ?></td>
        <td><?php echo $v->reg_dte; ?></td>
        <td><?php echo $v->username; ?></td>
        <td><?php echo $v->name; ?></td>
        <td><a href='index.php?mod=user&act=updManage&id=<?php echo $v->id; ?>'>修改</td>
        <td><a href='index.php?mod=user&act=exe_delUser&id=<?php echo $v->id; ?>'>刪除</a></td>
    </tr>    
    <?php endforeach; ?>
</table>  
<ul class="pagination">
<li><a href="index.php?mod=user&act=userManage&page=<?php echo $this->obj->current_page-1; ?>">&laquo;</a></li>
<?php for($i=1;$i<=$this->obj->total_page;$i++): ?>
    <?php if($i == $this->obj->current_page): ?>
    <li class="active"><a href="#"><?php echo $i; ?> <span class="sr-only">(current)</span></a></li>
    <?php else: ?>
    <li><a href='index.php?mod=user&act=userManage&page=<?php echo $i; ?>'><?php echo $i; ?></a></li>
    <?php endif; ?>
<?php endfor; ?>
<li><a href="index.php?mod=user&act=userManage&page=<?php echo $this->obj->current_page+1; ?>">&raquo;</a></li>
</ul> 
<?php break; ?>

<!--註冊 -->
<?php case 'reg': ?> 

<form method='POST' action='?mod=user&act=exe_reg'>
<p><label for='user'>帳號: </label><input type='text' name='user' /></p>
<p><label for='name'>姓名: </label><input type='text' name='name' /></p>
<p><label for='pwd'>密碼: </label><input type='password' name='pwd' /></p>
<p><label for='re_pwd'>再輸入一次: </label><input type='password' name='re_pwd' /></p>
<p><label for='email'>Email: </label><input type='email' name='email' /></p>
<p><label for='gender'>性別: </label><input type='radio' name='gender' value='M' checked />男<input type='radio' name='gender' value='F' />女</p>
<p><label for='birthday'>生日: </label><input type='date' name='birthday' /></p>
<p><label for='tel'>電話: </label><input type='text' name='tel' /></p>
<p><label for='addr'>地址: </label><input type='text' name='addr' /></p>

<p><input type='submit' value='送出' /></p>
</form>
<?php break; ?>

<!--收件夾 -->
<?php case 'msgbox': ?>
    <p><a href='index.php?mod=user&act=sendmsg'>新增郵件</a></p>
    <table class='responsive' class='msgbox'>
    <tr>
        <td>寄件人</td>
        <td>標題</td>
        <td>時間</td>
    </tr>

<?php foreach ($this->obj as $i => $v): ?>   
    <tr>
    <?php if ($v->isread==1): ?>
        <td class='isread mbsender'><input type='checkbox' name='chk' /> <?php echo $v->username;?></td>
        <td onclick=rdmsg(<?php echo $v->messageid;?>) class='isread mbtitle'><div id='rdmore'><?php echo $v->title;?> - <?php echo htmlentities($v->message);?></div></td>        
        <td onclick=rdmsg(<?php echo $v->messageid;?>) class='isread mbdate'><?php echo $v->posttime;?></td>        
    <?php else: ?>
        <td class='unread mbsender'><input type='checkbox' name='chk' /> <?php echo $v->username;?></td>
        <td onclick=rdmsg(<?php echo $v->messageid;?>) class='unread mbtitle'><div id='rdmore'><?php echo $v->title;?> - <?php echo htmlentities($v->message);?></div></td>        
        <td onclick=rdmsg(<?php echo $v->messageid;?>) class='unread mbdate'><?php echo $v->posttime;?></td>           
    <?php endif; ?>
    </tr>
<?php endforeach; ?>
    </table>
<?php break; ?>

<!--訊息 -->
<?php case 'msg': ?> 
<h2>&#187; <?php echo $this->obj->title;?></h2>
<p><?php echo $this->obj->username;?>(<?php echo $this->obj->send;?>)</p>
<p>寄給 <?php echo $this->obj->receivename;?></p>
<p><?php echo $this->obj->message;?></p>
<form method='POST' action='?mod=user&act=exe_sendmsg'>
<p><input type='hidden' name='receive' value='<?php echo $this->obj->username;?>' /></p>
<p><input type='hidden' name='title' value='Fw:<?php echo $this->obj->title;?>' /></p>
<p><textarea name='msg'></textarea></p>
<p><input type='submit' value='回覆' /></p>
</form>
<?php break; ?>

<!--寄送訊息 -->
<?php case 'sendmsg': ?> 
    <form method='POST' action='?mod=user&act=exe_sendmsg'>
        <p><label for='receive'>收件人: </label><input type='text' name='receive'></p>
        <p><label for='title'>主旨: </label><input type='text' name='title'></p>
        <p><label for='msg'>內容: </label><textarea name='msg'></textarea></p>
        <p><input type='submit'></p>
    </form>
<?php break; ?>

<!--寄送完成頁面 -->
<?php case 'exe_sendmsg': ?> 
    <p>短訊傳送完成</p>
    <a href='index.php'>回主頁</a>
<?php break; ?>

<!--修改密碼 -->
<?php case 'upd': ?> 
    <p><a href='index.php?mod=user&act=updPassword'>修改密碼(須重新登入)</a></p>
    <form method='POST' action='?mod=user&act=exe_upd'>       
        <p><label for='user'>帳號: </label><?php echo $this->obj->username; ?></p>
        <p><label for='name'>姓名: </label><input type='text' name='name' value='<?php echo $this->obj->name; ?>' /></p>
        <p><label for='email'>Email: </label><input type='email' name='email' value='<?php echo $this->obj->email; ?>' /></p>
        <p><label for='tel'>電話: </label><input type='text' name='tel' value='<?php echo $this->obj->tel; ?>' /></p>
        <p><label for='addr'>地址: </label><input type='text' name='addr' size='40' value='<?php echo $this->obj->address; ?>' /></p>
        <p><input type='submit' value='送出修改' /></p>
    </form>
<?php break; ?>

<?php case 'updManage': ?> 
    <form method='POST' action='?mod=user&act=exe_updManage&id=<?php echo $this->obj->id; ?>'>       
        <p><label for='user'>帳號: </label><input type='text' name='user' value='<?php echo $this->obj->username; ?>' /></p>
        <p><label for='name'>姓名: </label><input type='text' name='name' value='<?php echo $this->obj->name; ?>' /></p>
        <p><label for='email'>Email: </label><input type='email' name='email' value='<?php echo $this->obj->email; ?>' /></p>
        <p><label for='tel'>電話: </label><input type='text' name='tel' value='<?php echo $this->obj->tel; ?>' /></p>
        <p><label for='addr'>地址: </label><input type='text' name='addr' size='40' value='<?php echo $this->obj->address; ?>' /></p>
        <p><label for='addr'>權限: </label><select name='type'>
        <?php foreach($this->uType as $i => $v): ?>
            <?php if ($this->obj->type==$i): ?>
            <option selected value='<?php echo $i; ?>'><?php echo $v; ?></option>
            <?php else: ?>
            <option value='<?php echo $i; ?>'><?php echo $v; ?></option>
            <?php endif; ?>
        <?php endforeach; ?>
        </select>
        </p>
        <p><input type='submit' value='送出修改' /></p>
    </form>
<?php break; ?>

<?php case 'updPassword': ?> 
    <p><?php echo $this->chkpwd; ?></p>
    <form method='POST' action='?mod=user&act=updPassword'>
        <p><label for='pw'>請輸入原始密碼: </label><input type='text' name='pw' /></p>
        <p><label for='npw'>請輸入新密碼: </label><input type='text' name='npw' /></p>
        <p><label for='npw2'>請再次輸入新密碼: </label><input type='text' name='npw2' /></p>
        <p><input type='submit' value='確認修改' /></p>    
    </form>
    
<?php break; ?>

<?php endswitch;?>
