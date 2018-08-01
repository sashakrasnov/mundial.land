<div id="login-message" style="display: <?php print $LOGIN_MSG ? 'block' : 'none'; ?>;">
    <p class="message"><?php print $LOGIN_MSG; ?></p>
    <p class="btn-close"><a href="javascript: hide_message();">X</a></p>
</div>
<?php if($USER) : ?>
<div id="save-popup" style="display: none;"><button><?=LNG_BTN_SAVE;?></button></div>
<?php endif; ?>