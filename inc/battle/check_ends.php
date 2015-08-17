<?

$bbid=$stat['battle'];


// ----- # Функция расчёта опыта # ----- //
function get_exp () {
	global $stat, $addexp, $offer, $now, $w_img, $participant, $opp_stat, $cr;
	//, $level
	//$level=mysql_fetch_array(mysql_query("SELECT `exp` FROM levels WHERE level=".$stat['level']."+1"));
$participant=mysql_fetch_array(mysql_query("SELECT `hp`, `damage`, `side`, `damaged_h`, `damaged_t`, `damaged_l`, `damaged_r`, `damaged_le`,`x`,`y`,`live` FROM participants WHERE time='".$stat['battle']."' AND id='".$stat['id']."' LIMIT 1"));
$q1="SELECT sum(players.level) as lvlsum FROM participants,players WHERE participants.time='".$stat['battle']."' AND participants.side<>'".$participant['side']."' and participants.id=players.id";
$part1=mysql_fetch_array(mysql_query($q1));
$q2="SELECT sum(players.level) as lvlsum FROM participants,players WHERE participants.time='".$stat['battle']."' AND participants.side='".$participant['side']."' and participants.id=players.id";
$part2=mysql_fetch_array(mysql_query($q2));
if($part1['lvlsum']==0)$part1['lvlsum']=1;
if($part2['lvlsum']==0)$part2['lvlsum']=1;	
$koef=1+($part1['lvlsum']-$part2['lvlsum']);

// ----- # Расчитываем получаемый опыт для физического поединка # ----- //
	if ($offer['type'] == 1) {
		$single_exp=mysql_fetch_array(mysql_query("SELECT players.`level` AS `level`, levels.`base` AS `base` FROM participants, players, levels WHERE (participants.time='".$stat['battle']."' AND participants.id!='".$stat['id']."') AND players.id=participants.id AND levels.level=players.level"));
		if ($stat['level'] == $single_exp['level']) $addexp=$participant['damage'];
		else $addexp=$participant['damage'];
	}
	// ----- # ... для группового поединка # ----- //
	elseif ($offer['type'] == 2 || $offer['type'] == 3) { include("inc/battle/exp.php"); }
	if ($offer['type'] == 2) $addexp*=1;
	if ($offer['type'] == 3) $addexp*=1;
	// ----- # Если есть грамота, то опыта в 3 раза больше # ----- //
	if ($stat['sign'] > $now) $addexp*=3;
	if ($stat['abonement'] > $now) $addexp*=3;
	// ----- # Если противник бот, то опыта в 2 раза больше # ----- //
	if ($opp_stat['rank']==60) $addexp*=1;
	// ----- # Если в башни смерти то опыт в 5 раз больше # ----- //
	if ($opp_stat['bs']==1) $addexp*=5;
	
	$addexp=round($addexp*$koef);$cr=round($addexp/100);
}
// ----- Конец ----- //

// ----- # Износ вещей # ----- //
function iznos(){
	global $stat;
	$zap='';
	$masseg='';
	$i=0;
	$chl_obj=mysql_query("SELECT slots.*, objects.id FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.19)");
	while ($vesh=mysql_fetch_array($chl_obj)){
		$id_vesh[$i]=$vesh['id'];
		$s_vesh[$i]['1']=$vesh['1']; $s_vesh[$i]['2']=$vesh['2']; $s_vesh[$i]['3']=$vesh['3']; $s_vesh[$i]['4']=$vesh['4']; $s_vesh[$i]['5']=$vesh['5']; $s_vesh[$i]['6']=$vesh['6'];
		$s_vesh[$i]['7']=$vesh['7']; $s_vesh[$i]['8']=$vesh['8']; $s_vesh[$i]['9']=$vesh['9']; $s_vesh[$i]['10']=$vesh['10']; $s_vesh[$i]['11']=$vesh['11']; $s_vesh[$i]['12']=$vesh['12'];
		$s_vesh[$i]['13']=$vesh['13']; $s_vesh[$i]['14']=$vesh['14']; $s_vesh[$i]['15']=$vesh['15']; $s_vesh[$i]['16']=$vesh['16']; $s_vesh[$i]['19']=$vesh['19'];
		$i++;
	}
	if (count($id_vesh)>0){
		$rand = mt_rand(1, count($id_vesh));
		srand ((float) microtime() * 10000000);
		$rand_keys = array_rand ($id_vesh, $rand);
		for ($i=0; $i<=count($rand_keys)-1; $i++){
			$rand_key = (count($rand_keys)==1?$rand_keys:$rand_keys[$i]);
			if ($chl_obj=mysql_fetch_array(mysql_query("SELECT id, inf FROM objects WHERE user='".$stat['user']."' AND id = ".$id_vesh[$rand_key].""))){
				$obj_inf=explode("|",$chl_obj['inf']);
				$masseg.=$zap."<b>".$obj_inf[1]."</b>";
				$zap=", ";
				$obj_inf['6']+=1;
				// --- # Добавление износа # --- //
				mysql_query("UPDATE objects SET inf='".$obj_inf['0']."|".$obj_inf['1']."|".$obj_inf['2']."|".$obj_inf['3']."|".$obj_inf['4']."|".$obj_inf['5']."|".$obj_inf['6']."|".$obj_inf['7']."' WHERE id='".$id_vesh[$rand_key]."'");
				if ($obj_inf['7'] == $obj_inf['6']) {
					// ----- # Удаляем свиток # ----- //
					//mysql_query("DELETE FROM objects WHERE id='".$id_vesh[$rand_key]."'");
					switch ($id_vesh[$rand_key]) {
						case $s_vesh[$rand_key]['1']: $slots = '1'; break;
						case $s_vesh[$rand_key]['2']: $slots = '2'; break;
						case $s_vesh[$rand_key]['3']: $slots = '3'; break;
						case $s_vesh[$rand_key]['4']: $slots = '4'; break;
						case $s_vesh[$rand_key]['5']: $slots = '5'; break;
						case $s_vesh[$rand_key]['6']: $slots = '6'; break;
						case $s_vesh[$rand_key]['7']: $slots = '7'; break;
						case $s_vesh[$rand_key]['8']: $slots = '8'; break;
						case $s_vesh[$rand_key]['9']: $slots = '9'; break;
						case $s_vesh[$rand_key]['10']: $slots = '10'; break;
						case $s_vesh[$rand_key]['11']: $slots = '11'; break;
						case $s_vesh[$rand_key]['12']: $slots = '12'; break;
						case $s_vesh[$rand_key]['13']: $slots = '13'; break;
						case $s_vesh[$rand_key]['14']: $slots = '14'; break;
						case $s_vesh[$rand_key]['15']: $slots = '15'; break;
						case $s_vesh[$rand_key]['16']: $slots = '16'; break;
						case $s_vesh[$rand_key]['19']: $slots = '19'; break;
					}
					mysql_query("UPDATE slots SET slots.".$slots."=0 WHERE slots.id='".$stat['id']."'");
					$obj_inf['3'] = 0;
				}
			}
		}
	}
	if ($masseg!=''){
		$masseg = "Ваши Вещи приобрели единицу износа: ".$masseg;
		return $masseg;
	}
}
// ----- Конец ----- //

// ----- # HP равно нулю, проигрываем, выигрываем, или ждём окончания боя # ----- //
if($page=='showbupdate'){
	$offer=mysql_fetch_array(mysql_query("SELECT `timeout`, `type`, `blood`, `kulak`, `stavka`, `zone_width`, `zone_height`,`zone_type` FROM offers WHERE time='".$stat['battle']."' LIMIT 1"));
	// $max1=mysql_fetch_array(mysql_query('SELECT time,id FROM battles WHERE offer='.$stat['battle'].' AND type<>0 ORDER BY time DESC LIMIT 1'));
	// }else{
}
$max1=mysql_fetch_array(mysql_query('SELECT time,id,type FROM battles WHERE offer='.$stat['battle'].' AND type<>0 ORDER BY time DESC LIMIT 1'));
// echo mysql_error();die();
 

if(time()-$max1['time']>$offer['timeout']){
	$q = mysql_query('select players.user from players where players.battle='.$stat['battle'].' and players.user not in (select battles.attacker from battles where battles.offer='.$stat['battle'].' and type=0) and participants.id=players.id and participants.frozen=0');
	while($someq=@mysql_fetch_array($q)) 
		mysql_query('INSERT INTO battles (offer,time,id,defender,type,comment1)VALUES('.$stat['battle'].','.time().',\''.$someq['user'].'\','.(($max1['type']!=2)?$max1['id']+1:$max1['id']).',2,\'Персонаж <b>'.$someq['user'].'</b> заморожен\')');
	
	mysql_query('update participants,players set participants.frozen=1 where participants.time='.$stat['battle'].' and participants.id=players.id and players.user not in(select battles.attacker from battles where battles.offer='.$stat['battle'].' and type=0)');
						
	if(mysql_affected_rows()==0 && $stat['battle']!=0){
		mysql_query('INSERT INTO battles (offer,time,id,type,comment1)VALUES('.$stat['battle'].','.time().','.(($max1['type']!=2)?$max1['id']+1:$max1['id']).',2,\'Все персонажи были заморожены. Бой закончен ничьей.</b>\')');
		mysql_query('update `participants` SET `frozen`=1 where `time`='.$stat['battle']);
	}
}

$warmed=@mysql_num_rows(mysql_query('SELECT id FROM participants WHERE time='.$stat['battle'].' AND frozen=0 AND side='.$stat['bside']));

if($page=='showbupdate') $participant=mysql_fetch_array(mysql_query("SELECT `hp`, `damage`, `side`, `damaged_h`, `damaged_t`, `damaged_l`, `damaged_r`, `damaged_le`,`x`,`y`,`live` FROM participants WHERE time='".$stat['battle']."' AND id='".$stat['id']."' LIMIT 1"));
//

if ($stat['hp_now'] <= 0 || $participant['hp'] <= 0 || $warmed==0) {
	$user_command=@mysql_fetch_array(
	mysql_query(
      "select count(*) as count from participants
         where participants.hp>0
                   and participants.time=".$stat['battle']."
                   and participants.side=".$participant['side']."
		and participants.frozen=0"));

	$user_opponent_command=@mysql_fetch_array(mysql_query(
      "select count(*) as count from participants
         where participants.hp>0
                    and participants.time=".$stat['battle']."
                   and participants.side=".(1-$participant['side'])."
		and participants.frozen=0"));

	$sys_msg_of_end=@mysql_num_rows(mysql_query('select id from battles where offer='.$stat['battle'].' and attacker=NULL and defender=NULL and type=2 and id<>0'));

	// ----- # НИЧЬЯ # ----- //
	// echo ((($user_command['count'] == 0 && $user_opponent_command['count'] == 0) && !$endbattle));
	if ($user_command['count'] == 0 && $user_opponent_command['count'] == 0 && !$endbattle && $participant['live']!=1 && $sys_msg_of_end!=1 && is_numeric($participant['damage'])) {
		//echo 'rfvhhbhn';die();//$echo="<center><b>Бой закончен. Ничья.</b><br><input type=button value='Вернуться' onclick='disabled = true; window.location.href=\"main.php?tmp=\"+Math.random();\"\"' class=input></center><br>";
		// сюда можно вставить сообщение в лог о результате окончания боя
		$echo="<script language='javascript'>endbattle(".$stat['battle'].");</script>";
		$ebtype='draw';
		// die($user_command['count'].' == 0 && '.$user_opponent_command['count'].' == 0) && !'.$endbattle.') || ('.$fr.' && '.$whoneedfrozen.'==0');

		mysql_query("UPDATE players SET battle=0,last_battle=".$stat['battle']." WHERE battle='".$stat['battle']."'");
		mysql_query("UPDATE participants SET live=1 WHERE time='".$stat['battle']."'");
		mysql_query("UPDATE battles_stat SET a=0, d=0, u=0, k=0 WHERE u_id = $stat[id]");
		mysql_query("UPDATE players SET drawn=drawn+1, battle=0, last_battle=".$stat['battle']." WHERE id='".$stat['id']."'");

		if ($opp_stat['rank'] == 60 && $opponent) { // вражина - бот
			mysql_query("UPDATE `players` SET `drawn` = `drawn` + '1', `battle` = 0, `last_battle`=".$stat['battle'].", `hp_now` = '".$opp_hp_max."' WHERE `id` = '".$opp_stat['id']."'");
			mysql_query("UPDATE `participants` SET `live` = '1' WHERE `time` = '".$stat['battle']."' AND `id` = '".$stat['id']."'");
		}

		if ($stat['vitality']*5 != $stat[ustal_now]) {
			mysql_query("UPDATE players SET ustal_now=ustal_now+10 WHERE id='".$stat['id']."'");
		}

		if ($stat['vitality']*5 < $stat[ustal_now]) {
			mysql_query("UPDATE players SET ustal_now='".$stat['vitality']."'*5 WHERE id='".$stat['id']."'");
		}
		// 		mysql_query('update offers set winner=0 where time='.$stat['battle']);
		require_once("inc/chat/functions.php");
		insert_msg ("Бой закончен, Ничья. Всего Вами нанесено урона: <b><u>".$participant['damage']." HP</u></b>.","","","1",$stat['user'],"",$stat['room']);
		$endbattle = 1;
		$stat['last_battle'] = $stat['battle'];
		$stat['battle'] = '';
	}

	// ----- # ПРОИГРЫШ твоей КОМАНДЫ # ----- //
	elseif (($user_command['count'] == 0 && $user_opponent_command['count'] > 0) && !$endbattle && $participant['live']!=1) { //
		//$echo="<center><b>Бой закончен. Вы проиграли.</b><br><input type=button value='Вернуться' onclick='disabled = true; window.location.href=\"main.php?tmp=\"+Math.random();\"\"' class=input></center><br>";
		$ebtype='loose';
		mysql_query("UPDATE players SET last_battle=".$stat['battle']." WHERE battle=".$stat['battle']." AND side=".$opp_side);

		mysql_query("UPDATE battles_stat SET a=0, d=0, u=0, k=0 WHERE u_id = $stat[id]");

		mysql_query("UPDATE players SET losses=losses+1, battle=0, last_battle=".$stat['battle']." hp_now=0 WHERE id='".$stat['id']."'");

		mysql_query("UPDATE participants SET live=1, hp=0 WHERE time='".$stat['battle']."' AND id='".$stat['id']."'");
		// 		mysql_query("update offers set winner=".()." where time=".$stat['battle']);

		require_once("inc/chat/functions.php");
		insert_msg ("Бой закончен, Вы проиграли. Всего Вами нанесено урона: <b><u>".$participant['damage']." HP</u></b>.","","","1",$stat['user'],"",$stat['room']);
		$masseg = iznos();


		if ($stat['vitality']*5 != $stat[ustal_now]) {
			mysql_query("UPDATE players SET ustal_now=ustal_now+10 WHERE id='".$stat['id']."'");
		}

		if ($stat['vitality']*5 < $stat[ustal_now]) {
			mysql_query("UPDATE players SET ustal_now='".$stat['vitality']."'*5 WHERE id='".$stat['id']."'"); // повышаем виталити
		}

		if ($masseg) insert_msg ($masseg,"","","1",$stat['user'],"",$stat['room']); // чуваааак, что ты натворил?!


		if ($offer['blood'] == 1) { mysql_query("UPDATE players SET travma=$now+3600 WHERE  id='".$stat['id']."'"); } // и по ебалу обухом...
		if ($offer[stavka]>=0) { $stvs=mysql_query("Update players set credits=credits-".$offer[stavka]." where id='".$stat[id]."'"); } // пиздим бабло у азартника
		if ($opp_stat['rank'] == 60 && $opponent) { // куясе, бот халявит
			mysql_query("UPDATE `players` SET `wins` = `wins` + '1', `battle` = 0, `last_battle`=".$stat['battle'].", `hp_now` = '".$opp_hp_max."' WHERE `id` = '".$opp_stat['id']."'"); }
			$endbattle = 1;
			$stat['last_battle'] = $stat['battle'];
			$stat['battle'] = '';

	}

	// ----- # ПОБЕДА твоей КОМАНДЫ # ----- //
	elseif (($user_command['count'] > 0 && $user_opponent_command['count'] == 0) && !$endbattle && $participant['live']!=1) {

		//$echo="<center><b>Поздравляем, Вы одержали победу!</b><br><input type=button value='Вернуться' onclick='disabled = true; window.location.href=\"main.php?tmp=\"+Math.random();\"\"' class=input></center><br>";
		$ebtype='win';//$page='showbupdate';
		mysql_query("UPDATE players SET last_battle=".$stat['battle']." WHERE battle='".$stat['battle']."'");

		mysql_query("UPDATE battles_stat SET a=0, d=0, u=0, k=0 WHERE u_id = $stat[id]");

		mysql_query("UPDATE participants SET live=1 WHERE time='".$stat['battle']."' AND side='".$opp_side."'");

		get_exp();

		require_once("inc/chat/functions.php");
		//insert_msg("<script language='javascript'>endbattle(".$stat['battle'].");</script>");
		insert_msg("Поздравляем, Вы одержали победу! Всего Вами нанесено урона: <b><u>".$participant['damage']." HP</u></b>. Получено опыта: <b><u>".$addexp."</u></b> и <b><u>".$cr."</u></b> зм.","","","1",$stat['user'],"",$stat['room']);
		mysql_query('INSERT INTO battles (offer,time,id,type,comment1)VALUES('.$stat['battle'].','.time().','.($max1['id']+1).',2,\'Персонаж '.$stat['user'].' получил '.$addexp.' единиц опыта и <b><u>'.$cr.'</u></b> зм.<br>\')');
		if ($stat['exp']+$addexp >= $stat['next_exp'] && $stat['next_exp']!=0) {

			$new_exp=$stat['exp']+$addexp;

			$up_level=mysql_fetch_array(mysql_query("SELECT level, credits, updates FROM levels WHERE exp=".$stat['next_exp'].""));
			$new_exp=mysql_fetch_array(mysql_query("SELECT exp FROM levels WHERE exp>".$stat['next_exp']." ORDER BY level LIMIT 1"));
			if (!$new_exp['exp']) $new_exp['exp']=0;
			if ($stat['level']==$up_level['level'])
			insert_msg("Поздравляем, Вы получили новое повышение","","","1",$stat['user'],"",$stat['room']);
			elseif ($stat['level']<$up_level['level'])
			insert_msg("Поздравляем, Вы получили новый уровень","","","1",$stat['user'],"",$stat['room']);

			mysql_query("update players set wins=wins+1, battle=0, last_battle=".$stat['battle'].", exp=exp+".$addexp.", credits=credits+$cr, next_exp=".$new_exp['exp'].", s_updates=s_updates+".$up_level['updates'].", credits=credits+".$up_level['credits'].", level=".$up_level['level']." WHERE id='".$stat['id']."'");

			mysql_query("UPDATE participants SET live=1 WHERE time='".$stat['battle']."' AND id='".$stat['id']."'");
		}
		else {
			mysql_query("UPDATE players SET wins=wins+1, battle=0, last_battle=".$stat['battle'].", exp=exp+'".$addexp."', credits=credits+$cr where id='".$stat['id']."'");

			mysql_query("UPDATE participants SET live=1 WHERE time='".$stat['battle']."' AND id='".$stat['id']."'");
		}


		if ($offer['blood'] == 1) { mysql_query("UPDATE players SET travma=$now+3600 WHERE battle='".$stat['battle']."' AND side='".$opp_side."'"); }
		if ($opp_stat['rank'] == 60 && $opponent) {
			mysql_query("UPDATE `players` SET `losses` = `losses` + '1', `battle` = 0, `last_battle`=".$stat['battle'].", `hp_now` = '".$opp_hp_max."' WHERE `id` = '".$opp_stat['id']."'"); }
			$endbattle = 1;
			$stat['last_battle'] = $stat['battle'];
			$stat['battle'] = '';
	}

	// ----- # ЖДЁМ ОКОНЧАНИЯ БОЯ # ----- // ипать - трупак //
	elseif ($user_command['count'] > 0 && $user_opponent_command['count'] > 0) {
		$echo="<center><b>К сожалению, для Вас бой окончен. Ожидайте окончания боя...</b><br><input type=button value='Обновить' name=ref onclick='ref.disabled = true; window.location.href=\"battle.php?tmp=\"+Math.random();\"\"' class=input></center><br>";
	}




} else {
	$opponents=mysql_query(
    "select players.id,players.user from participants, players
       where players.id=participants.id
           and participants.hp>0
           and players.hp_now>0
            and participants.live=0
       and participants.time=".$stat['battle']."
       and participants.side=".(1-$participant['side'])."");

	if ($opponents && mysql_num_rows($opponents)) {
		$victims=array();
		while ($opponent=mysql_fetch_array($opponents)) {
			$user_turn=mysql_fetch_array(
			mysql_query(
          "select * from battles
            where offer=$stat[battle]
              and attacker='$stat[user]'
              and type = 0"));
			if (!$user_turn)
			$victims[] = $opponent[user];
		}
		$count_opponents=count($victims);
		if (!$count_opponents) { // вражина сбежала (~.~)

			$max=mysql_fetch_array(mysql_query("SELECT time FROM battles WHERE offer={$stat['battle']} ORDER BY `id` DESC, time ASC LIMIT 1"));
			$timeout=$offer['timeout']-(time()-$max['time']);

		} else {
			$random=0; // rand(0,$count_opponents-1);
			$max_=mysql_fetch_array(mysql_query("SELECT time, offer FROM battles WHERE offer={$stat['battle']}  ORDER BY `id` DESC, time ASC LIMIT 1"));
			$timeout=$offer['timeout']-(time()-$max_['time']);
			// ----- # Конец # ----- //

			if ($timeout>0 || $max_['time']==''){
				$random = rand(0,$count_opponents-1);
				$p_s = mysql_fetch_array(mysql_query("SELECT * FROM battles_stat WHERE u_id = $stat[id]"));
				// $form="";
				$receptions = '';
				$test_p = mysql_query("SELECT priemy.name, priemy.img FROM priemy WHERE lvl<=".$stat['level']."");
				$f == 0;
				while ($check = mysql_fetch_array($test_p)) {
					$f++;
					$receptions .= "<input type=image alt = \\'$check[name]\\' ";
					if ($access[$f] == 0) {
						$receptions.=" disabled = true src=\\'i/priemy/".$check[img]."_off.gif\\'";
						// $form="".$form." disabled = true src='i/priemy/2.gif'";
					}
					else {
						$receptions.=" src=\\'i/priemy/$check[img].gif\\'";
					}
					$receptions.=" onclick=\\'disabled = true; window.location.href=\"battle.php?page=battle&p=$f&enemy=$victims[$random]&tmp=\"+Math.random();\"\"\\' class=input>";
				}
				$receptions.=" </center>";
			}
		}

	} else {

		// ----- # Выигрыш # ----- //
		if (!$endbattle) {

			//$echo="<center><b>Поздравляем! Победа за Вами!</b><br><input type=button value='Вернуться' onclick='disabled = true; window.location.href=\"main.php?tmp=\"+Math.random();\"\"' class=input></center><br>";
			$echo="<script language='javascript'>endbattle(".$stat['battle'].");</script>";
			$ebtype='win';$page='showbupdate';
			mysql_query("UPDATE players SET last_battle=".$stat['battle']." WHERE battle='".$stat['battle']."' AND side='".$opp_side."'");

			mysql_query("UPDATE battles_stat SET a=0, d=0, u=0, k=0 WHERE u_id = $stat[id]");

			mysql_query("UPDATE participants SET hp=0 WHERE time='".$stat['battle'].$opp_stat['id']."' AND side='".$opp_side."'");

			get_exp();

			require_once("inc/chat/functions.php");
			insert_msg("Поздравляем, Вы одержали победу! Всего Вами нанесено урона: <b><u>".$participant['damage']." HP</u></b>. Получено опыта: <b><u>".$addexp."</u></b> и <b><u>".$cr."</u></b> зм.","","","1",$stat['user'],"",$stat['room']);
			if($addexp>0) mysql_query('INSERT INTO battles (offer,time,id,type,comment1)VALUES('.$stat['battle'].','.time().','.($max1['id']+1).',2,\'Персонаж <b>'.$stat['user'].'</b> получил '.$addexp.' единиц опыта и <b><u>'.$cr.'</u></b> зм, нанес '.$participant['damage'].' единиц урона.<br>\')');
			if ($stat['exp']+$addexp >= $stat['next_exp'] && $stat['next_exp']!=0) {
				$new_exp=$stat['exp']+$addexp;

				$up_level=mysql_fetch_array(mysql_query("SELECT level, credits, updates FROM levels WHERE exp=".$stat['next_exp'].""));
				$new_exp=mysql_fetch_array(mysql_query("SELECT exp FROM levels WHERE exp>".$stat['next_exp']." ORDER BY level LIMIT 1"));
				if (!$new_exp['exp']) $new_exp['exp']=0;
				if ($stat['level']==$up_level['level'])
				insert_msg("Поздравляем, Вы получили новое повышение","","","1",$stat['user'],"",$stat['room']);
				elseif ($stat['level']<$up_level['level'])
				insert_msg("Поздравляем, Вы получили новый уровень","","","1",$stat['user'],"",$stat['room']);

				mysql_query("update players set wins=wins+1, battle=0, last_battle=".$stat['battle'].", exp=exp+".$addexp.", credits=credits+$cr, next_exp=".$new_exp['exp'].", s_updates=s_updates+".$up_level['updates'].", credits=credits+".$up_level['credits'].", level=".$up_level['level']." WHERE id='".$stat['id']."'");

				mysql_query("UPDATE participants SET live=1 WHERE time='".$stat['battle']."' AND id='".$stat['id']."'");

			}
			else {
				mysql_query("UPDATE players SET wins=wins+1, battle=0, last_battle=".$stat['battle'].", exp=exp+'".$addexp."', credits=credits+$cr where id='".$stat['id']."'");

				mysql_query("UPDATE participants SET live=1 WHERE time='".$stat['battle']."' AND id='".$stat['id']."'");

			}

			if ($opp_stat['drop'] > 0) {
				$D_S = mysql_query("SELECT * FROM participants WHERE time='".$stat['battle']."' AND id NOT LIKE '".$stat['id']."' ");
				while ($D_SA = mysql_fetch_array($D_S)) {
					$d_ss ++;
					$d_id = $D_SA[id];
					$D_SPA = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE id=$d_id "));
					$drop = $D_SPA[drop];

					$D_PS = mysql_fetch_array(mysql_query("SELECT * FROM `drop` WHERE `p_drop` = $drop "));
					$name = $D_PS["name"];
					$r_name = $D_PS["rus_name"];
					$chance = $D_PS[chance];
					$ing = $D_PS[kol_ing];
					$p_drop = $D_PS[p_drop];

					$ch = rand(1,$chance);
					if ($drop == $p_drop) {
						if ($ch == 1) {
							$buyitem_res = mysql_query("SELECT * FROM `items` WHERE `name` = '$name' ");

							if (mysql_num_rows($buyitem_res)) {

								$buyitem = mysql_fetch_array($buyitem_res);
								$inf = "".$buyitem['name']."|".$buyitem['title']."|".$buyitem['price']."|0|".$secondary."|".$buyitem['art']."|0|".$buyitem['iznos']."";

								$min = "".$buyitem['min_level']."|".$buyitem['min_str']."|".$buyitem['min_dex']."|".$buyitem['min_ag']."|".$buyitem['min_vit']."|".$buyitem['min_razum']."|".$buyitem['min_rase']."|".$buyitem['min_proff']."";

								$result2 = mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`about`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."','".$buyitem['about']."')");
								require_once("inc/chat/functions.php");
								insert_msg("На поле боя вы обнаружили предмет <b>\"$r_name\"</b> и ловко подобрали его!","","","1",$stat[user],"",$stat[room]);
							}



							//$kol_ing = rand(1,$ing);
							//require_once("inc/chat/functions.php");
							//insert_msg("На поле боя вы обнаружили <b>\"$r_name\" $kol_ing шт.</b> и ловко подобрали его!","","","1",$stat[user],"",$stat[room]);

							//mysql_query("UPDATE players SET $name=$name+$kol_ing WHERE id='".$stat['id']."'");

						}
					}
				}
			}

			if ($opp_stat['drop_i'] > 0) {
				$D_S = mysql_query("SELECT * FROM participants WHERE time='".$stat['battle']."' AND id NOT LIKE '".$stat['id']."' ");
				while ($D_SA = mysql_fetch_array($D_S)) {
					$d_ss ++;
					$d_id = $D_SA[id];
					$D_SPA = mysql_fetch_array(mysql_query("SELECT * FROM players WHERE id=$d_id"));
					$drop_i = $D_SPA[drop_i];

					$D_PS = mysql_fetch_array(mysql_query("SELECT * FROM `drop_i` WHERE `p_drop` = '$drop_i'"));
					$p_drop = $D_PS[p_drop];
					$name = $D_PS["name"];
					$r_name = $D_PS["rus_name"];
					$chance = $D_PS[chance];

					$ch = rand(1,$chance);
					if ($drop_i == $p_drop) {
						if ($ch == 1) {

							$buyitem_res = mysql_query("SELECT * FROM `items` WHERE `name` = '$name' ");

							if (mysql_num_rows($buyitem_res)) {

								$buyitem = mysql_fetch_array($buyitem_res);
								$inf = "".$buyitem['name']."|".$buyitem['title']."|".$buyitem['price']."|0|".$secondary."|".$buyitem['art']."|0|".$buyitem['iznos']."";

								$min = "".$buyitem['min_level']."|".$buyitem['min_str']."|".$buyitem['min_dex']."|".$buyitem['min_ag']."|".$buyitem['min_vit']."|".$buyitem['min_razum']."|".$buyitem['min_rase']."|".$buyitem['min_proff']."";

								$result2 = mysql_query("INSERT INTO `objects` (`user`,`inf`,`min`,`tip`,`br1`,`br2`,`br3`,`br4`,`br5`,`min_d`,`max_d`,`hp`,`energy`,`strength`,`dex`,`agility`,`vitality`,`razum`,`krit`,`unkrit`,`uv`,`unuv`,`time`,`about`) VALUES ('".$stat['user']."','".$inf."','".$min."','".$buyitem['tip']."','".$buyitem['br1']."','".$buyitem['br2']."','".$buyitem['br3']."','".$buyitem['br4']."','".$buyitem['br5']."','".$buyitem['min']."','".$buyitem['max']."','".$buyitem['hp']."','".$buyitem['energy']."','".$buyitem['strength']."','".$buyitem['dex']."','".$buyitem['agility']."','".$buyitem['vitality']."','".$buyitem['razum']."','".$buyitem['krit']."','".$buyitem['unkrit']."','".$buyitem['uv']."','".$buyitem['unuv']."','".time()."','".$buyitem['about']."')");
								require_once("inc/chat/functions.php");
								insert_msg("На поле боя вы обнаружили предмет <b>\"$r_name\"</b> и ловко подобрали его!","","","1",$stat[user],"",$stat[room]);
							}

						}
					}
				}
			}

			if ( ($stat['room'] >= 701 && $stat['room'] <= 745) || ($opp_stat['room'] >= 701 && $opp_stat['room'] <= 745) ) {
				$kol = rand(1,2);
				$r_o = rand(1,6);
				if ( $r_o == 1 ) {
					if ( $opp_stat['ing_okun'] >= $kol ) {
						mysql_query("UPDATE players SET ing_okun=ing_okun+$kol where id='".$stat['id']."'");
						mysql_query("UPDATE players SET ing_okun=ing_okun-$kol where id='".$opp_stat['id']."'");

						require_once("inc/chat/functions.php");
						insert_msg("В лодке у убитого вы нашли <b>\"Окунь\"</b> <b>$kol</b> шт. ","","","1",$stat['user'],"",$stat['room']);
						insert_msg("Вашу лодку обыскали и забрали <b>\"Окунь\"</b> <b>$kol</b> шт. ","","","1",$opp_stat['user'],"",$opp_stat['room']);
					}
				}
				elseif ( $r_o == 2 ) {
					if ( $opp_stat['ing_osetr'] >= $kol ) {
						mysql_query("UPDATE players SET ing_osetr=ing_osetr+$kol where id='".$stat['id']."'");
						mysql_query("UPDATE players SET ing_osetr=ing_osetr-$kol where id='".$opp_stat['id']."'");

						require_once("inc/chat/functions.php");
						insert_msg("В лодке у убитого вы нашли <b>\"Осётр\"</b> <b>$kol</b> шт. ","","","1",$stat['user'],"",$stat['room']);
						insert_msg("Вашу лодку обыскали и забрали <b>\"Осётр\"</b> <b>$kol</b> шт. ","","","1",$opp_stat['user'],"",$opp_stat['room']);
					}
				}
				elseif ( $r_o == 3 ) {
					if ( $opp_stat['ing_stavrida'] >= $kol ) {
						mysql_query("UPDATE players SET ing_stavrida=ing_stavrida+$kol where id='".$stat['id']."'");
						mysql_query("UPDATE players SET ing_stavrida=ing_stavrida-$kol where id='".$opp_stat['id']."'");

						require_once("inc/chat/functions.php");
						insert_msg("В лодке у убитого вы нашли <b>\"Ставрида\"</b> <b>$kol</b> шт. ","","","1",$stat['user'],"",$stat['room']);
						insert_msg("Вашу лодку обыскали и забрали <b>\"Ставрида\"</b> <b>$kol</b> шт. ","","","1",$opp_stat['user'],"",$opp_stat['room']);
					}
				}
				elseif ( $r_o == 4 ) {
					if ( $opp_stat['ing_narval'] >= $kol ) {
						mysql_query("UPDATE players SET ing_narval=ing_narval+$kol where id='".$stat['id']."'");
						mysql_query("UPDATE players SET ing_narval=ing_narval-$kol where id='".$opp_stat['id']."'");

						require_once("inc/chat/functions.php");
						insert_msg("В лодке у убитого вы нашли <b>\"Нарвал\"</b> <b>$kol</b> шт. ","","","1",$stat['user'],"",$stat['room']);
						insert_msg("Вашу лодку обыскали и забрали <b>\"Нарвал\"</b> <b>$kol</b> шт. ","","","1",$opp_stat['user'],"",$opp_stat['room']);
					}
				}
				elseif ( $r_o == 5 ) {
					if ( $opp_stat['ing_kefal'] >= $kol ) {
						mysql_query("UPDATE players SET ing_kefal=ing_kefal+$kol where id='".$stat['id']."'");
						mysql_query("UPDATE players SET ing_kefal=ing_kefal-$kol where id='".$opp_stat['id']."'");

						require_once("inc/chat/functions.php");
						insert_msg("В лодке у убитого вы нашли <b>\"Кефаль\"</b> <b>$kol</b> шт. ","","","1",$stat['user'],"",$stat['room']);
						insert_msg("Вашу лодку обыскали и забрали <b>\"Кефаль\"</b> <b>$kol</b> шт. ","","","1",$opp_stat['user'],"",$opp_stat['room']);
					}
				}

			}


			if ($offer['blood'] == 1) { mysql_query("UPDATE players SET travma=$now+10800 WHERE battle='".$stat['battle']."' AND side='".$opp_side."'"); }
			if ($offer[stavka]>=0) { $stv=mysql_query("Update players set credits=credits+'".$offer[stavka]."' where id='".$stat[id]."'"); }
			if ($opp_stat['rank'] == 60 && $opponent) {
				mysql_query("UPDATE `players` SET `losses` = `losses` + '1', `battle` = 0, `last_battle` = '".$stat['battle']."', `hp_now` = '".$opp_hp_max."' WHERE `id` = '".$opp_stat['id']."'"); }
				$endbattle = 1;
				$stat['last_battle'] = $stat['battle'];
				$stat['battle'] = '';
		}
		// ----- # Конец # ----- //
	}
}

if(!strlen($bbid)>0) $bbid=$stat['battle'];
if(!strlen($bbid)>0) $bbid=$_RESERVER['battle'];
if(!strlen($bbid)>0){
	$arrr=mysql_fetch_array(mysql_query('select time from participants where id='.$stat['id'].' order by time desc limit 1'));
	$bbid=$arrr['time'];
	unset($arrr);
}
echo mysql_error();
?>
