<?
include("../db_connect.php");
$sql = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."'"));
$result = mysql_query($sql);
$d = @mysql_fetch_array($result);
$tribe= htmlspecialchars($d["tribe"]);
$credits= htmlspecialchars($d["credits"]);
$ic= htmlspecialchars($d["ic"]);

$stat = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));

if (isset($take1)) {
	if ($stat['kwest0'] != 17) $msg="Ошибка, не пытайтесь взломать игру :)!";
	else {
		mysql_query("UPDATE players SET kwest0=18 WHERE user='".$stat['user']."'");
		$stat['kwest0'] = 18;
		$ItTake = "kwest0_pybaxa_voina";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
		$msg="Вы получили <u>\"Рубаху Война\"</u><br>";
	}
}

if (isset($take2)) {
	if ($stat['kwest1'] != 5) $msg="Ошибка, не пытайтесь взломать игру :)!";
	else {
		mysql_query("UPDATE players SET kwest1=6 WHERE user='".$stat['user']."'");
		$stat['kwest1'] = 6;
		$ItTake = "sun_kamen";
		$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
		if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
		$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
		$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
		mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
		$msg="Вы подобрали <u>\"Солнечный камень\"</u><br>";
	}
}

?>
<HTML>
<HEAD>
<TITLE>Acres Of The Hope - [ Регистратура ]</TITLE>
<link rel=stylesheet type="text/css" href="i/main.css">
<meta content='text/html; charset=windows-1251' http-equiv=Content-type>
</HEAD>
<BODY topmargin=0 marginheight=0 leftmargin=0 rightmargin=0
	bottomMargin=0 bgcolor=#EBEDEC>
<table width="100%" border="0" cellpadding="0" cellspacing="0">
	<!--DWLayoutTable-->
<?
print"
        <html><table width=100% cellspacing=0 cellpadding=5 border=0>
        <tr>
        <td>&nbsp;&nbsp;<font face=Verdana size=2><b>У Вас на счету:</b> <u>".$sql['credits']."</u> <b>зм.</b></font>
        </td>
        <td align=right valign=top>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"klandom.php?tmp=\"+Math.random();\"\"'>
<input class=lbut type=button value='Вернуться' onclick='window.location.href=\"../../world3.php?room=43&tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table><BR></html>";

?>
	</tr>
</table>
</tr>
<tr>
	<td height="13" colspan="3" valign="top" align="center"><?
	if (!empty($msg)) echo"<center><font face=Verdana size=2 color=red><b>$msg</b></font></center><br>";
	?> <?
	if ($stat['kwest0'] == 17)
	echo"<center><fieldset style='WIDTH: 70%'><font face=Verdana size=2><legend>Сообщение о Квесте</legend></font>
<div align=center><font face=Verdana size=2>
Вы случайно здесь увидели <b>\"Рубаху Война\"</b>!<br>
<input class=lbut type=button value='Подобрать' onclick='window.location.href=\"klandom.php?take1\"'>
</font></div></fieldset></center><br>";
	?> <?
	if ($stat['kwest1'] == 5)
	echo"<center><fieldset style='WIDTH: 70%'><font face=Verdana size=2><legend>Сообщение о Квесте</legend></font>
<div align=center><font face=Verdana size=2>
Вы нашли здесь <b>\"Солнечный камень\"</b>!<br>
<input class=lbut type=button value='Подобрать' onclick='window.location.href=\"klandom.php?take2\"'>
</font></div></fieldset></center><br>";
	?>
	<center><font face="Verdana" size="2"><b>Отдел Регистрации Клана.</font></center>
	</b></td>
</tr>
</table>
<center>
<fieldset style='WIDTH: 70%'><font face="Verdana" size="2"><legend>Требования</legend></font>
<div align="center">
<table width=100% cellspacing=0 cellpadding=5>
	<tr>
		<td height="100%" width="100%"><font face="Verdana" size="2">
		<center>Здравствуйте Уважаемый <b><?=$sql["user"]?></b>! Здесь вы
		можете зарегистрировать свой клан на просторах нашего мира.</center>
		<BR>
		<b>Все что нужно иметь для регистрации клана:</b><BR>
		1. Название Клана (в английской форме)<BR>
		2. Значок Клана (формат .gif, 12х12)<BR>
		3. История Клана.<BR>
		4. На счете 2000 зм.<BR>
		5. Чистота перед законом.<BR>
		6. Сайт Клана.<br>
		7. Уровень вашего персонажа 7.<br>
		<br>
		<center><u>Вводите информацию аккуратно, во избежании проблем
		регистрации...</u></center></td>
	</tr>
</table>

</div>
</fieldset>
</center>
<br>
<center>
<fieldset style='WIDTH: 70%'><font face="Verdana" size="2"><legend>Заявка</legend></font>
<font face="Verdana" size="2"><?
if($sql['tribe']=="0"){
	print"
<form method='POST' action='add_klan.php?act=reg'>
<div align='center'>
<table border='0' width='100%' height='100%'>
<td height='100%' width='100%'>
<center><table width=70% cellspacing=0 cellpadding=5>
<tr><td height='100%'><input name='names' style='float: right'><font face=Verdana size=2>Название Клана: <font color='RED'><small>пример: Bots</small></font></font></td></tr>
<tr><td height='100%'><input name='sites' style='float: right'><font face=Verdana size=2>Сайт Клана: <font color='RED'><small>пример: www.bots.ru</small></font></font></td></tr>
<tr><td><font face=Verdana size=2>История: <font color='RED'><small>пример: В тридевятом царстве жил был...</small></font></font></td></tr>
<tr><td height='100%'><textarea name=history rows=50 cols=255 style='height: 100; width:500;'></textarea></td></tr>
<tr><td width='100%' height='100%'><input type='submit' value='Зарегистрировать' class='lbut' name='B3'> <input type='reset' value='Стереть' class='lbut' name='B4'></td></tr>
</table></center>
<form>";
}else {
	print "<font color='RED'>Вы состоите в клане, и неможете зарегистрировать свой! <br>Сначала выйдите из клана в котором вы состоите</font>";
	?></font>
</tr>
</table>
</div>
</fieldset>
</center>
</font>
<?
}
?>

</html>
