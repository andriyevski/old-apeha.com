<?php
// хаоты
$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'"));

if ($page=="start" || !$page) {
	mysql_query("LOCK TABLES battles WRITE, offers WRITE, participants WRITE, players WRITE, obstacles WRITE");
	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time,offers.zone_type from offers, participants WHERE offers.time>".$now." AND offers.start-".$now."<=10 AND participants.id=".$stat['id']." AND offers.type=3 AND offers.done=0 AND offers.time=participants.time"));

	if ($user_offer) {

		mysql_query("UPDATE offers SET done=1,type=2 WHERE time=".$user_offer['time']);
		// echo "UPDATE offers SET done=1,type=2 WHERE time=".$user_offer['time'].'<BR>';
		$participants_num=mysql_fetch_array(mysql_query("SELECT count(distinct id) AS id FROM participants WHERE time=".$user_offer['time']));
		$parts_num=$participants_num['id']-$participants_num['id']%2;
		if ($parts_num >1) { 
			$ms=3;//что ж это за херь такая?...
			$kol=0;

			$bdate=date("d.m.y H:i",$now);

			//                         mysql_query("INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values (".$user_offer['time'].", ".$now.", '0', '', '', '', '', NULL, '', 'Часы показывали <U>$bdate</U> когда бой начался!')");
			mysql_query("INSERT INTO battles (offer, time, id, type, comment1) values (".$user_offer['time'].", ".time().", '0', 2, 'Часы показывали 26.02.10 16:40 когда бой начался!')");
			// echo "INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values (".$user_offer['time'].", ".$now.", '0', '', '', '', '', NULL, '', 'Часы показывали <U>$bdate</U> когда бой начался!')<br>";

			$participants=mysql_query("SELECT participants.id, participants.side, players.user, players.room from participants,players WHERE participants.time=".$user_offer['time']." AND participants.id=players.id order by players.level DESC");
			// echo "SELECT participants.id, participants.side, players.user, players.room from participants,players WHERE participants.time=".$user_offer['time']." AND participants.id=players.id order by players.level DESC<BR>";
			$locality = $user_offer['zone_type'];
			$no_obst = true;
			include "inc/battle/obstacles.php";
			require_once("inc/chat/functions.php");
			$li=1;
			$ri=1;
			while ($participant=mysql_fetch_array($participants)) {

				if($ms<2 || $kol>=$parts_num)
				{
					mysql_query("update participants set side=1,y=".$ri.",x=$def_x2  where id=".$participant['id']." and participants.time=".$user_offer['time']);
					// echo "update participants set side=1,y=".$ri."  where id=".$participant['id']." and participants.time=".$user_offer['time'].'<BR>';
					$ri++;
					$participant['side']=1;
				}else{
					mysql_query('update participants set y='.$li.',x='.$def_x1.' where id='.$participant['id'].' and participants.time='.$user_offer['time']);
					// echo 'update participants set y='.$li.' where id='.$participants['id'].' and participants.time='.$user_offer['time'].'<BR>';
					$li++;
				}


				$ms=$kol%4;
				$kol=$kol+1;

				mysql_query("UPDATE players SET battle=".$user_offer['time'].", bside=".$participant['side']." WHERE id=".$participant['id']);
				// echo "UPDATE players SET battle=".$user_offer['time'].", side=".$participant['side']." WHERE id=".$participant['id'].'<BR>';

				insert_msg("Часы показывали <U>$bdate</U>, когда Ваш бой начался!","","","1",$participant['user'],"",$participant['room']);
			}
			mysql_query('update offers set zone_height='.(($zone_type!='none')?$y_size:(($ri>$li)?$ri:$li)+1).' where time='.$user_offer['time']);
			// echo 'update offers set zone_height='.((($ri>$li)?$ri:$li)+2).' where time='.$user_offer['time'];
			$stat['battle'] = $user_offer['time'];
			echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";

		}
		else {
			mysql_query("DELETE FROM offers WHERE time=".$user_offer['time']."");
			mysql_query("DELETE FROM participants WHERE time=".$user_offer['time']."");

			require_once("inc/chat/functions.php");
			insert_msg("Ваш бой не может начаться, т.к. группа не набрана!","","","1",$stat['user'],"",$stat['room']);
		}
	}

	mysql_query("UNLOCK TABLES");

}

// Подача новой заявки
else if ($page=="newbattle") {
	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time from offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));

	if ($user_offer)
	$offer_str="<br>Для начала с одной заявкой разберись...";
	elseif ($stat['hp_now']<($stat['vitality']*5+$stat['hp'])/3)
	$offer_str="Вы слишком ослаблены для поединка! Восстановитесь...";
	else {

		$user_offer = 1;

		switch ($timeout) {
			case 3: $timeo = 180; break;
			case 5: $timeo = 300; break;
			case 10: $timeo = 600; break;
			default: $timeo = 120; break;
		}


		// Время до начала поединка
		if ($time_battle_start!=180 && $time_battle_start!=300 && $time_battle_start!=600 && $time_battle_start!=900) $time_battle_start=180;

		$time_battle_start+=$now;
		//

		$time=$now+600;
		
// вставляем препятствия
   include "inc/battle/obstacles.php";
//

		mysql_query("LOCK TABLES offers WRITE");

		while (mysql_fetch_array(mysql_query("select * from offers where time=$time")))
		$time++;

		$comment = HtmlSpecialChars($comment);

		// Уровни
		switch ($offer_level_1) {
			case 1: $level_l_min=0; $level_l_max=100; break;
			case 2: $level_l_min=$stat['level']; $level_l_max=$stat['level']; break;
			case 3: $level_l_min=0; $level_l_max=$stat['level']; break;
			case 4: $level_l_min=0; $level_l_max=$stat['level']-1; break;
		}

		// Размеры команд
		//
		mysql_query("INSERT INTO offers (`time`,`type`,`size_left`,`size_right`,`timeout`,`comment`,`blood`,`start`,`level_l_min`,`level_l_max`,`level_r_min`,`level_r_max`,`zone_width`,`zone_height`,`zone_type`) VALUES (".$time.",3,'".(isset($max_players)?$max_players:99)."','0',".$timeo.", '".$comment."',".$blood.",'".$time_battle_start."','".$level_l_min."','".$level_l_max."','0','0',".(isset($x_size)?$x_size:6).",0,'$zone_type')");

		mysql_query("UNLOCK TABLES");

		mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`) VALUES (".$time.",".$stat['id'].",0,".$levels['base'].",".$stat['hp_now'].")");

		header("Location: battle.php?battle_type=3&page=start&".$now."");
	}
}

// Принятие заявки
else if ($page=="take_it" && $offer) {
	$user_offer=mysql_num_rows(mysql_query("SELECT offers.time FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));

	if ($user_offer > 0)
	$offer_str="<br>Для начала с одной заявкой разберись...";
	elseif ($stat['hp_now']<($stat['vitality']*5+$stat['hp'])/3)
	$offer_str="Вы слишком ослаблены для поединка! Восстановитесь...";
	else {

		$user_offer = 1;

		$offer_inf=mysql_fetch_array(mysql_query("SELECT size_left,size_right,level_l_min,level_l_max,level_r_min,level_r_max FROM offers WHERE  time=".$offer.""));
		$players_now = mysql_num_rows(mysql_query('select id from participants where time='.$offer));
		mysql_query("LOCK TABLES participants WRITE");

		if ($stat['level'] < $offer_inf['level_l_min']) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif (($offer_inf['level_l_min'] == $offer_inf['level_l_max']) && ($stat['level'] != $offer_inf['level_l_min'])) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif ($stat['level'] > $offer_inf['level_l_max']) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif($players_now >= $offer_inf['size_left']) $offer_str="<br>Достигнуто максимальное количество бойцов для данной заявки!";

		else {

			mysql_query("insert into participants (`time`,`id`,`side`,`base`,`hp`) values ($offer,$stat[id],0,".$levels['base'].",".$stat['hp_now'].")");

			mysql_query("UPDATE players SET side=0, offer=".$offer." WHERE id=".$stat['id']."");

			Header("Location: battle.php?battle_type=3&page=start&$now");
		}
		mysql_query("UNLOCK TABLES");
	}
}

$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time,offers.type,participants.side FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));
?>
