<?
if ($stat['aura_t'] > $now) $nms="�� ������ ��������� ��� ��������� ������ ����� ����!";
else {

	$aura_time=$now+28800;

	mysql_query("UPDATE `person` SET `aura`='6', `aura_t`='$aura_time' WHERE `user`='".$stat['user']."'");

	require_once("function/chat_insert.php");
	insert_msg("�� ��� ���� �������� ���� ������������ ��� 1 ������!","","","1",$stat['user'],"",$stat['room']);
	$nms="�� �������� �� ��������� ���� ������������ ���!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>