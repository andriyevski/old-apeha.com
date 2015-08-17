<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']) { header("Location: academy.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 43) { header("Location: main.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
else {

	if (isset($take1)) {
		if ($stat['kwest0'] != 21) $msg="Ошибка, не пытайтесь взломать игру :)!";
		else {
			mysql_query("UPDATE players SET kwest0=22 WHERE user='".$stat['user']."'");
			$msg="Вы попытались взять котёнка в руки, но он убежал от вас...";
		}
	}

	print"<body background='/i/bg.gif'>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['credits']."</u> <b>зм.</b>
</td>
<td align=right valign=top>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"admin_dom.php\"'>
<input class=lbut type=button value='Вернуться' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	if ($stat['kwest0'] == 21)
	echo"<center><fieldset style='WIDTH: 40%'><font face=Verdana size=2><legend>Сообщение о Квесте</legend></font>
<div align=center><font face=Verdana size=2>
Вы случайно здесь увидели играющего <b>\"Котёнка\"</b>!<br>
<input class=lbut type=button value='Взять котёнка' onclick='window.location.href=\"admin_dom.php?take1\"'>
</font></div></fieldset></center><br>";

	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";

	echo"
<table align=center width=90% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=center>
<font class=title>Администрация</font><br><br>";
	echo"
<FIELDSET style='WIDTH: 98%'><legend>Отделы</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center width=32%><A HREF='world3.php?room=19&tmp=\"+Math.random();\"'><b>Телеграф</b></A></td><td width=1% align=center><b>|</b></td>
<td align=center width=32%><A HREF='world3.php?room=18&tmp=\"+Math.random();\"'><b>Регистратура</b></A></td>
</tr>";
	if (!empty($_GET['otdel'])) {
		echo"<TR><TD COLSPAN=5 ALIGN=CENTER><HR COLOR='#CCCCCC'>";

		switch ($_GET['otdel']) {
			case 1: show(1); break;
			case 2: show(2); break;
			default: echo"<B STYLE='COLOR: Red'>Что-то тут не так...</B>"; break;
		}

		echo"</TD></TR>";
	}
	echo"</table></FIELDSET></td></tr></table>";
}
?>