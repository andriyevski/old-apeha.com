<?
$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat[bloked]=="1") echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
//elseif ($stat['v_time']) { header("Location: ambulance.php"); exit; } // Редиректим в больницу
elseif ($stat['k_time']>time()) { header("Location: academy.php"); exit; } // Редиректим в академию
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat[room]!= 16)
{
	if ($stat[w_time]>=$now)
	{
		mysql_query("UPDATE players SET room=16, lpv=".$now." WHERE user='".$stat['user']."'");
		$stat[room]=16;
	}
	else
	{
		header("Location: main.php");
		exit;
	}
}
else {


	//Легкая работа

	if ($getproff!="" && $getm=="") {
		$ch=mysql_fetch_array(mysql_query("SELECT * FROM works where id=".intval($getproff)." and type=0"));


		if ($stat[w_time]<$now) { // Свободен
			if ($stat[level]>=$ch[level]) { // Хватает левела

				if ($stat[ustal_now]>=$ch[srok]/3600*25) { // не устал

					mysql_query("UPDATE players set w_time=$now+$ch[srok] where id=$stat[id]");
					mysql_query("UPDATE players set credits=credits+$ch[price] where id=$stat[id]");
					mysql_query("UPDATE players set ustal_now=ustal_now-$ch[srok]/3600*25 where id=$stat[id]");
					$msg="Процесс работы начат! По окончанию работы Вам выплятят зарплату!";

				} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";

			} else $msg="Вы не можете получить эту работу, уровень маловат!";
		} else $msg="Центр занятости не предоставляет таких услуг!";

	}



	// Тяжелая работа
	if ($getm!="" && $getproff=="") {
		$ch=mysql_fetch_array(mysql_query("SELECT * FROM works where id=".intval($getm)." AND type=1"));

		if ($stat[w_time]<$now) { // Свободен
			if ($stat[level]>=$ch[level]) { // Хватает левела

				if ($stat[ustal_now]>="35") { // не устал
					mysql_query("UPDATE players set w_time=$now+".(floor($stat[ustal_now]/35)*3600)." where id=$stat[id]");
					mysql_query("UPDATE players set credits=credits+$ch[price]*".(floor($stat[ustal_now]/35))." where id=$stat[id]");
					mysql_query("UPDATE players set ustal_now=ustal_now-".(floor($stat[ustal_now]/35)*3600)." /3600*35 where id=$stat[id]");
					$msg="Процесс работы начат! По окончанию работы Вам выплятят зарплату!";
				} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
			} else $msg="Вы не можете получить эту работу, уровень маловат!";
		} else $msg="Центр занятости не предоставляет таких услуг!";
	}
	////////


	unset($stat);
	$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));




	include("inc/html_header.php");

	echo"
<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td align=right valign=top>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"works.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"street1.php?room=101&tmp=\"+Math.random();\"\"'>
</td>
</tr>
<tr>
<td>&nbsp;&nbsp;<b>Активность:</b> <u>".$stat['ustal_now']."</u>
</td>
</table>";


	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>Центр занятости</font></center><br>";






	if ($stat['w_time']>$now) {
		echo"<script src='i/time.js'></script>";
		echo"<center><table cellspacing=0 cellpadding=3>
<tr>
<td><font color=red><b>Оставшееся время работы:</b></font></td>
<td id=know style='COLOR: red; FONT-WEIGHT: Bold; TEXT-DECORATION: Underline'></td>
</tr>
</table>
<script>ShowTime('know',",$stat['w_time']-$now,");</script>";
	}
	else { mysql_query("UPDATE players set w_time=0 where id=$stat[id]"); }


	if ($msg!="") echo"<center><font color=red><b>$msg</b></font></center><br>";






	// Специальность

	echo"
<fieldset style='WIDTH: 98.6%'><legend>Легкая работа (требует 1 уровень и 25 активности за час)</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>


<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>

<td width=18 align=center><b>№</b></td>
<td><b>Наименование</b></td>
<td width=150 align=center><b>Срок работы</b></td>
<td width=160 align=center><b>Зарплата</b></td>
<td align=center width=120><b>Роспись</b></td>

</tr>";


	$ac=mysql_query("SELECT * FROM works where type=0 order by srok");


	for ($i=0; $i<mysql_numrows($ac); $i++) {
		$acs=mysql_fetch_array($ac);

		echo"
<tr>
<td align=center><b>".($i+1)."</b></td>
<td><b>$acs[title]</b></td>
<td align=center><b>".(round($acs[srok]/60,1))." мин.</b></td>
<td align=center><b>$acs[price] зм</b></td>
<td align=center><input type=button class=input value='Работать'";

		if ($stat[w_time]<$now) echo" onclick=\"if (confirm('Вы действительно хотите получить данную работу?')) window.location='works.php?getproff=$acs[id]&'+Math.random();''\""; else echo" disabled";

		echo"></td></tr>";

	}


	echo"
</table>


</td>
</tr>
</table>

</fieldset><br><br><br>";

	// Конец получения спец.


	unset($ac, $acs);












	// Тяжелая работа

	echo"
<fieldset style='WIDTH: 98.6%'><legend>Тяжелая работа (требует 2 уровень и 35 активности за час)</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>


<table width=100% cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1>
<tr>

<td width=18 align=center><b>№</b></td>
<td><b>Наименование</b></td>
<td width=150 align=center><b>Срок работы</b></td>
<td width=160 align=center><b>Зарплата за час работы</b></td>
<td align=center width=120><b>Роспись</b></td>

</tr>";


	$ac=mysql_query("SELECT * FROM works where type=1 order by srok");


	for ($i=0; $i<mysql_numrows($ac); $i++) {
		$acs=mysql_fetch_array($ac);

		echo"
<tr>
<td align=center><b>".($i+1)."</b></td>
<td><b>$acs[title]</b></td>
<td align=center><b>".(floor($stat[ustal_now]/35)*60)." мин.</b></td>
<td align=center><b>$acs[price] зм</b></td>
<td align=center><input type=button class=input value='Работать'";

		if ($stat[w_time]<$now) echo" onclick=\"if (confirm('Вы действительно хотите получить данную работу?')) window.location='works.php?getm=$acs[id]&'+Math.random();''\""; else echo" disabled";

		echo"></td></tr>";

	}


	echo"
</table>


</td>
</tr>
</table>

</fieldset>";

	// Конец получения владений





















	echo"</td>
</tr>
</table>
</td>
</tr>
</table>";

}

?>
