<?
# include('inc/noflood.php');

include('inc/db_connect.php');
mysql_query("SET CHARSET cp1251");
$now=time();
$error = "<title>Ошибка!</title><link rel=stylesheet type='text/css' href='i/main.css'>
   <body bgcolor=EBEDEC>
 <font color=red><b>Ошибка:</b></font><br>Персонаж с таким логином или ID не найден!";

if (isset($_GET['login']) && !empty($_GET['login'])){
	$login = mysql_escape_string($_GET['login']);
	$where = " where players.user='".addslashes($login)."'";
}
elseif (is_numeric($_SERVER['QUERY_STRING']))
{
	$id = mysql_escape_string($_SERVER['QUERY_STRING']);
	$where = " where players.id=".addslashes($id);
}
else
{
	die($error);
}
$query = mysql_query("select * from players".$where."");
$stat12 = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' LIMIT 1"));

// Перс не существует, попробуем поискать по другим городам.

// РЕДИРЕКТЫ ПЕРСОВ



// РЕДИРЕКТЫ ПЕРСОВ

if (mysql_num_rows($query)==0) { die($error); }
else {
	$info = mysql_fetch_array($query);

	$stat = mysql_fetch_array(mysql_query("select rank, admin, id from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

	include("inc/main/changed1.php");

	if ($info['skl']==3) $rase="<img src='i/kways3.gif'> Рыцарь света";
	elseif ($info['skl']==2) $rase="<img src='i/kways2.gif'> Рыцарь тьмы";
	else{$rase="Смертный";}
	$block = '';
	if ($info['bloked']){
		$block = "<br><font class=bloked>Персонаж заблокирован!</font><br><b>Причина блокировки:</b> <font color=red class=ch><b>".$info['bloked']."</b></font>";
	}

	$ctime = time();

	$motto = '';
	if (!empty($info['deviz'])){
		$motto = "<b>Девиз</b>: <a class=ch>".$info['deviz']."</a><br>";
	}
	$icq = '';
	if ($info['icq']!=0){
		$icq = "<b>ICQ</b>: <a class=ch>".$info['icq']."</a><br>";
	}
	$homepage = '';
	if (!empty($info['url'])){
		$homepage = "<b>Домашняя страница</b>: <a href='".$info['url']."' target=_blank><font class=ch>".$info['url']."</font></a><br>";
	}

	?>






<html>
<head>
<title>Падшие Ангелы - [ Информация о персонаже ] - <?=$info['user']?></title>
<LINK href="i/inf/main.css" type=text/css rel=stylesheet>
<meta http-equiv=Content-Type content='text/html; charset=windows-1251'>
<META Http-Equiv=Cache-Control Content=no-cache>
<meta http-equiv=PRAGMA content=NO-CACHE>
<META Http-Equiv=Expires Content=0>


<body topmargin="0" leftmargin="0" background="i/bb.jpg" style="text-align:center">

<div id=hint1 class=hint></div>
<script src='i/inf.js'></script>
<script src='i/show_inf.js'></script>
<script src='i/time.js'></script>

<table cellpadding=0 cellspacing=0 width=90% align=center>
<tr>
<td valign=top ><?include("inc/inf/inf.php");?></td><td valign=top><table width=15% cellpadding=0 cellspacing=0><?include("inc/inf/news/left.php");?></table><table width=15%  cellpadding=0 cellspacing=0><?php include("inc/inf/news/right.php");?></table></td><td valign=top><table width=500 height=460 cellpadding=0 cellspacing=0><?php include("inc/inf/news/anket.php");?></table></td>
</tr>
<tr>
<td>
					
</td>
</tr>
</table>
</body>






					<?
					if ((($stat['rank']>=10 && $stat['rank']<=14) || $stat['rank']>=98) || $stat['admin'] == 1 || $stat['id'] == 20572 || $stat['login'] == gor) {
						?>

<BR>

<TABLE cellspacing=0 cellpadding=0 width=80% align=center>
	<TR>
		<TD>




		<center><font face=Verdana size=2pt><u>Личное дело персонажа <b><?=$info['user']?></b></u></font></center>
		<table width=100% cellspacing=0 cellpadding=0 border=0>
			<tr>
				<td width=100%><? include('inc/inf/transfers.php'); ?> <? include('inc/inf/ld.php'); ?>

				<?
				$otchet=mysql_query("SELECT ip, result FROM `security` WHERE user='$info[user]'");
				$otchets=mysql_fetch_array($otchet);
				if ($otchets['result']==1) $result="&nbsp;<img src='i/fixed_on.gif' alt='Вход в систему успешный'>";
				elseif ($otchets['result']==2) $result="&nbsp;<img src='i/fixed_off.gif' alt='Неверный пароль!'>";
				else  $result="Нет записи в бд!&nbsp;<img src='i/clock.gif' alt='Долгое время отсутствовал или не разу не заходил!'>";
				?>
				<table width=100% cellspacing=0 cellpadding=3 border=0>

					<tr>
						<td width=26%><b>IP при регистрации:</b></td>
						<td><b><i><?=$info['ip']?></i></b></td>
					</tr>

					<tr>
						<td width=26%><b>IP последний:</b></td>
						<td><b><i><?=$otchets['ip']?><?=$result?></i></b></td>
					</tr>

					<tr>
						<td><b>E-Mail адрес:</b></td>
						<td><i><?=$info['email']?></i></a></td>
					</tr>

					<tr>
						<td><b>День рождения:</b></td>
						<td><i><?=$info['birth']?></i></td>
					</tr>

					<tr>
						<td><b>Мультиники:</b></td>
						<td><? if ($info['user']!="Блатной Бот" && $info['user']!="Кто Я" && $info['user']!="Insider") include('inc/inf/mults.php'); ?>

						</td>
					</tr>
					<tr>
						<td><b>Реферал:</b></td>
						<td><i><?=$info['referer']?></i></b></td>
					</tr>
					<tr>
						<td><b>Опыт:</b></td>
						<td><i><?=$info['exp']?></i></b></td>
					</tr>
					<tr>
						<td><b>РФС:</b></td>
						<td><i><?=$info['friends']?></i></b></td>
					</tr>
					<tr>
						<td><b>Золото:</b></td>
						<td><i><?=$info['credits']?></i></b></td>
					</tr>
					<tr>
						<td><b>Валюта:</b></td>
						<td><i><?=$info['valute']?></i></b></td>
					</tr>
					<tr>
						<td><b>Неиспользованых UP-ов:</b></td>
						<td><i><?=$info['s_updates']?></i></b></td>
					</tr>
				</table>
				</td>
			</tr>
		</table>




		</TD>

	</TR>

</TABLE>

				<?
					}
					?>


</td>
</tr>

</table>



					<?
}

?>