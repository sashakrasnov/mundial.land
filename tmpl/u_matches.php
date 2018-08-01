
    <div id="form-input" class="<?=$C;?>">
<?php

// Создаем реверсивный массив даты/матчи
foreach($$C as $uc => $un)
{
  $u_matches_rev[$un['dt']][$un['ct']] = $un;
  $u_matches_rev[$un['dt']][$un['ct']]['id'] = $uc;
}
//$u_dates = array_keys($u_matches_rev);
$u_dates = date_range($u_matches[1]['dt'], $u_matches[count($u_matches)]['dt'], '+1 day', 'Y-m-d w');

$c_dt = date('Y-m-d'); // Текущая дата. Будем отсекать с помощью нее лишние даты

?>
    <table id="form-imput" border>

      <tr><th></th><?php foreach($u_cities as $u_ct): ?><th><span class="city"><?=$u_ct;?></span></th><?php endforeach; ?></tr>

      <?php foreach($u_dates as $u_dt):
        $dt = substr($u_dt, 0, 10);
        $dd = intval($u_dt[8].$u_dt[9]);
        $mm = intval($u_dt[5].$u_dt[6]);
        $ww = intval($u_dt[11]); //$ww = date('w', strtotime($dt));
      ?>
      <?php if($dt >= $c_dt): ?>
      <tr><td><div class="event-date"><div class="day"><?=$dd;?></div><div class="month"><?=LNG_MONTHES[$mm];?></div><div class="weekday"><?=LNG_WEEKDAYS[$ww];?></div></div></td>
          <?php if(isset($u_matches_rev[$dt])): ?>
            <?php foreach($u_cities as $u_ct): ?>
            <td><div class="event">
            <?php if(isset($u_matches_rev[$dt][$u_ct])): $u_m = $u_matches_rev[$dt][$u_ct]; ?>
                <button id="<?=$C.'-'.$u_m['id'];?>" class="checkable <?=($V[$u_m['id']] ? 'checked' : '');?>" data-name="<?=$C;?>" data-val="<?=$u_m['id'];?>">
                    <div class="num"><?=$u_m['id'];?></div>
                    <div class="time"><?=$u_m['hm'];?></div>
                    <div class="team1"><?=$u_m['t1'];?></div>
                    <div class="team2"><?=$u_m['t2'];?></div>
                </button>
            <?php else: ?>
                <div class="empty"></div>
            <?php endif; ?>
            </div></td>
            <?php endforeach; ?>
          <?php else: ?>
            <td colspan="<?=count($u_cities);?>"><?=LNG_HOLIDAYS;?></td>
          <?php endif; ?>
      </tr>
      <?php endif; ?>
      <?php endforeach; ?>
    </table>
    </div>

