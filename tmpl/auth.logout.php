<?php

if(basename($_SERVER['PHP_SELF']) == basename(__FILE__)) die;

if($USER) :

?>
<span class="logout"><a href="?task=logout&<?=$LNG_URI_PARAM;?>"><?=LNG_LOGOUT;?></a></span>
<?php

endif;

?>