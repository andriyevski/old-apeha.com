<?
$object=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time DESC");


###НАЧАЛО ЦИКЛА
for($i=0; $i<mysql_num_rows($object); $i++) {
	$objects=mysql_fetch_array($object);
	$obj_inf=explode("|",$objects['inf']);
	$iteminfo=mysql_fetch_array(mysql_query("SELECT title FROM items WHERE name='".$objects['name']."' LIMIT 1"));



	echo"
<tr>
<td>

<table width=100% cellspacing=0 cellpadding=3 border=1 bordercolor=CCCCCC bgcolor=EBEDEC>
<tr";

	if ($objects[bank]) echo" bgcolor='E2E2E2'";

	echo">
<td width=33% align=center><b>".$obj_inf['1']."</b><br><small>Долговечность: ".$obj_inf['6']." [".$obj_inf['7']."]</small></td>
<td width=34% align=center><img src='i/items/".$obj_inf['0'].".gif'></td>
<td width=33% align=center>";


	if ($objects[bank]) echo"<a href='pomest_zeml.php?set1=edit&out=".$obj_inf['0']."&tmp=$objects[id]'>Изъять из землянки</a><br>
<small><i>(Находится в землянке)</i></small>";

	else echo"<a href='pomest_zeml.php?set1=edit&in=".$obj_inf['0']."&tmp=$objects[id]'>Положить в землянку</a><br>
<small><i>(Находится в рюкзаке)</i></small>";

	echo"</td>
</tr>
</table>


</td>
</tr>
";


}
###КОНЕЦ ЦИКЛА


if ($i==0) echo"<tr><td align=center><i>Рюкзак пуст!</i></td></tr>";
?>