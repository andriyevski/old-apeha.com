<?

$_obj=mysql_fetch_array(mysql_query("SELECT SUM(objects.`hp`) as `hp`, SUM(objects.`energy`) as `energy`, SUM(objects.`strength`) as `strength`, SUM(objects.`dex`) as `dex`, SUM(objects.`agility`) as `agility`, SUM(objects.`vitality`) as `vitality`, SUM(objects.`razum`) as `razum` FROM slots, objects WHERE slots.id='".$second['id']."' AND objects.user='".$second['user']."' AND objects.id IN (slots.1,slots.2,slots.3,slots.4,slots.5,slots.6,slots.7,slots.8,slots.9,slots.10,slots.11,slots.12,slots.13,slots.14,slots.15,slots.16,slots.17,slots.18,slots.19) LIMIT 1"));


// HP, Energy
$second['hp']+=$_obj['hp'];
$second['energy']+=$_obj['energy'];

$second['ork']=$SecondSkills['0']*5;
$second['elf']=$SecondSkills['1']*5;
$second['people']=$SecondSkills['2']*5;
$second['gnom']=$SecondSkills['3']*5;

// Статы
######+ Зелье силы####
if ($second['elik_sila'] > $now) {
	$second['strength']+=$_obj['strength']+$second['elik_ks'];}
	else {
		$second['strength']+=$_obj['strength'];
	}
	######+ Зелье Ловкости####
	if ($second['elik_lovkost'] > $now) {
		$second['agility']+=$_obj['agility']+$second['elik_kl'];}
		else {
			$second['agility']+=$_obj['agility'];
		}
		######+ Зелье Интуиции####
		if ($second['elik_inta'] > $now) {
			$second['dex']+=$_obj['dex']+$second['elik_ki'];}
			else {
				$second['dex']+=$_obj['dex'];
			}
			######+ Зелье Выносливости####
			if ($second['elik_vinosl'] > $now) {
				$second['vitality']+=$_obj['vitality']+$second['elik_kv'];}
				else {
					$second['vitality']+=$_obj['vitality'];
				}
				######+ Зелье Разума####
				if ($second['elik_razum'] > $now) {
					$second['razum']+=$_obj['razum']+$second['elik_kr'];}
					else {
						$second['razum']+=$_obj['razum'];
					}

					######+ Зелье брони####
					if ($second['elik_br'] > $now) {
						$second['br1']+=ceil($_obj['br1']+$second['vitality']+$second['elik_kb']+($second['m_t']*2));
						$second['br2']+=ceil($_obj['br2']+$second['vitality']+$second['elik_kb']+($second['m_t']*2));
						$second['br3']+=ceil($_obj['br3']+$second['vitality']+$second['elik_kb']+($second['m_t']*2));
						$second['br4']+=ceil($_obj['br4']+$second['vitality']+$second['elik_kb']+($second['m_t']*2));
						$second['br5']+=ceil($_obj['br5']+$second['vitality']+$second['elik_kb']+($second['m_t']*2));
					}
					else {
						$second['br1']+=ceil($_obj['br1']+$second['vitality']+($second['m_t']*2));
						$second['br2']+=ceil($_obj['br2']+$second['vitality']+($second['m_t']*2));
						$second['br3']+=ceil($_obj['br3']+$second['vitality']+($second['m_t']*2));
						$second['br4']+=ceil($_obj['br4']+$second['vitality']+($second['m_t']*2));
						$second['br5']+=ceil($_obj['br5']+$second['vitality']+($second['m_t']*2));
					}
					// МФ

					$second['krit']+=ceil($_obj['krit']+($second['agility']*5));
					$second['unkrit']+=ceil($_obj['unkrit']+($second['vitality']*4));
					$second['uv']+=ceil(($_obj['uv']*(1+($second['elf']/100)))+($second['dex']*5));
					$second['unuv']+=ceil($_obj['unuv']+($second['strength']*4));
					$second['min']+=ceil($_obj['min_d']+$second['strength']+($second['m_d']*2));
					$second['max']+=ceil($_obj['max_d']+$second['strength']+($second['m_d']*2));

$SecondSkills = explode("|",$second['rase_skill']);

?>
