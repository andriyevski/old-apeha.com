<?
include("inc/html_header.php");
?>


<html>

<head>
<meta name="GENERATOR" content="Microsoft FrontPage 5.0">
<meta name="ProgId" content="FrontPage.Editor.Document">
<meta http-equiv="Content-Type"
	content="text/html; charset=windows-1251">
<title>Падшие Ангелы - [ Рейтинг Игроков ]</title>
</head>


<body bottomMargin="0" leftMargin="0" topMargin="0" rightMargin="0"
	style="background-image: url('i/index1/bg.jpg')">

<div align="center">
<center>
<table border="0" cellpadding="0" cellspacing="0"
	style="border-collapse: collapse" width="90%" height="100%"
	bgcolor="#E8ECD1">
	<tr>
		<td width="24" background="i/index1/bgline_left.jpg" rowspan="3"></td>
		<td height="30" background="i/index1/bgcont_center.gif"><img
			border="0" src="i/index1/bgcont_left1.gif" align="left" hspace="0"
			width="105" height="30"><img border="0"
			src="i/index1/bgcont_right1.gif" align="right" hspace="0" width="105"
			height="30"></td>
		<td width="24" background="i/index1/bgline_right.jpg" rowspan="3"></td>
	</tr>
	<tr>
		<td height="100%" align="center">
		<center>





		<div id=hint1 class=hint></div>
		<script language=JavaScript src='i/show_inf.js'></script> <br>
		<center><font size=5 color=993300><B>Падшие Ангелы - [ Рейтинг Игроков
		]</B></font></center>
		<br>
		<br>
		<center><font size=4 color=993300><B>25 лучших игроков</B></font></center>
		<br>


		<?
		include("inc/db_connect.php");
		mysql_query("SET CHARSET cp1251");
		echo"<table width=80% border=0 cellspacing=0 cellpadding=3>
<tr>";

		// First Reiting
		echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: FCFAF3'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [Побед - поражений]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

		$rt=mysql_query("SELECT user,id,level,rank,tribe FROM players  where rank not like 60 order by wins-losses desc limit 0,25");

		while ($reit = mysql_fetch_array($rt)) { $n+=1;
		echo"<b><u>$n.</u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[level]','$reit[rank]','$reit[tribe]');</script><br>"; }

		unset($rt,$reit,$n);
		echo"
</td></tr></table>
</FIELDSET>
</td>";

		//




		// Second Reiting
		echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: FCFAF3'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [Побед + поражений]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

		$rt=mysql_query("SELECT user,id,level,rank,tribe FROM players  where rank not like 60 order by wins+losses desc limit 0,25");

		while ($reit = mysql_fetch_array($rt)) { $n+=1;
		echo"<b><u>$n.</u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[level]','$reit[rank]','$reit[tribe]');</script><br>"; }

		unset($rt,$reit,$n);
		echo"
</td></tr></table>
</FIELDSET>
</td>";

		//






		// Third Reiting
		echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: FCFAF3'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [Уровень]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

		$rt=mysql_query("SELECT user,id,level,rank,tribe FROM players  where rank not like 60 order by level desc,exp desc limit 0,25");

		while ($reit = mysql_fetch_array($rt)) { $n+=1;
		echo"<b><u>$n.</u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[level]','$reit[rank]','$reit[tribe]');</script><br>"; }

		unset($rt,$reit,$n);
		echo"
</td></tr></table>
</FIELDSET>
</td>";

		//



		echo"</tr></table>";
		?> <br>
		<center><font size=4 color=993300><B>10 лучших игроков</B></font></center>
		<br>



		<?
		include("inc/db_connect.php");
		mysql_query("SET CHARSET cp1251");
		echo"<table width=80% border=0 cellspacing=0 cellpadding=3>
<tr>";

		// Money
		echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: FCFAF3'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [Золотых Монет]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

		$rt=mysql_query("SELECT user,id,level,rank,tribe FROM players  where rank not like 60 order by credits desc limit 0,10");

		while ($reit = mysql_fetch_array($rt)) { $n+=1;
		echo"<b><u>$n.</u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[level]','$reit[rank]','$reit[tribe]');</script><br>"; }

		unset($rt,$reit,$n);
		echo"
</td></tr></table>
</FIELDSET>
</td>";

		//



		// strength
		echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: FCFAF3'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [Силы]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

		$rt=mysql_query("SELECT user,id,level,rank,tribe FROM players  where rank not like 60 order by strength desc limit 0,10");

		while ($reit = mysql_fetch_array($rt)) { $n+=1;
		echo"<b><u>$n.</u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[level]','$reit[rank]','$reit[tribe]');</script><br>"; }

		unset($rt,$reit,$n);
		echo"
</td></tr></table>
</FIELDSET>
</td>";

		//


		// strength
		echo"
<td width=33%>
<FIELDSET style='BORDER-COLOR: FCFAF3'><LEGEND><FONT COLOR=#8A6246><B>Рейтинг [Ловкости]</B></FONT></LEGEND>
<table width=100% cellpadding=10 cellspacing=0 border=0><tr><td>";

		$rt=mysql_query("SELECT user,id,level,rank,tribe FROM players  where rank not like 60 order by dex desc limit 0,10");

		while ($reit = mysql_fetch_array($rt)) { $n+=1;
		echo"<b><u>$n.</u></b>&nbsp;&nbsp;<script>show_inf('$reit[user]','$reit[id]','$reit[level]','$reit[rank]','$reit[tribe]');</script><br>"; }

		unset($rt,$reit,$n);
		echo"
</td></tr></table>
</FIELDSET>
</td>";
		//


		echo"</tr></table>";
		?> <br>
		<small>Для коректной игры сделайте настройки в вашем браузере:<br>
		<b>Вид -> Кодировка -> Автовыбор</b></small> <br>
		<br>
		<br>
		<font face="Verdana" size="2">
		<center><u><small>Падшие Ангелы (Все права защищены)</small></u><br>
		<br>


		</center>
		</font></center>
		</td>
	</tr>
	<tr>
		<td height="30" background="i/index1/bgcont_center_down.gif"><img
			border="0" src="i/index1/bgfoo_left.gif" align="left" hspace="0"
			width="105" height="30"><img border="0"
			src="i/index1/bgfoo_right.gif" align="right" hspace="0" width="105"
			height="30"></td>
	</tr>
</table>
</center>
</div>
</body>
</html>
