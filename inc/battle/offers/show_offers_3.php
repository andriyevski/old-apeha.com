<?php

include("inc/battle/offers/forms.php");

echo"<div id=battle_forms></div>";
echo"<div id=battle_side style='DISPLAY: None'></div>";

echo"<script language=JavaScript>

</script>";



if ($offer_str)
echo "<center><font color=red style='FONT-WEIGHT: BOLD'>$offer_str</font></center>";

print"<form action=battle.php?page=take_it&battle_type=3 method=post>";

if ($user_offer[time]) {

	if (!$user_offer[side]) {
		$opponent=mysql_fetch_array(
		mysql_query(
        "select participants.id,players.user from participants, players
           where participants.time=$user_offer[time]
             and participants.side=1
             and participants.id=players.id"));


		$op_inf=mysql_fetch_array(mysql_query("SELECT user, id, level, rank, tribe FROM players where user='$opponent[user]'"));

	}
} else {
	// Форма подачи хаот заявки
	echo $h_form;
	//
}








echo"<table width=100% cellspacing=0 cellpadding=3 border=1 bgcolor=e2e0e0 bordercolor=CCCCCC><tr>
<td width=20 align=center><b>#</b></td>
<td width=46 align=center><b><img src='i/clock.gif'></b></td>
<td align=left><b>Участники :</b></td>

</tr>";





if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) $type=1;
elseif ($battle_type==2) $type=2;
elseif ($battle_type==3) $type=3;

$offers=mysql_query(
  "select * from offers
     where time>$now
       and type=3
       and done=0 order by time desc");

while($offer=mysql_fetch_array($offers)) {
	$cn+=1;
switch ($offer['zone_type']){
	case 'catacombs': $zone_type='катакомбы';break;
	default: $zone_type='стандарт';
}
	if ($type==2 || $type==3) {
		$participants=mysql_query(
      "select players.user,players.id,players.level,players.rank,players.tribe,participants.side from participants, players
         where players.id=participants.id
           and participants.time=$offer[time]
         order by participants.side,participants.`order`");

		if ($offer['start']<$now) break;

		//   if (mysql_num_rows($participants)>1 && $user_offer[time]!=$offer[time])
		//   continue;

		if ($cn>1) echo"<tr><td bgcolor=white colspan=4>&nbsp;</td></tr>";

		echo "<tr>";

		if (!$user_offer[time] && $user_offer[time]!=$offer[time]) {
			echo "<td align=center rowspan=3><img src='i/join.gif' onclick='if (confirm(\"Вы действительно хотите принять эту заявку?\")) window.location=\"battle.php?page=take_it&battle_type=3&offer=".$offer['time']."\";' style='CURSOR: Hand' alt='Принять вызов'></td>"; } else echo"<td rowspan=3>&nbsp;</td>";

			// window.location=\"battle.php?page=take_it&battle_type=$battle_type&offer=$offer[time]\"




			if ($participant=mysql_fetch_array($participants)) {

				echo "<td align=center rowspan=3>
".date("H:i ", $offer[time]-600)."
</td>";


				echo"<td align=left valign=top>
<script language=JavaScript>show_inf('$participant[user]','$participant[id]','$participant[level]','$participant[rank]','$participant[tribe]');</script>";


				while(($participant=mysql_fetch_array($participants))) {
					$player_info=mysql_fetch_array(mysql_query("SELECT user, id, level, rank, tribe FROM players where user='$participant[user]'"));
					echo ", <script language=JavaScript>show_inf('$player_info[user]','$player_info[id]','$player_info[level]','$player_info[rank]','$player_info[tribe]');</script>";
				}} else
				continue;




				echo "</td></tr><tr>";

				echo"<td align=left>Уровень: [ <b>".$offer['level_l_min']."-".$offer['level_l_max']."</b> ]</td>";



				echo"
</tr><tr>
<td colspan=2>

<table cellspacing=0 cellpadding=0>
<tr>
<td valign=center><small>Таймаут: [ <b>",$offer[timeout]/60," мин.</b> ]&nbsp;</small></td>
<td valign=center><small><font color=CCCCCC>|</font> Начало боя через: [&nbsp;</small></td>

<td valign=center><b>
<div id='battle_start_$offer[time]'></div>
<script>ShowTime('battle_start_$offer[time]',",($offer[start]-$now),",1);</script>
</b></td>

<td valign=center><small>&nbsp;]</small>";

				if (!empty($offer['comment'])) echo"<td align=center><font color=blue> <small>[ <i><b>$offer[comment]</b></i> ]</font></small>";
				if (!empty($offer['blood'])) echo" <img title=\"Кровавый бой\" src='i/ckelet.gif'>";
				echo"

</td>

</tr>
<tr><td colspan=5><small>Тип местности: <b>$zone_type</b> <font color=CCCCCC>|</font> Количество игроков: <b>".$offer['size_left']."</b></small></td></tr>
</table>

";
				echo"</td></tr>";

	}
}



print"</table></form>";

?>
