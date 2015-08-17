<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select user, reason, t_time, room, bloked from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['room'] != 666) { header("Location: main.php"); exit; }

include("inc/html_header.php");

$now=time();
$srok=$stat['t_time']-$now;
$reason="<font color=red><b>$stat[reason]</b></font>";

if ($stat['t_time']<$now) {

	$back="<input type=button value=Вернуться onclick='window.location.href=\"world.php?tmp=\"+Math.random();\"\"' class=input>";

	mysql_query("update players set t_time=NULL where user='".$stat['user']."' LIMIT 1");
	$stat['t_time'] = NULL;
}



echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>";

print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
<input type=button value=Обновить onclick='window.location.href=\"prison.php?tmp=\"+Math.random();\"\"' class=input>
$back
</td>
</tr>
</table>";

if ($stat[t_time]<$now) { echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=center>
<img src='i/prison.jpg'>
</td>
<td align=center valign=top>
<font style='FONT-FAMILY: Arial; FONT-SIZE: 12pt;'><b>Тюрьма</b></font><br>
<br>
<table border=0 cellspacing=0 cellpadding=5 width=450 bordercolor=silver>
<tr>
<td align=center>
<b><i>Ваш срок наказания истёк!<br>Надеемся, Вы покидаете наше заведение навсегда :)</i></b>
</td>
</tr>
</table>
</td>
</tr>
</table>";

} else {

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=left>
<img src='i/prison.jpg'>
</td>
<td align=center valign=top>
<font style='FONT-FAMILY: Arial; FONT-SIZE: 12pt;'><b>Тюрьма</b></font><br>
<br>
<table border=0 cellspacing=0 cellpadding=5 width=450 bordercolor=silver>
<tr>
<td>
<table border=0 cellpadding=0 cellspacing=0>
<tr><td width=180>Оставшийся срок наказания:</td><td id=dt style='FONT-WEIGHT: Bold;'></td></tr></table></td>";


	echo"<script src='i/time.js'></script>";





	echo"<script>
ShowTime('dt',$srok);
</script>";

	echo"
</tr>
<tr>
<td style='BORDER-TOP: 1px solid'>
Причина отправку в тюрьму: <u>$reason</u>
</td>
</tr>
</table>
</td>
</tr>
</table>"; }
	?>