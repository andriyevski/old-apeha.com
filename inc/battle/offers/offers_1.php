<?php

$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'"));

if ($page=="start") {
	mysql_query("LOCK TABLES battles WRITE, offers WRITE, participants WRITE, players WRITE, slots WRITE");

	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.id=".$stat['id']." AND offers.time=participants.time"));


	if ($user_offer) {
		$participants=mysql_fetch_array(mysql_query("SELECT count(distinct side) AS count FROM participants WHERE participants.time=".$user_offer['time'].""));

		if ($participants['count'] == 2) {

			$stat['battle'] = $user_offer['time'];

			mysql_query("UPDATE offers SET done=1 WHERE time=".$user_offer['time']."");

			$bdate=date("d.m.y H:i",$now);

			//                         mysql_query("INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) VALUES (".$user_offer['time'].", ".$now.", '0', '', '', '', '', NULL, '', '<i>Часы показывали <u>".$bdate."</u> когда бой начался!')");
			mysql_query("INSERT INTO battles (offer, time, id, type, comment1) VALUES (".$user_offer['time'].", ".$now.", 0, 2, '<i>Часы показывали <u>".$bdate."</u> когда бой начался!')");
			// echo "INSERT INTO battles (offer, time, id, type, comment1) VALUES (".$user_offer['time'].", ".$now.", 0, 2, '<i>Часы показывали <u>".$bdate."</u> когда бой начался!')";

			$participants=mysql_query("SELECT participants.id,players.user, players.room from participants,players WHERE participants.time=".$user_offer['time']." AND participants.id=players.id");

			require_once("inc/chat/functions.php");



			while ($participant=mysql_fetch_array($participants)) {
				mysql_query("UPDATE players SET battle=".$user_offer['time']." WHERE id=".$participant['id']."");

				insert_msg("Часы показывали <U>$bdate</U>, когда Ваш бой начался!","","","1",$participant['user'],"",$participant['room']);

				$offer=mysql_fetch_array(mysql_query("SELECT `kulak` FROM offers WHERE time='".$stat['battle']."' LIMIT 1"));
				if ($offer['kulak'] == 1){
					for ($i=0; $i<19; $i++) {
						$obj=mysql_fetch_array(mysql_query("SELECT slots.".addslashes($i)." as id, objects.hp, objects.energy FROM slots, objects WHERE slots.id=".$participant['id']." && objects.id=slots.".addslashes($i).""));
						mysql_query("UPDATE slots, players set slots.".addslashes($i)."=0, players.hp_now=if(players.hp_now<$obj[hp],0,players.hp_now-$obj[hp]), players.energy_now=if(players.energy_now<$obj[energy],0,players.energy_now-$obj[energy]) WHERE slots.id=".$participant['id']." AND players.id=".$participant['id']."");
					}

				}
			}

		}

	}
	mysql_query("UNLOCK TABLES");
	echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";

}

// Подача новой заявки
elseif ($page=="newbattle") {
	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));
	if ($user_offer)
	$offer_str="Для начала с одной заявкой разберись...";
	elseif ($stat[hp_now]<($stat[vitality]*5+$stat[hp])/3)
	$offer_str="Вы слишком ослаблены для поединка! Восстановитесь...";

	else {

		$user_offer = 1;

		switch ($timeout) {
			case 1: $timeo = 60; break;
			case 2: $timeo = 120; break;
			case 3: $timeo = 180; break;
			case 5: $timeo = 300; break;
			case 10: $timeo = 600; break;
			default: $timeo = 120; break;
		}
			
		$time = $now+600;

		mysql_query("LOCK TABLES offers WRITE");

		while (mysql_fetch_array(mysql_query("SELECT * FROM offers WHERE time=".$time."")))
		$time++;

		$comment = HtmlSpecialChars($comment);

		mysql_query("INSERT INTO offers (`time`,`type`,`size_left`,`size_right`,`timeout`,`comment`, `blood`, `kulak`, `zone_width`, `zone_height`) VALUES (".$time.",1,1,1,".$timeo.",'".$comment."',".$blood.",".$kulak.",6,3)");

		mysql_query("UNLOCK TABLES");

		mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`,`x`,`y`) VALUES (".$time.",".$stat['id'].",0,".$levels['base'].",".$stat['hp_now'].",1,1)");

	}
	echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
}

// Принятие заявки
elseif ($page=="take_it" && $offer) {
	$shmot=mysql_fetch_array(mysql_query("select * from slots where id=".$stat['id'].""));

	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));

	if ($user_offer)
	$offer_str="Для начала с одной заявкой разберись...";


	else {

		$participants=mysql_query("SELECT * FROM participants WHERE participants.time=".$offer."");
		switch (mysql_num_rows($participants)) {
			case 1:

				if ($stat['hp_now']<($stat['vitality']*5+$stat['hp'])/3)
				$offer_str="Вы слишком ослаблены для поединка, подлечитесь!";
				else {

					$opponent=mysql_fetch_array(mysql_query("SELECT participants.id,players.user, players.room FROM participants, players WHERE participants.time=".$offer." AND participants.side=0 AND participants.id=players.id"));
					$my_ip=mysql_fetch_array(mysql_query("SELECT ip FROM security WHERE user='".$stat['user']."' AND result=1 ORDER BY id DESC"));
					$op_ip=mysql_fetch_array(mysql_query("SELECT ip FROM security WHERE user='".$opponent['user']."' AND result=1 ORDER BY id DESC"));

					// 										if($op_ip==$my_ip)$offer_str="Вы не можете выступать против персонажа с таким же IP как у вас!";



					// 										else {

					$user_offer = 1;

					mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`,`x`,`y`) VALUES (".$offer.",".$stat['id'].",1,".$levels['base'].",".$stat['hp_now'].",4,1)");
					// 					mysql_query("UPDATE `players` SET `bf_x`=1,`bf_y`=1,`bside`=0 WHERE `user`='".$stat['user']."' UNION UPDATE `players` SET `bf_x`=4,`bf_y`=1,`bside`=1 WHERE `user`='".$opponent['user']."'"); // для местностей


					require_once("inc/chat/functions.php");
					insert_msg("<b>".$stat['user']."</b> принял Вашу заявку!","","","1",$opponent['user'],"",$opponent['room']);
					echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
					// 										}
				}
				break;

			case 2:
				$offer_str="Кто-то оказался быстрее и перехватил заявку";
				echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
				break;

			default:
				$offer_str="Боец отозвал заявку";
				echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
		}
	}

}

$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time,offers.type,participants.side FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.time=offers.time AND participants.id=".$stat['id'].""));

// Отказать в поединке
if ($page=="dismiss" && $user_offer['type']==1) {
	if ($user_offer['time']) {
		if (!$user_offer['side']) {

			$opponent=mysql_fetch_array(mysql_query("SELECT participants.id, players.user, players.room FROM participants, players WHERE participants.time=".$user_offer['time']." AND participants.side=1 AND participants.id=players.id"));

			mysql_query("DELETE FROM participants WHERE time=".$user_offer['time']." AND id!=".$stat['id']."");

			require_once("inc/chat/functions.php");
			insert_msg("<b>$stat[user]</b> отказал в поединке!","","","1",$opponent['user'],"",$opponent['room']);
			echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
		}
	}
}

// Отзыв заявки
elseif ($page=="take_back") {
	if ($user_offer['time']) {
		if ($user_offer['type'] == 1) {
			if (!$user_offer['side'])
			mysql_query("DELETE FROM offers WHERE time=".$user_offer['time']."");
			mysql_query("DELETE FROM participants WHERE time=".$user_offer['time']." AND id=".$stat['id']."");
			unset($user_offer);
		} else $offer_str="Что-то тут не так..."; // вот и я говорю - расплодилось уток бля
	}
	echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
}

?>