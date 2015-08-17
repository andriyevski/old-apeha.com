<?
$now=time();
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";
if ($stat['t_time']) { header("Location: prison.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 12) { header("Location: main.php"); exit; }
else {
	include("inc/html_header.php");
	echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>";
	echo"<DIV id=hint1></DIV>";
	echo"
<script language=JavaScript src='i/show_inf.js'></script>
<script language=JavaScript src='i/time.js'></script>
";
	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr><td align=right valign=top>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"gamblinghouse.php?gameroom=$gameroom&tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"world5.php?room=0&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";
	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>Игорный дом</font></center><br>";
	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";
	echo"
<FIELDSET style='WIDTH: 98.6%'><legend>Выберите игровую комнату</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center width=32%><A"; if ($gameroom == 1) echo" disabled><b>"; else echo" HREF='gamblinghouse.php?gameroom=1'>"; echo"Кости</b></A></td><td width=1% align=center><b></b></td>
</tr>";
	if (!empty($_GET['gameroom'])) {
		echo"<TR><TD COLSPAN=5 ALIGN=CENTER><HR COLOR='#CCCCCC'>";
		switch ($_GET['gameroom']) {
			case 1: include('inc/games/1.php'); break;
			default: echo"<B STYLE='COLOR: Red'>Что-то тут не так...</B>"; break;
		}
		echo"</TD></TR>";
	}
	echo"
</table>
";
	echo"</td>
</tr>
</table>
<BR><BR>
";
}
?>