<?
if ($stat['user'] != "$chl[user]") $nms="Данное заклинание можно наложить только на себя!";
else {

	$MySkills = explode("|",$stat['rase_skill']);

	$stat['warattack']=$MySkills['0'];
	$stat['reactor']=$MySkills['1'];
	$stat['energymd']=$MySkills['2'];
	$stat['res']=$MySkills['3'];
	$stat['uvor']=$MySkills['4'];
	$stat['kritud']=$MySkills['5'];

	$skills = $stat['warattack'] + $stat['reactor'] + $stat['energymd'] + $stat['res'] + $stat['uvor'] + $stat['kritud'];

	mysql_query("update person set o_updates=o_updates+$skills where id=".$stat[id]."");
	mysql_query("update person set rase_skill='0|0|0|0|0|0' where id=".$stat[id]."");

	include("includes/magic/drop.php");
	$nms="Всё прошло удачно...<br>Ваши модификаторы сброшены!";
	$alldone=1;
}
?>
