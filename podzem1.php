<?
require_once("inc/module.php");
$stat2 = mysql_fetch_array(mysql_query("select * from players where user='$user' and pass='$pass'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat[t_time]) { header("Location: prison.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']<=300 && $stat['room']>=318) { header("Location: main.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
else {

	mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");
	include("inc/main/changed.php");



	$VaultInfo = mysql_fetch_array(mysql_query("SELECT * FROM `podzem` WHERE city='".$stat[city]."' and id='".$stat['room']."'"));


	if ($work) {
		if ($stat[proff] == 17) {
			if ($stat[room] == 300) {
				$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=17 AND objects.min='1|0|0|0|0|0|0|0' AND objects.id IN (slots.3)");
				if (mysql_num_rows ($instr)) {
					$instrument = mysql_fetch_array($instr);
					if ($stat[ustal_now]>=20) {
						if ($stat['vault_move'] == 0) {
							if ($stat['r_action'] == 0) {
								$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects WHERE min='1|0|0|0|0|0|0|0' AND objects.tip=17 AND user='".$stat['user']."'"));
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
								mysql_query("UPDATE players set r_time=$now+1800, r_action=1, ustal_now=ustal_now-20 where id=$stat[id]");
								echo"<script LANGUAGE=\"JavaScript\">top.frames['main'].location = \"podzem.php\";</SCRIPT>";
							} else $msg = "Вы добываете руду!";
						} else $msg = "Вы добываете руду!";
					} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
				} else $msg="Без кирки добывать руду нельзя!";
			} else $msg="Вы находитесь не в той комнате в какой нужно...";
		} else $msg="У вас нет профессии Рудокоп";
	}



	if ($stat['r_action'] == 1) {

		if ($stat['r_time']-2 < $now) {

			mysql_query("UPDATE `players` SET r_time=0, r_action=0 WHERE user='".$stat['user']."'");

			$stat['r_time'] = 0;
			$stat['r_action'] = 0;
			$res=rand(0,9);
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
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`time`, `about`) VALUES ('".$stat['user']."','".$res_type."|10|0|0|0|0|1','0|0|0|0|0|0|0|0','18','".time()."', 'Неограненный камень')");
				require_once("inc/chat/functions.php");
				insert_msg("Поздравляем! Вы добыли драгоценный камень в кол-ве <b><u>1 ед</u></b>","","","1",$stat['user'],"",$stat['room']);
			}
			else {
				mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`time`, `about`) VALUES ('".$stat['user']."','ruda|Руда|4|0|0|0|0|1','0|0|0|0|0|0|0|0','18','".time()."', 'Руда')");
				require_once("inc/chat/functions.php");
				insert_msg("Вы добыли руду в кол-ве <b><u>1 ед</u></b>!","","","1",$stat['user'],"",$stat['room']);
			}
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
				elseif ($chl['room'] < 300 || $chl['room'] > 330) $nms="Для нападния Вам необходимо находится в одной комнате!";
				elseif ($stat['hp_now'] < (($stat['hp']+$stat['vitality']*5)*0.33)) $msg="Вы слишком ослаблены для боя!";
				elseif ($chl['hp_now'] <= 5  && $chl['rank']<>60) $msg="Персонаж <u>$login</u> слишком слаб для поединка!";
				elseif (((time()-$chl['lpv'])<10) && ($chl['battle'] == $chl['last_battle'] || !$chl['battle']) && $chl['rank']==60) $msg="Бот <u>".$chl['user']."</u> еще не восстановил свой уровень жизни!";

				else {

					require_once("inc/chat/functions.php");
					insert_msg("Разъярённый <b><u>$stat[user]</u></b> собрался с силами и напал на Вас!","","","1",$chl['user'],"",$chl['room']);

					$battime="$now";

					if ($chl['rank']==60 && ($chl['battle'] == $chl['last_battle'] || !$chl['battle'])) {

						$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`vitality`) as `vitality` FROM slots, objects WHERE slots.id='".$chl['id']."' AND objects.user='".$chl['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slot
s.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slot
s.19) LIMIT 1"));
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

						$levels=mysql_fetch_array(mysql_query("SELECT base FROM levels WHERE level=$stat[level]"));

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
		if ($stat2['kwest0']!=12) $msg="Вы уже подобрали Солнечный камень или не получили квест в Квестовом Домике!";
		elseif ($stat2[room] != 306) $msg = "Вы находитесь не в той комнате в какой нужно...";
		elseif ($stat['vault_move'] == 1) $msg = "Вы не можете поднять вещь во время перемещения!";
		elseif ($stat[travma] > $now) $msg = "Вы травмированы, отдохните!";
		else {
			mysql_query("UPDATE players SET kwest0=13 WHERE user='".$stat2['user']."'");
			$stat2['kwest0'] = 13;

			$ItTake = "sun_kamen";

			$buyitem = mysql_fetch_array(mysql_query("SELECT * FROM items WHERE name='".$ItTake."'"));


			if ($buyitem['tip'] == 1 && $buyitem['slot2'] == "w5") $secondary=1; else $secondary=0;
			$inf="$buyitem[name]|$buyitem[title]|$buyitem[price]|0|$secondary|$buyitem[art]|0|$buyitem[iznos]";
			$min="$buyitem[min_level]|$buyitem[min_str]|$buyitem[min_dex]|$buyitem[min_ag]|$buyitem[min_vit]|$buyitem[min_razum]|$buyitem[min_rase]|$buyitem[min_proff]";

			mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`) VALUES ('".$stat2['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."')");
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
		elseif ($stat['r_time'] > $now) $msg = "Вы не можете передвигаться, т.к. ты работаете!";
		else {

			$GoInfo = mysql_fetch_array(mysql_query("SELECT * FROM `podzem` WHERE city='".$stat[city]."' and id='".$VaultInfo[$GoIn.'_id']."'"));

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

			mysql_query("UPDATE `players` SET room=vault_room, vault_room=0, vault_time=0, vault_move=0 WHERE user='".$stat['user']."'");

			$_ROOM['TO_CHANGE'] = $stat['vault_room'];
			$stat['vault_time'] = 0;
			$stat['vault_room'] = 0;
			$stat['vaul_move'] = 0;

			echo"
                <script LANGUAGE=\"JavaScript\">
                <!--
                top.frames['main'].location = \"podzem.php\";
                top.frames['voc_who_visible'].location = top.frames['voc_who_visible'].location;
                top.frames['voc_who'].location = \"chat/who.php?session=$session\";
                top.frames['chat'].location = top.frames['chat'].location;
                //-->
                </SCRIPT>
                ";
			exit;
		}
	}
	if ($stat[city]==1) {
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
	} else {
		$VaultRoom['300'] = "Вход в каналиацию";
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
	}


	$widthhp=$stat['hp_now']/$stat['hp_max']*181;
	if ($widthhp==0) $widthhp+=2;
	if ($widthhp==1) $widthhp+=1;
	if ($widthhp>1) $widthhp-=1;

	$ustal=$stat['ustal_now'];
	$ustal_max = $stat['vitality']*5+$stat['ustal'];

	$widthustal=$ustal/$ustal_max*181;
	if ($widthustal=="0") $widthustal=$widthustal+2;
	if ($widthustal=="1") $widthustal=$widthustal+1;
	if ($widthustal>"1") $widthustal=$widthustal-1;


	include("inc/html_header.php");

	echo"<body bgcolor=#EBEDEC leftmargin=0 topmargin=0>

<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
	echo"<script LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<script LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<script LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>
<script LANGUAGE=\"JavaScript\" src=\"AJAX/ajax.js\"></SCRIPT>
<script LANGUAGE=\"JavaScript\">Attackpodzem();</SCRIPT>
";

	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<TD width=1>&nbsp;</TD>
<td width=600 valign=top>


<TABLE cellspacing=0 cellpadding=0>
<tr>

<TD valign=top>
<script language=JavaScript>
show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</SCRIPT>
</TD>

<TD WIDTH=10>&nbsp;</TD>

<TD valign=top>
<table cellspacing=0 cellpadding=0 border=0 align=center height=12>
<tr>
<td width=200 title='Уровень жизни: $stat[hp_now]/$stat[hp_max]' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_helth.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/helth.gif height='10' width='$widthhp' border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/_helth_.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'></td>
<TD valign=top><FONT COLOR=RED><B>$stat[hp_now] / $stat[hp_max]</B></FONT></TD>
</tr>
<tr>
<td width=200 title='Уровень активности: $ustal/$ustal_max' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_ustal.gif width='10' height=10 border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/vault/navigation/hp/ustal.gif height='10' width='$ustal' border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/vault/navigation/hp/_ustal_.gif width='10' height=10 border=0 alt='Уровень активности: $ustal/$ustal_max'></td>
<TD valign=top><FONT COLOR=GREEN><B>$ustal / $ustal_max</B></FONT></TD>
</tr>
</table>
</TD>



</TR>
</TABLE>

</td>

<td align=right valign=top>
<input class=lbut type=button value='Обновить' onclick='window.location.href=\"podzem.php?tmp=\"+Math.random();\"\"'>";

	if ($stat['room'] == 318 || $stat['room'] == 300) echo"
<input class=lbut type=button value='Выход в Город' onclick='window.location.href=\"world.php?room=26&tmp=\"+Math.random();\"\"'>";

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

<fieldset style='WIDTH: 98.6%'><legend>Территория подземелья</legend>
<table width=100% cellspacing=0 cellpadding=5>
<tr>
<td align=center>



<table cellspacing=0 cellpadding=0 border=0 width=100%>
<tr>
<td width=170 align=left valign=top>





<!-- Навигация -->

<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center>

<b>Навигация</b><HR color=silver>

<table cellspacing=0 cellpadding=0 border=0>

<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['top_id']) echo"active/top.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=top&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['top_id']]."' style='CURSOR: Hand'"; else echo"n_active/top.gif' alt='Нет прохода'";
	echo"></td><td width=45>&nbsp;</td>
</tr>

<tr height=45>
<td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['left_id']) echo"active/left.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=left&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['left_id']]."' style='CURSOR: Hand'"; else echo"n_active/left.gif' alt='Нет прохода'";
	echo"></td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/center.gif'></td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['right_id']) echo"active/right.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=right&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['right_id']]."' style='CURSOR: Hand'"; else echo"n_active/right.gif' alt='Нет прохода'";
	echo"></td>
</tr>

<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['bottom_id']) echo"active/bottom.gif' onclick='top.frames[\"main\"].location = \"podzem.php?GoIn=bottom&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['bottom_id']]."' style='CURSOR: Hand'"; else echo"n_active/bottom.gif' alt='Нет прохода'";
	echo"></td><td width=45>&nbsp;</td>
</tr>

</table>";

	if ($stat['vault_time'] > $now) {

		echo"<HR color=silver>Топаем в <b><u>".$VaultRoom[$stat[vault_room]]."</u></b><HR color=silver><tABLE cellspacing=0 cellpadding=0><tr><td>Ещё:&nbsp;</td><td><b><small><div id=move></div></small></b><script>ShowTime('move',",$stat['vault_time']-$now+rand(1,3),",1);</script></td></tr></table>";
	}

	if ($stat['r_time'] > $now) {

		echo"<HR color=silver>Добываем руду<HR color=silver><tABLE cellspacing=0 cellpadding=0><tr><td>Ещё:&nbsp;</td><td><b><small><div id=know></div></small></b><script>ShowTime('know',",$stat['r_time']-$now,",1);</script></td></tr></table>";
	}
	echo"
</td>
</tr>
</table>

<!-- Конец навигации -->




</td>
<td align=center valign=top>
".$VaultInfo['text'];


	$YES = 0;
	if ($YES) {
		echo"<HR color=silver>

        <TABLE cellspacing=0 cellpadding=0 border=0 width=100%>
        <TR>
        <TD align=left>
                <b><i>В комнате разбросаны предметы:</i></b><BR>

        </TD>
        </TR>
        </TABLE>

        ";
	}

	echo"</td>


<td width=170 align=right valign=top>



<!-- Возможности -->

<table cellspacing=0 cellpadding=5 style='border-style: outset; border-width: 2' border=1 width=150>
<tr>
<td align=center >

<b>Действия</b><HR color=silver>
<input type=button class=input value='Нападение' style='WIDTH: 120px' onclick=\"java script:ShowForm('Нападение','podzem.php?Attack=$now','','','1','attack','1','0');\"><HR color=silver>
";
	if ($stat['room'] == 300) echo"
<input type=button class=lbut value='Добыча камней' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?work=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 305 && $stat2['kwest0'] == 7) echo"
<input type=button class=lbut value='Рубин' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take6=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 302 && $stat2['podzem1'] == 0) echo"
<input type=button class=lbut value='Камень' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take2=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 308 && $stat2['kwest0'] == 13) echo"
<input type=button class=lbut value='Рукоядь' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take10=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 310 && $stat2['kwest0'] == 4) echo"
<input type=button class=lbut value='Сундук' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take5=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 311 && $stat2['kwest0'] == 8) echo"
<input type=button class=lbut value='Йод' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take7=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 315 && $stat2['kwest0'] == 14) echo"
<input type=button class=lbut value='Лезвие' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take11=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 316 && $stat2['kwest0'] == 9) echo"
<input type=button class=lbut value='Змеиный Плод' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take8=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 317 && $stat2['kwest0'] == 1) echo"
<input type=button class=lbut value='Пояс' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take4=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 306 && $stat2['kwest0'] == 12) echo"
<input type=button class=lbut value='Солнечный камень' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take9=\"+Math.random();\"\"'><HR color=silver>";
	if ($stat['room'] == 313 && $stat2['kwest0'] == 23) echo"
<input type=button class=lbut value='Котёнок' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"podzem.php?take12=\"+Math.random();\"\"'><HR color=silver>";



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
";











	echo"</td>
</tr>
</table>
";

}
?>