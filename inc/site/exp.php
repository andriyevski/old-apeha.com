<?
include("inc/db_connect.php");
$inf=mysql_query("SELECT * FROM levels order by id");


echo"
<body bgcolor=FCFAF3>
<table align=center cellspacing=0 cellpadding=3 bordercolor=CCCCCC border=1 width=400 bgcolor=e2e2e2>
<tr bgcolor=F2F2F2>
     <td ><b>Уровень</b></td>
     <td ><b>Золото</b></td>
     <td ><b>Сумма золота</b></td>
     <td ><b>Хар-ки</b></td>
     <td ><b>Сумма хар-к</b></td>
     <td ><b>Опыт</b></td>
     <td><b>Баз. опыт</b></td>
     <td ><b>Побед</b></td>
</tr>";




for ($i=0; $i<mysql_num_rows($inf); $i++) {
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