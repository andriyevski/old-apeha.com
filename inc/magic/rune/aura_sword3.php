<?
if ($stat['aura_t'] > $now) $nms="�� ������ ��������� ��� ��������� ������ ����� ����!";
else {

	$aura_time=$now+21600;

	mysql_query("UPDATE `person` SET `aura`='8', `aura_t`='$aura_time' WHERE `user`='".$stat['user']."'");

	require_once("function/chat_insert.php");
	insert_msg("�� ��� ���� �������� ���� ������������ ��� 3 ������!","","","1",$stat['user'],"",$stat['room']);
	$nms="�� �������� �� ��������� ���� ������������ ���!";

	include("includes/magic/drop.php");
	$alldone=1;
}
?>