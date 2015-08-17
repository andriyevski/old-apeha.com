<?
if ($stat['battle']) $nms="В бою лечение травм невозможно!";
elseif ($chl['travma'] < $now) $nms="Персонаж не травмирован!";
elseif ($stat['energy_now'] < 20) $nms="У вас не хватает маны!";
elseif ($chl['room'] != $stat['room']) $nms="Для исцеления персонажа от травм Вам необходимо находится в одной комнате!";
else {

	include("includes/magic/drop.php");

	mysql_query("UPDATE person SET travma=NULL where id='".$chl['id']."'");
	mysql_query("update person set energy_now=energy_now-20 where id='".$stat['id']."'");
	if ($chl['user'] == $stat['user']) {
		$MesgForAdd = "Вы успешно исцелили себя от травм!";
		$stat['travma'] = NULL;
	}
	else $MesgForAdd = "Вы исцелены от травм лекарем <b><u>".$stat['user']."</u></b>";

	require_once("function/chat_insert.php");
	insert_msg("$MesgForAdd","","","1",$chl[user],"","0");

	$nms="Всё прошло удачно...<br>Персонаж <u>".$chl['user']."</u> успешно исцелён от травм!";
	$alldone=1;
}

?>