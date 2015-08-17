<?
include('inc/db_connect.php');

if ($id=="undefined" or $id=="") {
	$title="Пустой слот";
	include('inc/html_header.php');
	mysql_query("SET CHARSET cp1251");
	echo"Пустой слот";

}

else {

	$inf=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE id='$id'"));
	$iteminfo=mysql_fetch_array(mysql_query("SELECT * FROM items"));

	include('inc/inf/min_tr.php');
	include('inc/main/add.php');
	include('inc/main/classes.php');

	$title="$iteminfo[title] - Информация о предмете";
	include('inc/html_header.php');

	echo"
<body bgcolor=e2e0e0>

<table width=100% height=100% border=0 cellpacing=0 cellpadding=3>
<tr>
<td valign=top width=360>";
	// <img src='i/items/3d/3d$inf[name].gif'>
	echo"</td>
<td valign=center>
<b><i>Характеристика:</i></b>
<br>Название: <b>$iteminfo[title]</b>";

	if ($iteminfo[art]==1) echo" [<u>Артефакт</u>]<br>";

	echo"
<br>Гос. цена: <b>$iteminfo[price]</b> зм.
<br>Долговечность предмета: <b>0/$iteminfo[iznos]</b><br>



Тип предмета: <b>";

	switch ($iteminfo['tip']) {
		case 1: echo"Оружие"; break;
		case 2: echo"Доспех"; break;
		default: echo"нет"; break; }


		echo "</b><br><br>


<b><i>Минимальные требования:</i></b>
<br>Уровень: $iteminfo[min_level]
<br>Сила: $iteminfo[min_str]
<br>Ловкость: $iteminfo[min_dex]
<br>Удача: $iteminfo[min_ag]
<br>Выносливость: $iteminfo[min_vit]<br>


<b><i>Действие предмета:</i></b>
<br>

		$hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv



</td>
</tr>
</table>
";



}

?>