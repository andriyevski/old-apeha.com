<?

$now=time();$time = time();
include("inc/db_connect.php");
$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($UserName)."'"));
$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));
$skl = mysql_fetch_array(mysql_query("SELECT `skl`,`id` FROM `players` WHERE `user` = '".$_COOKIE['user']."' AND `pass` = '".$_COOKIE['pass']."'"));
if ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room'] == 50) { header("Location: main.php"); exit; }
elseif ($stat['room'] == 51) { header("Location: main.php"); exit; }
elseif ($stat['room'] == 8) { header("Location: main.php"); exit; }
else {

	$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."' LIMIT 1"));
	mysql_query("SET CHARSET cp1251");
	if ($stat['battle']) { header("Location: battle.php"); exit; }
	if ($stat['skl']!=2) {  header("Location: main.php"); exit; }
	$stat=mysql_fetch_array(mysql_query("select * from `players` where id='$skl[id]'"));
	$bite_t=$stat['bite'];
	$attack_t=$stat['attack'];
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
<img src='i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"dark.php?tmp=\"+Math.random();\"\"'>
<img src='i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"main.php?tmp=\"+Math.random();\"\"'>
</td>
</tr>
</table>";


	$CurrentTime = date("H");
	$energy_max = $stat['vitality']*5+$stat['ustal'];
	$en=floor($energy_max/2);
	if (isset($CurrentTime)) {

		echo"<BR><CENTER><FONT STYLE='FONT-SIZE: 9 pt; COLOR: green'><B>Солнце зашло за горизонт... Луна светит во всей своей красе...<BR>Неожиданно простые на вид люди стали превращаться в вампиров и оборотней... Ты, друг мой, один из них.</CENTER>";





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
					elseif ($chl['skl'] == '2') $msg="Нельзя напасть на собрата!";
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



	if (isset($bite)) { if($bite_t>5) $msg = "У вас больше нет возможности выпить кровь сегодня!";
	else {
		if (empty($UserName) || $UserName == "Логин")
		$ShowMessage = "Укажите логин!";
		 
		$HisInfo = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE user='".addslashes($UserName)."'"));
		if (!empty($HisInfo['user'])) {
			if ($HisInfo['user'] != $stat['user']) {
				if ($stat['skl'] == 2) {
					if ($chl['level'] >= ($stat['level']-1) and $chl['level'] <= ($stat['level']+1) and $chl['level']!='0' and $chl['level']!='1') {
						if ($HisInfo['skl'] !=100) {
							if (!$HisInfo['battle']) {
								include("inc/main/get_inf.php");
								if ($user_lpv < 60) {
									if ($stat['hp_now'] != $stat['hp_max']) {
										if ($HisInfo['hp_now'] >= 15) {
											if ($stat[ustal_now] >= 0) {                                                   mysql_query("UPDATE players SET hp_now=hp_now + $en*8 WHERE user='".$stat['user']."'");

											mysql_query("UPDATE players SET hp_now=0 WHERE user='".$HisInfo['user']."'");

											mysql_query("UPDATE players SET bite=bite+1 WHERE user='".$stat['user']."'");


											require_once("inc/chat/functions.php");
											insert_msg("Вампир <u><b>".$stat['user']."</b></u> выпил вашу кровь!","","","1",$HisInfo['user'],"",$HisInfo['user']);
											$ShowMessage = "Вы выпили кровь у персонажа ".$UserName."!";
											}
											else $ShowMessage = "У вас недостаточно энергии чтобы укусить персонажа ".$UserName."...";
										}
										else $ShowMessage = "Персонаж ".$UserName." слишком ослаблен...";
									}
									else $ShowMessage = "Вы полны энергии и вам не требуется пить кровь...";
								}
								else $ShowMessage = "Персонаж ".$UserName." сейчас отсутствует!";
							}
							else $ShowMessage = "Вы не можете укусит, т.к. персонаж ".$UserName." в поединке!";
						}
						else $ShowMessage = "Склонность персонажа ".$UserName." не позволяет укусить его!";
					}
					else $ShowMessage = "Выберите персонажа вашего +-1 уровня!";
				}
					
				else $ShowMessage = "Вы не темный!";
				 
			}
			else $ShowMessage = "Вы не можете укусить самого себя!";
		}
		else $ShowMessage = "Персонаж <u>$UserName</u> не найден!";
	}
	}



	 
	########################



	if (!empty($ShowMessage)) echo"<BR><CENTER><B><FONT COLOR=Red>$ShowMessage</FONT></B></CENTER>";
	if (!empty($msg)) echo"<BR><CENTER><B><FONT COLOR=Red>$msg<br>$nms</FONT></B></CENTER>";

	echo"
        <BR>

        Доступные возможности

        <CENTER>

        <TABLE CELLSPACING=0 CELLPADDING=3 WIDTH=98% border=0>
        <TR>
        <TD>


 <a href='javascript: {}' onclick=\"ShowForm('Вампиризм','?bite','Логин','UserName');\">Укус вампира</a> $bite_to/5<BR>
<a href='javascript: {}' onclick=\"ShowForm('Напасть на Рыцаря света','?attack','Логин','UserName');\">Помощь собрату</a> $attack_to/15<BR>


        </TD>
        </TR>
        </TABLE>

        </CENTER>

        


        <CENTER><BR><DIV id=form></div></CENTER>

"; 



	 
}




?>