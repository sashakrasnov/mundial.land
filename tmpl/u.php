<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

?>
<?php if($USER): ?>
    <div id="form-input" class="<?=$C;?>">
        <?=LNG_FULLNAME;?> <input data-name="<?=$C;?>" type="text" data-val="fname" value="<?=$V['fname'];?>" id="fname" placeholder="<?=LNG_FULLNAME;?>" />
        <?=LNG_BIRTHDAY;?> <input data-name="<?=$C;?>" type="text" data-val="bday" value="<?=$V['bday'];?>" id="bday" placeholder="<?=LNG_DT_PLACEHOLDER;?>" />
        <?=LNG_DATE_IN;?> <input data-name="<?=$C;?>" type="text" data-val="dt_in" value="<?=$V['dt_in'];?>" id="dt_in" placeholder="<?=LNG_DT_PLACEHOLDER;?>" />
        <?=LNG_DATE_OUT;?> <input data-name="<?=$C;?>" type="text" data-val="dt_out" value="<?=$V['dt_out'];?>" id="dt_out" placeholder="<?=LNG_DT_PLACEHOLDER;?>" />
        <?=LNG_PHONE;?> <input data-name="<?=$C;?>" type="text" data-val="phone" value="<?=$V['phone'];?>" id="phone" placeholder="<?=LNG_PHONE;?>" />
        <button id="<?=$C;?>-sms" class="checkable <?=($V['sms'] ? 'checked' : '');?>" data-name="<?=$C;?>" data-val="sms"><?=LNG_SMS;?></button>
        <button id="<?=$C;?>-scn" class="checkable <?=($V['scn'] ? 'checked' : '');?>" data-name="<?=$C;?>" data-val="scn"><?=LNG_SCN;?></button>
    </div>
<?php endif; ?>
