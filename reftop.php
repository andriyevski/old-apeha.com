<?
$PageTitle = "Рейтинг РФС";
$PageImg = "users_top";
?>
<html>
<head>
<title>[ <?=$PageTitle?> ]</title>
<link rel=stylesheet type="text/css" href="i/forum.css">
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
</head>



<div id=hint1 class=hint></div>
<script language=JavaScript src='i/show_inf.js'></script>







<?
include("inc/db_connect.php");
mysql_query("SET CHARSET cp1251");
echo"<table width=100% border=0 cellspacing=0 cellpadding=3>
<tr>";
// Third Reiting
echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: E6C9B5'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [РФС]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

$rt=mysql_query("SELECT user,id,friends,rank,tribe FROM players order by friends desc,exp desc limit 0,500");

while ($reit = mysql_fetch_array($rt)) { $n+=1;
echo"<b><u></u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[friends]','$reit[rank]','$reit[tribe]');</script><br>"; }

unset($rt,$reit,$n);
echo"
</td></tr></table>
</FIELDSET>
</td>";

//
echo"</tr></table>";
?>