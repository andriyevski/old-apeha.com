<?
$now=time();


// Функция "выбрасывания" вещи
function drop ($drop) {
	global $stat;
	if (preg_match("/^[0-9]+$/", $drop)){
		$is_my=mysql_fetch_array(mysql_query("SELECT id, hp, energy FROM objects WHERE id='".addslashes($drop)."' AND user='".$stat['user']."' AND bank=0"));

		if (!empty($is_my['id'])) {

			$is_onset=mysql_num_rows(mysql_query("SELECT slots.id as id FROM slots WHERE slots.id=".$stat['id']." AND ".addslashes($drop)." IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19)"));

			if ($is_onset == 1) {
				mysql_query("UPDATE players set players.hp_now=if(players.hp_now<$is_my[hp],0,players.hp_now-$is_my[hp]), players.energy_now=if(players.energy_now<$is_my[energy],0,players.energy_now-$is_my[energy]) WHERE players.id=".$stat['id'].""); }
		}

		mysql_query("DELETE FROM objects WHERE id='".$is_my['id']."'");

		Header("Location: main.php?set=edit&tmp=$now");
	}
}
//




// Функция снимания вещи
function un_set ($unset) {
	global $stat,$now;

	$unset=str_replace("w","",$unset);
	if (preg_match("/^[0-9]+$/", $unset)){
		$obj=mysql_fetch_array(mysql_query("SELECT slots.".addslashes($unset)." as id, objects.hp, objects.energy FROM slots, objects WHERE slots.id=".$stat['id']." && objects.id=slots.".addslashes($unset)." AND objects.bank=0"));

		mysql_query("UPDATE slots, players set slots.".addslashes($unset)."=0, players.hp_now=if(players.hp_now<$obj[hp],0,players.hp_now-$obj[hp]), players.energy_now=if(players.energy_now<$obj[energy],0,players.energy_now-$obj[energy]) WHERE slots.id=".$stat['id']." AND players.id=".$stat['id']."");

		Header("Location: main.php?set=edit&tmp=$now");
	}
}
//

// Функция снимания всех вещей
function un_set_all () {
	global $stat,$now;
	mysql_query("UPDATE slots SET slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE slots.id='".$stat['id']."'");
	Header("Location: main.php?set=edit&tmp=$now");
}
//


// ----- # Одевание вещи # ----- //
function on_set ($onset) {
	global $stat,$now;
	if (preg_match("/^[0-9]+$/", $onset)){
		include("inc/main/changed.php");
		$obj=mysql_fetch_array(mysql_query("SELECT `id`,`inf`,`min`,`tip` FROM objects WHERE user='".$stat['user']."' && id=".addslashes($onset)." AND objects.bank=0"));

		$obj_inf=explode("|",$obj['inf']);
		$obj_min=explode("|",$obj['min']);

		if (($stat['level'] < $obj_min['0'] || $stat['strength'] < $obj_min['1'] || $stat['dex'] < $obj_min['2'] || $stat['agility'] < $obj_min['3'] || $stat['vitality'] < $obj_min['4'] || $stat['razum'] < $obj_min['5'] || ($stat['rase'] != $obj_min['6'] && $obj_min['6'] != 0 AND $stat['rase'] != 100) || ($obj_min['7'] != 0 && $stat['proff'] != $obj_min['7'])) || $obj['tip'] == 13 || $obj_inf[6]>=$obj_inf[7]){
			Header("Location: main.php?set=edit&tmp=$now");
		}else{

			$slot_inf=mysql_fetch_array(mysql_query("SELECT `3` as `slot3`,`5` as `slot5`,`6` as `slot6`,`7` as `slot7`,`8` as `slot8`,`10` as `slot10`,`11` as `slot11`,`12` as `slot12`,`16` as `slot16`,`17` as `slot17` FROM slots WHERE id=".$stat['id'].""));

			switch ($obj['tip']) {

				case 1: if ($slot_inf['slot3'] && $obj_inf['4']) $slot = 5; else $slot = 3; break;

				case 2: $slot = 4; break;

				case 3:  if (!$slot_inf['slot6']) $slot = 6;
				elseif (!$slot_inf['slot7']) $slot = 7;
				elseif (!$slot_inf['slot8']) $slot = 8;
				elseif (!$slot_inf['slot10']) $slot = 10;
				elseif (!$slot_inf['slot11']) $slot = 11;
				elseif (!$slot_inf['slot12']) $slot = 12;
				else $slot = 6; break;

				case 4: $slot = 2; break;
				case 5: $slot = 5; break;
				case 6: $slot = 13; break;
				case 7: $slot = 9; break;
				case 8: $slot = 1; break;
				case 9: $slot = 15; break;
				case 10: $slot = 14; break;
				case 11: if ($slot_inf['slot16']) $slot = 19; else $slot = 16; break;

				case 12: if (mysql_num_rows(mysql_query("SELECT objects.id AS id FROM objects,slots WHERE slots.id='".$stat['id']."' AND objects.id=slots.17")) == 1) $slot = 18; else $slot = 17; break;

				case 14: if ($slot_inf['slot3'] && $obj_inf['4']) $slot = 5; else $slot = 3; break;

				case 15: $slot = 3; break;
			}

			$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));


			$MySkills = explode("|",$stat['rase_skill']);

			$stat['ork']=$MySkills['0']*5;
			$stat['elf']=$MySkills['1']*5;
			$stat['people']=$MySkills['2']*5;
			$stat['gnom']=$MySkills['3']*5;

			$stat['energy']+=$_obj['energy'];

			// Статы
			if ($stat['elik_sila'] > $now) {
				$stat['strength']+=$_obj['strength']+$stat['elik_ks'];}
				else {
					$stat['strength']+=$_obj['strength'];
				}
				######+ Зелье Ловкости####
				if ($stat['elik_lovkost'] > $now) {
					$stat['agility']+=$_obj['agility']+$stat['elik_kl'];}
					else {
						$stat['agility']+=$_obj['agility'];
					}
					######+ Зелье Интуиции####
					if ($stat['elik_inta'] > $now) {
						$stat['dex']+=$_obj['dex']+$stat['elik_ki'];}
						else {
							$stat['dex']+=$_obj['dex'];
						}
						######+ Зелье Выносливости####
						if ($stat['elik_vinosl'] > $now) {
							$stat['vitality']+=$_obj['vitality']+$stat['elik_kv'];}
							else {
								$stat['vitality']+=$_obj['vitality'];
							}
							######+ Зелье Разума####
							if ($stat['elik_razum'] > $now) {
								$stat['razum']+=$_obj['razum']+$stat['elik_kr'];}
								else {
									$stat['razum']+=$_obj['razum'];
								}



								if ($obj_inf['6']>=$obj_inf['7'] OR $stat['level']<$obj_min['0'] OR $stat['strength']<$obj_min['1'] OR $stat['dex']<$obj_min['2'] OR $stat['agility']<$obj_min['3'] OR $stat['vitality']<$obj_min['4'] OR $stat['razum']<$obj_min['5']) { echo "Что-то тут не так..."; }

								else {
									mysql_query("UPDATE slots SET slots.$slot=".$obj['id']." WHERE id=".$stat['id']."");
								}


								Header("Location: main.php?set=edit&tmp=$now");
		}
	}
}
?>
