<?

if ($chl['travma'] < $now) $nms="Персонаж не травмирован!";
elseif ($chl['room'] != $stat['room']) $nms="Для исцеления персонажа от травм Вам необходимо находится в одной комнате!";
else {

	include("inc/magic/drop.php");

	mysql_query("UPDATE players SET travma=NULL where id='".$chl['id']."'");

	if ($chl['user'] == $stat['user']) {
		$MesgForAdd = "Вы успешно исцелили себя от травм!";
		$stat['travma'] = NULL;
	}
	else $MesgForAdd = "Вы исцелены от травм лекарем <b><u>".$stat['user']."</u></b>";

	require_once("inc/chat/functions.php");
	insert_msg("$MesgForAdd","","","1",$chl['user'],"",$chl['room']);

	$nms="Всё прошло удачно...<br>Персонаж <u>".$chl['user']."</u> успешно исцелён от травм!";
	$alldone=1;
}

?>