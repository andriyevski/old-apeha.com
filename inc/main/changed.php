<?
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$stat['id']."' AND objects.user='".$stat['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));


$MySkills = explode("|",$stat['rase_skill']);

$stat['ork']=$MySkills['0']*5;
$stat['elf']=$MySkills['1']*5;
$stat['people']=$MySkills['2']*5;
$stat['gnom']=$MySkills['3']*5;

$stat['energy']+=$_obj['energy'];

// Статы
// Зелья
######+ Зелье силы####
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
					$stat['energy']+=$_obj['energy'];



					// HP, Energy
					$stat['hp']+=$_obj['hp'];
					$stat['hp_max']=ceil(($stat['vitality']*5+$stat['hp'])*(1+($stat['gnom']/100)));

					if ($stat['hp_now'] > $stat['hp_max']) {
						mysql_query("UPDATE `players` SET `hp_now` = '".$stat['hp_max']."' WHERE `id` = '".$stat['id']."'");
						echo mysql_error();
						$stat['hp_now'] = $stat['vitality']*5+$stat['hp'];
					}

					if ($set == "edit") {

						######+ Зелье брони####
						if ($stat['elik_br'] > $now) {
							$stat['br1']+=ceil($_obj['br1']+$stat['vitality']+$stat['elik_kb']+($stat['m_t']*2));
							$stat['br2']+=ceil($_obj['br2']+$stat['vitality']+$stat['elik_kb']+($stat['m_t']*2));
							$stat['br3']+=ceil($_obj['br3']+$stat['vitality']+$stat['elik_kb']+($stat['m_t']*2));
							$stat['br4']+=ceil($_obj['br4']+$stat['vitality']+$stat['elik_kb']+($stat['m_t']*2));
							$stat['br5']+=ceil($_obj['br5']+$stat['vitality']+$stat['elik_kb']+($stat['m_t']*2));
						}
						else {
							$stat['br1']+=ceil($_obj['br1']+$stat['vitality']+($stat['m_t']*2));
							$stat['br2']+=ceil($_obj['br2']+$stat['vitality']+($stat['m_t']*2));
							$stat['br3']+=ceil($_obj['br3']+$stat['vitality']+($stat['m_t']*2));
							$stat['br4']+=ceil($_obj['br4']+$stat['vitality']+($stat['m_t']*2));
							$stat['br5']+=ceil($_obj['br5']+$stat['vitality']+($stat['m_t']*2));
						}

						$stat['krit']+=ceil(($_obj['krit']*(1+($stat['people']/100)))+($stat['dex']*5));
						$stat['unkrit']+=ceil($_obj['unkrit']+($stat['vitality']*4));
						$stat['uv']+=ceil(($_obj['uv']*(1+($stat['elf']/100)))+($stat['agility']*5));
						$stat['unuv']+=ceil($_obj['unuv']+($stat['strength']*4));
						$stat['min']+=ceil($_obj['min_d']+$stat['strength']+($stat['m_d']*2));
						$stat['max']+=ceil($_obj['max_d']+$stat['strength']+($stat['m_d']*2));
					}

					?>