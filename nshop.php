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

	$title = '������� \"��� ������\"';

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
<td>&nbsp;&nbsp;<b>� ��� �� �����:</b> <u>".$stat['credits']."</u> <b>��.</b>
</td>
<td align=right valign=top>

<img src='i/refresh.gif' style='CURSOR: Hand' alt='��������' onclick='window.location.href=\"nshop.php?otdel=$otdel&tmp=\"+Math.random();\"\"'>

<img src='i/back.gif' style='CURSOR: Hand' alt='���������' onclick='window.location.href=\"world.php?room=0&tmp=\"+Math.random();\"\"'>&nbsp;

</td>
</tr>
</table>";


	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>������� \"��� ������\"</font></center><br>";

	if (!empty($msg)) echo"<center><FONT COLOR=RED><b>$msg</b></font></center><BR>";

	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td width=230 valign=top>

<FIELDSET><LEGEND><a class=ch>������ ��������</a></LEGEND>

<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>

<table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2' bgcolor=E2E2E2>
<tr>
<td>

<a class=shop>������:</a><BR>
&nbsp;&bull; <a href='?otdel=1'>���� � �������</a><BR>
&nbsp;&bull; <a href='?otdel=2'>����</a><BR>
&nbsp;&bull; <a href='?otdel=3'>������ � ������</a><BR>
&nbsp;&bull; <a href='?otdel=4'>������ � ������</a><BR><BR>

<a class=shop>�������:</a><BR>
&nbsp;&bull; <a href='?otdel=6'>�����</a><BR>
&nbsp;&bull; <a href='?otdel=7'>˸���� �����</a><BR>
&nbsp;&bull; <a href='?otdel=8'>������ �����</a><BR>
&nbsp;&bull; <a href='?otdel=15'>��������</a><BR>
&nbsp;&bull; <a href='?otdel=16'>�����������</a><BR>
&nbsp;&bull; <a href='?otdel=9'>��������</a><BR>
&nbsp;&bull; <a href='?otdel=10'>����</a><BR>
&nbsp;&bull; <a href='?otdel=11'>�����</a><BR>
&nbsp;&bull; <a href='?otdel=12'>�����</a><BR><BR>

<a class=shop>��������� �������:</a><BR>
&nbsp;&bull; <a href='?otdel=13'>��������</a><BR>
&nbsp;&bull; <a href='?otdel=14'>������</a><BR><BR>


<a class=shop>���������� ��������:</a><BR>
&nbsp;&bull; <a href='?otdel=17'>������</a><BR>
&nbsp;&bull; <a href='?otdel=18'>������</a><BR>
&nbsp;&bull; <a href='?otdel=19'>�����</a><BR>

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
	echo"����������� ������� ������ \"$otdels[$otdel]\"&nbsp;";

	echo"</a></LEGEND>

<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<td>

<table width=100% cellspacing=0 border=0 cellpadding=5 style='border-style: outset; border-width: 2' bgcolor=E2E2E2>
<tr>
<td>
";

	/*
	 if ($stat[rank] != 100) echo"<a href=# style='COLOR: Red'>������� ������. ���� ������.</a>"; else include('inc/shop/_otdels_tt.php');
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