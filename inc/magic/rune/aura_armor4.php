<?
if ($stat['aura_t'] > $now) $nms="¬ы можете находитс€ под действием только одной ауры!";
else {

	$aura_time=$now+14400;

	mysql_query("UPDATE `person` SET `aura`='4', `aura_t`='$aura_time' WHERE `user`='".$stat['user']."'");

	require_once("function/chat_insert.php");
	insert_msg("Ќа вас была наложена аура магической брони 4 уровн€!","","","1",$stat['user'],"",$stat['room']);
	$nms="¬ы наложили на персонажа ауру магической брони!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>