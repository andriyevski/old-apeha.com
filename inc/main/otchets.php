<?
include('inc/header.php');



print "<table cellpadding=3 width=100% cellspacing=1 border=0>
<td align=right><input class=lbut type=button value='Назад' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";



echo"<table cellpadding=3 width=100% cellspacing=1 border=0>
<tr>
<td bgcolor=#eaeaea align=center colspan=2><b>Виды отчетов</b></td>
</tr>";
echo"<tr>
<td bgcolor=#FCFAF3 align=center><b><a "; if ($mode=="security") echo"disabled"; else echo"href='main.php?set=otchets&mode=security'"; echo">Отчёт безопасности</a></b></td>
<td bgcolor=#FCFAF3 align=center><b><a "; if ($mode=="transfers") echo"disabled"; else echo"href='main.php?set=otchets&mode=transfers'"; echo">Отчёт о переводах</a></b></td></tr>";


if ($mode=="security") {

	$otchet=mysql_query("SELECT * FROM security WHERE user='$stat[user]' order by id desc");

	for ($i=0; $i<mysql_num_rows($otchet); $i++) {
		$otchets=mysql_fetch_array($otchet);

		if ($otchets['result']==0) $result="";
		elseif ($otchets['result']==1) $result="Вход в систему успешный";
		elseif ($otchets['result']==2) $result="<b><font color=red>Неверный пароль!</font></b>";

		echo"<tr><td bgcolor=#FCFAF3 colspan=2><u>".date("d.m.y H:i",$otchets[id])."</u> | IP: <b>$otchets[ip]</b> | $result</td></tr>";
	}}



	if ($mode=="transfers") {
		if ($transf==1) {
			echo"<tr><td bgcolor=#FCFAF3 colspan=2 align=center><b>Отчёт о переводах успешно создан и находится у Вас в инвентаре!</b></b></td></tr>"; }

			echo"<tr><td bgcolor=#FCFAF3 colspan=2 align=center><b><font color=red>Внимание!</font></b> Вы можете заказать отчёт о переводах!<br><b>Услуга платная: <u>5 зм.</u></b></td></tr>
<tr><td bgcolor=#FCFAF3 colspan=2 align=center>
<input type=button value='Заказать отчёт о переводах' class=lbut onclick=\"if(confirm('Вы действительно хотите заказать отчёт о переводах?')) window.location.href='main.php?set=otchets&mode=transfers&transf=1&tmp=$ctime';\">
</td></tr>";
	}


	echo"</table>
</table>";

	?>