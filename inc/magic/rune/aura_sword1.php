<?
if ($stat['aura_t'] > $now) $nms="¬ы можете находитс€ под действием только одной ауры!";
else {

	$aura_time=$now+28800;

	mysql_query("UPDATE `person` SET `aura`='6', `aura_t`='$aura_time' WHERE `user`='".$stat['user']."'");

	require_once("function/chat_insert.php");
	insert_msg("Ќа вас была наложена аура зачарованный меч 1 уровн€!","","","1",$stat['user'],"",$stat['room']);
	$nms="¬ы наложили на персонажа ауру зачарованный меч!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>