<?

if ($stat['user'] != "$chl[user]") $nms="Данное заклинание можно наложить только на себя!";
elseif ($stat['s_update'] != 0) $nms="У вас имеются свободные умения, сначала используйте их!";

else {

	include("inc/magic/drop.php");

	mysql_query("UPDATE slots set slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE id='".$stat['id']."'");
	$level_inf=mysql_fetch_array(mysql_query("SELECT SUM(updates) as updates FROM levels WHERE exp<=".$stat['exp'].""));
	mysql_query("UPDATE players SET strength=3, dex=3, agility=3, vitality=3, power=3, razum=0, s_updates=".$level_inf['updates'].", hp_now=15, energy_now=15 WHERE id='".$stat['id']."'");

	$stat['strength'] = 3;
	$stat['dex'] = 3;
	$stat['agility'] = 3;
	$stat['vitality'] = 3;
	$stat['power'] = 3;
	$stat['razum'] = 0;
	$stat['hp_now'] = 15;
	$stat['energy_now'] = 15;
	$stat['hp'] = 0;
	$stat['energy'] = 0;
	$stat['br1'] = 0;
	$stat['br2'] = 0;
	$stat['br3'] = 0;
	$stat['br4'] = 0;
	$stat['br5'] = 0;
	$stat['krit'] = 0;
	$stat['unkrit'] = 0;
	$stat['uv'] = 0;
	$stat['unuv'] = 0;
	$stat['min'] = 0;
	$stat['max'] = 0;

	$nms="Всё прошло удачно...<br>Ваши параметры сброшены!";
	$alldone=1;
}

?>