<?php

$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'"));

if ($page=="start" || !$page) {
	mysql_query("LOCK TABLES battles WRITE, offers WRITE, participants WRITE, players WRITE");

	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time from offers, participants WHERE offers.time>".$now." AND offers.start-".$now."<=10 AND participants.id=".$stat['id']." AND offers.type=2 AND offers.done=0 AND offers.time=participants.time"));
	// echo "SELECT offers.time from offers, participants WHERE offers.time>".$now." AND offers.start-".$now."<=10 AND participants.id=".$stat['id']." AND offers.type=2 AND offers.done=0 AND offers.time=participants.time<br>";
	if ($user_offer) {

		mysql_query("UPDATE offers SET done=1 WHERE time=".$user_offer['time']."");

		$participants=mysql_fetch_array(mysql_query("SELECT count(distinct side) AS count FROM participants WHERE time=".$user_offer['time'].""));
		// echo "SELECT count(distinct side) AS count FROM participants WHERE time=".$user_offer['time']."<BR>".$participants['count'].'<HR>';
		if ($participants['count'] > 1) {

			$bdate=date("d.m.y H:i",$now);

			mysql_query("INSERT INTO battles (offer, time, id, type, comment1) values (".$user_offer['time'].", ".$now.", '0', 2, 'Часы показывали <U>$bdate</U> когда бой начался!')");
			// echo "INSERT INTO battles (offer, time, id, type, comment1) values (".$user_offer['time'].", ".$now.", '0', 2, 'Часы показывали <U>$bdate</U> когда бой начался!')";

			$participants=mysql_query("SELECT participants.id, participants.side, players.user, players.room from participants,players WHERE participants.time=".$user_offer['time']." AND participants.id=players.id");
			// echo '<BR>'."SELECT participants.id, participants.side, players.user, players.room from participants,players WHERE participants.time=".$user_offer['time']." AND participants.id=players.id";

			require_once("inc/chat/functions.php");

			while ($participant=mysql_fetch_array($participants)) {
				mysql_query("UPDATE players SET battle=".$user_offer['time'].", bside=".$participant['side']." WHERE id=".$participant['id']."");
				// echo "UPDATE players SET battle=".$user_offer['time'].", bside=".$participant['side']." WHERE id=".$participant['id']."";
				insert_msg("Часы показывали <U>$bdate</U>, когда Ваш бой начался!","","","1",$participant['user'],"",$participant['room']);
				//echo"<script>parent.main.location=\"battle.php?battle_type=2&tmp=\"+Math.random();\"\"</script>";
			}

			$stat['battle'] = $user_offer['time'];

		}
		else {
			mysql_query("DELETE FROM offers WHERE time=".$user_offer['time']."");
			mysql_query("DELETE FROM participants WHERE time=".$user_offer['time']."");

			require_once("inc/chat/functions.php");
			insert_msg("Ваш бой не может начаться, т.к. группа не набрана!","","","1",$stat['user'],"",$stat['room']);
			//echo"<script>parent.main.location=\"battle.php?battle_type=2&tmp=\"+Math.random();\"\"</script>";
		}
	}
	mysql_query("UNLOCK TABLES");

}

// Подача новой заявки
else if ($page=="newbattle") {
	
	//die($locality);
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



		$comment = HtmlSpecialChars($comment);

		// Уровни
		switch ($offer_level_1) {
			case 1: $level_l_min=0; $level_l_max=100; break;
			case 2: $level_l_min=$stat['level']; $level_l_max=$stat['level']; break;
			case 3: $level_l_min=0; $level_l_max=$stat['level']; break;
			case 4: $level_l_min=0; $level_l_max=$stat['level']-1; break;
		}

		switch ($offer_level_2) {
			case 1: $level_r_min=0; $level_r_max=100; break;
			case 2: $level_r_min=$stat['level']; $level_r_max=$stat['level']; break;
			case 3: $level_r_min=0; $level_r_max=$stat['level']; break;
			case 4: $level_r_min=0; $level_r_max=$stat['level']-1; break;
		}
		//

		// Размеры команд
		if (is_numeric($size_left) && ($size_left>=1 && $size_left<=99))
		$size_left=$size_left;
		else
		$size_left=2;

		if (is_numeric($size_right) && ($size_right>=2 && $size_right<=99))
		$size_right=$size_right;
		else
		$size_right=2;
		//
// вставляем препятствия
   include "inc/battle/obstacles.php";
//

		mysql_query("LOCK TABLES offers WRITE");

		while (mysql_fetch_array(mysql_query("select * from offers where time=$time")))
		$time++;

		mysql_query("INSERT INTO offers (`time`,`type`,`size_left`,`size_right`,`timeout`,`comment`,`start`,`level_l_min`,`level_l_max`,`level_r_min`,`level_r_max`,`zone_width`,`zone_height`,`zone_type`) VALUES (".$time.",2,'".$size_left."','".$size_right."',".$timeo.",'".$comment."','".$time_battle_start."','".$level_l_min."','".$level_l_max."','".$level_r_min."','".$level_r_max."',".(isset($x_size)?$x_size:6).",".(isset($y_size)?$y_size:((($size_left>$size_right)?$size_left:$size_right)+2)).",'".$zone_type."')");//|| die(mysql);

		mysql_query("UNLOCK TABLES");

		mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`,`x`,`y`) VALUES (".$time.",".$stat['id'].",0,".$levels['base'].",".$stat['hp_now'].",1,1)");

		header("Location: battle.php?battle_type=2&page=start&".$now."");
	}
	echo"<script>parent.main.location=\"battle.php?battle_type=2&tmp=\"+Math.random();\"\"</script>";
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

		if ($battle_side !=0 && $battle_side !=1 ) $battle_side=0;

		$offer_inf=mysql_fetch_array(mysql_query("SELECT size_left,size_right,level_l_min,level_l_max,level_r_min,level_r_max FROM offers WHERE  time=".$offer.""));

		mysql_query("LOCK TABLES participants,players WRITE");

		$side_0=mysql_num_rows(mysql_query("SELECT * FROM participants WHERE time=".$offer." && side=0"));

		$side_1=mysql_num_rows(mysql_query("SELECT * FROM participants WHERE time=".$offer." && side=1"));

		if ($side_0 >= $offer_inf['size_left'] && $battle_side == 0) $offer_str="<br>Группа уже набрана!";
		elseif ($side_1 >= $offer_inf['size_right'] && $battle_side == 1) $offer_str="<br>Группа уже набрана!";

		elseif ($stat['level'] < $offer_inf['level_l_min'] && $battle_side == 0) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif (($offer_inf['level_l_min'] == $offer_inf['level_l_max']) && ($stat['level'] != $offer_inf['level_l_min']) && $battle_side == 0) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif ($stat['level'] > $offer_inf['level_l_max'] && $battle_side == 0) $offer_str="<br>Эта заявка не может быть принята Вами!";

		elseif ($stat['level'] < $offer_inf['level_r_min'] && $battle_side == 1) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif (($offer_inf['level_r_min'] == $offer_inf['level_r_max']) && ($stat['level'] != $offer_inf['level_r_min']) && $battle_side == 1) $offer_str="<br>Эта заявка не может быть принята Вами!";
		elseif ($stat['level'] > $offer_inf['level_r_max'] && $battle_side == 1) $offer_str="<br>Эта заявка не может быть принята Вами!";
		else {
			$no_obst=true;
			include "inc/battle/obstacles.php";
			mysql_query("insert into participants (`time`,`id`,`side`,`base`,`hp`,`x`,`y`) values ($offer,$stat[id],$battle_side,".$levels['base'].",".$stat['hp_now'].",".(($battle_side==0)?$def_x1:$def_x2).",".(1+(($battle_side==0)?$side_0:$side_1)).")");

			mysql_query("UPDATE players SET bside=".$battle_side.", offer=".$offer." WHERE id=".$stat['id']."");

			Header("Location: battle.php?battle_type=2&page=start&$now");
		}
		mysql_query("UNLOCK TABLES");
	}
}

$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time,offers.type,participants.side FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));
?>
