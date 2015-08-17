<?
include("inc/db_connect.php");

$title="Инстинкты Воина - [Таблица опыта]";
include("inc/html_header.php");


$inf=mysql_query("SELECT * FROM levels order by level");

echo"<style>
td	{ TEXT-ALIGN: Center; }
</style>";


echo"<center><font class=title>Таблица опыта</font></center><br>";


echo"
<body bgcolor=EBEDEC>
<table cellspacing=0 cellpadding=3 bordercolor=CCCCCC border=1 width=100% bgcolor=e2e2e2>
<tr bgcolor=F2F2F2>
	<td width=60><b>Уровень</b></td>
	<td width=120><b>Золотые монеты</b></td>
	<td width=160><b>Сумма золотых монет</b></td>
	<td width=120><b>Характеристики</b></td>
	<td width=150><b>Сумма характеристик</b></td>
	<td width=110><b>Опыт</b></td>
	<td><b>Базовый опыт</b></td>
	<td width=90><b>Побед</b></td>
</tr>";




for ($i=0; $i<mysql_numrows($inf); $i++) {
	$l=mysql_fetch_array($inf);

	$credits+=$l[credits];
	$updates+=$l[updates];

	if ($base!=0) $wins=$l[exp]/$base; else $wins=0;
	$wins=round($wins);

	echo"<tr"; if ($als) echo" bgcolor=F2F2F2"; echo">
	<td>$l[level]</td>
	<td>$l[credits]</td>
	<td>$credits</td>
	<td>$l[updates]</td>
	<td>$updates</td>
	<td>$l[exp]</td>
	<td>$l[base]</td>
	<td>$wins</td>
</tr>";


	$base=$l[base];
	if (!$als) $als=1; else $als=0;
}

echo"</table>";

?>