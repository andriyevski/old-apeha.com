<?
include('inc/db_connect.php');
$stat = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));

if (empty($stat['id']) || $stat['bloked']) {
	echo"<script>top.window.location = 'index.php?action=logout';</script>";
	exit;
}
elseif ($stat['user'] != 'migon') {
	echo"<script>top.window.location = 'index.php?action=logout';</script>";
	exit;
}
?>
<html>
<head>
<title>Acres Of The Hope</title>
<link rel=stylesheet type="text/css" href="i/main.css">
<meta http-equiv=Content-Type content="text/html; charset=windows-1251">
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>
</head>
<style>
td {
	TEXT-ALIGN: Center;
}

/* News Style */
.eDetails {
	border-top: 1px dashed #DBB270;
	border-bottom: 1px dashed #DBB270;
	font-family: Tahoma, Arial, Sans-Serif;
	color: #A88956;
	padding-bottom: 5px;
	padding-top: 3px;
	text-align: left;
	font-size: 7pt;
}
/* ------------- */
</style>
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
		<td height="100%" align="center" valign=top>
		<center>
		<center><font class=title><b>Админка новостей</b></font></center>
		<br>
		<body bgcolor=FCFAF3>
		<table width=100% cellspacing=0 cellpadding=3 border=0>
			<tr>
				<td align=right>
				<table cellspacing=2 cellpadding=2
					style='border-style: outset; border-width: 2; WIDTH: 98.6%'
					border=1>
					<tr>
						<td align=center width=33%><B><a href='news_admin.php?act=add'>Добавить
						Новость</b></td>
						<td align=center width=33%><B><a href='news_admin.php?act=del'>Удалить
						Новость</b></td>
						<td align=center width=33%><B><a href='news_admin.php?act=news'>Редактировать
						Новости</b></td>
					</tr>
				</table>
				<br>
				<table align=center cellspacing=0 cellpadding=3 bordercolor=CCCCCC
					border=1 width=80% bgcolor=e2e2e2>
					<?
					$new=mysql_query("SELECT * FROM news ORDER BY id");
					while($data = mysql_fetch_array($new)){
						$tema=$data["tema"];
						$date=$data["data"];
						$avtor=$data["user"];
						$id=$data["id"];
						$avt = mysql_fetch_array(mysql_query("select * from players where user='".$avtor."'"));
						print"
<div align='center'>
<table width=90% bordercolor=4f3908>
<tr><td style='padding:3px;'>
<div class='eDetails' style='clear:both;'>
Тема: <b><i>$tema</b></i>
 | Добавил: <SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT><SCRIPT language=JavaScript>
show_inf('$avt[user]','$avt[id]','$avt[level]','$avt[rank]','$avt[tribe]');
</SCRIPT> |
Дата: <u>$date</u> | 
ID: <b>$id</b>";
						print"
</div>
</td></tr></table>";
					}
					echo"<hr>";
					switch($act){
						case"add":

							if(@$adds){
								$tems = HtmlSpecialChars($tems);
								$texxt = stripslashes($texxt);
								$tems=str_replace("\n","<br>",$tems);
								$texxt=str_replace("\n","<br>",$texxt);
								$hourdiff = "0";
								$timeadjust = ($hourdiff * 60 * 60);
								$this_time = date("d.m.y H:i",time() + $timeadjust);
								$max = mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM news"));
								$NEWMAXID = $max['id'] + 1;
								$QQQQ = mysql_query("INSERT INTO `news` VALUES('".$NEWMAXID."','".$stat['user']."','".$texxt."','".$tems."','".$this_time."')");
								if($QQQQ){
									print "<center>Новость добавлена.</center>";
									require_once("inc/chat/functions.php");
									insert_msg("Читайте новости...","","","1",$stat['user'],"",$stat['room']);
								}
								else{
									print "Какаето Ошибка!";
								}
							}

							print"
<form method='POST'>
<table border=0>
<tr>
<td>
<input name='tems' size='65' style='float: right'></font><font size='4'><span lang='ru'>Тема:</span></font></td>
</tr>
<tr>
<td>
<textarea name=texxt rows=50 cols=255 style='height: 153; width:493; font-size:12pt'></textarea></td>
</tr>
<tr>
<td>
<center><input type='submit' value='Отправить' class=input name='adds'> <input type='reset' class=input value='Стереть' name='B4'>
</center>
</td>
</tr>
</table>
</form>";


							break; }

							switch($act){
								case"del":

									if (@$dels) {
										mysql_query("DELETE FROM News WHERE id='".$idss."'");
										echo"Новость удалина!";
									}

									echo"<table border=0><tr>
<td><form method=post>
<b>ID:</b>
<input type=text name=idss size=2>
<input type=submit class=input name=dels value='Удалить'></td>
</tr>
</table>
</form>";

									break; }



									switch($act){
										case"news":

											echo"
<form action='news_admin.php' method=post>
<input type=hidden name=act value=news>
Айди: <input type=text name=idc value='$idc'> <input type=submit class=input value='Найти'>
</form>";

											if($idc)
											{
												$user = HtmlSpecialChars($user);
												$tema = HtmlSpecialChars($tema);
												$texxt = stripslashes($texxt);
												$text = str_replace('\n','<br>',$text);
												$text = str_replace('','<br>',$text);
												$query = "select * from news where id='$idc'";
												$result = mysql_query($query);
												$num=mysql_num_rows($result);
												if($num==0)
												{
													echo"<b><i>Новость не найдена!</i></b><br>";
												}
												else
												{
													$row = mysql_fetch_array($result);
													if($dos)
													{
														$result = mysql_query("update news set text='$text', tema='$temas', user='$users' where id='".$idc."'");
														if($result)echo"<b>Данные успешно сохранены</b><br>";
														else echo"<b><i>Произошла непредвидемая ошибка!</i></b><br>";
														$row = mysql_fetch_array(mysql_query("select * from news where id='$idc'"));

													}
													elseif($doc)
													{
														mysql_query("delete from news where id='$id_news'");
														if($result)echo"<b>Новость удалина</b><br>";
													}

													echo"<form action='news_admin.php' methdo=post>
<input type=hidden name=act value=news>
<input type=hidden name=idc value='$idc'>
<input type=hidden name=id_news value='$row[id]'>
<table border=0>
<tr><td>Id Новости:</td><td><b>$row[id]</b></td></tr>
<tr><td>Тема:</td><td><input type=text size=25 name=temas value='$row[tema]'></td></tr>
<tr><td>Автор (Точный ник!):</td><td><input type=text size=25 name=users value='$row[user]'></td></tr>
<tr><td>Текст:</td><td><textarea name=text rows=7 cols=255 style='height: 100; width:293'>".stripslashes($row[text])."</textarea></td></tr>
";
													echo"</table>
<input type=submit name=dos class=input value='Сохранить данные'> <input type=submit name=doc class=input value='Удалить эту новость'></form>";

												}
											}
											break; }
											?>
					<br>
					<center><small>Для коректной игры сделайте настройки в вашем
					браузере:<br>
					<b>Вид -> Кодировка -> Автовыбор</b></small> <br>
					<br>
					<br>
					<font face="Verdana" size="2">
					<center><u><small>Acres Of The Hope (Все права защищены)</small></u></center>
					<br>
					<br></center>
					</font>
				</table>
				</center>
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

