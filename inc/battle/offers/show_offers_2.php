<?php

include("inc/battle/offers/forms.php");

echo"<div id=battle_forms></div>";
echo"<div id=battle_side style='DISPLAY: None'></div>";

echo"<script language=JavaScript>

function battle_side (battle_id) {

document.all(\"battle_side\").style.display = \"block\"

document.all(\"battle_side\").innerHTML = '<center><br><table width=250 cellspacing=1 cellpadding=3 border=1 bgcolor=e2e0e0 bordercolor=CCCCCC><tr><td align=center style=\'BORDER-RIGHT: 0 px solid\' width=100%><b>����� ������</b></td><td width=20 align=center style=\'BORDER-LEFT: 0 px solid\'><span style=\'CURSOR: Hand\' onclick=\'document.all(\"battle_side\").style.display = \"none\";\'><b>X</b></span></td></tr><tr><td colspan=2><table width=100% cellspacing=0 cellpadding=0 border=0><tr><td width=49% align=center><input class=standbut value=\'������� #1\' type=button onclick=\'window.location=\"battle.php?page=take_it&battle_type=2&offer='+battle_id+'&battle_side=0\"\'></td><td width=2% align=center><a class=ch>|</a></td><td width=49% align=center><input class=standbut value=\'������� #2\' type=button onclick=\'window.location=\"battle.php?page=take_it&battle_type=2&offer='+battle_id+'&battle_side=1\"\'></td></tr></table></td></tr></table></center>';

}

</script>";



if ($offer_str)
echo "<center><font color=red style='FONT-WEIGHT: BOLD'>$offer_str</font></center>";

print"<form action=battle.php?page=take_it&battle_type=2 method=post>";

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
	// ����� ������ ��������� ������
	echo $g_form;
	//
}








echo"<table width=100% cellspacing=0 cellpadding=3 border=1 bgcolor=e2e0e0 bordercolor=CCCCCC><tr>
<td width=20 align=center><b>#</b></td>
<td width=46 align=center><b><img src='i/clock.gif'></b></td>
<td align=center><b>������� #1</b></td>
<td align=center><b>������� #2</b></td>
</tr>";






if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) $type=1;
elseif ($battle_type==2) $type=2;
elseif ($battle_type==3) $type=3;

$offers=mysql_query(
  "select * from offers
     where time>$now
       and type=2
       and done=0 order by time desc");

while($offer=mysql_fetch_array($offers)) {
	$cn+=1;
switch ($offer['zone_type']){
	case 'catacombs': $zone_type='���������';break;
	default: $zone_type='��������';
}
	if ($type==2) {
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
			echo "<td align=center rowspan=3><img src='i/join.gif' onclick='if (confirm(\"�� ������������� ������ ������� ��� ������?\")) battle_side(\"$offer[time]\");' style='CURSOR: Hand' alt='������� �����'></td>"; } else echo"<td rowspan=3>&nbsp;</td>";

			// window.location=\"battle.php?page=take_it&battle_type=$battle_type&offer=$offer[time]\"




			if ($participant=mysql_fetch_array($participants)) {

				echo "<td align=center rowspan=3>
".date("H:i ", $offer[time]-600)."
</td>";


				echo"<td align=left valign=top width=206>
<script language=JavaScript>show_inf('$participant[user]','$participant[id]','$participant[level]','$participant[rank]','$participant[tribe]');</script>";


				while(($participant=mysql_fetch_array($participants)) && !$participant[side]) {
					$player_info=mysql_fetch_array(mysql_query("SELECT user, id, level, rank, tribe FROM players where user='$participant[user]'"));
					echo "<br><script language=JavaScript>show_inf('$player_info[user]','$player_info[id]','$player_info[level]','$player_info[rank]','$player_info[tribe]');</script>";
				}} else
				continue;

				$participants=mysql_query(
      "select participants.*, players.user,players.level,players.rank,players.tribe from participants, players where
                players.id=participants.id
        and participants.`time`=$offer[time]
        and participants.side=1
      order by id");


				echo"</td><td valign=top width=206>";

				if ($participant=mysql_fetch_array($participants)) {
					unset($op_inf);
					unset($player_info);

					echo"<script language=JavaScript>show_inf('$participant[user]','$participant[id]','$participant[level]','$participant[rank]','$participant[tribe]');</script>";

					while($participant=mysql_fetch_array($participants)) {
						$player_info=mysql_fetch_array(mysql_query("SELECT user, id, level, rank, tribe FROM players where user='$participant[user]'"));
						echo "<br><script language=JavaScript>show_inf('$player_info[user]','$player_info[id]','$player_info[level]','$player_info[rank]','$player_info[tribe]');</script>";
					}
				} else echo"<center><i>������ ���� �� �������</i></center>";



				echo "</td></tr><tr>";

				echo"<td align=center>������: <b>".$offer['size_left']."</b> <a class=ch>|</a> �������: [ <b>".$offer['level_l_min']."-".$offer['level_l_max']."</b> ]</td>";

				echo"<td align=center>������: <b>".$offer['size_right']."</b> <a class=ch>|</a> �������: [ <b>".$offer['level_r_min']."-".$offer['level_r_max']."</b> ]</td>";

				echo"
</tr><tr>
<td colspan=2>

<table cellspacing=0 cellpadding=0>
<tr>
<td valign=center><small>�������: [ <b>",$offer[timeout]/60," ���.</b> ]&nbsp;</small></td>
<td valign=center><small><font color=CCCCCC>|</font> ������ ��� �����: [&nbsp;</small></td>

<td valign=center><b>
<div id='battle_start_$offer[time]'></div>
<script>ShowTime('battle_start_$offer[time]',",($offer[start]-$now),",1);</script>
</b></td>

<td valign=center><small>&nbsp;]</small>";

				if (!empty($offer['comment'])) echo"<td align=center><font color=blue> <small>[ <i><b>$offer[comment]</b></i> ]</font></small></td>";
				if (!empty($offer['blood'])) echo" <img title=\"�������� ���\" src='i/ckelet.gif'>";
				echo"

</td>

</tr>
<tr><td colspan=5><small>��� ���������: <b>$zone_type</b></small></td></tr>
</table>

";
				echo"</td></tr>";

	}
}



print"</table></form>";

?>
