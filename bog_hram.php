<?
require_once("inc/module.php");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 28) { header("Location: main.php"); exit; }
elseif ($stat['o_time']) { header("Location: juvelir.php"); exit; }
elseif ($stat['r_time']) { header("Location: podzem.php"); exit; }

else {

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0 >
<tr><td align=right valign=top>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"bog_hram.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='Назад' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";

	if (isset($take1)) {
		if ($stat['mol_bog_tima'] > $now) $msg="Вы еще молитесь богу Тьмы, дождитесь окончания молитвы!";
		elseif ($stat['mol_bog_swet'] > $now) $msg="Вы еще молитесь богу Света, дождитесь окончания молитвы!";
		elseif ($stat['ustal_now'] < 10) $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
		else {
			mysql_query("UPDATE players set mol_bog_swet=$now+600, ed_bog_swet=ed_bog_swet+1, ustal_now=ustal_now-10 WHERE id=$stat[id]");
			$msg="Молитва началась, дождитесь окончания 10 мин., и вы получите 1 ед. к очкам бога Света!";
		}
	}

	if (isset($take2)) {
		if ($stat['mol_bog_tima'] > $now) $msg="Вы еще молитесь богу Тьмы, дождитесь окончания молитвы!";
		elseif ($stat['mol_bog_swet'] > $now) $msg="Вы еще молитесь богу Света, дождитесь окончания молитвы!";
		elseif ($stat['ustal_now'] < 10) $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
		else {
			mysql_query("UPDATE players set mol_bog_tima=$now+600, ed_bog_time=ed_bog_time+1, ustal_now=ustal_now-10 WHERE id=$stat[id]");
			$msg="Молитва началась, дождитесь окончания 10 мин., и вы получите 1 ед. к очкам бога Тьмы!";
		}
	}

	if (isset($take3)) {
		if ($stat['kwest0'] != 22) $msg="Ошибка, не пытайтесь взломать игру :)!";
		else {
			mysql_query("UPDATE players SET kwest0=23 WHERE user='".$stat['user']."'");
			$msg="Вы попытались взять котёнка в руки, но он убежал от вас...";
		}
	}

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>Божественный Храм</font></center><br>";

	if ($stat['kwest0'] == 22)
	echo"<center><fieldset style='WIDTH: 40%'><font face=Verdana size=2><legend>Сообщение о Квесте</legend></font>
<div align=center><font face=Verdana size=2>
Вы случайно здесь увидели <b>\"Котёнка\"</b>!<br>
<input class=lbut type=button value='Взять котёнка' onclick='window.location.href=\"bog_hram.php?take3\"'>
</font></div></fieldset></center><br>";

	if ($stat['mol_bog_swet']>$now) {
		echo"<script src='i/time.js'></script>";
		echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>Осталось молится богу Света:</b></font></td>
<td id=know style='COLOR: red; FONT-WEIGHT: Bold; TEXT-DECORATION: Underline'></td>
</tr>
</table>
<script>ShowTime('know',",$stat['mol_bog_swet']-$now,");</script>";
	}



	if ($stat['mol_bog_tima']>$now) {
		echo"<script src='i/time.js'></script>";
		echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>Осталось молится богу Тьмы:</b></font></td>
<td id=know style='COLOR: red; FONT-WEIGHT: Bold; TEXT-DECORATION: Underline'></td>
</tr>
</table>
<script>ShowTime('know',",$stat['mol_bog_tima']-$now,");</script>";
	}

	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


	echo"<tr>
<td width=60% align=center>
<fieldset style='WIDTH: 60%'><legend>Молитвы</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>
В этом <b>Божественном Храме</b> вы сможете помолится своему богу...<br>Удачной молитвы, да прибудет с вами сила...<br><br>

<table width=90% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>
<td align=center colspan=2>
Выберите бога которому вы собираетесь молится:<br></td>
</tr>
<tr>
<td align=left>
<input class=lbut type=button value='Молится Богу Света' onclick='window.location.href=\"bog_hram.php?take1=\"+Math.random();\"\"'><br>
За очки полученные от молитвы этому богу, вы сможете:<br>
 - Пополнить XP<br>
 - Излечение от травм<br>
</td><td align=left>
 <input class=lbut type=button value='Молится Богу Тьмы' onclick='window.location.href=\"bog_hram.php?take2=\"+Math.random();\"\"'><br>
За очки полученные от молитвы этому богу, вы сможете:<br>
 - Пополнить игровой счет ЗМ.<br>
 - Снять запрет на общение<br>
</td>
<tr><td>Очки от молитвы богу Света: <b>".$stat['ed_bog_swet']."</b> ед.</td>
<td>Очки от молитвы богу Тьмы: <b>".$stat['ed_bog_time']."</b> ед.</td></tr>

";
	echo"</td>
</tr>
</table>
</td>
</tr>
</table>
</fieldset></td></tr>
<BR><BR>
</td>
</tr>
</table>
";

}
?>
