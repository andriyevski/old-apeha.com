<?
if ($access[$p] == 1) {
	$text = "<script language=JavaScript>show_inf(\"".$stat['user']."\",\"".$stat['id']."\",\"".$stat['level']."\",\"".$stat['rank']."\",\"".$stat['tribe']."\");</script> применил прием <b>\"Удачный удар\"</b><HR COLOR=e2e0e0>";
	$max=mysql_fetch_array(mysql_query("select max(id) as id from battles where offer='".$stat['battle']."'"));
	if (!$max) $new_id=1;
	else $new_id=$max['id']+1;
	if ($stat[level] == 0) {
		$add_dmg_by_lvl = (int)($add_dmg_lvl/2);
	}
	else {
		$add_dmg_by_lvl = $stat[level]*$add_dmg_lvl;
	}
	mysql_query("UPDATE battles_stat SET a=a-$min_a[$p], d=d-$min_d[$p], u=u-$min_u[$p], k=k-$min_k[$p] WHERE u_id = $stat[id]");
	mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment, side, priem)
                   values ($stat[battle], $now, $new_id, '$stat[user]', '$opponent', '', '', '1', '$add_dmg_by_lvl', '$text', '2', '$p')");
	$access[$p] = 0;
}
?>