<?
$text = "<script language=JavaScript>show_inf(\"".$stat['user']."\",\"".$stat['id']."\",\"".$stat['level']."\",\"".$stat['rank']."\",\"".$stat['tribe']."\");</script> применил прием <b>\"+$add_armor_3 к защите\"</b><HR COLOR=e2e0e0>";
$max=mysql_fetch_array(mysql_query("select max(id) as id from battles where offer='".$stat['battle']."'"));
if (!$max) $new_id=1;
else $new_id=$max['id']+1;
mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment, side, priem)
                 values ($stat[battle], $now, $new_id, '$stat[user]', '$opponent', '', '', '1', '$add_armor_3', '$text', '2', '$p')");
$access[$p] = 0;
?>