<?
if ($access[$p] == 1) {
	$max=mysql_fetch_array(mysql_query("select max(id) as id from battles where offer='".$stat['battle']."'"));
	if (!$max) $new_id=1;
	else $new_id=$max['id']+1;
	$inf_sel = mysql_query("SELECT id, hp_now FROM players WHERE user='$enemy'");
	if (mysql_num_rows($inf_sel) == 1) {
		$info = mysql_fetch_array($inf_sel);
		$add_dmg_by_lvl = (int)(rand(($stat[strength]/3+$stat[min])*(1+($stat['ork']/100)),
		(1+$stat[strength]/1.5+$stat[max])*(1+($stat['ork']/100))));
		$add_hp = $info[hp_now] - $add_dmg_by_lvl;
		$text = "<script language=JavaScript>show_inf(\"".$stat['user']."\",\"".$stat['id']."\",\"".$stat['level']."\",\"".$stat['rank']."\",\"".$stat['tribe']."\");</script> применил прием <b>\"Сокрушающий удар\"</b> и тем самым нанес <b>$add_dmg_by_lvl</b> урона персонажу $enemy<HR COLOR=e2e0e0>";
		mysql_query("UPDATE players SET hp_now = $add_hp where id = $info[id]");
		mysql_query("UPDATE participants SET hp = $add_hp where id = $info[id] and time = $stat[battle]");
		mysql_query("UPDATE battles_stat SET a=a-$min_a[$p], d=d-$min_d[$p], u=u-$min_u[$p], k=k-$min_k[$p] WHERE u_id = $stat[id]");
		mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment, side, priem)
                     values ($stat[battle], $now, $new_id, '$stat[user]', '$opponent', '', '', '1', '0', '$text', '2', '$p')");
	}
	$access[$p] = 0;
}
?>