<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

$fb_login_url = FB_AUTH_URI.'&redirect_uri='.urlencode(FB_REDIRECT_URI).'&scope=email&state='.session_id();
$vk_login_url = VK_AUTH_URI.'&redirect_uri='.urlencode(VK_REDIRECT_URI).'&scope=email&state='.session_id();

if(!$USER) :
?>
<script>
$(document).ready(function(){
    $('#form-login').submit(function(){
        if($('#form-login .inp-email').val() != '' && $('#form-login .inp-passw').val() != '' )
            return true;
        else {
            show_message('<?=LNG_ERR_LOGIN_EMPTY;?>'); return false; }
    });

    $('#form-register').submit(function(){
        if(check_fname($('#form-register .inp-fname')))
            if(check_email($('#form-register .inp-email')))
                if(check_passw($('#form-register .inp-passw')))
                    return true;
                else {
                    show_message('<?=LNG_ERR_LOGIN_PASSW;?>'); return false; }
            else {
                show_message('<?=LNG_ERR_LOGIN_EMAIL;?>'); return false; }
        else {
            show_message('<?=LNG_ERR_LOGIN_FNAME;?>'); return false; }
    });
});
</script>
<div class="login-panel">
  <div class="fb-login">
    <a href="<?=$fb_login_url;?>"><?=LNG_FB_LOGIN;?></a>
  </div>
  <div class="vk-login">
    <a href="<?=$vk_login_url;?>"><?=LNG_VK_LOGIN;?></a>
  </div>
  <span id="form-login-msg"></span>
  <form action="<?=$URI;?>?task=login&<?=$LNG_URI_PARAM;?>" method="post" id="form-login">
    <div class="login-form">
      <!--
      <input type="hidden" name="<?=LNG_PARAM;?>" value="<?=$LNG;?>" />
      <input type="hidden" name="task" value="login" />
      -->
      <div class="inp"><input type="text" name="email" class="inp-email" placeholder="<?=LNG_EMAIL;?>" />
      <div class="inp"><input type="password" name="passw" class="inp-passw" placeholder="<?=LNG_PASSW;?>" /></div>
      <div class="inp"><button type="submit"><?=LNG_BTN_LOGIN;?></button></div>
    </div>
  </form>
  <span id="form-register-msg"></span>
  <form action="<?=$URI;?>?task=register&<?=$LNG_URI_PARAM;?>" method="post" id="form-register">
    <div class="register-form" id="form-register">
      <!--
      <input type="hidden" name="<?=LNG_PARAM;?>" value="<?=$LNG;?>" />
      <input type="hidden" name="task" value="register" />
      -->
      <div class="inp"><input type="text" name="full_name" class="inp-fname" placeholder="<?=LNG_FULLNAME;?>" /></div>
      <div class="inp"><input type="text" name="email" class="inp-email" placeholder="<?=LNG_EMAIL;?>" /></div>
      <div class="inp"><input type="password" name="passw" class="inp-passw" placeholder="<?=LNG_PASSW;?>" /></div>
      <div class="inp"><button type="submit"><?=LNG_BTN_REGISTER;?></button></div>
    </div>
  </form>
</div>
<?php endif; ?>