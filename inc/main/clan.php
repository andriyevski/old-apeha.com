<?
$now=time();
$title='Клан';
include("inc/html_header.php");


echo"
<body leftmargin=0 topmargin=0>
<div id=hint1 class=hint></div>

<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>
";


$uri=GetEnv("REQUEST_URI");
$uri=explode("?",$uri);
$uri=$uri['0'];

if (($set == "clan" && $uri=="/main.php") && (!empty($usemagic) && is_numeric($useid))) include("inc/magic/abils/use.php");

include("inc/main/changed.php");
$widthhp=$stat['hp_now']/$stat['hp_max']*181;
if ($widthhp==0) $widthhp+=2;
if ($widthhp==1) $widthhp+=1;
if ($widthhp>1) $widthhp-=1;

print"<table cellpadding=3 width=100% cellspacing=1 border=0 background='/i/bg.gif'>
<td align=right><input class=lbut type=button value='Назад' onClick=top.main.location.href=\"main.php?set=&tmp=\"+Math.random();\"\">
</td></table>";


if ($stat['tribe']) {

	function ld_m ($t,$u,$w,$r,$m,$s) {
		global $now;
		mysql_query("INSERT INTO ld (user, writer, mess, time, reason, type, srok) values('".addslashes($u)."', '".addslashes($w)."', '".addslashes($m)."', '".$now."', '".addslashes($r)."', '".addslashes($t)."', '".addslashes($s)."')");
	}

	// Принятие в клан
	if ($mode == "add" && $stat['b_tribe'] > 0) {
		if (empty($login) || $login == "Логин")
		$msg = "Укажите логин персонажа, которого Вы хотите принять в клан!";
		else {
			$hinfo=mysql_fetch_array(mysql_query("SELECT user, id, room, rank, level, tribe, ic FROM players WHERE user='".addslashes($login)."' LIMIT 1"));

			if (empty($hinfo['user']))
			$msg = "Персонаж <u>".$login."</u> не найден!";
			elseif ($hinfo['user'] == $stat['user'])
			$msg = "Вы и так состоите в клане <U>".$stat['tribe']."</U>!";
			elseif ($hinfo['tribe'])
			$msg = "Персонаж <U>".$hinfo['user']."</U> состоит в клане <U>".$hinfo['tribe']."</U>.";
			elseif ($hinfo['level']<2)
			$msg = "Вступать в клан могут персонажи не ниже 2 уровня!";
			elseif ($stat['credits']<150)
			$msg = "У Вас нет необходимой суммы для приёма персонажа в клан!";
			elseif ($hinfo['ic']<$now)
			$msg = "Персонаж либо слишком давно проходил проверку у Инквизиторов, либо не проходил её вовсе!";
			else {
				$RunQuery = mysql_query("UPDATE players t1, players t2 SET t1.credits=t1.credits-150, t2.tribe='".$stat['tribe']."', t2.b_tribe=0, t2.tribe_rank='' WHERE t1.user='".$stat['user']."' AND t2.user='".$hinfo['user']."' AND t1.credits>=150");

				if ($RunQuery) {

					ld_m (4,$hinfo['user'],'Администратор','',"Принят в клан <U>".$stat['tribe']."</U> персонажем <U>".$stat['user']."</U>",'');

					require_once("inc/chat/functions.php");
					insert_msg("Персонаж <b><u>".$stat['user']."</u></b> принял Вас в клан <b><u>".$stat['tribe']."</u></b>","","","1",$hinfo['user'],"",$hinfo['room']);

					$msg = "Вы приняли в клан персонажа <U>".$hinfo['user']."</U>.";
				}
			}
		}
	}

	// Исключение из клана
	if ($mode == "drop" && $stat['b_tribe'] > 0) {
		if (empty($login) || $login == "Логин")
		$msg = "Укажите логин персонажа, которого Вы хотите принять в клан!";
		else {
			$hinfo=mysql_fetch_array(mysql_query("SELECT user, id, room, tribe, b_tribe FROM players WHERE user='".addslashes($login)."' LIMIT 1"));

			if (empty($hinfo['user']))
			$msg = "Персонаж <u>".$login."</u> не найден!";
			elseif ($hinfo['user'] == $stat['user'])
			$msg = "Вы не можете исключить из клана самого себя!";
			elseif ($hinfo['tribe'] != $stat['tribe'])
			$msg = "Персонаж <U>".$hinfo['user']."</U> не состоит в вашем клане!";
			elseif ($hinfo['b_tribe'] == 1)
			$msg = "Персонаж <U>".$hinfo['user']."</U> является главой клана ".$stat['tribe'].".<BR>Никто не в праве исключить главу клана!";
			elseif ($stat['credits']<50)
			$msg = "У Вас нет необходимой суммы для исключения персонажа из клана!";
			else {
				$RunQuery = mysql_query("UPDATE players t1, players t2 SET t1.credits=t1.credits-50, t2.tribe='0', t2.b_tribe=0, t2.tribe_rank='' WHERE t1.user='".$stat['user']."' AND t2.user='".$hinfo['user']."' AND t1.credits>=50");

				if ($RunQuery) {

					ld_m (4,$hinfo['user'],'Администратор','',"Исключён из клана <U>".$stat['tribe']."</U> персонажем <U>".$stat['user']."</U>",'');

					require_once("inc/chat/functions.php");
					insert_msg("Персонаж <b><u>".$stat['user']."</u></b> исключил Вас из клана <b><u>".$stat['tribe']."</u></b>","","","1",$hinfo['user'],"",$hinfo['room']);

					$msg = "Вы исключили из клана персонажа <U>".$hinfo['user']."</U>.";
				}
			}
		}
	}

	// Сложение полномочий
	if ($mode == "tcp" && $stat['b_tribe'] == 1) {
		if (empty($login) || $login == "Логин")
		$msg = "Укажите логин персонажа, на которого Вы хотите сложить полномочия!";
		else {
			$hinfo=mysql_fetch_array(mysql_query("SELECT user, id, room, tribe, b_tribe FROM players WHERE user='".addslashes($login)."' LIMIT 1"));

			if (empty($hinfo['user']))
			$msg = "Персонаж <u>".$login."</u> не найден!";
			elseif ($stat['b_tribe'] != 1)
			$msg = "У Вас нет полномочий, что бы их складывать! :)";
			elseif ($hinfo['user'] == $stat['user'])
			$msg = "Зачем складывать полномочия на самого себя? :)";
			elseif ($hinfo['tribe'] != $stat['tribe'])
			$msg = "Персонаж <U>".$hinfo['user']."</U> не состоит в Вашем клане!";
			else {
				$RunQuery = mysql_query("UPDATE players t1, players t2 SET t1.b_tribe=0, t2.b_tribe=1, t2.tribe_rank='' WHERE t1.user='".$stat['user']."' AND t2.user='".$hinfo['user']."'");
				$stat['b_tribe'] = 0;

				if ($RunQuery) {
					require_once("inc/chat/functions.php");
					insert_msg("Персонаж <b><u>".$stat['user']."</u></b> сложил на Вас полномочия главы клана <b><u>".$stat['tribe']."</u></b>","","","1",$hinfo['user'],"",$hinfo['room']);

					$msg = "Вы сложили полномочия на персонажа <U>".$hinfo['user']."</U>.";
				}
			}
		}
	}


	echo"

<table width=100% cellspacing=0 cellpadding=3 border=0 background='/i/bg.gif'>
<tr>
<td align=right>
<center><font class=title>Домашняя страничка клана <U>".$stat['tribe']."</U></font></center><br>

<table width=100% cellspacing=0 cellpadding=5 background='/i/bg2.gif'>
<tr>
<td align=center>

<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>";

	if(!empty($stat['tribe']) and $stat['b_tribe']=='0'){echo"<TD width=185 align=center valign=top>

<table cellpadding=3 width=100% cellspacing=1 border=1 bordercolor=#EAEAEA>
<tr>
<td align=center><b>Управление</b><br><br>

<input type=button value='Покинуть клан' class=lbut style='WIDTH: 150px; CURSOR: Hand' onclick=\"location.href='main.php?set=clan&mode=leave';\" onmouseover=\"hint('Покинуть клан');\" onmouseout=\"c();\"><HR  width=100>
</td>
</tr>
</table></td>
	";
	}

	if ($stat['b_tribe'] > 0) {
		echo"
<TD width=185 align=center valign=top>

<table background='/i/bg4.gif' cellpadding=3 width=100% cellspacing=1 border=1 bordercolor=#EAEAEA>
<tr>
<td align=center>

<b>Управление</b><br><br>

<input type=button value='Принять в клан' class=lbut style='WIDTH: 150px; CURSOR: Hand' onclick=\"ShowForm('Принять в клан за 150 зм', 'main.php?set=clan&mode=add','','');\" onmouseover=\"hint('Принять в клан персонажа');\" onmouseout=\"c();\"><HR  width=100>

<input type=button value='Исключить из клана' class=lbut style='WIDTH: 150px; CURSOR: Hand' onclick=\"ShowForm('Исключить из клана за 50 зм', 'main.php?set=clan&mode=drop','','');\" onmouseover=\"hint('Исключить из клана персонажа');\" onmouseout=\"c();\"><HR  width=100>

<input type=button value='Редактировать статус' class=lbut style='WIDTH: 150px; CURSOR: Hand' onclick=\"ShowForm('Редактировать статус', 'main.php?set=clan&mode=edit','','');\" onmouseover=\"hint('Редактировать статус персонажа, состоящего в Вашем клане');\" onmouseout=\"c();\">";

		if ($stat['b_tribe'] == 1)
		echo"<HR  width=100><input type=button value='Сложить полномочия' class=lbut style='WIDTH: 150px; CURSOR: Hand' onclick=\"ShowForm('Сложить полномочия', 'main.php?set=clan&mode=tcp','','');\" onmouseover=\"hint('Сложить с себя полномочия <b>главы клана</b> на другого персонажа');\" onmouseout=\"c();\">";

		echo"</td>
</tr>
</table></td>";
	}




	echo"<td align=center valign=top>";

	echo"<div id=form></div>
<div id=mainform></div>";




	// Редактирование статуса
	if ($mode=="leave" && !empty($stat['tribe'])) {mysql_query("UPDATE `players` set `tribe`='' where id='".$stat['id']."'");}
	if ($mode=="edit" && $stat['b_tribe'] > 0) {
		if (empty($login) || $login == "Логин")
		$msg = "Укажите логин персонажа, статус которого вы хотите изменить!";
		else {
			$hinfo=mysql_fetch_array(mysql_query("SELECT user, tribe, b_tribe, tribe_rank FROM players WHERE user='".addslashes($login)."' LIMIT 1"));

			if (empty($hinfo['user']))
			$msg = "Персонаж <u>".$login."</u> не найден!";
			elseif ($hinfo['tribe'] != $stat['tribe'])
			$msg = "Персонаж <U>".$hinfo['user']."</U> не состоит в вашем клане!";
			elseif ($hinfo['b_tribe'] == 1)
			$msg = "Персонаж <U>".$hinfo['user']."</U> является главой клана ".$stat['tribe'].".<BR>Никто не в праве изменить статус главы клана!";
			else {

				if (@$update) {
					$n_status = HtmlSpecialChars($n_status);

					$n_status=str_replace("&lt;b&gt;","<b>",$n_status);
					$n_status=str_replace("&lt;i&gt;","<i>",$n_status);
					$n_status=str_replace("&lt;u&gt;","<u>",$n_status);

					$n_status=str_replace("&lt;/b&gt;","</b>",$n_status);
					$n_status=str_replace("&lt;/i&gt;","</i>",$n_status);
					$n_status=str_replace("&lt;/u&gt;","</u>",$n_status);

					if ($s_tribe)
					$QueryString = ", b_tribe=2";
					else
					$QueryString = ", b_tribe=0";

					mysql_query("UPDATE players SET tribe_rank='".addslashes($n_status)."'".$QueryString." WHERE user='".addslashes($login)."'");

					$msg="Статус персонажа <U>".$hinfo['user']."</U> успешно изменён!";
				}
				else {
					$hinfo['tribe_rank']=str_replace("&lt;","<",$hinfo['tribe_rank']);
					$hinfo['tribe_rank']=str_replace("&gt;",">",$hinfo['tribe_rank']);

					echo"<script>
                                        document.all('form').innerHTML='<table width=100% cellspacing=0 cellpadding=0><form action=\'\' method=post><tr><td align=center><input type=hidden name=login value=\'".$hinfo['user']."\'><input class=input value=\'".$hinfo['tribe_rank']."\' style=\'WIDTH: 300px\' name=n_status><br><input class=lbut type=submit name=\'update\' value=\'Сохранить\' style=\'WIDTH: 100px\'></td></tr><tr><td align=center><input type=hidden name=s_tribe value=0><input type=checkbox name=s_tribe id=s_tribe value=1";

					if ($hinfo['b_tribe'] == 2) echo" checked";

					echo"> <label for=s_tribe><b>Может принимать и исключать из клана</b></label></td></tr></form><tr><td align=center><small>Разрешённые теги: &lt;b>, &lt;i>, &lt;u></small></td></tr></table><br>';
                                        </script>";
				}
			}
		}
	}

	if (!empty($msg)) echo"<center><font color=red><b>".$msg."</b></font></center><br>";

	//Берем состав
	$SostQuery=mysql_query("SELECT user, id, level, tribe, b_tribe, tribe_rank, rank, lpv FROM players WHERE tribe='".$stat['tribe']."' ORDER BY user");



	echo"<table  cellpadding=3 width=100% cellspacing=1 border=1 bordercolor=#EAEAEA>";

	echo"<SCRIPT language=JavaScript>
        function s (user,id,level,rank,tribe,status,st) {
        if (status == 0)
                status='<img src=\'i/offline.gif\' alt=\'OffLine\' width=15>';
        else
                status='<img src=\'i/online.gif\' alt=\'OnLine\' width=15>';
        document.write('<tr><td bgcolor=#cecece width=20 align=center valign=center>'+status+'</td><td bgcolor=#cecece width=250><a href=\"javascript:top.pp(\''+user+'\')\"><img src=\'i/private.gif\' border=0 alt=\'Приватное сообщение\'></a> <img src=\'i/align'+rank+'.gif\'><img src=\'i/klan/'+tribe+'.gif\' width=12 height=12><a href=\"javascript:top.to(\''+user+'\')\"><b>'+user+'</b></a> ['+level+'] <a href=\'inf.php?'+id+'\' target=_blank border=0><img src=\'i/inf.gif\'></a></td><td bgcolor=#cecece>'+st+'</td></tr>'); }
        ";

	for ($j=0; $j<mysql_num_rows($SostQuery); $j++) {
		$sostav=mysql_fetch_array($SostQuery);

		if ($sostav['b_tribe'] == 1)
		$st="<font color=red><b>Глава гильдии</b></font>";
		elseif ($sostav['rank'] == 99)
		$st="<font color=red><b>Верховный Инквизитор</b></font>";
		elseif (!empty($sostav['tribe_rank']))
		$st="$sostav[tribe_rank]";
		else
		$st="&nbsp;";

		if (time() - $sostav['lpv'] > 180)
		$status = 0;
		else
		$status = 1;
		echo"s('".$sostav['user']."','$sostav[id]','$sostav[level]','$sostav[rank]','$sostav[tribe]','$status','$st');";
	}

	echo"
        </script>
        </table>";


	echo"</td>

<!-- Абилки -->

<TD width=185 align=center valign=top>

<table cellpadding=3 width=100% cellspacing=1 border=1 background='/i/bg4.gif' bordercolor=#EAEAEA>
<tr>
<td align=center>

<b>Реликты клана</b>";


	$Abils = mysql_query("SELECT abils.*, items.name, items.title FROM abils, items WHERE abils.tribe='".$stat['tribe']."' AND items.name=abils.name ORDER BY abils.id");

	if (mysql_num_rows($Abils)) {
		for ($i=0; $i<mysql_num_rows($Abils); $i++) {
			$Abil = mysql_fetch_array($Abils);
			echo"<HR width=100><input type=button value='".$Abil['title']."' class=lbut style='WIDTH: 150px; CURSOR: Hand' onclick=\"javascript: ShowForm('".$Abil['title']."','','','','1','".$Abil['name']."','".$Abil['id']."','0');\" onmouseover=\"hint('<CENTER><A class=agree>".$Abil['title']."</A></CENTER>Оставшийся лимит: <B>",$Abil['m_iznos']-$Abil['c_iznos']," [".$Abil['m_iznos']."]</B>');\" onmouseout=\"c();\">";

		}
	}
	else
	echo"<HR width=100><a class=agree>У Вашего клана нет реликтов!</a>";



	echo"</td>
</tr>
</table>

</td>

<!-- Конец абилок -->



</tr>
</table>

</td>
</tr>
</table>

<BR><BR>

</td>
</tr>
</table>
";


}
else
echo"<center><b><font color=red>Вы не состоите ни в каком клане!</font></b></center>";

include('inc/f_display.php');


?>
<body background='/i/bg.gif'></body>
