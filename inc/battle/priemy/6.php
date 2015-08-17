<?

if ($access[$p] == 1) {
	$text = "<script language=JavaScript>show_inf(\"".$stat['user']."\",\"".$stat['id']."\",\"".$stat['level']."\",\"".$stat['rank']."\",\"".$stat['tribe']."\");</script> применил прием <b>\"Рывок\"</b><HR COLOR=e2e0e0>";
	$max=mysql_fetch_array(mysql_query("select max(id) as id from battles where offer='".$stat['battle']."'"));
	if (!$max) $new_id=1;
	else $new_id=$max['id']+1;
	$add_hp = $stat[hp_now] - (int)($stat[hp_now]*0.1);
	$stat[hp_now]-=(int)($stat[hp_now]*0.1);
	mysql_query("UPDATE players SET hp_now = $add_hp where id = $stat[id]");
	mysql_query("UPDATE participants SET hp = $add_hp where id = $stat[id] and time = $stat[battle]");
	mysql_query("UPDATE battles_stat SET a=a-$min_a[$p]+$add_a_rivok, d=d-$min_d[$p], u=u-$min_u[$p], k=k-$min_k[$p] WHERE u_id = $stat[id]");
	mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment, side, priem)
                   values ($stat[battle], $now, $new_id, '$stat[user]', '$opponent', '', '', '1', '0', '$text', '2', '$p')");
	$access[$p] = 0;
}

?>