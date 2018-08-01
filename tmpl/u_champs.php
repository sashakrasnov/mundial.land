<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

?>
    <div id="form-input" class="<?=$C;?>">
<?php foreach($$C as $uc => $un) : ?>
        <button id="<?=$C.'-'.$uc;?>" class="checkable <?=($V[$uc] ? 'checked' : '');?>" data-name="<?=$C;?>" data-val="<?=$uc;?>"><?=$un[0];?></button>
<?php endforeach; ?>
    </div>
    <br />
