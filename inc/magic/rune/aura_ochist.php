<?
if ($stat['aura_t'] < $now) $nms="Вы не находитесь под действием аур!";
else {

	mysql_query("UPDATE `person` SET `aura`='0', `aura_t`='0' WHERE `user`='".$stat['user']."'");

	require_once("function/chat_insert.php");
	insert_msg("Вы очистились от действий аур!","","","1",$stat['user'],"",$stat['room']);
	$nms="Вы очистили персонажа от действий аур!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>