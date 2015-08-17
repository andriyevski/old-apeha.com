<?
$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum`, SUM(objects.`br1`) as `br1`, SUM(objects.`br2`) as `br2`, SUM(objects.`br3`) as `br3`, SUM(objects.`br4`) as `br4`, SUM(objects.`br5`) as `br5`, SUM(objects.`krit`) as `krit`, SUM(objects.`unkrit`) as `unkrit`, SUM(objects.`uv`) as `uv`, SUM(objects.`unuv`) as `unuv`, SUM(objects.`min_d`) as `min_d`, SUM(objects.`max_d`) as `max_d` FROM slots, objects WHERE slots.id='".$info['id']."' AND objects.user='".$info['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));


$MySkills = explode("|",$info['rase_skill']);

$info['ork']=$MySkills['0']*5;
$info['elf']=$MySkills['1']*5;
$info['people']=$MySkills['2']*5;
$info['gnom']=$MySkills['3']*5;

$info['energy']+=$_obj['energy'];

// Статы
// Зелья
######+ Зелье силы####
if ($info['elik_sila'] > $now) {
	$info['strength']+=$_obj['strength']+$info['elik_ks'];}
	else {
		$info['strength']+=$_obj['strength'];
	}
	######+ Зелье Ловкости####
	if ($info['elik_lovkost'] > $now) {
		$info['agility']+=$_obj['agility']+$info['elik_kl'];}
		else {
			$info['agility']+=$_obj['agility'];
		}
		######+ Зелье Интуиции####
		if ($info['elik_inta'] > $now) {
			$info['dex']+=$_obj['dex']+$info['elik_ki'];}
			else {
				$info['dex']+=$_obj['dex'];
			}
			######+ Зелье Выносливости####
			if ($info['elik_vinosl'] > $now) {
				$info['vitality']+=$_obj['vitality']+$info['elik_kv'];}
				else {
					$info['vitality']+=$_obj['vitality'];
				}
				######+ Зелье Разума####
				if ($info['elik_razum'] > $now) {
					$info['razum']+=$_obj['razum']+$info['elik_kr'];}
					else {
						$info['razum']+=$_obj['razum'];
					}
					$info['energy']+=$_obj['energy'];


					// HP, Energy
					$info['hp']+=$_obj['hp'];
					$info['hp_max']=ceil(($info['vitality']*5+$info['hp'])*(1+($info['gnom']/100)));

					if ($info['hp_now'] > $info['hp_max']) {
						mysql_query("UPDATE `players` SET `hp_now` = '".$info['hp_max']."' WHERE `id` = '".$info['id']."'");
						echo mysql_error();
						$info['hp_now'] = $info['vitality']*5+$info['hp'];
					}

					if ($set == "edit") {
						// МФ
						$info['br1']+=ceil($_obj['br1']+$info['vitality']+($info['m_t']*2));
						$info['br2']+=ceil($_obj['br2']+$info['vitality']+($info['m_t']*2));
						$info['br3']+=ceil($_obj['br3']+$info['vitality']+($info['m_t']*2));
						$info['br4']+=ceil($_obj['br4']+$info['vitality']+($info['m_t']*2));
						$info['br5']+=ceil($_obj['br5']+$info['vitality']+($info['m_t']*2));
						$info['krit']+=ceil($_obj['krit']+($info['agility']*5));
						$info['unkrit']+=ceil($_obj['unkrit']+($info['vitality']*4));
						$info['uv']+=ceil(($_obj['uv']*(1+($info['elf']/100)))+($info['dex']*5));
						$info['unuv']+=ceil($_obj['unuv']+($info['strength']*4));
						$info['min']+=ceil($_obj['min_d']+$info['strength']+($info['m_d']*2));
						$info['max']+=ceil($_obj['max_d']+$info['strength']+($info['m_d']*2));
					}

					?>