<? include("inc/db_connect.php");   
define('INSIDE', true);
$now=time();$time = time();



$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE user='".addslashes($user)."' AND pass='".addslashes($pass)."'"));
mysql_query("SET CHARSET cp1251");
if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]>time()) { header("Location: prison.php"); exit; }
//elseif ($stat['v_time']>time()) { header("Location: ambulance.php"); exit; }
//elseif ($stat['k_time']>time()) { header("Location: academy.php"); exit; }
elseif ($stat['w_time']>time()) { header("Location: works.php"); exit; }
elseif ($stat['o_time']>time()) { header("Location: repair.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
//elseif ($stat['room']<=300 && $stat['room']>=370) { header("Location: main.php"); exit; }
else{
	$idg=mysql_real_escape_string($_GET['id']);
$userg=mysql_real_escape_string($_GET['user']);
if ($_GET['group']=="exit"){
if ($_GET['ld']==$stat['user']){
mysql_query("DELETE FROM `groups` WHERE `id`='$idg'");
}else{
$qry=mysql_fetch_array(mysql_query("SELECT `users` FROM `groups` WHERE `id`='$idg'"));
$rpl=str_replace($userg,"",$qry['users']);
mysql_query("UPDATE`groups` SET `users`='$rpl'");
}
}

if ($_GET['group']=="deluser"){
if ($_GET['ld']==$stat['user']){
$queryg=mysql_fetch_array(mysql_query("SELECT `users` FROM `groups` WHERE `id`='$idg'"));
$rplc=str_replace($userg,"",$queryg['users']);
mysql_query("UPDATE `groups` SET `users`='$rplc'");
}
}

if ($_GET['group']=="ok"){
$prvrk=mysql_fetch_array(mysql_query("SELECT gogroup.id, groups.users FROM gogroup,groups WHERE groups.id=gogroup.id AND gogroup.user='$stat[user] [$stat[level]]'"));
if (!$prvrk['users']){
mysql_query("DELETE FROM `gogroup` WHERE `id`='$prvrk[id]'");
mysql_query("UPDATE `groups` SET `users`='$stat[user] [$stat[level]]' WHERE `id`='$prvrk[id]'");
}else{
mysql_query("DELETE FROM `gogroup` WHERE `id`='$prvrk[id]'");
mysql_query("UPDATE `groups` SET `users`='$prvrk[users],$stat[user] [$stat[level]]' WHERE `id`='$prvrk[id]'");
}
}

if ($_GET['group']=="cancel"){
$prvrk=mysql_fetch_array(mysql_query("SELECT gogroup.id, groups.users FROM gogroup,groups WHERE groups.id=gogroup.id AND gogroup.user='$stat[user] [$stat[level]]'"));
if ($prvrk['id']){
mysql_query("DELETE FROM `gogroup` WHERE `id`='$prvrk[id]'");
}
}

if ($_GET['group']=="go"){
$proverka=mysql_query("SELECT `level` FROM `players` WHERE `user`='$login'");
if (@mysql_num_rows($proverka)==0){
$msg="Такого игрока не существует!";
}else{
$p=mysql_fetch_array($proverka);
if ($_GET['ld']==$stat['user']){
mysql_query("INSERT INTO `gogroup` (`id`,`user`) values ('$idg','$login [$p[level]]')");
$msg="Игроку отправлено приглашение!";
}else{
mysql_query("INSERT INTO `groups` (`users`,`leader`) values ('','$stat[user] [$stat[level]]')");
$idg=mysql_fetch_array(mysql_query("SELECT `id` FROM `groups` WHERE `leader`='$stat[user] [$stat[level]]'"));
mysql_query("INSERT INTO `gogroup` (`id`,`user`) values ('$idg[id]','$login [$p[level]]')");
$msg="Игроку отправлено приглашение!";
}
}
}
	
if($stat['r_time']<$now) {

	$bots_num=mysql_query("select * from players where room='".$stat['room']."' and rank='60'");

	while($bots=mysql_fetch_array($bots_num)){

		$chance=20;$i=0;
		$side1_hp=mysql_fetch_array(mysql_query("select sum(hp) as hp from participants where time='".$bots['battle']."' and side='1'"));
		$side2_hp=mysql_fetch_array(mysql_query("select sum(hp) as hp from participants where time='".$bots['battle']."' and side='2'"));
		$last_comment_time=mysql_fetch_array(mysql_query("select time from battles where offer='".$bots['battle']."'"));
		if(empty($side1_hp['hp']) or empty($side2_hp['hp']) or ($last_comment_time['time']-$bots['battle'])>=180){$boy_end=1;}

		if(rand(1, 100)<=$chance && $boy_end=='1'){
			$stat = mysql_fetch_array(mysql_query("SELECT * FROM `players` WHERE id='".$stat['id']."'"));
			$i++;

			$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$bots['id']."' AND objects.user='".$bots['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
			$MySkills = explode("|",$bots['rase_skill']);
			$chl['gnom']=$MySkills['3']*5;
			$bots['vitality']=$bots['vitality']+$_obj['vitality'];
			$bots['hp_max']=ceil(($bots['vitality']*5)*(1+($bots['gnom']/100))+$_obj['hp']);
			$bots['hp_now']=$bots['hp_max'];

			mysql_query("update players set hp_now='".$bots['hp_max']."', `battle` = NULL where id='".$bots['id']."'");

			if($i>1 or !empty($stat['battle']) && $stat['r_time']<$now){
				//vmesh
				if ($bots[next_exp]!=0)
				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$bots['level']."' AND exp<=$bots[next_exp] ORDER BY exp DESC"));
				else
				$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$bots['level']."'AND exp<=$bots[exp] ORDER BY exp DESC"));
				$prt=mysql_fetch_array(mysql_query("SELECT side AS side, x, y, time AS time FROM participants WHERE time='".$stat['battle']."' AND id='".$stat['id']."'"));

				switch ($prt['side']) {
					case 0: $side=1; break;
					case 1: $side=0; break;
				}
				$query=mysql_query("select x, y from participants where time='".$prt['time']."' and side='$side' order by `y` desc limit 1");
				$randes=mysql_fetch_array($query);

				$y=$randes['y']+1;



				mysql_query("UPDATE players, offers SET players.battle='".$prt['time']."', players.bside='".$side."', offers.type='2', offers.timeout='180', offers.zone_height=offers.zone_height+1 WHERE players.id='".$stat['id']."' && offers.time='".$prt['time']."'");
				mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`,x,y, frozen) values('".$prt['time']."', '".$bots['id']."', '".$side."', '".$levels['base']."', '".$bots['hp_now']."','1', '$y', '0')");

				$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM battles WHERE offer='".$prt['time']."'"));
				$b_id_id['id']+=1;

				mysql_query("INSERT INTO battles (offer, time, id, type, comment1) values ('".$prt['time']."', '".$now."', '".($b_id_id['id']-1)."', '2', '<b>".$bots['user']."</b> [".$bots['level']."] вмешался в поединок!')");
				$bat=1;
			}
			else{//napadaem
				//$time=time();
				if ($stat[next_exp]!=0)
				$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=".$bots['level']." AND exp<=$stat[next_exp] ORDER BY exp DESC"));
				else
				$chl_base=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level='".$bots['level']."'AND exp<=$stat[exp] ORDER BY exp DESC"));
				$bdate=date("d.m.y H:i",$time);


				while (mysql_fetch_array(mysql_query("SELECT * FROM offers WHERE time='".$time."'")))
				$time++;
				$prt2=mysql_num_rows(mysql_query("select id FROM participants WHERE time='".$stat['battle']."'"));
				mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout, zone_width, zone_height, city) values(".$time.",1,1,'1','1','180', 6, '".($prt2/2+3)."', 1)");


				mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, x, y, frozen) VALUES ('".$time."','".$bots['id']."','0','".$levels['base']."','".$bots['hp_now']."' ,'".($prt['x']+1)."', '".($prt['y']+1)."', '0')");

				mysql_query("INSERT INTO participants (`time`,`id`,`side`,`base`,`hp`, x, y, frozen) VALUES ('".$time."','".$stat['id']."','1','".$chl_base['base']."','".$stat['hp_now']."','".($prt['x']+4)."', '".($prt['y']+1)."', '0')");

				
				mysql_query("INSERT INTO battles (offer, time, id, type, damage, comment1) values (".$time.", ".$time.", '1', 2, '', '<i>Часы показывали <u>".$bdate."</u> когда бой начался!')");

				mysql_query("UPDATE players SET battle='".$time."', bside='0' WHERE id='".$bots['id']."'");
				mysql_query("UPDATE players SET battle='".$time."', bside='1' WHERE id='".$stat['id']."'");


				require_once("inc/chat/functions.php");
				insert_msg("Разъярённый <b><u>".$bots['user']."</u></b> собрался с силами и напал на Вас!","","","1",$stat['user'],"",$stat['room']);


				$bat=1;
			}

		}

	}
}
	if(!empty($bat)){echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";}
	$bat=0;
	mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");
	include("inc/main/changed.php");


	$VaultInfo = mysql_fetch_array(mysql_query("SELECT * FROM `vault` WHERE id='".$stat['room']."'"));

	//include("inc/1vault_povelitel.php");
	if ($Heal) {
		if ($stat['vault_move'] == 1) $msg = "Вы не можете лечиться во время перемещения!";
		elseif ($stat['r_action'] == 1) $msg = "Вы не можете лечиться во время добычи руды!";
		elseif ($stat['room'] == 300) $msg = "Здесь колодец пустой!";
		else {
			if ($VaultInfo['heal'] >= time()) $msg = "Кто-то оказался быстрее и выпил всю энергию из Колодца Жизни!";
			else {
				if ($stat['hp_now'] < $stat['hp_max']) {
					$VaultInfo['heal'] = $now + 180;
					mysql_query("UPDATE `vault` SET heal='".$VaultInfo['heal']."' WHERE id='".$VaultInfo['id']."'");
					mysql_query("UPDATE `players` SET hp_now='".$stat['hp_max']."' WHERE user='".$stat['user']."'");
					$stat['hp_now'] = $stat['hp_max'];
					$msg = "Ваш уровень жизни полностью восстановлен!";
				} else $msg = "Вы не нуждаетесь в лечении!";
			}
		}
	}

	if ($work) {
		$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|4' AND objects.id IN (slots.3)");
		if (mysql_num_rows ($instr)) {
			$instrument = mysql_fetch_array($instr);



			if ($stat[ustal_now]>=15) { // не устал
				if ($stat['vault_move'] == 0) {
					if ($stat['r_action'] == 0) {
						$izn_instr = mysql_fetch_array(mysql_query("SELECT objects.*, slots.3 FROM objects, slots WHERE objects.min='1|0|0|0|0|0|0|4' AND objects.tip=15 AND objects.user='".$stat['user']."' AND objects.id IN (slots.3)"));
						$instr_inf=explode("|",$izn_instr['inf']);
						$iznos=($instr_inf[6]+1);
						if ($instr_inf[7] > $iznos ) {
							mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
						}
						else
						{
							mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
							mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
						}
						$dtime = 900*(1-($stat['res']/100));
						mysql_query("UPDATE players set r_time=$now+$dtime, r_action=1, ustal_now=ustal_now-15 where id=$stat[id]");
							
						echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"podzem.php\";</SCRIPT>";
					} else $msg = "Вы добываете руду!";
				} else $msg = "Вы добываете руду!";
			} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
		} else $msg="Без кирки добывать руду нельзя!";
	}

	if ($stat['r_action'] == 1) {

		if ($stat['r_time']-2 < $now) {

			mysql_query("UPDATE `players` SET r_time=0, r_action=0 WHERE user='".$stat['user']."'");

			$stat['r_time'] = 0;
			$stat['r_action'] = 0;
			$res=rand(0,9);
			if ($stat['proff'] == 5){
				$resurs=array();
				$resurs[0]="alexandrit|Александрит";		// Типы камней которые может добывать шахтёр.
				$resurs[1]="almaz|Алмаз";			// Поменять на более крутые камешки
				$resurs[2]="amazonit|Амазонит";			// Пока менять влом
				$resurs[3]="biruza|Бирюза";
				$resurs[4]="pirit|Пирит";
				$resurs[5]="opal|Опал";
				$resurs[6]="rubin|Рубин";
				$resurs[7]="sapfir|Сапфир";
				$res_type=$resurs[rand(0,7)];
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`time`, `about`) VALUES ('".$stat['user']."','".$res_type."|10.00|0|0|0|0|1','0|0|0|0|0|0|0|0','16','".time()."', 'Неограненный камень')");
				require_once("inc/chat/functions.php");
				insert_msg("Поздравляем! Вы добыли драгоценный камень в кол-ве <b><u>1 ед</u></b>!","","","1",$stat['user'],"",$stat['room']);
			}
			else{
				if ($res == 5) {
					$resurs=array();
					$resurs[0]="alexandrit|Александрит";
					$resurs[1]="almaz|Алмаз";
					$resurs[2]="amazonit|Амазонит";
					$resurs[3]="biruza|Бирюза";
					$resurs[4]="pirit|Пирит";
					$resurs[5]="opal|Опал";
					$resurs[6]="rubin|Рубин";
					$resurs[7]="sapfir|Сапфир";
					$res_type=$resurs[rand(0,7)];
					mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`time`, `about`) VALUES ('".$stat['user']."','".$res_type."|10.00|0|0|0|0|1','0|0|0|0|0|0|0|0','16','".time()."', 'Неограненный камень')");
					require_once("inc/chat/functions.php");
					insert_msg("Поздравляем! Вы добыли драгоценный камень в кол-ве <b><u>1 ед</u></b>!","","","1",$stat['user'],"",$stat['room']);
				}
				else {
					mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`time`, `about`) VALUES ('".$stat['user']."','ruda|Руда|8.00|0|0|0|0|1','0|0|0|0|0|0|0|0','16','".time()."', 'Руда')");
					require_once("inc/chat/functions.php");
					insert_msg("Вы добыли руду в кол-ве <b><u>1 ед</u></b>!","","","1",$stat['user'],"",$stat['room']);
				}}
				 

		}
	}

	if ($Attack) {
		if ($stat['vault_move'] == 1) $msg = "Вы не можете напасть во время перемещения!";
		elseif ($stat['r_action'] == 1) $msg = "Вы не можете напасть во время добычи руды!";
		else {
			if (empty($login)) $msg = "Укажите логин!";
			else {
				$chl=mysql_fetch_array(mysql_query("SELECT * FROM players where user='".addslashes($login)."'"));

				if ($chl['user'] == $stat['user']) $msg="Нападение на самого себя - это уже мазохизм...";
				elseif ($chl['room'] == 300) $msg="Здесь не место для битв!";
				elseif ($chl['immun'] > $now) $nms="На персонаже уже стоит защита от нападения!";
				elseif ($chl['r_action'] == 1) $msg="Он занят!";
				elseif ($ctime-$chl['lpv'] > 180 && $chl['rank'] != 60) $nms="Персонаж <u>$login</u> отстутствует!";
				elseif ($chl['room'] < 300 || $chl['room'] > 230) $nms="Для нападния Вам необходимо находится в одной комнате!";
				elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33)) $msg="Вы слишком ослаблены для боя!";
				elseif ($chl['hp_now'] <= 5  && $chl['rank']<>60) $msg="Персонаж <u>$login</u> слишком слаб для поединка!";
				elseif (((time()-$chl['lpv'])<10) && ($chl['battle'] == $chl['last_battle'] || !$chl['battle']) && $chl['rank']==60) $msg="Бот <u>".$chl['user']."</u> еще не восстановил свой уровень жизни!";

				else {

					require_once("inc/chat/functions.php");
					insert_msg("Разъярённый <b><u>$stat[user]</u></b> собрался с силами и напал на Вас!","","","1",$chl['user'],"",$chl['room']);

					$battime="$now";

					if ($chl['rank']==60 && ($chl['battle'] == $chl['last_battle'] || !$chl['battle'])) {

						$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));
						$chl['vitality']+=$_obj['vitality'];
						$chl['hp_max']=$chl['vitality']*5+$_obj['hp'];
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

						$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level]"));

						mysql_query("INSERT INTO participants (`time`, `id`, `side`, `base`,`hp`) values('$prt[time]', '$stat[id]', '$side', '$levels[base]', $stat[hp_now])");

						$b_id_id=mysql_fetch_array(mysql_query("SELECT MAX(id) as id from battles where offer=$prt[time]"));
						$b_id_id['id']+=1;

						mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($prt[time], '$battime', '$b_id_id[id]', '', '', '', '', NULL, '', '<script language=JavaScript>show_inf(\"$stat[user]\",\"$stat[id]\",\"$stat[level]\",\"$stat[rank]\",\"$stat[tribe]\");</script> вмешался в поединок!')");
						$b_id=$prt[time];


						mysql_query("UPDATE players, offers SET players.battle=".$prt['time'].", players.side=".$side.", offers.type=2 where players.id=$stat[id] && offers.time=$prt[time]");

					} else {

						$bdate=date("d.m.y H:i",$battime);

						mysql_query("INSERT INTO offers (time, type, size_left, size_right, done, timeout, status) values($battime+600,1,1,'1','1','180',1)");

						$levels_my = mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level]"));
						$levels_opp = mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$chl[level]"));

						mysql_query("INSERT INTO participants (time, id, side, hp, base) values($battime+600, '$stat[id]', '0', '".$stat['hp_now']."', '".$levels_my['base']."')");
						mysql_query("INSERT INTO participants (time, id, side, hp, base) values($battime+600, '$chl[id]', '1', '".$chl['hp_now']."', '".$levels_opp['base']."')");

						mysql_query("insert into battles (offer, time, id, attacker, defender, kick, block, type, damage, comment) values ($battime, $battime, '0', '', '', '', '', NULL, '', '<i>Часы показывали <u>$bdate</u> когда бой между </i><font color=CFA87A><b>$stat[user]</b></font> и <font color=679958><b>$chl[user]</b></font> <i>начался!</i>')");

						mysql_query("update players set battle=$battime+600, side=0 where id='$stat[id]'");
						mysql_query("update players set battle=$battime+600, side=1 where id='$chl[id]'");
						$b_id=$battime;

					}

					echo"<script>parent.main.location=\"battle.php?tmp=\"+Math.random();\"\"</script>";

				}
			}
		}
	}



	if (isset($take2)) {
		if ($stat2['podzem1'] != 0) $msg="Вы уже подобрали руну, в склепе ничего нет!";
		elseif ($stat2[room]<300 || $stat2[room]>318) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вешь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET podzem1=1 WHERE user='".$stat2['user']."'");
			$stat2['podzem1'] = 1;

			$ItTake = "podzem_runa";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Руну\"</u>";

		}
	}


	if (isset($take4)) {
		if ($stat2['kwest0']!=1) $msg="Вы уже подобрали Подземный пояс или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 317) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=2 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 2;

			$ItTake = "kwest0";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Подземный пояс\"</u>";

		}
	}

	if (isset($take5)) {
		if ($stat2['kwest0']!=4) $msg="Вы уже обыскали сундук или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 310) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете обыскать сундук во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=5 WHERE user='".$stat2['user']."'");
			mysql_query("UPDATE players SET credits=credits+50 WHERE user='".$stat2['user']."'");



			$msg="Вы обыскали <u>\"сундук\"</u> и нашли там <u>\"50 зм\"</u>";

		}
	}

	if (isset($take6)) {
		if ($stat2['kwest0'] != 7) $msg="Вы уже подобрали Рубин или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 305) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=8 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 8;

			$ItTake = "kwest0_rubin";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Рубин\"</u>";

		}
	}

	if (isset($take7)) {
		if ($stat2['kwest0']!=8) $msg="Вы уже подобрали Йод или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 311) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=9 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 9;

			$ItTake = "kwest0_iod";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Йод\"</u>";

		}
	}

	if (isset($take8)) {
		if ($stat2['kwest0']!=9) $msg="Вы уже подобрали Змеиный Плод или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] !=316) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=10 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 10;

			$ItTake = "kwest0_zmei_plod";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));


			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Змеиный Плод\"</u>";

		}
	}

	if (isset($take9)) {
		if ($stat['kwest0']!=12) $msg="Вы уже подобрали Солнечный камень или не получили квест в Квестовом Домике!";
		elseif ($stat[room] != 306) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=13 WHERE user='".$stat['user']."'");
			$stat2['kwest0'] = 13;

			$ItTake = "sun_kamen";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));


			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Солнечный камень\"</u>";

		}
	}

	if (isset($take10)) {
		if ($stat2['kwest0']!=13) $msg="Вы уже подобрали Рукоядь или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 308) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=14 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 14;

			$ItTake = "rukoad";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Рукоядь\"</u>";

		}
	}

	if (isset($take11)) {
		if ($stat2['kwest0']!=14) $msg="Вы уже подобрали Лезвие или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 315) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=15 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 15;

			$ItTake = "lezvie";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));

			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подобрали <u>\"Лезвие\"</u>";

		}
	}

	if (isset($take12)) {
		if ($stat['kwest0'] != 23) $msg="Ошибка, не пытайтесь взломать игру :)!";
		elseif ($stat2[room] != 313) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять котёнка во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=24 WHERE user='".$stat['user']."'");
			$stat2['kwest0'] = 24;
			$ItTake = "kitten";
			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));
			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";
			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
			$msg="Вы подняли котёнка, и положили его в мешок...";
		}
	}
	// Переход
	if ($GoIn && ($GoIn == "top" || $GoIn == "bottom" || $GoIn == "left" || $GoIn == "right")) {

		if ($stat['vault_move'] == 1) $msg = "Вы уже перемещаетесь!";
		elseif ($stat['r_action'] == 1) $msg = "Вы добываете руду!";
		else {

			$GoInfo = mysql_fetch_array(mysql_query("SELECT * FROM `vault` WHERE id='".$VaultInfo[$GoIn.'_id']."'"));

			if ($GoInfo['id']) {

				$stat['vault_time'] = $now + $GoInfo['time'];
				$stat['vault_room'] = $GoInfo['id'];
				$stat['vaul_move'] = 1;

				mysql_query("UPDATE `players` SET vault_room='".$GoInfo['id']."', vault_time='".$stat['vault_time']."', vault_move=1 WHERE user='".$stat['user']."'");

				$GoToText = "Топаем в <b><u>".$GoInfo['title']."</u></b>";
			}
		}
	}

	if ($stat['vault_move'] == 1) {

		if ($stat['vault_time']-2 < $now) {

			mysql_query("UPDATE `players` SET room=vault_room, vault_room=vault_room, vault_time=0, vault_move=0 WHERE user='".$stat['user']."'");

			$_ROOM['TO_CHANGE'] = $stat['vault_room'];
			include("inc/rooms.php");

			$stat['vault_time'] = 0;
			$stat['vault_room'] = vault_room;
			$stat['vaul_move'] = 0;

			echo"
                <SCRIPT LANGUAGE=\"JavaScript\">
                <!--
                top.frames['main'].location = \"podzem.php\";
                
                //-->
                </SCRIPT>
                ";
			exit;
		}
	}



	//$VaultRoom['300'] = "Врата Подземелья";
	$VaultRoom['201'] = "Большой Коридор";
	$VaultRoom['202'] = "Зал Странствий";
	$VaultRoom['203'] = "Зал Призраков";
	$VaultRoom['204'] = "Зал Бездны";
	$VaultRoom['205'] = "Тупиковый Тоннель";
	$VaultRoom['206'] = "Зал Хаоса";
	$VaultRoom['207'] = "Зал Призраков №2";
	$VaultRoom['208'] = "Оружейный Зал";
	$VaultRoom['209'] = "Зал Мучений";
	$VaultRoom['210'] = "Зал Сумрака";
	$VaultRoom['211'] = "Зал Добычи";


	$VaultRoom['300'] = "Склеп";
	$VaultRoom['301'] = "Коридор";
	$VaultRoom['302'] = "Кладбище героев";
	$VaultRoom['303'] = "Ущелье";
	$VaultRoom['305'] = "Алтарь";
	$VaultRoom['306'] = "Усыпальница королей";
	$VaultRoom['307'] = "Подземная река";
	$VaultRoom['308'] = "Оранжерея";
	$VaultRoom['309'] = "Казармы";
	$VaultRoom['310'] = "Псарня";
	$VaultRoom['311'] = "Старая арена";
	$VaultRoom['312'] = "Свалка";
	$VaultRoom['313'] = "Кладбище Домашних Животных";
	$VaultRoom['314'] = "Тюрьма";
	$VaultRoom['315'] = "Дерево Жизни";
	$VaultRoom['316'] = "Зал коронации";
	$VaultRoom['317'] = "Зыбучие пески";
	$VaultRoom['318'] = "Телепорт";
	$VaultRoom['319'] = "Сектор 19";
	$VaultRoom['320'] = "Сектор 20";
	$VaultRoom['321'] = "Сектор 21";
	$VaultRoom['322'] = "Сектор 22";
	$VaultRoom['323'] = "Сектор 23";
	$VaultRoom['324'] = "Сектор 24";
	$VaultRoom['325'] = "Сектор 25";
	$VaultRoom['326'] = "Сектор 26";
	$VaultRoom['327'] = "Сектор 27";
	$VaultRoom['328'] = "Сектор 28";
	$VaultRoom['329'] = "Сектор 29";
	$VaultRoom['330'] = "Сектор 30";
	$VaultRoom['331'] = "Сектор 31";
	$VaultRoom['332'] = "Сектор 32";
	$VaultRoom['333'] = "Сектор 33";
	$VaultRoom['334'] = "Сектор 34";
	$VaultRoom['335'] = "Сектор 35";
	$VaultRoom['336'] = "Сектор 36";
	$VaultRoom['337'] = "Сектор 37";
	$VaultRoom['338'] = "Сектор 38";
	$VaultRoom['339'] = "Сектор 39";
	$VaultRoom['340'] = "Сектор 40";
	$VaultRoom['341'] = "Сектор 41";
	$VaultRoom['342'] = "Сектор 42";
	$VaultRoom['343'] = "Сектор 43";
	$VaultRoom['344'] = "Сектор 44";
	$VaultRoom['345'] = "Сектор 45";
	$VaultRoom['346'] = "Сектор 46";
	$VaultRoom['347'] = "Сектор 47";
	$VaultRoom['348'] = "Сектор 48";
	$VaultRoom['349'] = "Сектор 49";
	$VaultRoom['350'] = "Сектор 50";
	$VaultRoom['351'] = "Сектор 51";
	$VaultRoom['352'] = "Сектор 52";
	$VaultRoom['353'] = "Сектор 53";
	$VaultRoom['354'] = "Сектор 54";
	$VaultRoom['355'] = "Сектор 55";
	$VaultRoom['356'] = "Сектор 56";
	$VaultRoom['357'] = "Сектор 57";
	$VaultRoom['358'] = "Сектор 58";
	$VaultRoom['359'] = "Сектор 59";
	$VaultRoom['360'] = "Сектор 60";
	$VaultRoom['361'] = "Сектор 61";
	$VaultRoom['362'] = "Сектор 62";
	$VaultRoom['363'] = "Сектор 63";
	$VaultRoom['364'] = "Сектор 64";
	$VaultRoom['365'] = "Сектор 65";
	$VaultRoom['366'] = "Сектор 66";
	$VaultRoom['367'] = "Сектор 67";
	$VaultRoom['368'] = "Сектор 68";
	$VaultRoom['369'] = "Сектор 69";
	$VaultRoom['370'] = "Сектор 70";

	$widthhp=$stat['hp_now']/$stat['hp_max']*181;
	if ($widthhp==0) $widthhp+=2;
	if ($widthhp==1) $widthhp+=1;
	if ($widthhp>1) $widthhp-=1;


	include("inc/html_header.php");

	echo"<body background='/i/bg.gif' leftmargin=0 topmargin=0>
<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
	echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<TD width=1>&nbsp;</TD>
<td width=600 valign=top>


<TABLE cellspacing=0 cellpadding=0 background='/i/bg2.gif'>
<tr>

<TD valign=top>
<SCRIPT language=JavaScript>
var imgpath = '".$stat[img_path]."';
show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</SCRIPT>
</TD>

<TD WIDTH=10>&nbsp;</TD>

<TD valign=top>
<table  cellspacing=0 cellpadding=0 border=0 align=center height=12>
<tr>
<td width=200 title='Уровень жизни: $stat[hp_now]/$stat[hp_max]' align=left valign=bottom width=200><img src=$stat[img_path]/i/vault/navigation/hp/_helth.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=$stat[img_path]/i/vault/navigation/hp/helth.gif height='10' width='$widthhp' border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=$stat[img_path]/i/vault/navigation/hp/_helth_.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'></td>
</tr>
</table>
</TD>

<TD WIDTH=5>&nbsp;</TD>

<TD valign=top><FONT COLOR=RED><B>$stat[hp_now] / $stat[hp_max]</B></FONT></TD>

</TR>
</TABLE>

</td>

<td align=right valign=top>
<img src='$stat[img_path]/i/refresh.gif' style='CURSOR: Hand' alt='Обновить' onclick='window.location.href=\"podzem.php?tmp=\"+Math.random();\"\"'>";

	if ($stat['room'] == '300') echo"<img src='$stat[img_path]/i/back.gif' style='CURSOR: Hand' alt='Вернуться' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>";

	echo"</td>
</tr>
</table>";






	echo"
<table width=100% cellspacing=0 cellpadding=3 border=0 >
<tr>
<td align=right>
<center><font class=title>".$VaultInfo['title']."</font></center><br>";



	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center><br>";


	echo"

<fieldset style='WIDTH: 98.6%'><legend>Территория подземелья</legend>
<table width=100% cellspacing=0 cellpadding=5 >
<tr>
<td align=center>



<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td width=170 align=left valign=top>





<!-- Навигация -->

<table background='/i/bg2.gif' cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center>

<b>Навигация</b><HR color=silver>

<table cellspacing=0 cellpadding=0 border=0 bgcolor='#eeeeee'>

<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='$stat[img_path]/i/vault/navigation/";
	if ($VaultInfo['bottom_id']) echo"active/top.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=bottom&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['bottom_id']]."' style='CURSOR: Hand'"; else echo"n_active/top.gif' alt='Нет прохода'";
	echo"></td><td width=45>&nbsp;</td>
</tr>

<tr height=45>
<td width=45 align=center valign=center><IMG SRC='$stat[img_path]/i/vault/navigation/";
	if ($VaultInfo['left_id']) echo"active/left.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=left&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['left_id']]."' style='CURSOR: Hand'"; else echo"n_active/left.gif' alt='Нет прохода'";
	echo"></td><td width=45 align=center valign=center><IMG SRC='$stat[img_path]/i/vault/navigation/center.gif'></td><td width=45 align=center valign=center><IMG SRC='$stat[img_path]/i/vault/navigation/";
	if ($VaultInfo['right_id']) echo"active/right.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=right&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['right_id']]."' style='CURSOR: Hand'"; else echo"n_active/right.gif' alt='Нет прохода'";
	echo"></td>
</tr>

<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='$stat[img_path]/i/vault/navigation/";
	if ($VaultInfo['top_id']) echo"active/bottom.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=top&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['top_id']]."' style='CURSOR: Hand'"; else echo"n_active/bottom.gif' alt='Нет прохода'";
	echo"></td><td width=45>&nbsp;</td>
</tr>

</table>";

	if ($stat['vault_time'] > $now) {

		echo"<HR color=silver>Топаем в <b><u>".$VaultRoom[$stat[vault_room]]."</u></b><HR color=silver><tABLE cellspacing=0 cellpadding=0><tr><td>Ещё:&nbsp;</td><td><b><small><div id=move></div></small></b><script>ShowTime('move',",$stat['vault_time']-$now+rand(1,3),",1);</script></td></tr></table>";
	}

	if ($stat['r_time'] > $now) {

		echo"<HR color=silver>Добываем руду<HR color=silver><tABLE cellspacing=0 cellpadding=0><tr><td>Ещё:&nbsp;</td><td><b><small><div id=know></div></small></b><script>ShowTime('know',",$stat['r_time']-$now,",1);</script></td></tr></table>";
	}
$group=mysql_query("SELECT * FROM `groups` WHERE `leader`='".$stat['user']." [".$stat['level']."]' OR `users` LIKE '%".$stat['user']." [".$stat['level']."]%'");
$group2=mysql_fetch_array($group);  
	echo"
</td>
</tr>
<tr>
<td>
<b><center>Группа</center></b><hr>";
$countgroups=mysql_num_rows($group);
if ($countgroups<1){
$query = "SELECT groups.leader,gogroup.id FROM groups,gogroup WHERE groups.id=gogroup.id AND gogroup.user='$stat[user] [$stat[level]]'";
$prvrk=mysql_fetch_array(mysql_query($query));
if ($prvrk['leader']!=''){
echo"
Вас пригласил к себе в группу <b>$prvrk[leader]</b>.
<input type=button class=input value='Вступить' style='WIDTH: 120px' onclick=\"location.href='?group=ok'\">
<input type=button class=input value='Отмена' style='WIDTH: 120px' onclick=\"location.href='?group=cancel'\">
";
}else{
echo"<center>Вы не состоите в группе
<input type=button class=input value='Пригласить' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Пригласить в группу','podzem.php?group=go&ld=$leader[0]&id=$group2[id]','','','1','attack','1','0');\">
</center>";
}
}else{
$leader=explode(" ",$group2['leader']);
echo"<center>
<b><img src=\"i/align100____.gif\" alt=\"Лидер Группы\">&nbsp;&nbsp;<a href=\"#\" onclick=\"top.to('$leader[0]')\">$group2[leader]</a>&nbsp;<a target=_blank href=\"inf.php?login=$leader[0]\"><img alt=\"Информация о персонаже\" src=\"i/inf.gif\"></a></b><br>";
$groupusers=explode(",",$group2['users']);
$countusers=substr_count($group2['users'], ",");
if (!$group2['users']){
echo"В вашей группе нет ни одного участника!";
}else{
while ($i++<$countusers+1){
$a=$i-1;
$groupe=explode(" ",$groupusers[$a]);
if ($leader[0]==$stat['user']){
echo"
<b><a href=\"#\" onclick=\"
if(confirm('Вы точно хотите исключить игрока из группы?')){
location.href='?group=deluser&id=$group2[id]&ld=$leader[0]&user=";if ($a!==0){echo",";}echo"$groupusers[$a]";if ($a==$countusers){}else{echo",";}echo"'
}else{}
\"><img src=\"i/drop.gif\"></a>&nbsp;";}echo"<a href=\"#\" onclick=\"top.to('$groupe[0]')\">$groupusers[$a]</a>&nbsp;<a target=_blank href=\"inf.php?login=$groupe[0]\"><img alt=\"Информация о персонаже\" src=\"i/inf.gif\"></a></b><br>
";
}
}
echo"
<input type=\"button\" class=\"input\" style=\"WIDTH: 120px\" value=\"Покинуть группу\" onclick=\"
if (confirm('"; if ($leader[0]==$stat['user']){$lead=$stat['user']; echo"Если вы сейчас покинете группу то она будет расформирована. Вы уверены?";}else{$lead=$leader[0]; echo"Вы точно уверены что хотите покинуть группу?";}
echo"')){
location.href='?group=exit&id=$group2[id]&ld=$lead&user=";if ($a!==0){echo",";}echo"$stat[user] [$stat[level]]'";if ($a==$countusers){}else{echo",";}echo"
}else{}
\">
"; 
if ($leader[0]==$stat['user']){
echo"
<input type=button class=input value='Пригласить' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Пригласить в группу','podzem.php?group=go&ld=$leader[0]&id=$group2[id]','','','1','attack','1','0');\">
";
}
echo"
</center>
";}

echo"
</td>
</tr>  

</table>

<!-- Конец навигации -->




</td>
<td align=center valign=top>
".$VaultInfo['text'].'<br>';
if(!empty($VaultInfo['bottom_id'])&& empty($VaultInfo['left_id'])&& empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault1.jpg\'>';
}
elseif(!empty($VaultInfo['bottom_id'])&& !empty($VaultInfo['left_id'])&& empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault2.jpg\'>';
}
elseif(!empty($VaultInfo['bottom_id'])&& empty($VaultInfo['left_id'])&& !empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault3.jpg\'>';
}
elseif(empty($VaultInfo['bottom_id'])&& !empty($VaultInfo['left_id'])&& !empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault6.jpg\'>';
}
elseif(!empty($VaultInfo['bottom_id'])&& !empty($VaultInfo['left_id'])&& !empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault5.jpg\'>';
}
elseif(empty($VaultInfo['bottom_id'])&& empty($VaultInfo['left_id'])&& !empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault7.jpg\'>';
}
elseif(empty($VaultInfo['bottom_id'])&& !empty($VaultInfo['left_id'])&& empty($VaultInfo['right_id'])){
echo '<img src=\'/i/vault/vault8.jpg\'>';
}
else{echo '<img src=\'/i/vault/vault4.jpg\'>';}
	$YES = 1;
	if ($YES) {
		echo"<HR color=silver>

        <TABLE cellspacing=0 cellpadding=0 border=0 width=100%>
        <TR>
        <TD align=left>
	<b><i>В комнате разбросаны предметы:</i></b><BR>";

		$d_ss ++;
		$drop = $stat[room];
		$user_d = $stat["user"];
			
		$D_P = mysql_query("SELECT * FROM `drop_i` WHERE `p_drop` = $drop ");
		while ($D_PS = mysql_fetch_array($D_P)){
			$name = $D_PS["name"];
			$chance = $D_PS[chance];

			$ch = rand(1,$chance);
			$text = "$ch";
			if ($ch == 1) {
				require_once("inc/chat/functions.php");
				insert_msg("В пещере вы нашли <b><i>$name</b></i>.","","","1",$stat['user'],"",$stat['room']);
				 
				$buyitem_res = mysql_query("SELECT * FROM `items` WHERE `title` = '$name' ");

				if (mysql_num_rows($buyitem_res)) {
					$aaa = 1;
					$buyitem = mysql_fetch_array($buyitem_res);
					echo"<img src='$stat[img_path]/i/items/$buyitem[name].gif'>";
					$inf = "".$buyitem['name']."|".$buyitem['title']."|".$buyitem['price']."|0|".$secondary."|".$buyitem['art']."|0|".$buyitem['iznos']."";

					$min = "".$buyitem['min_level']."|".$buyitem['min_str']."|".$buyitem['min_dex']."|".$buyitem['min_ag']."|".$buyitem['min_vit']."|".$buyitem['min_razum']."|".$buyitem['min_rase']."|".$buyitem['min_proff']."";

					$result2 = mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
				}
			}}




			echo"</TD>
        </TR>
        </TABLE>

        ";
	}

	echo"</td>
<td width=170 align=right valign=top>";

	if ($stat[room]>300 && $stat[room]<=215){
		$nap = rand(0,5);}
		elseif ($stat[room]>300){
			$nap = rand(0,3);
		}else{$nap=1;}
		if ($nap==0){
			$bot = mysql_query("SELECT `user` FROM `players` WHERE `room`='$stat[room]' AND `rank`=60 ");
			if (mysql_num_rows($bot) == 1){
				$boi = mysql_fetch_array($bot);

				echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames[\"main\"].location = \"podzem.php?Attack=$now&login=$boi[user]&tmp=\"+Math.random();</SCRIPT>";
			}}

			echo"<!-- Возможности -->

<table background='/i/bg2.gif' cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center >

<b>Действия</b><HR color=silver>

<input type=button class=input value='Нападение' style='WIDTH: 120px' onclick=\"javascript:ShowForm('Нападение','podzem.php?Attack=$now','','','1','attack','1','0');\"><HR color=silver>

<input type=button class=input value='Добыча руды' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?work=\"+Math.random();\"\"'><HR color=silver>

<input type=button class=input value='Колодец Жизни' style='WIDTH: 120px'";
			if ($podzemInfo['heal'] >= $now) echo" disabled><HR color=silver>"; else echo" onclick='top.frames[\"main\"].location = \"podzem.php?Heal=\"+Math.random();'><HR color=silver>";


			if ($stat['room'] == 305 && $stat['kwest0'] == 7) echo"
<input type=button class=input value='Рубин' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take6=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 302 && $stat['podzem1'] == 0) echo"
<input type=button class=input value='Камень' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take2=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 308 && $stat['kwest0'] == 13) echo"
<input type=button class=input value='Рукоядь' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take10=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 310 && $stat['kwest0'] == 4) echo"
<input type=button class=input value='Сундук' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take5=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 311 && $stat['kwest0'] == 8) echo"
<input type=button class=input value='Йод' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take7=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 315 && $stat['kwest0'] == 14) echo"
<input type=button class=input value='Лезвие' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take11=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 316 && $stat['kwest0'] == 9) echo"
<input type=button class=input value='Змеиный Плод' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take8=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 317 && $stat['kwest0'] == 1) echo"
<input type=button class=input value='Пояс' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take4=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 306 && $stat['kwest'] == 7) echo"
<input type=button class=input value='Солнечный камень' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take9=\"+Math.random();\"\"'><HR color=silver>";
			if ($stat['room'] == 313 && $stat['kwest0'] == 23) echo"
<input type=button class=input value='Котёнок' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take12=\"+Math.random();\"\"'><HR color=silver>";



			echo"

</td>
</tr>
</table>

<!-- Конец возможностей -->

</td>
</tr>
</table>
</td>
</tr>
</table>
</fieldset>
<BR><BR>
</td>
</tr>
</table>
";

}




?>
<BODY
	bgcolor=EBEDEC leftmargin=0 topmargin=0
	background='<? print"$stat[img_path]"; ?>/i/backgrounds/podzem.jpg'
	style='background-attachment: fixed;'>