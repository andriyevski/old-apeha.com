<?
include("inc/db_connect.php");
include("inc/html_header.php");
$now=time();
$stat = mysql_fetch_array(mysql_query("select * from players where user='".addslashes($user)."' and pass='".addslashes($pass)."'"));

if ($stat['bloked']) echo"<script>top.location='index.php?action=logout'</script>";

if ($stat['t_time']>$now) { header("Location: prison.php"); exit; }
elseif ($stat['k_time']>$now) { header("Location: academy.php"); exit; }
elseif ($stat['o_time']>$now) { header("Location: juvelir.php"); exit; }
elseif ($stat[r_time]>$now) { header("Location: podzem.php"); exit; }
elseif ($stat['mol_bog_swet']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat['mol_bog_tima']>$now) { header("Location: bog_hram.php"); exit; }
elseif ($stat[battle]) { header("Location: battle.php"); exit; }
elseif ($stat['room']<=601 && $stat['room']>=645) { header("Location: main.php"); exit; }
else {

	mysql_query("UPDATE players SET lpv=$now WHERE user='".$stat['user']."'");
	include("inc/main/changed.php");



	//расчет жизней
	$widthhp=$stat['hp_now']/$stat['hp_max']*172;
	if ($widthhp==0) $widthhp+=2;
	if ($widthhp==1) $widthhp+=1;
	if ($widthhp>1) $widthhp-=1;

	//расчет усталости
	$ustal=$stat['ustal_now'];
	$ustal_max = $stat['vitality']*5+$stat['ustal'];

	$widthustal=$ustal/$ustal_max*172;
	if ($widthustal=="0") $widthustal=$widthustal+2;
	if ($widthustal=="1") $widthustal=$widthustal+1;
	if ($widthustal>"1") $widthustal=$widthustal-1;
	//конец расчетам

	//формула отнимания ХП при попадении в водоворот
	$minus_hp = $stat[hp_now]*50/100;
	//формула закончилась
	/*
	 //попадаем в водоворот
	 if ($stat['room'] == 719) {
	 mysql_query("UPDATE players SET room=721, hp_now=hp_now-$minus_hp WHERE user='".$stat['user']."'");
	 echo"<SCRIPT LANGUAGE='JavaScript'>
	 <!--
	 alert('Неожиданно налетевший шквал потащил вашу лодку в сторону огромного водоворота. Вы пытались отвернуть в сторону, но сорванная очередным порывом рея обрушилась на вашу голову... Когда вы очнулись, то поняли, что еле живы и находитесь в совершенно неизвестном месте.');
	 //-->
	 </SCRIPT>";
	 echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"forest.php\";</SCRIPT>";
	 } elseif ($stat['room'] == 724) {
	 mysql_query("UPDATE players SET room=704, hp_now=hp_now-$minus_hp WHERE user='".$stat['user']."'");
	 echo"<SCRIPT LANGUAGE='JavaScript'>
	 <!--
	 alert('Неожиданно налетевший шквал потащил вашу лодку в сторону огромного водоворота. Вы пытались отвернуть в сторону, но сорванная очередным порывом рея обрушилась на вашу голову... Когда вы очнулись, то поняли, что еле живы и находитесь в совершенно неизвестном месте.');
	 //-->
	 </SCRIPT>";
	 echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"forest.php\";</SCRIPT>";
	 } elseif ($stat['room'] == 735) {
	 mysql_query("UPDATE players SET room=717, hp_now=hp_now-$minus_hp WHERE user='".$stat['user']."'");
	 echo"<SCRIPT LANGUAGE='JavaScript'>
	 <!--
	 alert('Неожиданно налетевший шквал потащил вашу лодку в сторону огромного водоворота. Вы пытались отвернуть в сторону, но сорванная очередным порывом рея обрушилась на вашу голову... Когда вы очнулись, то поняли, что еле живы и находитесь в совершенно неизвестном месте.');
	 //-->
	 </SCRIPT>";
	 echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"forest.php\";</SCRIPT>";
	 }
	 //конец попадания в водоворот
	 */
	if($stat['rub_time']<$now) {

	$bots_num=mysql_query("select * from players where room='".$stat['room']."' and rank='60'");

	while($bots=mysql_fetch_array($bots_num)){

		$chance=5;$i=0;
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

			if($i>1 or !empty($stat['battle']) && $stat['rub_time']<$now){
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
	$VaultInfo = mysql_fetch_array(mysql_query("SELECT * FROM `forest` WHERE id='".$stat['room']."'"));


	if ($work) {
		if ( $_POST['right_code'] == $_POST['number'] ) {
			if ($stat['room'] == 601 || $stat['room'] == 611 || $stat['room'] == 613 || $stat['room'] == 620 || $stat['room'] == 628 || $stat['room'] == 634 || $stat['room'] == 641 || $stat['room'] == 645) {
				//Тут проверяем удочку на тебе
				$instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='3|0|0|0|0|0|0|0' AND objects.id IN (slots.3)");

				if (mysql_num_rows ($instr)) {
					//Проверяем активность
					if ($stat[ustal_now]>=5) {
						//Проверка не перемещаемся ли мы
						if ($stat['forest_move'] == 0) {
							//Проверка не ловим ли мы рыбку
							if ($stat['rub_action'] == 0) {
								//Тут из БД достаем вашу удочку
								$izn_instr = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='1|0|0|0|0|0|0|4' AND objects.id IN (slots.3)");
								$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='3|0|0|0|0|0|0|0' AND objects.id IN (slots.3)"));
								$instr_inf=explode("|",$izn_instr['inf']);
								$iznos=($instr_inf[6]+1);
								//Проверяем если сломана полностью удочка то ложим ее в мешок

								if ($instr_inf[7] > $iznos ) {
									mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
								}
								else
								{
									//Ложим в мешок
									mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
									mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
								}

								$time_r = 420*$stat['navik_lsn'];
								$times_r = 600-$time_r;
								$times_r2 = ceil($times_r);

								//Ставим время ловли рыбы (20 сек) + отнимаем 5 активности
								mysql_query("UPDATE players set rub_time=$now+$times_r2, rub_action=1, ustal_now=ustal_now-5 where id=$stat[id]");
								echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"forest.php\";</SCRIPT>";

							} else $msg = "Вы уже работаете!";
						} else $msg = "Вы не можете начать искать, т.к. вы перемещаетесь!";
					} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
				} else $msg="У вас нет корзинки, куда складывать добычу!";
			} else $msg="Вы находитесь не в той комнате в какой нужно...";
		} else $msg="Неверный код";
	}









	if ($kopka) {
		if ( $_POST['right_code2'] == $_POST['number2'] ) {
			if ($stat['room'] != 601 || $stat['room'] != 602 || $stat['room'] != 613 || $stat['room'] != 620 || $stat['room'] != 628 || $stat['room'] != 634 || $stat['room'] != 641 || $stat['room'] != 645) {
				//Тут проверяем удочку на тебе
				$lopata = mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='5|0|0|0|0|0|0|0' AND objects.inf LIKE '%lopata%' AND objects.id IN (slots.3)");

				if (mysql_num_rows ($lopata)) {
					//Проверяем активность
					if ($stat[ustal_now]>=5) {
						//Проверка не перемещаемся ли мы
						if ($stat['forest_move'] == 0) {
							//Проверка не ловим ли мы рыбку
							if ($stat['rub_action'] == 0) {
								//Тут из БД достаем вашу удочку

								$izn_instr = mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.inf LIKE '%lopata%'
 AND objects.min='5|0|0|0|0|0|0|0' AND objects.id IN (slots.3)"));
								$instr_inf=explode("|",$izn_instr['inf']);
								$iznos=($instr_inf[6]+1);
								//Проверяем если сломана полностью удочка то ложим ее в мешок

								if ($instr_inf[7] > $iznos ) {
									mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
								}
								else
								{
									//Ложим в мешок
									mysql_query("UPDATE objects SET inf='".$instr_inf['0']."|".$instr_inf['1']."|".$instr_inf['2']."|".$instr_inf['3']."|".$instr_inf['4']."|".$instr_inf['5']."|".$iznos."|".$instr_inf['7']."' WHERE id='".$izn_instr['id']."'");
									mysql_query("UPDATE slots set slots.3=0 WHERE slots.id=".$stat['id']."");
								}

								$time_r = 420*$stat['navik_lsn']/2/100;
								//$times_r = 170-$time_r;
								$times_r = 170-$time_r;
								$times_r2 = ceil($times_r);

								//Ставим время ловли рыбы (20 сек) + отнимаем 5 активности
								mysql_query("UPDATE players set rub_time=$now+$times_r2, rub_action=2, ustal_now=ustal_now-5 where id=$stat[id]");
								echo"<SCRIPT LANGUAGE=\"JavaScript\">top.frames['main'].location = \"forest.php\";</SCRIPT>";

							} else $msg = "Вы уже работаете!";
						} else $msg = "Вы не можете начать копать, т.к. вы перемещаетесь!";
					} else $msg="Да вы батенька заработались! Идите-ка посражайтесь.";
				} else $msg="У вас нет Лопаты, купите ее или возьмите в руки!";
			} else $msg="Вы находитесь не в той комнате в какой нужно...";
		} else $msg="Неверный код";
	}



	if ($stat['rub_action'] == 1) {
		//Если у тебя вышло время ловли рыбки, то даем саму рыбку, или не даем :))
		if ($stat['rub_time']-2 < $now) {
			//Убираем в БД время, и значение ловли рыбы
			mysql_query("UPDATE `players` SET rub_time=0, rub_action=0 WHERE user='".$stat['user']."'");
			$stat['rub_action'] = 0;
			$stat['rub_time'] = 0;



			$resurs=array();
			$resurs[1]="ing_gribok|Грибок";
			$resurs[2]="ing_galo_skorp|Жало скорпиона";
			$resurs[3]="ing_vamp|Клык вампира";
			$resurs[4]="ing_4esh_drak|Чешуя дракона";
			$resurs[5]="ing_trava|Трава";
			$resurs[6]="ing_kosti|Кости животного";
			$resurs[7]="ing_koga|Кусок кожи";
			$resurs[8]="ing_vet_veres|Ветка Вереска";
			$resurs[9]="ing_kor_mand|Корень Мандрагоры";
			$resurs[10]="ing_oleni_rog|Рога оленя";
			//$resurs[10]="ing_metril|Метрил";



			/*$resurs[1]="ing_gribok|Грибок";
			 $resurs[2]="ing_galo_skorp|Жало скорпиона";
			 $resurs[3]="ing_vamp|Клык вампира";
			 $resurs[4]="ing_4esh_drak|Чешуя дракона";
			 $resurs[5]="ing_trava|Трава";
			 $resurs[6]="ing_kosti|Кости животного";
			 $resurs[7]="ing_koga|Кусок кожи";
			 $resurs[8]="ing_vet_veres|Ветка Вереска";
			 $resurs[9]="ing_kor_mand|Корень Мандрагоры";
			 //$resurs[10]="ing_metril|Метрил";

			 $resurs[2]="ing_cry|Кристалы";
			 $resurs[4]="ing_kri_kv|Кристалл кварца";
			 $resurs[5]="ing_br_slit|Бронзовый слиток";
			 $resurs[19]="ing_volos|Волосы";
			 $resurs[8]="ing_kefal|Кефаль";
			 $resurs[9]="ing_narval|Нарвал";
			 $resurs[10]="ing_stavrida|Ставрида";
			 $resurs[11]="ing_osetr|Осётр";
			 $resurs[12]="ing_okun|Окунь";*/
			$res_type=$resurs[rand(1,10)];
			$r_name=explode("|",$res_type);

			$iznos=($instr_inf[6]+1);

			$navik = $stat['navik_lsn'];


			$min = $chance*$navik/100;

			$ch = rand(0,9);
			$ing = 1;
			$kol_ing = rand(1,$ing);

			if ( $ch <= 4 ) {

				$ass = $kol_ing+2;
				$dobav_nav = $ass/1000;

				require_once("inc/chat/functions.php");
				insert_msg("Вы добыли <b>\"$r_name[1]\" $ing шт.</b> и ловко забросили в корзину! Ваш навык <b>\"Лесника\"</b> повысился на <b>$dobav_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_lsn=navik_lsn+$dobav_nav WHERE id='".$stat['id']."'");
				mysql_query("UPDATE players SET $r_name[0]=$r_name[0]+1 WHERE id='".$stat['id']."'");



			}
			else {



				$ch2 = rand(0,4);

				if ( $ch2 <= 3 ) {
					$dobav_nav = $ass/1000;

					require_once("inc/chat/functions.php");
					insert_msg("Вы добыли <b>\"Трава\" $ing шт.</b> и ловко забросили в корзину! Ваш навык <b>\"Лесника\"</b> повысился на <b>$dobav_nav</b>%","","","1",$stat[user],"",$stat[room]);
					mysql_query("UPDATE players SET navik_lsn=navik_lsn+$dobav_nav WHERE id='".$stat['id']."'");
					mysql_query("UPDATE players SET ing_trava=ing_trava+1 WHERE id='".$stat['id']."'");

				}else {

					$ubr_nav = $kol_ing/1000;
					require_once("inc/chat/functions.php");
					insert_msg("Вы ничего не нашли! Ваш навык <b>\"Лесника\"</b> повысился на <b>$ubr_nav</b>%","","","1",$stat[user],"",$stat[room]);
					mysql_query("UPDATE players SET navik_lsn=navik_lsn+$ubr_nav WHERE id='".$stat['id']."'");

				}}

		}
	}



	if ($stat['rub_action'] == 2) {
		//Если у тебя вышло время ловли рыбки, то даем саму рыбку, или не даем :))
		if ($stat['rub_time']-2 < $now) {
			//Убираем в БД время, и значение ловли рыбы
			mysql_query("UPDATE `players` SET rub_time=0, rub_action=0 WHERE user='".$stat['user']."'");
			$stat['rub_action'] = 0;
			$stat['rub_time'] = 0;



			$resurs=array();
			$resurs[1]="ing_dozhdevik|Дождевой червь";
			$resurs[2]="ing_zhuk|Жук навозный";
			$res_type=$resurs[rand(1,2)];
			$r_name=explode("|",$res_type);

			$iznos=($instr_inf[6]+1);

			$navik = $stat['navik_lsn'];


			$min = $chance*$navik/100;

			$ch = rand(0,4);
			$ing = 5;
			$kol_ing = rand(1,$ing);

			if ( $ch > 3 ) {

				$ass = $kol_ing+2;
				$dobav_nav = $ass/10000;

				require_once("inc/chat/functions.php");
				insert_msg("Вы выкипали <b>\"$r_name[1]\" $kol_ing шт.</b> и ловко забросили в корзину! Ваш навык <b>\"Лесника\"</b> повысился на <b>$dobav_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_lsn=navik_lsn+$dobav_nav WHERE id='".$stat['id']."'");
				mysql_query("UPDATE players SET $r_name[0]=$r_name[0]+$kol_ing WHERE id='".$stat['id']."'");


			}
			else {
				$ubr_nav = $kol_ing/1000;
				require_once("inc/chat/functions.php");
				insert_msg("Вы ничего не нашли! Ваш навык <b>\"Лесника\"</b> повысился на <b>$ubr_nav</b>%","","","1",$stat[user],"",$stat[room]);
				mysql_query("UPDATE players SET navik_lsn=navik_lsn+$ubr_nav WHERE id='".$stat['id']."'");

			}

		}
	}


	// Переход
	if ($GoIn && ($GoIn == "top" || $GoIn == "bottom" || $GoIn == "left" || $GoIn == "right")) {
		$boots=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=6 AND objects.min='3|0|0|0|0|0|0|0' AND objects.inf LIKE '%boots%' AND objects.id IN (slots.13)"));
		if ($stat['forest_move'] == 1) $msg = "Вы уже перемещаетесь!";
		elseif ($stat['rub_time'] > $now) $msg = "Вы не можете перемещаться, т.к. вы работаете!";

		elseif (!$boots) $msg = "Вы не можете перемещаться, т.к. на вас нет специальной обуви!";
		else {

			$GoInfo = mysql_fetch_array(mysql_query("SELECT * FROM `forest` WHERE id='".$VaultInfo[$GoIn.'_id']."'"));

			if ($GoInfo['id']) {

				$boots=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=6 AND objects.min='3|0|0|0|0|0|0|0' AND objects.id IN (slots.13)"));

				$boots_inf=explode("|",$boots['inf']);
				$times = $GoInfo['time']*30-$boots_inf['2'];
				 
				if ($stat['user'] == 'diepo' || $stat['user'] == 'Gibson') {$stat['forest_time'] = $now+'1';} else {
					$stat['forest_time'] = $now + $times;}
					$stat['forest_room'] = $GoInfo['id'];
					$stat['vaul_move'] = 1;


					mysql_query("UPDATE `players` SET forest_room='".$GoInfo['id']."', forest_time='".$stat['forest_time']."', forest_move=1 WHERE user='".$stat['user']."'");

					$GoToText = "Перемещаемся в <b><u>".$GoInfo['title']."</u></b>";
			}
		}
	}

	if ($stat['forest_move'] == 1) {

		if ($stat['forest_time']-2 < $now) {

			mysql_query("UPDATE `players` SET room=forest_room, forest_room=0, forest_time=0, forest_move=0 WHERE user='".$stat['user']."'");

			$_ROOM['TO_CHANGE'] = $stat['forest_room'];
			$stat['forest_time'] = 0;
			$stat['forest_room'] = 0;
			$stat['vaul_move'] = 0;

			echo"
                <SCRIPT LANGUAGE=\"JavaScript\">
                <!--
top.frames['main'].location = \"forest.php\";
top.frames['online'].location = top.frames['online'].location;

                //-->
                </SCRIPT>
                ";
			exit;
		}
	}

	$VaultRoom['601'] = "Лес x5 y1";
	$VaultRoom['602'] = "Лес x5 y2";
	$VaultRoom['603'] = "Лес x5 y3";
	$VaultRoom['604'] = "Лес x5 y4";
	$VaultRoom['605'] = "Лес x4 y1";
	$VaultRoom['606'] = "Лес x4 y2";
	$VaultRoom['607'] = "Лес x4 y3";
	$VaultRoom['608'] = "Лес x4 y4";
	$VaultRoom['609'] = "Лес x3 y1";
	$VaultRoom['610'] = "Лес x3 y2";
	$VaultRoom['611'] = "Лес x3 y3";
	$VaultRoom['612'] = "Лес x3 y4";
	$VaultRoom['613'] = "Лес x2 y1";
	$VaultRoom['614'] = "Лес x2 y2";
	$VaultRoom['615'] = "Лес x2 y3";
	$VaultRoom['616'] = "Лес x2 y4";
	$VaultRoom['617'] = "Лес x1 y1";
	$VaultRoom['618'] = "Лес x1 y2";
	$VaultRoom['619'] = "Лес x1 y3";
	$VaultRoom['620'] = "Лес x1 y4";
	$VaultRoom['621'] = "Лес x-1 y2";
	$VaultRoom['622'] = "Лес x-1 y3";
	$VaultRoom['628'] = "Лес x-2 y1";
	$VaultRoom['623'] = "Лес x-2 y3";
	$VaultRoom['624'] = "Лес x-2 y4";
	$VaultRoom['627'] = "Лес x-3 y1";
	$VaultRoom['626'] = "Лес x-3 y2";
	$VaultRoom['625'] = "Лес x-3 y3";
	$VaultRoom['629'] = "Лес x-4 y1";
	$VaultRoom['630'] = "Лес x-4 y-1";
	$VaultRoom['631'] = "Лес x-5 y-1";
	$VaultRoom['632'] = "Лес x-3 y-1";
	$VaultRoom['633'] = "Лес x-3 y-2";
	$VaultRoom['634'] = "Лес x-2 y-2";
	$VaultRoom['635'] = "Лес x-3 y-3";
	$VaultRoom['636'] = "Лес x-1 y-2";
	$VaultRoom['637'] = "Лес x-2 y-3";
	$VaultRoom['638'] = "Лес x1 y-2";
	$VaultRoom['639'] = "Лес x1 y-3";
	$VaultRoom['640'] = "Лес x1 y-1";
	$VaultRoom['641'] = "Лес x2 y-2";
	$VaultRoom['642'] = "Лес x3 y-2";
	$VaultRoom['643'] = "Лес x3 y-1";
	$VaultRoom['644'] = "Лес x3 y-3";
	$VaultRoom['645'] = "Лес x4 y-3";



	include("inc/html_header.php");

	echo"<body bgcolor=F5FFD9 leftmargin=0 topmargin=0>

<DIV id=hint1></DIV>
<div id=mainform style='position:absolute; left:30px; top:30px'></div>";
	echo"<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/time.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/show_inf.js\"></SCRIPT>
<SCRIPT LANGUAGE=\"JavaScript\" SRC=\"i/login_form.js\"></SCRIPT>";

	//Начало перехода в порт
	if ($perexod) {
		if ($stat['forest_move'] == 0) {
			if ($stat[room] == 602) { // Проверка на локацию

				mysql_query("UPDATE players set room=38 where user='".$stat['user']."'");
				$stat['room']=38;

				require_once("inc/chat/functions.php");
				insert_msg("Вы вернулись из леса","","","1",$stat[user],"",$stat[room]);

				echo "<meta http-equiv='refresh' content='0; url=goforest.php'>"; }

				else $msg="Ошибка, вы находитесь слишком долеко от города!"; } else $msg = "Вы уже ходите в лесу!";
	}
	//Конец перехода в порт


	print"<table width=100% cellspacing=0 cellpadding=5 border=0>
<tr>
<TD width=1>&nbsp;</TD>
<td width=600 valign=top>


<TABLE cellspacing=0 cellpadding=0>
<tr>

<TD valign=top>
<SCRIPT language=JavaScript>
show_inf('$stat[user]','$stat[id]','$stat[level]','$stat[rank]','$stat[tribe]');
</SCRIPT>
</TD>

<TD WIDTH=10>&nbsp;</TD>
<form action='' method=post>
<TD valign=top>
<table cellspacing=0 cellpadding=0 border=0 align=center height=12>
<tr>
<td width=200 title='Уровень жизни: $stat[hp_now]/$stat[hp_max]' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_helth.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/helth.gif height='10' width='$widthhp' border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'><img src=i/vault/navigation/hp/_helth_.gif width='10' height=10 border=0 alt='Уровень жизни: $stat[hp_now]/$stat[hp_max]'></td>
<TD valign=top><FONT COLOR=RED><B>$stat[hp_now] / $stat[hp_max]</B></FONT></TD>
</tr>
<tr>
<td width=200 title='Уровень активности: $ustal/$ustal_max' align=left valign=bottom width=200><img src=i/vault/navigation/hp/_ustal.gif width='10' height=10 border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/vault/navigation/hp/ustal.gif height='10' width='$widthustal' border=0 alt='Уровень активности: $ustal/$ustal_max'><img src=i/vault/navigation/hp/_ustal_.gif width='10' height=10 border=0 alt='Уровень активности: $ustal/$ustal_max'></td>
<TD valign=top><FONT COLOR=GREEN><B>$ustal / $ustal_max</B></FONT></TD>
</tr>
</table>
</TD>



</TR>
</TABLE>

</td>

<td align=right valign=top>
<input class=input type=button value='Обновить' onclick='window.location.href=\"forest.php?tmp=\"+Math.random();\"\"'>";

	if ($stat['room'] == 602) echo"
<input type=submit class=input value='Войти в город' name=perexod>";

	echo"</td>
</tr>
</table></form>";



	if (!empty($msg)) echo"<center><font color=red><b>$msg</b></font></center>";


	echo "<table border='0' width='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='100%' align='center'>
     <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b11.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b12.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b13.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b14.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b15.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
    </td>
    <td height='100%'>
      <table border='0' width='100%' height='100%' cellspacing='0' cellpadding='0'>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b211.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b212.gif' valign='middle'>
    <table border='0' height='22' cellspacing='0' cellpadding='0'>
  <tr>
<td width='96' height='22'>&nbsp;</td>

  </tr>
</table>
   
    </td>
    <td width='51' height='25'>
<img src='i/inman_b213.gif' width='51' height='25' alt=''></td>
  </tr>
</table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='100%' background='i/inman_fon.gif'>
            <table border='0' width='100%' height='100%' cellpadding='0' cellspacing='0' style='border-collapse: collapse; border-style: solid; padding: 3'>
            <tr><td valign='top' width='135'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center' colspan='3'><b>Навигация:</b></td></tr>
<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['top_id']) echo"active/top.gif' onclick='top.frames[\"main\"].location = \"forest.php?GoIn=top&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['top_id']]."' style='CURSOR: Hand'"; else echo"n_active/top.gif' alt='Нет прохода'";
	echo"></td><td width=45>&nbsp;</td>
</tr>

<tr height=45>
<td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['left_id']) echo"active/left.gif' onclick='top.frames[\"main\"].location = \"forest.php?GoIn=left&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['left_id']]."' style='CURSOR: Hand'"; else echo"n_active/left.gif' alt='Нет прохода'";
	echo"></td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/center.gif'></td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['right_id']) echo"active/right.gif' onclick='top.frames[\"main\"].location = \"forest.php?GoIn=right&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['right_id']]."' style='CURSOR: Hand'"; else echo"n_active/right.gif' alt='Нет прохода'";
	echo"></td>
</tr>

<tr height=45>
<td width=45>&nbsp;</td><td width=45 align=center valign=center><IMG SRC='i/vault/navigation/";
	if ($VaultInfo['bottom_id']) echo"active/bottom.gif' onclick='top.frames[\"main\"].location = \"forest.php?GoIn=bottom&\"+Math.random();' alt='Перейти в ".$VaultRoom[$VaultInfo['bottom_id']]."' style='CURSOR: Hand'"; else echo"n_active/bottom.gif' alt='Нет прохода'";
	echo"></td><td width=45>&nbsp;</td>
</tr>";

	echo"</table>
</div>
";

	echo "</td><td valign='top'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Лесной инвентарь</b></td></tr><tr><td>";


	$boots=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=6 AND objects.min='3|0|0|0|0|0|0|0' AND objects.inf LIKE '%boots%'
  AND objects.id IN (slots.13)"));

	$boots_inf=explode("|",$boots['inf']);

	if ($boots) {
		echo "Название: <b>"; echo $boots_inf[1];
		echo "</b><br>
<center><img src='i/items/".$boots_inf['0'].".gif'></center>
Возможности: <b>".$boots['about']."</b>"; 
	} else {
		echo "На вас нет сапог.";
	}

	echo "<br><br>";

	$korzinka=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.min='3|0|0|0|0|0|0|0' AND objects.inf LIKE '%korzinka%'
 AND objects.id IN (slots.3)"));

	$korzinka_inf=explode("|",$korzinka['inf']);

	if ($korzinka) {
		echo "Название: <b>"; echo $korzinka_inf[1];
		echo "</b><br>
<center><img src='i/items/".$korzinka_inf['0'].".gif'></center>
Возможности: <b>".$korzinka['about']."</b>"; 
	} else {
		echo "В вашей руке нет корзинки.";
	}


	echo "<br><br>";

	$lopata=mysql_fetch_array(mysql_query("SELECT * FROM objects, slots WHERE objects.user='".$stat['user']."' AND slots.id=".$stat['id']." AND objects.tip=15 AND objects.inf LIKE '%lopata%'
 AND objects.min='5|0|0|0|0|0|0|0' AND objects.id IN (slots.3)"));

	$lopata_inf=explode("|",$lopata['inf']);

	if ($lopata) {
		echo "Название: <b>"; echo $korzinka_inf[1];
		echo "</b><br>
<center><img src='i/items/".$lopata_inf['0'].".gif'></center>
Возможности: <b>".$lopata['about']."</b>"; 
	} else {
		echo "В вашей руке нет лопаты.";
	}


	echo "                </td>
  </tr>
</table>
</div>
";

	echo "</td><td valign='top'>";

	echo"
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Ваши действия:</b></td></tr>";

	if ($stat['forest_time'] > $now) {

		echo"<tr><td align='center'><center><img src='i/location/forest.gif'></center><br>Вы в локации: <b>".$VaultInfo['title']."</b><br><br>Перемещаетесь:&nbsp;<b><small><div id=move></div></small></b><script>ShowTime('move',",$stat['forest_time']-$now+rand(1,3),",1);</script>
<br>В локацию: <b>".$VaultRoom[$stat[forest_room]]."</b></td></tr>";
	}

	elseif ($stat['rub_time'] > $now) {

		echo"<tr><td align='center'><center><img src='i/location/forest.gif'></center><br>Вы в локации: <b>".$VaultInfo['title']."</b><br><br>Ищете: &nbsp;<b><small><div id=know></div></small></b><script>ShowTime('know',",$stat['rub_time']-$now,",1);</script></td></tr>";
	}
	else { echo"<tr><td align='center'><center><img src='i/location/forest.gif'></center><br>Вы в локации: <b>".$VaultInfo['title']."</b><br>Ваши действия: Ожидание действий</td></tr>"; }

	echo"
</table>
</div>
";

	echo "</td><td valign='top' width='135'>";

	echo"<form action='' method=post>
<div align='center'>
  <table border='1' background='i/inman_fon2.gif' cellpadding='0' cellspacing='0' style='padding:5; border-collapse: collapse' bordercolor='#D8C792' width='100%'>
    <tr><td align='center'><b>Действия:</b></td></tr><tr><td align='center'>";
	$number = rand('111111','999999');
	$number2 = rand('111111','999999');
	if ($stat['room'] == 601 || $stat['room'] == 611 || $stat['room'] == 613 || $stat['room'] == 620 || $stat['room'] == 628 || $stat['room'] == 634 || $stat['room'] == 641 || $stat['room'] == 645) echo"
Введите код: <b>".$number."</b>
<input name='number' class=input style='WIDTH: 120px' maxlength=11 type='text' size='20'>
<input type='hidden' name='right_code' value='".$number."'>
<input type='submit' class='input' name='work' value='Искать' style='WIDTH: 120px'>";

	if ($stat['room'] != 602) echo"
Введите код: <b>".$number2."</b>
<input name='number2' class=input style='WIDTH: 120px' maxlength=11 type='text' size='20'>
<input type='hidden' name='right_code2' value='".$number2."'>
<input type='submit' class='input' name='kopka' value='Копать' style='WIDTH: 120px'>";

	/*	elseif ($stat['room'] == 626) echo"
	 <input type=button disabled class=input value='Подплыть к Острову' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"\"'>";

	 elseif ($stat['room'] == 637) echo"
	 <input type=button disabled class=input value='Подплыть к Острову' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"\"'>";

	 elseif ($stat['room'] == 644) echo"
	 <input type=button disabled class=input value='Подплыть к Острову' style='WIDTH: 120px' onclick='top.frames[\"main\"].location = \"\"'>";
	 */
	else echo "Здесь нет никаких действий для вас.";


	echo "                </td>
  </tr>
</table>
</div>
";

	echo "</form> </td>
                </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td width='100%' height='25'>
          <table border='0' width='100%' height='25' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='51' height='25'>
<img src='i/inman_b231.gif' width='51' height='25' alt=''></td>
    <td background='i/inman_b232.gif'>&nbsp;</td>
    <td width='51' height='25'>
<img src='i/inman_b233.gif' width='51' height='25' alt=''></td>
  </tr>
</table>

          </td>
        </tr>
      </table>
    </td>
    <td width='22' height='100%'>
    <table border='0' width='22' height='100%' cellspacing='0' cellpadding='0'>
  <tr>
    <td width='22' height='25'>
<img src='i/inman_b21.gif' width='22' height='25' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b22.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='100%' background='i/inman_b23.gif'>&nbsp;</td>
  </tr>
  <tr>
    <td width='22' height='69'><img src='i/inman_b24.gif' width='22' height='69' alt=''></td>
  </tr>
  <tr>
    <td width='22' height='25'><img src='i/inman_b25.gif' width='22' height='25' alt=''></td>
  </tr>
</table>
   </td>
  </tr>
</table>
      
      </td>
  </tr>
</table>";
}
?>