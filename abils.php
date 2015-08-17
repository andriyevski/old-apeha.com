<?
include('inc/header.php');

print"<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr>
<td>
<center><u><i>Абилити</i></u></center>
</td>
<td align=right>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"main.php?set=abils&tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";



if (mysql_numrows(mysql_query("SELECT * FROM abils where tribe='".$stat['tribe']."'"))) {

	// echo"<div id=form align=center></div><br>";

	// Список абилок
	$_abil=mysql_query("SELECT distinct(id), name, c_iznos, m_iznos FROM abils where tribe='".$stat['tribe']."' order by id");

	for ($i=0; $i<mysql_numrows($_abil); $i++) {
		$abil=mysql_fetch_array($_abil);
		$iteminfo=mysql_fetch_array(mysql_query("SELECT name, title FROM items where name='".$abil['name']."'")); // Получаем инфу о предмете

		echo"<a href=\"javascript:ShowForm('$iteminfo[title]','','','','1','$iteminfo[name]','$abil[id]','0'";

		echo");\"><img src='i/items/$iteminfo[name].gif'></a> <b>$iteminfo[title] - ["; echo $abil[m_iznos]-$abil[c_iznos]; echo"/$abil[m_iznos]]</b><br>";


	}
	//





} else $nms="У Вас нет ни одной абилити!";

include('inc/f_display.php');

?>