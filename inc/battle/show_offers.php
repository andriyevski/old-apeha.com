<script language=JavaScript>
function closebattle () { document.all("newbattle").style.display = 'none'; document.all("newbattle").innerHTML=''; }
function newbattle () {
document.all("newbattle").style.display = 'inline';
document.all("newbattle").innerHTML='<table width=200 cellspcaing=0 cellpadding=3 bordercolor=CCCCCC border=1 bgcolor=e2e0e0><form action="?page=newbattle" method=post><tr><td valign=top align=center><table width=100% cellspacing=0 cellpadding=0 border=0><tr><td align=center><a class=ch>Подать заявку</a></td><td width=22 align=center><B style="CURSOR: Hand" onclick="closebattle();" title="Закрыть">[X]</B></td></tr></table><hr color=CCCCCC><select style="WIDTH: 187px" name=timeout><option value=1>Таймаут: 1 мин.<option value=2>Таймаут: 2 мин.<option value=3>Таймаут: 3 мин.<option value=5>Таймаут: 5 мин.<option value=10>Таймаут: 10 мин.</select><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=100>Комментарий:</td><td width=120 align=center><input class=input name=comment size=19 value="" maxlength=15></td></tr></table><hr color=CCCCCC><table border=0 width=100% cellpadding=0 cellspacing=0><tr><td width=100>Мин. уровень:</td><td align=center><input type=text class=input size=7 name=min_level value="<? echo"$stat[level]"; ?>"></td></tr><tr><td>Maкс. уровень:</td><td align=center><input type=text class=input size=7 name=max_level value="<? echo"$stat[level]"; ?>"></td></tr></table><hr color=CCCCCC><input type=submit class=standbut value="Подать заявку" style="WIDTH: 187px"></td></tr></form></table>';
}
</script>

<div
	id=newbattle style='position: absolute; left: 430px; top: 50px'></div>



<?php

if ($offer_str)
echo "<center><font color=red style='FONT-WEIGHT: BOLD'>$offer_str</font></center>";

print"<form action=battle.php?page=take_it method=post>";

if ($user_offer[time]) {
	if ($user_offer[side])
	print"Ожидаем подтверждения<br><input type=button value='Отозвать вызов' onClick='location=\"battle.php?page=take_back&tmp=\"+Math.random();\"\"' class=standbut><br>";
	else {
		$opponent=mysql_fetch_array(
		mysql_query(
        "select participants.id,players.user from participants, players
           where participants.time=$user_offer[time]
             and participants.side=1
             and participants.id=players.id"));


		$op_inf=mysql_fetch_array(mysql_query("SELECT * FROM players where user='$opponent[user]'"));

		if ($opponent) {

			print "Заявку принял <script language=JavaScript>show_inf('$op_inf[user]','$op_inf[id]','$op_inf[level]','$op_inf[rank]','$op_inf[tribe]');</script> ";


			print "<input type=button value='Отказать' onClick='location=\"battle.php?page=dismiss&tmp=\"+Math.random();\"\"' class=standbut>&nbsp;";
			print "<input type=button value='Битва!' onClick='location=\"battle.php?page=start&tmp=\"+Math.random();\"\"' class=standbut><br>";
		} else
		print"Заявка подана<br><input type=button value='Отозвать заявку' onClick='location=\"battle.php?page=take_back&tmp=\"+Math.random();\"\"' class=standbut><br>";
	}
} else {

	/////
	print"<input type=button value='Подать заявку' onClick='newbattle();' class=standbut><br>";

	print"<input type=submit value='Принять вызов' class=standbut><br>";
	//////

}







if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) $type=3;
elseif ($battle_type==2) $type=2;
elseif ($battle_type==3) $type=3;

$offers=mysql_query(
  "select * from offers
     where time>$now
       and type=$type
       and done=0");

while($offer=mysql_fetch_array($offers)) {
	if ($type==1) {
		$participants=mysql_query(
      "select players.user,players.id,players.level,players.rank,players.tribe,participants.side,participants.timeout,participants.comment from participants, players
         where players.id=participants.id
           and participants.time=$offer[time]
         order by participants.side,participants.`order`");
		if (mysql_num_rows($participants)>1 && $user_offer[time]!=$offer[time])
		continue;
		if (!$user_offer[time]) {
			echo "<input type=\"radio\" name=\"offer\" value=\"$offer[time]\"";
			if ($user_offer[time]==$offer[time])
			echo " disabled";
			echo "> ";
		}
		if ($participant=mysql_fetch_array($participants)) {
			echo date("H:i ", $offer[time]-600);

			echo"<script language=JavaScript>show_inf('$participant[user]','$participant[id]','$participant[level]','$participant[rank]','$participant[tribe]');</script>";

			###
			//if ($participant[user]!="$stat[user]" and $user_offer[side]==0 and !$user_offer[time]) echo" <img //src='i/battle/take_it.gif' onclick='window.location=\"battle.php?page=take_it&offer=$offer[time]\"' alt='Принять вызов' //style='CURSOR: Hand'>";
			###




			// echo" <small>(Тайм-аут: ".$participant[timeout]/60;
			// echo" мин.";

			// if (!empty($participant['comment'])) echo" Комментарий: $participant[comment]";
			// echo")</small>";



			while(($participant=mysql_fetch_array($participants)) && !$participant[side])
			echo ", <b>$participant[user]</b>";
		} else
		continue;

		$participants=mysql_query(
      "select participants.*, players.user,players.level,players.rank,players.tribe from participants, players
	 where players.id=participants.id
           and participants.`time`=$offer[time]
           and participants.side=1
         order by id");
		if ($participant=mysql_fetch_array($participants)) {
			unset($op_inf);

			echo " <i>против</i> ";
			echo"<script language=JavaScript>show_inf('$participant[user]','$participant[id]','$participant[level]','$participant[rank]','$participant[tribe]');</script>";
			while($participant=mysql_fetch_array($participants))
			echo ", <b>$participant[user]</b>";
		}
		echo "<br>";

	}
}

print"</form>";

?>