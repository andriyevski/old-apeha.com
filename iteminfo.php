<?
include('inc/db_connect.php');

if ($id=="undefined" or $id=="") {
	$title="������ ����";
	include('inc/html_header.php');
	mysql_query("SET CHARSET cp1251");
	echo"������ ����";

}

else {

	$inf=mysql_fetch_array(mysql_query("SELECT * FROM items WHERE id='$id'"));
	$iteminfo=mysql_fetch_array(mysql_query("SELECT * FROM items"));

	include('inc/inf/min_tr.php');
	include('inc/main/add.php');
	include('inc/main/classes.php');

	$title="$iteminfo[title] - ���������� � ��������";
	include('inc/html_header.php');

	echo"
<body bgcolor=e2e0e0>

<table width=100% height=100% border=0 cellpacing=0 cellpadding=3>
<tr>
<td valign=top width=360>";
	// <img src='i/items/3d/3d$inf[name].gif'>
	echo"</td>
<td valign=center>
<b><i>��������������:</i></b>
<br>��������: <b>$iteminfo[title]</b>";

	if ($iteminfo[art]==1) echo" [<u>��������</u>]<br>";

	echo"
<br>���. ����: <b>$iteminfo[price]</b> ��.
<br>������������� ��������: <b>0/$iteminfo[iznos]</b><br>



��� ��������: <b>";

	switch ($iteminfo['tip']) {
		case 1: echo"������"; break;
		case 2: echo"������"; break;
		default: echo"���"; break; }


		echo "</b><br><br>


<b><i>����������� ����������:</i></b>
<br>�������: $iteminfo[min_level]
<br>����: $iteminfo[min_str]
<br>��������: $iteminfo[min_dex]
<br>�����: $iteminfo[min_ag]
<br>������������: $iteminfo[min_vit]<br>


<b><i>�������� ��������:</i></b>
<br>

		$hp$energy$min$max$strength$dex$agility$vitality$razum$br1$br2$br5$br3$br4$krit$unkrit$uv$unuv



</td>
</tr>
</table>
";



}

?>