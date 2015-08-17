<?php

include("forms.php");

echo"<div id=battle_forms></div>";


$now=time();

include("inc/db_connect.php");

$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");


mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");
include("inc/main/changed.php");



if ($Attack) {

	if (empty($login)) $msg = "Укажите логин!";
	else {
		$chl=mysql_fetch_array(mysql_query("SELECT id, v_time, k_time, user, room, level, hp_now, battle, last_battle, vitality, travma, rank, lpv, rase_skill FROM players where user='".addslashes($login)."'"));

		if ($chl['user'] == $stat['user']) $msg="Нападение на самого себя - это уже мазохизм...";
		elseif ($chl['rank']!=60) $msg="Персонаж <u>$login</u> отстутствует!";

		elseif ($stat['travma']>$now) $msg="С травмой в бой нельзя!";
		//						elseif ($stat['level'] != $chl['level']) $msg="Выбери равного противника!";
		elseif ($chl['room']!=2) $msg="Для нападния Вам необходимо находится в одной комнате!";
		elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33)) $msg="Вы слишком ослаблены для боя!";
		elseif ($chl['hp_now'] <= 5  && $chl['rank']<>60) $msg="Персонаж <u>$login</u> слишком слаб для поединка!";
		elseif (((time()-$chl['lpv'])<10) && ($chl['battle'] == $chl['last_battle'] || !$chl['battle']) && $chl['rank']==60) $msg="Бот <u>".$chl['user']."</u> еще не восстановил свой уровень жизни!";
		elseif (($stat['level']-$chl['level'])>0 && $stat[level] > 5) $msg="Нельзя нападать на ботов слабее чем Вы!";

		else {

			require_once("inc/chat/functions.php");
			insert_msg("Разъярённый <b><u>$stat[user]</u></b> собрался с силами и напал на Вас!","","","1",$chl['user'],"",$chl['room']);

			$battime="$now";

			if ($chl['rank']==60 && ($chl['battle'] == $chl['last_battle'] || !$chl['battle'])) {

				$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
				$MySkills = explode("|",$chl['rase_skill']);
				$chl['gnom']=$MySkills['3']*5;
				$chl['vitality']+=$_obj['vitality'];
				$chl['hp_max']=ceil(($chl['vitality']*5+$_obj['hp'])*(1+($chl['gnom']/100)));
				$chl['hp_now']=$chl['hp_max'];
				mysql_query ("UPDATE `players` SET `hp_now` = '".$chl['hp_now']."', `battle` = NULL, `lpv`='".time()."' WHERE `id` = '".$chl['id']."'");
				$chl['battle'] = NULL;
			}

			if ($chl['battle']) {

				$prt=mysql_fetch_array(mysql_query("SELECT side as side,time as time from participants where time=$chl[battle] and id=$chl[id]"));

				switch ($prt['side']) {
					case 0: $side=1; break;
					case 1: $side=0; break;
				}

				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level] AND up=$stat[up]"));

				mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`) values('$prt[time]', '$stat[id]', '$side', '$levels[base]', $stat[hp_now])");

				$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id from battles where offer=$prt[time]"));
				$b_id_id['id']+=1;

				mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($prt[time], '$battime', '$b_id_id[id]', '', '', '', '', NULL, '', '<script language=JavaScript>show_inf(\"$stat[user]\",\"$stat[id]\",\"$stat[level]\",\"$stat[rank]\",\"$stat[tribe]\");</script> вмешался в поединок!')");
				$b_id=$prt[time];


				mysql_query("UPDATE players, offers SET players.battle=".$prt['time'].", players.side=".$side.", offers.type=2 where players.id=$stat[id] && offers.time=$prt[time]");

			} else {

				$bdate=date("d.m.y H:i",$battime);

				mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout) values($battime+600,1,1,'1','1','180')");

				$levels_my = mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level]"));
				$levels_opp = mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$chl[level]"));

				mysql_query("INSERT INTO participants (time, id, side, hp, base) values($battime+600, '$stat[id]', '0', '".$stat['hp_now']."', '".$levels_my['base']."')");
				mysql_query("INSERT INTO participants (time, id, side, hp, base) values($battime+600, '$chl[id]', '1', '".$chl['hp_now']."', '".$levels_opp['base']."')");

				mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($battime, $battime, '0', '', '', '', '', NULL, '', '<i>Часы показывали <u>$bdate</u> когда бой между </i><font color=CFA87A><b>$stat[user]</b></font> и <font color=679958><b>$chl[user]</b></font> <i>начался!!!</i>')");

				mysql_query("update players set battle=$battime+600, side=0 where id='$stat[id]'");
				mysql_query("update players set battle=$battime+600, side=1 where id='$chl[id]'");
				$b_id=$battime;

			}

			echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";

		}
	}
}










$widthhp=$stat['hp_now']/$stat['hp_max']*181;
if ($widthhp==0) $widthhp+=2;
if ($widthhp==1) $widthhp+=1;
if ($widthhp>1) $widthhp-=1;


include("inc/html_header.php");

echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

echo"</td>
</tr>
</table>";






echo"
<table width=100% cellspacing=0 cellpadding=3 border=0>
<tr>
<td align=right>
<center><font class=title>".$VaultInfo['title']."</font></center><br>";



if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


echo"

<fieldset style='WIDTH: 98.6%'><legend>Тренировочный зал</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>



<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td width=170 align=left valign=top>




<!-- Возможности -->

<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center >

<b>Действия</b><HR color=silver>

<input type=button class=input value='Нападение' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Нападение','show_offers_bot.php?Attack=$now','','','1','attack','1','0');\">

</td>
</tr>
</table>

<!-- Конец возможностей -->

<!-- Навигация -->

<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center>

<b>Информация</b><HR color=silver>Вы находитесь в тренировочном зале<br>
Список ботов он-лайн с которыми вы можете сражаться:

<table cellspacing=0 cellpadding=0 border=0>


</table>";
include('botsonline.php');

echo"
</td>
</tr>
</table>

<!-- Конец навигации -->








</td>
</tr>
</table>




";








echo"</td>
</tr>
</table>
";





?>