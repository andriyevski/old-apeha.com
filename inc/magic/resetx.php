<?

if ($stat['user'] != "$chl[user]") $nms="Данное заклинание можно наложить только на себя!";
else {

	include("inc/magic/drop.php");

	mysql_query("UPDATE slots set slots.1=0, slots.2=0, slots.3=0, slots.4=0, slots.5=0, slots.6=0, slots.7=0, slots.8=0, slots.9=0, slots.10=0, slots.11=0, slots.12=0, slots.13=0, slots.14=0, slots.15=0, slots.16=0, slots.17=0, slots.18=0, slots.19=0 WHERE id='".$stat['id']."'");
	$level_inf=mysql_fetch_array(mysql_query("SELECT SUM(raseup) as raseup FROM levels WHERE exp<=".$stat['exp'].""));
	mysql_query("UPDATE players SET rase_skill='0|0|0|0', o_updates=".$level_inf['raseup']." WHERE id='".$stat['id']."'");

	$stat['rase_skill'] ='0|0|0|0';
	$stat['krit'] = 0;
	$stat['unkrit'] = 0;
	$stat['uv'] = 0;
	$stat['unuv'] = 0;

	$nms="Всё прошло удачно...<br>Ваши характеристики сброшены!";
	$alldone=1;
}

?>