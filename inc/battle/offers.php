<?php

if ($page=="start") {
	$user_offer=mysql_fetch_array(
	mysql_query(
      "select offers.time from offers, participants
         where offers.time>$now
           and offers.done=0
           and participants.id=$stat[id]
           and offers.time=participants.time"));
	if ($user_offer) {
		$participants=mysql_fetch_array(
		mysql_query(
        "select count(distinct side) as count from participants
           where participants.time=$user_offer[time]"));
		if ($participants[count]==2) {
			$participants=mysql_query(
        "select participants.id,players.user from participants,players
           where participants.time=$user_offer[time]
             and participants.id=players.id");

			$bdate=date("d.m.y H:i",$now);

			while ($participant=mysql_fetch_array($participants)) {
				mysql_query(
          "update players
             set battle=$user_offer[time]
             where id=$participant[id]");

				$p=mysql_fetch_array(mysql_query("SELECT * FROM players where user='$participant[user]'"));
				$op[]=$p[user];

				require_once("inc/chat/functions.php");
				insert_msg("Часы показывали <U>$bdate</U>, когда Ваш бой начался!","","","1",$participant['user'],"",$p['room']);

			}

			mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($user_offer[time], $now, '0', '', '', '', '', NULL, '', '<i>Часы показывали <u>$bdate</u> когда бой между </i><font color=CFA87A><b>$op[0]</b></font> и <font color=679958><b>$op[1]</b></font> <i>начался!</i>')"); // Первый коммент в бою
			mysql_query(
        "update offers
           set done=1
           where time=$user_offer[time]");
			$stat[battle]=$user_offer[time];

		}
	}
	echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
} else if ($page=="newbattle") {
	$user_offer=mysql_fetch_array(
	mysql_query(
      "select offers.time from offers, participants
         where offers.time>$now
           and offers.done=0
           and participants.time=offers.time
           and participants.id=$stat[id]"));
	if ($user_offer)
	$offer_str="Для начала с одной заявкой разберись...";
	elseif ($stat[hp_now]<($stat[vitality]*5+$stat[hp])/3)
	$offer_str="Вы слишком ослаблены для поединка! Восстановитесь...";
	else {
		///////////
		if ($timeout=="1") $timeo="60"; elseif ($timeout=="2") $timeo="120"; elseif ($timeout=="3") $timeo="180"; elseif ($timeout=="5") $timeo="300"; elseif ($timeout=="10") $timeo="600"; else $timeo="120"; // Время тайм-аута

		$time=$now+600;
		while (mysql_fetch_array(mysql_query("select * from offers where time=$time")))
		$time++;

		$comment=str_replace("<","&lt;",$comment);
		$comment=str_replace(">","&gt;",$comment);
		$comment=str_replace("\"","&quout;",$comment);

		mysql_query("insert into offers (`time`,`type`,`size_left`,`size_right`,`timeout`,`comment`) values ($time,1,1,1,$timeo,'$comment')");
		mysql_query("insert into participants (`time`,`id`,`side`) values ($time,$stat[id],0)");

		//////////
	}
} else if ($page=="take_it" && $offer) {
	$participants=mysql_query(
    "select * from participants
       where participants.time=$offer");

	switch (mysql_num_rows($participants)) {
		case 1:
			mysql_query("insert into participants (`time`,`id`,`side`) values ($offer,$stat[id],1)");
			$opponent=mysql_fetch_array(
			mysql_query(
        "select participants.id,players.user from participants, players
           where participants.time=$offer
             and participants.side=0
             and participants.id=players.id"));

			$o=mysql_fetch_array(mysql_query("SELECT * FROM players where user='$opponent[user]'"));

			require_once("inc/chat/functions.php");
			insert_msg("<b>$stat[user]</b> принял Вашу заявку!","","","1",$opponent['user'],"",$o['room']);

			break;
		case 2:
			$offer_str="Кто-то оказался быстрее и перехватил заявку";
			break;
		default:
			$offer_str="Боец отозвал заявку";
	}
}

$user_offer=mysql_fetch_array(
mysql_query(
    "select offers.time,participants.side from offers, participants
       where offers.time>$now
         and offers.done=0
         and participants.time=offers.time
         and participants.id=$stat[id]"));

if ($page=="dismiss") {
	if ($user_offer[time]) {
		if (!$user_offer[side]) {
			$opponent=mysql_fetch_array(
			mysql_query(
          "select participants.id,players.user from participants, players
             where participants.time=$user_offer[time]
               and participants.side=1
               and participants.id=players.id"));
			mysql_query(
        "delete from participants
           where time=$user_offer[time]
             and id!=$stat[id]");

			$o=mysql_fetch_array(mysql_query("SELECT * FROM players where user='$opponent[user]'"));

			require_once("inc/chat/functions.php");
			insert_msg("<b>$stat[user]</b> отказал в поединке!","","","1",$opponent['user'],"",$o['room']);

		}
	}
} else if ($page=="take_back") {
	if ($user_offer[time]) {
		if (!$user_offer[side])
		mysql_query(
        "delete from offers
           where time=$user_offer[time]");
		mysql_query(
      "delete from participants
         where time=$user_offer[time]
           and id=$stat[id]");
		unset($user_offer);
	}
}

?>