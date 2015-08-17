<?
function get_zone($szone){
	switch ($szone){
		case 1: return 'h';break;
		case 2: return 't';break;
		case 3: return 'l';break;
		case 4: return 'r';break;
		case 5: return 'le';break;
	}
}

function getcomment($kick,$krt,$side,$attacker,$defender,$damage,$comhp,$adv){
	if(empty($kick)){$kick=rand(1,5);}
	switch ($kick) {
		case 1: $str = "в голову";        break;
		case 2: $str = "в корпус";        break;
		case 3: $str = "по правой руке";        break;
		case 4: $str = "по левой руке";                break;
		case 5: $str = "по ногам";        break;
	}

	switch ($krt) {
		case 0: $com_color="000000"; break;
		case 1: $com_color="RED"; break;
	}

	$partic_color='blue';
	$enemy_color='red';
	if($side==0){
		$partic_color='blue';
		$enemy_color='red';
	}

	$cma[0]="<b><font color=$partic_color>$attacker</font></b> ударил $str <b><font color=$enemy_color>$defender</font></b> 	на: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	$cma[1]="<b><font color=$partic_color>$attacker</font></b> саданул точный удар $str, несмотря на то, что наглый <b><font color=$enemy_color>$defender</font></b> хотел уйти от удара: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	$cma[2]="<b><font color=$partic_color>$attacker</font></b> влепил мощный удар $str, несмотря на все усилия <b><font color=$enemy_color>$defender</font></b> избежать этого: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	//$cma[3]="<b><font color=$enemy_color>$defender</font></b> явно неодоценил силы противника... Как результат: <b><font color=$partic_color>$attacker</font></b> нанёс тяжелейший удар $str: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	//$cma[4]="Почувствовав нерешительность <b><font color=$enemy_color>$defender</font></b>, разъярённый <b><font color=$partic_color>$attacker</font></b> со всего размаху ударил $str: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	//$cma[5]="<b><font color=$enemy_color>$defender</font></b> совершил роковую ошибку, подойдя вплотную к <b><font color=$partic_color>$attacker</font></b>, на что тот ответил незамедлительным ударом $str: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	//$cma[6]="<b><font color=$enemy_color>$defender</font></b> предпринял неудачную попытку заблокировать удар, за что и поплатился. Яростный <b><font color=$partic_color>$attacker</font></b> нанес точнейший удар $str: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";
	$cma[3]="<b><font color=$partic_color>$attacker</font></b>, увидев страх в глазах противника, незамедлительно нанёс сокрушительный удар $str <b><font color=$enemy_color>$defender</font></b>: <b style=\"COLOR: $com_color\">-$damage</b> [$defender: $comhp]";

	$cmb[0]="<b><font color=$partic_color>$attacker</font></b> хотел вломить $str, но <b><font color=$enemy_color>$defender</font></b>, не напрягаясь, заблокировал удар, или броня поглотила удар";
	$cmb[1]="<b><font color=$partic_color>$attacker</font></b> изо всех сил пытался вломить, но <b><font color=$enemy_color>$defender</font></b> увел удар $str";
	$cmb[2]="<b><font color=$partic_color>$attacker</font></b> призадумался, благодаря чему сообразительный <b><font color=$enemy_color>$defender</font></b>, сменив тактику, заблокировал удар $str";
	$cmb[3]="Силы потраченные <b><font color=$partic_color>$attacker</font></b> для удара $str не принесли ему успеха, и как следствие <b><font color=$enemy_color>$defender</font></b> заблокировал удар";
	$cmb[4]="<b><font color=$enemy_color>$defender</font></b> ушел в глухую оборону и как следствие заблокировал удар <b><font color=$partic_color>$attacker</font></b> $str";
	$cmb[5]="Замысел <b><font color=$partic_color>$attacker</font></b> легко читался и прозорливый <b><font color=$enemy_color>$defender</font></b> увел удар $str";
	$cmb[6]="Силы были равны... Но обороняющийся <b><font color=$enemy_color>$defender</font></b> оказался немного хитрее и поэтому заблокировал удар <b><font color=$partic_color>$attacker</font></b> $str";
	$cmb[7]="Атакующий <b><font color=$partic_color>$attacker</font></b> размахнулся, но всё было сделано настолько медленно, что <b><font color=$enemy_color>$defender</font></b> заблокировал удар $str";


	if($damage>0) $comment = $cma[rand(0,0)];
	else{
		if ($adv == 2) $comment = "<b><font color=$partic_color>$attacker</font></b> попытался нанести жестокий удар $str, но ловкий <b><font color=$enemy_color>$defender</font></b> <b><font color=green>увернулся</font></b> от удара";
		else $comment = $cmb[rand(0,0)];
	}
	return $comment;
}

function closest4bot($bx,$by,$bside){
	//global $stat,$max1,$link;
	global $stat,$max1;
	$t_sys=array(1,1,100,''); // первые 2 значения отвечают за координаты и последняя - расстояние
	$do_SQL='SELECT `participants`.`x`,`participants`.`y`,`players`.`user`,`battles`.`x` as `bx`,`battles`.`y` as `by` FROM `participants`,`players`,`battles` WHERE `participants`.`time`='.$stat['battle'].' AND `participants`.`side`='.(1-$bside).' AND `participants`.`hp`>0 AND `players`.`id`=`participants`.`id` AND `battles`.`id`='.($max1['id']+1).' AND `battles`.`offer`='.$stat['battle'].' AND `battles`.`attacker`=`players`.`user` and players.hp_now>0';
	$get=mysql_query($do_SQL);
	while($cords=mysql_fetch_array($get)){
		if(is_numeric($cords['bx']) && is_numeric($cords['by']))
		$tdist=dist($bx,$by,$cords['bx'],$cords['by']);
		else
		$tdist=dist($bx,$by,$cords['x'],$cords['y']);
		//echo 'Дистанция между ботом и целью: '.$tdist.'<br>';
		if($tdist<$t_sys[2]){
			$t_sys[0]=$cords['x'];
			$t_sys[1]=$cords['y'];
			$t_sys[2]=$tdist;
			$t_sys[3]=$cords['user'];
			//echo 'success!!<br>';
		}
	}


	return $t_sys;
}

// отсюда начинаем подсчет дамаги\переходо, ходов кроч
//$op_partic_count=5;
//$op_bat_count=0;
$op_partic_count = mysql_num_rows(mysql_query("select players.id from players,participants where players.battle='{$stat['battle']}' AND players.rank <> '60' AND players.hp_now > '0' AND players.id=participants.id AND participants.time='{$stat['battle']}' AND participants.frozen=0 and participants.hp>0"));// считаем кол-во человек находящихся в бою
$battles_sql = mysql_query("select * from battles where offer='$stat[battle]' AND type = '0' ORDER BY id DESC LIMIT 0,$op_partic_count");
$op_bat_count = mysql_num_rows($battles_sql); // считаем кол-во записей на ход
$max1=@mysql_fetch_array(mysql_query("SELECT time,id FROM battles WHERE offer='".$stat['battle']."' AND type='1' OR type='2' ORDER BY time DESC LIMIT 1"));

//global $op_partic_count,$op_bat_count,$max1;	
//$bot_bat_count=mysql_num_rows(mysql_query('SELECT players.user FROM players,participants WHERE players.rank=60 AND participants.id=players.id AND participants.time='.$stat['battle']));
//echo $op_bat_count.' == '.$op_partic_count;
if($op_bat_count >= $op_partic_count){ // если ходов >= игроков

	// здесь проверяем есть ли в бою боты и вносим изменения, и если они есть то в обязательном порядке делаем $op_partic_count+=$bots_count;
	$bots = mysql_query('select participants.side,
							participants.hp,
							participants.x,
							participants.y,
							players.user 
					from 
							participants,
							players 
					where 
							participants.time='.$stat['battle'].'
							and
							players.id=participants.id
							and
							players.rank=60 and participants.hp > 0 and players.hp_now>0');
	if($bots){
		// ходим
		while ($bot=mysql_fetch_array($bots)){
			$btarget=closest4bot($bot['x'],$bot['y'],$bot['side']);
			if($btarget[2]>1){ // расстояние больше единицы, ходим
//echo 'Кординаты цели: '.$btarget[0].' '.$btarget[1].'<br>';
				// вычисляем ближлежащие точки
				$mbY=array($bot['y']-1,$bot['y']-1,$bot['y'],$bot['y'],$bot['y']+1,$bot['y']+1);
				if($bot['y']%2==0)
				$mbX=array($bot['x']-1,$bot['x'],$bot['x']-1,$bot['x']+1,$bot['x']-1,$bot['x']);
				else
				$mbX=array($bot['x'],$bot['x']+1,$bot['x']-1,$bot['x']+1,$bot['x'],$bot['x']+1);

				$tx=$bot['x']-$btarget[0];
				$ty=$bot['y']-$btarget[1];

				if($tx<0) $tx=1; else $tx=0;
				if($ty<0) $ty=-1; elseif ($ty>0) $ty=1;

				$index=(abs($ty-1))*2+$tx; // получаем индекс для массивов
				//echo $bot['user'].' '.$index.' '.$zones[$index].'<BR>';
				// поправка на свободную локу
				$zones=array(0,0,0,0,0,0);
				$checksz=mysql_query('SELECT `participants`.`x`,`participants`.`y` FROM `participants` WHERE `participants`.`frozen`=0 AND `participants`.`time`='.$stat['battle'].' and participants.hp>0 UNION SELECT `battles`.`x`,`battles`.`y` FROM `battles` WHERE `battles`.`offer`='.$stat['battle'].' AND `battles`.`type`=0 UNION SELECT `obstacles`.`c_x` as `x`, `obstacles`.`c_y` as `y` FROM `obstacles` WHERE `obstacles`.`offer_id`='.$stat['battle']);
				while($check=mysql_fetch_array($checksz))
				for($i=0;$i<6;$i++)
				if($check['x']==$mbX[$i] && $check['y']==$mbY[$i]) $zones[$i]=1;
				//echo '<hr>';
				//echo '<HR>'.$zones[0].' '.$zones[1].' '.$zones[2].' '.$zones[3].' '.$zones[4].' '.$zones[5].'<HR>';
				if($zones[$index]==1){

					if($index%2==0){
						if($index-2>=0 && $zones[$index-2]==0 && $mbY[$index-2]>=0 && $mbX[$index-2]>=0) $index-=2;
						elseif($index+2<6 && $zones[$index+2]==0 && $mbY[$index+2]<$offer['height'] && $mbX[$index+2]<$offer['width']) $index+=2;
						elseif($index-4>=0 && $zones[$index-4]==0 && $mbY[$index-4]>=0 && $mbX[$index-4]>=0) $index-=4;
						elseif($index+4<6 && $zones[$index+4]==0 && $mbY[$index+4]<$offer['height'] && $mbX[$index+4]<$offer['width']) $index+=4;
						elseif($index-1>=0 && $zones[$index-1]==0 && $mbY[$index-1]>=0 && $mbX[$index-1]>=0) $index--;
						elseif($index+1<6 && $zones[$index+1]==0 && $mbY[$index+1]<$offer['height'] && $mbX[$index+1]<$offer['width']) $index++;
						elseif($index-3>=0 && $zones[$index-3]==0 && $mbY[$index-3]>=0 && $mbX[$index-3]>=0) $index-=3;
						elseif($index+3<6 && $zones[$index+3]==0 && $mbY[$index+3]<$offer['height'] && $mb[$index+3]<$offer['width']) $index+=3;
						elseif($index-5>=0 && $zones[$index-5]==0 && $mbY[$index-5]>=0 && $mbX[$index-5]>=0) $index-=5;
						elseif($index+5<6 && $zones[$index+5]==0 && $mbY[$index+5]<$offer['height'] && $mb[$index+5]<$offer['width']) $index+=5;
					}else{
						if($index+1<6 && $zones[$index+1]==0 && $mbY[$index+1]<$offer['height'] && $mbX[$index+1]<$offer['width']) $index++;
						elseif($index-1>=0 && $zones[$index-1]==0 && $mbY[$index-1]>=0 && $mbX[$index-1]>=0) $index--;
						elseif($index+3<6 && $zones[$index+3]==0 && $mbY[$index+3]<$offer['height'] && $mb[$index+3]<$offer['width']) $index+=3;
						elseif($index-3>=0 && $zones[$index-3]==0 && $mbY[$index-3]>=0 && $mbX[$index-3]>=0) $index-=3;
						elseif($index+5<6 && $zones[$index+5]==0 && $mbY[$index+5]<$offer['height'] && $mb[$index+5]<$offer['width']) $index+=5;
						elseif($index-5>=0 && $zones[$index-5]==0 && $mbY[$index-5]>=0 && $mbX[$index-5]>=0) $index-=5;
						elseif($index+2<6 && $zones[$index+2]==0 && $mbY[$index+2]<$offer['height'] && $mbX[$index+2]<$offer['width']) $index+=2;
						elseif($index-2>=0 && $zones[$index-2]==0 && $mbY[$index-2]>=0 && $mbX[$index-2]>=0) $index-=2;
						elseif($index+4<6 && $zones[$index+4]==0 && $mbY[$index+4]<$offer['height'] && $mbX[$index+4]<$offer['width']) $index+=4;
						elseif($index-4>=0 && $zones[$index-4]==0 && $mbY[$index-4]>=0 && $mbX[$index-4]>=0) $index-=4;
					}
				}
				//echo('<BR>'.$index);
				// ставим блоки
				//echo('<BR>'.$zones[0].' '.$zones[1].' '.$zones[2].' '.$zones[3].' '.$zones[4]);
				$zones4block=array(1,2,3,4,5);
				$zones4block[rand(0,4)]='';
				sort($zones4block);
				array_shift($zones4block);
				//echo $index.'|';
				mysql_query('INSERT INTO `battles` (`offer`,`time`,`id`,`attacker`,`defender`,`side`,`x`,`y`,`type`,`lblock1`,`lblock2`,`rblock1`,`rblock2`)VALUES('.$stat['battle'].','.(time()+1).','.($max1['id']+1).',\''.$bot['user'].'\',\''.$btarget[3].'\','.$bot['side'].','.$mbX[$index].','.$mbY[$index].',0,'.$zones4block[0].','.$zones4block[1].','.$zones4block[2].','.$zones4block[3].');');
			}else{
				$wd=floor(rand(0,89)/35); // what do, ну типа удар\(блок+удар)\блок
				if($wd==0){
					$lkick=rand(1,5);
					$rkick=rand(1,5);
					$lblock=array(NULL,NULL);
					$rblock=array(NULL,NULL);
				}elseif($wd==1){
					$lkick=rand(1,5);
					$rkick=NULL;
					$lblock=array(rand(1,5),NULL);
					$rblock=array(rand(1,5),NULL);
				}else{
					$lkick=NULL;
					$rkick=NULL;
					$lblock=array(rand(1,5),rand(1,5));
					$rblock=array(rand(1,5),rand(1,5));
				}
				mysql_query('INSERT INTO `battles` (`offer`,`time`,`id`,`attacker`,`defender`,`lkick`,`rkick`,`lblock1`,`lblock2`,`rblock1`,`rblock2`,`side`)
                               VALUES('.$stat['battle'].','.(time()+1).','.($max1['id']+1).',\''.$bot['user'].'\',\''.$btarget[3].'\',\''.$lkick.'\',\''.$rkick.'\',\''.$lblock[0].'\',\''.$lblock[1].'\',\''.$rblock[0].'\',\''.$rblock[1].'\','.$bot['side'].');');
			}
		}

	}
	//die('<br>Брек пойнт');
	//$battles_sql = mysql_query("select * from battles where offer='".$stat['battle']."' AND type = 0 ORDER BY id DESC LIMIT 0,$op_partic_count");
	$battles_sql = mysql_query("select * from battles where offer='".$stat['battle']."' AND type = '0' ORDER BY id DESC");
	$opp=@mysql_fetch_array($battles_sql);

	while(($partic_step=@mysql_fetch_array($battles_sql)) || ($partic_step=$opp)){
		if (!array_diff($partic_step,$opp)) unset($opp); 
		// ---- # Получаем параметры персонажа # ---- //
		$enemy_stat=mysql_fetch_array(mysql_query("SELECT 	`players`.*,
	`participants`.`damaged_h` as `1`, 
	`participants`.`damaged_t` as `2`, 
	`participants`.`damaged_l` as `3`, 
	`participants`.`damaged_r` as `4`, 
	`participants`.`damaged_le` as `5`,
	`participants`.`frozen`
FROM 
	`players`,
	`participants` 
WHERE 
	`players`.`user`='{$partic_step['defender']}' 
		AND 
	`participants`.`id`=`players`.`id` and participants.hp>0 and players.hp_now>0 
order by `participants`.`time` DESC limit 1")); 
		$enemy_stat2=mysql_fetch_array(mysql_query("SELECT
	`battles`.`lblock1`,
	`battles`.`lblock2`,
	`battles`.`rblock1`,
	`battles`.`rblock2`,
	`battles`.`priem`
FROM
	`battles`
WHERE
	`battles`.`attacker`='{$partic_step['defender']}' 
AND
	`battles`.`offer`='".$stat['battle']."' 
ORDER BY `battles`.`time` DESC LIMIT 1"));

		include("inc/battle/params_enemy.php");
		$partic_stat=mysql_fetch_array(mysql_query("SELECT `players`.*, `participants`.`damaged_h`, `participants`.`damaged_t`, `participants`.`damaged_l`, `participants`.`damaged_r`, `participants`.`damaged_le`,`participants`.`x`,`participants`.`y` FROM `players`,`participants` WHERE `players`.`user`='{$partic_step['attacker']}' AND `participants`.`id`=`players`.`id` and participants.hp>0 and players.hp_now>0 order by `participants`.`time` DESC LIMIT 1"));
		include("inc/battle/params_partic.php");

		// ---- # Подсчет урона, нанесенного мною # ---- //
		unset($damage);
		if(is_numeric($partic_step['x']) && is_numeric($partic_step['y'])) $damage[0] = 0;
		else{

			foreach(array('lkick','rkick') as $kick){
				$index=(int)($kick=='lkick');
				if (($partic_step[$kick]===$enemy_stat2['lblock1'] || $partic_step[$kick]===$enemy_stat2['lblock2'] || $partic_step[$kick]===$enemy_stat2['rblock1'] || $partic_step[$kick]===$enemy_stat2['rblock2']) || $partic_step[$kick]===null || !is_numeric($partic_step[$kick]) || $partic_step[$kick]<1 || $partic_step[$kick]>5){ $damage[$index] = 0;
				// echo 'alert(\'дефолт\');';
				}else $damage[$index] = rand(($partic_stat['strength']+$partic_stat['min'])*(1+($partic_stat['ork']/100)),(1+$partic_stat['strength']+$partic_stat['max'])*(1+($partic_stat['ork']/100)));
			
			
			}
		}

		//krit
         $ch = round($partic_stat['krit']-$enemy_stat['unkrit']);
         if($ch<0) $partic_stat['dex']-=round(abs($ch)/5);
         if($ch>=100) $my_zl=$partic_stat['dex'];
         else{$my_zl=rand(0,$partic_stat['dex']);} 
          $razn=$my_zl-$enemy_stat['dex'];
          if($razn<0)$razn=0;   
         $perc = round($razn*100/$enemy_stat['dex']);
         $cha=rand(0,100);
         if($perc>$cha){
        $damage[0] *= $damage[0];
        $adv_attack[0]=1;
        $krt[0] = 1;
         }
        else{
        	$adv_attack[0]=0;
			$krt[0] = 0;
        } 
  
         $ch = round($partic_stat['krit']-$enemy_stat['unkrit']);
         if($ch<0) $partic_stat['dex']-=round(abs($ch)/5);
         if($ch>=100) $my_zl=$partic_stat['dex'];
         else{$my_zl=rand(0,$partic_stat['dex']);} 
          $razn=$my_zl-$enemy_stat['dex'];
          if($razn<0)$razn=0; 
         $perc = round($razn*100/$enemy_stat['dex']);
         $cha=rand(0,100);
         if($perc>$cha){
        $damage[1]*=$damage[1];
        $adv_attack[1]=1;
        $krt[1] = 1;
         }
        else{
        	$adv_attack[1]=0;
			$krt[1] = 0;
        } 
    
 
		
	
		// Уворот противника от "тебя"
		
         $ch = round($enemy_stat['uv']-$partic_stat['unuv']);
         if($ch<0) $partic_stat['agility']-=round(abs($ch)/5);
         if($ch>=100) $en_uv=$enemy_stat['agility'];
         else{$en_uv=rand(0,$enemy_stat['agility']);} 
          $razn=$en_uv-$partic_stat['agility'];
          if($razn<0)$razn=0;   
         $perc = round($razn*100/$partic_stat['agility']);
         $cha=rand(0,100);
         if($perc>$cha){
        $damage[0]=0;
        $adv_attack[0]=2;
        
         }
        else{
        	$adv_attack[0]=0;
		
        }
	         $ch = round($enemy_stat['uv']-$partic_stat['unuv']);
         if($ch<0) $partic_stat['agility']-=round(abs($ch)/5);
	         if($ch>=100) $en_uv=$enemy_stat['agility'];
         else{$en_uv=rand(0,$enemy_stat['agility']);} 
          $razn=$en_uv-$partic_stat['agility'];
          if($razn<0)$razn=0;   
         $perc = round($razn*100/$partic_stat['agility']);
         $cha=rand(0,100);
         if($perc>$cha){
        $damage[1]=0;
        $adv_attack[1]=2;
        
         }
        else{
        	$adv_attack[1]=0;
		
        }
	 
	
	

 
		// собственно подсчет урона
		foreach(array('lkick','rkick') as $kick){
			$index=(int)($kick=='rkick');
			if($damage[$index]>0){
				switch ($partic_step[$kick]) {
					case 1: $damage[$index]-=rand(round(1+$enemy_stat['br1']/3),1+$enemy_stat['br1']); break;
					case 2: $damage[$index]-=rand(round(1+$enemy_stat['br2']/3),1+$enemy_stat['br2']); break;
					case 3: $damage[$index]-=rand(round(1+$enemy_stat['br4']/3),1+$enemy_stat['br4']); break;
					case 4: $damage[$index]-=rand(round(1+$enemy_stat['br5']/3),1+$enemy_stat['br5']); break;
					case 5: $damage[$index]-=rand(round(1+$enemy_stat['br5']/3),1+$enemy_stat['br5']); break;
				}
				if($damage[$index]<=0) $damage[$index]=1;
				elseif($damage[$index]>$enemy_stat['hp_now']) $damage[$index]=$enemy_stat['hp_now'];
			}
		}

		$participant['damage'] += $damage['0']+$damage['1']; // подсчитываем нанесенный урон

		// HP для комментариев
		if ($enemy_stat['hp_now']<($damage[0]+$damage[1])){
			$comhp_0=($enemy_stat['hp_now']<$damage[0])?0:$enemy_stat['hp_now']-$damage[0];
			$comhp_1=0;
			$damage[0]=$enemy_stat['hp_now']-$damage[1];
		}else {
			$comhp_0=$enemy_stat['hp_now']-$damage[0];
			$comhp_1=$comhp_0-$damage[1];
		}

		if ($damage[0] > 0) $upd_udar1 = 1; else $upd_block1=1;
		if ($damage[1] > 0) $upd_udar2 = 1; else $upd_block2=1;
		//       if ($damage['1'] < 1 AND $upd_uv != 1) $upd_block = 1;

		if ($comhp_0 == 0) { // если противник оказался дохлым
			$max=mysql_fetch_array(mysql_query("SELECT MAX(id) as id FROM battles WHERE offer='".$stat['battle']."' LIMIT 1"));
			$max['id']+=1;
			if (!isset($WRITED)) mysql_query("INSERT INTO battles (offer, time, id, defender, type, comment1, side) VALUES ($stat[battle], ".$now.", '$max[id]', '$enemy_stat[user]', 2, '<b>$enemy_stat[user]</b> повержен!',$enemy_stat[bside])");
			$WRITED = 1;
		}

		// смотрим комменты
		if(is_numeric($partic_step['x']) && is_numeric($partic_step['y'])){ 
			include('inc/battle/comments_3.php');
			// определяем цвет
			   $partic_color='000';
			   $enemy_color='000';
			if($partic_step['side']==0){
				$partic_color='000';
				$enemy_color='000';
			}
			//
			$cmnt1 = '<b><font color='.$partic_color.'>'.$partic_stat['user'].'</font></b>'.$mv_com[rand(0,7)];

			// удар в спину
			$g_closest=mysql_query('SELECT
             `participants`.`id`,
             `participants`.`x`,
             `participants`.`y`, 
             `players`.`user`,
             `players`.`strength`,
             `players`.`rase_skill`
                          FROM 
             `participants`,
             `players`
                          WHERE
             `participants`.`time`='.$stat['battle'].'
                          AND
             `participants`.`side`='.(1-$partic_step['side']).'
                          AND
             `players`.`id`=`participants`.`id`
                          AND
             `players`.`bside`=`participants`.`side` and participants.hp>0 and players.hp_now>0');
			 
			while($damager=mysql_fetch_array($g_closest)){
	   if(dist($partic_stat['x'],$partic_stat['y'],$damager['x'],$damager['y'])<=1 && dist($partic_step['x'],$partic_step['y'],$damager['x'],$damager['y'])>dist($partic_stat['x'],$partic_stat['y'],$damager['x'],$damager['y'])){
	    $get_ork=explode("|",$damager['rase_skill'],1);
	    $damager['ork']=($get_ork[0])*5;
	    unset($get_ork);
	    $olabama=mysql_fetch_array(mysql_query('SELECT SUM(`objects`.`min_d`) as `min_d`, SUM(`objects`.`max_d`) as `max_d` FROM `slots`,`objects` WHERE `slots`.`id`='.$damager['id'].' AND objects.user=\''.$damager['user'].'\' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1'));
	    $silent_damage=rand(($damager['strength']/3+$olabama['min_d'])*(1+($damager['ork']/100)),(1+$damager['strength']/1.5+$olabama['max_d'])*(1+($damager['ork']/100)));
	    $partic_stat['hp_now']-=$silent_damage;
	    $cmnt='<font color='.$partic_color.'><b>'.$partic_stat['user'].'</b></font> думал отделатся легким испугом и отойти на безопастную дистанцию, но <font color='.$enemy_color.'><b>'.$damager['user'].'</b></font> нанес удар в спину: <b>-'.$silent_damage.'</b> ['.$partic_stat['user'].': '.$partic_stat['hp_now'].']';
	    mysql_query('INSERT INTO `battles` (`offer`,`time`,`id`,`type`,`defender`,`damage`,`comment1`)VALUES('.$stat['battle'].','.$partic_step['time'].','.$partic_step['id'].',2,\''.$enemy_stat['attacker'].'\','.$silent_damage.',\''.$cmnt.'\')');//||die(mysql_error().'<BR>'.'INSERT INTO `battles` (`offer`,`time`,`id`,`type`,`defender`,`damage`,`comment1`)VALUES('.$stat['battle'].','.$partic_step['time'].','.$partic_step['id'].',2,\''.$partic_step['attacker'].'\','.$silent_damage.',\''.$cmnt.'\')');
	    // засчитываем дамагу
	    //mysql_query('UPDATE `participants` SET `damage`=`damage`+'.$silent_damage.' WHERE `id`='.$damager['id'].' AND time='.$stat['battle']);
	   }
			}
			 
			//die();
		}else{
			if(is_numeric($partic_step['lkick'])) $cmnt1=getcomment($partic_step['lkick'],$krt[1],$partic_step['side'],$partic_stat['user'],$partic_step['defender'],$damage[1],$comhp_1,$adv_attack[1]);
			if(is_numeric($partic_step['rkick'])) $cmnt2=getcomment($partic_step['rkick'],$krt[0],$partic_step['side'],$partic_stat['user'],$partic_step['defender'],$damage[0],$comhp_0,$adv_attack[0]);
		}

//if(is_numeric($partic_step['lkick']))$cmnt1.=' '.$partic_stat['br1'].' '.$partic_stat['br2'].' '.$partic_stat['br4'].' '.$partic_stat['br5'];
//if(is_numeric($partic_step['rkick']))$cmnt2.=' '.$enemy_stat['br1'].' '.$enemy_stat['br2'].' '.$enemy_stat['br4'].' '.$enemy_stat['br5'];

		if(is_numeric($partic_step['x']) && is_numeric($partic_step['y'])) mysql_query("UPDATE participants set x='".$partic_step['x']."', y='".$partic_step['y']."' WHERE id='".$partic_stat['id']."'");

		$sqlf='';

		if($damage[0]>0||$damage[1]>0){
			if($partic_step['lkick']===$partic_step['rkick'] && is_numeric($partic_step['lkick'])){
				if($damage[0]>0 && $damage[1]>0) $stag_count=2; else $stag_count=1;
				$zone=get_zone($partic_step['lkick']);
				if($enemy_stat[($partic_step['lkick'])]-$stag_count>=2){
					$sqlf=', participants.damaged_'.$zone.'=participants.damaged_'.$zone.'-'.$stag_count;
					$enemy_stat[($partic_step['lkick'])]-=$stag_count;
				}elseif($enemy_stat[($partic_step['lkick'])]>1){
					$sqlf=', participants.damaged_'.$zone.'=2';
					$enemy_stat[($partic_step['lkick'])]=2;
				}
			}else{
				if($damage[1]>0) $hands[]='lkick';
				if($damage[0]>0) $hands[]='rkick';
				foreach ($hands as $kickc){
					$zone=get_zone($partic_step[$kickc]);
					if($enemy_stat[($partic_step[$kickc])]-1>=2){
						$sqlf.=', participants.damaged_'.$zone.'=participants.damaged_'.$zone.'-1';
						$enemy_stat[($partic_step[$kickc])]-=1;
					}
				}
			}
		}
		$enemy_stat['hp_now']-=($damage[0]+$damage[1]);
		mysql_query("UPDATE battles_stat SET a=a+$upd_udar, u=u+$upd_uv, k=k+$upd_krit WHERE u_id = ".$partic_stat['id']);
		mysql_query("UPDATE battles_stat SET d=d+$upd_block WHERE u_id=".$enemy_stat['id']);
		mysql_query("UPDATE players,participants SET players.hp_now=".($enemy_stat['hp_now']).",participants.hp=".($enemy_stat['hp_now'])."$sqlf WHERE players.id=".$enemy_stat['id']." AND participants.id=".$enemy_stat['id'].' and participants.hp>0 and participants.time='.$stat['battle']);
		mysql_query("UPDATE participants SET damage=damage+".($damage[0]+$damage[1])." WHERE id=".$partic_stat['id'].' and time='.$stat['battle']);//+
		mysql_query("UPDATE battles SET type=1, damage=".($damage[0]+$damage[1]).", comment2='$cmnt2',comment1='$cmnt1' WHERE offer='".$stat['battle']."' AND id='".$partic_step['id']."' AND attacker='".$partic_step['attacker']."'");//+

		$on_get_broken=array('h'=>1,'t'=>2,'l'=>3,'r'=>4,'le'=>5);
		
		foreach(array('h','t','l','r','le') as $zon){

			if($enemy_stat[$on_get_broken[$zon]]==2 && is_numeric($enemy_stat[$on_get_broken[$zon]]) && (is_numeric($partic_step['lkick'])||is_numeric($partic_step['rkick']))){
				switch ($zon){
					case 'h':$w=1;$combr='получил сотрясение мозга';break;
					case 't':$w=4;$combr='сломал ребра';break;
					case 'l':$w=5;$combr='сломал левую руку';break;
					case 'r':$w=3;$combr='сломал правую руку';break;
					case 'le':$w=13;$combr='сломал ногу';break;
				}
				
			   $partic_color='000';
			   $enemy_color='000';
			if($partic_step['side']==0){
				$partic_color='000';
				$enemy_color='000';
			}
			
				$enemy_stat['hp_now']-=$partic_stat['strength'];
				if($enemy_stat['hp_now']<0) $enemy_stat['hp_now']=0;
				mysql_query('insert into battles (offer,time,id,defender,damage,comment1,type)values('.$stat['battle'].','.time().','.$partic_step['id'].',\''.$partic_step['defender'].'\','.$partic_stat['strength'].',\'Персонаж <font color='.$enemy_color.'>'.$partic_step['defender'].'</font> '.$combr.' и получил <b><font color=red>'.$partic_stat['strength'].'</font></b> единиц урона ['.$partic_step['defender'].': '.($enemy_stat['hp_now']).']\',2)');

				mysql_query('update players set hp_now='.$enemy_stat['hp_now'].' where user=\''.$enemy_stat['user'].'\' and id='.$enemy_stat['id']);
				mysql_query('update participants set hp='.$enemy_stat['hp_now'].',damaged_'.$zon.'=1 where id='.$enemy_stat['id'].' and time='.$stat['battle']);

				if($enemy_stat['rank']!=60){
					$s=@mysql_fetch_array(mysql_query("SELECT $w as `s` FROM `slots` WHERE id=".$enemy_stat['id']));
					$obj=@mysql_fetch_array(mysql_query("SELECT slots.".$s['s']." as id, objects.hp, objects.energy FROM slots, objects WHERE slots.id=".$enemy_stat['id']." && objects.id=slots.$w"));
					mysql_query("UPDATE slots, players,participants set slots.$w=0, players.hp_now=if(players.hp_now<$obj[hp],0,players.hp_now-$obj[hp]), players.energy_now=if(players.energy_now<$obj[energy],0,players.energy_now-$obj[energy]),participants.hp=if(participants.hp<$obj[hp],0,participants.hp-$obj[hp]) WHERE slots.id=".$enemy_stat['id']." AND players.id=".$enemy_stat['id']." AND participants.id=".$enemy_stat['id']);
					$oj=@mysql_fetch_array(mysql_query("SELECT inf FROM objects WHERE id=".$s['s']));
					$oj_inf=explode("|",$oj['inf']);
					$oj_inf[6]+=3;
					if($oj_inf[6]>=$oj_inf[7]) mysql_query('DELETE FROM objects WHERE id='.$w);
					else mysql_query('UPDATE objects SET inf='.implode('|',$oj_inf).' WHERE id='.$w);
                    if($enemy_stat['3']==2 && $enemy_stat['4']==2) // неожиданно сломались обе руки
                    foreach(array('6','7','8','9','10','11','12','14') as $w){
                        $s=@mysql_fetch_array(mysql_query("SELECT $w as `s` FROM `slots` WHERE id=".$enemy_stat['id']));
                        $obj=@mysql_fetch_array(mysql_query("SELECT slots.".$s['s']." as id, objects.hp, objects.energy FROM slots, objects WHERE slots.id=".$enemy_stat['id']." && objects.id=slots.$w"));
                        mysql_query("UPDATE slots, players,participants set slots.$w=0, players.hp_now=if(players.hp_now<$obj[hp],0,players.hp_now-$obj[hp]), players.energy_now=if(players.energy_now<$obj[energy],0,players.energy_now-$obj[energy]),participants.hp=if(participants.hp<$obj[hp],0,participants.hp-$obj[hp]) WHERE slots.id=".$enemy_stat['id']." AND players.id=".$enemy_stat['id']." AND participants.id=".$enemy_stat['id']);
                        $oj=@mysql_fetch_array(mysql_query("SELECT inf FROM objects WHERE id=".$s['s']));
                        $oj_inf=explode("|",$oj['inf']);
                        $oj_inf[6]+=3;
                        if($oj_inf[6]>=$oj_inf[7]) mysql_query('DELETE FROM objects WHERE id='.$w);
                        else mysql_query('UPDATE objects SET inf='.implode('|',$oj_inf).' WHERE id='.$w);
                    }
				}}}
				
				
		
				// unset();
				mysql_query('update players set hp_now='.$partic_stat['hp_now'].' where user=\''.$partic_stat['user'].'\' and id='.$partic_stat['id']);
				mysql_query('update participants set hp='.$partic_stat['hp_now'].' where id='.$partic_stat['id'].' and time='.$stat['battle']);
				unset($cmnt1,$cmnt2,$zone,$sql,$oj,$w,$s,$obj,$oj_inf,$zone,$sqlf);
	} // завершили цикл на персонажа
}
?>
