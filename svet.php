<?
$now=time();$time = time();
include("inc/db_connect.php");
$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));
$bite_t=$stat['bite'];
$attack_t=$stat['attack'];
$skl = mysql_fetch_array(mysql_query("SELECT `skl`,`id`,`bite`,`attack` FROM `players` WHERE `user` = '".addslashes($user)."' AND `pass` = '".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] == 50) { header("Location: main.php"); exit; }
elseif ($stat['room'] == 51) { header("Location: main.php"); exit; }
elseif ($stat['room'] == 8) { header("Location: main.php"); exit; }else {

	$object=mysql_query("SELECT objects.* FROM objects, slots WHERE objects.user='".$stat['user']."' AND ".$OBJECTS_SELECT_QUERY." AND slots.id=".$stat['id']." AND objects.id NOT IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) ORDER BY time DESC");

	$stat = mysql_fetch_array(mysql_query("select battle from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
	mysql_query("SET CHARSET cp1251");
	if ($stat['battle']) { header("Location: battle.php"); exit; }
	if ($skl['skl']!=3) {  header("Location: main.php"); exit; }



	if(empty($bite_t)){$bite_to=(string)'0';}
	else{$bite_to=(string)$bite_t;}
	if(empty($attack_t)){$attack_to=(string)'0';}
	else{$attack_to=(string)$attack_t;}
	include('inc/header.php');

	print"<script language=JavaScript>var rank='$stat[rank]';</script>";
	print"<script src='i/forms.js'></script>";

	print"
<table width=100% cellspacing=0 cellpadding=0 border=0>
<tr>
<td>
</td>
<td align=right>
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"svet.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


	$CurrentTime = date("H");
	$en=floor(($stat['vitality']*5+$stat['ustal'])/2);
	if (isset($CurrentTime)) {

		echo"<BR><CENTER><FONT STYLE='FONT-SIZE: 9 pt; COLOR: green'><B>Солнце зашло за горизонт... Луна светит во всей своей красе...<BR>Неожиданно простые на вид люди стали превращаться в вампиров и оборотней... Ты, друг мой, должен противостоять этой нечисти!</CENTER>";





		if (isset($attack)) {
			if($attack_t>=15) $msg = "У вас больше нет возможности помоч собрату сегодня!";
			elseif ($chl['immun'] > time()) $msg="На персонаже уже стоит защита от нападения!";
			else {
				if ($stat['vault_move'] == 1) $msg = "Вы не можете напасть во время перемещения!";
				elseif ($stat['r_action'] == 1) $msg = "Вы не можете напасть во время добычи руды!";
				else {
					if (empty($UserName)) $msg = "Укажите логин!";
					 
					$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($UserName)."'"));

					if ($chl['user'] == $stat['user']) $msg="Нападение на самого себя - это уже мазохизм...";
					elseif ($chl['skl'] == '3') $msg="Нельзя напасть на собрата!";
					elseif ($chl['immun'] > time()) $msg="На персонаже уже стоит защита от нападения!";
					elseif ($chl['r_action'] == 1) $msg="Он занят!";
					elseif ($chl['level'] < ($stat['level']-1) and $chl['level']!='0' and $chl['level']!='1') $msg="Выберите противника равного по уровню";
					elseif (time()-$chl['lpv'] > 180 && $chl['rank'] != 60) $nms="Персонаж <u>$UserName</u> отстутствует!";
					elseif ($chl['room'] != $stat['room']) $msg="Для нападния Вам необходимо находится в одной комнате!";
					elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33)) $msg="Вы слишком ослаблены для боя!";
					elseif ($chl['hp_now'] <= 5  && $chl['rank'] != 60) $msg="Персонаж <u>$UserName</u> слишком слаб для поединка!";
					//elseif (((time()-$chl['lpv'])<100) && ($chl['battle'] == $chl['last_battle'] || !$chl['battle'] && $chl['rank']==60)) $msg="Ангел <u>".$chl['user']."</u> еще не восстановил свой уровень жизни!";

					else {
						mysql_query("UPDATE players SET attack=attack+1 WHERE user='".$stat['user']."'");
						if($chl['rank']==60 && empty($chl['battle'])){
							$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));echo mysql_error();
							$MySkills = explode("|",$chl['rase_skill']);
							$chl['gnom']=$MySkills['3']*5;
							$chl['vitality']=$chl['vitality']+$_obj['vitality'];
							$chl['hp_max']=ceil(($chl['vitality']*5)*(1+($chl['gnom']/100))+$_obj['hp']);
							$chl['hp_now']=$chl['hp_max'];

							mysql_query("update players set hp_now='".$chl['hp_max']."' where id='".$chl['id']."'");
						}
						if ($stat[next_exp]!=0)
						$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."' AND exp<='$stat[next_exp]' ORDER BY exp DESC"));
						else
						$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$stat['level']."'AND exp<='$stat[exp]' ORDER BY exp DESC"));

						if (!empty($chl['battle'])) {



							$prt=mysql_fetch_array(mysql_query("SELECT side AS side, x, y, time AS time FROM participants WHERE time='".$chl['battle']."' AND id='".$chl['id']."'"));

							switch ($prt['side']) {
								case 0: $side=1; break;
								case 1: $side=0; break;
							}
							$query=mysql_query("select x, y from participants where time='".$prt['time']."'");
							$i=0;
							while($randes=mysql_fetch_array($query))
							{
								$rande_x[$i]['x']=$randes['x'];
								$rande_y[$i]['y']=$randes['y'];
								$i++;
							}

							$wihg=mysql_fetch_array(mysql_query("select zone_width, zone_height from offers where time='".$chl['time']."'"));
							do{
								$x=rand(0, $wihg['zone_width']);
								$y=$x=rand(0, $wihg['zone_width']);
							}
							while(in_array($x, $rande_x) and in_array($y, $rande_y));

							mysql_query("UPDATE players, offers SET players.battle='".$prt['time']."', players.bside='".$side."', offers.type=2 WHERE players.id='".$stat['id']."' && offers.time='".$prt['time']."'");
							mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`,x,y, frozen) values('".$prt['time']."', '".$stat['id']."', '".$side."', '".$levels['base']."', '".$stat['hp_now']."','1', '$y', '0')");

							$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM battles WHERE offer='".$prt['time']."'"));
							$b_id_id['id']+=1;

							mysql_query("INSERT INTO battles (offer, time, id, type, comment1) values ('".$prt['time']."', '".$now."', '".($b_id_id['id']-1)."', '2', '<b>'".$stat['user']."'</b> ['".$stat['level']."'] вмешался в поединок!')");

						}



						else {


							//$time=time();
							if ($chl[next_exp]!=0)
							$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$chl['level']."' AND exp<='$chl[next_exp]' ORDER BY exp DESC"));
							else
							$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$chl['level']."'AND exp<='$chl[exp]' ORDER BY exp DESC"));
							$bdate=date("d.m.y H:i",$time);


							while (mysql_fetch_array(mysql_query("SELECT * FROM offers WHERE time='".$time."'")))
							$time++;

							mysql_query("INSERT INTO offers (`time`, `type`, `size_left`, `size_right`, `done`, `timeout`, `zone_width`, `zone_height`, `city`) values('$time',1,1,'1','1','180', '6', '3', '1')");


							mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, x, y, frozen) VALUES ('$time','".$stat['id']."','0','".$levels['base']."','".$stat['hp_now']."' ,'1', '1', '0')");

							mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, x, y, frozen) VALUES ('$time','".$chl['id']."','1','".$chl_base['base']."','".$chl['hp_now']."','4', '1', '0')");

							mysql_query("INSERT INTO battles (offer, time, id, type, damage, comment1) values ('$time', '$time', '1', '2', '', '<i>Часы показывали <u>$bdate</u> когда бой начался!')");

							mysql_query("UPDATE players SET battle='$time', bside='0' WHERE id='".$stat['id']."'");
							mysql_query("UPDATE players SET battle='$time', bside='1' WHERE id='".$chl['id']."'");
						}

						require_once("inc/chat/functions.php");
						insert_msg("Разъярённый <b><u>".$stat['user']."</u></b> собрался с силами и напал на Вас!","","","1",$chl['user'],"",$chl['room']);

						echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";
					}
					 
				}
			}
		}
	}



	if (isset($bite)) {
		if($bite_t>='5') $msg = "У вас больше нет возможности отдать энергию сегодня!";
		else {
			if (empty($UserName) || $UserName == "Логин")
			$ShowMessage = "Укажите логин!";
			 
			$HisInfo = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($UserName)."'"));

			$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$HisInfo['id']."' AND objects.user='".$HisInfo['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
			$MySkills = explode("|",$HisInfo['rase_skill']);
			$HisInfo['gnom']=$MySkills['3']*5;
			$HisInfo['vitality']+=$_obj['vitality'];
			$HisInfo['hp_max']=ceil(($HisInfo['vitality']*5+$_obj['hp'])*(1+($HisInfo['gnom']/100)));


			if (!empty($HisInfo['user'])) {
				if (isset($HisInfo['user'])) {
					if ($stat['skl'] == 3) {
						if ($HisInfo['skl'] !=2) {
							include("inc/main/get_inf.php");
							if ($user_lpv < 60) {
								if ($HisInfo['hp_now'] < $HisInfo['hp_max'] ) {
									if ($stat['ustal_now'] >=0) {
										if (!$HisInfo['battle']) {


												
												
											mysql_query("UPDATE players SET hp_now=hp_now + $en*4 WHERE user='".addslashes($UserName)."'");
												
											if (($HisInfo['hp_now'] + $en*4) > $HisInfo['hp_max']) {
												mysql_query("UPDATE players SET hp_now=".$HisInfo['hp_max']." WHERE user='".addslashes($UserName)."'");
											}
												
											mysql_query("UPDATE players SET bite=bite+1 WHERE user='".$stat['user']."'");                                require_once("inc/chat/functions.php");
											insert_msg("Светлый собрат <u><b>".$stat['user']."</b></u> отдал вам свою энергию и восстановил вас!","","","1",$HisInfo['user'],"",$HisInfo['user']);
											$ShowMessage = "вы передали свою энергию персонажу ".$UserName."!";


										} else $ShowMessage = "Вы не можете вылечить, т.к. персонаж ".$UserName." в поединке!";
									} else $ShowMessage = "У вас нет энергии...";
								}
								else $ShowMessage = "Персонаж полон энергии и ему не требуется лечение...";
							}
							else $ShowMessage = "Персонаж ".$UserName." сейчас отсутствует!";
						}
						else $ShowMessage = "Склонность персонажа ".$UserName." не позволяет вылечить его!";
					}
					else $ShowMessage = "Вы не светлый!";

				}
				else $ShowMessage = "Вы не можете передать энергию самому себе!";
			}
			else $ShowMessage = "Персонаж <u>$UserName</u> не найден!";
		}
	}







	######################
	if ($skl[skl]==3) {
		if (!empty($ShowMessage)) echo"<BR><CENTER><B><FONT COLOR=Red>$ShowMessage<br>$nms</FONT></B></CENTER>";
		if (!empty($msg)) echo"<BR><CENTER><B><FONT COLOR=Red>$msg<br>$nms</FONT></B></CENTER>";

		echo"

        <BR>

        Доступные возможности

        <CENTER>

        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH=98% border=0>
        <TR>
        <TD>

     <a href='javascript: {}' onclick=\"ShowForm('Лечение','?bite','Логин','UserName');\">Лечение</a> $bite_to/5<BR>
<a href='javascript: {}' onclick=\"ShowForm('Напасть на Рыцаря света','?attack','Логин','UserName');\">Помощь собрату</a> $attack_to/15<BR>
Ув. 
     
        </TD>
        </TR>
        </TABLE>

        </CENTER>

        


        <CENTER><BR><DIV id=form></div></CENTER>

";}



}
?>