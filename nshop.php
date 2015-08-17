<?
include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

$ctime = time();

if ($stat['t_time']) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']) { header("Location: academy.php"); exit; }
elseif ($stat['battle']) { header("Location: battle.php"); exit; }
elseif ($stat['room'] != 7) { header("Location: main.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }

else {
	$_SHOP['type'] = 2;

	if (!isset($otdel)) $otdel=1;

	if (!empty($buy)) include("inc/shop/buy_tt.php");

	$title = 'Магазин \"Три тополя\"';

	include("inc/html_header.php");

	include("inc/shop/otdels.php");

	echo'<link rel=stylesheet type="text/css" href="i/shop.css">';

	echo"
<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
";

	echo"<style>
.none                { display: none }
</style>";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>&nbsp;&nbsp;<b>У Вас на счету:</b> <u>".$stat['credits']."</u> <b>зм.</b>
</td>
<td align=right valign=top>

<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"nshop.php?otdel=$otdel&tmp=\"+Math.random();\"\"'>

<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>&nbsp;

</td>
</tr>
</table>";


	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>Магазин \"Три тополя\"</font></center><br>";

	if (!empty($msg)) echo"<center><FONT COLOR=RED><b>$msg</b></font></center><BR>";

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td width=230 valign=top>

<FIELDSET><LEGEND><a class=ch>Отделы магазина</a></LEGEND>

<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>

<table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2' bgcolor=E2E2E2>
<tr>
<td>

<a class=shop>Оружие:</a><BR>
&nbsp;&bull; <a href='?otdel=1'>Ножи и кинжалы</a><BR>
&nbsp;&bull; <a href='?otdel=2'>Мечи</a><BR>
&nbsp;&bull; <a href='?otdel=3'>Топоры и Секиры</a><BR>
&nbsp;&bull; <a href='?otdel=4'>Дубины и Булавы</a><BR><BR>

<a class=shop>Доспехи:</a><BR>
&nbsp;&bull; <a href='?otdel=6'>Шлемы</a><BR>
&nbsp;&bull; <a href='?otdel=7'>Лёгкая броня</a><BR>
&nbsp;&bull; <a href='?otdel=8'>Тяжёлая броня</a><BR>
&nbsp;&bull; <a href='?otdel=15'>Браслеты</a><BR>
&nbsp;&bull; <a href='?otdel=16'>Нарукавники</a><BR>
&nbsp;&bull; <a href='?otdel=9'>Перчатки</a><BR>
&nbsp;&bull; <a href='?otdel=10'>Щиты</a><BR>
&nbsp;&bull; <a href='?otdel=11'>Пояса</a><BR>
&nbsp;&bull; <a href='?otdel=12'>Обувь</a><BR><BR>

<a class=shop>Ювелирные изделия:</a><BR>
&nbsp;&bull; <a href='?otdel=13'>Ожерелья</a><BR>
&nbsp;&bull; <a href='?otdel=14'>Кольца</a><BR><BR>


<a class=shop>Магические предметы:</a><BR>
&nbsp;&bull; <a href='?otdel=17'>Посохи</a><BR>
&nbsp;&bull; <a href='?otdel=18'>Свитки</a><BR>
&nbsp;&bull; <a href='?otdel=19'>Зелья</a><BR>

</td>
</tr>
</table>

</td>
</tr>
</table>

</FIELDSET>


</td>
<td valign=top>

<FIELDSET><LEGEND><a class=ch>";
	echo"Ассортимент товаров отдела \"$otdels[$otdel]\"&nbsp;";

	echo"</a></LEGEND>

<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>

<table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2' bgcolor=E2E2E2>
<tr>
<td>
";

	/*
	 if ($stat[rank] != 100) echo"<a href=# style='COLOR: Red'>Магазин закрыт. Приём товара.</a>"; else include('inc/shop/_otdels_tt.php');
	 */

	include('inc/shop/_otdels_tt.php');

	echo"
</td>
</tr>
</table>

</td>
</tr>
</table>

</FIELDSET>



</td>
</tr>
</table>
";

	echo"
</td>
</tr>
</table>";

}
?>