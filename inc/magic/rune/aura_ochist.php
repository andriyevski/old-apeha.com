<?
if ($stat['aura_t'] < $now) $nms="�� �� ���������� ��� ��������� ���!";
else {

	mysql_query("UPDATE `person` SET `aura`='0', `aura_t`='0' WHERE `user`='".$stat['user']."'");

	require_once("function/chat_insert.php");
	insert_msg("�� ���������� �� �������� ���!","","","1",$stat['user'],"",$stat['room']);
	$nms="�� �������� ��������� �� �������� ���!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>