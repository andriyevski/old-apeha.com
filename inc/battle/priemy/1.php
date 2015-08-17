<?
//$stat['hp_now']=$stat['hp_now'] + $_obj['hp'];
$stat['hp_max']=ceil(($stat['vitality']*5)*(1+($stat['gnom']/100))+ $_obj['hp']);
$add_hp_3=ceil(($stat['hp_max']/100)*3);
if (($stat[hp_now]+$add_hp_3) >= $stat[hp_max]) {
	$add_hp = $stat[hp_max];
	$stat[hp_now] = $stat[hp_max];
}
else {
	$add_hp = $stat[hp_now] + $add_hp_3;
	$stat[hp_now]+=$add_hp_3;
}

mysql_query("UPDATE players SET hp_now = $add_hp where id = $stat[id]");
mysql_query("UPDATE participants SET hp = $add_hp where id = $stat[id] and time = $stat[battle]");
mysql_query("UPDATE battles_stat SET a=a-$min_a[$p], d=d-$min_d[$p], u=u-$min_u[$p], k=k-$min_k[$p] WHERE u_id = $stat[id]");
$text = "<script language=JavaScript>show_inf(\"".$stat['user']."\",\"".$stat['id']."\",\"".$stat['level']."\",\"".$stat['rank']."\",\"".$stat['tribe']."\");</script> применил прием <b>\"+$add_hp_3 HP\"</b><HR COLOR=e2e0e0>";
$max=mysql_fetch_array(mysql_query("select max(id) as id from battles where offer='".$stat['battle']."'"));
if (!$max) $new_id=1;
else $new_id=$max['id']+1;
mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment, side, priem)
                 values ($stat[battle], $now, $new_id, '$stat[user]', '$opponent', '', '', '1', '0', '$text', '2', '$p')");
$access[$p] = 0;

?>