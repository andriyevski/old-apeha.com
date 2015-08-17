<?
require_once("inc/module.php");
if ($set1=="edit") {
	if (!empty($in)) include("inc/pomest/in.php");
	elseif (!empty($out)) include("inc/pomest/out.php");
	include("inc/html_header.php");
	echo"<body leftmargin=2 topmargin=2 bgcolor='EBEDEC'>
<table width=100% border=0 cellspacing=0 cellpadding=0>
<tr><td align=right>

<table width=100% align=center valign=top border=1 cellspacing=0 cellpadding=3 bordercolor=CCCCCC>
<tr>
<td bgcolor=white>

<table width=100% cellspacing=0 cellpadding=0><tr>
<td width=33% align=center><b>Наименование</b></td><td width=34% align=center><b>Изображение</b></td><td width=33% align=center><b>Действие</b></td>
</tr></table>

</td>
</tr>
";
	include("inc/pomest/edit.php");
	echo"</table></td></tr></table>";
	exit;
}


echo"
<table width=100% border=0 cellspacing=0 cellpadding=3>
<tr><td align=center valign=center><b>Список Ваших предметов:</b></td></tr>
<tr><td><iframe src='pomest_zeml.php?set1=edit' width=100% height=255 frameborder=1></iframe></td></tr>
</table>";
?>