<?php
include("inc/db_connect.php");
$online=mysql_num_rows(mysql_query("select `id` from `online`"));
$type=$_GET['type'];
if(empty($type)){$type = "news"; }
else if($type=="news"){$title="Новости";}
else if($type=="top_user"){$title="Топ игроков";}
else if($type=="top_klans"){$title="Топ кланов";}
else if($type=="forum"){$title="Форум";}
else if($type=="lib"){$title="Библиотека";}
else if($type=="comments"){$title="Обсуждение";}
else if($type=="reg"){$title="Регистрация";}
else if($type=="about"){$title="О игре";}
else if($type=="law"){$title="Законы";}
else if($type=="faq"){$title="FAQ";}
else if($type=="start"){$title="Быстрый старт";}
else if($type=="termin"){$title="Термины";}
else if($type=="lib_monsters"){$title="Монстры";}
else if($type=="lib_kvest"){$title="Квесты";}
else if($type=="exp"){$title="Таблица опыта";}
else {die();}
?>
<? $all=mysql_num_rows(mysql_query("select id from players"));$svet=mysql_num_rows(mysql_query("select id from players where skl='3'"));$dark=mysql_num_rows(mysql_query("select id from players where `skl`='2'")); $p_svet=round(($svet/$all)*100,2); $proc=(150/100)*$p_svet;?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type"
	content="text/html; charset=windows-1251">
<title>Падшие Ангелы - Онлайн игра</title>
<style type="text/css">
<!--
body {
	background-color: #000;
	margin-left: 0px;
	margin-top: 0px;
	margin-right: 0px;
	margin-bottom: 0px;
}

left {
	margin: 20 20 20 20;
}

right {
	margin: 20 20 20 20;
}

a:link {
	color: #930;
	text-decoration: none;
}

a:visited {
	color: #930;
	text-decoration: none;
}

a:hover {
	color: #F00;
	text-decoration: none;
}

a:active {
	color: #930;
	text-decoration: none;
}

body,td,th {
	color: #000;
	font-family: Palatino Linotype, Book Antiqua, Palatino, serif;
}
-->
</style>
<link href="i/index.css" rel="stylesheet" type="text/css">
</head>

<body>
<table width="1000" border="0" cellspacing="0" cellpadding="0"
	background="bg.jpg" align="center">
	<tr>
		<td><img src='header.jpg' width="1000" height="512">
		<div align="center" style="margin-top: -78px; padding-left: 33px;">
		<FORM method=post action=enter.php>

		<TABLE align="center">

			<TBODY>

				<TR style="HEIGHT: 14px">

					<TD></TD>

					<TD></TD>
				</TR>

				<TR>

					<TD><INPUT class=login name=user style="background-color: #688686"></TD>

					<TD><INPUT class=login type=password
						style="background-color: #688686" name=pass></TD>

					<TD><INPUT class=login_submit type=submit
						style="background-color: #688689" name=go value="Войти в игру"></TD>

					<TD></TD>
				</TR>
			</TBODY>
		</TABLE>
		</FORM>
		</div>
		<br>
		<center><A style="background-color: #B98c4b" href="index.php?type=reg"><b>&nbsp;РЕГИСТРАЦИЯ&nbsp;</b></A></center>
		</td>
	</tr>
	<tr>
		<td width="1000" height="800" align="center" valign="top" class='left'>

		<table width="960" cellpadding="20" cellspacing="20" align="center">
			<tr>
				<td width="200" align="left" valign="top" bgcolor="#7F9D9D"
					background="/i/bg.gif">
<center><embed height="355" width="188" bgcolor="#ffffff" name="vishnu" src="http://www.iii.ru/static/Vishnu.swf" wmode="window" flashvars="uuid=21457e13-962d-4776-ab32-cb36a8a360dd&disableRuOverride=1&skin_color=0xEBEBEB&vertical_layout=1" type="application/x-shockwave-flash" quality="high" style=""></embed></center>
				<center>Соотношение добра и зла</center>
				<br>

				<? echo "<center>$svet :: $dark</center>";  ?>

				<table width="150" border="0" align="center" cellpadding="0"
					cellspacing="0">

					<tr>

						<td title="<? echo "Ангелы жизни $p_svet %";?>"
							width="<? echo $proc;?>" bgcolor="#FFFFFF">&nbsp;</td>

						<td title="<? echo "Падшие ангелы ".(100-$p_svet)." %";?>"
							width="<? echo 150-$proc;?>" bgcolor="#000000">&nbsp;</td>

					</tr>

				</table>
				<UL>

					<LI><A href="index.php">Главная страница</A>
					
					
					<LI><A href="index.php?type=reg">Регистрация</A>
					
					
					<LI><A href="forum.php">Форум</A> <BR>
					<BR>
					
					
					<LI><FONT color=#660000><B><U>Библиотека</U></B></FONT>
					
					
					<LI><A href="index.php?type=faq">FAQ</A>
					
					
					<LI><A href="index.php?type=start">Быстрый старт</A>
					
					
					<LI><A href="index.php?type=about">О игре</A>
					
					
					<LI><A href="index.php?type=law">Законы</A>
					
					
					<LI><A href="index.php?type=termin">Термины</A>
					
					
					<LI><A href="index.php?type=exp">Таблица опыта</A>
					
					
					<LI><FONT color=#660000><B><U>Рейтинги</U></B></FONT>
					
					
					<LI><A target='_blank' href="top.php">Игроков</A>
					
					
					<LI><A href="index.php?type=top_user">Крутизны</A>
					
					
					<LI><A href="index.php?type=top_klans">Кланов</A>
					
					
					<LI><A target='_blank' href="reftop.php">Реф. ссылок</A><BR>
					<BR>

					<!--Rating@Mail.ru counter--> <script language="javascript"
						type="text/javascript"><!--

d=document;var a='';a+=';r='+escape(d.referrer);js=10;//--></script> <script
						language="javascript1.1" type="text/javascript"><!--

a+=';j='+navigator.javaEnabled();js=11;//--></script> <script
						language="javascript1.2" type="text/javascript"><!--

s=screen;a+=';s='+s.width+'*'+s.height;

a+=';d='+(s.colorDepth?s.colorDepth:s.pixelDepth);js=12;//--></script> <script
						language="javascript1.3" type="text/javascript"><!--

js=13;//--></script><script language="javascript" type="text/javascript"><!--

d.write('<a href="http://top.mail.ru/jump?from=1747979" target="_top">'+

'<img src="http://dc.ca.ba.a1.top.mail.ru/counter?id=1747979;t=218;js='+js+

a+';rand='+Math.random()+'" alt="Рейтинг@Mail.ru" border="0" '+

'height="31" width="88"><\/a>');if(11<js)d.write('<'+'!-- ');//--></script>

					<noscript><a target="_top"
						href="http://top.mail.ru/jump?from=1747979"> <img
						src="http://dc.ca.ba.a1.top.mail.ru/counter?js=na;id=1747979;t=218"
						height="31" width="88" border="0" alt="Рейтинг@Mail.ru"></a></noscript>

					<script language="javascript" type="text/javascript"><!--

if(11<js)d.write('--'+'>');//--></script> <!--// Rating@Mail.ru counter--><br>

					<!-- begin of Top100 logo --> <a
						href="http://top100.rambler.ru/home?id=1933031" target="_blank"><img
						src="http://top100-images.rambler.ru/top100/banner-88x31-rambler-brown2.gif"
						alt="Rambler's Top100" width="88" height="31" border="0" /></a> <!-- end of Top100 logo -->

					<!-- begin of Top100 code --> <script id="top100Counter"
						type="text/javascript"
						src="http://counter.rambler.ru/top100.jcn?1933031"></script>
					<noscript><img src="http://counter.rambler.ru/top100.cnt?1933031"
						alt="" width="1" height="1" border="0" /></noscript>

					<!-- end of Top100 code --><br>

					<!-- StarCounter --> <script language="javascript"
						type="text/javascript">

<!--

ck=document.cookie; ck="SC=1;"; tr="";tr="&amp;cook="+(ck?"Y":"N");

document.write("<a href='http://counter.star.lg.ua/stats.cgi?id=472' target='_blank'>");

document.write("<img src='http://counter.star.lg.ua/star.fcgi?id=472&amp;t="+Math.random()+tr+"&amp;r="+escape(document.referrer)+"' border='0' width='88' height='31' alt='StarCounter' /><"+"/a>");

//-->

</script>

					<noscript><a href='http://counter.star.lg.ua/stats.cgi?id=472'
						target='_blank'><img
						src="http://counter.star.lg.ua/star.fcgi?id=472" border="0"
						width="88" height="31" alt="StarCounter" /></a></noscript>

					<!-- StarCounter --> <br>

					<!--LiveInternet counter--><script type="text/javascript"><!--

document.write("<a href='http://www.liveinternet.ru/click' "+

"target=_blank><img src='http://counter.yadro.ru/hit?t28.6;r"+

escape(document.referrer)+((typeof(screen)=="undefined")?"":

";s"+screen.width+"*"+screen.height+"*"+(screen.colorDepth?

screen.colorDepth:screen.pixelDepth))+";u"+escape(document.URL)+

";"+Math.random()+

"' alt='' title='LiveInternet: показано количество просмотров и"+

" посетителей' "+

"border='0' width='88' height='120'><\/a>")

//--></script><!--/LiveInternet-->
				
				</td>

				<td width="700" align="left" valign="top" bgcolor="#BEABA5"
					background="/i/bg.gif"><? include "inc/site/$type.php";?></td>
			</tr>
		</table>

		</td>
	</tr>
</table>

</body>
</html>
