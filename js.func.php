<?php
/**
  * Генерирование кода на JS, зависимого от авторизации
  */

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

?>
    <script>
    $(document).ready(function(){
        $('#form-input .checkable').click(function() {
            toggle_checkable($(this));
            <?php if(!$USER) : ?>
            cfg_save();
            <?php else : ?>
            save_show();
            <?php endif; ?>
            //console.log(cfg);
        });
        $('#form-input input').change(function() {
           cfg[$(this).attr('data-name')][$(this).attr('data-val')] = $(this).val();
           save_show();
           //console.log(cfg);
        });
        <?php if($USER) : ?>
        $('#save-popup button').click(function() {
            $('#save-popup').fadeOut(100);
            $.post('/updt.ajax.php?'+lng_uri, cfg, function(data) {
                if(data) show_message(data);
                save_hide();
            });
        });
        <?php endif; ?>
    });
    </script>
