<?
include("inc/db_connect.php");

$title="Инстинкты Воина - [Таблица опыта]";
include("inc/html_header.php");

mysql_query("SET CHARSET cp1251");
$inf=mysql_query("SELECT * FROM transfers order by id");




echo"<center><font class=title>Таблица опыта</font></center><br>";


echo"
<body bgcolor=EBEDEC>
<table cellspacing=0 cellpadding=3 bordercolor=CCCCCC border=1 width=100% bgcolor=e2e2e2>

<tr bgcolor=F2F2F2>

	<td width=60><b>IP</b></td>
	<td width=60><b>От кого</b></td>
	<td width=120><b>Кому</b></td>
	<td width=160><b>Сколько(руб.)</b></td>
	<td width=120><b>Вещи</b></td>
	<td width=150><b>ID</b></td>
	<td width=110><b>Причина</b></td>

</tr>";




for ($i=0; $i<mysql_numrows($inf); $i++) {
	$l=mysql_fetch_array($inf);

	$credits+=$l[credits];
	$updates+=$l[updates];



	$lvl="$l[id]"-1;
	echo"<tr"; if ($als) echo" bgcolor=F2F2F2"; echo">

	<td><center>$l[ip]</td>
	<td><center>$l[fr]</td>
	<td><center>$l[user]</td>
	<td><center>$l[credits]</td>
	<td><center>$l[item]</td>
	<td><center>$l[id]</td>
	<td><center>$l[comment]</td>

	
</tr>";


	$base=$l[base];
	if (!$als) $als=1; else $als=0;
}

echo"</table>";

?>