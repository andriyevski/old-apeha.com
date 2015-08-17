<?php

include("inc/battle/offers/forms.php");

echo"<div id=battle_forms></div>";
if ($offer_str)
echo "<br><center><font color=red style='FONT-WEIGHT: BOLD'>$offer_str</font></center>";

print"<form action='battle.php?page=take_it' method=post>";

if ($user_offer[time]) {

	if ($user_offer[side] && $user_offer[type]==1)  echo"$s_b_form";

	else {
		$opponent=mysql_fetch_array(
		mysql_query(
        "select participants.id,players.user from participants, players
           where participants.time=$user_offer[time]
             and participants.side=1
             and participants.id=players.id"));


		$op_inf=mysql_fetch_array(mysql_query("SELECT * FROM players where user='$opponent[user]'"));

		if ($opponent && $user_offer[type]==1) {

			// Кто то принял заявку

			include("inc/battle/offers/forms_1.php");
			echo $s_t_form;

			//

		} else

		if ($user_offer[type]==1) { echo $s_c_form; }

	}
} else {


	// Форма подачи одиночной заявки
	echo $s_form;
	//

}








echo"<table width=100% cellspacing=0 cellpadding=3 border=1 bgcolor=e2e0e0 bordercolor=CCCCCC><tr>
<td width=20 align=center><b>#</b></td>
<td width=46 align=center><b><img src='i/clock.gif'></b></td>
<td>&nbsp;</td>
</tr>";





if ($battle_type==1 || !isset($battle_type) || empty($battle_type)) $type=1;
elseif ($battle_type==2) $type=2;
elseif ($battle_type==3) $type=3;

$offers=mysql_query(
  "select * from offers
     where time>$now
       and type=$type
       and city=$stat[city]
       and done=0 order by time desc");

while($offer=mysql_fetch_array($offers)) {
	if ($type==1) {
		$participants=mysql_query(
      "select players.user,players.id,players.level,players.rank,players.tribe,participants.side from participants, players
         where players.id=participants.id
           and participants.time=$offer[time]
         order by participants.side,participants.`order`");
		if (mysql_num_rows($participants)>1 && $user_offer[time]!=$offer[time])
		continue;

		echo "<tr>";

		if (!$user_offer[time] && $user_offer[time]!=$offer[time]) {
			echo "<td align=center><img src='i/join.gif' onclick='if (confirm(\"Вы действительно хотите принять эту заявку?\")) window.location=\"battle.php?page=take_it&battle_type=$battle_type&offer=$offer[time]\"' style='CURSOR: Hand' alt='Принять вызов'></td>"; } else echo"<td>&nbsp;</td>";



			if ($participant=mysql_fetch_array($participants)) {

				echo "<td align=center>
".date("H:i:s ", $offer[time]-600)."
</td>";

				echo"<td align=left>
<script language=JavaScript>show_inf('$participant[user]','$participant[id]','$participant[level]','$participant[rank]','$participant[tribe]');</script>";


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

			if (!empty($offer['timeout'])) echo" <small>[ <b>",$offer[timeout]/60," мин.</b> ]</small>";
			if (!empty($offer['comment'])) echo" <small>[ <i><b>$offer[comment]</b></i> ]</small>";

			echo "</td></tr>";

	}
}



print"</table></form>";

?>
