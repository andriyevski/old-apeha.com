<?php

$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'"));

if ($page=="start") {
	mysql_query("LOCK TABLES battles WRITE, offers WRITE, participants WRITE, players WRITE");

	$user_offer=mysql_fetch_array(mysql_query("SELECT offers.time FROM offers, participants WHERE offers.time>".$now." AND offers.done=0 AND participants.id=".$stat['id']." AND offers.time=participants.time"));

	if ($user_offer) {
		$participants=mysql_fetch_array(mysql_query("SELECT count(distinct side) AS count FROM participants WHERE participants.time=".$user_offer['time'].""));

		if ($participants['count'] == 2) {

			$stat['battle'] = $user_offer['time'];

			mysql_query("UPDATE offers SET done=1 WHERE time=".$user_offer['time']."");

			$bdate=date("d.m.y H:i",$now);

			mysql_query("INSERT INTO battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) VALUES (".$user_offer['time'].", ".$now.", '0', '', '', '', '', NULL, '', '<i>Часы показывали <u>".$bdate."</u> когда бой начался!')");

			$participants=mysql_query("SELECT participants.id,players.user, players.room from participants,players WHERE participants.time=".$user_offer['time']." AND participants.id=players.id");

			require_once("inc/chat/functions.php");

			while ($participant=mysql_fetch_array($participants)) {
				mysql_query("UPDATE players SET battle=".$user_offer['time']." WHERE id=".$participant['id']."");

				insert_msg("Часы показывали <U>$bdate</U>, когда Ваш бой начался!","","","1",$participant['user'],"",$participant['room']);

			}
		}
	}
	mysql_query("UNLOCK TABLES");
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

		mysql_query("INSERT INTO offers (`time`,`type`,`size_left`,`size_right`,`timeout`,`comment`) VALUES (".$time.",4,1,1,".$timeo.",'".$comment."')");

		mysql_query("UNLOCK TABLES");

		mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`,`x`,`y`) VALUES (".$time.",".$stat['id'].",0,".$levels['base'].",".$stat['hp_now'].",1,1)");

	}
}

// Принятие заявки
elseif ($page=="take_it" && $offer) {

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

					$user_offer = 1;

					mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`) VALUES (".$offer.",".$stat['id'].",1,".$levels['base'].",".$stat['hp_now'].")");

					$opponent=mysql_fetch_array(mysql_query("SELECT participants.id,players.user, players.room FROM participants, players WHERE participants.time=".$offer." AND participants.side=0 AND participants.id=players.id"));

					require_once("inc/chat/functions.php");
					insert_msg("<b>".$stat['user']."</b> принял Вашу заявку!","","","1",$opponent['user'],"",$opponent['room']);
				}
				break;

			case 2:
				$offer_str="Кто-то оказался быстрее и перехватил заявку";
				break;

			default:
				$offer_str="Боец отозвал заявку";
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
		} else $offer_str="Что-то тут не так...";
	}
}

?>