<?
if ($chl['room'] != $stat['room'])
$nms="ѕерсонаж на которого вы хотите наложить заклинание находитс€ не в вашей комнате.";

else {

	include("inc/magic/drop.php");

	mysql_query("update players set room=1 where user='".$chl['user']."'");

	require_once("inc/chat/functions.php");
	insert_msg("¬ы удачно телепортировались в <b>ѕорт</b>!","","","1",$chl['user'],"",$chl['room']);
}

?>