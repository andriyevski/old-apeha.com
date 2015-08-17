<?
if ($mode=="security") {

	$otchet=mysql_query("SELECT * FROM security WHERE user='$stat[user]' order by id desc");

	for ($i=0; $i<mysql_num_rows($otchet); $i++) {
		$otchets=mysql_fetch_array($otchet);

		if ($otchets['result']==0) $result="";
		elseif ($otchets['result']==1) $result="Вход в систему успешный";
		elseif ($otchets['result']==2) $result="<b><font color=red>Неверный пароль!</font></b>";

		echo"<tr><u>".date("d.m.y H:i",$otchets[id])."</u> | IP: <b>$otchets[ip]</b> | $result</td></tr>";
	}}



	echo"</table>";

	?>